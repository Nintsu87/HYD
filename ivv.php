<?php

session_start();
    include("connection.php");
    include("functions.php");
if (isset($_SESSION['user_id'])) {
    header('location: paasivu.php');

}
if (!isset($_SESSION['kirj'])) {
    $_SESSION['kirj'] = "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="hyd.css"<?php echo time(); ?>>
    <title>How You Doin'</title>
</head>
<body style="background-color: #e1f7ed;">
    <p id="yla">Nina | Minna | Meeri</p>
    <header class="otsikko">
        <h1 class="ekaotsikko">How You Doin'</h1>
        <h3 class="tokaotsikko">eli Kuis kulkee kultasein</h3>
        <img src="./img/question.png" class="merkki">
    </header>
    <img src="./img/xHYDLogo.png" class="kuva">
    <p class="esittely">Tämä on ryhmän Ihan-vaan-viisi projektityö 
        kurssille ohjelmistokehittäjänä toimiminen. Tällä sivustolla löydät erilaista
        tietoa terveyteen liittyen. Rekisteröityneenä käyttäjänä voit tallentaa
        omia tietojasi ja tarkastella ja vertailla niitä ajan saatossa. Aina kun ilmoitat
        omia tietojasi, ohjelma kertoo palautteen terveyden näkökulmasta. Käytössäsi on verenpaineen,
        verensokerin ja painoindeksin tulkinnat.</p>
    

    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Kirjaudu</button><button type="button" class="toggle-btn" onclick="register()">Rekisteröidy</button>
            </div>
            <form id="login" class="input-group" method="POST" enctype="multipart/form-data" action="log.php">
                <input type="text" class="input-field" name="user_name" placeholder="Käyttäjätunnus" required>
                <input type="password" class="input-field" name="password" placeholder="Salasana" required>
                <button type="submit" class="submit-btn" name="Login" action="">Kirjaudu</button>
                <br>
                <a href="ssalasana.php">Unohtuiko salasana</a>
                <p style="color:red;"><b><?=$_SESSION['kirj']?></b></p>

            </form>
            
            <form id="register" class="input-group" method="post" enctype="multipart/form-data" action="">
                <input type="text" class="input-field" name="user_name" placeholder="Käyttäjätunnus" required>
                <input type="email" class="input-field" name="email" placeholder="Sähköposti">
                <input type="password" class="input-field" name="password" placeholder="Salasana" required>

                <input type="checkbox" class="chech-box" required><span>Hyväksyn käyttöehdot, mitä ikinä ne tulee olemaankaan</span>

                <button type="submit" class="submit-btn">Rekisteröidy</button>
            </form>    
        </div>
    </div>
    <div class="popup" id="popup">
        <img src="img/xHYDLogo.png">
        <h2>Rekisteröinti onnistui</h2>
        <p>Nyt voit jatkaa kirjautumalla sisään!</p>
        <button type="button" onclick="closePopup()">OK</button>
    </div>

    <script>
        window.addEventListener( "load", function () {
    function sendData() {
    const XHR = new XMLHttpRequest();

    // Bind the FormData object and the form element
    const FD = new FormData( form );

    // Define what happens on successful data submission
    XHR.addEventListener( "load", function(event) {
      if (event.target.responseText == "Jei")
      {
      openPopup();}
      else {

         alert( "Otapa uudestaan. Käyttäjätunnuksen pitää olla uniikki. Salasanassa pitää olla vähitään 8 merkkiä, sisältää isoja ja pieniä kirjaimia sekä vähintään yksi numero.");

      }
    } );

    // Define what happens in case of error
    XHR.addEventListener( "error", function( event ) {
      alert( 'Oops! Something went wrong.' );
    } );

    // Set up our request
    XHR.open( "POST", "sig.php" );

    // The data sent is what the user provided in the form
    XHR.send( FD );
  }

  // Access the form element...
  const form = document.getElementById("register");

  // ...and take over its submit event.
  form.addEventListener( "submit", function ( event ) {
    event.preventDefault();

    sendData();
  } );
} );


        let popup = document.getElementById("popup");

        function openPopup(){
        popup.classList.add("open-popup");
        }

        function closePopup(){
        popup.classList.remove("open-popup");
        location.reload();
        }

        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }
        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
        }
    </script>

    <p id="ala">Ihan-vaan-viisi <img src="./img/ivv3.png" class="logo"></p>
</body>
</html>

