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

<?if (is_array($arResult["ITEMS"]) && count($arResult[ "ITEMS" ])>0):?>
<div class="heading">
	<h3>Перечень товаров данного производителя</h3>
</div>
<div class="list-product clearfix">
	<?
	$partSize = ceil( count( $arResult[ "ITEMS" ] ) / 2 );
	$arResults = array_chunk( $arResult[ "ITEMS" ], $partSize );
	?>
	<? foreach( $arResults as $arResultPart ): ?>
		<ul class="left-list">
			<? foreach( $arResultPart as $arItem ): ?>
				<li>
					<a href="<?=getCatalogProductUrl($arItem["ID"], true)?>">
						<?=$arItem[ "NAME" ]?>
					</a>
				</li>
			<? endforeach ?>
		</ul>
	<? endforeach ?>
</div>
<?endif?>
