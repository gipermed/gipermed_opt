<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if ($request->isAjaxRequest() && $request->get('action') === 'showMore') {
	$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");

	$content = ob_get_contents();
	ob_end_clean();

	list(, $itemsContainer) = explode('<!--items-container-->', $content);
	list(, $paginationContainer) = explode('<!--pagination-container-->', $content);

	$GLOBALS['APPLICATION']->RestartBuffer();

	echo json_encode(array(
		'items' => $itemsContainer,
		'pagination' => $paginationContainer
	));

	die();
}