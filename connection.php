<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "hyd";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
    die("Epäonnistunut yritys!");
}

?>