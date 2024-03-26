<!-- teren.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teren.css">
    <link rel="stylesheet" href="style.css">
    <title>Teren Fotbal</title>
</head>
<body>

<div class="navbar">
        <div class="container">
            <a class="log__navbar" href="index.html"><img src="images/ball.png"></a>
            <a href="displayClub.php">Cluburi</a>
            <a href="displayJucator.php">Jucători</a>
            <a href="displayAntrenor.php">Antrenori</a>
            <a href="displayStadion.php">Stadioane</a>
            <a href="displayLiga.php">Ligi</a>
            <a href="meciuri.php">Vezi meciuri</a>
            <a href="teren.php">Creaza echipa ta!</a>
            <div class="logare">
                <a href="login.php"><img src="images/login.svg" class="log__icon" alt=""></a>
                <a href="signup.php"><img src="images/signup.png" class="log__icon" alt=""></a>
            </div>
        </div>
    </div>

    <div id="teren">
    <?php

    session_start();

    if($_SESSION["myid"] == 0) header("Location: Login.php");

    $servername = "localhost:3307:3307";
    $username = "root";
    $password = "";
    $dbname = "fotbal";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $queryJucatori = "SELECT * FROM jucatori";
    $resultJucatori = $conn->query($queryJucatori);

    $queryOcupati = "SELECT * FROM users_jucatori WHERE user_id=".$_SESSION["myid"];
    $resultOcupati = $conn->query($queryOcupati);

    $ocupati = [];
    while ($row = $resultOcupati->fetch_assoc()) {
        $pozitie = $row['pozitia'];
        $jucatorId = $row['jucator_id'];
        $ocupati[$pozitie] = $jucatorId;
    }

    for ($i = 1; $i <= 11; $i++) {
        echo "<div class='pozitie pozitionare$i'>";

        if (isset($ocupati[$i])) {
            $jucatorId = $ocupati[$i];

            $resultJucatori->data_seek(0); 
            while ($row = $resultJucatori->fetch_assoc()) {
                if ($row['Id'] == $jucatorId) {
                    $pozaJucator = $row['Poza'];
                    echo "<a href='selecteaza_jucator.php?pozitie=$i'><img src='$pozaJucator' alt='Poza Jucator'></a>";

                    break;
                }
            }
        } else {
            echo "<a href='selecteaza_jucator.php?pozitie=$i' class='jucator'>$i</a>";
        }

        echo "</div>";
    }

    $conn->close();
    ?>
</div>
</body>
</html>
