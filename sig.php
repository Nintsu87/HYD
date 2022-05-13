<?php 
session_start();
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //jtn kirjoitettiin
    $user_name= $_POST['user_name'];
    $email= $_POST['email'];
    $password= $_POST['password'];

    //Nina: lisäilin emailin uniikkitestin salasanan vaihtoa varten:
    $tulos = $con -> query('SELECT * FROM käyttäjät WHERE email = "' . $email . '"');
    if ($tulos -> num_rows != 0) {
        $emailtest = false;
    } else {
        $emailtest = true;
    }
    
    if(!empty($user_name) && !empty($password) && preg_match('@[A-Z]@', $password) && preg_match('@[a-z]@', $password) 
    && preg_match('@[0-9]@', $password) && strlen($password) >= 8 && !empty($email) && $emailtest == true)
    {
        //vie tietokantaan
        $user_id = random_num(8);

        $query = 'INSERT INTO käyttäjät (user_id, email, user_name, password, oikeus, aktivoitu) 
        VALUES (' . $user_id . ', "' . $email . '", "' . $user_name . '", "' . $password . '", "user", "ei")';
        
        mysqli_query($con, $query);
        
        echo "Jei";
        die;

    }else
    {
        echo "Otapa uudestaan.";
        
    }
}

?> 
