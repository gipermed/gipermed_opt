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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$baseUrl = $arResult["sUrlPathParams"] . "PAGEN_" . $arResult["NavNum"] . "=";
$currPage = $arResult["NavPageNomer"];
$firstPage = 1;
$lastPage = $pageCnt = $arResult["NavPageCount"];

$linkPrev = ($currPage > 1) ? $baseUrl . ($currPage - 1) : "javascript:";
$linkNext = ($currPage < $pageCnt) ? $baseUrl . ($currPage + 1) : "javascript:";

$pagesShowNearActive = 2;
?>


<div class="pagination-wrap clearfix">
	<ul class="pagination clearfix">
		<?if ( $currPage > $firstPage ):?>
			<li class="prev"><a href="<?=$linkPrev?>"><span>Назад</span></a></li>
		<?endif?>

		<?if ( $currPage <= $firstPage + $pagesShowNearActive ):?>
			<?for ( $i = $firstPage; $i < $currPage;  $i++ ):?>
				<li><a href="<?=$baseUrl.$i?>"><?=$i?></a></li>
			<?endfor?>
		<?else:?>
			<li><a href="<?=$baseUrl.$firstPage?>"><?=$firstPage?></a></li>
			<li class="etc"><span>...</span></li>
		<?endif?>

		<li class="active"><a href=""><?=$currPage?></a></li>


		<?if ( $currPage >= $lastPage - $pagesShowNearActive ):?>
			<?for ( $i = $currPage + 1; $i <= $lastPage;  $i++ ):?>
				<li><a href="<?=$baseUrl.$i?>"><?=$i?></a></li>
			<?endfor?>
		<?else:?>
			<li class="etc"><span>...</span></li>
			<li><a href="<?=$baseUrl.$lastPage?>"><?=$lastPage?></a></li>
		<?endif?>


		<?if ( $currPage < $lastPage ):?>
			<li class="next"><a href="<?=$linkNext?>"><span>Вперед</span></a></li>
		<?endif?>

	</ul>
</div>

