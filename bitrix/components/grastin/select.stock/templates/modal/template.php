<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$apiUrl = "//api-maps.yandex.ru/2.1/?lang=ru_RU";
if (strlen($arResult["API_KEY"]) > 0)
	$apiUrl .= "&apikey=".$arResult["API_KEY"];

$this->addExternalJs($apiUrl);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');
$this->addExternalJs(BX_ROOT . '/js/grastin.delivery/list.min.js');
?>
<div class="export_popup_wrap">
	<div class="export_popup_container">
		<div class="export_popup_content">
			<div class="export_point_popup">
				<div class="title">
					<div class="export_c_wrap"><?= Loc::getMessage("TPL_SELECT_STOCK_F_TITLE") ?></div>
				</div>
				<?if(isset($arResult['ERROR'])):?>
				<div class="notice">
					<h3><?= Loc::getMessage("TPL_SELECT_STOCK_E_TITLE") ?></h3>
					<div>
						<div><strong><?= Loc::getMessage("TPL_SELECT_STOCK_E_MORE_INFO") ?></strong></div>
						<p><?=($arResult['ERROR'])?></p>
					</div>
				</div>
				<?else:?>
				<div class="export_item_details_tabs">
					<div class="export_c_wrap">
						<ul class="nav nav-tabs ">
							<li class="tabs-item active">
								<a href="javascript:void(0)" data-id="link_tab"><?= Loc::getMessage("TPL_SELECT_STOCK_TAB_LIST") ?></a>
							</li>
							<li class="tabs-item">
								<a href="javascript:void(0)" data-id="map_tab"><?= Loc::getMessage("TPL_SELECT_STOCK_TAB_MAP") ?></a>
							</li>
						</ul>
						<div class="export_item_logo">
							<a class="logo-block" href="https://grastin.ru" target="_blank"></a>
						</div>
					</div>
				</div>
				<div class="export_tab_content_block">
					<div class="export_tab_content_item active" data-id="link_tab" id="points_list_wr">
						<div class="export_c_wrap export_search_item">
							<div class="search_item_input_wr">
								<input class="search_item_input" placeholder="<?= Loc::getMessage("TPL_SELECT_STOCK_SEARCH_PLACEHOLDER") ?>" />
								<span class="icon search_reset" onclick="this.previousElementSibling.value = ''"></span>
							</div>
						</div>
						<ul class="points_list">
						<?
						foreach($arResult['DELIVERY_POINTS'] as $arPoint):
							$id = $arPoint['XML_ID'];
						?><li class="export_tab_item">
							<div class="export_c_wrap">
								<div class="input_group">
									<label for="delivery_place_<?=($id)?>" class="delivery">
										<input
											name="delivery_place"
											type="radio"
											id="delivery_place_<?=($id)?>"
											value="<?=($arPoint['NAME'])?>"
										/>
										<div class="input_text">
											<div class="export_point">
												<div class="address"><?=($arPoint['NAME'])?></div>
												<div class="desc"><?
													if(strlen($arPoint['DRIVINGDESCRIPTION']) > 0):
														?><p><?=$arPoint['DRIVINGDESCRIPTION'];?></p><?
													endif;

													if(strlen($arPoint['TIMETABLE']) > 0):
													?><p><?=Loc::getMessage("TPL_SELECT_STOCK_F_TIMETABLE",array("#TIME#" => $arPoint['TIMETABLE']));?></p><?
													endif;

													if(strlen($arPoint['PHONE']) > 0):
													?><p><?=Loc::getMessage("TPL_SELECT_STOCK_F_PHONE",array("#PHONE#" => $arPoint['PHONE']));?></p><?
													endif;
												?></div>
											</div>
										</div>
										<div class="export_submit_btn">
											<a data-id="<?=($id)?>" href="javascript:void(0)" class="btn btn_primary"><?= Loc::getMessage("TPL_SELECT_STOCK_BTN_SELECT") ?></a>
										</div>
									</label>
								</div>
							</div>
						</li><?
						endforeach;
					?></ul>
					</div>
					<div class="export_tab_content_item export_tab_content_item_map" data-id="map_tab">
						<div class="export_c_wrap">
							<div class="map" id="map">
								<div id="hellopreloader">
									<div id="hellopreloader_preload"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?endif;?>
			</div>
			<button type="button" class="export_popup_close box-modal_close"><?=(Loc::getMessage('TPL_SELECT_STOCK_BTN_CLOSE'))?></button>
		</div>
	</div>
</div>

<script>
	BX.mapballoon = <?=(CUtil::PhpToJSObject($arResult['MAP_BALLOON']))?>;
	BX.ready(function () {
		initPointPopup();
		<? if (!isset($arResult['ERROR'])) : ?>
		ymaps.ready(initYmaps);
		ymaps.ready(setTimeout(function () {
			$('#hellopreloader').css('display', 'none');
		}, 3000));

		$('.export_submit_btn a').on('click', function () {
			var pointId = $(this).data('id');
			var pointValue = $('#delivery_place_' + pointId).val();

			if ("" == pointValue)
				return false;

			selectPoint(pointId, pointValue, true);
		});
		<? endif; ?>

		BX.message({
			BTN_MESSAGE_SELECT_POINT_BUTTON: '<? echo GetMessageJS('TPL_SELECT_STOCK_BTN_SELECT') ?>'
		});
	});
</script>
