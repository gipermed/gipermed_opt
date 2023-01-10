<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контактная информация оптового интернет магазина медицинских товаров ⚕«Гипермед»⚕");
$APPLICATION->SetPageProperty("title", "Контакты оптового интернет-магазина медицинских товаров ⚕«Гипермед»⚕");
$APPLICATION->SetTitle("Контакты");
?><div class="page page-contacts">
	<div class="page-container">

		<div class="contacts-row flex-row">
			<div class="contacts-col flex-row-item">
				<div class="contacts-section">
					<div class="section-title">Отдел продаж ЦТМТ «Гипермед»</div>
					<div class="content-text">
						<p><b>Адрес для корреспонденции: 107113, г. Москва, ул. Лобачика, д. 17, комната 29, ЦТМТ «Гипермед»</b>
						<p>Тел.: <a href="tel:88003505513"><b>8 800 350-55-13</b></a> (Бесплатный звонок по РФ)<br>
						Тел.: <a href="tel:84951340122"><b>8 495 134-01-22</b></a> (Для Москвы)<br>
						Е-майл: <a href="mailto:gipermed@gipermed.ru" target="_blank"><b>gipermed@gipermed.ru</b></a>
					</div>
				</div>
			</div>
			<div class="contacts-col flex-row-item">
				<div class="contacts-section">
					<div class="section-title">Складской комплекс ЦТМТ «Гипермед»</div>
					<div class="content-text">
						<p><b>Адрес: г. Москва, ул. Рябиновая, д. 37, стр. 1<br></b><br>
						GPS координаты склада:<br>
						широта - <b>55.704144</b>,<br>
						долгота - <b>37.424174</b>
						<p>Режим работы: с <b>8:00</b> до <b>17:00</b><br>
						Тел.: <a href="tel:84951184257"><b>8 495 118-42-57</b></a><br>
						Тел.: <a href="tel:"><b>8 917 569-92-17</b></a><br>
						Контактное лицо (зав. склада): Юлия Теплова
					</div>
				</div>
			</div>
			<div class="contacts-col contacts-col-full flex-row-item">
				<div class="content-title">Доступ на территорию склада</div>
				<div class="contacts-alert">
					<img src="<?= $APPLICATION->GetTemplatePath("img/alert-icon.svg"); ?>" alt="">
					<div class="contacts-alert-body">
						<p><span>На автомобиле:</span> Для проезда автотранспорта на территорию <b>пропуск не требуется.</b>
						<p><span>Пешком:</span> Для прохода пешим путем на территорию <b>необходим пропуск - предварительно закажите у сотрудников склада.</b>
					</div>
				</div>
			</div>
			<div class="contacts-col flex-row-item">
				<div class="content-title content-title-inline">
					<span>Доступ на территорию склада</span>
					<a href="<?= $APPLICATION->GetTemplatePath("img/contacts-schema-new.jpg"); ?>" class="btn print-img-btn hidden-tablet">
						<svg width="18" height="17"><use xlink:href="#icon-print"/></svg>
						<span>Распечатать схему</span>
					</a>
				</div>
				<a href="<?= $APPLICATION->GetTemplatePath("img/contacts-schema-new.jpg"); ?>" class="contacts-schema zoom-link" data-fancybox="image">
					<img src="<?= $APPLICATION->GetTemplatePath("img/contacts-schema-new.jpg"); ?>" srcset="<?= $APPLICATION->GetTemplatePath("img/contacts-schema-new.jpg"); ?> 1x,<?= $APPLICATION->GetTemplatePath("img/contacts-schema-new@2x.jpg"); ?> 2x" alt="">
					<svg width="24" height="24" class="zoom-icon"><use xlink:href="#icon-zoom"/></svg>
				</a>
				<div class="contacts-schema-desc hidden-tablet">* Схема разработана для печати на листе формата А4</div>
			</div>
			<div class="contacts-col flex-row-item">
				<div class="content-title contacts-map-title">Склад на карте</div>
				<div class="contacts-map" data-lat="55.704144" data-lng="37.424174" data-zoom="14" data-address="г. Москва, ул. Рябиновая, д. 37, стр. 1" data-caption="Рябиновая улица 37с1"></div>
				<a href="#" class="contacts-map-read-more read-more-link">
					<span>Посмотреть</span>
					<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
				</a>
			</div>
		</div>
	</div>
</div>
<div id="modal-contacts-schema" class="popup modal-contacts-schema">
	<div class="popup-body">
		<div class="modal-contacts-schema-head">
			<a href="#" class="modal-close-btn" aria-label="Закрыть">
				<svg width="14" height="14"><use xlink:href="#icon-close"/></svg>
			</a>
			<div class="modal-contacts-schema-title">Схема проезда на склад</div>
			<a href="<?= $APPLICATION->GetTemplatePath("img/contacts-schema-new.jpg"); ?>" class="btn print-img-btn hidden-tablet">
				<svg width="18" height="17"><use xlink:href="#icon-print"/></svg>
				<span>Распечатать схему</span>
			</a>
			<div class="modal-contacts-schema-desc hidden-tablet">Схема разработана для печати на<br> листе формата А4</div>
		</div>
		<div class="modal-contacts-schema-img">
			<img src="<?= $APPLICATION->GetTemplatePath("img/contacts-schema-new.jpg"); ?>" srcset="<?= $APPLICATION->GetTemplatePath("img/contacts-schema-new.jpg"); ?> 1x,<?= $APPLICATION->GetTemplatePath("img/contacts-schema-new@2x.jpg"); ?> 2x" alt="">
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>