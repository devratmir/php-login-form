<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PHP Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Login"><br>
    </form>
    <div class="text">Don't have an account?</div>
    <a href="register.php" class="form-submit">Register </a>
</body>
</html>

<?php

include("setup.php");

$_SESSION["logged"] = false;
$_SESSION["username"] = null;

$users = null;


$sql = "SELECT username, password FROM users";
$result = mysqli_query($con, $sql);

if ($result) {
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
else {
    echo output("Error executing SQL query: " . mysqli_error($con));
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Make sure username and password are not empty
    if (empty($username) || empty($password)) {
        echo output("Username or password cannot be empty");
        return;
    }

    
    foreach ($users as $user) {
        if ($user["username"] == $username) {
            if ($user["password"] == $password) {
                $_SESSION["username"] = $username;
                $_SESSION["logged"] = true;
                sleep(0.5);
                header("Location: /php-login-form/index.php");
                break;
            }

            else {
                echo output("Please check your password");
                die();
            }
        }
    }

    echo output("User does not exist.");
    die();
}

mysqli_close($con);

?>