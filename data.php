<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "fotbal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea esuata: " . $conn->connect_error);
}

if ($_POST['submit'] == 'club') insertClub($conn);
else if ($_POST['submit'] == 'stadion') insertStadion($conn);
else if ($_POST['submit'] == 'antrenor') insertAntrenor($conn);
else if ($_POST['submit'] == 'jucator') insertJucator($conn);
else if ($_POST['submit'] == 'liga') insertLiga($conn);
else if ($_POST['submit'] == 'user') insertUser($conn);

function insertClub($conn) {
    $nume = $conn->real_escape_string($_POST['nume']);
    $jucatori = $conn->real_escape_string($_POST['jucatori']);
    $antrenor = $conn->real_escape_string($_POST['antrenor']);
    $pret = $conn->real_escape_string($_POST['pret']);

    if (empty($nume) || !ctype_alpha($nume)) {
        echo "Eroare: Numele poate conține doar litere.";
        return;
    }

    if (empty($jucatori) || !ctype_digit($jucatori)) {
        echo "Eroare: Numărul de jucători poate conține doar cifre.";
        return;
    }

    if (empty($antrenor) || !ctype_alpha($antrenor)) {
        echo "Eroare: Numele antrenorului poate conține doar litere.";
        return;
    }

    if (empty($pret) || !is_numeric($pret)) {
        echo "Eroare: Prețul poate conține doar cifre.";
        return;
    }

    $targetDir = "images/";
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "Fișierul este o imagine - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Fișierul nu este o imagine.";
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 0) {
        echo "Fișierul dvs. nu a fost încărcat.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "Fișierul " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " a fost încărcat.";
            $sql = "INSERT INTO club (Nume, Jucatori, Antrenor, Pret, Logo) VALUES ('$nume', '$jucatori', '$antrenor', '$pret', '$targetFile')";
            $conn->query($sql);
            echo "Clubul a fost inserat cu succes!<br>";
        } else {
            echo "A apărut o eroare la încărcarea fișierului.";
        }
    }
    $conn->close();
    header('Location: displayClub.php');

}

function insertStadion($conn) {
    $nume = $conn->real_escape_string($_POST['nume']);
    $adresa = $conn->real_escape_string($_POST['adresa']);
    $capacitate = $conn->real_escape_string($_POST['capacitate']);
    $echipa = $conn->real_escape_string($_POST['echipa']);

    if (empty($nume)) {
        echo "Eroare: Numele stadionului nu poate fi gol.";
        return;
    }

    if (empty($adresa)) {
        echo "Eroare: Adresa stadionului nu poate fi goală.";
        return;
    }

    if (empty($capacitate) || !ctype_digit($capacitate)) {
        echo "Eroare: Capacitatea poate conține doar cifre.";
        return;
    }

    if (empty($echipa)) {
        echo "Eroare: Numele echipei nu poate fi gol.";
        return;
    }

    $targetDir = "images/";
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "Fișierul este o imagine - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Fișierul nu este o imagine.";
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 0) {
        echo "Fișierul dvs. nu a fost încărcat.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "Fișierul " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " a fost încărcat.";
            $sql = "INSERT INTO stadion (Nume, Adresa, Capacitate, Echipa, Poza) VALUES ('$nume', '$adresa', '$capacitate', '$echipa', '$targetFile')";
            $conn->query($sql);
            echo "Stadionul a fost inserat cu succes!<br>";
        } else {
            echo "A apărut o eroare la încărcarea fișierului.";
        }
    }

    if ($conn->query($sql) === TRUE) {
        echo "Datele au fost adăugate cu succes în tabela stadion!";
    } else {
        echo "Eroare: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header('Location: displayStadion.php');

}

function insertAntrenor($conn) {
    $nume = $conn->real_escape_string($_POST['nume']);
    $prenume = $conn->real_escape_string($_POST['prenume']);
    $certificare = $conn->real_escape_string($_POST['certificare']);
    $varsta = $conn->real_escape_string($_POST['varsta']);

    if (empty($nume) || !ctype_alpha($nume)) {
        echo "Eroare: Numele poate conține doar litere.";
        return;
    }

    if (empty($prenume) || !ctype_alpha($prenume)) {
        echo "Eroare: Prenumele poate conține doar litere.";
        return;
    }

    if (empty($certificare)) {
        echo "Eroare: Certificarea nu poate fi goală.";
        return;
    }

    if (empty($varsta) || !ctype_digit($varsta)) {
        echo "Eroare: Varsta poate conține doar cifre.";
        return;
    }

    $targetDir = "images/";
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "Fișierul este o imagine - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Fișierul nu este o imagine.";
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 0) {
        echo "Fișierul dvs. nu a fost încărcat.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "Fișierul " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " a fost încărcat.";
            $sql = "INSERT INTO antrenori (Nume, Prenume, Certificare, Varsta, Poza) VALUES ('$nume', '$prenume', '$certificare', '$varsta', '$targetFile')";
            $conn->query($sql);
            echo "Antrenorul a fost inserat cu succes!<br>";
        } else {
            echo "A apărut o eroare la încărcarea fișierului.";
        }
    }
    $conn->close();
    header('Location: displayAntrenor.php');
}

function insertJucator($conn) {
    $nume = $conn->real_escape_string($_POST['nume']);
    $prenume = $conn->real_escape_string($_POST['prenume']);
    $club = $conn->real_escape_string($_POST['club']);
    $pozitia = $conn->real_escape_string($_POST['pozitia']);
    $varsta = $conn->real_escape_string($_POST['varsta']);

    if (empty($nume) || !ctype_alpha($nume)) {
        echo "Eroare: Numele poate conține doar litere.";
        return;
    }

    if (empty($prenume) || !ctype_alpha($prenume)) {
        echo "Eroare: Prenumele poate conține doar litere.";
        return;
    }

    if (empty($club)) {
        echo "Eroare: Numele clubului nu poate fi gol.";
        return;
    }

    if (empty($pozitia)) {
        echo "Eroare: Pozitia nu poate fi goală.";
        return;
    }

    if (empty($varsta) || !ctype_digit($varsta)) {
        echo "Eroare: Varsta poate conține doar cifre.";
        return;
    }

    $targetDir = "images/";
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "Fișierul este o imagine - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Fișierul nu este o imagine.";
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 0) {
        echo "Fișierul dvs. nu a fost încărcat.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "Fișierul " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " a fost încărcat.";
            $sql = "INSERT INTO jucatori (Nume, Prenume, Club, Pozitia, Varsta, Poza) VALUES ('$nume', '$prenume', '$club', '$pozitia', '$varsta', '$targetFile')";
            $conn->query($sql);
            echo "Jucatorul a fost inserat cu succes!<br>";
        } else {
            echo "A apărut o eroare la încărcarea fișierului.";
        }
    }
    $conn->close();
    header('Location: displayJucator.php');
}

function insertLiga($conn) {
    $nume = $conn->real_escape_string($_POST['nume']);
    $tara = $conn->real_escape_string($_POST['tara']);
    $echipe = $conn->real_escape_string($_POST['echipe']);
    $lider = $conn->real_escape_string($_POST['lider']);

    if (ctype_alpha($nume) || ctype_digit($nume)) {
        echo "Eroare: Numele poate conține doar litere si cifre.";
        return;
    }

    if (!ctype_alpha($tara)) {
        echo "Eroare: Țara poate conține doar litere.";
        return;
    }

    if (!ctype_digit($echipe)) {
        echo "Eroare: Numărul de echipe poate conține doar cifre.";
        return;
    }

    if (!ctype_alpha($lider)) {
        echo "Eroare: Liderul poate conține doar litere.";
        return;
    }

    $targetDir = "images/";
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "Fișierul este o imagine - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Fișierul nu este o imagine.";
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 0) {
        echo "Fișierul dvs. nu a fost încărcat.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "Fișierul ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " a fost încărcat.";
            $sql = "INSERT INTO liga (Nume, Tara, Nr_Echipe, Lider, Logo) VALUES ('$nume', '$tara', '$echipe', '$lider', '$targetFile')";
            $conn->query($sql);
            echo "Jucatorul a fost inserat cu succes<br>";
        } else {
            echo "A apărut o eroare la încărcarea fișierului.";
        }
    }
    $conn->close();
    header('Location: displayLiga.php');
}
function InsertUser($conn) {
    $name = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $parola = $conn->real_escape_string($_POST['pass']);

    if (ctype_alpha($name) || ctype_digit($name)) {
        echo "Eroare: Numele poate conține doar litere si cifre.";
        return;
    }
 
    $sql = "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$parola')";
    $conn->query($sql);

    header('Location: login.php');
}
?>
