<?php
session_start();
require 'conexion.php';

$izena = htmlspecialchars(trim($_POST['izenaB']));
$data = htmlspecialchars(trim($_POST['dataB']));
$deskribapena = htmlspecialchars(trim($_POST['deskribapenaB']));
$prezioa = htmlspecialchars(trim($_POST['prezioaBesteak']));

if(!isset($_SESSION['idBid'])){
    echo "<script>
    alert('Mesedez lehenego bidaiaren formularion erregistratu');
    window.location.href = 'bidaiErregistratu.php';
  </script>";
}

$bidaia= $_SESSION['idBid'];

$conn->query("INSERT INTO zerbitzuak (idBid)
            VALUES ('$bidaia')");

$zerbitzua_id = $conn->insert_id;


$sql = "INSERT INTO ostatua (idZerb, izena, datak, desk, prezioa) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($sql);

// s = string
$stmt->bind_param("issdss", $zerbitzua_id, $izena, $data, $deskribapena, $prezioa);

    if ($stmt->execute()) {
        echo "<script>
                alert('Datuak datu basean ondo gorde dira.');
                window.location.href = '../index.html';
              </script>";
    } else {
        echo "Errorea datuak datu basean gordetzeko." . $conn->error;
    }

$stmt->close();
$conn->close();
?>