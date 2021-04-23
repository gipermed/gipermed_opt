<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<? if ( count($arResult["ITEMS"]) > 0 ): ?>
<article class="banner">
	<div class="container">
	  <div class="swiper-container banner__slide">
	    <section class="arrow arrow--left banner__arrow--left"></section>
	    <section class="arrow arrow--right banner__arrow--right arrow--active"></section>
	    <div class="swiper-wrapper">
    	<?foreach ($arResult["ITEMS"] as $arItem):?>
	      <div class="banner__img swiper-slide">
	      	<a href="<?= $arItem['PROPERTIES']['URL']['VALUE'] ?>" class="full"></a><img src="https://gipermed.ru<?=$arItem[ "BIG_IMG" ]?>" alt="<?=$arItem["NAME"]?>"/></div>
      	<?endforeach?>
	    </div>
	    <div class="swiper-pagination banner__pag"></div>
	  </div>
	</div>
</article>
<?endif?>