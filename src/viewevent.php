<!DOCTYPE html>
<html lang="fr">

<?php require "header.php";
require "times.php"; ?>

<head>
	<title>Events - Chocopoly</title>
</head>

<body onmouseup='munclick()'>
	<?php
	echo "<br>";
	$uname = filter_var($_SESSION['Username'], FILTER_SANITIZE_STRING);
	if(isset($_GET['e'])){
		$ename = $_GET['e'];
		
		$query = "SELECT * FROM events WHERE EventId=".$ename." LIMIT 1";
		$result = $conn->query($query);
		$i = 0;

		if ($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
			require_once "autocreate.php";
			$name = $row["Name"];
			$date = $row["Date"];
			if (!datePassed($date)){
				$maxslot = $row["Maxslot"];
				$people = $row["Participants"];
				$people = json_decode($people, true);
				// var_dump($people);
				$_SESSION['lastpage'] = "./viewevent.php?e=".$ename;
				$ldate = deformat($date,'date');
				$ltime = deformat($date,'time');
				$ppl = [];
				$hr = [];
				echo "<h1 class='hache'>".$name."</h1><br>";
				$months = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
				for ($i=0; $i<count($ldate); $i++){
					echo "".$ldate[$i][0]." ".$months[(int)$ldate[$i][1]]." ".$ldate[$i][2]."<br>";
					echo "<form method='POST' autocomplete='off'>";
					echo addtimes($ltime[$i][0], $ltime[$i][1], $i, $uname, $people, $maxslot);
				}
			echo "<input type='submit' name='save' value='Enregistrer' class='passbuttonadd'></form>";
			}else{
				echo "L'événement est déjà terminé.";
			}
		}
		
		}else{
			echo "No event found.";
		}
	}else{
		echo "No event found.";
	}

	if (isset($_POST['save'])){
		if (isset($_SESSION['Username'])){
			$query = "SELECT * FROM events WHERE EventId=".$ename." LIMIT 1";
			$result = $conn->query($query);
			while($row = $result->fetch_assoc()) {
				$people = $row["Participants"];
			}
			$people = json_decode($people, true);
			// Alamogus:7,7.5,8,8.5:7,8.5,9;Mogusa:8,8.5,9
			$uname = filter_var($_SESSION['Username'], FILTER_SANITIZE_STRING);

			if (participant($uname, $people)){
				unset($people[$uname]);
				// print_r($people);
			}
			
				// $ppl2 = '';
				// if ($people != ''){
				// 	$ppl2 = ';';
				// }
				$lhour = array();
				for ($i=0; $i<count($ldate); $i++){
					$phour = filter_var($_POST['heures-'.$i], FILTER_SANITIZE_STRING);
					$lhour2 = explode(',',$phour);
					array_push($lhour, $lhour2);
					// $ppl2 .= ':'.$phour;
					// $hours .= $phour;
				}

				if (!emptyLists($lhour)){
					$people[$uname] = $lhour;
				}
				// print_r($people);
				// al('a');
				$people = json_encode($people);
				// if ($hours != ''){
				// 	$people .= $ppl2;
				// }
				$ename = filter_var($ename, FILTER_SANITIZE_STRING);
				$sql = "UPDATE events SET Participants = '".$people."' WHERE EventId = '".$ename."';";
				$result = mysqli_query($conn, $sql);
				echo "<script type='text/JavaScript'>window.location.replace('./viewevent.php?e=".$ename."');</script>";

		}else{
			$_SESSION['lastpage'] = "./viewevent.php?e=".$ename;
			echo "<script type='text/JavaScript'>window.location.replace('./setname.php');</script>";
		}
	}
	?>	

</body>

</html>