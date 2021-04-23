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
$isMobile = isset($arParams['MOBILE']);
?>


<? if ( count($arResult["ITEMS"]) > 0 ): ?>
	<article class="brands<?= $isMobile ? '--mob' : '' ?>">
        <div class="container">
          <section class="brand__above flex-row">
            <p class="title"><?=$arParams["HEADER"]?></p>
            <section class="brand__pag flex-row">
              <section class="arrow arrow--left brand__arrow--left arrow--brand"></section>
              <section class="arrow arrow--right brand__arrow--right arrow--active arrow--brand"></section>
            </section>
          </section>
          <section class="brand__list swiper-container">
            <div class="swiper-wrapper">
        	<?foreach ($arResult["ITEMS"] as $arItem):?>
              	<div class="brand__item swiper-slide">
                  <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="full"></a>
                  <img src="https://gipermed.ru<?=$arItem[ "SRC" ]?>" alt="<?=$arItem["NAME"]?>"/>
                </div>
          	<?endforeach?>
            </div>
          </section><a class="link_full" href="<?=$arResult[ "LIST_PAGE_URL" ]?>">Все производители<span>
              <svg class="icon icon-arrow">
                <use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#arrow"></use>
              </svg></span></a>
        </div>
      </article>
<?endif?>