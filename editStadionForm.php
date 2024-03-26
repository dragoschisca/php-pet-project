<!DOCTYPE html>
<html>
<head>
	<title>Editare stadion</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="form.css">

</head>
<body>
	<?php
		$host="localhost:3307";
		$user="root";
		$pas="";
		$dbname="fotbal";
		$conn= new mysqli($host,$user,$pas,$dbname);
		$sql="SELECT * FROM stadion WHERE Id = ".$_POST['Id'];
		$result=$conn->query($sql);
		$r=$result->fetch_array(MYSQLI_NUM);
	?>
	<form method="post" action="editStadionDb.php" enctype="multipart/form-data">
		<input type="hidden" name="Id" value=<?php echo $r[0] ?>>
		<table>
			<tr>
				<td>Nume</td>
				<td><input type="text" name="nume" value=<?php echo $r[1]; ?>></td>
			</tr>
			<tr>
				<td>Adresa</td>
				<td><input type="text" name="adresa" value=<?php echo $r[2]; ?>></td>
			</tr>
			<tr>
				<td>Capacitate</td>
				<td><input type="text" name="capacitate" value=<?php echo $r[3]; ?>></td>
			</tr>
			<tr>
				<td>Echipa</td>
				<td><input type="text" name="echipa" value=<?php echo $r[4]; ?>></td>
			</tr>
			<tr>
				<td>
					Selectați imagine pentru a modifica:
				</td>
				<td>
					<img src=<?php echo "\"".$r[5]."\"" ?> width="150px">
					<input type="file" name="fileToUpload">
				</td>
			</tr>
			<tr>
				<?php $conn->close(); ?>
				<td colspan="2"><input type="submit" value="Inserare"></td>
			</tr>
		</table>
	</form>
</body>
</html>