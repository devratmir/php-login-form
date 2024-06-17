<?php
include("setup.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | PHP Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Register"><br>
    </form>

    <div class="text" style="font-size: 13px;">(After account creation, please log in.)</div>
    <div class="text">Already have an account?</div>
    <a href="login.php" class="form-submit">Login</a>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $newUser = array(
            "username" => $username,
            "password" => $password
        );


        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        
        if (!mysqli_query($con, $sql)) {
            echo output("Error executing SQL query: " . mysqli_error($con));
            die();
        }
        
        header("Location: /php-login-form/login.php");
    }

    mysqli_close($con);
?>