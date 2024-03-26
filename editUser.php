<!DOCTYPE html>
<html>
<head>
	<title>Editare User</title>
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

		$userId = isset($_GET['id']) ? $_GET['id'] : null;

		$sql="SELECT * FROM users WHERE id = $userId";
		$result=$conn->query($sql);
		$r=$result->fetch_array(MYSQLI_NUM);
	?>
	<form method="post" action="editUserDb.php" enctype="multipart/form-data">
		<input type="hidden" name="id" value=<?php echo $r[0] ?>>
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="username" value=<?php echo $r[1]; ?>></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" name="email" value=<?php echo $r[2]; ?>></td>
			</tr>
            <tr>
				<td>Parola</td>
				<td><input type="password" name="password" value=<?php echo $r[3]; ?>></td>
			</tr>
			<tr>
				<td>
					Selectați imagine pentru a modifica:
				</td>
				<td>
					<img src=<?php echo "\"".$r[4]."\"" ?> width="150px">
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