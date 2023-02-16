<?php include 'header.php' ?>


<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {

    $error_message = '';
    if (isset($_GET['submit'])) {
        $first_name = $_GET['first_name'];
        $last_name = $_GET['last_name'];
        $CNP = $_GET['CNP'];
        $Specialization_aux = $_GET['Specialization'];
        if ($Specialization_aux == 0) {
            $Specialization = 'mecanic';
        } else if ($Specialization_aux == 1) {
            $Specialization = 'electrician';
        } else if ($Specialization_aux == 2) {
            $Specialization = 'tinichigiu';
        }
        $Salary = $_GET['Salary'];


        $sql = "INSERT INTO employees (First_name, Last_name, CNP, Specialization, Salary) VALUES ('$first_name', '$last_name', '$CNP', '$Specialization', '$Salary')";

        if (mysqli_query($conn, $sql)) {
            header("Location: employee.php");
        } else {
            $error_message = 'Error: ' . $sql . '<br>' . mysqli_error($conn);
        }
        mysqli_free_result($result);
        mysqli_close($conn);
    }
}
?>


<div class='main_container'>
    <h1>Adauga angajat nou: </h1>
    <div class='div_form'>
        <form action="add_employee.php" method="get">

            <label for="first_name"><b>Nume</b></label>
            <BR>
            <input class='input_cls' type="text" name="first_name" placeholder="Nume" required>

            <BR>
            <label for="last_name"><b>Prenume</b></label>
            <BR>
            <input class='input_cls' type="text" name="last_name" placeholder="Prenume" required>

            <BR>
            <label for="CNP"><b>CNP</b></label>
            <BR>
            <input class='input_cls' type="text" name="CNP" placeholder="CNP" required>

            <BR>
            <label for="Specialization"><b>Specializare</b></label>
            <BR>
            <select class='input_cls' name="Specialization" id="Specialization" required>
                <option disabled selected value> -- alege o optiune -- </option>
                <option value="0">Mecanic</option>
                <option value="1">Electrician</option>
                <option value="2">Tinichigiu</option>
            </select>
            <BR>

            <label for="Salary"><b>Salariu</b></label>
            <BR>
            <input class='input_cls' type="text" name="Salary" placeholder="Salariu" required>

            <BR>

            <input class='login_button' type="submit" name="submit" value="Adauga">

        </form>

        <div class='error_message_container'>
            <?php echo $error_message ?>
        </div>
    </div>

</div>
</body>