<?php
session_start();
require 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
    <ul class = "menua">
            <li><a href="#"><p>Hasiera</p></a></li>
            <li><a href="../E2T5/html/gu.html"><p>Gu &copy;</p></a></li>
            <li><a href="../E2T5/html/laguntza.html"><p>Laguntza</p></a></li>
        </ul>
    </nav>
</body>
</html>
<?php


$nombre = htmlspecialchars(trim($_POST['erabiltzailea']));
$pasahitza = htmlspecialchars(trim($_POST['pasahitza']));

$sql = "SELECT Erabiltzaile, Pasahitza FROM agentzia WHERE Erabiltzaile = '$nombre' and pasahitza ='$pasahitza'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
        header("Location: ../html/menu_nagusia.html");
        exit();
       
} else {
    echo "<script>
    setTimeout(() => { 
            alert('Erabiltzailearen izena edo pasahitza ez dira existitzen.');
            window.location.href = '../index.html';
            }, 50);        
        
    </script>";
}

$conn->close();
?>
