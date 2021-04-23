<?
if ( $_REQUEST["confirm"] === "y" )
	setcookie("HIDE_COOKIE_ALERT", "Y", time() + 86400 * 1000, "/");