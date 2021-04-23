<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$url = $arResult["sUrlPathParams"] . "PAGEN_" . $arResult["NavNum"] . "=" . ((int)$arResult["NavPageNomer"] + 1);
?>
<?if ((int)$arResult["NavPageNomer"] < (int)$arResult["NavPageCount"]):?>
	<div class="manufacturers-all clearfix">
		<a onclick="showMoreHandler(this); return false;" data-url="<?=$url?>" href="<?=$url?>" class="js-pagination_show_more more">
			<?=GetMessage("CT_S_PGN_SHOW_MORE");?>
		</a>
	</div>
<?endif?>