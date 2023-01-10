<?require($_SERVER['DOCUMENT_ROOT'].'/local/templates/.default/header.php');?>
<div class="content">

	<?$APPLICATION->IncludeComponent(
		"bitrix:breadcrumb",
		"",
		Array(
			"PATH" => "",
			"SITE_ID" => SITE_ID,
			"START_FROM" => "0"
		)
	);?>
	<a href="/" class="breadcrumbs-back-link">
		<svg width="8" height="12"><use xlink:href="#icon-angle-left"></use></svg>
		<span>Вернуться на главную</span>
	</a>
	<h1 class="page-title"><?=$APPLICATION->ShowTitle(false);?></h1>
