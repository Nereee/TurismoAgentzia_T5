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
        <div>
        <input type = "radio" name = "hegaldiaRadio" value = "hegaldiaRadio" onclick = "formularioaErakutsi()">Hegaldia<br>
        </div>
        <div>
        <input type = "radio" name = "ostatuRadio" value = "ostatuRadio" onclick = "formularioaErakutsi()">Ostatua<br>
        </div>
        <div>
        <input type = "radio" name = "besteakRadio" value = "besteakRadio" onclick = "formularioaErakutsi()">Beste batzuk<br><br>
        </div> 
        <input type = "submit" value = "GORDE">

        <form id = formHegaldiJoan>
        <div id="hegaldia" class="zerbitzuMota">
            <label for="hegaldiMota">Zein hegaldi mota da?</label>
        </div>
        <input type="radio" id="joanRadio" name="joanRadio">Joan<br>
        <input type="radio" value="joanEtorriRadio" name = "joanEtorriRadio">Joan / Etorri<br>
        <div id="hegaldia" class="zerbitzuMota">
            <label for = "jatorrizkoAero">
        </div>
            <select>
            <?php
                //DATU BASETIK
                $sql = "select kodAireportua from aireportua"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['kodAireportua'] . "'>" . $row['kodAireportua'] . "</option>";
                    }
                }
                ?>
            </select>
        <div id="hegaldia" class="zerbitzuMota">
            <label for = "helmugakoAero">
        </div>
            <select>
            <?php
                //DATU BASETIK
                $sql = "select kodAireportua from joan_etorri"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['kodAireportua'] . "'>" . $row['kodAireportua'] . "</option>";
                    }
                }
                ?>
            </select>
            <div id="hegaldia" class="zerbitzuMota">
                <label for = "hegaldiKodea">
            </div>
                <input type = "text" id = "hegaldiKodea" name = "hegaldiKodea" required>
            <div id="hegaldia" class="zerbitzuMota">
                <label for = "airelinea">Airelinea:<br>
            </div>
            <select>
            <?php
                //DATU BASETIK
                $sql = "select kodAirelinea from airelineak"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['kodAirelinea'] . "'>" . $row['kodAirelinea'] . "</option>";
                    }
                }
                ?>
            </select>
            <div id="hegaldia" class="zerbitzuMota">
                <label for = "prezioa">
            </div>
            <input type = "text" id = "prezioa" name = "prezioa">Prezioa (€)<br>
            <div id="hegaldia" class="zerbitzuMota">
                <label for = "irteeraData">Irteera data:<br>
            </div>
            <input type = "date" id = "irteeraData" name = "irteeraData" required><br>
            <div id="hegaldia" class="zerbitzuMota">
                <label for = "irteeraOrdua">
            </div>
            <input type = "time" id = "irteeraOrdua" name = "irteeraOrdua" required><br>
            <div id="hegaldia" class="zerbitzuMota">
                <label for = "bidaiarenIraupena">Bidaiaren iraupena (orduak)<br>
            </div>
            <input type = "text" id = "bidaiarenIraupena" name = "bidaiarenIraupena" required><br>
        </form>
    </div>
    </form>
    </div>

    <form id = "formHegaldiJoanEtorri" style = "display: none;">
        <h1>Hegaldia (etorria)</h1>
        <div id = "hegaldia" class = "hegaldiaEtorria">
            <label for = "itzuleraData">Itzulera data:<br>
        </div>
        <input type = "date" id = "itzuleraData" name = "itzuleraData" required><br>
        <div id = "hegaldia" class = "hegaldiaEtorria">
            <label for = "itzuleraOrdua">Itzulera ordua:<br>
        </div>
        <input type = "time" id = "itzuleraOrdua" name = "itzuleraOrdua" required><br>
        <div id = "hegaldia" class = "hegaldiaEtorria">
            <label for = "bueltakoIraupena">Bueltako Bidaiaren Iraupena (orduetan)<br>
        </div>
        <input type = "text" id = "bueltakoIraupena" name = "bueltakoIraupena" required><br>
        <div id = "hegaldia" class = "hegaldiaEtorria">
            <label for = "bueltakoKodea">Bueltako Hegaldi Kodea:<br>
        </div>
        <input type = "text" id = "bueltakoKodea" name = "bueltakoKodea" required><br>
        <div id = "hegaldia" class = "hegaldiaEtorria">
            <label for = "bueltakoAirelinea">Bueltako Airelinea:<br>
        </div>
        <select>
            <?php
                //DATU BASETIK
                $sql = "select kodAirelinea from joan_etorri"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['kodAirelinea'] . "'>" . $row['kodAirelinea'] . "</option>";
                    }
                }
                ?>
            </select>
    </form>

    <form id = formOstatu>
        <div id = "ostatua" class = "ostatuaAukera">
            <label for = "hotelarenIzena">Hotelaren izena:<br>
        </div>
        <input type = "text" id = "hotelarenIzena" name = "hotelarenIzena" required><br>
        <div id = "ostatua" class = "ostatuaAukera">
            <label for = "hiriaOstatu"> Hiria:<br>
        </div>
        <input type = "text" id = "hiriaOstatu" name = "hiriaOstatu" required><br>
        <div id = "ostatu" class = "ostatuaAukera">
            <label for = "prezioaOstatu">Prezioa (€):<br>
        </div>
        <input type = "text" id = "prezioaOstatu" name = "prezioaOstatu" required><br>
        <div id = "ostatua" class = "ostatuaAukera">
            <label for = "sarreraEguna">Sarrera eguna:<br>
        </div>
        <input type = "date" id = "sarreraEguna" name = "sarreraEguna" required><br>
        <div id = "ostatu" class = "ostatuaAukera">
            <label for = "irteeraEguna">Irteera eguna:<br>
        </div>
        <input type = "date" id = "irteeraEguna" name = "irteeraEguna" required><br>
        <div id = "ostatua" class = "ostatuaAukera">
            <label for = "logelaMota">Logela mota:<br>
        </div>
        <select>
            <?php
                //DATU BASETIK
                $sql = "select kodLogMota from logela_mota"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['kodLogMota'] . "'>" . $row['kodLogMota'] . "</option>";
                    }
                }
                $conn->close();
                ?>
        </select>
    </form>

    <form id = "formBesteak">
        <div id = "besteak" class = "besteakAukera">
            <label for = "izena">Izena:<br>
        </div>
        <input type = "text" id = "izena" name = "izena" required><br>
        <div id = "besteak" class = "besteakAukera">
            <label for = "data">Data:<br>
        </div>
        <input type = "date" id = "data" name = "data" required><br>
        <div id = "besteak" class = "besteakAukera">
            <label for = "deskribapena">Deskribapena:<br>
        </div>
        <input type = "text" id = "deskribapena" name = "deskribapena" rows="4" cols="50" required><br>
        <div id = "besteak" class = "besteakAukera">
            <label for = "prezioaBesteak">Prezioa (€):<br>
        </div>
        <input type = "text" id = "prezioaBesteak" name = "prezioaBesteak" required><br>
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

    if (bidaia === "" || zerbitzua === "") {
        alert("Bidaia eta zerbitzuak aukeratu behar dira.");
        return;
    }

    alert("Zerbitzua ondo erregistratu da.");
    window.location.href = "../E2T5/html/menu_nagusia.html"; 
});
    function formularioaErakutsi() {
            var radioButton = document.getElementById("opcion1");
            var form = document.getElementById("formularioAdicional");
            
            // Si el radio button está seleccionado, mostrar el formulario adicional
            if (radioButton.checked) {
                formularioAdicional.style.display = "block";
            } else {
                formularioAdicional.style.display = "none";
            }
        }
    </script>
</body>
</html>
