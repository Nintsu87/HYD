<?php
session_start();
include 'paiva.php';
$_SESSION['kuukausi'] = 'next';
header('location: omasivu.php');
?>