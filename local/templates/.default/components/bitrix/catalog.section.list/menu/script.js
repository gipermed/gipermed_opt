$(function(){
	$(".js-show-more-cat").on("click", function(e) {
		e.preventDefault();
		$(".js-show-more-cat-hidden").show();
		$(this).parent().hide();
	});

	$(".js-show-more-cat-mob").on("click", function(e) {
		e.preventDefault();
		$(".js-show-more-cat-mob-list .hidden").removeClass("hidden");
		$(this).parent().hide();
	});
});