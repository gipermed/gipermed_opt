$(document).ready(function (){
	$(document).on("scroll", function () {
		var sticky = $(".sticky-product");
		if (  $(window).width() > 992 && $(window).scrollTop() > 400 ) sticky.addClass("sticky-product--active");
		else sticky.removeClass("sticky-product--active");
	});
});