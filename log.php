<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    //jtn kirjoitettiin
    $user_name= $_POST['user_name'];
    $password= $_POST['password'];

    if(!empty($user_name) && !empty($password)) {

        //lue tietokannasta
        $query = "select * from käyttäjät where user_name = '$user_name' && password = '$password' limit 1";
        $result = $con->query($query);
        if ($result->num_rows > 0) {
            while($row = $result -> fetch_assoc()) {
                if ($row['aktivoitu'] == "on") {
                    $_SESSION['user_id'] = $row["user_id"];
                    $_SESSION['paiva'] = date('Y-m-d');
                    $_SESSION['kuukausi'] = 'now';
                    $_SESSION['vuosi'] = date('Y');
                    $_SESSION['kkmaara'] = 0;
                    $_SESSION['oikeus'] = $row['oikeus'];
                    $_SESSION['aktivoitu'] = $row['aktivoitu'];
                    header("Location: paasivu.php");
                    die;
                } else {
                    $_SESSION['kirj'] = '</br>Tunnuksia ei vielä ole aktivoitu.';
                    header('location: ivv.php'); 
                    die;
                }
            }
        }
        
    $_SESSION['kirj'] = '</br>Otapa uudestaan';
    header('location: ivv.php');  
    }

}
?>
