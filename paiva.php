<?php
// funktio luo päivän riippuen mikä käsky sille on annettu (liittyy kalenterin kuukausinäkymään)
function tee_paiva($maaraus = NULL) {
    if ($maaraus == "next") {
        ++$_SESSION['kkmaara'];
        $seur = strtotime($_SESSION['kkmaara'] . " Months");
        $_SESSION['paiva'] = date('Y-m-d', $seur);
        
    } elseif ($maaraus == "prev") {
        --$_SESSION['kkmaara'];
        $ed = strtotime($_SESSION['kkmaara'] . " Months");
        $_SESSION['paiva'] = date('Y-m-d', $ed);
    } else {
        $_SESSION['paiva'] = date('Y-m-d') ;
    }
    return $_SESSION['paiva'];
}
?>
