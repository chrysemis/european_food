//identifies portions amount 
//loops through ul and calculates ingr amount for each li


$(function() {
	var $portionsForm = $('#portions-choice');
	var $portionsNumber = $('#portions-amount');
	
	$portionsForm.on('change', function(e) {
		e.preventDefault();
		var $currentPortions = $portionsNumber.val();
		$('li.incalc').each(function () {
			var $specIngr = $(this).children('span.ingr-calculation').text();
			var ingrTogether = $specIngr * $currentPortions;
			$(this).children('span').hide();
			$(this).prepend('<span>' + ingrTogether + ' ' + '</span>');
		});
		
 
	});
	
});

