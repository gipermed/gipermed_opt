BX.namespace("Grastin.OrderShipment.Edit");

BX.Grastin.OrderShipment.Edit = {
	mainBlockId: "grastin_shipment_tr",
	selfpickupWrap: "grastin_office_address",
	selfpickup_input_name: "grastin_selfpickup",
	address_input_name: "grastin_address",
	data: null,
	defaultPoints: [],

	modalPoint: null,
	location: null,
	city: null,
	popup: null,
	popups: {},

	init: function (data) {
		console.info("Grastin.OrderShipment.Edit.init()", data);
		this.data = data;
		this.setUrl(data["ADDRESS_MODAL_URL"]);
		this.setGrastinProfiles(data["GRASTIN_PROFILES"]);
		this.setCurPoint(data["SELFPICKUP"]);

		this.location = data.hasOwnProperty("LOCATION") ? data["LOCATION"] : "";
		this.city = data.hasOwnProperty("CITY") ? data["CITY"] : "";

		if (data.hasOwnProperty("PROPERTIES_SETTINGS"))
			this.props = data["PROPERTIES_SETTINGS"];

		this.insert();
		this.bindChangeService();
		this.bindModalEvents();
	},
	setUrl: function (url) {
		this.url = url;
	},
	setLocation(location, city) {
		this.location = location;
		this.city = city;
	},
	setGrastinProfiles: function (grastinProfiles) {
		this.grastinProfiles = grastinProfiles;
	},
	setCurPoint: function (point) {
		var profileId = this.getCurProfile();
		if (!profileId)
			return;

		this.defaultPoints[profileId] = point;
	},
	bindChangeService: function () {
		var updateDeliveryListStr = BX.Sale.Admin.OrderShipment.prototype.updateDeliveryList.toString();
		if (updateDeliveryListStr.indexOf("/* grastin */") == -1) {
			updateDeliveryListStr = this.insertString(updateDeliveryListStr, ' BX.Grastin.OrderShipment.Edit.changeDelivery("service");    /* grastin */ ', ['{']);
			updateDeliveryListStr = this.insertString(updateDeliveryListStr, ' BX.Grastin.OrderShipment.Edit.changeDelivery("head"); ', ['for', '}', '}']);
			BX.Sale.Admin.OrderShipment.prototype.updateDeliveryList = eval("(" + updateDeliveryListStr + ")");
		}
		var updateProfilesStr = BX.Sale.Admin.OrderShipment.prototype.updateProfiles.toString();
		if (updateProfilesStr.indexOf("/* grastin */") == -1) {
			updateProfilesStr = this.insertString(updateProfilesStr, ' BX.Grastin.OrderShipment.Edit.insert();    /* grastin */ ', ['BX.bind('], false, true);
			BX.Sale.Admin.OrderShipment.prototype.updateProfiles = eval("(" + updateProfilesStr + ")");
		}
	},
	bindModalEvents: function () {
		var _this = this;
		BX.addCustomEvent("Grastin:close", BX.delegate(function () {
			_this.close();
		}, this));

		BX.addCustomEvent("Grastin:selectPoint", BX.delegate(function (pointID, pointValue) {
			var msg = "Grastin: получено новое значение ПВЗ.";
			if (pointValue)
				msg += " Адрес: " + pointValue + ";";
			if (pointID)
				msg += " ПВЗ: " + pointID + ";";
			console.info(msg);

			_this.close();
			_this.updateCurPoint(pointID, pointValue);
		}, this));
	},
	insert: function (update) {
		var module_id = this.getCurDelivery();
		var profile_id = this.getCurProfile();
		console.info("Grastin.OrderShipment.Edit.insert()", module_id, profile_id);
		var isGrastinSelfpickup = this.isGrastinSelfpickup(profile_id);

		this.removeBlock();
		if (!isGrastinSelfpickup) {
			this.insertBlock(this.hiddenPointValues());
			return;
		}

		var pvzHtml = '<td class="adm-detail-content-cell-l">' + BX.message('GD_ORDER_SHIPMENT_EDIT_POINT_TITLE') + '</td>' +
			'<td class="adm-detail-content-cell-r" id="grastin_shipment_td">' +
			'<div id="' + this.selfpickupWrap + '">' +
			this.pointToHtmlView(profile_id) +
			'</div>' +
			'<div id="grastin_delivery_info"></div>' +
			'</td>';

		this.insertBlock(pvzHtml);
	},
	removeBlock: function () {
		var mainBlock = BX(this.mainBlockId);
		if (mainBlock) BX.remove(mainBlock);
	},
	insertBlock: function (html) {
		var profilesBlock = BX('BLOCK_PROFILES_1');
		if (!profilesBlock)
			return;

		var parent = BX.findParent(profilesBlock);
		if (!parent)
			return;

		parent.appendChild(BX.create('tr', {'props': {'id': this.mainBlockId, 'innerHTML': html}}));
	},
	changeDelivery: function () {
		var module_id = this.getCurDelivery();
		var profile_id = this.getCurProfile();
		console.info("Grastin.OrderShipment.Edit.changeDelivery()", module_id, profile_id);
		var deliveryParentChanged = parseInt(profile_id) === 0;
		if (deliveryParentChanged)
			this.insert(true);
	},
	getCurDelivery: function () {
		var deliveryEl = BX('DELIVERY_1');
		return deliveryEl ? deliveryEl.value : 0;
	},
	getCurProfile: function () {
		var profileEl = BX('PROFILE_1');
		return profileEl ? profileEl.value : 0;
	},
	/**
	 * Сохраняет выбранную точку ПВЗ.
	 * Обновляет блок с выбранной точкой ПВЗ.
	 * Обновляет значения в полях свойств заказа (если страница создания заказа)
	 * @param id
	 * @param address
	 */
	updateCurPoint: function (id, address) {
		this.setCurPoint({
			XML_ID: id,
			NAME: address
		});
		this.setModalPoint(id);
		this.updateOrderCreateProp();
		this.updatePointBlock(this.pointToHtmlView());
	},
	/**
	 * Обнолвяет блок с выбранноой точкой ПВЗ
	 * @param html
	 */
	updatePointBlock: function (html) {
		var deliveryEl = BX(this.selfpickupWrap);
		if (!deliveryEl)
			return;

		deliveryEl.innerHTML = html;
	},
	/**
	 * Если это страница создания заказа, то обновляет значения в полях свойств заказа
	 */
	updateOrderCreateProp: function () {
		var point = this.getCurPoint();
		if (!point || !point.NAME || !point.XML_ID) {
			return;
		}

		this.setOrderCreatePropValue("INDIVIDUAL_ADDRESS", point.NAME);
		this.setOrderCreatePropValue("ENTITY_ADDRESS", point.NAME);
		this.setOrderCreatePropValue("INDIVIDUAL_SELFPICKUP", point.XML_ID);
		this.setOrderCreatePropValue("ENTITY_SELFPICKUP", point.XML_ID);
	},
	/**
	 * Возвращает true, если профиль доставки profileId является профилем доставки грастина c ПВЗ
	 * @param profileId
	 * @returns {boolean}
	 */
	isGrastinSelfpickup: function (profileId) {
		return this.grastinProfiles.hasOwnProperty(profileId);
	},
	/**
	 * Возвращает код профиля доставки грастин с ПВЗ
	 * @param profileId
	 * @returns {string, null}
	 */
	getProfileCode: function (profileId) {
		return (this.grastinProfiles.hasOwnProperty(profileId)) ? this.grastinProfiles[profileId] : null;
	},
	/**
	 * Возввращает html для вставки скрытых значений выбранного ПВЗ
	 * @param id
	 * @param address
	 * @returns {string}
	 */
	hiddenPointValues: function (id, address) {
		return '<input id="' + this.selfpickup_input_name + '" name="' + this.selfpickup_input_name + '" type="hidden" value="' + (id ? id : '') + '"/>' +
			'<input id="' + this.address_input_name + '" name="' + this.address_input_name + '" type="hidden" value="' + (address ? address : '') + '"/>';
	},
	/**
	 * Возввращает html для вставки блока с выбором точки ПВЗ по профилю доставки
	 * @param profileId
	 * @returns {string}
	 */
	pointToHtmlView: function (profileId) {
		if (!profileId)
			profileId = this.getCurProfile();

		var profileCode = this.getProfileCode(profileId);

		var curPoint = this.getCurPoint();
		var selfpickupXmlId = curPoint ? curPoint.XML_ID : "";
		var selfpickupAddress = curPoint ? curPoint.NAME : "";
		var propsValues = this.hiddenPointValues(selfpickupXmlId, selfpickupAddress);

		console.log("isGrastinSelfpickup", profileId, this.isGrastinSelfpickup(profileId));
		if (!this.isGrastinSelfpickup(profileId))
			return propsValues;

		if (!curPoint) {
			return '<div class="export_tab_item active"><div class="export_c_wrap"><div class="input_group">' +
				propsValues +
				'<div class="export_submit_btn">' +
				'<a href="javascript:BX.Grastin.OrderShipment.Edit.changePoint(\'' + profileCode + '\')" class="adm-btn adm-btn-save">' + BX.message('GD_ORDER_SHIPMENT_EDIT_POINT_ADD_BUTTON') + '</a>' +
				'</div>' +
				'</div></div></div>';
		}

		return '<div class="export_tab_item active"><div class="export_c_wrap"><div class="input_group">' +
			propsValues +
			'<div class="input_text">' +
			'<div class="export_point">' +
			'<div class="address">' +
			curPoint.NAME +
			'</div>' +
			'</div>' +
			'</div>' +
			'<div class="export_submit_btn">' +
			'<a href="javascript:BX.Grastin.OrderShipment.Edit.changePoint(\'' + profileCode + '\')" class="adm-btn adm-btn-save">' + BX.message('GD_ORDER_SHIPMENT_EDIT_POINT_BUTTON') + '</a>' +
			'</div>' +
			'</div></div></div>';
	},
	changePoint: function (profileCode) {
		var location = this.location;
		var city = this.city;

		if (this.data["MODE"] == "order_create") {

			location = this.getOrderCreatePropValue("ENTITY_LOCATION");
			if (!location)
				location = this.getOrderCreatePropValue("INDIVIDUAL_LOCATION");

			city = this.getOrderCreatePropValue("ENTITY_CITY");
			if (!city)
				city = this.getOrderCreatePropValue("INDIVIDUAL_CITY");
		}

		this.setLocation(location, city);
		this.show(profileCode, this.getCurPoint());
	},
	getOrderCreatePropId: function (propCode) {
		return this.props && propCode in this.props ? this.props[propCode] : null;
	},
	getOrderCreatePropValue: function (propCode) {
		var propId = this.getOrderCreatePropId(propCode);
		if (!propId)
			return "";

		var propInputs = document.getElementsByName("PROPERTIES[" + propId + "]");
		if (propInputs.length <= 0)
			return "";

		return propInputs[0].value;
	},
	setOrderCreatePropValue: function (propCode, value) {
		var propId = this.getOrderCreatePropId(propCode);
		if (!propId)
			return false;

		var propInputs = document.getElementsByName("PROPERTIES[" + propId + "]");
		if (propInputs.length <= 0)
			return false;

		propInputs[0].value = value;
		return true;
	},
	getCurPoint: function () {
		var profileId = this.getCurProfile();
		if (!profileId || !this.defaultPoints.hasOwnProperty(profileId))
			return null;

		return this.defaultPoints[profileId];
	},
	/**
	 * поиск позиции и переменной в строке по цепочке соответствий
	 */
	stringPosVal: function (s, ar, position, before) {
		var v = '', p = 0, p2 = 0;

		for (var i = 0; i < ar.length; i++)
			if (ar[i] == 'VALUE') p2 = p;
			else {
				p = s.indexOf(ar[i], p);
				if (p == -1) break;
				if (p2 != 0) {
					v = s.substr(p2, p - p2).replace(/^\s+|\s+$/gm, '');
					break;
				}
				if (!before) p += ar[i].length;
			}

		return (position != undefined ? p : [p, v]);
	},
	/**
	 * замена в строке по цепочке соответствий (s - строка, s2 - вставить, ar - цепочка соответствий, ar2 - цепочка соответствий для переменной)
	 */
	insertString: function (s, s2, ar, ar2, before) {
		if (ar2 != undefined && ar2 != false) {
			v = this.stringPosVal(s, ar2);
			if (v[1] != '') s2 = s2.replace('%value%', v[1]);
		}

		var p = this.stringPosVal(s, ar, true, before);
		if (p > 0) s = s.substr(0, p) + s2 + s.substr(p);

		return s;
	},
	/**
	 * Открываем попап
	 */
	show: function (profileCode, point) {
		if (!this.url)
			return;

		this.setModalPoint(point ? point.XML_ID : "");
		var params = [
			{'name': 'sid', 'value': profileCode}
		];
		if (this.location)
			params.push({'name': 'location', 'value': this.location});
		if (this.city)
			params.push({'name': 'city', 'value': this.city});

		var src = this.addParamsToUrl(this.url, params);
		if (!src)
			return false;

		this.popup = this.getPopupWindow(src);
		if (this.popup)
			this.popup.show();

		return false;
	},
	/**
	 * Закрываем попап
	 */
	close: function () {
		if (this.popup)
			this.popup.close();
	},
	/**
	 * Возвращает уже созданный попап, если он открывался
	 */
	getPopupWindow: function (src) {
		if (!src)
			return;

		if (this.popups.hasOwnProperty(src)) {
			return this.popups[src];
		}

		var id = (Math.floor(Math.random() * 99999));
		this.frameName = "grastin_delivery_modal_" + id;

		var popup = BX.PopupWindowManager.create(
			"grastin-modal-" + id,
			null,
			{
				className: "grastin_order_modal",
				contentNoPaddings: true,
				content:
					"<div class=\"grastin_order_modal_content\">" +
					"<iframe src=\"" + src + "\" name=\"" + this.frameName + "\" id=\"" + this.frameName + "\"></iframe>" +
					"<div id=\"grastin_overlay_loading\" class=\"overlay_loading\"><div class=\"grastin_order_modal_loading\"></div></div>" +
					"</div>",
				closeByEsc: true,
				autoHide: true,
				zIndex: 10000,
				closeIcon: true,
				offsetLeft: 0,
				offsetTop: 0,
				bindOptions: {forceBindPosition: true},
				overlay: {
					backgroundColor: 'black',
					opacity: '80'
				},
				events: {
					onPopupShow: BX.delegate(this.onWindowShow, this),
					onPopupFirstShow: BX.delegate(this.onFirstWindowShow, this),
					onAfterPopupShow: BX.delegate(this.onAfterWindowShow, this)
				}
			}
		);

		this.popups[src] = popup;
		return popup;
	},
	/**
	 * При первой загрузке попапа показывать прелоудер
	 */
	onFirstWindowShow: function () {
		this.showPreloader();
	},
	/**
	 * При показе попапа
	 */
	onWindowShow: function () {
	},
	/**
	 * После загрузки попапа скрывать прелоудер и открываем выбранную точку
	 */
	onAfterWindowShow: function () {
		var _this = this;

		if (!this.frameName)
			return;

		var win = window.frames[this.frameName];
		if (!win)
			return;

		win.onload = function () {
			_this.hidePreloader();
			win.postMessage({action: "onShow", point: this.modalPoint}, location.origin);
		};
	},
	/**
	 * показать прелоудер
	 */
	showPreloader: function () {
		BX.show(BX("grastin_overlay_loading"));
	},
	/**
	 * скрыть прелоудер
	 */
	hidePreloader: function () {
		BX.hide(BX("grastin_overlay_loading"));
	},
	/**
	 * Сохраняет XML_ID точки для след. открытия попапа
	 * @param id
	 */
	setModalPoint: function (id) {
		this.modalPoint = id;
	},
	/**
	 * добавляет параметры params в url для GET запроса
	 * @param url
	 * @param params
	 * @returns {*}
	 */
	addParamsToUrl: function (url, params) {
		url += (url.indexOf("?") === -1) ? "?" : "&";
		params.forEach(function (element) {
			url += element.name + "=" + element.value + "&";
		});
		if (url.lastIndexOf("&") === url.length - 1)
			url = url.slice(0, -1);
		return url;
	}
};
