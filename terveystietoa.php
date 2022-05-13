<?php
session_start();
include 'functions.php';
check();
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
        <h1>Terveystietoa</h1>
    </div>
    <div class="tekstia">
        <div class="kpl">
            <h2>Sokru</h1>
            <p>Tässä ois tietoa sokruista ja semmosta</p>
        </div>
        <div class="kpl">
            <h2>Verenpaine</h1>
            <p>Tässä ois tietoa verenpaineesta ja semmosta</p>
        </div>
        <div class="kpl">
            <h2>Painoindeksi (BMI)</h1>
            <p>Tässä ois tietoa painoindeksistä ja semmosta</p>
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
