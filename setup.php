<?php

session_start();

function output($message, $error=true) {
    if ($error) {
        return "<div class='php-error'>$message</div><br>";
    }
    else {
        return "<div class='php-output'>$message</div><br>";
    }
}

$json_file = "users.json";

$con = mysqli_connect("localhost", "root", "", "phploginformdb");

if (!$con) {
    die(output("MySQL connection failed: " . mysqli_connect_error()));
}



?>