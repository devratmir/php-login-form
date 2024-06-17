<?php
include("setup.php");
$username = $_SESSION['username'];

if (empty($username)) {
    header("Location: /php-login-form/login.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Deletion | PHP Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="password">Enter your password for confirmation:</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Delete Account">
    </form>
    <a href="dashboard.php" class="form-submit">Back</a>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
    $password = $_POST['password'];
    $username = $_SESSION["username"];
    
    
    $sql = "DELETE FROM users WHERE username = '$username' AND password = '$password'";
    
    if (!mysqli_query($con, $sql)) {
        if (mysqli_errno($con) == 1062) {
            echo output("Wrong password.");
        }
        elseif (mysqli_errno($con) == 1064) {
            echo output("Wrong username or password.");
        }
        else {
            echo output("Error executing SQL query: " . mysqli_error($con));
        }
        die();
    }
    
    $numRows = mysqli_affected_rows($con);
    if ($numRows == 0) {
        echo output("User does not exist.");
        die();
    }

    session_destroy();
    header("Location: /php-login-form/login.php");
    die();
}

mysqli_close($con);
?>