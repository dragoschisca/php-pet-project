<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ligi</title>
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
        <h1>Ligi</h1>
        <a href="liga.html"><p>Create new</p></a>

        <form method="post" action="">
            
            <label for="nume">Nume:</label>
            <input type="text" name="nume" id="nume">

            <label for="tara">Țara:</label>
            <input type="text" name="tara" id="tara">

            <input type="submit" value="Filtrează">
        </form>
    </div>

    <?php
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "fotbal";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexiunea esuata: " . $conn->connect_error);
    }

    $whereClause = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["tara"])) {
            $tara = $_POST["tara"];
            $whereClause .= " AND Tara LIKE '%$tara%'";
        }

        if (!empty($_POST["nume"])) {
            $nume = $_POST["nume"];
            $whereClause .= " AND Nume LIKE '%$nume%'";
        }
    }

    $sql = "SELECT * FROM liga WHERE 1 $whereClause";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='tabel' >";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<div class='id'>" . $row["Id"] . "</div>"; 
            echo "<h2>" . $row["Nume"] . "</h2>";
            echo "<img src='" . $row["Logo"] . "' alt='Poza'>";
            echo "<p><strong>Țara:</strong> " . $row["Tara"] . "</p>";
            echo "<p><strong>Numărul de echipe:</strong> " . $row["Nr_Echipe"] . "</p>";
            echo "<p><strong>Lider:</strong> " . $row["Lider"] . "</p>";
            echo "<form method='post' action='delLiga.php'><input type='hidden' name='Id' value=".$row["Id"]."> <input type='submit' value='Șterge'> </form>";
            echo "<form method='post' action='editLigaForm.php'><input type='hidden' name='Id' value=".$row["Id"]."> <input type='submit' value='Modifică'> </form>";
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
