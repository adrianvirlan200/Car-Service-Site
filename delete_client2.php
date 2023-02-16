<?php include 'header.php' ?>

<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {

    session_start();
    $ClientID = $_SESSION['clientID'];

    $sql = "SELECT * FROM clients WHERE ClientID = '$ClientID'";
    $result = mysqli_query($conn, $sql);
    $client = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (isset($_GET['submit'])) {
        $sql = "DELETE FROM clients WHERE ClientID = '$ClientID'";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        header("Location: main.php");
    }
}


?>
<div class='main_container'>
    <h1>Stergeti client din Baza de date:</h1>
    <p style="float: left;color:brown">
    <div class='div_form'>
        <b style="color:aqua">Clientul selectat:</b><BR>
        Nume: <?php echo $client[0]['First_name'] ?>
        <BR>
        Prenume: <?php echo $client[0]['Last_name'] ?>
        <BR>
        Nr.Telefon: <?php echo $client[0]['Phone_number'] ?>
        <BR>
        Email: <?php echo $client[0]['Email'] ?>
    </div>

    <form action="delete_client2.php" method="get">
        <input type='submit' class='login_button' name='submit' value='Sterge'>
    </form>

</div>
</body>