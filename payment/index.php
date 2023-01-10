<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("description", "Варианты оплаты медицинских товаров и изделий в интернет магазине медицинских товаров в Москве  ⚕«Гипермед»⚕");
$APPLICATION->SetPageProperty("title", "Оплата товаров медицинского назначения в интернет магазине медтоваров ⚕«Гипермед»⚕");
$APPLICATION->SetTitle("Оплата");
?>

<div class="page page-payment">
	<div class="page-container">
		<div class="payment-row flex-row">
			<div class="payment-col payment-col-content flex-row-item">
				<div class="content-text">Все финансовые взаиморасчеты между ЦТМТ «Гипермед» и партнерами происходят на основании выставленного счета в безналичной форме и подписанного обеими сторонами Договора.</div>
			</div>
			<div class="payment-col flex-row-item">
				<div class="payment-info">
					<img src="<?= $APPLICATION->GetTemplatePath("img/info-icon.svg"); ?>" alt="">
					<div class="payment-info-desc">В ЦТМТ «Гипермед» не существует минимальной суммы счета, что позволяет нашим партнерам не привязываться к определенному объёму выкупа товара.</div>
				</div>
			</div>
		</div>
		<div class="payment-content">
			<div class="content-title">ЦТМТ «Гипермед» рассматривает следующие варианты сотрудничества со своими Партнерами по условиям оплаты товара:</div>
			<div class="payment-advantages">
				<div class="payment-advantages-row flex-row">
					<div class="payment-advantages-col flex-row-item">
						<div class="payment-advantage">
							<div class="content-text">100% предоплата. - Условия сотрудничества для новых Партнеров.</div>
						</div>
					</div>
					<div class="payment-advantages-col flex-row-item">
						<div class="payment-advantage">
							<div class="content-text">70% предоплата и последующая доплата 30% в течение 30 дней<br> с момента отгрузки товара.</div>
						</div>
					</div>
					<div class="payment-advantages-col flex-row-item">
						<div class="payment-advantage">
							<div class="content-text">
								<p>Отгрузка товара БЕЗ ПРЕДОПЛАТЫ,<br> с отсрочкой платежа до 30 дней. 
								<p>Данный вариант сотрудничества согласовывается в индивидуальном порядке.
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="payment-contacts">
				<p>Более подробную информацию по системе оплаты, скидкам и актуальности цен, вы можете узнать связавшись с нашими специалистами:
				<p>Тел.: <a href="tel:88003505513">8 800 350-55-13</a> (Бесплатный звонок по РФ)
				<p>Тел.: <a href="tel:84951340122">8 495 134-01-22</a> (Для Москвы)
				<p>Е-майл: <a href="mailto:gipermed@gipermed.ru" target="_blank">gipermed@gipermed.ru</a>
			</div>
		</div>
	</div>
</div>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>