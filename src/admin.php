<?php 

require "header.php"; require "times.php";
if (!isAdmin()){
	header("Location: /", true, 301);
	die();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<title>PAGE ADMIN - Chocopoly</title>
</head>

<body>
	<?php

	echo "<br><h2>PAGE ADMIN</h2>";
	$months = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

	$query = "SELECT * FROM events ORDER BY PseudoDate DESC";
	$result = $conn->query($query);
	$i = 0;
	$uname = filter_var($_SESSION['Username'], FILTER_SANITIZE_STRING);
	
	if (isset($_GET['e'])){$events = True;}else{$events = False;}
	
	if ($result->num_rows >= 0) {
		
		while($row = $result->fetch_assoc()) {
			require_once "autocreate.php";
			$date = $row["Date"];
			if (!datePassed($date) || $events){
				$i++;
			}
		}
		
		echo"<div id='box'>";
		if ($i > 0){
			echo"<svg width='600', height='".($i*150 + 50)."'>";
			echo"<rect width='600' height='".($i*150 + 50)."' rx='20' ry='20' x='0' y='0' rx='0' ry='0' fill='rgb(0, 133, 80)' />";
		}else{
			echo "Aucun événement en ce moment.";
		}
		// echo"<a href='./addevent.php'><rect width='200' height='50' rx='10' ry='10' x='200' y='20' fill='rgb(100, 6, 6)' />";
		// echo"<text x='260' y='50' class='h1' fill='rgb(255, 255, 255)'>Add Event</text></a>";
		
		$query = "SELECT * FROM events ORDER BY PseudoDate DESC";
		$result = $conn->query($query);
		$i = 0;
		while($row = $result->fetch_assoc()) {
			require_once "autocreate.php";
			$eid = $row["EventId"];
			$name = $row["Name"];
			$date = $row["Date"];
			if (!datePassed($date) || $events){
				$part = json_decode($row["Participants"], true);

				// $sql = "UPDATE events SET PseudoDate='".pseudoDate($date, 0)."' WHERE EventId='".$eid."'";
				// $result2 = mysqli_query($conn, $sql);
		
				echo "<a href='./adminview.php?e=".$eid."'><svg>";
				echo "<rect width='500' height='100' class='svgrect' x='55' y='".(55 + $i*150)."' fill='rgb(0, 72, 43)' />";
				echo "<rect width='500' height='100' class='svgrect' x='50' y='".(50 + $i*150)."' fill='rgb(255, 255, 255)' />";
				echo "<text x='75' y='".(110 + $i*150)."' class='hache' style='fill:rgb(0, 50, 30)'>".$name."</text>";
				echo "<text x='75' y='".(130 + $i*150)."' class='h2'>".datestring($date)."</text>";
				echo"<circle cx='500' cy='".(100 + $i*150)."' r='30' style='fill:#cccccc'/>";
				if (participant($uname, $part)){
					echo"<circle cx='500' cy='".(100 + $i*150)."' r='25' style='fill:#00ff00'/>";
				}
				echo "</svg></a>";
				$i++;
			}
	}
	}
	echo"</svg>";
	if (!isset($_GET['e'])){
		echo "<br><br><a href='./admin.php?e=all'>Voir tous les events</a><br><br>";
	}else{
		echo "<br><br><a href='./admin.php'>Voir moins</a><br><br>";
	}
	echo"</div>";
		
	?>	

</body>

</html>