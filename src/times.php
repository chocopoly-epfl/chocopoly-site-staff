<script>
mousedown = false;
mincl = 0;
maxcl = 0;
selecting = false;
whichdate = 0;

function mclick(x, n){
	mousedown = true;
	mincl = x;
	maxcl = x;
	whichdate = n;
	if (document.getElementById(x+"-"+whichdate).className == 'not'){
		selecting = true;
	}else{
		selecting = false;
	}
	caseChange(x);
}

function munclick(){
	if (mousedown){
		mousedown = false;
		satisfaction();
		getselected(48)
	}
}
function satisfaction(){
	if (mousedown){
		for (i=mincl; i<=maxcl; i++){
			caseChange(i);
		}
	}
}

function caseChange(x){
	if (selecting){
		document.getElementById(x+"-"+whichdate).className = 'yes';
	}else{
		document.getElementById(x+"-"+whichdate).className = 'not';
	}
}

function mhover(x){
	if (mousedown){
		if (x > maxcl){maxcl = x;}
		if (x < mincl){mincl = x;}
		satisfaction();
	}
}

function totime(x){
	if (x % 1 == 0){
		return x + 'h00';
		// return x;
	}else{
		return (x-0.5) + 'h30';
		// return x + 'h30';
	}
}

function interval(txt){
	txts = txt.split(',')
	making = false
	endnb = 0
	intervals = []
	if (document.getElementById(0+'-'+whichdate)){k=0;}else{k=1;}
	for (i=k; i<30; i++){
		element = document.getElementById(i+"-"+whichdate)
		if (element){
			if (making){
				if (element.className == 'not'){
					// document.write(intervals[intervals.length - 1])
					intervals[intervals.length - 1] += " - " + totime(element.getAttribute("data-time"));
					making = false
				}else{
					endnb = parseFloat(element.getAttribute("data-time"))+0.5;
				}
			}else if (!making && element.className == 'yes'){
				intervals.push(totime(element.getAttribute("data-time")));
				endnb = parseFloat(element.getAttribute("data-time"))+0.5;
				// alert(endnb)
				making = true
			}
		}else{
			if (making){
				intervals[intervals.length - 1] += " - " + totime(endnb);
			}
			break;
		}
	}
	return intervals;
}

function getselected(x){
	txt = '';
	if (document.getElementById(0+'-'+whichdate)){k=0;}else{k=1;}
	for (i=k; i<x; i++){
		element = document.getElementById(i+'-'+whichdate)
		if (element){
			if (element.className == 'yes'){
				if (txt != ''){txt+=','}
				txt += element.getAttribute("data-time");
			}
		}else{
			break
		}
	}
	// document.write(txt)
	document.getElementById('result-'+whichdate).innerHTML = interval(txt);
	document.getElementById('heures-'+whichdate).innerHTML = "<input type='hidden' value='" + txt + "' name='heures-"+whichdate+"'>";
}
</script>

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
