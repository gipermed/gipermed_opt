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
// dd($arResult, false);
// die();

// Генерируем уникальный класс для слайдеров, нужно, чтобы каждый работал независимо друг от друга
$sliderClass = preg_replace("/\d+/", "", md5($arParams["HEADER"]) ) ;

$filter = $GLOBALS[ "arrFilter" ];

$exclusiv = '';


if(isset($filter[0][0]['!PROPERTY_SALE']) && $filter[0][0]['!PROPERTY_SALE'] == false) {
	$exclusiv = 'sale'; 
}
if(isset($filter['PROPERTY_SALE']) && $filter['PROPERTY_SALE'] == false) {
	$exclusiv = 'best';
}
if(isset($filter['!PROPERTY_NEW']) && $filter['!PROPERTY_NEW'] == false) {
	$exclusiv = 'new';
}
?>


<?if ( count( $arResult[ "ITEMS" ] ) > 0 ):?>
<article class="product product--<?= $exclusiv ?>">
        <div class="container">
          <p class="title"><?=$arParams["HEADER"]?></p>
          <section class="product__wrap">
            <section class="product__tabs">
            	<?$isFirst = true;
            	?>
				<?foreach ( $arResult[ "SECTIONS" ] as $sectionId => $arSection):?>
					<?$arItems = $arResult[ "ITEMS_IN_SECTIONS" ][ $sectionId ]?>
					<?if ( $arSection["DISPLAY"] != "Y" ) continue?>
					<?if ( !is_array($arItems) || count($arItems) <= 0) continue?>
						<p class="product__tab <?= $isFirst ? 'product__tab--active' : ''?>"  data-open-tab="<?= $exclusiv.$sectionId ?>"><?=$arSection[ "NAME" ]?></p>
					<?if ( $isFirst ) $isFirst = false;?>
				<?endforeach?>
            </section>
          </section>
        <?$isFirst = true;?>
		<?foreach ( $arResult[ "SECTIONS" ] as $sectionId => $arSection):?>
				<?$arItems = $arResult[ "ITEMS_IN_SECTIONS" ][ $sectionId ]?>
				<?if ( $arSection["DISPLAY"] != "Y" ) continue?>
				<?if ( !is_array($arItems) || count($arItems) <= 0) continue?>
				<?$class = $isFirst ? "product__slider--active" : ""?>
					<div class="swiper-container product__slider <?= $class ?>" data-tab="<?= $exclusiv.$sectionId ?>">
						<section class="arrow arrow--left product__arrow--left"></section>
						<section class="arrow arrow--right product__arrow--right arrow--active"></section>
						<div class="swiper-wrapper">
						<?foreach ( $arItems as $i ):?>
							<?$arItem = $arResult[ "ITEMS" ][ $i ]?>
							<? $APPLICATION->IncludeComponent( "gipermed:catalog.element.template", "redesign", $arItem ) ?>
						<?endforeach?>
					</div>
				</div>
				<?if ( $isFirst ) $isFirst = false;?>
			<?endforeach?>
      </article>
<?endif?>