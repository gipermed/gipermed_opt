<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Варианты отгрузки и способы доставки медицинских товаров и изделий в интернет магазине медицинских товаров в Москве  ⚕«Гипермед»⚕");
$APPLICATION->SetPageProperty("title", "Отгрузка и доставка медицинских изделий и расходных материалов в магазине  ⚕«Гипермед»⚕");
$APPLICATION->SetTitle("Отгрузка и Доставка");
?><div class="page page-delivery">
	<div class="page-container">
		<div class="delivery-row flex-row">
			<div class="delivery-col flex-row-item">
				<div class="section-title">Условия и сроки отгрузки</div>
				<div class="content-text">
					<p>Отгрузка продукции осуществляется с нашего склада в городе Москва.
					<p>Отгрузка производится только после поступления на расчетный счет компании ЦТМТ «Гипермед» денежных средств в размере 100% от суммы платежного документа (счета), либо после выполнения индивидуальных условий оплаты.
					<p>Информацию по срокам и условиям отгрузки товара, согласования доставки и индивидуальных условий, необходимо уточнять у специалистов отдела продаж.
					<p>Отгрузка товара осуществляется на следующий рабочий день, после получения предоплаты на расчетный счет ЦТМТ «Гипермед» (при условии наличия товара на складе).
					<p>Возможна услуга отгрузки «день в день». (Условия по данной услуге индивидуальны и требуют уточнения у специалистов отдела продаж).
				</div>
			</div>
			<div class="delivery-col flex-row-item">
				<div class="section-title">Пакет документов</div>
				<div class="content-text">
					<p>При отгрузке ЦТМТ «Гипермед» предоставляет необходимый пакет документов на доставляемые товары:</p>
					<ul>
						<li>Оригинал платежного документа (счета) с подписями ответственных лиц, и синей печатью компании;
						<li>Товарно-транспортная накладная с подписями ответственных лиц и синей печатью компании;
						<li>Счет-фактура с подписями ответственных лиц и синей печатью компании;
						<li>Оригинал договора с партнером с подписями ответственных лиц и синей печатью компании (при необходимости);
						<li>Документы качества на продукцию (при необходимости).
					</ul>
				</div>
			</div>
			<div class="delivery-col delivery-col-full flex-row-item">
				<div class="section-title">Способы отгрузки и доставки</div>
				<div class="delivery-row flex-row">
					<div class="delivery-col flex-row-item">
						<div class="delivery-section">
							<div class="delivery-section-title">
								<div class="delivery-info-icon visible-mobile">
									<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-icon-1.svg"); ?>" alt="">
								</div>
								<span>Самовывоз</span>
							</div>
							<div class="delivery-info">
								<div class="delivery-info-icon hidden-mobile">
									<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-icon-1.svg"); ?>" alt="">
								</div>
								<div class="delivery-info-body">
									<div class="content-text">
										Вы можете самостоятельно забрать товар со склада по адресу: <b>г. Москва, ул. Рябиновая, д. 37, стр. 1</b> <br>
										Услуга бесплатна для всех клиентов.
									</div>
									<div class="delivery-schema">
										<div class="delivery-schema-title">Схема проезда до склада: </div>
										<a href="https://gipermed.ru/contacts/" class="delivery-schema-link">
											<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-schema.svg"); ?>" alt="">
											<span class="read-more-link">
												<span>Подробнее</span>
												<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="delivery-section-alert">
								<div class="delivery-section-alert-icon">
									<img src="<?= $APPLICATION->GetTemplatePath("img/alert-icon.svg"); ?>" alt="">
								</div>
								<div class="delivery-section-alert-desc">Внимание!!! Обязательно наличие у представителя покупателя оригинала доверенности на право получения приобретённой продукции с подписями ответственных лиц и синей печатью компании или печать организации.</div>
							</div>
						</div>
					</div>
					<div class="delivery-col flex-row-item">
						<div class="delivery-section">
							<div class="delivery-section-title">
								<div class="delivery-info-icon visible-mobile">
									<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-icon-2.svg"); ?>" alt="">
								</div>
								<span>Доставка Москва и МО:</span>
							</div>
							<div class="delivery-info">
								<div class="delivery-info-icon hidden-mobile">
									<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-icon-2.svg"); ?>" alt="">
								</div>
								<div class="delivery-info-body">
									<div class="content-text">
										<p>Данная услуга действует только для клиентов Москвы и Московской области. 
										<p>Подробности вы можете узнать у менеджеров компании по телефону: <a href="tel:84951340122">8 (495) 134-01-22.</a>
										<p><b>Условия доставки:</b>
										<p>Заказ > 25 000 руб. - БЕСПЛАТНО<br>
										Заказ < 25 000 руб. - от 500 руб.<br>
										Возможны индивидуальные условия.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="delivery-col delivery-col-full flex-row-item">
				<div class="delivery-section">
					<div class="delivery-section-title">
						<div class="delivery-info-icon visible-mobile">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-icon-3.svg"); ?>" alt="">
						</div>
						<span>Доставка В РЕГИОНЫ</span>
					</div>
					<div class="delivery-info">
						<div class="delivery-info-icon hidden-mobile">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-icon-3.svg"); ?>" alt="">
						</div>
						<div class="delivery-info-body">
							<div class="content-text">
								<p>Доставка продукции в регионы России - осуществляется через транспортные компании. 
								<p>Доставка продукции до терминала транспортной компании в г. Москва осуществляется БЕСПЛАТНО.
								<p>Если в нашем списке транспортных компаний вы не обнаружили необходимую, то обязательно озвучьте свои пожелания в общение со специалистом отдела продаж и мы постараемся произвести доставку продукции в ваш адрес желаемой транспортной компанией.
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="delivery-companies">
			<div class="content-title">Транспортные компании</div>
			<div class="delivery-companies-row flex-row">
				<div class="delivery-companies-col flex-row-item">
					<div class="delivery-company">
						
						<div class="delivery-company-logo">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-company-logo-1.svg"); ?>" alt="">
						</div>
						<div class="delivery-company-desc">Компания ООО «Байкал Сервис ТК» предоставляет для наших клиентов 10% скидку на дополнительную упаковку (паллетный борт), а также 5% на межфилиальные перевозки.</div>
						<a href="https://www.baikalsr.ru/tools/calculator/" class="read-more-link">
							<span>Калькулятор ТК</span>
							<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
					</div>
				</div><div class="delivery-companies-col flex-row-item">
					<div class="delivery-company">
						
						<div class="delivery-company-logo">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-company-logo-2.svg"); ?>" alt="">
						</div>
						<div class="delivery-company-desc">При отправке продукции через транспортную компанию "Деловые Линии", наши клиенты получают скидку 10 % на меж терминальную перевозку, при условии указания в качестве отправителя ЦТМТ «Гипермед».</div>
						<a href="https://www.dellin.ru/requests/" class="read-more-link">
							<span>Калькулятор ТК</span>
							<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
					</div>
				</div><div class="delivery-companies-col flex-row-item">
					<div class="delivery-company">
						
						<div class="delivery-company-logo">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-company-logo-3.svg"); ?>" alt="">
						</div>
						<div class="delivery-company-desc">Компания «ПЭК» — один из крупнейших российских грузоперевозчиков, работающий на рынке с 2001 года.</div>
						<a href="https://pecom.ru/services-are/shipping-request/" class="read-more-link">
							<span>Калькулятор ТК</span>
							<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
					</div>
				</div><div class="delivery-companies-col flex-row-item">
					<div class="delivery-company">
						
						<div class="delivery-company-logo">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-company-logo-4.svg"); ?>" alt="">
						</div>
						<div class="delivery-company-desc">«ЖелДорЭкспедиция» осуществляет транспортировку товаров для физических лиц, малого, среднего и крупного бизнеса. Многочисленные филиалы обслуживания и индивидуальный подход.</div>
						<a href="https://www.jde.ru/online/calculator.html" class="read-more-link">
							<span>Калькулятор ТК</span>
							<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
					</div>
				</div><div class="delivery-companies-col flex-row-item">
					<div class="delivery-company">
						
						<div class="delivery-company-logo">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-company-logo-5.svg"); ?>" alt="">
						</div>
						<div class="delivery-company-desc">Компания Кит, а теперь GTD – это более 50 000 направлений межтерминальной перевозки. Именно развитая филиальная сеть позволяет поддерживать доступный уровень цен на доставку грузов и посылок.</div>
						<a href="https://gtdel.com/order" class="read-more-link">
							<span>Калькулятор ТК</span>
							<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
					</div>
				</div><div class="delivery-companies-col flex-row-item">
					<div class="delivery-company">
						
						<div class="delivery-company-logo">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-company-logo-6.svg"); ?>" alt="">
						</div>
						<div class="delivery-company-desc">Основным направлением деятельности ЖелдорАльянс являются грузовые перевозки по России железнодорожным и автомобильным транспортом.</div>
						<a href="https://zhdalians.ru/calculator/" class="read-more-link">
							<span>Калькулятор ТК</span>
							<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
					</div>
				</div><div class="delivery-companies-col flex-row-item">
					<div class="delivery-company">
						
						<div class="delivery-company-logo">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-company-logo-7.svg"); ?>" alt="">
						</div>
						<div class="delivery-company-desc">Транспортная компания «СТЕИЛ» оказывает полный комплекс услуг по перевозке грузов авиа, автомобильным и железнодорожным транспортом.</div>
						<a href="https://steil.ru/calc/" class="read-more-link">
							<span>Калькулятор ТК</span>
							<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
					</div>
				</div><div class="delivery-companies-col flex-row-item">
					<div class="delivery-company">
						
						<div class="delivery-company-logo">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-company-logo-8.svg"); ?>" alt="">
						</div>
						<div class="delivery-company-desc">ГлавДоставка — это экспедиционная компания с двенадцатилетней историей. Берем на себя организацию логистики для наших клиентов. Доставим ваш груз в любую точку России, Казахстана, Беларуси, Киргизии и Армении.</div>
						<a href="https://glav-dostavka.ru/clients/calc/" class="read-more-link">
							<span>Калькулятор ТК</span>
							<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
					</div>
				</div><div class="delivery-companies-col flex-row-item">
					<div class="delivery-company">
						
						<div class="delivery-company-logo">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-company-logo-9.svg"); ?>" alt="">
						</div>
						<div class="delivery-company-desc">«Норд Вил» — лидер по перевозкам сборного груза по направлению СПБ-Москва-СПб. В распоряжение клиента предоставляются автомобили разной грузоподъемности: от стандартных газелей до мощных тягачей.</div>
						<a href="https://nordwheel24.ru/kalkulyator.html" class="read-more-link">
							<span>Калькулятор ТК</span>
							<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
					</div>
				</div><div class="delivery-companies-col flex-row-item">
					<div class="delivery-company">
						
						<div class="delivery-company-logo">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-company-logo-10.svg"); ?>" alt="">
						</div>
						<div class="delivery-company-desc">Транспортная компания «Возовоз» – российская федеральная компания по перевозке сборных грузов. Осуществляются грузоперевозки по России во всех направлениях.</div>
						<a href="https://vozovoz.ru/order/create/" class="read-more-link">
							<span>Калькулятор ТК</span>
							<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
					</div>
				</div><div class="delivery-companies-col flex-row-item">
					<div class="delivery-company">
						
							<div class="delivery-company-express">Экспресс доставка</div>
						
						<div class="delivery-company-logo">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-company-logo-11.svg"); ?>" alt="">
						</div>
						<div class="delivery-company-desc">СДЭК оказывает людям и компаниям спектр услуг своевременной и гарантированной доставки, постоянно повышая уровень сервиса, внедряя новые технологии, эффективно используя внутренний потенциал и внешние ресурсы.</div>
						<a href="https://www.cdek.ru/ru/calculate" class="read-more-link">
							<span>Калькулятор ТК</span>
							<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
					</div>
				</div><div class="delivery-companies-col flex-row-item">
					<div class="delivery-company">
						
							<div class="delivery-company-express">Экспресс доставка</div>
						
						<div class="delivery-company-logo">
							<img src="<?= $APPLICATION->GetTemplatePath("img/delivery-company-logo-12.svg"); ?>" alt="">
						</div>
						<div class="delivery-company-desc">DPD в России оказывает тысячам клиентам полный комплекс транспортно-логистических услуг и доставляет по всей территории России, в Армению, Белоруссию, Казахстан, Кыргызстан а также по всему миру.</div>
						<a href="https://www.dpd.ru/ols/calc/calc.do2" class="read-more-link">
							<span>Калькулятор ТК</span>
							<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>