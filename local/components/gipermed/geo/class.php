<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;

class CGeo extends CBitrixComponent {

	public function executeComponent()
	{
		$context = \Bitrix\Main\Application::getInstance()->getContext();
		$req = $context->getRequest();
		$res = $context->getResponse();

		$isAjax =
			$req->isAjaxRequest() &&
			$req->get( "component" ) == "geo"
		;

		if ( $isAjax ) {
			$location = $req->get( "location" );

			$_SESSION[ "location" ] = $location;

			$cookie = new \Bitrix\Main\Web\Cookie( "location", $location );
			$res->addCookie( $cookie );
		}
		else {
			$location = $_SESSION[ "location" ];

			if ( !$location ) {
				$location = $req->getCookie( "location" );
			}

			$this->arResult = [ "LOCATION" => $location ];

			if ( strlen( $location ) <= 0 ) {
				$this->arResult[ "ASK_LOCATION" ] = "Y";
			}

			$this->IncludeComponentTemplate();
		}
	}
}