<?php
$pi = filter_input(INPUT_POST, 'pituus');
$pa = filter_input(INPUT_POST, 'paino');
if (!empty($pi)){
if (!empty($pa)){
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "HYD";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
die('Yhteysvirhe ('. mysqli_connect_errno() . ') '
. mysqli_connect_error());
}
else{
$sql = "INSERT INTO bmi (pituus, paino)
values('$pi','$pa')";
if ($conn->query($sql)){
include("bmi.php");
}
else{
echo "Error: ". $sql . "
". $conn->error;
}
$conn->close();
}
}
else{
echo "Painon ei pitäisi olla tyhjä";
die();
}
}
else{
echo "Pituuden ei pitäisi olla tyhjä";
die();
}
?>