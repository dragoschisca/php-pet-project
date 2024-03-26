<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>User</title>
</head>
<body>
    
    <div class="user__div">
    <?php

    $conn = new mysqli("localhost:3307:3307", "root", "", "fotbal");
    session_start();

    if(isset($_SESSION['myid'])) {
        $userId = $_SESSION['myid'];
        
        $query = "SELECT * FROM users WHERE id = $userId";
        $result = mysqli_query($conn, $query);

        if($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            echo "<h1>{$user['username']}</h1>";
            echo "<img src='{$user['Poza']}' class='user__img' alt='Poza'>";
            echo "<p>Email: {$user['email']}</p>";
            echo "<p>Data înregistrării: {$user['Data_crearii']}</p>";
            echo "<div class='buttons'>";
            echo "<a href='editUser.php?id={$user['id']}'><button>Edit info</button></a>";
            echo "<a href='logout.php'><button>Log out</button></a>";
            echo "</div>";
        } else {
            echo "User not found.";
        }
    } else {
        echo "User not logged in.";
    }
    ?>
    </div>

</body>
</html>