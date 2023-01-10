<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

?>
<div class="category-head">
	<div class="category-sort">
		<div class="category-sort-row flex-row">
			<div class="category-sort-col flex-row-item">
				<div class="category-sort-title">Сортировать:</div>
				<ul class="category-sort-list">
					<?foreach ( $arResult[ "SORT_LIST" ] as $code => $item ): 
					//var_dump($item);?>
					<li class="<?=($item['ORDER']?'active':'')?> <?=($item['ORDER'] == 'ASC'?'sort-asc':($item['ORDER'] == 'DESC'?'sort-desc':''))?>"><a href="<?=$item["URL"]?>"><?=$item["NAME"]?></a></li>
					<?endforeach;?>
				</ul>
			</div>
			<div class="category-sort-col flex-row-item hidden-mobile">
				<div class="category-sort-title">Показывать:</div>
				<div class="category-sort-select select">
					<label class="form-block">
						<?	foreach ( $arResult[ "SHOW_BY_LIST" ] as $item ): 
							if ($item[ "SELECTED" ] == "Y")
								$selectedItem = $item["VALUE"];
						endforeach;	
						$selectedItem = $selectedItem??$arResult[ "SHOW_BY_LIST" ][0]['VALUE'];?>

						<input type="text" class="select-input input" value="<?=$selectedItem?>" disabled>
						<span class="select-icon">
							<svg width="12" height="12"><use xlink:href="#icon-angle-bottom"/></svg>
						</span>
					</label>
					<div class="select-list-wrapp">
						<ul class="select-list">
							<?foreach ( $arResult["SHOW_BY_LIST"] as $item ): ?>
								<li class="<?=$item[ "VALUE" ] == $selectedItem ? "active" : ""?>"><a href="<?=$item["URL"]?>"><?=$item["VALUE"]?></a></li>
							<?endforeach;?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="hidden-mobile">
		<!-- ДОДЕЛАТЬ -->
		<?$APPLICATION->ShowViewContent('SECTION_NAV_STRING')?>
		<!--<ul class="pagination">
			<li>
				<a href="#" class="pagination-prev" aria-label="Назад">
					<svg width="12" height="12"><use xlink:href="#icon-angle-left"/></svg>
				</a>
			</li>
			<li><a href="#">1</a></li>
			<li class="active"><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><span>...</span></li>
			<li><a href="#">13</a></li>
			<li>
				<a href="#" class="pagination-next" aria-label="Вперед">
					<svg width="12" height="12"><use xlink:href="#icon-angle-right"/></svg>
				</a>
			</li>
		</ul>-->
	</div>
</div>
<a href="#" class="category-filter-open-btn btn btn-red">Фильтр</a>

<!-- ТО ЧТО НИЖЕ УБРАТЬ ПОТОМ -->
<!--
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
				<?endforeach;?>
			</ul>
		</div>
	</div>
	<div class="middle-col">
		<div class="show-count-item">
			<span>Показывать:</span>
			<select class="js-show-by">
				<?foreach ( $arResult[ "SHOW_BY_LIST" ] as $item ): ?>
					<? $selected = $item[ "SELECTED" ] == "Y" ? "selected" : ""?>
					<? $url = $item["URL"]?>
					<option data-url="<?=$url?>" <?=$selected?>>
						<?=$item["VALUE"]?>
					</option>
				<?endforeach;?>
			</select>
		</div>
	</div>
	<div class="right-col">
		<?$APPLICATION->ShowViewContent('SECTION_NAV_STRING')?>
	</div>
</div> -->