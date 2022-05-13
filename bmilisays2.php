<?php
    session_start();
    if($_POST!=null)
    {

    $pituus=$_POST["pituus"];
    $paino=$_POST["paino"];
    $index =0;

    $index = round($paino/($pituus*$pituus));
    $bmi = $index;
    
    

    if ($index < 17) {
        $_SESSION['tulkinta'] = "Painoindeksisi on ". $index . ": Vaarallinen aliravitsemus";
    } else if ($index < 18.5){
        $_SESSION['tulkinta'] = "Painoindeksisi on" . $index . ": Liiallinen laihuus";
    } else if ($index < 25) {
        $_SESSION['tulkinta'] = "Painoindeksisi on ". $index . ": Normaalipaino";
    } else if ($index < 30) {
        $_SESSION['tulkinta'] = "Painoindeksisi on " . $index . ": Ylipaino eli lievä lihavuus";  
    } else if ($index < 35) {
        $_SESSION['tulkinta'] ="Painoindeksisi on " . $index . ": Merkittävä lihavuus";
    } else if ($index < 40) {
        $_SESSION['tulkinta'] = "Painoindeksisi on " . $index . ": Vaikea lihavuus";
    } else {
        $_SESSION['tulkinta'] = "Painoindeksisi on " . $index . ": Sairaalloinen lihavuus"; 
        
    
}

header('location: bmi.php');
}

function lisaa($pituus, $paino, $index) { 

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
    $lisayssql = "INSERT INTO bmi (aika, hlon_ID, pituus, paino, pindx) VALUES ('" . $aika . "', '" . $_SESSION['user_id'] . "', '" . $pituus . "', '" . $paino . "', " . $index . ")";

    echo $lisayssql;
    // Suoritetaan lisäys
    $yhteys->query($lisayssql);


    $yhteys->close();
    
}

lisaa($pituus, $paino, $index);
?>
