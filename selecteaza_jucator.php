<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Selectează Jucător</title>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pozitie'])) {
        $pozitie = $_GET['pozitie'];

        $servername = "localhost:3307:3307";
        $username = "root";
        $password = "";
        $dbname = "fotbal";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT * FROM jucatori";
        $result = $conn->query($query);

        echo "<h2>Selectează jucătorul pentru poziția $pozitie</h2>";
        echo "<form action='proceseaza_selectie.php' method='post'>";
        echo "<input type='hidden' name='pozitie' value='$pozitie'>";
        echo "<select name='jucator'>";
        
        while ($row = $result->fetch_assoc()) {
            $jucatorId = $row['Id'];
            $nume = $row['Nume'];
            $prenume = $row['Prenume'];
            $p = $row['Pozitia'];

            if($pozitie == 1 && $p == 'Portar'){
                echo "<option value='$jucatorId'>$prenume $nume</option>";
            }

            if($pozitie > 1 && $pozitie < 6 && $p == 'Fundas'){
                echo "<option value='$jucatorId'>$prenume $nume</option>";
            }

            if($pozitie > 5 && $pozitie < 9 && $p == 'Mijlocas'){
                echo "<option value='$jucatorId'>$prenume $nume</option>";
            }

            if($pozitie > 8 && $pozitie < 12 && $p == 'Atacant'){
                echo "<option value='$jucatorId'>$prenume $nume</option>";
            }
        }

        echo "</select>";
        echo "<input type='submit' value='Selectează'>";
        echo "</form>";

        $conn->close();
    } else {
        echo "Eroare: Poziție lipsă.";
    }
    ?>
</body>
</html>
