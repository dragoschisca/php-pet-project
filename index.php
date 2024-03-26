<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fotbal</title>
</head>
<body>

    <div class="navbar">
        <div class="container">
            <a class="log__navbar" href="index.php"><img src="images/ball.png"></a>
            <a href="displayClub.php">Cluburi</a>
            <a href="displayJucator.php">Jucători</a>
            <a href="displayAntrenor.php">Antrenori</a>
            <a href="displayStadion.php">Stadioane</a>
            <a href="displayLiga.php">Ligi</a>
            <a href="meciuri.php">Vezi meciuri</a>
            <a href="teren.php">Creaza echipa ta!</a>
            <div class="logare">
            <?php
            session_start();

            $servername = "localhost:3307:3307";
            $username = "root";
            $password = "";
            $dbname = "fotbal";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexiune eșuată: " . $conn->connect_error);
            }

            if (isset($_SESSION['myid'])) {
                $userId = $_SESSION['myid'];

                $query = "SELECT username FROM users WHERE $userId = id";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                }

                echo '<a href="userpage.php" class="username"> ' . $row['username'] . '</a>';
            } else {
                echo '<a href="login.php" id="logare">Logare</a>';
                echo '<a href="creare.html" id="autentificare">Creare</a>';
            }

            $conn->close();
            ?>
            </div>
        </div>
    </div>



<img src="images/logo.avif" class="logo" alt="">


</body>
</html>
