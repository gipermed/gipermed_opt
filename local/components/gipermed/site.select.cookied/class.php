<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class CSiteSelect extends CBitrixComponent
{
	public function executeComponent()
	{
		$context = \Bitrix\Main\Application::getInstance()->getContext();
		$request = $context->getRequest();
		$response = $context->getResponse();

		$cookieName = "SITE_SELECTED";

		$isAjax = $request->isAjaxRequest()
			&& $request->get("component") === "site.select"
			&& $request->get("action") === "confirm";

		$siteSelected = $request->get( $cookieName ) == "Y";
		$showAlert = $request->getCookie( $cookieName ) !== "Y";


		if ( $siteSelected || $isAjax ) {
			$cookie = new \Bitrix\Main\Web\Cookie( $cookieName , "Y" );
			$response->addCookie($cookie);
//			$GLOBALS["APPLICATION"]->RestartBuffer();
//			echo "site.select";
			//die();
		}
		elseif( $showAlert ) {
			$this->arResult["PARAM_NAME"] = $cookieName;
			$this->IncludeComponentTemplate();
		}
	}
}