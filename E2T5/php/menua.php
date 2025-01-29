<?php
session_start();
require 'conexion.php';

$nombre = htmlspecialchars(trim($_POST['erabiltzailea']));
$pasahitza = htmlspecialchars(trim($_POST['pasahitza']));

$sql = "SELECT Erabiltzaile, Pasahitza FROM agentzia WHERE Erabiltzaile = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if ((string)$pasahitza === (string)$user['Pasahitza']) {
        session_regenerate_id(true);
        $_SESSION['Izena'] = $user['Izena'];
        $_SESSION['Logoa'] = $user['Logoa'];
        header("Location: ../html/menu_nagusia.html");
        exit();
    } else {
        echo "<script>
            alert('Pasahitza okerra da. Saiatu berriro.');
            window.location.href = '../index.html';
        </script>";
    }         
} else {
    echo "<script>
        alert('Erabiltzailearen izena ez da existitzen.');
        window.location.href = '../index.html';
    </script>";
}

$conn->close();
?>