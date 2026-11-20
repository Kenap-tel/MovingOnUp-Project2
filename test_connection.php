<?php
include 'db_connect.php';

echo "Database: ";

$result = $conn->query("SELECT DATABASE()");
$row = $result->fetch_row();

echo $row[0] . "<br>";

$clientID = 1001;

$stmt = $conn->prepare(
    "SELECT ClientID FROM clients WHERE ClientID = ?"
);

$stmt->bind_param("i", $clientID);
$stmt->execute();
$stmt->store_result();

echo "Client ID: " . $clientID . "<br>";

if ($stmt->num_rows > 0) {
    echo "Client exists!";
} else {
    echo "Client does not exist!";
}

$stmt->close();
$conn->close();
?>