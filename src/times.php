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

		for ($i=$a; $i<=$b; $i++){
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
		
		$timemax = timemax($n, $list);
		$t = $a;
		for ($i = 0; $i<count($h)*2-2; $i++){
			if (countnb($t, $timemax) >= $slotmax){$red = 'background-color:#ff8800;';}else{$red = '';}
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
		if (participant($uname, $list) >= 0){
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

	function participant($name, $list){
		for ($i=0; $i<count($list); $i++){
			$n = explode(':', $list[$i]);
			if ($n[0] == $name){
				return $i;
			}
		}
		return -1;
	}

	function whattime($name, $list){
		$list2 = [];
		$i = participant($name, $list);
		$n = explode(':', $list[$i]);
		if ($n[0] == $name){
			for ($j=1; $j<count($n); $j++){
				array_push($list2, explode(',', $n[$j]));
			}
			return $list2;
		}
	}

	function timemax($nb, $list){
		$alltimes = '';
		for ($i=0; $i<count($list); $i++){
			if ($list[$i] != ''){
				$n = explode(':', $list[$i]);
				$alltimes .= ','.$n[$nb+1];
			}
		}
		return explode(',', $alltimes);
	}

	function countnb($nb, $list){
		$count = 0;
		for ($i=0; $i<count($list); $i++){
			if ($list[$i] == $nb){
				$count++;
			}
		}
		return $count;
	}
?>
