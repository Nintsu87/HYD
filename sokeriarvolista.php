<?php

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
if (isset($_SESSION['user_id'])) {
    mysqli_set_charset($yhteys, "utf8");
    $hakusql = "SELECT aika, s_arvo FROM sokeriarvot WHERE hlon_ID = " . $_SESSION['user_id'];
    // Suoritetaan haku
    $tulos = $yhteys->query($hakusql);

    if ($tulos->num_rows == 0) {
        $rmjono = "Historiasi on vielä tyhjä.";    
    } elseif ($homma = false) {
        $rmjono = "Tietokantayhteys ei ole auki.";
        
    } else {
        $ajat = array();
        $rmjono = "";

        while($row = $tulos -> fetch_assoc()) {
            $rmjono .= $row["aika"] . " Arvo: " . $row["s_arvo"]. "<br>";

            $aikast = strtotime($row['aika']);
            $aika = date('Y-m-d', $aikast);
            if (array_key_exists($aika, $ajat)) {
                continue;
            } else {
                array_push($ajat, $aika);
                
            }

        }
    }
}
$yhteys->close();
?>
