<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Antrenori</title>
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
        <h1>Antrenori</h1>
        <a href="antrenori.html"><p>Create new</p></a>

        <form method="post" action="">
            <label for="certificare">Certificare:</label>
            <input type="text" name="certificare" id="certificare">

            <label for="nume">Nume:</label>
            <input type="text" name="nume" id="nume">

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
        if (!empty($_POST["certificare"])) {
            $certificare = $_POST["certificare"];
            $whereClause .= " AND Certificare LIKE '%$certificare%'";
        }

        if (!empty($_POST["nume"])) {
            $nume = $_POST["nume"];
            $whereClause .= " AND Nume LIKE '%$nume%'";
        }
    }

    $sql = "SELECT * FROM antrenori WHERE 1 $whereClause";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='tabel' >";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<div class='id'>" . $row["Id"] . "</div>"; 
            echo "<h2>" . $row["Prenume"] . " " . $row["Nume"] . "</h2>";
            echo "<img src='" . $row["Poza"] . "' alt='Poza'>";
            echo "<p><strong>Club:</strong> " . $row["Club"] . "</p>";
            echo "<p><strong>Certificare:</strong> " . $row["Certificare"] . "</p>";
            echo "<p><strong>Varsta:</strong> " . $row["Varsta"] . "</p>";
            echo "<form method='post' action='delAntrenor.php'><input type='hidden' name='Id' value=".$row["Id"]."> <input type='submit' value='Șterge'> </form>";
            echo "<form method='post' action='editAntrenorForm.php'><input type='hidden' name='Id' value=".$row["Id"]."> <input type='submit' value='Modifică'> </form>";
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
