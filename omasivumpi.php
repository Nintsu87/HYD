<?php
session_start();
$_SESSION['kuukausi'] = 'now';
$_SESSION['paiva'] = date('Y-m-d');
$_SESSION['kkmaara'] = 0;
header('location: omasivu.php')
?>