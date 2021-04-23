$(function(){
	$(".site-switch").attr("href", buildUrl());

	$(".site-switch").on("click", function(){
		$(this).addClass('site-switch--action');
	});

	function buildUrl() {
		var url = $("[data-alt-url]").data("alt-url");
		var host = window.location.host.replace(/^(.*)(ru)$/, "https://$1com");
		return host + (url ? url : "");
	}
});

