<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class CCookieAlert extends CBitrixComponent
{
	public function executeComponent()
	{
		$context = \Bitrix\Main\Application::getInstance()->getContext();
		$request = $context->getRequest();
		$response = $context->getResponse();

		$cookieName = "HIDE_COOKIE_ALERT";

		$isAjax = $request->isAjaxRequest()
			&& $request->get("component") === "cookie.alert"
			&& $request->get("action") === "confirm";

		$showAlert = $request->getCookie( $cookieName ) !== "Y";


		if ( $isAjax ) {
			$cookie = new \Bitrix\Main\Web\Cookie( $cookieName , "Y" );
			$response->addCookie($cookie);
		}
		elseif( $showAlert ) {
			$this->IncludeComponentTemplate();
		}
	}
}