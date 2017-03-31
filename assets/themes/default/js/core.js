$(document).ready(function(){
	
	//hover for menu
	$('ul.nav li.dropdown').hover(function() {
		$('.dropdown-toggle', this).trigger('click'); 
	});  



	
});