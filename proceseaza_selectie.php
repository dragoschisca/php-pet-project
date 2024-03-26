<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userId = $_SESSION["myid"];
    $pozitie = $_POST['pozitie'];
    $jucatorId = $_POST['jucator'];

    $conn = new mysqli('localhost:3307:3307', 'root', '', 'fotbal');

    $query = "INSERT INTO users_jucatori (user_id, jucator_id, pozitia) VALUES ($userId, $jucatorId, '$pozitie')";
    $result = $conn->query($query);

    if ($result) {
        header("Location: teren.php");
        exit();
    } else {
        echo "Eroare la procesarea selecției.";
    }
} else {
    echo "Eroare: Metoda de accesare incorectă.";
}
?>
