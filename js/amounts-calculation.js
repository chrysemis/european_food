var portions = 4;
var x = 0.5;

for ( i = 1; i < 11; i++ ) {
	if (i === portions) {
		x = (x*i);
	}
	else {
		x = x;
	}
}
	
var msg = x + ' ';
var el = document.getElementById('amounts-calculation');
el.textContent = msg; 

/*var portions = 4;
var x = 0.5;

/*switch (portions) {
	case 1:
		msg = x;
		break;
	case 2:
		msg = (x*2);
		break;
	case 3:
		msg = (x*3);
}*/
	
/* for ( i = 1; i < 11; i++ ) {
	if (i === portions) {
		x = (x*i);
	}
	else {
		x = x;
	}
}
	
var msg = x + ' ';
var el = document.getElementById('amounts-calculation');
el.textContent = msg; 
*/


 
