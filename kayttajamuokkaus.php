<?php
session_start();
include("connection.php");
include("functions.php");
if (isset($_POST['ss1'])) {
    $ss1 = $_POST['ss1'];
    $ss2 = $_POST['ss2'];
    if ($ss1 == $ss2) {
        $tulos = $con->query('SELECT * FROM käyttäjät WHERE user_id = ' . $_SESSION['user_id']);
        $row=$tulos->fetch_assoc();
        $kss = $row['password'];
        if ($ss1 == $kss) {
            $_SESSION['ssvarmennus'] = "varmennettu";
        } else {
            $_SESSION['ssvarmennus'] = "väärin";
        }
    } else {
        $_SESSION['ssvarmennus'] = "täsmäys";
    }
}

if (isset($_SESSION['poistak'])) {
    if ($_SESSION['ssvarmennus'] == "varmennettu") {
        $tulos = $con->query("DELETE FROM sokeriarvot WHERE hlon_ID = " . $_SESSION['poistak']);
        $tulos = $con->query("DELETE FROM verenpaine WHERE hlon_ID = " . $_SESSION['poistak']);
        $tulos = $con->query("DELETE FROM bmi WHERE hlon_ID = " . $_SESSION['poistak']);
        $tulos = $con->query("DELETE FROM käyttäjät WHERE user_id = " . $_SESSION['poistak']);
        $tulos2 = $con->query('SELECT * FROM käyttäjät WHERE user_id = ' . $_SESSION['alenna']);
        $row2 = $tulos2->fetch_assoc();
        $nimi = $row2['user_name'];
        $_SESSION['k_onnasko'] = 'Käyttäjä: ' . $nimi . ' poistettu!';
        unset($_SESSION['stieto']);
        unset($_SESSION['poistak']); 
        unset($_SESSION['tuloste']);
        unset($_SESSION['ohje']);
        header('location: kayttajat.php');
    } elseif ($_SESSION['ssvarmennus'] == "väärin") {
        $_SESSION['stieto'] = "Tuo ei ole sinun salasanasi.";
        header('location: kvarmennus.php');
    } elseif ($_SESSION['ssvarmennus'] == "täsmäys") {
        $_SESSION['stieto'] = "Salasanat eivät täsmää.";
        header('location: kvarmennus.php');
    }
    
} elseif (isset($_SESSION['alenna'])) {
    if (isset($_POST['ok'])) {
        $ok = $_POST['ok'];
        if ($ok != "ok") {
            $_SESSION['k_onnasko'] = "Et varmistanut muokkausta.";
            header('location: kayttajat.php');
            unset($_SESSION['alenna']);
            die;
        } else {
            $tulos = $con->query('UPDATE käyttäjät SET oikeus = "user" WHERE user_id = ' . $_SESSION['alenna']);
            $tulos2 = $con->query('SELECT * FROM käyttäjät WHERE user_id = ' . $_SESSION['alenna']);
            $row2 = $tulos2->fetch_assoc();
            $nimi = $row2['user_name'];
            $_SESSION['k_onnasko'] = 'Käyttäjä: ' . $nimi . ' alennettu!';
            unset($_SESSION['alenna']); 
            header('location: kayttajat.php');
        }
    }   
} elseif (isset($_SESSION['ylenna'])) {
    if (isset($_POST['ok'])) {
        $ok = $_POST['ok'];
        if ($ok != "ok") {
            $_SESSION['k_onnasko'] = "Et varmistanut muokkausta.";
            header('location: kayttajat.php');
            unset($_SESSION['ylenna']);
            die;
        } else {
            $tulos = $con->query('UPDATE käyttäjät SET oikeus = "admin" WHERE user_id = ' . $_SESSION['ylenna']);
            $tulos2 = $con->query('SELECT * FROM käyttäjät WHERE user_id = ' . $_SESSION['ylenna']);
            $row2 = $tulos2->fetch_assoc();
            $nimi = $row2['user_name'];
            $_SESSION['k_onnasko'] = 'Käyttäjä: ' . $nimi . ' ylennetty!';
            unset($_SESSION['ylenna']); 
            header('location: kayttajat.php');
        }
    }   
} elseif (isset($_POST['aktivoi'])) {
    $id = $_POST['aktivoi'];
    $nimi = $_POST['nimi'];
    $tulos = $con->query('UPDATE käyttäjät SET aktivoitu = "on" WHERE user_id = ' . $id);
    $_SESSION['k_onnasko'] = '</br>Käyttäjä: ' . $nimi . ' aktivoitu!</br>';
    header('location: kayttajat.php');
}
?>
