<?php
	function createEvent($name,$dates,$maxslot){
		require "dbconn.php";
		if (checkdates(deformat($dates, 'date')) && checktimes(deformat($dates, 'time'))){
			$name = filter_var($name, FILTER_SANITIZE_STRING);
			$maxslot = filter_var($maxslot, FILTER_SANITIZE_STRING);
			$dates = str_replace("'", "",$dates);
			$dates = filter_var($dates, FILTER_SANITIZE_STRING);
			$sql = "INSERT INTO events (Name, Date, Maxslot) VALUES ('".$name."', '".$dates."', '".$maxslot."')";
			$result = mysqli_query($conn, $sql);
			return $result;
			// echo "<script type='text/JavaScript'>window.location.replace('./');</script>";
		}else{
			return "Erreur";
		}
	}

	function checkdates($dates){
		for ($i=0; $i<count($dates); $i++){
			if (!checkdate($dates[$i][1],$dates[$i][0],$dates[$i][2])){
				return False;
			}
		}
		return True;
	}

	function checktimes($times){
		for ($i=0; $i<count($times); $i++){
			for ($j=0; $j<=1; $j++){
				if ($times[$i][$j] < 0 || $times[$i][$j] >= 24){
					return False;
				}
				if (($times[$i][$j]*10)%5 != 0 || ($times[$i][$j]*10)%5 != 0){
					return False;
				}
			}
		}
		return True;
	}

	function deformat($dates, $what){
		$dates = explode(',', $dates);
		$newdates = [];
		for ($i=0; $i<count($dates); $i++){
			$newdates[$i] = explode(':',$dates[$i]);
		}
		$symbols = array("'", "{", "}");
		for ($i=0; $i<count($newdates); $i++){
			for ($j=0; $j<=1; $j++){
				for ($k=0; $k<count($symbols); $k++){
					$newdates[$i][$j] = str_replace($symbols[$k],"",$newdates[$i][$j]);
				}
			}
		}
		$export = [];
		if ($what == 'time'){
			$nb = 1;
		}else{
			$nb = 0;
		}
		for ($i=0; $i<count($newdates); $i++){
			$export[$i] = explode('-',$newdates[$i][$nb]);
		}
		return $export;
	}

	function datestring($dates, $what){
		$list = deformat($dates, $what);
		$text = "";
		for ($i=0; $i<count($list); $i++){
			if ($text != ""){
				$text .= ", ";
			}
			$text .= $list[$i][0].".".$list[$i][1].".".$list[$i][2];
		}
		return $text;
	}
?>