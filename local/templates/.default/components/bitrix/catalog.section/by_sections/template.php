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

// Генерируем уникальный класс для слайдеров, нужно, чтобы каждый работал независимо друг от друга
$sliderClass = preg_replace("/\d+/", "", md5($arParams["HEADER"]) ) ;
?>


<?if ( count( $arResult[ "ITEMS" ] ) > 0 ):?>
<div class="section arrows-middle-height">
	<div class="heading"><p class="h2"><?=$arParams["HEADER"]?></p></div>

	<div class="tabs-wrapper sale-tabs <?=$sliderClass?> clearfix">
		<div class="tabs level-1">
			<div class="label-wrap delivery-level-1-label-wrap">
				<?$isFirst = true;?>
				<?foreach ( $arResult[ "SECTIONS" ] as $sectionId => $arSection):?>
					<?$arItems = $arResult[ "ITEMS_IN_SECTIONS" ][ $sectionId ]?>
					<?if ( $arSection["DISPLAY"] != "Y" ) continue?>
					<?if ( !is_array($arItems) || count($arItems) <= 0) continue?>
					<?$class = $isFirst ? "active" : ""?>
					<label class="<?=$class?>">
						<span class="tabs-title">
							<?=$arSection[ "NAME" ]?>
						</span>
					</label>
					<?if ( $isFirst ) $isFirst = false;?>
				<?endforeach?>
			</div>

			<?$isFirst = true;?>
			<?$cnt = 0?>
			<?foreach ( $arResult[ "SECTIONS" ] as $sectionId => $arSection):?>
				<?$arItems = $arResult[ "ITEMS_IN_SECTIONS" ][ $sectionId ]?>
				<?if ( $arSection["DISPLAY"] != "Y" ) continue?>
				<?if ( !is_array($arItems) || count($arItems) <= 0) continue?>
				<?$class = $isFirst ? "active" : ""?>
				<div class="tabs-content tabs-content-level-1 <?=$class?>">
					<div class="product-carousel c<?=$cnt++ ?>">
						<?foreach ( $arItems as $i ):?>
							<?$arItem = $arResult[ "ITEMS" ][ $i ]?>
							<div class="carousel-cell">
							<div class="product-card">
								<? $APPLICATION->IncludeComponent( "gipermed:catalog.element.template", "", $arItem ) ?>
							</div>
							<div class="overlay"></div>
						</div>
						<?endforeach?>
					</div>
				</div>
				<?if ( $isFirst ) $isFirst = false;?>
			<?endforeach?>
		</div>
	</div>
</div>


	<script>
		$(function () {
			var sliderClass = ".<?=$sliderClass?>";

			var arSelectors = [];
			for (var i = 0; i < <?=$cnt?>; i++) {
				arSelectors.push( sliderClass + " .product-carousel.c" + i);
			}

			$(arSelectors.join(", ")).slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: true,
				fade: false,
				infinite: false,
				dots: false,
				responsive: [
					{
						breakpoint: 1070,
						settings:
						{
							slidesToShow: 3,
						}
					},
					{
						breakpoint: 992,
						settings: "unslick"
					}
				]
			});

			$(sliderClass).on('click', function() {
				arSelectors.forEach(function(el){
					var $el = $(el);
					if ($el.length) $el.get(0).slick.setPosition();
				});
			});

			$(sliderClass + ' .tabs.level-1 > .label-wrap > label').click(function() {
				$(sliderClass + ' .tabs.level-1 > .label-wrap > label').removeClass('active');
				$(this).addClass('active');

				var labelIndex = $(this).index();
				$(this).parent().parent().find('.tabs-content-level-1').removeClass('active');
				$(this).parent().parent().find('.tabs-content-level-1').eq(labelIndex).addClass('active');
			});

			$(sliderClass + ' .tabs.level-2 > .label-wrap > label').click(function() {
				$(sliderClass + ' .tabs.level-2 > .label-wrap > label').removeClass('active');
				$(this).addClass('active');

				var labelIndex = $(this).index();
				$(this).parent().parent().find('.tabs-content-level-2').removeClass('active');
				$(this).parent().parent().find('.tabs-content-level-2').eq(labelIndex).addClass('active');
			});
		});
	</script>


<?endif?>