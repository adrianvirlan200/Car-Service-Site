<?php include 'header.php' ?>


<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {
    $sql = "SELECT E.*, Count(WP.WorkID) as no,Sum(S.Cost) as price FROM employees E
            LEFT JOIN works_performed WP ON WP.EmployeeID = E.EmployeeID
            LEFT JOIN Services S ON S.ServiceID = WP.ServiceID
            GROUP BY E.EmployeeID
            ORDER BY Count(WP.WorkID) DESC;";
    $result = mysqli_query($conn, $sql);
    $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<div class='main_container'>
    <h1>Toti angajatii:</h1>

    <div class="container_add_works">
        <a href="delete_employee.php">Stergeti un angajat</a>
    </div>

    <div class="container_add_works">
        <a href="add_employee.php">Adauga angajat</a>
    </div>

    <table>
        <tr>
            <th>Nume</th>
            <th>Prenume</th>
            <th>CNP</th>
            <th>Specializare</th>
            <th>Data angajare</th>
            <th>Salariu</th>
            <th>Numar de lucrari</th>
            <th>Bani castigati</th>
        </tr>

        <?php foreach ($employees as $employee) { ?>
            <tr>
                <td><?php echo $employee['First_name']; ?></td>
                <td><?php echo $employee['Last_name']; ?></td>
                <td><?php echo $employee['CNP']; ?></td>
                <td><?php echo $employee['Specialization']; ?></td>
                <td><?php echo $employee['Employment date']; ?></td>
                <td><?php echo $employee['Salary']; ?></td>
                <td><?php echo $employee['no']; ?></td>
                <td><?php echo ($employee['price'] == ''?'0':$employee['price']); ?></td>
            </tr>
        <?php
        }
        ?>

</div>
</body>