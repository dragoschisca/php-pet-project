<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cluburi</title>
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

    <div class="dates">
        <h1>Cluburi</h1>
        <a href="club.html"><p>Create new</p></a>

        <form method="post" action="">
            <label for="nume">Nume:</label>
            <input type="text" name="nume" id="nume">

            <label for="pret">Preț:</label>
            <input type="text" name="pret" id="pret">

            <input type="submit" value="Filtrează">
        </form>
    </div>

    <?php
    $servername = "localhost:3307:3307";
    $username = "root";
    $password = "";
    $dbname = "fotbal";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexiunea esuata: " . $conn->connect_error);
    }

    $whereClause = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["nume"])) {
            $nume = $_POST["nume"];
            $whereClause .= " AND Nume LIKE '%$nume%'";
        }

        if (!empty($_POST["pret"])) {
            $pret = $_POST["pret"];
            $whereClause .= " AND Pret LIKE '%$pret%'";
        }
    }

    $sql = "SELECT jucatori.Nume, club.Nume FROM jucatori ON club LEFT JOIN jucatori.Club = club.Nume";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='tabel' >";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<div class='id'>" . $row["Id"] . "</div>"; 
            echo "<h2>" . $row["Nume"] . "</h2>";
            echo "<img src='" . $row["Logo"] . "' alt='Poza'>";
            echo "<p><strong>Jucători:</strong> " . $row["Jucatori"] . "</p>";
            echo "<p><strong>Antrenor:</strong> " . $row["Antrenor"] . "</p>";
            echo "<p><strong>Preț:</strong> " . $row["Pret"] . "</p>";
            echo "<form method='post' action='delClub.php'><input type='hidden' name='Id' value=".$row["Id"]."> <input type='submit' value='Șterge'> </form>";
            echo "<form method='post' action='editClubForm.php'><input type='hidden' name='Id' value=".$row["Id"]."> <input type='submit' value='Modifică'> </form>";
            echo "</div>";
        }  
        echo "</div>";
    } else {
        echo "0 rezultate";
    }

    $conn->close();
    ?>
</body>

</html>
