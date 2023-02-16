<?php include 'header.php' ?>

<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');

$error_message = '';
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {
    if (isset($_GET['submit'])) {
        session_start();

        $first_name = $_GET['fname'];
        $last_name = $_GET['lname'];
        $CNP = $_GET['cnp'];

        $sql = "SELECT * FROM employees WHERE First_name = '$first_name' AND Last_name = '$last_name' AND CNP = '$CNP'";
        $result = mysqli_query($conn, $sql);
        $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);

        if (count($employees) == 0) {
            $error_message = 'Angajatul nu a fost gasit';
        } else {
            $_SESSION["employee_id"] = $employees[0]["EmployeeID"];
            $_SESSION["is_free"] = $employees[0]["Is_free"];

            header("Location: delete_employee2.php");
        }
    }
}

?>

<div class='main_container'>
    <h1>Stergeti angajat din Baza de date:</h1>

    <div class='div_form'>
        <form action="delete_employee.php" method="get">
            <label for="name">Nume Angajat</label>
            <BR>
            <input class='input_cls' type="text" name="fname" placeholder="Nume angajat" required>

            <BR>
            <label for="name">Prenume Angajat</label>
            <BR>
            <input class='input_cls' type="text" name="lname" placeholder="Prenume angajat" required>

            <BR>
            <label for="name">CNP</label>
            <BR>
            <input class='input_cls' type="text" name="cnp" placeholder="CNP" required>

            <BR>
            <input type='submit' class='login_button' name='submit' value='Cauta'>
        </form>
        
        <div class="error_message_container">
            <p class="error_message"><?php echo $error_message ?></p>
        </div>

    </div>
</div>
</body>