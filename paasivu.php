<?php
session_start();

include("connection.php");
include("functions.php");
check();

$tulos = $con -> query('SELECT * FROM käyttäjät WHERE aktivoitu = "ei"');
if ($tulos -> num_rows > 0 && $_SESSION['oikeus'] == "admin") {
    $print = "HOI!</br>Siellä ois käyttäjiä taas aktivoitavaksi.";
} else {
    $print = "";
}

?>

<!DOCTYPE html>
<html lang="fi">
<head>
<meta charset="UTF-8" />
<link href="min_ivv.css?<?php echo time(); ?>" rel="StyleSheet" type="text/css" />
<title>How you doin'?</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="./img/xHYDLogo.png" width="25%" height="25%">
            </div>

            <nav>
                <ul>
                    <li><a href="./paasivu.php">Etusivu</a></li>
                    <li><a href="./omasivumpi.php">Omasivu</a></li>
                    <li><a href="./terveystietoa.php">Terveystietoa</a></li>
                    <!--<li><a href="#">Asetukset</a></li>-->
                    <li><a href="./ohjeet.php">Sivuston ohjeet</a></li>
                    <?=$_SESSION['otsikko']?>
                    <li><button><a href="logout.php">Kirjaudu ulos</a></button></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="banner-section">
        <p>
            Tämä on ryhmän Ihan-vaan-viisi projektityö 
            kurssille ohjelmistokehittäjänä toimiminen. Tällä sivustolla löydät erilaista
            tietoa terveyteen liittyen. Rekisteröityneenä käyttäjänä voit tallentaa
            omia tietojasi ja tarkastella ja vertailla niitä ajan saatossa. Aina kun ilmoitat
            omia tietojasi, ohjelma kertoo palautteen terveyden näkökulmasta. Käytössäsi on verenpaineen,
            verensokerin ja painoindeksin tulkinnat.
        </p>
    </section>


    <section id="tiles">
        <div class="huom">
            <h3><?=$print?></h3>
        </div>
        <div class="container">
            <div class="square">
                <a href="./verensokeri.php">
                <img src="./img/omppu.png">
                <h3>Verensokeri</h3>
                </a>
                <p>Verensokeri tarkoittaa veren glukoosipitoisuutta, jonka 
                    mittausyksikkönä käytetään mmol/l eli millimoolia litrassa. 
                    Verensokeri vaikuttaa ihmisen yleisvointiin ja vireyteen.
                </p>
            </div>
            <div class="square">
                <a href="./paine.php">
                <img src="./img/sydan.png">
                <h3>Verenpaine</h3>
                </a>
                <p>Verenpaine tarkoittaa ihmisen suurimmissa valtimoissa olevaa 
                    painetta. Verenpaineen suhteellisen säännöllisesti jatkuva 
                    muutos pitää veren liikkeessä, ja sitä ylläpitää sydän.
                </p>

            </div> <div class="square">
                <a href="./bmi.php">
                <img src="./img/BMI.png">
                <h3>Painoindeksi</h3>
                </a>    
                <p>Pelkkä paino ei kerro, onko ylipainoa vai ei, koska ihmiset 
                    ovat eripituisia. Siksi paino pitää suhteuttaa pituuteen. 
                    Se tehdään painoindeksin avulla. Painoindeksistä käytetään 
                    lyhennystä BMI, joka tulee englannin kielen sanoista 
                    Body Mass Index.
                </p>
            </div>
        </div>
    </section>

    <section id="footer">
        <img src="./img/ivv3.png">
        <p>Copyright 2022</p>
    </section>
</body>
</html>

