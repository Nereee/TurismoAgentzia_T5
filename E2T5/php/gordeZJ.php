<?php
session_start();
require 'conexion.php';

$jatorri_kod = htmlspecialchars(trim($_POST['jatorrizkoAirep']));
$helmuga_kod = htmlspecialchars(trim($_POST['helmugakoAire']));
$hegaldi_kodea = $_POST['hegaldiKodea'];
$airelinea_joan = htmlspecialchars(trim($_POST['airelineaJ']));
$prezio_joan = htmlspecialchars(trim($_POST['prezioaJoan']));
$irteera_data = $_POST['irteeraDataJoan'];
$irteera_ordua = $_POST['irteeraOrduaJoan'];
$bidai_iraupen = htmlspecialchars(trim($_POST['bidaiIraupena']));
$bidaia= $_SESSION['idBid'];

$conn->query("INSERT INTO zerbitzuak (idBid)
            VALUES ('$bidaia')");

$zerbitzua_id = $conn->insert_id;


$sql = "INSERT INTO hegaldia (idZerb, hegaldi_kodea, prezioa, irteera_data, irteera_ordutegia, bidaiaren_iraupena, kodAirelinea, kodAireportua_jatorria, kodAireportua_helmuga) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($sql);

// s = string, i = integer
$stmt->bind_param("isssissss", $zerbitzua_id, $hegaldi_kodea, $prezio_joan, $irteera_data, $irteera_ordua, $bidai_iraupen, $airelinea_joan, $jatorri_kod, $helmuga_kod);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Datuak datu basean ondo gorde dira.');
                window.location.href = '../index.html';
              </script>";
    } else {
        echo "Errorea datuak datu basean gordetzeko." . $conn->error;
    }
?>