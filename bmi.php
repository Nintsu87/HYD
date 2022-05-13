<?php
session_start();
include 'bmilista2.php';
include 'functions.php';
check();
if (!isset($_SESSION['tulkinta'])){
    $_SESSION['tulkinta']='';
}
$vuosi = date("Y");
?>
<!DOCTYPE html>
<html lang="fi">
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="min_ivv.css?<?php echo time(); ?>" />
<title>How you doin'?</title>
</head>
<body>
    <button onclick="topFunction()" id="ylös" title="Sivun ylälaitaan">Ylös</button>
    <script>
        var mybutton = document.getElementById("ylös");
        
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
          } else {
            mybutton.style.display = "none";
          }
        }
        function topFunction() {
          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;
        }
        </script>
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
        <section id="selite">
            <p>Painoindeksissä paino jaetaan pituuden "neliöllä" 
                (pituus2 eli pituus × pituus). Painoa ei voi jakaa pelkällä 
                pituudella, koska saatu tulos ei olisi tasapuolinen 
                eripituisilla henkilöillä. Pituuden "neliöinti" tasoittaa 
                tuloksen kaiken pituisille sopivaksi. "Neliöinnissä" eli 
                toiseen potenssiin korottamisessa luku kerrotaan itsellään, 
                esimerkiksi 1,752 = 1,75 × 1,75.
            <a href="https://www.terveyskirjasto.fi/dlk01001">Terveyskirjasto</a></p>
            
        </section>
        
    </section>

    <section id="lomake">
        <div class="haha">
            <div class="hoo">
            <img src="./img/BMI.png">
            <h1>Painoindeksilaskuri</h1>

    <section id="laatikot">
        <div class="container">
            <div class="laatikko">
                <form method="post" enctype="multipart/form-data" action="bmilisays2.php" name="arvioi">
                    <p>Anna pituus metreissä:</p>
                    <input type="text" class="pituus" name="pituus" placeholder="esim. 1.75" required>
                    <br>
                    <p>Anna paino kiloissa:</p>
                    <input type="text" class="paino" name="paino" placeholder="esim. 65" required>
                    <br>
                    <button type="submit">Laske</button>
                </form>
            </div>
        </div>
    </section>
    <section class="perus">
        <div class="tulkinta">

            <h1><?=$_SESSION['tulkinta']?></h1>
        </div>
        <div class="historia">
                <ul>
                    <li>Alle 17: vaarallinen aliravitsemus</li>
                    <li>17-18.5: liiallinen laihuus</li>
                    <li>18.5-25: normaalipaino</li>
                    <li>25–30: ylipaino eli lievä lihavuus</li>
                    <li>30–35: merkittävä lihavuuss</li>
                    <li>35–40: vaikea lihavuus</li>
                    <li>Yli 40: sairaalloinen lihavuus</li>
                </ul>
                
                <h3>Historia</h3>
                <p><?=$rmjono?></p>           
         </div>      
    </section>
    </section>
            </form>
        </div> 
                
    </section>

    <section id="footer">
        <p><span style="font-size:12px">Copyright <img src="./img/ivv3.png" class="ivvlogo" width="5%"> <?=$_SESSION['vuosi']?> </span></p>
    </section>
</body>
</html>
<?php
unset($_SESSION['tulkinta']);
?>



	
