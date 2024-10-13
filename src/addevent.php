<!DOCTYPE html>
<html lang="fr">

<?php require "header.php";
require "times.php"; ?>

<head>
	<title>Events - Chocopoly</title>
</head>

<body onmouseup='munclick()'>
	<h2>Add Event</h2>
	<br>
	<form method='POST' autocomplete='off'>
	<label for="eventname" class="passlabel">Nom de l'évènement</label><br>
	<input type="text" name="eventname" class="passinput" required><br><br>
	
	<label for="date" class="passlabel">Date</label><br>

	<?php
		echo "<select class='passbutton' name='day'>";
		echo "<option value='0' selected></option>";
		for ($j=1; $j<=31; $j++){
			echo"<option value='".$j."'";
			echo ">".$j."</option>";
		}
	echo "</select>";
	
	echo "<select class='passbutton' name='month'>";
		$months = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
		echo "<option value='0' selected></option>";
		for ($j=1; $j<=12; $j++){
			echo"<option value='".$j."'";
			echo ">".$months[$j]."</option>";
		}
	echo "</select>";
	
	echo "<select class='passbutton' name='year'>";
		for ($j=2024; $j>=2023; $j-=1){
			echo"<option value='".$j."'";
			echo ">".$j."</option>";
		}
	echo "</select><br>";

	?>

	<label for="heuredebut" class="passlabel">Heure de début</label><br>

	<?php addtimes(7, 20); ?>

	<input type="submit" name="submit" value="Ajouter" class="passbutton">
	</form>

	<?php

	if (isset($_POST['submit'])){
		$dateformat = filter_var($_POST["year"]."-".$_POST["month"]."-".$_POST["day"], FILTER_SANITIZE_STRING);
		$eventname = filter_var($_POST["eventname"], FILTER_SANITIZE_STRING);
		$eventhours = filter_var($_POST["heures"], FILTER_SANITIZE_STRING);
		$sql = "INSERT INTO events (Name, Date, Heures) VALUES ('".$eventname."', '".($dateformat)."', '".($eventhours)."')";
		$result = mysqli_query($conn, $sql);			
		echo "<script type='text/JavaScript'>window.location.replace('./');</script>";
	}

	?>

</body>

</html>