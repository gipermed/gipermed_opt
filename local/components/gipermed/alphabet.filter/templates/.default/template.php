<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>


<div class="alphabet-filter">
	<div class="alphabet-filter-box en">
		<? foreach ( $arResult[ "EN" ] as $l ): ?>
			<? $selected = $l == $arResult[ "SELECTED" ] ? "active" : "" ?>
			<? $valid = $arResult[ "VALID" ][ $l ] ? "" : "invalid"  ?>
			<? $onclick = $arResult[ "VALID" ][ $l ] ? "" : "return false;"  ?>
			<a class="<?=$selected?> <?=$valid?>" onclick="<?=$onclick?>" href="?letter=<?=$l?>">
				<?= $l ?>
			</a>
		<? endforeach ?>
	</div>
	<div class="alphabet-filter-box rus">
		<? foreach ( $arResult[ "RU" ] as $l ): ?>
			<? $selected = $l == $arResult[ "SELECTED" ] ? "active" : "" ?>
			<? $valid = $arResult[ "VALID" ][ $l ] ? "" : "invalid"  ?>
			<? $onclick = $arResult[ "VALID" ][ $l ] ? "" : "return false;"  ?>
			<a class="<?=$selected?> <?=$valid?>" onclick="<?=$onclick?>" href="?letter=<?=$l?>">
				<?= $l ?>
			</a>
		<? endforeach ?>
	</div>
</div>
