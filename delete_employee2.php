<?php include 'header.php' ?>

<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');
$error_message = '';

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {

    session_start();
    $employee_id = $_SESSION['employee_id'];
    $is_free = $_SESSION['is_free'];


    $sql = "SELECT * FROM employees WHERE EmployeeID = '$employee_id'";
    $result = mysqli_query($conn, $sql);
    $employee = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (isset($_GET['submit'])) {
        $sql = "DELETE FROM employees WHERE EmployeeID = '$employee_id'";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        header("Location: main.php");
    }
}


?>
<div class='main_container'>
    <h1>Stergeti angajat din Baza de date:</h1>
    <div class='div_form'>
        <b style="color:aqua">Angajatul a fost gasit:</b><BR>
        Nume: <?php echo $employee[0]['First_name'] ?>
        <BR>
        Prenume: <?php echo $employee[0]['Last_name'] ?>
        <BR>
        CNP: <?php echo $employee[0]['CNP'] ?>
        <BR>
        Data angajare: <?php echo $employee[0]['Employment date'] ?>
        <BR>
        Salariu: <?php echo $employee[0]['Salary'] ?>
        <BR>
    </div>

    <?php if ($is_free == 1) { ?>
        <form action="delete_employee2.php" method="get">
            <input type='submit' class='login_button' name='submit' value='Sterge'>
        </form>
    <?php } else { ?>
        Angajatul nu poate fi sters deoarece este ocupat.
    <?php } ?>
    <div class="error_message_container">
        <p class="error_message"><?php echo $error_message ?></p>
    </div>

</div>
</body>