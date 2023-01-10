function onWidgetFrameLoad () {
	console.log('onWidgetFrameLoad');
}

BX.addCustomEvent('onArcticModalClose',function() {
	
	console.log('close modal!');
	
	$.arcticmodal('close');
});