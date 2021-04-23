<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class CSortPanel extends CBitrixComponent {

	public function executeComponent()
	{
		$req = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

		$arReturn = $this->processSortParams( $req );
		$arReturn[ "SHOW_BY" ] = $this->processShowBy( $req );

		$this->IncludeComponentTemplate();

		return $arReturn;
	}

	private function processShowBy( $req )
	{
		$rQty = intval( $req->get("showBy") );
		$sQty = intval( $_SESSION["showBy"] );

		if ( $rQty ) 		$qty = $rQty;
		elseif ( $sQty ) 	$qty = $sQty;
		else 				$qty = $this->arParams[ "SHOW_BY" ][ 0 ];

		$_SESSION["showBy"] = $qty;

		$this->createResultShowByList( $qty );

		return $qty;
	}

	private function createResultShowByList( $qty )
	{
		$this->arResult[ "SHOW_BY" ] = $qty;
		$this->arResult[ "SHOW_BY_LIST" ] = array();
		foreach ( $this->arParams[ "SHOW_BY" ] as $item ) {
			$this->arResult[ "SHOW_BY_LIST" ][] = array(
				"VALUE" => $item,
				"SELECTED" => $item == $qty ? "Y" : "N",
				"URL" => $this->makeUrl( "showBy=$item" )
			);
		}
	}


	private function processSortParams( $req )
	{
		// sort
		$rSort = $req->get("sort");
		$sSort = $_SESSION["sort"];

		$rSort = $this->checkSortParam( $rSort );
		$sSort = $this->checkSortParam( $sSort );


		$defaultSort = $this->arParams[ "SORT_DEF" ];

		if ( $rSort ) 		$sort = $rSort;
		elseif ( $sSort ) 	$sort = $sSort;
		else 				$sort = $defaultSort;

		// order
		$sOrder = $_SESSION["order"];
		$rOrder = $req->get("order");

		$rOrder = $this->checkSortOrder( $rOrder );
		$sOrder = $this->checkSortOrder( $sOrder );

		$defaultOrder = $this->arParams[ "SORT" ][ $sort ][ "DEF_DIR" ];
		$defaultOrder = $this->checkSortOrder( $defaultOrder, false );

		if ( $rOrder ) 		$order = $rOrder;
		elseif ( $sOrder ) 	$order = $sOrder;
		else 				$order = $defaultOrder;



		$_SESSION["sort"] = $sort;
		$_SESSION["order"] = $order;



		$this->createResultSortList( $sort, $order );

		return array(
			"SORT" => $this->arParams[ "SORT" ][ $sort ][ "PARAM" ],
			"ORDER" => $order,
		);
	}

	private function createResultSortList( $sort, $order )
	{
		$this->arResult[ "SORT" ] = $sort;
		$this->arResult[ "ORDER" ] = $order;
		$this->arResult[ "SORT_LIST" ] = array();
		foreach( $this->arParams[ "SORT" ] as $code => $arSortParam ) {
			$selected = $sort == $code;

			if ( $selected ) {
				$currOrder = $order;
				$nextOrder = strtolower( $order ) == "asc" ? "DESC" : "ASC";
			}
			else {
				$currOrder = false;
				$nextOrder = strtolower( $arSortParam[ "DEF_DIR" ] ) == "asc" ? "ASC" : "DESC";
			}

			$arSortParam[ "SELECTED" ] = $selected ? "Y" : "N";
			$arSortParam[ "ORDER" ] = $currOrder;
			$arSortParam[ "URL" ] = $this->makeUrl(	"sort=$code&order=$nextOrder" );

			$this->arResult[ "SORT_LIST" ][ $code ] = $arSortParam;
		}

	}

	private function checkSortParam( $p )
	{
		return isset($p) && $p != "" && is_array( $this->arParams["SORT"][$p] )
			? $p
			: false;
	}

	private function checkSortOrder( $p, $checkForEmpty = true )
	{
		if ( $checkForEmpty ) {
			if ( !isset( $p ) ) return false;
			if ( $p == "" ) return false;
		}

		return strtolower( $p ) == "asc" ? "ASC" : "DESC";
	}

	private function makeUrl( $params )
	{
		global $APPLICATION;
		return $APPLICATION->GetCurPageParam(
			$params,
			array(
				"showBy",
				"sort",
				"order",
				"SECTION_PATH"
			)
		);
	}
}