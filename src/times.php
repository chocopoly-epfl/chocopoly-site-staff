<script src='./times.js'></script>

<?php
	function addtimes($a, $b, $n, $uname, $list, $slotmax){
		$h = [];
		$a2 = False;
		if (!filter_var($a, FILTER_VALIDATE_INT)){
			$a = $a - 0.5;
			$a2 = True;
		}
		$b2 = False;
		if (!filter_var($b, FILTER_VALIDATE_INT)){
			$b = $b + 0.5;
			$b2 = True;
		}
		// echo $a."-".$b;

		for ($i=(int)$a; $i<=$b; $i++){
			array_push($h, $i);
		}

		$style = 'border-top: 1px solid black;border-bottom: 1px solid black;padding: 20px;padding-top: 40px;';
		echo "<table>";
		echo "<tr>";
		for ($i = 0; $i<count($h); $i++){
			echo "<td colspan='2'>".$h[$i]."h</td>";
		}
		echo "</tr>";
		echo "<tr>";
		echo "<td class='sp2' style='border-right: 1px solid black;'></td>";

		$timemax = timemax($a, $b, $n, $list);
		$t = $a;
		for ($i = 0; $i<count($h)*2-2; $i++){
			if ($timemax[$i] >= $slotmax){$red = 'background-color:#ff8800;';}else{$red = '';}
			echo "<td class='sp2' colspan='1' style='";
			if ($i % 2 != 0){
				echo "border-right: 1px solid black;";
			}
			echo $red."'></td>";
			$t += 0.5;
		}
		echo "<td class='sp2'></td>";
		echo "</tr>";
		echo "<tr class='unselectable'>";
		echo "<td class='sp'></td>";
		if (participant($uname, $list)){
			$times = whattime($uname, $list);
		}else{
			$times = [[],[],[],[],[]];
		}
		for ($i = 0; $i<count($h)*2-2; $i++){
			$nb = $i/2+$a;
			if (($a2 && $nb == $a) || ($b2 && $nb == $b -0.5)){
				echo "<td style='".$style."background-color:rgb(255, 229, 142);'></td>";
			}else{
				// print_r($times);
				if (in_array($nb, $times[$n])){
					$cl = 'yes';
				}else{
					$cl = 'not';
				}
				echo "<td class='".$cl."' onmousedown='mclick(".$i.",".$n.")' onmouseenter='mhover(".$i.")' data-time='".$nb."' id='".$i."-".$n."' style='".$style."'></td>";
			}
		}
		echo "<td class='sp'></td>";
		echo "</tr>";
		echo "</table>";
		echo "<div id='result-".$n."' class='errormessage'></div><br>";
		echo "<form method='POST' autocomplete='off'><span id='heures-".$n."'><input type='hidden' value='".implode(',', $times[$n])."' name='heures-".$n."'></span>";
	
	}

	function participant2($name, $list){
		for ($i=0; $i<count($list); $i++){
			$n = explode(':', $list[$i]);
			if ($n[0] == $name){
				return $i;
			}
		}
		return -1;
	}

	function participant($name, $list){
		if (isset($list[$name])){
			return True;
		}
		return False;
	}

	function al($text){
		echo "<script type='text/JavaScript'>alert('".$text."');</script>";
	}

	function whattime($name, $list){
		if (isset($list[$name])){
			return $list[$name];
		}
	}

	function timemax($a, $b, $nb, $list){
		$alltimes = array();
		for ($i = $a; $i<=$b; $i+=0.5){
			$n = 0;
			if ($list != []){
				foreach ($list as $l){
					if (in_array($i, $l[$nb])){
						$n++;
					}
				}
			}
			array_push($alltimes, $n);
		}
		return $alltimes;
	}

	function emptyLists($list){
		foreach ($list as $l){
			if ($l != [""]){
				return False;
			}
		}
		return True;
	}
?>
