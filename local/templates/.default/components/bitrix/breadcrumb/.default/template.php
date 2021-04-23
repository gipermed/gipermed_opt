<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$codeToPass = getSectionTree()[ROOT_SECTION_ID]["CODE"];
foreach ($arResult as $i => &$item) {
	$link = $item["LINK"];
	if ( $link == "/catalog/$codeToPass/" ) {
		unset($arResult[$i]);
	}

	$item["LINK"] = str_replace("/$codeToPass", "", $link);
}
?>


<?ob_start();?>
<div class="breadcrumbs">
	<ul class='links'>
		<?foreach ($arResult as $i => $arItem):?>
			<li>
				<? if($i != count($arResult)) : ?>
				<a href="<?=$arItem["LINK"]?>"><?=$arItem["TITLE"]?></a>
				<? else: ?>
				<span><?=$arItem["TITLE"]?></span>
				<? endif; ?>
			</li>
		<?endforeach?>
	</ul>
</div>
<?
$content= ob_get_contents();
ob_end_clean();
return $content;
?>



