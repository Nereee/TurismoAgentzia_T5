<?php
session_start();
require 'conexion.php';

$hotelaren_izena = htmlspecialchars(trim($_POST['hotelarenIzena']));
$hiria = htmlspecialchars(trim($_POST['hiriaOstatu']));
$prezioa_o = htmlspecialchars(trim($_POST['prezioaOstatu']));
$sarrera_eguna = htmlspecialchars(trim($_POST['sarreraEguna']));
$irteera_eguna = htmlspecialchars(trim($_POST['irteeraEguna']));
$logela_mota = htmlspecialchars(trim($_POST['logelaMotaO']));
$bidaia= $_SESSION['idBid'];

$conn->query("INSERT INTO zerbitzuak (idBid)
            VALUES ('$bidaia')");

$zerbitzua_id = $conn->insert_id;


$sql = "INSERT INTO ostatua (idZerb, hotelaren_izena, hiria, prezioa, sarrera_eguna, irteera_eguna, kodLogMota) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($sql);
//konprobatzen du bariable guztiak null-ean ez egotea

// s = string
$stmt->bind_param("isssss", $zerbitzua_id, $hotelaren_izena, $hiria, $sarrera_eguna, $irteera_eguna, $logela_mota);

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