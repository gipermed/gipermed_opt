$(function(){
	$(".js-confirm-cookie").on("click", function(){
		$.post(
			"/",
			{
				component: "cookie.alert",
				action: "confirm"
			},
			function(){
				$('.cookalert').remove();
			}
		);
	});
});