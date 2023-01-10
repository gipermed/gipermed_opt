<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("description", "Оптовый каталог медицинских инструментов, расходных материалов и оборудования. Продажа товаров мед. назначения оптом по низким ценам в Москве в магазине  ⚕«Гипермед»⚕");
$APPLICATION->SetPageProperty("title", "Оптовый каталог товаров медицинского назначения и расходных материалов");
$APPLICATION->SetTitle("Полный каталог товаров");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"trees",
		Array(
			"SHOW_SUBSECTIONS_NUM" => 10,
			"COMPONENT_TEMPLATE" => "tree",
			"IBLOCK_TYPE" => "ru",
			"IBLOCK_ID" => "1",
			"SECTION_ID" => ROOT_SECTION_ID,
			"SECTION_CODE" => "",
			"COUNT_ELEMENTS" => "Y",
			"TOP_DEPTH" => "3",
			"SECTION_FIELDS" => array(
				0 => "",
			),
			"SECTION_USER_FIELDS" => array(
				0 => "",
			),
			"SECTION_URL" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_GROUPS" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
		),
		false
	);?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>