<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (empty($arResult["CATEGORIES"]))
	return;
?>
<div class="bx_searche">
<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
	<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
		<?if ( in_array($arItem["ITEM_ID"], $arResult["EXCLUDE_ITEMS"]) ) continue;?>
		<?//echo $arCategory["TITLE"]?>
		<?if($category_id === "all"):?>
			<div class="bx_item_block" style="min-height:0">
				<div class="bx_img_element"></div>
				<div class="bx_item_element"><hr></div>
			</div>
			<?/*?>
			<div class="bx_item_block all_result">
				<div class="bx_img_element"></div>
				<div class="bx_item_element">
					<span class="all_result_title"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></span>
				</div>
				<div style="clear:both;"></div>
			</div>
			<?/**/?>
		<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
			$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>
			<div class="bx_item_block">
				<?if (is_array($arElement["PICTURE"])):?>
				<div class="bx_img_element">
					<div class="bx_image" style="background-image: url('<?echo $arElement["PICTURE"]["src"]?>')"></div>
				</div>
				<?endif;?>
				<div class="bx_item_element">
					<a href="<?echo getCatalogProductUrl($arItem["ITEM_ID"], true)?>"><?echo $arItem["NAME"]?></a>
					<div class="bx_price"><?=$arElement["PRICE"]?></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		<?else:?>
			<?/*?>
			<div class="bx_item_block others_result">
				<div class="bx_img_element"></div>
				<div class="bx_item_element">
					<a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
				</div>
				<div style="clear:both;"></div>
			</div>
			<?/**/?>
		<?endif;?>
	<?endforeach;?>
<?endforeach;?>
</div>