<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skladiste";

// Kreiranje konekcije
$conn = new mysqli($servername, $username, $password, $dbname);

// Provjera konekcije
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>