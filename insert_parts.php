<?php include 'header.php' ?>


<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');

$error_message = '';

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {
    $sql = "SELECT ModelID,CONCAT(Producer_name, ' ',Model_name) AS all_data FROM models";
    $result = mysqli_query($conn, $sql);
    $models = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sql = "SELECT PartID, ServiceID, Name FROM parts GROUP BY Name";
    $result = mysqli_query($conn, $sql);
    $parts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (isset($_GET['submit'])) {
        $quantity = $_GET['quantity'];
        $modelID = $_GET['model'];
        $part = $_GET['part'];

        if (!is_numeric($quantity)) {
            $error_message = "Doar numere intregi sunt permise";
        } else if ($quantity <= 0) {
            $error_message = "Numarul de piese trebuie sa fie pozitiv";
        } else {
            $sql = "UPDATE parts SET No_stock = No_stock + $quantity 
                    WHERE Name = '$part' AND ModelID = $modelID";
            $result = mysqli_query($conn, $sql);
            header("Location: stock_parts.php");
        }
        //mysqli_free_result($result);
        mysqli_close($conn);
    }
}
?>

<div class='main_container'>
    <h1>Adauga piese noi: </h1>
    <div class='div_form'>
        <div class='div_form'>
            <form action="insert_parts.php" method="get">
                <label for="model">Alege modelul de masina:</label><BR>
                <select class='input_cls' name=model id=model required>
                    <option disabled selected value> -- Alege o masina -- </option>
                    <?php foreach ($models as $model) : ?>
                        <option value="<?php echo $model['ModelID'] ?>"><?php echo $model['all_data'] ?></option>
                    <?php endforeach; ?>
                </select>

                <BR>
                <label for="service">Alege piesa:</label><BR>
                <select class='input_cls' name=part id=part size="" required>
                    <option disabled selected value> -- Alege piesa -- </option>
                    <?php foreach ($parts as $part) : ?>
                        <option value="<?php echo $part['Name'] ?>"><?php echo $part['Name'] ?></option>
                    <?php endforeach; ?>
                </select>

                <BR>
                <label for="quantity">Cantitate:</label><BR>
                <input class="input_cls" type="text" name=quantity placeholder="Numar bucati" required></text>

                <input type='submit' class='login_button' name='submit' value='Adauga'>

                <div class="error_message_container">
                    <?php echo $error_message ?>
                </div>

            </form>
        </div>
    </div>
</div>
</body>