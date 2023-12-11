<?php

session_start();

$mysqli = require __DIR__ . "/database.php";

$sql = "DELETE FROM cart WHERE user_id = ?";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("i",
                  $_SESSION["user_id"]);

if ($stmt->execute()) {

    header("Location: calendar.html");
    exit;
    
}