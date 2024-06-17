<?php

include("setup.php");

if (!$_SESSION["logged"]) {
    header("Location: /php-login-form/login.php");
    die();
}

else {
    header("Location: /php-login-form/dashboard.php");
    die();
}

mysqli_close($con);

?>