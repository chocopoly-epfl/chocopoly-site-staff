<!DOCTYPE html>
<html lang="fr">

<?php require "header.php"; ?>

<head>
	<title>Setname - Chocopoly</title>
</head>

<body>
	<?php
	echo "<br>";
		echo "<br><br><form method='POST' autocomplete='off'>
		<label for='name' class='passlabel'>Votre nom</label><br>";

		if (isset($_SESSION['Username'])){
			$uname = $_SESSION['Username'];
		}else{
			$uname = '';
		}
		echo "<input type='text' name='name' class='passinput' value='".$uname."'><br>";
		
		echo "<input type='submit' name='submit' value='Soumettre' class='passbutton'>
		</form>";


	if (isset($_POST['submit'])){
		if (isset($_POST['name']) && $_POST['name'] != ''){
			$_SESSION['Username'] = strtolower(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
		}else{
			unset($_SESSION['Username']);
		}
		echo "<script type='text/JavaScript'>window.location.replace('".$_SESSION['lastpage']."');</script>";
		unset($_SESSION['lastpage']);
	}

	?>	

</body>

</html>