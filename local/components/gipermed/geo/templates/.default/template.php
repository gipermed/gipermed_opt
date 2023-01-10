<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$this->addExternalJS("//api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU");
?>


<?$this->SetViewTarget("GEO_MOBILE");?>
	<div class="header-city-text" onclick="$('#city-modal').arcticmodal();">
		<strong class="header-city-label">
			Ваш город:
		</strong>
		<span class="header-city">
			<?=$arResult[ "LOCATION" ]?>
		</span>
	</div>
<?$this->EndViewTarget();?>


<?$this->SetViewTarget("GEO_DESKTOP");?>
	<div class="header-city-text header-city-text_header" onclick="$('#city-modal').arcticmodal();">
		<strong class="header-city-label">
			Ваш город:
		</strong>
		<span class="header-city">
			<?=$arResult[ "LOCATION" ]?>
		</span>
	</div>
<?$this->EndViewTarget();?>

<script>
	$(document).ready(function () {
		<?if ( $arResult[ "ASK_LOCATION" ] ):?>
		$('#city-modal').arcticmodal();
		<?endif?>

		$('.js-form-city .find-out-btn').on('click', function () {
			var location = $('.js-select-city').val();
			$('.header-city').text( location );

			$.arcticmodal('close');

			$.ajax({
				type: "POST",
				data: {
					component: 'geo',
					location: location
				}
			});
		});
	});

	ymaps.ready(function () {

		$('.js-select-city').kladr({
			token: 'token',
			key: 'key',
			type: $.kladr.type.city
		});

		if (typeof ymaps.geolocation.city != "undefined") {
			console.log(ymaps.geolocation.city);
			$('.js-select-city').val(ymaps.geolocation.city);
		} else {
			$('.js-form-city .heading').text('Напишите свой город');
			$('.js-form-city .find-out-btn').text('Готово');
		}
	});
</script>
<div style="display: none;">
	<div class="box-modal" id="city-modal">
		<div class="box-modal_close arcticmodal-close"></div>
		<div class="contact-us-modal js-form-city">
			<span class="heading">Это ваш город?</span>
			<form action="/">
				<input type="text" class="js-select-city">
				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="find-out-btn" value="Да">Да</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

