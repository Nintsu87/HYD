<?php
session_start();

$_SESSION['note'] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST['mail']);
    $_SESSION['mail'] = $email; 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['note'] = "<p style='color:red;'><b>Nyt taisi tulla typo.. </b></p>";
        header("location: salasana.php");
        die;
        
    }
}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data; 
}

function luo_salasanakoodi() {
    $merkit = "abcdefghijklmnopqrstuvwxyz123456789";
    $nro = strlen($merkit)-1;

    $koodi = "";
    for ($x = 0; $x <= 8; $x++) {
        $randomi = rand(0,$nro);
        $koodi .= $merkit[$randomi];
    }
    return $koodi;
}
function testaa_koodi($koodi) {
    $haku2sql = "SELECT * FROM `ssanavaihto`;";
    // Suoritetaan haku

    $tulos2 = $yhteys->query($haku2sql);

    if ($tulos2->num_rows > 0) {    
        while($row = $tulos2 -> fetch_assoc()) {
            if ($koodi == $row['koodi']) {
                $salakoodi = luo_salasanakoodi();
                testaa_koodi($salakoodi);
            }
            
        }
    }
}

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
$hakusql = 'SELECT * FROM käyttäjät WHERE email = "' . $_SESSION['mail'] . '";';

$tulos = $yhteys->query($hakusql);

$salakoodi = luo_salasanakoodi();
if ($tulos->num_rows == 0) {
    $_SESSION["email"] = "noemail"; 
} elseif ($homma == false) {
    $_SESSION['email'] = "nosql";
} elseif ($tulos->num_rows > 0) {
    $row = $tulos -> fetch_assoc();
    $id = $row['user_id'];
    $_SESSION['email'] = 'oikein';
    $lisaakoodi = 'INSERT INTO ssanavaihto (kayttajaID, koodi, status) VALUES ("' . $id . '", "' . $salakoodi . '", "active");';

    $tulos = $yhteys->query($lisaakoodi);
    $_SESSION['viesti'] = 'Tällä linkillä voit vaihtaa salasanasi: *<a href="svaihto.php">tässon kiva linkki</a>*, käytä koodia: ' . $salakoodi;
    //mail($email, "Salasana-asiaa HYD:ltä.", $_SESSION['viesti']);
    
}


if ($_SESSION['email'] == 'nosql') {
    $_SESSION['note'] = "<p style='color:red;'><b>Meiän yhteyksissä on vikaa, kokli myöhemmin uudestaan.</b></p>";
} elseif ($_SESSION['email'] == "noemail") {
    $_SESSION['note'] = "<p style='color:red;'><b>Meillä ei oo tallennettuna accounttia antamallasi maililla.</b></p>";
} elseif ($_SESSION['email'] == "väärä") {
    $_SESSION['note'] = "<p style='color:red;'><b>Nyt taisi tulla typo.. </b></p>";
} elseif ($_SESSION['email'] == "oikein") {
    $_SESSION['note'] = "<p><b>Mailin pitäisi tulla pian sun saapuneisiin osoitteeseen " . $_SESSION['mail'] . ". Viesti: " . $_SESSION['viesti'] . "</b></p>";
}
 

$yhteys->close();
header('location: salasana.php');
?>
