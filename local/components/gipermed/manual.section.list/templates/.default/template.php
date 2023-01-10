<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<div class="category">
	<?foreach ( $arResult[ "SECTIONS" ] as $arSection ):?>
		<a href="<?=$arSection[ "SECTION_PAGE_URL" ]?>">
			<?=$arSection[ "NAME" ]?>
		</a>
	<?endforeach?>
</div>



