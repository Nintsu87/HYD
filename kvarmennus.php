<?php
// Ninan touhuama käyttäjävarmennussivu
session_start();
include("connection.php");
include("functions.php");
// funktio, jolla tarkistetaan onko käsiteltävä ID sama kuin kirjautuneen ID
function check_self($id) {
    if ($_SESSION['user_id'] == $id) {
        return "Ei itteensä saa muokata.";
    } else {
        return " ";
    }
}
if (!isset($_SESSION['stieto'])) {
    $_SESSION['stieto'] = " ";
}
// jos käyttäjänpoistonappia painaa
if(isset($_POST['poista'])){
    $_SESSION['poistak'] = $_POST['poista'];
    $_SESSION['k_onnasko'] = check_self($_SESSION['poistak']);
    // jos koittaa itseensä poistaa, palaa käyttäjätsivulle, tyhjää väliaikaisen sessiomuuttujan ja katkaisee koodin ajamisen
    if ($_SESSION['k_onnasko'] == "Ei itteensä saa muokata.") {
        header('location: kayttajat.php');
        unset($_SESSION['poistak']);
        die;
    }
    // luo tarvittavat sessiomuuttujat, jotta käyttäjämuokkaus php saa oikeat tiedot
    $_SESSION['tuloste'] = '<input type="password" name="ss1"><input type="password" name="ss2">';
    $_SESSION['ohje'] = 'Kirjoita oma salasanasi 2 kertaan, jos haluat varmentaa poiston.';
// jos painaa ylennänappulaa
} elseif (isset($_POST['ylenna'])) {
    $_SESSION['ylenna'] = $_POST['ylenna'];
    $_SESSION['k_onnasko'] = check_self($_SESSION['ylenna']);
    // jos muokkaa itseään, palaa käyttäjätsivulle, tyhjää väliaikaisen sessiomuuttujan ja katkaisee koodin ajamisen
    if ($_SESSION['k_onnasko'] == "Ei itteensä saa muokata.") {
        header('location: kayttajat.php');
        unset($_SESSION['ylenna']);
        die;
    }
    // luo tarvittavat sessiomuuttujat, jotta käyttäjämuokkaus php saa oikeat tiedot
    $_SESSION['tuloste'] = '<input type="text" name="ok">';
    $_SESSION['ohje'] = 'Kirjoita "ok", jos haluat varmentaa ylennyksen.';
// jos painaa alennanappulaa
} elseif (isset($_POST['alenna'])) {
    $_SESSION['alenna'] = $_POST['alenna'];
    $_SESSION['k_onnasko'] = check_self($_SESSION['alenna']);
    // jos muokkaa itseään, palaa käyttäjätsivulle, tyhjää väliaikaisen sessiomuuttujan ja katkaisee koodin ajamisen
    if ($_SESSION['k_onnasko'] == "Ei itteensä saa muokata.") {
        header('location: kayttajat.php');
        unset($_SESSION['alenna']);
        die;
    }
    // luo tarvittavat sessiomuuttujat, jotta käyttäjämuokkaus php saa oikeat tiedot
    $_SESSION['tuloste'] = '<input type="text" name="ok">';
    $_SESSION['ohje'] = 'Kirjoita "ok", jos haluat varmentaa alennuksen.';
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="info.css?<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&family=Luxurious+Roman&family=Raleway&display=swap" rel="stylesheet">
    <title>How you doin'?</title>
</head>
<body>
    <header>
        <div class="perus">
            <div class="logo">
                <img src="./img/xHYDLogo.png" width="25%">
            </div>
    
            <nav>
                <ul>
                    <li><a href="./paasivu.php">Etusivu</a></li>
                    <li><a href="./omasivumpi.php">Omasivu</a></li>
                    <li><a href="./terveystietoa.php">Terveystietoa</a></li>
                    <!--<li><a href="#">Asetukset</a></li>-->
                    <li><a href="./ohjeet.php">Sivuston ohjeet</a></li>
                    <?=$_SESSION['otsikko']?>
                    <li><form method="post" action="logout.php"><button>Kirjaudu ulos</button></form></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="raita">
        <h1>Varmennus</h1>
    </div>
    <div class="tekstia">
        <h3><?=$_SESSION['stieto']?></h3>
        <p><?=$_SESSION['ohje']?></p>
        <div class="kayttaja">
            <form method="POST" action="kayttajamuokkaus.php">
                <?=$_SESSION['tuloste']?>
                <button type="submit">Varmenna</button>
            </form>
            <button><a href="peru.php">Peruuta</a></button>
        </div>
        
    </div>

    <section id="perus">
            <button><a href="./verensokeri.php"><img src="./img/omppu.png" width="125px" height="125px"></a></button>
            <button><a href="./paine.php"><img src="./img/sydan.png" width="120px" height="120px"></a></button>
            <button><a href="./bmi.php"><img src="./img/BMI.png" width="130px" height="130px"></a></button>
        </section>
    <section id="footer">
        <p><span style="font-size:12px">Copyright <img src="./img/ivv3.png" class="ivvlogo" width="5%"> <?=$_SESSION['vuosi']?> </span></p> 
    </section>
</body>
</html>
