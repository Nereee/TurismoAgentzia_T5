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
                $sql = "select kodBidMota, desk from bid_mota"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['kodBidMota'] . "'>" . $row['desk'] . "</option>";
                    }
                }
                ?>
        </select><br>
        <div class = "bidaiErregistratu">
            <label for = "hasieraData">Hasiera data:</label>
        </div>
        <input type = "date" id = "hasieraData" name = "hasieraData"  onclick ="gaurkoData()" required><br>
        <div class = "bidaiErregistratu">
            <label for = "amaieraData">Amaiera data:</label>
        </div>
        <input type = "date" id = "amaieraData" name = "amaieraData" onclick ="gaurkoData()" onchange ="egunakKalkulatu()" required><br>
        <div class = "bidaiErregistratu">
            <label for = "egunak">Egunak:</label>
        </div>
        <input type = "number" id = "egunak" name = "egunak" readonly required><br>
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
        <input type = "text"  id="deskribapena" name="deskribapena" rows="4" cols="50" required><br>
        <div class = "bidaiErregistratu">
            <label for = "kanpokoZerbitzuak">Kanpoan geratzen diren zerbitzuak:</label>
        </div>
        <input type = "text" id = "kanpokoZerbitzuak" name = "kanpokoZerbitzuak" required><br>
        <button type="button">GORDE</button>

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
        
    function gaurkoData(){
    let gaur = new Date();
    let urtea = gaur.getFullYear();
    let hilea = String(gaur.getMonth() + 1).padStart(2, '0'); //array batean bezala 0 posiziotik hasten da beraz, +1
    let eguna = String(gaur.getDate()).padStart(2, '0');
    let Minimoa = `${urtea}-${hilea}-${eguna}`;

    document.getElementById("hasieraData").setAttribute("min", Minimoa);
    document.getElementById("amaieraData").setAttribute("min", Minimoa);
            }

    function egunakKalkulatu(){

        let hasieraData = document.getElementById("hasieraData").value;
        let amaieraData = document.getElementById("amaieraData").value;

        if(!hasieraData || !amaieraData){
        alert("Mesedez bete ezazu hutsune guztiak");
        return;
    }

    let diff = new Date(amaieraData) - new Date(hasieraData);
            if (diff < 0) {
                alert("Errorea, amaiera data hasiera data baino handiagoa izan behar da");
                return;
            }

            let egunak = (diff / (1000 * 3600 * 24)); //milisegunduak egunetara bihurtu
            document.getElementById("egunak").value = egunak;
}
    </script>
</body>
</html>