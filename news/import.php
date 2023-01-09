<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
Text here....
<?
// function executeComponent() {
	\CModule::IncludeModule("iblock");
//$internal = $this->getResultCached();
$internal = 15;

//$url =  $this->arParams[ "URL" ] . "/news-export.php";
$url =  "https://gipermed.info/news-export.php";

//if ( $this->arParams[ "FULL_UPDATE" ] != "Y" )
//	$url .= "?UPDATED_ONLY=Y";

//	$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
//	$context = stream_context_create($opts);
//
//	$external = file_get_contents( $url,false,$context );
//	$external = unserialize($external);
//	var_dump($external);
//echo"php";

	$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
		$query = curl_exec($curl_handle);
		$external = unserialize($query);
		curl_close($curl_handle);
print_r($query);

/*$ch = curl_init('https://gipermed.info/news-export.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
 
echo $http_code; // Выведет: 200*/


//	$cibe = new \CIBlockElement();

/*		foreach ( $external as $extId => $extItem ) {
			$intItem = $internal[ $extId ];
			$intId = $intItem[ "ID" ];

			$extItem[ "PROPERTY_VALUES" ][ "HASH" ] = $extItem[ "HASH" ];

			$update = false;
			$add = false;

			if ( $extItem[ "ACTIVE" ] == "N" ) {
				if ( $intItem[ "ACTIVE" ] == "Y" ) {
					$update = true;

				}
			}
			elseif ( empty( $intItem ) ) {
				$add = true;
			}
			elseif ( $extItem[ "HASH" ] != $intItem[ "HASH" ] ) {
				$update = true;
			}




			if ( $add || $update ) {
				$extItem[ "DETAIL_TEXT" ] = $extItem[ "PREVIEW_TEXT" ];
				$extItem[ "DETAIL_TEXT_TYPE" ] = "html";

				$extItem[ "PROPERTY_VALUES" ][ "HASH" ] = $extItem[ "HASH" ];
				$extItem[ "PROPERTY_VALUES" ][ "EXT_ID" ] = $extId;

				$arPhoto = $extItem[ "PHOTO" ];
				if ( count( $arPhoto ) ) {
					$arImg = \CFile::MakeFileArray( $this->arParams[ "URL" ] . $arPhoto[0] );
					$extItem[ "DETAIL_PICTURE" ] = $arImg;
				}

				unset( $extItem[ "HASH" ] );
				unset( $extItem[ "PREVIEW_TEXT" ] );

			}


			if ( $add ) {
				echo "add $extId ";
				$extItem[ "IBLOCK_ID" ] = $this->arParams[ "IBLOCK_ID" ];
				$cibe->Add( $extItem );

				echo $cibe->LAST_ERROR, "<br>";
			}
			elseif ( $update ) {
				echo "update $intId ";
				$cibe->Update( $intId, $extItem );

				echo $cibe->LAST_ERROR, "<br>";
			}
			else {
				//echo "nothing to do", "<br>";
			}

}*/
	//	}

 function getResultCached() {
	 /*$cache = \Bitrix\Main\Data\Cache::createInstance();

		$cacheTtl = $this->arParams["CACHE_TIME"];
		$cacheId = md5( $this->arParams[ "IBLOCK_ID" ] );
		$cachePath = self::CACHE_PATH;

		$value = array();


		if ($cache->initCache($cacheTtl, $cacheId, $cachePath)) {
			$value = $cache->getVars();
		}
		elseif ($cache->startDataCache()) {
			$value = $this->getResult();

			$cache_manager = \Bitrix\Main\Application::getInstance()->getTaggedCache();
			$cache_manager->startTagCache($cachePath);
			$cache_manager->registerTag("iblock_id_" . $this->arParams["IBLOCK_ID"]);
			$cache_manager->endTagCache();

			$cache->endDataCache($value);
		}

return $value;*/
	}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>