$(function(){
	$(".js-select-site").on("click", function(){
		$.arcticmodal("close");

		$.post(
			"/",
			{
				component: "site.select",
				action: "confirm"
			},
			function(){	}
		);
	});
});