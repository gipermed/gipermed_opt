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

$active_cats = [];

$filter = $GLOBALS[ "arrFilter" ];

	$exclusiv = '';

	if(isset($filter['!PROPERTY_SHOW_SPEC']) && $filter['!PROPERTY_SHOW_SPEC'] == false) {
		$exclusiv = 'special'; 
	}
	if(isset($filter['!PROPERTY_SHOW_DEFAULT']) && $filter['!PROPERTY_SHOW_DEFAULT'] == false) {
		$exclusiv = 'default';
	}

?>
<?if ( count( $arResult[ "ITEMS" ] ) > 0 ):?>
	<section class="product__wrap">
		<section class="product__tabs">
		<?$isFirst = true;?>
		<?foreach ( $arResult[ "SECTIONS" ] as $sectionId => $arSection):?>
			<?$arItems = $arResult[ "ITEMS_IN_SECTIONS" ][ $sectionId ]?>
			<?php
				if($arSection["DISPLAY"] == "Y") {
					$active_cats[] = $arSection;
				}
			?>
			<?if ( $arSection["DISPLAY"] != "Y" ) continue?>
			<?if ( !is_array($arItems) || count($arItems) <= 0) continue?>
				<p class="product__tab <?= $isFirst ? 'product__tab--active' : ''?>"  data-open-tab="<?= $exclusiv.$sectionId ?>"><?=$arSection[ "NAME" ]?></p>
			<?if ( $isFirst ) $isFirst = false;?>
		<?endforeach?>
		</section>
	</section>
	<?php
		$isFirst = true;
		foreach ($active_cats as $category):
		$arItems = $arResult[ "ITEMS_IN_SECTIONS" ][ $category['ID'] ];
	?>
	<section class="catalog__item flex-row <?= $isFirst ? 'catalog__item--active' : '' ?>"  data-tab="<?= $exclusiv.$category['ID'] ?>">
		<div class="catalog__cat">
			<div class="catalog__category flex-row">
				<div class="catalog__image"><img src="https://gipermed.ru<?= $category['SRC'] ?>" alt=""/></div>
				<div class="catalog__describe">
					<div class="catalog--mob flex-row">
						<div class="catalog__image--mob">
							<img src="https://gipermed.ru<?= $category['SRC'] ?>" alt=""/>
						</div>
						<p class="catalog__header"><?= $category['NAME'] ?>:</p>
					</div>
					<p class="catalog__desc"><?= $category['UF_TEXT_CATEGORY'] ?></p>
					<a class="catalog__full" href="<?= $category['SECTION_PAGE_URL'] ?>"><span>Подробнее</span>
					<svg class="icon icon-arrow">
						<use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#arrow"></use>
					</svg></a>
				</div>
			</div>
		</div>
		<div class="catalog__product swiper-container">
			<div class="swiper-wrapper">
				<?foreach ( $arItems as $i ):
					?>
					<?$arItem = $arResult[ "ITEMS" ][ $i ]?>
					<? $APPLICATION->IncludeComponent( "gipermed:catalog.element.template", "special_redesign", $arItem ) ?>
				<?endforeach?>
			</div>
			<div class="swiper-pagination catalog__pag"></div>
		</div>
	</section>
	<?if ( $isFirst ) $isFirst = false;?>
	<?php endforeach; ?>
<?php endif; ?>