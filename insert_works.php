<?php include 'header.php' ?>

<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {

    $sql = 'SELECT CONCAT(First_name,\' \', Last_name,\'(\',Specialization,\')\') As all_data, Specialization, 	EmployeeID
            FROM `employees` WHERE Is_free = 1 ORDER BY all_data;';
    $result = mysqli_query($conn, $sql);
    $free_employees = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $sql = 'SELECT CONCAT(Name,\', specializare necesara: \', Specialization_needed) AS all_data, ServiceID
            FROM services WHERE 1';
    $result = mysqli_query($conn, $sql);
    $services = mysqli_fetch_all($result, MYSQLI_ASSOC);


    //selecteaza masinile si clientii lor care nu sunt acum in curs de reparatie
    $sql = 'SELECT CONCAT(CL.First_name,\' \',CL.Last_name,\'-\' ,M.Producer_name,\' \',M.Model_name,\' \',CA.Engine) AS all_data, 
            CA.CarID AS CarID
        FROM `cars` CA
        JOIN clients CL ON CL.ClientID = CA.ClientID
        JOIN models M ON M.ModelID = CA.ModelID
        Where CA.CarID NOT IN(
            SELECT CarID FROM works_performed WP 
            WHERE WP.Finished = 0);';
    $result = mysqli_query($conn, $sql);
    $cars = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //adauga lucrare in BD, schimba statusul angajatului, si reduce numarul de piese de pe stoc cu 1
    $error_message = '';
    if (isset($_GET['submit'])) {
        //verifica daca angajatul este combatibil cu serviciul
        $sql = "SELECT Specialization_needed FROM services WHERE ServiceID = $_GET[service] ;";
        $result = mysqli_query($conn, $sql);
        $service = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $sql = "SELECT Specialization FROM employees WHERE EmployeeID = $_GET[employee] ;";
        $result = mysqli_query($conn, $sql);
        $employee = mysqli_fetch_all($result, MYSQLI_ASSOC);

        //verifica daca sunt piese pe stoc pentru masina data
        $sql = "SELECT * FROM `parts` WHERE ServiceID = $_GET[service] 
                AND ModelID = (SELECT ModelID FROM cars WHERE CarID = $_GET[car]);";
        $result = mysqli_query($conn, $sql);
        $parts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $ver = 0;
        foreach ($parts as $part) {
            if ($part["No_stock"] == 0 || $part["No_stock"] == NULL) {
                $ver = 1;
            }
        }

        if ($employee[0]['Specialization'] != $service[0]['Specialization_needed']) {
            $error_message = 'Angajatul nu este compatibil cu serviciul';
        } else if ($ver == 1) {
            $error_message = 'Nu exista piese pe stoc pentru acest serviciu';
        } else {
            $conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');


            $sql = "INSERT INTO `works_performed`(`ServiceID`, `EmployeeID`, `CarID`) 
                    VALUES ('$_GET[service]','$_GET[employee]','$_GET[car]');";
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE `employees` SET `Is_free`= 0 
                    WHERE EmployeeID = '$_GET[employee]';";
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE `parts` SET `No_stock`= No_stock - 1 
                    WHERE ServiceID = '$_GET[service]' AND ModelID = (SELECT ModelID FROM cars WHERE CarID = $_GET[car] );";
            $result = mysqli_query($conn, $sql);

            mysqli_close($conn);
            header('Location: main.php');
        }
    }
}

?>


<div class='main_container'>
    <h1>Adauga o lucrare noua:</h1>
    <div class='div_form'">
            <form action=" insert_works.php" method="get">

        <label for="service">Nume operatiune:</label>
        <BR>
        <select class='input_cls' name=service id=service required>
            <option disabled selected value> -- Alege o optiune -- </option>
            <?php foreach ($services as $service) : ?>
                <option value="<?php echo $service['ServiceID'] ?>"><?php echo $service['all_data'] ?></option>
            <?php endforeach;
            ?>
        </select>

        <BR>
        <label for="employee">Numele angajatului(<b style="color:brown">!alegeti o specializare compatibila</b>):</label>
        <BR>
        <select class='input_cls' name=employee id=employee required>
            <?php if (count($free_employees) == 0) { ?>
                <option disabled selected value> -- Nu exista angajati liberi -- </option>
            <?php } else { ?>
                <option disabled selected value> -- Alege o optiune -- </option>
                <?php foreach ($free_employees as $employee) : ?>
                    <option value="<?php echo $employee['EmployeeID'] ?>"><?php echo $employee['all_data'] ?></option>
            <?php endforeach;
            } ?>
        </select>

        <BR>
        <label for="car">Pentru masina clientului:</label>
        <BR>
        <select class='input_cls' name=car id=car required>
            <option disabled selected value> -- Alege o optiune -- </option>
            <?php foreach ($cars as $car) : ?>
                <option value="<?php echo $car['CarID'] ?>"><?php echo $car['all_data'] ?></option>
            <?php endforeach;
            ?>
        </select>

        <BR>
        <input class='login_button' type="submit" name="submit" value="Adauga">

        </form>
        <div class='error_message_container'>
            <?php echo $error_message ?>
        </div>

        Nu gasesti clientul?
        <div class="container_add_works">
            <a class='container_add_works' href="add_client.php">Adauga client nou</a>
        </div>

    </div>

</div>


</body>