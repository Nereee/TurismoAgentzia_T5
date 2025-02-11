<?php
session_start();
require 'conexion.php';

$izen = htmlspecialchars(trim($_POST['izena']));
$bidaiaMota = htmlspecialchars(trim($_POST['bidaiMota']));
$hasieraData = htmlspecialchars(trim($_POST['hasieraData']));
$amaieraData = htmlspecialchars(trim($_POST['amaieraData']));
$herrialdea = htmlspecialchars(trim($_POST['herrialdeak']));
$deskribapena = htmlspecialchars(trim($_POST['deskribapena']));



$sql = "INSERT INTO bidaia (izena, desk, hasieeraData, amaieraData, idAgen, kodBidMota, idHerri) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";


$stmt = $conn->prepare($sql);
// s = string, i = integer
$stmt->bind_param("ssssiss", $izen, $deskribapena, $hasieraData, $amaieraData, $agentzia_id, $bidaiaMota, $herrialdea,);

if ($stmt->execute()) {
    $_SESSION['idBid'] = $conn->insert_id;

    echo "<script>
            alert('Datuak ondo gorde dira');
            window.location.href = '../index.html';
          </script>";
} else {
    echo "Errorea datuak gordetzeko " . $conn->error;
}


$stmt->close();
$conn->close();
?>