$(document).ready(function(){
	if (document.cookie_consent != undefined) {
		$('html').css({overflow: 'hidden'});
		h = screen.height + 100;
		document.getElementsByClassName("ch-cookie-consent")[0].style.height = h+'px'
	}
});