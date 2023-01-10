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

$this->setFrameMode(true);
?>
<iframe
		src="<?=($templateFolder . '/ajax.php')?>"
		scrolling="no"
		frameborder="0"
		width="100%"
		height="100%"
		allowtransparency
		onload="onWidgetFrameLoad(0)"
		sandbox="allow-same-origin allow-top-navigation allow-scripts"
></iframe>
