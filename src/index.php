<!DOCTYPE html>
<html lang="fr">

<?php require "header.php"; require "times.php"; ?>

<head>
	<title>Events - Chocopoly</title>
</head>

<body>
	<?php

	$months = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

	$query = "SELECT * FROM events ORDER BY Date DESC";
	$result = $conn->query($query);
	$i = 0;
	$uname = filter_var($_SESSION['Username'], FILTER_SANITIZE_STRING);

	if ($result->num_rows >= 0) {

		echo"<div id='box'>";
		echo"<svg width='600', height='".($result->num_rows*150 + 50)."'>";
		echo"<rect width='600' height='".($result->num_rows*150 + 50)."' rx='20' ry='20' x='0' y='0' rx='0' ry='0' fill='rgb(180, 0, 0)' />";
		// echo"<a href='./addevent.php'><rect width='200' height='50' rx='10' ry='10' x='200' y='20' fill='rgb(100, 6, 6)' />";
		// echo"<text x='260' y='50' class='h1' fill='rgb(255, 255, 255)'>Add Event</text></a>";
	
	while($row = $result->fetch_assoc()) {
		require_once "autocreate.php";
		$eid = $row["EventId"];
		$name = $row["Name"];
		$date = $row["Date"];
		$part = json_decode($row["Participants"], true);
		echo "<a href='./viewevent.php?e=".$eid."'><svg>";
		echo "<rect width='500' height='100' rx='20' ry='20' x='55' y='".(55 + $i*150)."' fill='rgb(100, 0, 0)' />";
		echo "<rect width='500' height='100' rx='20' ry='20' x='50' y='".(50 + $i*150)."' fill='rgb(255, 255, 255)' />";
		echo "<text x='75' y='".(110 + $i*150)."' class='hache'>".$name."</text>";
		echo "<text x='75' y='".(130 + $i*150)."' class='h2'>".datestring($date)."</text>";
		echo"<circle cx='500' cy='".(100 + $i*150)."' r='30' style='fill:#cccccc'/>";
		if (participant($uname, $part)){
			echo"<circle cx='500' cy='".(100 + $i*150)."' r='25' style='fill:#00ff00'/>";
		}
		echo "</svg></a>";
		$i++;
	}
	}
	echo"</svg>";
	echo"</div>";
	
	?>	

</body>

</html>