<?php

// Datu baserako konexioko parametroak
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "db_e2t5ii"; //datu basearen izena

// Konexioa egin
$conn = new mysqli($servername, $username, $password, $dbname);
// Konexioa egiaztatu
if ($conn->connect_error) {
    die("Fallo en la conexión: " . $conn->connect_error);
}
?>