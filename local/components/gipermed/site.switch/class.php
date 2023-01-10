<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class CSiteSwitch extends CBitrixComponent
{
	public function executeComponent()
	{
		$server = \Bitrix\Main\Application::getInstance()->getContext()->getServer();

		$host = $server->get("HTTP_HOST");
		$host = preg_replace("/^(.*)(ru)$/", "https://$1com/", $host);

		$this->arResult = [ "HOST" => $host ];
		$this->IncludeComponentTemplate();
	}
}