<?php
$conn = mysqli_connect('localhost', 'car_service_admin', '1234', 'service');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
} else {
    echo 'Connected to DB' . '<BR>';
}

$sql = 'Select username, password From admins';
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

$error_message = '';


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    foreach ($users as $user)
        if ($user['username'] == $username && $user['password'] == $password) {
            header("Location: main.php");
            $error_message = 'Logged in successfully';
        } else {
            $error_message = 'Wrong username or password';
        }

    mysqli_free_result($result);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>

<head>
    <title>Vericu' tunning</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form class = "login_form" action="index.php" method="POST">
        <div class="img_container">
            <img src="images/img2.png" alt="photo1">
        </div>
        
        <label style="color:aliceblue" for="username"><b>Username</b></label>
        <input type="text" class="input_cls" name="username" placeholder="Enter username" required/>
        
        <label style="color:aliceblue" for="password"><b>Password</b></label>
        <input type="password" class="input_cls" name="password" placeholder="Enter password" required>
        
        <button class = "login_button" type="submit" name="submit">Login</button>
        
        <div class="error_message_container"">
            <?php echo $error_message; ?>
        </div>
    </form>

</body>