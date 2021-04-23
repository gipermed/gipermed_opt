<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class CElementTemplate extends CBitrixComponent {
	public function executeComponent() {
		$this->arResult = $this->arParams;
		$this->IncludeComponentTemplate();
	}
}