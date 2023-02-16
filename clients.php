<?php include 'header.php' ?>
<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {
    $sql = "SELECT * From clients CL
            JOIN cars CA ON CL.ClientID = CA.ClientID
            JOIN models M ON CA.ModelID = M.ModelID;";
    $result = mysqli_query($conn, $sql);
    $clients = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<div class='main_container'>
    <h1>Clientii si masinile lor:</h1>

    <div class="container_add_works">
        <a href="delete_client.php">Sterge un client</a>
    </div>

    <div class="container_add_works">
        <a href="add_client.php">Adauga client</a>
    </div>

    <table>
        <tr>
            <th>Nume</th>
            <th>Prenume</th>
            <th>Masina</th>
            <th>Numar telefon</th>
            <th>Email</th>
        </tr>

        <?php foreach ($clients as $client) { ?>
            <tr>
                <td><?php echo $client['First_name']; ?></td>
                <td><?php echo $client['Last_name']; ?></td>
                <td><?php echo $client['Producer_name'] . ' ' . $client['Model_name'] . ' ' . $client['Engine']; ?></td>
                <td><?php echo $client['Phone_number']; ?></td>
                <td><?php echo $client['Email']; ?></td>
            </tr>
        <?php
        }
        ?>

</div>
</body>