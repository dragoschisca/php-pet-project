<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "fotbal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea esuata: " . $conn->connect_error);
}

    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    if (empty($username)) {
        echo "Eroare: Numele nu poate fi gol.";
        return;
    }

    if (empty($email)) {
        echo "Eroare: Email  nu poate fi goală.";
        return;
    }

    if (empty($password) || !ctype_digit($password)) {
        echo "Eroare: Parola poate conține doar cifre.";
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
            $sql = "INSERT INTO users (username, email, password, Poza) VALUES ('$username', '$email', '$password', '$targetFile')";
            
            if ($conn->query($sql) === TRUE) {
                session_start();
                $_SESSION['myid'] = $conn->insert_id; 
                $conn->close();
                header('Location: index.php');
                exit(); 
            } else {
                echo "Eroare: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "A apărut o eroare la încărcarea fișierului.";
        }
    }
?>