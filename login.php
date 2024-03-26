<!DOCTYPE html>
<html>
<head>
	<title>Autentificare</title>
	<link rel="stylesheet" href="input.css">
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

<form method="post">
	<br><br>
	<input type="text" name="user_name" placeholder="Nume utilizator"><br>
	<input type="password" name="user_pas" placeholder="Parola"><br>
	<input type="submit" name="btn_auth" value="Autentificare">
</form>
<?php
	if(isset($_POST["btn_auth"]))
	{
		$host="localhost:3307:3307";
		$user="root";
		$pas="";
		$db="fotbal";
		$conn= new mysqli($host,$user,$pas,$db);
		$sql="SELECT id FROM users WHERE username='".$_POST['user_name']."' AND password='".$_POST['user_pas']."'";
		$result=$conn->query($sql);
		if($conn->affected_rows==0) echo "Autentificarea esuata";
		else {
		$row=$result->fetch_assoc();
		session_start();
		$_SESSION["myid"]=$row['id'];
		$conn->close();
		header("Location: index.html");
	}
	}
?>
</body>
</html>