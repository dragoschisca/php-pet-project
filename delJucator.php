<?php
	$host="localhost:3307";
	$user="root";
	$pas="";
	$dbname="fotbal";
	$conn=new mysqli($host,$user,$pas,$dbname);
	$sql="DELETE FROM jucatori WHERE Id=".$_POST['Id'];
	$conn->query($sql);
	$conn->close();
	header("Location: displayJucator.php");
?>