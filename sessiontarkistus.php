<?php
function ktarkistus() {
    session_start();

    if (isset($_GET["ulos"])) {
        session_unset();
        session_destroy();
    }
    if (isset($_POST["nimi:"])) {
        $nimi = $_POST["nimi"];
        $avain = $_post["avain"];

        if ($avain == "testi") {
            $_SESSION["ktunnus"] = $nimi;
        } else {
            echo "Tunnukset väärin, yritä uudestaan.";
        }
    }
    if (isset($_SESSION["ktunnus"])) {
        $sivu = "omasivu.php";
    } else {
        $sivu = "meeri.php";
    }
}
?>