<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$maxItemsToShow = $arParams["SHOW_SECTIONS_NUM"];
$rootSectionId = $arParams["SECTION_ID"] ?: "ROOT";
$rootSectionsCnt = count( $arResult[ "TREE" ][ $rootSectionId ] );
$showMore = $rootSectionsCnt > $maxItemsToShow;
?>
<article class="header__mcatalog">
<div class="header__mcatalog__scroll">
	<section class="header__mcatalog__contact">
		<svg class="icon icon-cross">
			<use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#cross"></use>
		</svg>
		<?$APPLICATION->IncludeFile(
			"/include/ru/header-mobile.php",
			Array(),
			Array("MODE"=>"html")
		);?>
	</section>
	<ul class="header__mcatalog__menu">
		<li><span>Каталог товаров</span>
		<ul>
		<?foreach( $arResult[ "TREE" ][ $rootSectionId ] as $i => $sectionId ):?>
		<? $sectionIndex = $arResult[ "INDEXES" ][ $sectionId ];?>
		<? $arSection = $arResult[ "SECTIONS" ][ $sectionIndex ]; ?>
			<li class="flex-row">
				<div class="flex-row">
					<div class="header__icon">
						<img src="https://gipermed.ru<?=$arSection[ "ICON" ]?>" alt=""/>
					</div>
					<a href="<?=$arSection[ "SECTION_PAGE_URL" ]?>"><?=$arSection[ "NAME" ]?></a>
				</div>
				<? $arSectionChildren = $arResult[ "TREE" ][ $sectionId ]; ?>
				<? if ( is_array($arSectionChildren) && count( $arSectionChildren ) > 0 ):?>
				<svg class="icon icon-arrow-up">
					<use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#arrow-up"></use>
				</svg>
					<ul class="header__mcatalog--inner">
						<li class="header__mcatalog__header">
							<svg class="icon icon-arrow-up">
								<use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#arrow-up"></use>
							</svg>
							<?=$arSection[ "NAME" ]?>
						</li>
						<?foreach ( $arSectionChildren as $subSectionId ):?>
						<? $subSectionIndex = $arResult[ "INDEXES" ][ $subSectionId ]; ?>
						<? $arSubSection = $arResult[ "SECTIONS" ][ $subSectionIndex ]?>
						<li>
							<a href="<?=$arSubSection["SECTION_PAGE_URL"]?>"><?=$arSubSection["NAME"]?><span> (<?=$arSubSection["ELEMENT_CNT"]?>)</span></a>
						</li>
						<?php endforeach; ?>				
					</ul>
				<?endif?>
			</li>
		<?php endforeach; ?>
			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"top_sale",
				array(
				"COMPONENT_TEMPLATE" => "sale",
				"ROOT_MENU_TYPE" => "sale",
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
		</ul>
	</li>
	<? $APPLICATION->IncludeComponent(
		"bitrix:menu",
		"mobile_menu",
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
	<li>
		<section class="header__mcatalog__roz">
			<p class="header__mcatalog__full">Сайт для физических лиц</p>
			<p class="header__mcatalog__small">www.gipermed.com</p><a class="header__mcatalog__link" href="#">Перейти</a>
		</section>
	</li>
</ul>
</div>
</article>