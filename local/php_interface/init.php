<?

define('PATH_TO_404', '/404.php');
define('DEFAULT_TEMPLATE_PATH', '/local/templates/.default/');
define('DEFAULT_SITE_ID', 's1');
define('ROOT_SECTION_ID', 753);
define('ALT_SECTION_ID', 631);

//include_once 'lib/signer.php';

function cache( $id, $ttl, $path, $tag, $func, $params = [] ) {
	$cache = \Bitrix\Main\Data\Cache::createInstance();
	$value = array();

	if ($cache->initCache($ttl, $id, $path)) {
		$value = $cache->getVars();
	}
	elseif ($cache->startDataCache()) {
		$value = $func($params);

		if ($tag) {
			$cache_manager = \Bitrix\Main\Application::getInstance()->getTaggedCache();
			$cache_manager->startTagCache($path);
			$cache_manager->registerTag($tag);
			$cache_manager->endTagCache();
		}

		$cache->endDataCache($value);
	}

	return $value;
}


function getSectionTree() {
	$carIbId = 1;
	$cacheTag = "iblock_id_$carIbId";
	$cachePath = "/" . SITE_ID . "/rngdv/catalog-sections/";



	$getSectionTree = function () {
		\CModule::IncludeModule("iblock");

		$sort = ["left_margin" => "asc"];
		$select = [ "ID", "NAME", "CODE", "IBLOCK_SECTION_ID" ];
		$filter = [
			"ACTIVE" => "Y",
			"GLOBAL_ACTIVE" => "Y",
		];

		$rs = \CIBlockSection::GetList( $sort, $filter, false, $select );
		$tree = [];

		while ($row = $rs->Fetch()) {
			$id = $row[ "ID" ];
			$tree[ $id ] = [
				"PARENT" => $row[ "IBLOCK_SECTION_ID" ],
				"CODE" => $row[ "CODE" ]
			];
		}

		return $tree;
	};

	return cache( ROOT_SECTION_ID, 86400, $cachePath, $cacheTag, $getSectionTree );
}

function getCatalogSectionUrl($id, $rootSectionId = ROOT_SECTION_ID) {
	$sections = getSectionTree();
	$currUrl = "";

	// Вряд ли будет больше разделов в урле. Пусть будет так вместо вечного цикла
	for ( $i = 0; $i < 20; $i++ ) {
		if ( $id == $rootSectionId ) {
			return "/catalog/$currUrl";
		}
		else {
			$code = $sections[$id]["CODE"];
			$currUrl = "$code/$currUrl";
		}

		$id = $sections[$id]["PARENT"];
		if ( !$id ) break;
	}

	return "/catalog/$currUrl/";
}

function getCatalogProductSections($id) {

	$getCatalogProductSections = function ($id) {
		\CModule::IncludeModule("iblock");
		$res = \CIBlockElement::GetElementGroups($id, true);

		$sections = [];
		while ($row = $res->GetNext()) {
			$sections[] = $row["ID"];
		}

		return $sections;
	};

	$catIbId = 1;
	$cacheTag = "iblock_id_$catIbId";
	$cachePath = "/" . SITE_ID . "/rngdv/catalog-product-sections/";

	return cache( $id, 86400, $cachePath, $cacheTag, $getCatalogProductSections, $id );
}

function getCatalogProductUrl($id, $forCurrentSite = null) {
	$catIbId = 1;
	$cacheTag = "iblock_id_$catIbId";
	$cachePath = "/" . SITE_ID . "/rngdv/catalog-product-url/";

	$getProductUrls = function ($id) {
		\CModule::IncludeModule("iblock");


		$elementCode = \Bitrix\Iblock\ElementTable::getRow([
			'filter' => ['=ID' => $id],
			'select' => ['CODE'],
			'cache' => ['ttl' => 60 * 60 * 24 * 30 * 6],
		])['CODE'];

		return [
			'curr' => '/product/' . $elementCode . '/',
			'alt' => '/product/' . $elementCode . '/',
		];

		$res = \CIBlockElement::GetElementGroups($id, true);

		$sections = getSectionTree();
		$urls = [];

		while ($row = $res->GetNext()) {
			$currSectionId = $row["ID"];
			$currUrl = "";

			// Вряд ли будет больше разделов в урле. Пусть будет так вместо вечного цикла
			for ( $i = 0; $i < 20; $i++ ) {
				if ( $currSectionId == ROOT_SECTION_ID ) {
					$urls["curr"] = "/catalog/$currUrl$id/";
					break;
				}
				elseif ( $currSectionId == ALT_SECTION_ID ) {
					$urls["alt"] = "/catalog/$currUrl$id/";
					break;
				}
				else {
					$currSectionCode = $sections[$currSectionId]["CODE"];
					$currUrl = "$currSectionCode/$currUrl";
				}

				$currSectionId = $sections[$currSectionId]["PARENT"];

				if ( !$currSectionId ) break;
			}
		}

		return $urls;
	};

	$urls = cache( $id, 86400, $cachePath, $cacheTag, $getProductUrls, $id );
	//$urls = $getProductUrls($id);

	if ( !isset($forCurrentSite) ) return $urls;

	return $urls[ $forCurrentSite ? "curr" : "alt" ];

}





function getDirPropertyList( $tableName, $arCodes = array(), $arResize = false ) {
	CModule::IncludeModule('highloadblock');

	$filter = array( "TABLE_NAME" => $tableName );
	$query = array( "filter" => $filter );
	$hldata = Bitrix\Highloadblock\HighloadBlockTable::getList( $query )->fetch();


	$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
	$entityClass = $entity->getDataClass();


	$query = array( "select" => array("*") );

	if ( is_array( $arCodes ) && count( $arCodes ) > 0 ) {
		$query[ "filter" ] = array( "UF_XML_ID" => $arCodes );
	}

	$res = $entityClass::getList( $query );
	$ar = array();
	while ( $row = $res->fetch() ) {
		$code = $row[ "UF_XML_ID" ];

		if ( $row[ "UF_FILE" ] && is_array( $arResize ) && is_array( $arResize["SIZE"] ) && isset( $arResize["TYPE"] ) ) {
			$arImg = \CFile::ResizeImageGet(
				$row[ "UF_FILE" ],
				$arResize[ "SIZE" ],
				$arResize[ "TYPE" ]
			);

			$row[ "SRC" ] = $arImg[ "src" ];
		}


		$ar[ $code ] = $row;
	}

	return $ar;
}


function getCatalogIconColor( $arProps ) {
	$arIconProps = array(
		"NEW_RETAIL" 			=> "orange",
		"SALE_RETAIL" 			=> "dark-red",
		"STOCK_RETAIL" 			=> "green",
		"REJECT_RETAIL" 		=> "dark-green",
		"PROD_OF_MONTH_RETAIL" 	=> "blue"
	);

	$arProdIcons = array();

	foreach ( $arIconProps as $prop => $color ){
		if ( $arProps[$prop]["VALUE"] )
			$arProdIcons[$prop] = array(
				"COLOR" => $color,
				"TEXT" => GetMessage("CATALOG_ICON_PROP_$prop")
			);
	}

	return $arProdIcons;
}


if ( !function_exists("pw") ){
	function pw($value, $word0, $word1, $word2) {
		if 		(preg_match('/1\d$/', $value)) 		{ return $word2; }
		elseif 	(preg_match('/1$/', $value)) 		{ return $word0; }
		elseif 	(preg_match('/(2|3|4)$/', $value))	{ return $word1; }
		else 										{ return $word2; }
	}
}

if ( !function_exists("compareBySort") ) {
	function compareBySort($a, $b) {
		if ($a["SORT"] == $b["SORT"]) {
			return 0;
		}
		return ($a["SORT"] < $b["SORT"]) ? -1 : 1;
	}
}


AddEventHandler("main", "OnAfterUserRegister", "OnAfterUserRegisterHandler");

function OnAfterUserRegisterHandler(&$arFields)
{
	\Bitrix\Main\Loader::includeModule('sale');

	//создаём профиль
	//PERSON_TYPE_ID - идентификатор типа плательщика, для которого создаётся профиль
	$arProfileFields = array(
		"NAME" => "Профиль покупателя (".$arFields['LOGIN'].')',
		"USER_ID" => $arFields['USER_ID'],
		"PERSON_TYPE_ID" => 1
	);
	$PROFILE_ID = CSaleOrderUserProps::Add($arProfileFields);

	//если профиль создан
	if ($PROFILE_ID)
	{
		//формируем массив свойств
		$PROPS=Array(
			array(
				"USER_PROPS_ID" => $PROFILE_ID,
				"ORDER_PROPS_ID" => 1,
				"NAME" => "Ф.И.О.",
				"VALUE" => $arFields['LAST_NAME'].' '.$arFields['NAME'].' '.$arFields['SECOND_NAME']
			),
			array(
				"USER_PROPS_ID" => $PROFILE_ID,
				"ORDER_PROPS_ID" => 2,
				"NAME" => "E-Mail",
				"VALUE" => $arFields['EMAIL']
			),
			array(
				"USER_PROPS_ID" => $PROFILE_ID,
				"ORDER_PROPS_ID" => 3,
				"NAME" => "Телефон",
				"VALUE" => $arFields['WORK_PHONE']
			),
		);
		//добавляем значения свойств к созданному ранее профилю
		foreach ($PROPS as $prop)
			CSaleOrderUserPropsValue::Add($prop);
	}
}


AddEventHandler('sale', 'OnOrderNewSendEmail', 'OnOrderNewSendEmailHandler');

function OnOrderNewSendEmailHandler($ID, &$eventName, &$arFields) {
	if ($ID>0 && CModule::IncludeModule('iblock')) {
		$arFields['ORDER_LIST'] = '<table cellpadding="5" cellspacing="5">';
		$rsBasket = CSaleBasket::GetList(array(), array('ORDER_ID' => $ID));
		while ($arBasket = $rsBasket->GetNext()) {
			$arPicture = false;
			//мы берем картинку только если это товар из инфоблока
			if ($arBasket['MODULE'] == 'catalog') {
				if ($arProduct = CIBlockElement::GetByID($arBasket['PRODUCT_ID'])->Fetch()) {
					if ($arProduct['PREVIEW_PICTURE'] > 0) {
						$fileID = $arProduct['PREVIEW_PICTURE'];
					} elseif ($arProduct['DETAIL_PICTURE'] > 0) {
						$fileID = $arProduct['DETAIL_PICTURE'];
					} else {
						$fileID = 0;
					}
					$arPicture = CFile::ResizeImageGet($fileID, array('width' => 90, 'height' => 110));
					$arPicture['SIZE'] = getimagesize($_SERVER['DOCUMENT_ROOT'].$arPicture['src']);
				}
			}
			$arFields['ORDER_LIST'] .= '<tr valign="top">'
				. '<td>'.($arPicture ? '<img src="http://'.$GLOBALS['SERVER_NAME'].(str_replace(array('+', ' '), '%20', $arPicture['src'])).'" width="'.$arPicture['SIZE'][0].'" height="'.$arPicture['SIZE'][1].'" alt="">' : '').'</td>'
				. '<td>'.$arBasket['NAME'].'</td>'
				. '<td style="white-space: nowrap">'.(int)$arBasket['QUANTITY'].' шт.</td>'
				. '<td style="white-space: nowrap">'.SaleFormatCurrency($arBasket['PRICE'], $arBasket['CURRENCY']).'</td>'
				. '</tr>';
		}
		$arFields['ORDER_LIST'] .= '</table>';
	}
}




function unpublishedProductsMustBeHidden() {
	if ( CUser::IsAuthorized() ) {
		$arUserGroups = CUser::GetUserGroupArray();

		foreach ( [1, 5, 6] as $idGroup ) {
			if ( in_array( $idGroup, $arUserGroups ) ) {
				return false;
			}
		}
	}

	return true;
}



function userIsContentManager() {
	$arUserGroups = CUser::GetUserGroupArray();

	return in_array( 5, $arUserGroups );
}




AddEventHandler("sale", "OnSaleBeforeStatusOrder", "OnSaleBeforeStatusOrderHandler");

function OnSaleBeforeStatusOrderHandler( $ID, $val ) {

	if ( $val === "G" ) {
		\Bitrix\Main\Loader::includeModule("sale");
		$order = \Bitrix\Sale\Order::load($ID);
		$paymentCollection = $order->getPaymentCollection();

		foreach ($paymentCollection as $payment) {

			// Теоретически, для всех модулей онлайн оплаты (то есть, те, которые печаюат чеки)
			//$onlinePayment = "Y" === $payment->getPaySystem()->getField("CAN_PRINT_CHECK");

			// Только  для модуля Vampirus;
			$action = $payment->getPaySystem()->getField("ACTION_FILE");
			$onlinePayment = $action === "yandexcheckoutvs";

			$isPaid = $payment->isPaid();

			if ( $onlinePayment && !$isPaid ) {
				// я в душе не ебу как еще можно показать эту блядскую ошибку
				// оно не хочет жрать ни исключений (ни через $APPLICATION, ни просто так),
				// ни EventResult::ERROR, ни чего бы то ни было еще
				// пидор, блядь
				echo json_encode([
					"RESULT" => "ERROR",
					"ERROR" => "Невозможно установить статус 'Передан в доставку', пока заказ не будет оплачен онлайн"
				]);

				die();
			}
		}
	}
}



AddEventHandler("iblock", "OnBeforeIBlockElementDelete", "DenyDeletionForContentManager");

function DenyDeletionForContentManager($ID)
{
	if ( userIsContentManager() )
	{
		CModule::IncludeModule("iblock");

		$rs = CIBlockElement::GetByID($ID);

		if ( $rw = $rs->GetNext() )
		{
			if ( $rw["CREATED_BY"] != CUser::GetID() )
			{
				global $APPLICATION;
				$APPLICATION->throwException("Вам запрещено удалять этот элемент");
				return false;
			}
		}
	}
}



AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "DenyPublicationForContentManager");
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "DenyPublicationForContentManager");

function DenyPublicationForContentManager(&$arFields)
{
	$itemId = $arFields["ID"];
	$iblockId = $arFields["IBLOCK_ID"];

	if ( $iblockId === 1 && userIsContentManager() ) {
		$isPublished = $arFields["PROPERTY_VALUES"]["34"] != "";
		$wasPublished = false;

		if ( $itemId ) {
			CModule::IncludeModule("iblock");
			$filter = ["CODE" => "PUBLISH"];
			$rs = CIBlockElement::GetProperty( $iblockId, $itemId, [], $filter );
			$rw = $rs->GetNext();
			$wasPublished = $rw["VALUE"] != "";
		}

		global $APPLICATION;

		if ( !$wasPublished && $isPublished )
		{
			$APPLICATION->throwException("Вам запрещено публиковать элементы");
			return false;
		}
		elseif ( $wasPublished && !$isPublished )
		{
			$APPLICATION->throwException("Вам запрещено снимать элементы с публикации");
			return false;
		}
	}
}




AddEventHandler('main', 'OnBeforeEventSend', "OnBeforeEventSendHandler");
function OnBeforeEventSendHandler(&$arFields, $arTemplate, $context)
{
	if ( $arTemplate["EVENT_NAME"] === "SALE_NEW_ORDER" ) {
		$orderId = $arFields["ORDER_ID"];
		$content = $GLOBALS["APPLICATION"]->IncludeComponent("rngdv:order.info", "", ["ORDER_ID" => $orderId], false);
		$arFields["MANAGER_CONTENT"] = $content;
	}
}



AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "DropCommentCache");
function DropCommentCache(&$arFields) {
	$iblockId = $arFields["IBLOCK_ID"];
	$isPublished = $arFields["PROPERTY_VALUES"]["55"] != "";
	$objectId = array_values($arFields["PROPERTY_VALUES"]["54"])[0]["VALUE"];

	//\Bitrix\Main\Diag\Debug::writeToFile($iblockId, '$iblockId', "_____rev.txt");
	//\Bitrix\Main\Diag\Debug::writeToFile($isPublished, '$isPublished', "_____rev.txt");
	//\Bitrix\Main\Diag\Debug::writeToFile($objectId, '$objectId', "_____rev.txt");
	//\Bitrix\Main\Diag\Debug::writeToFile($arFields, '$arFields', "_____rev.txt");
	//\Bitrix\Main\Diag\Debug::writeToFile($iblockId === 6 && $isPublished && $objectId, '$iblockId === 6 && $isPublished && $objectId', "_____rev.txt");

	if ( $iblockId === 6 && $isPublished && $objectId ) {
		$cache_manager = \Bitrix\Main\Application::getInstance()->getTaggedCache();
		$cache_manager->clearByTag("review_target_" . $objectId);
		$cache_manager->clearByTag("review_target_rates_" . $objectId);
		$cache_manager->clearByTag("review_target_summary_" . $objectId);
	}
}

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate","ExcludeFields");

function ExcludeFields(&$arFields)
{
    if ($_REQUEST['mode']=='import')
    {
    	$fieldsToRemove = [
    		"NAME",
			"DETAIL_TEXT",
			"DETAIL_TEXT_TYPE",
			"PREVIEW_TEXT",
			"PREVIEW_TEXT_TYPE",
			"SEARCHABLE_CONTENT",
			"IBLOCK_SECTION"
		];

    	foreach ($fieldsToRemove as $field) {
			unset($arFields[$field]);
		}

		Bitrix\Main\Diag\Debug::writeToFile('test5',serialize($arFields),"test.txt");
    } else {
    	Bitrix\Main\Diag\Debug::writeToFile('test','Condition not work',"test.txt");
	}
}
function dd($in,$opened = true){
    if($opened)
        $opened = ' open';
    if(is_object($in) or is_array($in)){
        echo '<div>';
            echo '<details'.$opened.'>';
                echo '<summary>';
                    echo (is_object($in)) ? 'Object {'.count((array)$in).'}':'Array ['.count($in).']';
                echo '</summary>';
                pretty_print_rec($in, $opened);
            echo '</details>';
        echo '</div>';
    }
}
function pretty_print_rec($in, $opened, $margin = 10){
    if(!is_object($in) && !is_array($in)) 
        return;

    foreach($in as $key => $value){
        if(is_object($value) or is_array($value)){
            echo '<details style="margin-left:'.$margin.'px" '.$opened.'>';
                echo '<summary>';
                    echo (is_object($value)) ? $key.' {'.count((array)$value).'}':$key.' ['.count($value).']';
                echo '</summary>';
                pretty_print_rec($value, $opened, $margin+10);
            echo '</details>';
        }
        else{
            switch(gettype($value)){
                case 'string':
                    $bgc = 'red';
                break;
                case 'integer':
                    $bgc = 'green';
                break;
            }
            echo '<div style="margin-left:'.$margin.'px">'.$key . ' : <span style="color:'.$bgc.'">' . $value .'</span> ('.gettype($value).')</div>';
        }
    }
}

/**
 * Возвращает значение из таблицы
 * @param $hlbName string название таблицы
 * @param $code string - внешний код элемента таблицы, по которому производится поиск
 * @param $col string  - названия поля таблицы значение которого хотим вернуть
 */

use Bitrix\Main\Loader;
use \Bitrix\Highloadblock as HL;
use CIBlockElement;

function getValFromHLB($hlbName, $code, $col = 'UF_NAME') {


	if ( Loader::IncludeModule('highloadblock') && !empty($hlbName) )
	{
		$hlblock = HL\HighloadBlockTable::getRow([
			'filter' => [
				'=TABLE_NAME' => $hlbName
			],
		]);
		if ( $hlblock )
		{
			$entity      = HL\HighloadBlockTable::compileEntity( $hlblock );
			$entityClass = $entity->getDataClass();

			$arRecords = $entityClass::getList([]);
			foreach ($arRecords as $record)
			{

				if($record['UF_XML_ID'] == $code) {
					return $record[$col];
				}
			}
		}
	}
}

$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandlerCompatible('search', 'BeforeIndex',    ['\\CatalogProductIndexer','handleBeforeIndex']);


class CatalogProductIndexer
{
  /**
   * @var int Идентификатор инфоблока каталога 
   */
  const IBLOCK_ID = '1';

  /**
   * Дополняет индексируемый массив нужными значениями
   * подписан на событие BeforeIndex модуля search
   * @param array $arFields 
   * @return array
   */
  public static function handleBeforeIndex( $arFields = [] )
  {
    if ( !static::isInetesting( $arFields ) )
    {
      return $arFields;
    }

    /**
     * @var array Массив полей элемента, которые нас интересуют
     */
    $arSelect = [
      'ID',
      'IBLOCK_ID',
      'PROPERTY_ART_NUMBER'
    ];

    /**
     * @var CIblockResult Массив описывающий индексируемый элемент
     */
    $resElements = \CIBlockElement::getList(
      [],
      [
        'IBLOCK_ID' => $arFields['PARAM2'],
        'ID'        => $arFields['ITEM_ID']
      ],
      false,
      [
        'nTopCount'=>1
      ],
      $arSelect
    );

    /**
     * В случае, если элемент найден мы добавляем нужные поля 
     * в соответсвующие столбцы поиска
     */
    if ( $arElement = $resElements->fetch() )
    {
      $arFields['TITLE'] .= ' '.$arElement['PROPERTY_ART_NUMBER_VALUE'];
    }

    return $arFields;
  }

  /**
   * Возвращает true, если это интересующий нас элемент
   * @param array $fields 
   * @return boolean
   */
  public static function isInetesting( $fields = [] )
  {
    return ( $fields["MODULE_ID"] == "iblock" && $fields['PARAM2'] == static::IBLOCK_ID );
  }

}

if (!function_exists('custom_mail') && COption::GetOptionString("webprostor.smtp", "USE_MODULE") == "Y")
{
	function custom_mail($to, $subject, $message, $additional_headers='', $additional_parameters='')
	{
		if(CModule::IncludeModule("webprostor.smtp"))
		{
			$smtp = new CWebprostorSmtp("s1");
			$result = $smtp->SendMail($to, $subject, $message, $additional_headers, $additional_parameters);

			if($result)
				return true;
			else
				return false;
		}
	}
}
