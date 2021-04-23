<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<noindex>
	<div class="hidden">
		<div class="box-modal" id="js-site-select">
<!--			<div class="box-modal_close arcticmodal-close"></div>-->
			<div class="cost-modal" style="text-align: center">
				<span class="heading">Выбор сайта</span>
				<a href="https://gipermed.com?<?=$arResult["PARAM_NAME"]?>=Y" class="v-btn v-btn--red v-btn--sm">
					<div class="v-btn__text">
						Сайт для физических лиц
					</div>
				</a>
				<br>
				<br>
				<div class="v-btn v-btn--red v-btn--sm js-select-site">
					<div class="v-btn__text">
						Сайт для юридических лиц
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(function () {
			$("#js-site-select").arcticmodal({
				closeOnEsc: false,
				closeOnOverlayClick: false
			});
		})
	</script>
</noindex>