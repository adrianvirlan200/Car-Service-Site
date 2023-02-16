<?php include 'header.php' ?>

<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {
    $sql = "SELECT S.Name as Name,
            CONCAT(E.First_Name,' ',E.Last_name) AS employee_full,
            WP.Date_started, WP.Duration,
            CONCAT(M.Producer_name,' ' ,M.Model_name) AS car_full,
            CONCAT(CL.First_name ,' ', CL.Last_name) as client_full,
            S.Cost + (Select Sum(price) from parts P where P.ServiceID = S.ServiceID And CA.ModelID = P.ModelID) as total_cost 
            FROM works_performed WP
            JOIN services S on S.ServiceID = WP.ServiceID
            LEFT JOIN employees E ON E.EmployeeID = WP.EmployeeID
            LEFT JOIN cars CA ON CA.CarID = WP.CarID
            LEFT JOIN clients CL ON CL.ClientID = CA.ClientID
            LEFT JOIN models M on M.ModelID = CA.ModelID
            WHERE WP.Finished = 1
            ORDER BY WP.Date_started DESC;";
    $result = mysqli_query($conn, $sql);
    $works = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $sql = 'SELECT COUNT(*) FROM `works_performed`
            WHERE Finished = 1;';
    $result = mysqli_query($conn, $sql);
    $number_of_works = mysqli_fetch_array($result);
}
?>

<div class='main_container'>
    <h1>Total inregistrari: <?php echo $number_of_works[0] ?></h1>
    <table class="main_table">
        <tr>
            <th>Nume Serviciu</th>
            <th>Nume si Prenume angajat</th>
            <th>Data inceperii</th>
            <th>Durata(ore)</th>
            <th>Nume si Prenume Client</th>
            <th>Masina</th>
            <th>Cost total</th>
        </tr>

        <?php // LOOP TILL END OF DATA
        foreach ($works as $work) {
        ?>
            <tr>
                <!--FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN-->
                <td><?php echo $work['Name'] ?></td>
                <td><?php echo ($work['employee_full'] == ''? '----':$work['employee_full'])?></td>
                <td><?php echo $work['Date_started']; ?></td>
                <td><?php echo $work['Duration']; ?></td>
                <td><?php echo ($work['client_full']==''?'----': $work['client_full']); ?></td>
                <td><?php echo ($work['car_full']==''?'---':$work['car_full']); ?></td>
                <td><?php echo $work['total_cost']; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
</body>