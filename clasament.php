<?php

// ...

// După afișarea meciurilor, adaugă codul pentru clasament

echo "<h2>Clasament</h2>";
$createTableQuery = "CREATE TABLE IF NOT EXISTS `clasament` (
    `Id` int(11) AUTO_INCREMENT PRIMARY KEY,
    `NumeEchipa` varchar(40) NOT NULL,
    `Puncte` int(11) NOT NULL
)";

$conn->query($createTableQuery);
foreach ($clubs as $club) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS NumarMeciuri, SUM(Puncte) AS TotalPuncte FROM meciuri WHERE (Echipa1 = ? OR Echipa2 = ?) AND Terminat = 1");
    $stmt->bind_param("ss", $club->Nume, $club->Nume);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $numarMeciuri = $row['NumarMeciuri'];
        $totalPuncte = $row['TotalPuncte'];

        $punctaj = ($numarMeciuri > 0) ? round($totalPuncte / $numarMeciuri, 2) : 0;

        $stmt = $conn->prepare("INSERT INTO clasament (NumeEchipa, Puncte) VALUES (?, ?) ON DUPLICATE KEY UPDATE Puncte = ?");
        $stmt->bind_param("sdd", $club->Nume, $punctaj, $punctaj);
        $stmt->execute();
    }
    $stmt->close();
}

$result = $conn->query("SELECT NumeEchipa, Puncte FROM clasament ORDER BY Puncte DESC");
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Pozitie</th><th>Echipa</th><th>Puncte</th></tr>";
    $pozitie = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$pozitie}</td>";
        echo "<td>{$row['NumeEchipa']}</td>";
        echo "<td>{$row['Puncte']}</td>";
        echo "</tr>";
        $pozitie++;
    }
    echo "</table>";
} else {
    echo "Nu există date în clasament.";
}

// ...

?>
