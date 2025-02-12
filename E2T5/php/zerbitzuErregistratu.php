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
        <ul class = "menua">
            <li>
                <a href="../index.html">
                <p>Hasiera</p>
                </a>
            </li>
            <li>
                <a href="../html/gu.html">
                    <p>Gu &copy;</p>
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
    <form id = "zerbitzuakErregistratuOrria" method="post" action="#" style = "margin-top: 190px;">           
        <div class = "zerbitzuErregistratu">
            <label for = "aukera">Aukeratu bidaia:</label><br>
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
            </select>
        <div class = "zerbitzuErregistratu">
            <label for = "zerbitzuMota">Zein zerbitzu erregistratu behar duzu?</label><br><br>
        </div>
        <div class="radio-buttons">
        <input type="radio" id="hegaldiaRadio" name="zerbitzuMota" value="hegaldiaRadio" onclick="formularioaErakutsi()"> Hegaldia
        <input type="radio" id="ostatuRadio" name="zerbitzuMota" value="ostatuRadio" onclick="formularioaErakutsi()"> Ostatua
        <input type="radio" id="besteakRadioButton" name="zerbitzuMota" value="besteakRadioButton" onclick="formularioaErakutsi()"> Beste batzuk
        </div><br>

        <div id="hegaldiAukerak" style="display: none;">
            <input type="radio" id="joanRadio" name="hegaldiAukera" value="joanRadio" onclick="formularioaErakutsi()"> Joan
            <input type="radio" id="joanEtorriRadio" name="hegaldiAukera" value="joanEtorriRadio" onclick="formularioaErakutsi()"> Joan / Etorri
        </div><br>
        <input type = "button" value = "MENU NAGUSIA" onclick="window.location.href='../html/menu_nagusia.html'"><br>

<div id = "formHegaldiJoan" style = "display: none;">
    <label for = "jatorrizkoAire">Jatorrizko aireportua:</label><br>
    <select id = "jatorrizkoAirep" name = "jatorrizkoAirep">
        <?php
            //DATU BASETIK
            $sql = "select kodAireportua, hiria from aireportua"; 
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['kodAireportua'] . "'>" . $row['hiria'] . "</option>";
                }
            }
            ?>
    </select>
    <label for = "helmugaAire">Helmugako aireportua:</label><br>
    <select id = "helmugakoAire" name = "helmugakoAire">
        <?php
            //DATU BASETIK
            $sql = "select kodAireportua, hiria from aireportua"; 
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['kodAireportua'] . "'>" . $row['hiria'] . "</option>";
                }
            }
            ?>
    </select>
    <label for = "hegaldiKod">Hegaldi kodea:</label><br>
    <input type = "text" id = "hegaldiKodea" name = "hegaldiKodea" required><br>
    <label for = "airelineaJoan">Airelinea:</label><br>
    <select id = "airelineaJ" name = "airelineaJ" style = "width: 250px">
        <?php
            //DATU BASETIK
            $sql = "select kodAirelinea, izena from airelineak"; 
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['kodAirelinea'] . "'>" . $row['izena'] . "</option>";
                
                }
            }
            ?>
    </select>
    <label for = "prezioaHJoan">Prezioa (€):</label><br>
    <input type = "number" id = "prezioaJoan" name = "prezioaJoan" required><br>
    <label for = "irteeraDJoan">Irteera data:</label><br>
    <input type = "date" id = "irteeraDataJoan" name = "irteeraDataJoan" required><br>
    <label for = "irteeraOJoan">Irteera ordua:</label><br>
    <input type = "time" id = "irteeraOrduaJoan" name = "irteeraOrduaJoan" required><br>
    <label for = "bidaIraupena">Bidaiaren iraupena (orduetan):</label><br>
    <input type = "number" id = "bidaiIraupena" name = "bidaiIraupena" required><br>
    <input type = "button" value = "GORDE" onclick ="erakutsiTaulaHJ()"><br><br>
    <input type = "submit" value = "GORDE DB" onclick="gordeDB(event)"><br><br>
    <input type = "button" value = "ATZERA" onclick="window.location.href='zerbitzuErregistratu.php'"><br>
</div>

<div id = "formHegaldiJoanE" style = "display: none;">
    <label for = "itzuleraD">Itzulera data:</label><br>
    <input type = "date" id = "itzuleraData" name = "itzuleraData" required><br>
    <label for = "itzuleraO">Itzulera ordua:</label><br>
    <input type = "time" id = "itzuleraOrdua" name = "itzuleraOrdua" required><br>
    <label for = "bueltaIraupena">Bueltako bidaiaren iraupena (orduetan):</label><br>
    <input type = "number" id = "bueltaIraupena" name = "bueltaIraupena" required><br>
    <label for = "bueltaKod">Bueltako hegaldi kodea:</label><br>
    <input type = "text" id = "bueltaHKod" name = "bueltaHKod" required><br>
    <label for = "bueltaAire">Bueltako airelinea:</label><br>
    <select id = "airelineaJE" name = "airelineaJE" style = "width: 250px">
        <?php
            //DATU BASETIK
            $sql = "select kodAirelinea, izena from airelineak"; 
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['kodAirelinea'] . "'>" . $row['izena'] . "</option>";
                
                }
            }
            ?>
    </select><br>
    <input type = "button" value = "GORDE" onclick ="erakutsiTaulaHJE()"><br><br>
    <input type = "submit" value = "GORDE DB" onclick="gordeDB(event)"><br><br>
    <input type = "button" value = "ATZERA" onclick="window.location.href='zerbitzuErregistratu.php'"><br>
</div>

    <div id = "formOstatu" style = "display: none;">
        <div id = "ostatuHotela">
            <label for = "hotelarenIzena">Hotelaren izena:</label><br>
        </div>
        <input type = "text" id = "hotelarenIzena" name = "hotelarenIzena" required><br>
        <div id = "ostatuHiria">
            <label for = "hiriaOstatu"> Hiria:</label><br>
        </div>
        <input type = "text" id = "hiriaOstatu" name = "hiriaOstatu" required><br>
        <div id = "ostatuPrezioa">
            <label for = "prezioaOstatu">Prezioa (€):</label><br>
        </div>
        <input type = "number" id = "prezioaOstatu" name = "prezioaOstatu" required><br>
        <div id = "ostatuSarerra">
            <label for = "sarreraEguna">Sarrera eguna:</label><br>
        </div>
        <input type = "date" id = "sarreraEguna" name = "sarreraEguna" required><br>
        <div id = "ostatuIrteera">
            <label for = "irteeraEguna">Irteera eguna:</label><br>
        </div>
        <input type = "date" id = "irteeraEguna" name = "irteeraEguna" required><br>
        <div id = "ostatuLogela">
            <label for = "logelaMota">Logela mota:</label><br>
        </div>
        <select id = "logelaMotaO" name = "logelaMotaO">
            <?php
                //DATU BASETIK
                $sql = "select kodLogMota, desk from logela_mota"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['kodLogMota'] . "'>" . $row['desk'] . "</option>";
                    }
                }
                $conn->close();
                ?>
        </select><br>
        <input type = "button" value = "GORDE" onclick ="erakutsiTaulaO()"><br><br>
        <input type = "submit" value = "GORDE DB" onclick="gordeDB(event)"><br><br>
        <input type = "button" value = "ATZERA" onclick="window.location.href='zerbitzuErregistratu.php'"><br>
    </div>

    <div id = "formBesteakid" style = "display: none;">
        <div id = "besteakIzena">
            <label for = "izena">Izena:</label><br>
        </div>
        <input type = "text" id = "izenaB" name = "izenaB" required><br>
        <div id = "besteakData">
            <label for = "data">Data:</label><br>
        </div>
        <input type = "date" id = "dataB" name = "dataB" required><br>
        <div id = "besteakDesk">
            <label for = "deskribapena">Deskribapena:</label><br>
        </div>
        <input type = "text" id = "deskribapenaB" name = "deskribapenaB" rows="4" cols="50" required><br>
        <div id = "besteakPrezioa">
            <label for = "prezioaBesteak">Prezioa (€):</label><br>
        </div>
        <input type = "number" id = "prezioaBesteak" name = "prezioaBesteak" required><br>
        <input type = "button" value = "GORDE" onclick ="erakutsiTaulaB()"><br><br>
        <input type = "submit" value = "GORDE DB" onclick="gordeDB(event)"><br><br>
        <input type = "button" value = "ATZERA" onclick="window.location.href='zerbitzuErregistratu.php'"><br>
  </div>
</form>
<table id = "laburpenTaulaHJ" style = "display: none;">
        <thead>
            <tr>
                <th>Jatorrizko Aireportua</th>
                <th>Helmugako Aireportua</th>
                <th>Hegaldi Kodea</th>
                <th>Airelinea</th>
                <th>Prezioa</th>
                <th>Irteera Data</th>
                <th>Irteera Ordua</th>
                <th>Bidaiaren Iraupena</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <table id = "laburpenTaulaHJE" style = "display: none;">
        <thead>
            <tr>
                <th>Itzulera Data</th>
                <th>Itzulera Ordua</th>
                <th>Bueltako Bidai Iraupena</th>
                <th>Bueltako Hegaldi Kodea</th>
                <th>Bueltako Airelinea</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <table id = "laburpenTaulaO" style = "display: none;">
        <thead>
            <tr>
                <th>Hotelaren Izena</th>
                <th>Hiria</th>
                <th>Prezioa (€)</th>
                <th>Sarrera Eguna</th>
                <th>Irteera Eguna</th>
                <th>Logela Mota</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <table id = "laburpenTaulaB" style = "display: none;">
        <thead>
            <tr>
                <th>Izena</th>
                <th>Data</th>
                <th>Deskribapena</th>
                <th>Prezioa (€)</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

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
    let formOstatu = document.getElementById("formOstatu");
    let formBesteak = document.getElementById("formBesteakid");
    let formHegaldiJoan = document.getElementById("formHegaldiJoan");
    let formHegaldiJoanE = document.getElementById("formHegaldiJoanE");
    let formHegaldiAukerak = document.getElementById("hegaldiAukerak");
    let ostatuaRadio = document.getElementById("ostatuRadio");
    let besteakR = document.getElementById("besteakRadioButton");
    let hegaldiaR = document.getElementById("hegaldiaRadio");
    let joanR = document.getElementById("joanRadio");
    let joanEtorriR = document.getElementById("joanEtorriRadio");

    formOstatu.style.display = "none";
    formBesteak.style.display = "none";
    formHegaldiJoan.style.display = "none";
    formHegaldiJoanE.style.display = "none";
    formHegaldiAukerak.style.display = "none";

    if(hegaldiaR.checked) {
        formHegaldiAukerak.style.display = "block";
        if(joanR.checked) {
            formHegaldiJoan.style.display = "block";
        }
        if(joanEtorriR.checked) {
            formHegaldiJoanE.style.display = "block";
        }
    }

    if(ostatuRadio.checked) {
        formOstatu.style.display = "block";
    }
    if(besteakR.checked){
        document.getElementById("formBesteakid").style.display = "block";
    }
}
function erakutsiTaulaHJ() {
    let jatorrizkoAireportua=document.getElementById("jatorrizkoAirep").value;
    let helmugakoAireportua=document.getElementById("helmugakoAire").value;
    let hegaldiKodea=document.getElementById("hegaldiKodea").value.trim();
    let airelineaJ=document.getElementById("airelineaJ").value;
    let prezioaJ=document.getElementById("prezioaJoan").value.trim();
    let irteeraDataJ=document.getElementById("irteeraDataJoan").value;
    let irteeraOrduaJ=document.getElementById("irteeraOrduaJoan").value;
    let bidaiIraupenaJ=document.getElementById("bidaiIraupena").value.trim();
    
    let table = document.getElementById("laburpenTaulaHJ");
    let tbody = table.querySelector("tbody");

    let lerroa = document.createElement("tr");

        let jatorrizkoAireportuaGelaxka = document.createElement('td');
        jatorrizkoAireportuaGelaxka.textContent = jatorrizkoAireportua;
        lerroa.appendChild(jatorrizkoAireportuaGelaxka);

        let helmugakoAireportuaGelaxka = document.createElement('td');
        helmugakoAireportuaGelaxka.textContent = helmugakoAireportua;
        lerroa.appendChild(helmugakoAireportuaGelaxka);

        let hegaldiKodeaGelaxka = document.createElement('td');
        hegaldiKodeaGelaxka.textContent = hegaldiKodea;
        lerroa.appendChild(hegaldiKodeaGelaxka);

        let airelineaJGelaxka = document.createElement('td');
        airelineaJGelaxka.textContent = airelineaJ;
        lerroa.appendChild(airelineaJGelaxka);

        let prezioaJGelaxka = document.createElement('td');
        prezioaJGelaxka.textContent = prezioaJ;
        lerroa.appendChild(prezioaJGelaxka);

        let irteeraDataJGelaxka = document.createElement('td');
        irteeraDataJGelaxka.textContent = irteeraDataJ;
        lerroa.appendChild(irteeraDataJGelaxka);

        let irteeraOrduaJGelaxka = document.createElement('td');
        irteeraOrduaJGelaxka.textContent = irteeraOrduaJ;
        lerroa.appendChild(irteeraOrduaJGelaxka);
            
        let bidaiIraupenaJGelaxka = document.createElement('td');
        bidaiIraupenaJGelaxka.textContent = bidaiIraupenaJ;
        lerroa.appendChild(bidaiIraupenaJGelaxka);

        tbody.appendChild(lerroa);

        table.style.display = "table";
    }

function erakutsiTaulaHJE() {
    let itzuleraData=document.getElementById("itzuleraData").value;
    let itzuleraOrdua=document.getElementById("itzuleraOrdua").value; 
    let bueltakoIraupena=document.getElementById("bueltaIraupena").value.trim(); //trim ezabatzen ditu testu bateko espazio zuriak
    let bueltakoKodea=document.getElementById("bueltaHKod").value.trim();
    let bueltakoAirelinea=document.getElementById("airelineaJE").value;
    
   let table = document.getElementById("laburpenTaulaHJE");
    let tbody = table.querySelector("tbody");

    let lerroa = document.createElement("tr");

    let itzuleraDataGelaxka = document.createElement('td');
    itzuleraDataGelaxka.textContent = itzuleraData;
    lerroa.appendChild(itzuleraDataGelaxka);

    let itzuleraOrduaGelaxka = document.createElement('td');
    itzuleraOrduaGelaxka.textContent = itzuleraOrdua;
    lerroa.appendChild(itzuleraOrduaGelaxka);

    let bueltakoIraupenaGelaxka = document.createElement('td');
    bueltakoIraupenaGelaxka.textContent = bueltakoIraupena;
    lerroa.appendChild(bueltakoIraupenaGelaxka);

    let bueltakoKodeaGelaxka = document.createElement('td');
    bueltakoKodeaGelaxka.textContent = bueltakoKodea;
    lerroa.appendChild(bueltakoKodeaGelaxka);

    let bueltakoAirelineaGelaxka = document.createElement('td');
    bueltakoAirelineaGelaxka.textContent = bueltakoAirelinea;
    lerroa.appendChild(bueltakoAirelineaGelaxka);

    tbody.appendChild(lerroa);

    table.style.display = "table";
    }

function erakutsiTaulaO() {
    let hotelarenIzena=document.getElementById("hotelarenIzena").value;
    let hiria=document.getElementById("hiriaOstatu").value; 
    let prezioaO=document.getElementById("prezioaOstatu").value.trim(); //trim ezabatzen ditu testu bateko espazio zuriak
    let sarreraEguna=document.getElementById("sarreraEguna").value.trim();
    let irteeraEguna=document.getElementById("irteeraEguna").value;
    let logelaMotaO=document.getElementById("logelaMotaO").value;
    
   let table = document.getElementById("laburpenTaulaO");
            let tbody = table.querySelector("tbody");

            let lerroa = document.createElement("tr");

            let hotelarenIzenaGelaxka = document.createElement('td');
            hotelarenIzenaGelaxka.textContent = hotelarenIzena;
            lerroa.appendChild(hotelarenIzenaGelaxka);

            let hiriaGelaxka = document.createElement('td');
            hiriaGelaxka.textContent = hiria;
            lerroa.appendChild(hiriaGelaxka);

            let prezioaOGelaxka = document.createElement('td');
            prezioaOGelaxka.textContent = prezioaO;
            lerroa.appendChild(prezioaOGelaxka);

            let sarreraEgunaGelaxka = document.createElement('td');
            sarreraEgunaGelaxka.textContent = sarreraEguna;
            lerroa.appendChild(sarreraEgunaGelaxka);

            let irteeraEgunaGelaxka = document.createElement('td');
            irteeraEgunaGelaxka.textContent = irteeraEguna;
            lerroa.appendChild(irteeraEgunaGelaxka);

            let logelaMotaOGelaxka = document.createElement('td');
            logelaMotaOGelaxka.textContent = logelaMotaO;
            lerroa.appendChild(logelaMotaOGelaxka);

            tbody.appendChild(lerroa);

            table.style.display = "table";
        }

        function erakutsiTaulaB() {
    let izenaB=document.getElementById("izenaB").value.trim();
    let dataB=document.getElementById("dataB").value; 
    let deskribapenaB=document.getElementById("deskribapenaB").value.trim(); //trim ezabatzen ditu testu bateko espazio zuriak
    let prezioaB=document.getElementById("prezioaBesteak").value;
    
   let table = document.getElementById("laburpenTaulaB");
            let tbody = table.querySelector("tbody");

            let lerroa = document.createElement("tr");

            let izenaBGelaxka = document.createElement('td');
            izenaBGelaxka.textContent = izenaB;
            lerroa.appendChild(izenaBGelaxka);

            let dataBGelaxka = document.createElement('td');
            dataBGelaxka.textContent = dataB;
            lerroa.appendChild(dataBGelaxka);

            let deskribapenaBGelaxka = document.createElement('td');
            deskribapenaBGelaxka.textContent = deskribapenaB;
            lerroa.appendChild(deskribapenaBGelaxka);

            let prezioaBGelaxka = document.createElement('td');
            prezioaBGelaxka.textContent = prezioaB;
            lerroa.appendChild(prezioaBGelaxka);

            tbody.appendChild(lerroa);

            table.style.display = "table";
        }

function gordeDB(event){
    event.preventDefault();

    let formularioa=document.getElementById("zerbitzuakErregistratuOrria");
    let joanR=document.getElementById("joanRadio");
    let joanEtorriR=document.getElementById("joanEtorriRadio");
    let ostatuR=document.getElementById("ostatuRadio");
    let besteBatzukR=document.getElementById("besteakRadioButton");

    let url = ""; 

    if(joanRadio.checked){
        url= 'gordeZJ.php';
    }else if(joanEtorriRadio.checked){
        url = 'gordeZJE.php';
    }else if(ostatuRadio.checked){
        url = 'gordeZO.php';
    }else if(bestekRadioButton.checked){
        url= 'gordeZB.php';
    }else{
        alert("Hutsune guztiak bete behar dituzu.");
        return;
    }

    formularioa.action = url;
    formularioa.submit();
}
</script>
</body>
</html>
