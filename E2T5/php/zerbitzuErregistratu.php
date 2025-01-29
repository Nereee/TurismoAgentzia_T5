<?php
// conexion.php fitxategia ireki
require '../php/conexion.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zerbitzuak erregistratu</title>
    <link rel="stylesheet" href="../css/style.css" >
</head>
<body>
<nav>
        <ul>
            <li>
                <a href="../index.html">
                <p>Hasiera</p>
                </a>
            </li>
            <li>
                <a href="../documents/gu.html">
                    <p>Gu</p>
                </a>
            </li>
            <li>
                <a href="../documents/laguntza.html">
                    <p>Laguntza</p>
                </a>
            </li>
        </ul>
    </nav>  
    <div class="form-container">
            <img src="../img/errekamari_logoa.png" alt="logo" class="logo"> 
    <form id = "zerbitzuakErregistratuOrria" name = "zerbitzuakErregistratuOrria" method = "post">           
        <div class = "zerbitzuErregistratu">
            <label for = "aukera">Aukeratu bidaia:</label><br>
        </div>
            <select>
            <?php
                //DATU BASETIK
                $sql = "select Erabiltzaile from agentzia"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Erabiltzaile'] . "'>" . $row['Erabiltzaile'] . "</option>";
                    }
                }
                $conn->close();
                ?>
            </select><br>
        <div class = "zerbitzuErregistratu">
            <label for = "zerbitzuMota">Zein zerbitzu erregistratu behar duzu?</label>
        </div>
            <input type = "radio" name = "zerbitzuMota" value = "hegaldia">Hegaldia<br>
            <input type = "radio" name = "zerbitzuMota" value = "ostatua">Ostatua<br>
            <input type = "radio" name = "zerbitzuMota" value = "besteBatzuk">Beste batzuk<br><br>
            <input type = "submit" value = "GORDE">
            <p id="errorMezua" style="color:white;"></p>
    </form>
    </div>
    <footer>
        <p>&copy; 2025 Errekamari Bidaiak. Eskubide guztiak erreserbatuta.</p>
        <p>
            <a href="#">Política de privacidad</a> |
            <a href="#">Términos de servicio</a> |
        </p>
    </footer>
    <script>
        document.getElementById('zerbitzuakErregistratuOrria').addEventListener('submit', function(event) {
    event.preventDefault();

    let bidaia = document.getElementById('bidaia').value;
    let zerbitzua = document.getElementById('zerbitzua').value;
    let errorMezua = document.getElementById('errorMezua').value;

    if (bidaia === "" || zerbitzua === "") {
        document.getElementById('errorMezua').textContent = "Bidaia eta zerbitzuak aukeratu behar dira.";
        return;
    }

    alert("Zerbitzua ondo erregistratu da.");
    window.location.href = "../E2T5/html/menu_nagusia.html"; 
});
    </script>
</body>
</html>