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