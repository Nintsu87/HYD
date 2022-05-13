<?php
// Ninan touhuama edelliskuukausinappulan tapahtuma
session_start();
include 'paiva.php';
$_SESSION['kuukausi'] = 'prev';
header('location: omasivu.php');
?>
