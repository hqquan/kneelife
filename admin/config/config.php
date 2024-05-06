<?php
    $mysqli = new mysqli("localhost:3308", "root", "", "kneelife1");

    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
?>