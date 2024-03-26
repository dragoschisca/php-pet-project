<?php
$host="localhost:3307";
$user="root";
$pas="";
$dbname="fotbal";
if($_FILES["fileToUpload"]["name"]!="")
{
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "Fișierul este o imagine - " . $check["mime"] . ".<br>";
    $uploadOk = 1;
  } else {
    echo "Fișierul nu este o imagine.<br>";
    $uploadOk = 0;
  }
}


if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Scuze, fișierul dvs. este prea mare.<br>";
  $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Scuze, numai fișierele de tipul JPG, JPEG, PNG & GIF sunt accesibile.<br>";
  $uploadOk = 0;
}
if ($uploadOk == 0) {
  echo "Scuze, fișierul dvs. nu a fost încărcat pe server.<br>";
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    try
	{
		$conn=new mysqli($host,$user,$pas,$dbname);
		echo "Conexiunea este reușită<br>";
		$sql="UPDATE club SET Nume='".$_POST['nume']."', Jucatori='".$_POST['jucatori']."', Antrenor='".$_POST['antrenor']."', Pret=".$_POST['pret'].", Logo='".$target_file."' WHERE Id=".$_POST["Id"];
		$conn->query($sql);
		echo "Datele clubului au fost modificate cu succes<br>";
		$conn->close();
	}
	catch(Exception $error)
	{
		echo $error->getMessage();
	}
  } else {
    echo "Scuze, a apărut o eroare la încărcarea fișierului dvs pe server.<br>";
  }
}
}	
else
{
  try
  {
    $conn=new mysqli($host,$user,$pas,$dbname);
    echo "Conexiunea este reușită<br>";
    $sql="UPDATE club SET Nume='".$_POST['nume']."', Jucatori='".$_POST['jucatori']."', Antrenor='".$_POST['antrenor']."', Pret='".$_POST['pret']."'";
    
    if (!empty($target_file)) {
      $sql .= ", Logo='".$target_file."'";
  }
  
    $sql .= " WHERE Id=".$_POST["Id"];
    $conn->query($sql);
    $conn->close();
  }
  catch(Exception $error)
  {
    echo $error->getMessage();
  }

}
header("Location: displayClub.php");	
?>