<?php
    include("setup.php");

    if (!isset($_SESSION["username"])) {
        header("Location: /php-login-form/login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset | PHP Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
        <div class="text" style="font-size: 25px;">Password Reset</div><br>
        <label for="existing-password">Current password:</label>
        <input type="password" name="existing-password" id="existing-password" required>
        <label for="new-password">New password:</label>
        <input type="password" name="new-password" id="new-password" required>
        <input type="submit" value="Submit">
    </form>
    <a href="dashboard.php" class="form-submit">Back</a><br>
</body>
</html>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["existing-password"])) {
        $username = $_SESSION["username"];
        $existingPassword = $_POST["existing-password"];
        $newPassword = $_POST["new-password"];
        
        $sql = "UPDATE users SET password = '$newPassword' WHERE username = '$username' AND password = '$existingPassword'";
        
        if (!mysqli_query($con, $sql)) {
            echo output("Error executing SQL query: " . mysqli_error($con));
            die();
        }
        
        $numRows = mysqli_affected_rows($con);
        if ($numRows == 0) {
            echo output("Incorrect existing password.");
            die();
        }
        
        echo output("Password changed successfully.", false);
    }

    mysqli_close($con);
?>