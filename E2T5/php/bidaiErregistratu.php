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
    <title>Bidaiak erregistratu formularioa</title>
    <link rel="stylesheet" href="../css/style.css">
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
                <a href="../html/gu.html">
                    <p>Gu</p>
                </a>
            </li>
            <li>
                <a href="../html/laguntza.html">
                    <p>Laguntza</p>
                </a>
            </li>
        </ul>
    </nav>   
    <div class="form-container">
            <img src="../img/errekamari_logoa.png" alt="logo" class="logo">
    <form id = "bidaiakErregistratuOrria" name = "bidaiakErregistratuOrria" method = "post">           
        <div class = "bidaiErregistratu">
            <label for = "izena">Izena:</label>
        </div>
            <input type = "text" id = "izena" name = "izena" cols = "20" required><br>
        <div class = "bidaiErregistratu">
            <label for = "bidaiMota">Bidai mota:</label>
        </div>
        <select>
        <?php
                //DATU BASETIK
                $sql = "select kodBidMota from bid_mota"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['kodBidMota'] . "'>" . $row['kodBidMota'] . "</option>";
                    }
                }
                $conn->close();
                ?>
        </select><br>
        <div class = "bidaiErregistratu">
            <label for = "hasieraData">Hasiera data:</label>
        </div>
        <input type = "date" id = "hasieraData" name = "hasieraData" requiered><br>
        <div class = "bidaiErregistratu">
            <label for = "amaieraData">Amaiera data:</label>
        </div>
        <input type = "date" id = "amaieraData" name = "amaieraData" requiered><br>
        <div class = "bidaiErregistratu">
            <label for = "egunak" id = "egunak">Egunak:</label>
        </div>
        <input type = "text" id = "egunak" name = "egunak" requiered><br>
        <div class = "bidaiErregistratu">
            <label for = "herrialdea">Herrialdea:</label>
        </div>
        <select>
        <?php
                //DATU BASETIK
                $sql = "select idHerri from herrialdeak"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['idHerri'] . "'>" . $row['idHerri'] . "</option>";
                    }
                }
                $conn->close();
                ?>
        </select><br>
        <div class = "bidaiErregistratu">
            <label for = "bidaiDeskribapena">Deskribapena:</label>
        </div>
        <input type = "text"  id="deskribapena" name="deskribapena" rows="4" cols="50" requiered><br>
        <div class = "bidaiErregistratu">
            <label for = "kanpokoZerbitzuak">Kanpoan geratzen diren zerbitzuak:</label>
        </div>
        <input type = "text" id = "kanpokoZerbitzuak" name = "kanpokoZerbitzuak" requiered><br>
        <button type="button">GORDE</button>
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
    document.getElementById('bidaiakErregistratuOrria').addEventListener('submit', function(event) {
        event.preventDefault(); 
    
        let hasieraData = new Date(document.getElementById('hasiera-data').value);
        let amaieraData = new Date(document.getElementById('amaiera-data').value);
        let errorMezua = document.getElementById('errorMezua');
    
        if (amaieraData <= hasieraData) {
            errorMezua.textContent = "Amaiera data ezin da hasiera datatik beranduago izan.";
            return; // no va a seguir para adelante
        }
    
        let diffTime = amaieraData - hasieraData;
        let diffDays = diffTime / (1000 * 3600 * 24); // milisegundos para calcular los días
        console.log("Egun kopurua: ${diffDays} egun");
    
        if (diffDays > 0) {
            alert("Datuak ondo gorde dira. Itzultzen zara menu nagusira.");
            window.location.href = "menu_nagusia.html"; 
        } else {
            alert("Datuak ez dira ondo gorde. Saiatu berriro.");
        }
    });
    </script>
</body>
</html>