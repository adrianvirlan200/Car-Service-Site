<?php include 'header.php' ?>

<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');

$error_message = '';
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {

    //afiseaza clientii care nu au acum masini in curs de reparatie
    $sql = "SELECT ClientID, CONCAT(First_name,' ',Last_name) AS all_data FROM clients
            Where ClientID NOT IN(
                Select C.ClientID From cars C
                JOIN Works_performed WP ON WP.CarID = C.CarID
                Where WP.Finished = 0);";
    $result = mysqli_query($conn, $sql);
    $clients = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (isset($_GET['submit'])) {
        session_start();

        $_SESSION['clientID'] = $_GET['client'];

        header("Location: delete_client2.php");
        
        mysqli_free_result($result);
        mysqli_close($conn);
    }
}
?>

<div class='main_container'>
    <h1>Stergeti client din Baza de date:</h1>

    <div class = 'div_form'>
        <form action="delete_client.php" method="get">
            <select class='input_cls' name=client id=client required>
                <option disabled selected value> -- Alege un client -- </option>
                <?php foreach ($clients as $client) : ?>
                    <option value="<?php echo $client['ClientID'] ?>"><?php echo $client['all_data'] ?></option>
                <?php endforeach;?>
            </select>
            <BR>
            Daca nu apar clientii aici inseamna ca au masini in curs de reparatie.
            <BR>
            Stergeti reparatiile si apoi stergeti clientul.
            <BR>
            <input type='submit' class='login_button' name='submit' value='Confirma'>
        </form>
    </div>
</div>
</body>