<?php
function analysoi($arvio) {
    if ($arvio == 1) {
        $analyysi = "<p style='color:red;'>Verenpaineesi on koholla: <br> Verenpaine on koholla, kun yläpaine on yli 140 tai alapaine yli 90. <br>
        Kohonnut verenpaine vahingoittaa valtimoita ja aiheuttaa aivohalvauksia ja sydäninfarkteja.<br>
        Verenpainetta voi alentaa vähentämällä suolaa ja liikkumalla riittävästi, tupakoitsija lopettamalla ja ylipainoinen laihduttamalla.<br>
        Jos omat keinot eivät laske verenpainetta riittävästi, tarvitaan verenpainelääkkeitä.</p>";
    } elseif ($arvio == 2) {
        $analyysi = "<p style='color:orange;'>Verenpaineesi on tyydyttävällä tasolla: <br>
        Alenna verenpainettasi vähentämällä suolan käyttöää ja liikkumalla riittävästi, tupakoitsija lopettamalla ja ylipainoinen laihduttamalla.</p>";
    } elseif ($arvio == 3) {
        $analyysi = "<p style='color:green;'>Verenpaineesi on normaalilla tasolla: <br>Hyvä!</p>";
    } elseif ($arvio == 4) {
        $analyysi = "<p style='color:red;'>Huippaako? Verenpaineesi on matala. <br>Syö lakritsia niin helpottaa.</p>";
    } elseif ($arvio == 6) {
        $analyysi = "<p style='color:red;'>Syötit tiedot väärässä muodossa. Käytä numeroita erotettuna / merkillä.</p>";
    } else {
        $analyysi = "Annoit tiedot väärin enkä suostu käsittelemään sitä.";
    }
    return $analyysi;
    }

function arvioi($arvo){

    
        $paine= explode("/", $arvo);
        $ylapaine= $paine[0];
        $alapaine= $paine[1];
        // Tarkistaa onko luvut halutussa muodossa.
        if (is_numeric($ylapaine) and is_numeric($alapaine) and isset($ylapaine) and isset($alapaine)){ 
            // Antaa tietoa, miten lukuun tulisi suhtautua.
            if ($ylapaine >= 140 or $alapaine >= 90){  
                    #print("Verenpaineesi on koholla.")
                $merkinta = 1;}
            elseif (139 >= $ylapaine and $ylapaine >= 131 and 80 <= $alapaine and $alapaine <= 89){
                    #print("Verenpaineesi on tyydyttävällä tasolla.")
                $merkinta = 2;}
            elseif (130 >= $ylapaine and $ylapaine >= 101 and $alapaine <= 85){
                    #print("Verenpaineesi on normaalilla tasolla.")
                $merkinta = 3;}
            elseif ($ylapaine <=100){
                    #print("Huippaako? Verenpaineesi on matala.")
                $merkinta = 4;}
            else{
                $merkinta = 5;}}
        else{
            $merkinta = 6;
        }
            
        $arvio = $merkinta;
        return $arvio;

    }

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
    if ($arvio <= 4){
        $lisayssql = "INSERT INTO verenpaine (aika, hlon_ID, p_arvo, arvio) VALUES ('" . $aika . "', '" . $_SESSION['user_id'] . "', '" . $arvo . "', " . $arvio . ")";
    // Suoritetaan lisäys
        $yhteys->query($lisayssql);
        $yhteys->close();
        header('location: paine.php');
    }
    else{
        alert("Annoit tiedot väärin enkä suostu tallentamaan sitä.");
        $yhteys->close();
      }
}

// Alertin funktio
function alert($message) {
	
	echo "<script>alert('$message');</script>";
}


$lisayssql = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $arvo = $_POST["arvo"]; 
    $_SESSION['arvo']= $arvo;
} else {
    $arvo = "";
    $_SESSION['arvo'] = $arvo;
}

if ($_SESSION['arvo'] != "") {
    $arvio = arvioi($_SESSION['arvo']);
    $analyysi = analysoi($arvio);
} else {
    $arvio = "";
    $analyysi = "";
}

if (isset($_POST["lisaa"])) {
    lisaa($arvo, $arvio);
}

?>
