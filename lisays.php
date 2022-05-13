<?php
// Ninan verensokeriarvon lisäyssivu
$lisayssql = "";
// jos käyttäjä syöttää arvon, se testataan ja tallennetaan sessioon
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $arvo = test_input($_POST["arvo"]); 
    $_SESSION['arvo'] = $arvo;
// muuten tallennetaan tyhjä arvo sessioon
} else {
    $arvo = "";
    $_SESSION['arvo'] = $arvo;
}
// jos tallennettu arvo ei ole tyhjä se analysoidaan ja siitä luodaan arvio
if ($_SESSION['arvo'] != "") {
    $edarvo = $_SESSION['arvo'];
    $uarvo = (float) $edarvo;
    if (strval($uarvo) != $edarvo) {
        $arvo= "Annoit tiedot väärin enkä suostu käsitellä sitä: " . $edarvo;
        $tieto2 = "ei";
        $arvio = "";
        $analyysi = "";
    } else {
        $tieto2 = "joo";
        $arvio = arvioi($_SESSION['arvo']);
        $analyysi = analysoi($arvio);
    }
    
    
// muuten luodaan tyhjät arvot
} else {
    $arvio = "";
    $analyysi = "";
}
// jos ruksi on laitettu analysointinappia painaessa
if (isset($_POST["lisaa"]) AND $tieto2 != "ei") {
    // tallentaa arvon käyttäjän tiedoilla, arvolla ja arviolla tietokantaan
    lisaa($arvo, test_input($arvio[0]));
}

// funktio käyttää pythonilla kirjoitettua arvioimiskoodia hyväkseen luodakseen arvion
function arvioi($arvo) {
    $command = escapeshellcmd('python ivv-sokeritarkistus.py ' . $arvo);
    $output = shell_exec($command);
    return $output;
}
// funktio testaa ettei oo hack ja palauttaa epähackautuvan tekstin
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if (strpos($data, ",")) {
        $data = str_replace(",", ".", $data);
    }
    return $data; 
}
// funktio antaa arviolle kirjallisen analyysin
function analysoi($arvio) {
    if ($arvio == 1) {
        $analyysi = "<p style='color:red;'>Arvo on korkea: <br>Käytäthän insuliinia lääkärin ohjeen mukaisesti ja jos se ei auta soita 112.</p>";
    } elseif ($arvio == 2) {
        $analyysi = "<p style='color:orange;'>Arvo on kohonnut: <br>Vältä sokerien nostavien ruokien syömistä hetkeen.</p>";
    } elseif ($arvio == 3) {
        $analyysi = "<p style='color:green;'>Arvo on normaali: <br>Hyvä!</p>";
    } elseif ($arvio == 4) {
        $analyysi = "<p style='color:red;'>Arvo on alhainen: <br>Jos sokerisi vielä laskevat, saatat joutua sairaalaan. Tämän vältät syömällä jotain, joka nostaa sokeriasi.</p>";
    } else {
        $analyysi = $arvio . "Annoit tiedot väärin enkä suostu käsitellä sitä.";
    }
    return $analyysi;
}

// funktio tallentaa tietokantaan sille annetun arvon ja arvion käyttäjän id ja tämänhetkisen ajan kanssa
function lisaa($arvo, $arvio) {   
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hyd";

    // Muodostetaan yhteys tietokantaan halutuilla tiedoilla
    $yhteys = new mysqli($server,$username,$password,$dbname);

    //Tarkistetaan yhteys
    if ($yhteys -> connect_error) {
        $homma = false;
    } else {
        $homma = true;
    }
    mysqli_set_charset($yhteys, "utf8");
    $aika = date("d.m.Y H:i");
    $lisayssql = "INSERT INTO sokeriarvot (aika, hlon_ID, s_arvo, arvio) VALUES ('" . $aika . "', '" . $_SESSION['user_id'] . "', '" . $arvo . "', " . $arvio . ")";
    echo $lisayssql;
    // Suoritetaan lisäys
    $tulos = $yhteys->query($lisayssql);


    $yhteys->close();
    header('location: verensokeri.php');
}
?>
