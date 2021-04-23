$(function(){
	$(".js-show-by").on("change", function(){
		var url = $(this).find(":selected").data("url");
		window.location.href = url;
	});
});