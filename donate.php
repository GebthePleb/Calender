<?php
session_start();

if (!(is_numeric($_POST["card"])) || !(strlen($_POST['card']) == 16)) {
        die("Card number invalid");
    }
$mysqli = require __DIR__ . "/database.php";

$stmt1 = $mysqli->prepare('SELECT * FROM cart WHERE user_id=?');
$stmt1->bind_param('s', $_SESSION['user_id']);
$stmt1->execute();
$amount = 0;
$result = $stmt1->get_result();
foreach ($result as $row) {
    $amount = $amount + $row['amount'];
}

$sql = "INSERT INTO donation (user_id, amount, tax, card, address)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$taxes = $amount * 0.04225;
$stmt->bind_param("iddss",
            $_SESSION['user_id'],
            $amount,
            $taxes,
            $_POST['card'],
            $_POST['address']);

$stmt->execute();

$query = "DELETE FROM cart WHERE user_id = ?";

$stmt2 = $mysqli->stmt_init();

if ( ! $stmt2->prepare($query)) {
    die("SQL error: " . $mysqli->error);
}

$stmt2->bind_param("i",
                  $_SESSION["user_id"]);

if ($stmt2->execute()) {

    header("Location: calendar.html");
    exit;
    
}