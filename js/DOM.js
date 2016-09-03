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

//future - link with PHP and use loop to find number of portions; for now just set up portions=2;
// var portions = 10;
var elements = document.getElementsByClassName('amounts-calculation');
for ( i = 0; i < elements.length; i++ ) {
//get text node from all spans and multiply x 2 (number of portions)
		var elText = (elements[i].firstChild.nodeValue * 2.5);
		elements[i].textContent = elText + ' ';
}	
	
 

 