<?php

session_start();

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO cart (user_id, amount)
        VALUES (?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("id",
                  $_SESSION['user_id'],
                  $_POST["amount"]);

if ($stmt->execute()) {

    header("Location: checkout.php");
    exit;
    
}

?>