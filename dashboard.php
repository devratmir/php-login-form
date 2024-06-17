<?php include("setup.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | PHP Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    if (isset($_SESSION['username'])) {
        echo "<div class='text' style='font-size: 30px; font-weight: bold;'>Welcome, {$_SESSION['username']}!</div>";
    }

    else {
        header("Location: /php-login-form/login.php");
    }
    ?>
    <form action="dashboard.php" method="post">
        <input type="submit" value="Logout">
    </form>
    <form action="remove-account.php" method="post">
        <input type="submit" value="Delete account">
    </form>
    <form action="password-reset.php" method="post">
        <input type="submit" value="Change my password">
    </form>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_destroy();
        header("Location: /php-login-form/login.php");
    }
?>