<?php
session_start();
require 'conexion.php';

$itzulera_data = htmlspecialchars(trim($_POST['itzuleraData']));
$itzulera_ordua = htmlspecialchars(trim($_POST['itzuleraOrdua']));
$bueltako_iraupenaJE = $_POST['bueltaIraupena'];
$bueltako_kodeaJE = htmlspecialchars(trim($_POST['bueltaHKod']));
$bueltako_airelineaJE = htmlspecialchars(trim($_POST['airelineaJE']));
$bidaia= $_SESSION['idBid'];

$conn->query("INSERT INTO zerbitzuak (idBid)
            VALUES ('$bidaia')");

$zerbitzua_id = $conn->insert_id;


$sql = "INSERT INTO hegaldia (idZerb, hegaldi_kodea, prezioa, irteera_data, irteera_ordutegia, bidaiaren_iraupena, kodAirelinea, kodAireportua_jatorria, kodAireportua_helmuga) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($sql);

// s = string, i = integer
$stmt->bind_param("sssisssss", $zerbitzua_id, $bueltako_kodeaJE, $prezio_joan, $itzulera_data, $itzulera_ordua, $bueltako_iraupenaJE, $bueltako_airelineaJE, $jatorri_kod, $helmuga_kod);

    if ($stmt->execute()) {
        echo "<script>
                alert('Datuak datu basean ondo gorde dira.');
                window.location.href = '../index.html';
              </script>";
    } else {
        echo "Errorea datuak datu basean gordetzeko." . $conn->error;
    }
?>