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
            <li>
            <button type = "button" onclick="window.location.href='../index.html'">Irten saiotik</button>
            </li>
        </ul>
    </nav>   
    <div class="form-container">
            <img src="../img/errekamari_logoa.png" alt="logo" class="logo">
<form id = "bidaiakErregistratuOrria" action="gordeBidai.php" method="post">           
        <div class = "bidaiErregistratu">
            <label for = "izena">Izena:</label>
        </div>
            <input type = "text" id = "izena" name = "izena" cols = "20" required><br>
        <div class = "bidaiErregistratu">
            <label for = "bidaiMota">Bidai mota:</label>
        </div>
        <select id = "bidaiMota" name = "bidaiMota">
        <?php
                //DATU BASETIK
                $sql = "select kodBidMota, Desk from bid_mota"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['kodBidMota'] . "'>" . $row['Desk'] . "</option>";
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
            <label for = "herrialdeak">Herrialdea:</label>
        </div>
        <select id = "herrialdeak" name = "herrialdeak">
        <?php
                //DATU BASETIK
                $sql = "select idHerri, izena from herrialdeak"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['idHerri'] . "'>" . $row['izena'] . "</option>";
                    }
                }
                $conn->close();
                ?>
        </select><br>
        <div class = "bidaiErregistratu">
            <label for = "bidaiDeskribapena">Deskribapena:</label>
        </div>
        <input type = "text"  id="deskribapena" name="deskribapena" rows="4" cols="50"><br>
        <div class = "bidaiErregistratu">
            <label for = "kanpokoZerbitzuak">Kanpoan geratzen diren zerbitzuak:</label>
        </div>
        <input type = "text" id = "kanpokoZerbitzuak" name = "kanpokoZerbitzuak"><br>
        <input type = "button" value = "GORDE" onclick ="erakutsiTaula()"><br>
        <input type = "submit" value = "GORDE DB"><br>
        <input type = "button" value = "ATZERA" onclick="window.location.href='../html/menu_nagusia.html'"><br>

    </form>
    </div>
    <table id = "laburpenTaula">
        <caption>Laburpen taula</caption>
        <thead>
            <tr>
                <th>Izena</th>
                <th>Bidai mota</th>
                <th>Hasiera data</th>
                <th>Amaiera data</th>
                <th>Egunak</th>
                <th>Herrialdea</th>
                <th>Deskribapena</th>
                <th>Kanpoko zerbitzuak</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
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

    function erakutsiTaula() {
        let izena=document.getElementById("izena").value.trim();
        let bidaiMota=document.getElementById("bidaiMota").value.trim();
        let hasieraData=document.getElementById("hasieraData").value;
        let amaieraData=document.getElementById("amaieraData").value;
        let egunak=document.getElementById("egunak").value.trim();
        let herrialdea=document.getElementById("herrialdeak").value.trim();
        let deskribapena=document.getElementById("deskribapena").value.trim();
        let kanpokoZerbitzuak=document.getElementById("kanpokoZerbitzuak").value.trim();
    
   let table = document.querySelector("table");
            let tbody = table.querySelector("tbody");

            let lerroa = document.createElement("tr");

            let izenaGelaxka = document.createElement('td');
            izenaGelaxka.textContent = izena;
            lerroa.appendChild(izenaGelaxka);

            let bidaiMotaGelaxka = document.createElement('td');
            bidaiMotaGelaxka.textContent = bidaiMota;
            lerroa.appendChild(bidaiMotaGelaxka);

            let hasieraDataGelaxka = document.createElement('td');
            hasieraDataGelaxka.textContent = hasieraData;
            lerroa.appendChild(hasieraDataGelaxka);

            let amaieraDataGelaxka = document.createElement('td');
            amaieraDataGelaxka.textContent = amaieraData;
            lerroa.appendChild(amaieraDataGelaxka);

            let egunakGelaxka = document.createElement('td');
            egunakGelaxka.textContent = egunak;
            lerroa.appendChild(egunakGelaxka);

            
            let herrialdeaGelaxka = document.createElement('td');
            herrialdeaGelaxka.textContent = herrialdea;
            lerroa.appendChild(herrialdeaGelaxka);
            
            let deskribapenaGelaxka = document.createElement('td');
            deskribapenaGelaxka.textContent = deskribapena;
            lerroa.appendChild(deskribapenaGelaxka);

            let kanpokoZerbitzuakGelaxka = document.createElement('td');
            kanpokoZerbitzuakGelaxka.textContent = kanpokoZerbitzuak;
            lerroa.appendChild(kanpokoZerbitzuakGelaxka);

            tbody.appendChild(lerroa);

            table.style.display = "table";
        }


</script>
</body>
</html>