<!DOCTYPE html>
<html lang="fr">

<?php require "header.php";
require "times.php";
if (!isAdmin()){
	header("Location: /", true, 301);
	die();
}
?>
<head>
	<title>Events - Chocopoly</title>
</head>

<body>
	<?php
	echo "<br>";
	$uname = filter_var($_SESSION['Username'], FILTER_SANITIZE_STRING);
	if(isset($_GET['e'])){
		$ename = filter_var($_GET['e'], FILTER_SANITIZE_STRING);
		
		$query = "SELECT * FROM events WHERE EventId=".$ename." LIMIT 1";
		$result = $conn->query($query);
		$i = 0;

		if ($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
			require_once "autocreate.php";
			$name = $row["Name"];
			$date = $row["Date"];
			// if (!datePassed($date)){
				$maxslot = $row["Maxslot"];
				$people = $row["Participants"];
				$people = json_decode($people, true);
				// var_dump($people);
				$_SESSION['lastpage'] = "./viewevent.php?e=".$ename;
				$ldate = deformat($date,'date');
				$ltime = deformat($date,'time');
				$ppl = [];
				$hr = [];
				echo "Max par slot: ".$maxslot."<br>";
				echo "<h1 class='hache' style='color:rgb(0, 50, 30);'>".$name."</h1><br>";
				$months = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
				for ($i=0; $i<count($ldate); $i++){
					echo "<p class=date>".$ldate[$i][0]." ".$months[(int)$ldate[$i][1]]." ".$ldate[$i][2]."</p><br>";
					// echo "<form method='POST' autocomplete='off'>";
					echo addtimes($ltime[$i][0], $ltime[$i][1], $i, $uname, $people, $maxslot, True);
				}
			// echo "<input type='submit' name='save' value='Enregistrer' class='passbuttonadd'></form>";
			// }else{
			// 	echo "L'événement est déjà terminé.";
			// }
		}
		
		}else{
			echo "No event found.";
		}
	}else{
		echo "No event found.";
	}
?>	

</body>

</html>