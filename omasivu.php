<?php
session_start();


include("connection.php");
include("functions.php");
check();
include 'kalenteri.php';
include 'paiva.php';
include 'sokeriarvolista.php';
include 'painelista.php';
$paiva = tee_paiva($_SESSION['kuukausi']);

$calendar = new Calendar($paiva);
if (isset($ajat)) {
    $ajat = array_unique($ajat);
    foreach ($ajat as $aikanen) {
        $calendar->add_event('Verensokeri', $aikanen, 1);
    }
} if (isset($p_ajat)) {
    $p_ajat = array_unique($p_ajat);
    foreach ($p_ajat as $aikanen) {
        $calendar->add_event('Verenpaine', $aikanen, 1, 'red');    
    }
}
$aikt = strtotime('2022-03-15');
$aik = date('Y-m-d', $aikt);
$calendar->add_event('BMI', $aik, 1, 'green')
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>How you doin'?</title>
		<link rel="stylesheet" type="text/css" href="kalenteri.css?<?php echo time(); ?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&family=Luxurious+Roman&family=Raleway&display=swap" rel="stylesheet">
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
        <div class="filler">            
        </div>
        <div class="filler">            
        </div>
		<div class="content home">
			<?=$calendar?>
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
