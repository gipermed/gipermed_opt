<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

if (!$arResult['MODE'])
	return;

?>
	<link rel="stylesheet" type="text/css" href="<?= BX_ROOT . '/js/' . GRASTIN_DELIVERY_MODULE . '/modal.css' ?>">
	<script type="text/javascript">
		BX.ready(function () {
			if (!BX.Sale) return;

			BX.message({
				GD_ORDER_SHIPMENT_EDIT_POINT_TITLE: '<?=GetMessageJS('GD_ORDER_SHIPMENT_EDIT_POINT_TITLE')?>',
				GD_ORDER_SHIPMENT_EDIT_POINT_BUTTON: '<?=GetMessageJS('GD_ORDER_SHIPMENT_EDIT_POINT_BUTTON')?>',
				GD_ORDER_SHIPMENT_EDIT_POINT_ADD_BUTTON: '<?=GetMessageJS('GD_ORDER_SHIPMENT_EDIT_POINT_ADD_BUTTON')?>',
			});

			BX.Grastin.OrderShipment.Edit.init(<?=CUtil::PhpToJSObject($arResult)?>);
		});
	</script>
<?
