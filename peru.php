<?php
// Ninan touhuama peru-nappulasta: unsettaa väliaikaissessiomuuttujat
session_start();
$_SESSION['k_onnasko'] = "Toiminto peruttu.";
unset($_SESSION['poistak']); 
unset($_SESSION['stieto']);
unset($_SESSION['tuloste']);
unset($_SESSION['ohje']);
unset($_SESSION['alenna']);
unset($_SESSION['ylenna']);
header("location: kayttajat.php")

?>
