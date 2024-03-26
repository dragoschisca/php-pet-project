<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="meci.css">
    <link rel="stylesheet" href="style.css">

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


<div class="match-panel">
    <?php

    function Scor() {
        return rand(0, 5);
    }

    function Timp($n){
        $timpuri = array(0);

        for($f = 1; $f <= $n; $f++)
            $timpuri[$f] = rand(1, 90);

        sort($timpuri);

        return $timpuri;
    }

    $host = "localhost:3307:3307";
    $user = "root";
    $pass = "";
    $dbname = "fotbal";

    try {
        $conn = new mysqli($host, $user, $pass, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT Id, Nume, Logo FROM club");
        $stmt->execute();

        $result = $stmt->get_result();

        class Club
        {
            public $Id;
            public $Nume;
            public $Logo;
            public $marcate = 0;
            public $primite = 0;
            public $puncte = 0;
        }

        $clubs = array();
        while ($row = $result->fetch_assoc()) {
            $club = new Club();
            $club->Id = $row['Id'];
            $club->Nume = $row['Nume'];
            $club->Logo = $row['Logo'];
            $clubs[] = $club;
        }

        function Jucator($numeClub) {
            global $conn;
            $stmt = $conn->prepare("SELECT Id, Nume, Prenume FROM jucatori WHERE Club = ? AND Pozitia  != 'Portar' ORDER BY RAND()");
            $stmt->bind_param("s", $numeClub);
            $stmt->execute();

            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $stmt->close();
                return "{$row['Nume']}";
            } else {
                $stmt->close();
                return "N/A";
            }
        }

        echo "<div class='column__games'>";

        for($x = 1; $x <= 2; $x++) {
            echo "<h1>Turul {$x} a fost disputat cu succes!</h1> <br>";
        for($c = 0; $c < count($clubs)-1; $c++) {
            for($next = $c+1; $next < count($clubs); $next++){

                if($clubs[$c]->Id == $clubs[$next]->Id ) break;
                else{
                    echo "<div class='row__game'>";
                
                    echo "<div class='match-card'>";
                    echo "<img src='{$clubs[$c]->Logo}' alt='{$clubs[$c]->Nume}' class='team-logo'>";
                    echo "<p>{$clubs[$c]->Nume}</p>";
                    echo "</div>";
                
                    if ($c + 1 < count($clubs)) {
                
                        $scor1 = Scor();
                        $scor2 = Scor();
                
                        echo "<div class='vs'>";
                            echo "<div class='echipa1'>";
                            echo "<h1>{$scor1}</h1>";
                            $arr1 = Timp($scor1);
                            for ($j = 1; $j <= $scor1; $j++)
                                echo "<p class='grey'>" . Jucator($clubs[$c]->Nume) . " {$arr1[$j]}</p>";
                            echo "</div>";
                
                            echo "<h1>:</h1>";
                
                            echo "<div class='echipa1'>";
                            echo "<h1>{$scor2}</h1>";
                            $arr2 = Timp($scor2);
                            for ($k = 1; $k <= $scor2; $k++)
                                echo "<p class='grey'>" . Jucator($clubs[$next]->Nume) . " {$arr2[$k]}</p>";
                            echo "</div>";
                        echo "</div>";
                
                        echo "<div class='match-card'>";
                        echo "<img src='{$clubs[$next]->Logo}' alt='{$clubs[$next]->Nume}' class='team-logo'>";
                        echo "<p>{$clubs[$next]->Nume}</p>";
                        echo "</div>";
                    }
        
                    $clubs[$c]->marcate += $scor1;
                    $clubs[$c]->primite += $scor2;
        
                    $clubs[$next]->marcate += $scor2;
                    $clubs[$next]->primite += $scor1;
                
                    if($scor1 > $scor2){
                        $clubs[$c]->puncte += 3;
                    }else if($scor1 < $scor2){
                        $clubs[$next]->puncte += 3;
                    } else{
                        $clubs[$c]->puncte += 1;
                        $clubs[$next]->puncte += 1;
                    }
        
                    echo "</div>";
                }
            }
        }
    }
        

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    echo "</div>";

    usort($clubs, function ($a, $b) {
        return $b->puncte - $a->puncte;
    });

    echo "<table>";
    echo "<thead><tr><th>Poziție</th><th>Club</th><th>Gol marcate</th><th>Gol primite</th><th>Puncte</th></tr></thead>";
        echo "<tbody>";

        for ($i = 0; $i < count($clubs); $i++) {
            echo "<tr>";
            echo "<td>" . ($i + 1) . "</td>";
            echo "<td>{$clubs[$i]->Nume}</td>";
            echo "<td>{$clubs[$i]->marcate}</td>";
            echo "<td>{$clubs[$i]->primite}</td>";
            echo "<td>{$clubs[$i]->puncte}</td>";
            echo "</tr>";
        }

        echo "</tbody>";
    echo "</table>";

    ?>
</div>

</body>
</html>
