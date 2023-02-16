<?php include 'header.php' ?>


<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {
    $sql = "SELECT First_name, Last_name, Sum(S.Cost) as sum From employees E
            JOIN works_performed WP on WP.EmployeeID = E.EmployeeID
            JOIN services S on S.ServiceID = WP.ServiceID
            WHERE WP.Finished = 1 AND MONTH(WP.Date_started) = MONTH(CURRENT_DATE())
            GROUP BY E.EmployeeID, First_name, Last_name
            ORDER BY SUM(S.Cost) DESC
            Limit 1;";
    $result = mysqli_query($conn, $sql);
    $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sql = 'SELECT First_name, Last_name,SUM(WP.Duration)-100 as extra From employees E
            JOIN works_performed WP on WP.EmployeeID = E.EmployeeID
            WHERE MONTH(WP.Date_started) = MONTH(CURRENT_DATE())
            GROUP BY E.EmployeeID, First_name, Last_name
            Having SUM(WP.Duration) > 100;';
    $result = mysqli_query($conn, $sql);
    $employees2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>


<div class='main_container'>
    <h1>Distinctiile lunare: </h1>
    <div class='div_form'>
    Angajatul lunii este:<BR>
    <?php echo $employees[0]['First_name'] . ' ' . $employees[0]['Last_name']  . ' care a produs firmei '. $employees[0]['sum'] . 'lei in aceasta luna'?>
    <BR>
    Mentiuni onorabile:
    <?php foreach($employees2 as $employees)?>
    <BR>
    <?php echo $employees['First_name'] . ' ' . $employees['Last_name']  . ' care a lucrat in plus ' . $employees['extra'] . ' ore in aceasta luna'?>
    </div>

</div>
</body>