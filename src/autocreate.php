<?php
	function createEvent($name,$dates,$maxslot){
		require "dbconn.php";
		if (checkdates($dates, 'all')){
			$name = filter_var($name, FILTER_SANITIZE_STRING);
			$maxslot = filter_var($maxslot, FILTER_SANITIZE_STRING);
			$sql = "INSERT INTO events (Name, Date, PseudoDate, Maxslot) VALUES ('".$name."', '".$dates."', '".pseudoDate($dates, 0)."', '".$maxslot."')";
			$result = mysqli_query($conn, $sql);

			$query = "SELECT EventId FROM events ORDER BY EventId DESC";
			$result = $conn->query($query);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$eventid = $row['EventId'];
					$link = "https://staff.chocopoly.ch/viewevent.php?e=".$eventid;
					return json_encode(array("link"=>$link));
				}
			}
		}else{
			return json_encode(array("link"=>"Erreur"));
		}
	}

	function modifyEvent($id, $name, $dates, $maxslot){
		require "dbconn.php";
		if (checkdates($dates, 'all')){
			$name = filter_var($name, FILTER_SANITIZE_STRING);
			$maxslot = filter_var($maxslot, FILTER_SANITIZE_STRING);
			if (isset($name)){
				$sql = "UPDATE events SET Name='".$name."' WHERE EventId='".$id."'";
				$result = mysqli_query($conn, $sql);
			}
			if (isset($dates)){
				$sql = "UPDATE events SET Date='".$dates."', PseudoDate='".pseudoDate($dates, 0)."' WHERE EventId='".$id."'";
				$result = mysqli_query($conn, $sql);
			}
			if (isset($maxslot)){
				$sql = "UPDATE events SET Maxslot='".$maxslot."' WHERE EventId='".$id."'";
				$result = mysqli_query($conn, $sql);
			}

			$link = "https://staff.chocopoly.ch/viewevent.php?e=".$id;
			return json_encode(array("link"=>$link));
		}else{
			return json_encode(array("link"=>"Erreur"));
		}
	}

	function checkdates($dates, $what){
		$dates = json_decode($dates, true);
		if ($what != 'date'){
			foreach ($dates as $key => $value) {
				$d = explode('-', $value);
				for ($i=0; $i<2; $i++){
					if ($d[$i] < 0 || $d[$i] >= 24){
						return False;
					}
					if (($d[$i]*10)%5 != 0 || ($d[$i]*10)%5 != 0){
						return False;
					}
				}
				if (!($d[1] > $d[0])){
					return False;
				}
			}
		}
		if ($what != 'time'){
			foreach ($dates as $key => $value) {
				$d = explode('-', $key);
				if (!checkdate($d[1],$d[0],$d[2])){
					return False;
				}
			}
		}
		if ($what == 'time' || $what == 'date' || $what == 'all'){
			return True;
		}else{
			return False;
		}
	}

	function deformat($dates, $what){
		$dates = json_decode($dates);
		$export = array();
		foreach ($dates as $key => $value) {
			if ($what == 'time'){
				$d = explode('-', $value);
			}else if ($what == 'date'){
					$d = explode('-', $key);
			}
			array_push($export, $d);
		}
		return $export;
	}

	function datestring($dates){
		$dates = json_decode($dates);
		$text = "";
		foreach ($dates as $key => $value) {
			$d = str_replace('-', '.', $key);
			if ($text != ""){
				$text .= ", ";
			}
			$text .= $d;
		}
		return $text;
	}

	function pseudoDate($date2, $i){
		$d = json_decode($date2, true);
		$pseudo = '';
		foreach ($d as $key => $value) {
			$date = explode('-',$key);
			for ($k=2; $k>=0; $k-=1){
				$pseudo .= $date[$k];
			}

			$time = explode('-',$value);
			if ($time[0]*10 < 100){
				$pseudo .= '0'.$time[0]*10;
			}else{
				$pseudo .= $time[0]*10;
			}
			return $pseudo;
		}
	}

	function datePassed($d){
		$date = json_decode($d,true);
		return (time() - 86400 >= strtotime(array_key_last($date)));
	}
?>