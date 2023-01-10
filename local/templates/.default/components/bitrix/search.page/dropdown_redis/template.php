<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$class = $arParams["MOBILE"] == "Y" ? "msearch" : "search";
$INPUT_ID = $arParams["INPUT_ID"];
$CONTAINER_ID = $arParams["CONTAINER_ID"];
?>

<div class="header__search" id="<?= $CONTAINER_ID?>">
	<form class="form" action="<?echo $arResult["FORM_ACTION"]?>">
	    <input 
		    class="header__input" 
		    type="text" 
		    placeholder="Поиск среди 3 000 товаров. Введите запрос." 
		    name="q" 
		    value="<?=htmlspecialcharsbx($_REQUEST["q"])?>"
		    autocomplete="off"
		    id="<?echo $INPUT_ID?>"
	    />
	    <button class="header__btn" type="submit">
	      <svg class="icon icon-magnifer">
	        <use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#magnifer"></use>
	      </svg>
	    </button>
	</form>
</div>

<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>

