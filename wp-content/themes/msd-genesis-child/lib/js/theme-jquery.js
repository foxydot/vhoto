jQuery(document).ready(function($) {	
	$('ul li:first-child').addClass('first-child');
	$('ul li:last-child').addClass('last-child');
	$('ul li:nth-child(even)').addClass('even');
	$('ul li:nth-child(odd)').addClass('odd');
	$('table tr:first-child').addClass('first-child');
	$('table tr:last-child').addClass('last-child');
	$('table tr:nth-child(even)').addClass('even');
	$('table tr:nth-child(odd)').addClass('odd');
	$('tr td:first-child').addClass('first-child');
	$('tr td:last-child').addClass('last-child');
	$('tr td:nth-child(even)').addClass('even');
	$('tr td:nth-child(odd)').addClass('odd');
	$('div:first-child').addClass('first-child');
	$('div:last-child').addClass('last-child');
	$('div:nth-child(even)').addClass('even');
	$('div:nth-child(odd)').addClass('odd');

	
	//special for lifestyle
	$('.ftr-menu ul.menu>li').after(function(){
		if(!$(this).hasClass('last-child') && $(this).hasClass('menu-item') && $(this).css('display')!='none'){
			return '<li class="separator">|</li>';
		}
	});
	
});