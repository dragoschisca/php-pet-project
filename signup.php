<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="style.css">
    <title>Autentificare</title>
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

    <form action="data.php" method="post" enctype="multipart/form-data">
        <br> <br>
        <input type="text" name="username" placeholder="Username"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="pass" placeholder="Parola"><br>
        <input type="submit" name="submit" value="user">
    </form>
</body>
</html>