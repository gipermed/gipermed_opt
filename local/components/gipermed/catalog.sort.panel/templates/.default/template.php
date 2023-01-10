<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

?>

<div class="top-bar clearfix">
	<div class="left-col">
		<div class="sorting">
			<span>Сортировать:</span>
			<ul class="sorting_switcher">
				<? foreach ( $arResult[ "SORT_LIST" ] as $code => $item ): ?>
					<li>
						<span class="sorting-type-wrapper">
							<a href="<?=$item["URL"]?>" class="sorting-type">
								<?=$item["NAME"]?>
								<?if( $item["ORDER"] ) echo $item["ORDER"]=="ASC"?"&uarr;":"&darr;"?>
							</a>
						</span>
					</li>
				<? endforeach ?>
			</ul>
		</div>
	</div>
	<div class="middle-col">
		<div class="show-count-item">
			<span>Показывать:</span>
			<select class="js-show-by">
				<? foreach ( $arResult[ "SHOW_BY_LIST" ] as $item ): ?>
					<? $selected = $item[ "SELECTED" ] == "Y" ? "selected" : ""?>
					<? $url = $item["URL"]?>
					<option data-url="<?=$url?>" <?=$selected?>>
						<?=$item["VALUE"]?>
					</option>
				<? endforeach ?>
			</select>
		</div>
	</div>
	<div class="right-col">
		<?$APPLICATION->ShowViewContent('SECTION_NAV_STRING')?>
	</div>
</div>