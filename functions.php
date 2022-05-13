<?php

function check_login($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query= "select * from käyttäjät where user_id = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    else
    //vie kirj.sivulle
    header('location: ivv.php');
    die;
}

//vaihtoehtoinen tarkistus edelliselle funktiolle
function check() {
    if(!isset($_SESSION['user_id'])) {
        header('location: ivv.php');

    } elseif (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
        $_SESSION['kirj'] = "Ehdit olla 30min ilman aktiivisuutta.";
        header('location: ivv.php');

    } elseif ($_SESSION['aktivoitu'] == "ei") {
        session_unset();
        session_destroy(); 
        $_SESSION['kirj'] = "Tunnuksiasi ei ole vielä aktivoitu.";
        header('location: ivv.php');
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
    if ($_SESSION['oikeus'] == "admin"){
        $_SESSION['otsikko'] = '<li><a href="kayttajat.php">Käyttäjät</a></li>';

    } else {
        $_SESSION['otsikko'] = '';
    }
}

function random_num($length)
{
    $text= "";
    if($length < 5)
    {
        $length=5;
    }

    $len= rand(4,$length);

    for ($i=0; $i < $len; $i++) { 
        # code...

        $text .= rand(0,9);
    }

    return $text;
}
?>
