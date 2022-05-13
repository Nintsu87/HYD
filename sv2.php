<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ss1 = $_POST['ss1'];
    $ss2 = $_POST['ss2'];
    $koodi = $_POST['koodi'];
    if ($ss1 == $ss2) {
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hyd";

        // Muodostetaan yhteys tietokantaan halutuilla tiedoilla
        $yhteys = new mysqli($server,$username,$password,$dbname);

        //Tarkistetaan yhteys
        if ($yhteys -> connect_error) {
            $homma = false;
        } else {
            $homma = true;
        }

        mysqli_set_charset($yhteys, "utf8");

        $hakusql = 'SELECT * FROM ssanavaihto WHERE koodi = "' . $koodi . '";';

        $tulos = $yhteys->query($hakusql);
        if ($tulos->num_rows == 0) {
            $_SESSION['kirj'] = "Koodi on epäkelpo.";
        } elseif ($homma == false) {
            $_SESSION['kirj'] = "Ei yhteyttä tietokantaan, yritä myöhemmin uudelleen.";
        } elseif ($tulos->num_rows > 0) {
            $row = $tulos -> fetch_assoc();
            $status = $row['status'];
            if ($status == "active") {
                $id = $row['kayttajaID'];
                $svaihtosql = 'UPDATE käyttäjät SET password = "' . $ss1 . '" WHERE user_id = "' . $id . '";';
                $statusvaihtosql = 'UPDATE ssanavaihto SET status = "used" WHERE koodi = "' . $koodi . '";';
                $tulos = $yhteys->query($svaihtosql);
                $tulos = $yhteys->query($statusvaihtosql);
                $_SESSION['kirj'] = "Salasana vaihdettu onnistuneesti.";
                header("location: ivv.php");
                $yhteys->close();
                die;
            } else {
                $_SESSION['kirj'] = "Koodi on jo käytetty. Vaihto epäonnistui.";
                header("location: svaihto.php");
                $yhteys->close();
                die;
            }
        }
    } elseif ($ss1 != $ss2) {
        $_SESSION['kirj'] = "Salasanat eivät täsmänneet.";
        header("location: svaihto.php");
        $yhteys->close();
        die;
    }
}
?>
