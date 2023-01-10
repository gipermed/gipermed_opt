<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
global $USER, $APPLICATION, $lang;
use Bitrix\Main\Page\Asset;
Bitrix\Main\Localization\Loc::loadMessages(__FILE__);
$lang = LANGUAGE_ID;
?>
<!DOCTYPE html>
<html lang="ru">
	<head>



		<meta charset="utf-8">
		<title><? $APPLICATION->ShowTitle(); ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?/*?><meta property="og:image" content="path/to/image.jpg"><?/**/?>

		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="apple-touch-icon" href="/favicon.ico">
		<link rel="apple-touch-icon" sizes="32x32" href="/favicon32.ico">
		<link rel="apple-touch-icon" sizes="64x64" href="/favicon64.ico">
		<link rel="apple-touch-icon" sizes="128x128" href="/favicon128.ico">



		<meta name="theme-color" content="#000">
		<meta name="msapplication-navbutton-color" content="#000">
		<meta name="apple-mobile-web-app-status-bar-style" content="#000">

		<? Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . 'css/main.css'); ?>
		<? Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . 'css/vi.css'); ?>
		<? Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . 'css/vicommon.css'); ?>
		<? Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . 'css/custom.css'); ?>
		<? Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . 'scss/compiled.css'); ?>
		<? Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . 'css/jquery-ui.min.css'); ?>
		<? Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . 'css/iefix.css'); ?>
		<? Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . 'css/redesign.css'); ?>
		<? Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . 'css/redesign-imhvost.css'); ?>		
		<? Asset::getInstance()->addCss('https://unpkg.com/swiper/swiper-bundle.min.css'); ?>

		<? Asset::getInstance()->addJs("//cdn.jsdelivr.net/npm/vue@2/dist/vue.js"); ?>
		<? //Asset::getInstance()->addJs("//cdn.jsdelivr.net/npm/vue@2"); ?>
		<? Asset::getInstance()->addJs("//api-maps.yandex.ru/2.1/?apikey=7f660a71-c0dc-40f6-9728-9ac341701ce8&lang=ru_RU"); ?>
		<? Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . "js/jquery.inputmask.min.js"); ?>

		<? Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . 'plugins/air-datepicker-master/datepicker.min.css'); ?>
		<? Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . 'plugins/air-datepicker-master/datepicker.min.js'); ?>
		<?CJSCore::Init(array("jquery"));?>
		<? //Asset::getInstance()->addJs('https://code.jquery.com/jquery-3.5.1.min.js'); ?>
		<? Asset::getInstance()->addJs('https://code.jquery.com/ui/1.11.4/jquery-ui.js'); ?>
		<? Asset::getInstance()->addJs('https://unpkg.com/swiper/swiper-bundle.min.js'); ?>
		<? Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . 'js/scripts.min.js'); ?>
		<? Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . 'js/main.js'); ?>


		<? $APPLICATION->ShowHead(); ?>

<!--Гирлянда на сайт css -->
<link rel="stylesheet" href="/ny/style.css">
<script src="/ny/scriptn.js" defer></script>

                  <script src="https://daruse.ru/assets/js/snowfall.js"></script>
    <script type="text/javascript">
        $(document).snowfall({
            flakeCount: 700,
                        image : "/ny/flake.png",
            flakeColor: '#ECF6FE',
            minSize: 3,
            maxSize: 15,
            maxSpeed: 5,
            minSpeed: 1,
            round: true,
            //shadow: true,
        });
    </script>
<!--Гирлянда на сайт css -->



		<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-177395131-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-177395131-2');
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
	(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
		m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
	(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	ym(51873659, "init", {
		id:51873659,
		clickmap:true,
		trackLinks:true,
		accurateTrackBounce:true,
		webvisor:true
	});
</script>

<?php
ob_start();
$APPLICATION->IncludeFile(
	"/include/$lang/header-email.php",
	Array(),
	Array("MODE"=>"html")
);
$email = ob_get_clean();
?>

<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "Organization",
		"url": "<?= isset($_SERVER['HTTPS']) ? 'https://'.$_SERVER['SERVER_NAME'] : 'http://' .$_SERVER['SERVER_NAME'] ?>",
		"name": "Гипермед",
		"email": "<?= strip_tags($email) ?>",
		"logo": "<?= isset($_SERVER['HTTPS']) ? 'https://'.$_SERVER['SERVER_NAME'] : 'http://' .$_SERVER['SERVER_NAME'] ?>/local/templates/.default/img/logo.png",
		"address": {
			"@type": "PostalAddress",
			"addressLocality": "Москва, Россия",
			"streetAddress": " г. Москва, ул. Рябиновая д. 53"
		}
	}
</script>
<!-- /Yandex.Metrika counter -->
<link rel="preconnect" href="https://fonts.gstatic.com"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&amp;display=swap" rel="stylesheet"/>



	</head>
	<body>
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0" height="0" style="position:absolute">
	
		<symbol id="icon-angle-bottom" viewBox="0 0 12 8.2">
			<path d="M6 8.2L0 2.1V0l6 6.2L12 0v2.1L6 8.2z"></path>
		</symbol>
	
		<symbol id="icon-angle-left" viewBox="0 0 9 12">
			<path d="M6.07 0h2.11L1.962 6l6.216 6H6.071L0 6l6.07-6z"></path>
		</symbol>
	
		<symbol id="icon-angle-right" viewBox="0 0 9 12">
			<path d="M9 6l-6.1 6H.8L7 6 .8 0h2.1L9 6z"></path>
		</symbol>
	
		<symbol id="icon-arrow-right" viewBox="0 0 21 16">
			<path d="M20.707 8.707a1 1 0 0 0 0-1.414L14.343.929a1 1 0 1 0-1.414 1.414L18.586 8l-5.657 5.657a1 1 0 0 0 1.414 1.414l6.364-6.364zM0 9h20V7H0v2z"></path>
		</symbol>
	
		<symbol id="icon-close" viewBox="0 0 14 14">
			<path d="M.419 12.507L12.57 0 14 1.47 1.848 13.978l-1.43-1.471z"></path><path d="M1.43.021L13.58 12.528 12.151 14 .002 1.493 1.43.02z"></path>
		</symbol>
	
		<symbol id="icon-print" viewBox="0 0 18 16.6">
			<path d="M16.7 3.8h-2V.5c0-.3-.2-.5-.5-.5H3.8c-.3 0-.5.2-.5.5v3.3h-2C.6 3.8 0 4.4 0 5.1v7c0 .7.6 1.3 1.3 1.3h2v2.7c0 .3.2.5.5.5h10.3c.3 0 .5-.2.5-.5v-2.7h2c.7 0 1.3-.6 1.3-1.3v-7c.1-.7-.5-1.3-1.2-1.3zM4.4 1.1h9.3v2.7H4.4V1.1zm9.2 14.4H4.4v-5.4h9.3v5.4zm3.3-3.4c0 .1-.1.2-.2.2h-2V9.6c0-.3-.2-.5-.5-.5H3.8c-.3-.1-.5.2-.5.5v2.7h-2c-.1 0-.2-.1-.2-.2v-7c0-.1.1-.2.2-.2h15.5c.1 0 .2.1.2.2l-.1 7z"></path><path d="M14.2 7.7c.4 0 .8-.3.8-.8 0-.4-.3-.8-.8-.8-.4 0-.8.3-.8.8s.3.8.8.8zM11.5 11.2h-5c-.3 0-.5.2-.5.5s.2.5.5.5h5c.3 0 .5-.2.5-.5s-.2-.5-.5-.5zM11.5 13.4h-5c-.3 0-.5.2-.5.5s.2.5.5.5h5c.3 0 .5-.2.5-.5s-.2-.5-.5-.5z"></path>
		</symbol>
	
		<symbol id="icon-zoom" viewBox="0 0 21.1 21.1">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M.8 14.3c.2 0 .4.1.5.2.1.1.2.3.2.5v4.5H6c.2 0 .4.1.5.2.1.1.2.3.2.5s-.1.4-.2.5c-.1.3-.3.4-.5.4H.8c-.2 0-.4-.1-.5-.2-.2-.2-.3-.4-.3-.6V15c0-.2.1-.4.2-.5.2-.1.4-.2.6-.2z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 13.5c.1.1.2.3.2.5s-.1.4-.2.5l-6.2 6.2c-.2.2-.4.3-.6.3-.2 0-.4-.1-.5-.2-.1-.2-.2-.4-.2-.5 0-.2.1-.4.2-.5l6.2-6.2c.1-.1.3-.2.5-.2.3-.1.5 0 .6.1zM20.8.2c.1.1.1.2.2.2v.4c0 .1 0 .2-.1.3s-.1.2-.2.2l-6.2 6.2c-.1.1-.3.2-.5.2s-.4-.1-.5-.2c-.1-.1-.2-.3-.2-.5s.1-.4.2-.5L19.7.3c.2-.2.4-.3.6-.3.1 0 .3.1.5.2z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M14.3.8c0-.2.1-.4.2-.5.2-.2.4-.3.6-.3h5.3c.2 0 .4.1.5.2.1.1.2.3.2.5V6c0 .2-.1.4-.2.5-.1.1-.3.2-.5.2s-.4-.1-.5-.2c-.1-.1-.2-.3-.2-.5V1.5h-4.5c-.2 0-.4-.1-.5-.2-.3-.2-.4-.4-.4-.5zm6 13.5c-.2 0-.4.1-.5.2-.1.1-.2.3-.2.5v4.5h-4.5c-.2 0-.4.1-.5.2-.1.1-.2.3-.2.5s.1.4.2.5c.1.1.3.2.5.2h5.3c.2 0 .4-.1.5-.2.1-.1.2-.3.2-.5V15c0-.2-.1-.4-.2-.5-.2-.2-.4-.2-.6-.2z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M13.6 13.4c-.1.1-.1.2-.2.2 0 .1-.1.2-.1.3 0 .1 0 .2.1.3 0 .1.1.2.2.2l6.2 6.2c.1.1.3.2.5.2.1 0 .2 0 .3-.1.1 0 .2-.1.2-.2.1-.1.1-.2.2-.2 0-.1.1-.2.1-.3 0-.1 0-.2-.1-.3 0-.1-.1-.2-.2-.2l-6.2-6.2c-.1-.1-.3-.2-.5-.2-.2.1-.4.2-.5.3zM.3.2C.3.3.2.4.2.5.2.6.1.7.1.8c0 .1 0 .2.1.3 0 .1.1.2.2.2l6.2 6.2c.1.1.3.2.5.2s.4-.1.5-.2c.1-.1.2-.3.2-.5s-.1-.4-.2-.5L1.4.2C1.2.1 1.1 0 .9 0S.5.1.3.2z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M6.8.8c0-.2-.1-.4-.2-.5-.2-.2-.3-.3-.5-.3H.8C.6 0 .4.1.3.2S.1.6.1.8V6c0 .2.1.4.2.5.1.1.3.2.5.2s.4-.1.5-.2c.2-.1.3-.3.3-.5V1.5h4.5c.2 0 .4-.1.5-.2.1-.2.2-.4.2-.5z"></path>
		</symbol>
	
</svg>
		<? //$APPLICATION->IncludeComponent( "gipermed:geo", "zero_line", array(), false )?>
		<div id="panel">
			<? $APPLICATION->ShowPanel(); ?>
		</div>
		<div class="<?$APPLICATION->ShowProperty("page_fix", "page clearfix")?>">
			<? $APPLICATION->IncludeComponent( "gipermed:cookie.alert", "", array(), false )?>
			<div class="mobile-menu">
				<div class="mobile-menu-height">
					<div class="mobile-menu-wrap">
						<div class="close"></div>
						<? $APPLICATION->IncludeComponent(
							"bitrix:menu",
							"top_mobile",
							array(
								"COMPONENT_TEMPLATE" => "top",
								"ROOT_MENU_TYPE" => "top",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_USE_GROUPS" => "N",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "N",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N"
							),
							false
						); ?>
						<div class="header-first-floor-menu">
							<a href="/catalog/sale/" class="sale">Распродажа</a>
							<a href="/catalog/stock/" class="action">Акции</a>
							<a href="/catalog/cut-price/" class="markdown">Скидки</a>
							<? $APPLICATION->ShowViewContent('GEO_MOBILE'); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="main-ct">
				<header class="header">
	<section class="header__top">
		<div class="container">
			<div class="flex-row header__row">
				<div class="header__top-sale" href="#">Акции
				<div class="header-stock__menu-wrap">
					<div class="header-stock__menu">
						<a class="header-stock__menu-item header-stock__menu-item--sale" href="/catalog/sale/">Распродажа</a>
						<a class="header-stock__menu-item header-stock__menu-item--action" href="/catalog/stock/">Акции</a>
						<a class="header-stock__menu-item header-stock__menu-item--markdown" href="/catalog/cut-price/">Скидки</a>
					</div>
				</div>
				</div>
				
				<? $APPLICATION->IncludeComponent(
					"bitrix:menu",
					"header_top",
					array(
					"COMPONENT_TEMPLATE" => "top",
					"ROOT_MENU_TYPE" => "top",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_USE_GROUPS" => "N",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MAX_LEVEL" => "1",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "N",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N"
					),
					false
				); ?>
			</div>
		</div>
	</section>

					<section class="header__slogan2">Внимание! Актуальные цены и наличие товара просьба уточнять у наших менеджеров.<br>
Резервы по счету на товар временно действуют один день.
</section>
					<section class="header__slogan">Центр торговли медицинскими товарами</section>

  <!-- новогодняя мотня 2.1 -->
    <div class="b-page_newyear">
        <div class="b-page__content">
            <i class="b-head-decor">
                <i class="b-head-decor__inner b-head-decor__inner_n1">
                    <div class="b-ball b-ball_n1 b-ball_bounce" data-note="0"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n2 b-ball_bounce" data-note="1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n3 b-ball_bounce" data-note="2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n4 b-ball_bounce" data-note="3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n5 b-ball_bounce" data-note="4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n6 b-ball_bounce" data-note="5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n7 b-ball_bounce" data-note="6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n8 b-ball_bounce" data-note="7"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n9 b-ball_bounce" data-note="8"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                </i>
                <i class="b-head-decor__inner b-head-decor__inner_n2">
                    <div class="b-ball b-ball_n1 b-ball_bounce" data-note="9"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n2 b-ball_bounce" data-note="10"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n3 b-ball_bounce" data-note="11"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n4 b-ball_bounce" data-note="12"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n5 b-ball_bounce" data-note="13"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n6 b-ball_bounce" data-note="14"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n7 b-ball_bounce" data-note="15"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n8 b-ball_bounce" data-note="16"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n9 b-ball_bounce" data-note="17"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                </i>
                <i class="b-head-decor__inner b-head-decor__inner_n3">
                    <div class="b-ball b-ball_n1 b-ball_bounce" data-note="18"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n2 b-ball_bounce" data-note="19"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n3 b-ball_bounce" data-note="20"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n4 b-ball_bounce" data-note="21"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n5 b-ball_bounce" data-note="22"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n6 b-ball_bounce" data-note="23"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n7 b-ball_bounce" data-note="24"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n8 b-ball_bounce" data-note="25"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n9 b-ball_bounce" data-note="26"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                </i>
                <i class="b-head-decor__inner b-head-decor__inner_n4">
                    <div class="b-ball b-ball_n1 b-ball_bounce" data-note="27"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n2 b-ball_bounce" data-note="28"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n3 b-ball_bounce" data-note="29"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n4 b-ball_bounce" data-note="30"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n5 b-ball_bounce" data-note="31"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n6 b-ball_bounce" data-note="32"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n7 b-ball_bounce" data-note="33"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n8 b-ball_bounce" data-note="34"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n9 b-ball_bounce" data-note="35"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                </i>
                <i class="b-head-decor__inner b-head-decor__inner_n5">
                    <div class="b-ball b-ball_n1 b-ball_bounce" data-note="0"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n2 b-ball_bounce" data-note="1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n3 b-ball_bounce" data-note="2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n4 b-ball_bounce" data-note="3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n5 b-ball_bounce" data-note="4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n6 b-ball_bounce" data-note="5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n7 b-ball_bounce" data-note="6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n8 b-ball_bounce" data-note="7"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n9 b-ball_bounce" data-note="8"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                </i>
                <i class="b-head-decor__inner b-head-decor__inner_n6">
                    <div class="b-ball b-ball_n1 b-ball_bounce" data-note="9"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n2 b-ball_bounce" data-note="10"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n3 b-ball_bounce" data-note="11"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n4 b-ball_bounce" data-note="12"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n5 b-ball_bounce" data-note="13"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n6 b-ball_bounce" data-note="14"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n7 b-ball_bounce" data-note="15"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n8 b-ball_bounce" data-note="16"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n9 b-ball_bounce" data-note="17"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                </i>
                <i class="b-head-decor__inner b-head-decor__inner_n7">
                    <div class="b-ball b-ball_n1 b-ball_bounce" data-note="18"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n2 b-ball_bounce" data-note="19"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n3 b-ball_bounce" data-note="20"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n4 b-ball_bounce" data-note="21"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n5 b-ball_bounce" data-note="22"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n6 b-ball_bounce" data-note="23"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n7 b-ball_bounce" data-note="24"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n8 b-ball_bounce" data-note="25"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_n9 b-ball_bounce" data-note="26"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i1"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i2"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i3"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i4"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i5"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                    <div class="b-ball b-ball_i6"><div class="b-ball__right"></div><div class="b-ball__i"></div></div>
                </i>
            </i>
        </div>
    </div>
    <!-- новогодняя мотня 2.1 -->

<section class="header__bottom">
	<div class="container">
		<div class="header__list flex-row">
			<div class="header__catalog--mob">
				<svg class="icon icon-catalog">
					<use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#catalog"></use>
				</svg>
			</div>
			<div class="header__logo"><a href="/"><img src="<?=DEFAULT_TEMPLATE_PATH ?>img/main_redis/logo.svg" alt=""/></a></div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"menu_new",
				Array(
				"SHOW_SECTIONS_NUM" => 20,
				"IBLOCK_TYPE" => "ru",
				"IBLOCK_ID" => "1",
				"SECTION_ID" => ROOT_SECTION_ID,
				"SECTION_CODE" => "",
				"COUNT_ELEMENTS" => "Y",
				"TOP_DEPTH" => "2",
				"SECTION_FIELDS" => array(
				0 => "",
				),
				"SECTION_USER_FIELDS" => array(
				0 => "",
				),
				"SECTION_URL" => "",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_GROUPS" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				),
				false
			);?>
			<?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"dropdown_redis", 
	array(
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "10",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => SITE_DIR."search/",
		"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
		"CATEGORY_0" => array(
			0 => "iblock_ru",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "all",
		),
		"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "search",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CONVERT_CURRENCY" => "Y",
		"COMPONENT_TEMPLATE" => "dropdown_redis",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "Y",
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"CURRENCY_ID" => "RUB",
		"CATEGORY_0_iblock_ru" => array(
			0 => "1",
		)
	),
	false
);?>
			<div class="header__contact">
				<div class="header__general flex-row">
					<svg class="icon icon-phone">
						<use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#phone"></use>
					</svg>
					<?$APPLICATION->IncludeFile(
						"/include/$lang/header-phone-once.php",
						Array(),
						Array("MODE"=>"html")
					);?>
					<svg class="icon icon-arrow-up">
						<use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#arrow-up"></use>
					</svg>
					<a href="tel:84951340122" class="header__tel-mob">
						<img src="<?=DEFAULT_TEMPLATE_PATH ?>img/phone.svg" alt="">
					</a>
					<svg class="icon icon-magnifer">
						<use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#magnifer"></use>
					</svg>
				</div>
				<div class="header__dropdown">
					<?$APPLICATION->IncludeFile(
						"/include/$lang/header-cont-drop.php",
						Array(),
						Array("MODE"=>"html")
					);?>
				</div>
			</div><a class="header__roz flex-row" href="https://gipermed.com/">
			<p>Для розничных покупателей <br><span>(физические лица)</span></p>
			<svg class="icon icon-touch">
				<use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#touch"></use>
			</svg></a>
		</div>
	</div>
</section>
</header>
<div class="container">
	<div class="row">
		<div class="content-wrap">
