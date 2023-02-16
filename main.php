<?php include 'header.php' ?>

<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {

    $sql = "SELECT WP.WorkID AS WorkID,
            S.Name,
            CONCAT(E.First_name,' ',E.Last_name) AS employee_full,
            WP.Date_started,
            CONCAT(M.Producer_name,' ' ,M.Model_name) AS car_full,
            CONCAT(cl.First_name ,' ', cl.Last_name) as client_full 
            FROM `works_performed` WP
            JOIN services S on S.ServiceID = WP.ServiceID
            JOIN employees E ON E.EmployeeID = WP.EmployeeID
            JOIN cars C ON C.CarID = WP.CarID
            JOIN clients CL ON CL.ClientID = C.ClientID
            JOIN models M on M.ModelID = C.ModelID
            WHERE WP.Finished = 0 AND E.Is_free = 0
            ORDER BY WP.Date_started;";
    $result = mysqli_query($conn, $sql);
    $current_works = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $sql = 'SELECT COUNT(*) FROM `works_performed`
            WHERE Finished = 0;';
    $result = mysqli_query($conn, $sql);
    $number_of_current_works = mysqli_fetch_array($result);

    if (isset($_GET['finish'])) {
        //caut angajatul care a facut lucrarea
        $sql = "SELECT E.EmployeeID FROM employees E
                JOIN works_performed WP ON WP.EmployeeID = E.EmployeeID
                WHERE WorkID = " . $_GET['finish'] . ";";
        $result = mysqli_query($conn, $sql);
        $employee_id = mysqli_fetch_array($result);

        $sql = 'UPDATE `works_performed` WP SET `Finished`=1,
                Duration = TIMESTAMPDIFF(HOUR, WP.Date_started, NOW())
                WHERE WorkID = ' . $_GET['finish'] . ';';
        $result = mysqli_query($conn, $sql);

        $sql = 'UPDATE `employees` SET `Is_free`=1 WHERE EmployeeID = ' . $employee_id[0] . ';';
        $result = mysqli_query($conn, $sql);

        mysqli_close($conn);

        header('Location: main.php');
    }
}
?>


<div class='main_container'>
    <h1>Lucrari in desfasurare: <?php echo $number_of_current_works[0] ?></h1>
    <div style= "margin: 10px;">
        <a style='color:bisque;float:left;margin:25px;padding:5px' href='works_archive.php'>Vezi istoric lucrari</a>
    </div>
    <form action="main.php" method="get" id='main_form'>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>Nume Lucrare</th>
                <th>Nume si Prenume angajat</th>
                <th>Data inceperii</th>
                <th>Masina</th>
                <th>Nume si Prenume Client</th>
                <th>Reparatie finalizata</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php // LOOP TILL END OF DATA
            foreach ($current_works as $current_work) {
            ?>
                <tr>
                    <!--FETCHING DATA FROM EACH
                            ROW OF EVERY COLUMN-->
                    <td><?php echo $current_work['Name']; ?></td>
                    <td><?php echo $current_work['employee_full'] ?></td>
                    <td><?php echo $current_work['Date_started']; ?></td>
                    <td><?php echo $current_work['car_full']; ?></td>
                    <td><?php echo $current_work['client_full']; ?></td>
                    <td><button type='submit' form="main_form" class="table_button" name='finish' value=<?php echo $current_work['WorkID']; ?>>Finalizeaza</button></td>

                </tr>
            <?php
            }
            ?>
        </table>

    </form>
    <div class="container_add_works">
        <a href="insert_works.php">Adauga lucrari noi</a>
    </div>

</div>


</body>