<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

global $APPLICATION;
if (\Grastin\Delivery\Options::needIncludeJquery()) {
	CJSCore::Init(array("jquery"));
}
CJsCore::Init(array('arcticmodal'));