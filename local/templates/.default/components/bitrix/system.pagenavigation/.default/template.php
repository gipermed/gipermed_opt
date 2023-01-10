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

$pagesShowNearActive = 1;

?>


	<div class="pagen clearfix">

		<?if ( $currPage > $firstPage ):?>
			<a class="pagen__item pagen__item--prev" href="<?=$linkPrev?>"></a>
		<?else:?>
			<?/*?><span class="pagen__item pagen__item--prev pagen__item--inactive"></span><?/**/?>
		<?endif?>


		<?if ( $firstPage + $pagesShowNearActive + 1 >= $currPage ):?>
			<?for ( $i = $firstPage; $i < $currPage;  $i++ ):?>
				<a class="pagen__item" href="<?=$baseUrl.$i?>"><?=$i?></a>
			<?endfor?>
		<?else:?>
			<?$nearActiveBegin = $currPage - $pagesShowNearActive?>
			<?$beginMiddle = round( ($nearActiveBegin + $firstPage)/2 )?>

			<a class="pagen__item" href="<?=$baseUrl.$firstPage?>"><?=$firstPage?></a>
			<a class="pagen__item" href="<?=$baseUrl.$beginMiddle?>">...</a>

			<?for ( $i = $nearActiveBegin; $i < $currPage;  $i++ ):?>
				<a class="pagen__item" href="<?=$baseUrl.$i?>"><?=$i?></a>
			<?endfor?>
		<?endif?>

		<span class="pagen__item pagen__item--active"><?=$currPage?></span>

		<?if ( $currPage + $pagesShowNearActive + 1 >= $lastPage  ):?>
			<?for ( $i = $currPage + 1; $i <= $lastPage;  $i++ ):?>
				<a class="pagen__item" href="<?=$baseUrl.$i?>"><?=$i?></a>
			<?endfor?>
		<?else:?>
			<?$nearActiveEnd = $currPage + $pagesShowNearActive?>
			<?$endMiddle = round( ($nearActiveEnd + $lastPage)/2 )?>

			<?for ( $i = $currPage + 1; $i <= $nearActiveEnd;  $i++ ):?>
				<a class="pagen__item" href="<?=$baseUrl.$i?>"><?=$i?></a>
			<?endfor?>

			<a class="pagen__item" href="<?=$baseUrl.$endMiddle?>">...</a>
			<a class="pagen__item" href="<?=$baseUrl.$lastPage?>"><?=$lastPage?></a>
		<?endif?>

		<?if ( $currPage < $lastPage ):?>
			<a class="pagen__item pagen__item--next" href="<?=$linkNext?>"></a>
		<?else:?>
			<?/*?><span class="pagen__item pagen__item--next pagen__item--inactive"></span><?/**/?>
		<?endif?>
	</div>

