<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="menu">
	<ul>
		<?foreach ($arResult as $arItem):?>
			<li>
				<a href="<?=$arItem["LINK"]?>" class="c-black linkRedHover linkDotted keepDotted" title="<?=$arItem["TEXT"]?>">
					<span class="linkDotted"><?=$arItem["TEXT"]?></span>
				</a>
			</li>
		<?endforeach?>
	</ul>
</div>

<?/*?>
	<div class="menu">
		<ul>
			<li>
				<a class="c-black linkRedHover keepUnderline" href="//belgorod.vseinstrumenti.ru/selfDelivery/363.html" target="_self" title="Адреса магазинов">
					Адреса магазинов
				</a>
			</li>
			<li class="withChilds">
				<a href="javascript:void(0)" class="c-black linkRedHover linkDotted keepDotted" title="Получение и оплата"><span class="linkDotted">Получение и оплата</span></a>
				<ul style="padding-right: 6px; -moz-padding-end: 6px;">
					<li>
						<a class="c-black no_und linkRedHover" href="//belgorod.vseinstrumenti.ru/cityDelivery/">Доставка курьером</a>
					</li>
					<li>
						<a class="c-black no_und linkRedHover" href="//www.vseinstrumenti.ru/regionDelivery/">Доставка транспортной компанией</a>
					</li>
					<li>
						<a class="c-black no_und linkRedHover" href="//belgorod.vseinstrumenti.ru/selfDelivery/363.html">Самовывоз</a>
					</li>
					<li>
						<a class="c-black no_und linkRedHover" href="//www.vseinstrumenti.ru/payments/">Способы оплаты</a>
					</li>
				</ul>
			</li>
			<li class="withChilds">
				<a class="c-black linkRedHover linkDotted keepDotted" href="javascript:void(0)" title="Сервис"><span class="linkDotted">Сервис</span></a>
				<ul>
					<li>
						<a class="c-black no_und linkRedHover" href="http://service.vseinstrumenti.ru/" target="_blank" rel="nofollow">Сервисный центр ВсеИнструменты.ру</a>
					</li>
					<li>
						<a class="c-black no_und linkRedHover" href="https://www.vseinstrumenti.ru/service/">Сервисные центры производителей</a>
					</li>
					<li>
						<a class="c-black no_und linkRedHover" href="//www.vseinstrumenti.ru/pretension/">Отдел претензий</a>
					</li>
				</ul>
			</li>
			<li class="withChilds redArrowDown">
				<a class="linkRedHover linkDotted keepDotted" target="_blank" href="javascript:void(0)" title="Компаниям">
					<span class="linkDotted">Компаниям</span>
				</a>
				<ul style="-moz-padding-end: 4px;">
					<li>
						<a target="_blank" class="c-black no_und linkRedHover" href="https://company.vseinstrumenti.ru/" rel="nofollow">
							Организациям
						</a>
					</li>
					<li>
						<a target="_blank" class="c-black no_und linkRedHover" href="//www.vseinstrumenti.ru/b2b/franshiza_dlya_malogo_biznesa/">Франшиза</a>
					</li>
				</ul>
			</li>
			<li>
				<a class="c-black linkRedHover keepUnderline" href="//belgorod.vseinstrumenti.ru/contacts/363.html" title="Контакты">
					Контакты
				</a>
			</li>
		</ul>
	</div>
<?/**/?>