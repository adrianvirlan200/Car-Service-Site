<?php include 'header.php' ?>

<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {
    $sql = "SELECT S.Name AS Service_name,P.Name,P.No_stock, P.No_lot,M.Producer_name,M.Model_name,S.Cost FROM parts P
            JOIN models M ON M.ModelID = P.ModelID
            JOIN services S ON S.ServiceID = P.ServiceID
            ORDER BY M.Producer_name, M.Model_name, S.Name;";
    $result = mysqli_query($conn, $sql);
    $parts = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<div class='main_container'>
    <h1>Piesele disponibile in depozit:</h1>
    <div class="container_add_works">
        <a href="insert_parts.php">Reactualizeaza stocul</a>
    </div>
    <table>
        <tr>
            <th>Masina</th>
            <th>Nume serviciu</th>
            <th>Nume Piesa</th>
            <th>Stoc</th>
            <th>Numar lot</th>
            <th>Pret</th>
        </tr>

        <?php foreach ($parts as $part) { ?>
            <tr>

                <?php
                $color = '';
                if ($part['No_stock'] < 10) {
                    $color = 'red';
                } else {
                    $color = 'green';
                }
                ?>

                <td><?php echo $part['Producer_name'] . ' ' . $part['Model_name']; ?></td>
                <td><?php echo $part['Service_name']; ?></td>
                <td><?php echo $part['Name']; ?></td>
                <td style="color:<?php echo $color ?>"><?php echo $part['No_stock']; ?></td>
                <td><?php echo $part['No_lot']; ?></td>
                <td><?php echo $part['Cost']; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>

</div>

</div>
</body>