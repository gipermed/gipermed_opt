BX.namespace("Grastin.Order.Modal.Select");

BX.Grastin.Order.Modal.Select = {
	max_zoom: 12,
	map: null,
	clusterer: null,
	currentPoint: null,

	classes: {
		tabLinkClass: "tabs-item",
		tabContentClass: "export_tab_content_item",
		pointItemClass: "export_tab_item"
	},

	isInited: function () {
		return this.map !== null;
	},
	setMap: function (map) {
		this.map = map;
	},
	getMap: function () {
		return this.map;
	},
	setClusterer: function (clusterer) {
		this.clusterer = clusterer;
	},
	getClusterer: function () {
		return this.clusterer;
	},
	onMapShow: function () {
		if (this.currentPoint) {
			this.map.container.fitToViewport();
			this.showBalloon(this.currentPoint);
		}
		else {
			this.autoZoomMap();
		}
	},
	autoZoomMap: function () {
		if (!this.map || !this.clusterer)
			return;

		this.map.container.fitToViewport();

		/**
		 * Спозиционируем карту так, чтобы на ней были видны все объекты.
		 */
		this.map.setBounds(this.clusterer.getBounds(), {
			checkZoomRange: true,
			useMapMargin: true
		});

		var centerAndZoom = ymaps.util.bounds.getCenterAndZoom(this.clusterer.getBounds(), this.map.container.getSize());
		var zoom = (centerAndZoom.zoom > 0 && centerAndZoom.zoom <= this.max_zoom) ? centerAndZoom.zoom : this.max_zoom;
		this.map.setZoom(zoom);
	},
	initMap: function () {
		var getBalloonHtml = function (object) {
			var html = '<div class="popup_point">';

			if (object.ADDRESS)
				html += '<div class="address">' + object.ADDRESS + '</div>';

			if (object.TIME_WORK)
				html += '<p class="time_work">' + object.TIME_WORK + '</p>';

			if (object.PHONE)
				html += '<p class="phone">' + object.PHONE + '</p>';

			if (object.DRIVINGDESCRIPTION)
				html += '<p class="description">' + object.DRIVINGDESCRIPTION + '</p>';

			html += '<div class="btn_wr">' +
				'<a href="javascript:void(0)"' +
				' class="btn' +
				' btn_primary" onclick="selectPoint(\'' + object.XML_ID + '\', \'' + object.ADDRESS + '\');" >' + BX.message('BTN_MESSAGE_SELECT_POINT_BUTTON') + '</a></div>' +
				'</div>';

			return html;
		};

		var map = new ymaps.Map("map", {
			center: [55.7558, 37.6176],
			zoom: 10,
			controls: ['zoomControl', 'geolocationControl', 'searchControl']
		});
		map.behaviors.disable('scrollZoom');
		var clusterer = new ymaps.Clusterer({
			preset: 'islands#invertedVioletClusterIcons',
			groupByCoordinates: false,
			clusterDisableClickZoom: true,
			clusterHideIconOnBalloonOpen: false,
			geoObjectHideIconOnBalloonOpen: false
		});

		var geoObject = [];
		for (var i = 0, len = BX.mapballoon.length; i < len; i++) {
			var objectThis = BX.mapballoon[i];

			var object = new ymaps.Placemark(objectThis.COORD, {
					balloonContent: getBalloonHtml(objectThis),
					clusterCaption: (objectThis.TITLE == "" ? objectThis.ADDRESS : objectThis.TITLE)
				}, {
					preset: 'islands#icon',
					iconColor: '#ff4081'
				}
			);
			geoObject[i] = object;
		}

		clusterer.add(geoObject);
		this.placemarks = geoObject;
		map.geoObjects.add(clusterer);
		this.setClusterer(clusterer);
		this.setMap(map);
		this.autoZoomMap();
	},
	getIndex: function (pointID) {
		for (var i = 0, len = BX.mapballoon.length; i < len; i++) {
			if (pointID == BX.mapballoon[i].XML_ID)
				return i;
		}
	},
	showSelectPoint: function (pointID, openBalloon) {
		this.currentPoint = pointID;

		var deliveryPlaceInput = $("#delivery_place_" + pointID);
		if (deliveryPlaceInput.length > 0) {
			var elementWrapper = deliveryPlaceInput.closest("." + this.classes.pointItemClass);
			$("." + this.classes.pointItemClass).removeClass("active");
			elementWrapper.addClass("active");
			this.scrollToElement(elementWrapper);
		}

		if (!!openBalloon)
			this.showBalloon(pointID);
	},
	showBalloon: function (pointID) {
		var id = this.getIndex(pointID);
		if (BX.mapballoon[id] && this.map) {
			this.map.setCenter(BX.mapballoon[id].COORD, 12);
		}
		if (this.placemarks[id] && this.clusterer) {
			/**
			 * Если метка находится в кластере, выставим ее в качестве активного объекта.
			 * Тогда она будет "выбрана" в открытом балуне кластера.
			 *
			 * Если метка не попала в кластер и видна на карте, откроем ее балун.
			 */
			var objectState = this.clusterer.getObjectState(this.placemarks[id]);
			if (objectState.isClustered) {
				objectState.cluster.state.set('activeObject', this.placemarks[id]);
				this.clusterer.balloon.open(objectState.cluster);
			} else if (objectState.isShown) {
				this.placemarks[id].balloon.open();
			}
		}
	},
	scrollToElement: function (element) {
		if (element.length < 0)
			return;

		var elementWrapper = element.closest("." + this.classes.tabContentClass);
		if (elementWrapper.length < 0)
			return;

		var toTop = elementWrapper.scrollTop() + (element.offset().top - elementWrapper.offset().top);
		elementWrapper.animate({scrollTop: toTop - 1})
	},
	initPointPopup: function () {
		var self = this;
		$('.' + this.classes.tabLinkClass).click(function () {
			var id = $(this).children('a').data('id'),
				activeTab = $(this).children().text();

			$('.item_tabs_active .text .active_text').text(activeTab);
			$('.item_details_tabs._mobile').removeClass('_open');

			$('.' + self.classes.tabLinkClass).removeClass('active');
			$('.' + self.classes.tabContentClass).removeClass('active');
			$('.' + self.classes.tabContentClass).each(function (index, item) {
				if ($(this).data('id') == id) {
					$(this).addClass('active');
				}
			});

			$('.' + self.classes.tabLinkClass).each(function (index, item) {
				if ($(this).children('a').data('id') == id) {
					$(this).addClass('active');
				}
			});

			if (id == "all") {
				$('.' + self.classes.tabContentClass).addClass('active');
			}

			if (id == "map_tab") {
				self.onMapShow();
			}
		});

		/* item_details_tabs_mobile */
		$('.item_tabs_active').click(function () {
			$(this).parent().toggleClass('_open');
		});

		$('.box-modal_close').on('click', function () {
			/**
			 * Отправляем событие в родительское окно заказа с данными выбранного ПВЗ
			 */
			if (top.BX)
				top.BX.onCustomEvent('Grastin:close', []);
			else
				BX.onCustomEvent('Grastin:close', []);
		});

		/**
		 * Обработка кнопки сброса поиска в списке
		 */
		$(".search_reset").on("click", function() {
			var inputEl = this.previousElementSibling;
			inputEl.value = '';
			var event = new Event('input');
			inputEl.dispatchEvent(event);
		});

		/**
		 * фильтр списка по адресу и описанию
		 */
		if (typeof(List) !== "undefined") {
			var pointsList = new List('points_list_wr', {
				valueNames: [ 'address', 'desc' ],
				listClass: "points_list",
				searchClass: "search_item_input"
			});
		}
	}
};

function initPointPopup() {
	BX.Grastin.Order.Modal.Select.initPointPopup();
}

function selectPoint(pointID, pointValue, openBalloon) {
	/**
	 * Показываем выбранный ПВЗ в попапе
	 */
	BX.Grastin.Order.Modal.Select.showSelectPoint(pointID, openBalloon);

	/**
	 * Отправляем событие в родительское окно заказа с данными выбранного ПВЗ
	 */
	if (top.BX) {
		top.BX.onCustomEvent('Grastin:selectPoint', [pointID, pointValue]);
	}
	else {
		BX.onCustomEvent('Grastin:selectPoint', [pointID, pointValue]);
	}
}

function initYmaps() {
	BX.Grastin.Order.Modal.Select.initMap();
}

/**
 * Слушаем сообщение о необходимости показать в попапе выбранный ПВЗ
 */
window.addEventListener("message", function (event) {
	if (event.origin !== window.location.origin)
		return;

	if (event.data.action === "onShow") {
		/**
		 * Запускаем сркипты работы с картой после ее инициализации,
		 * т.к. сообщение приходит раньше, чем карта инициализируется
		 */
		var timerId = setInterval(function () {
			var mapInited = BX.Grastin.Order.Modal.Select.isInited();
			if (mapInited) {
				BX.Grastin.Order.Modal.Select.autoZoomMap();
				if (event.data.point) {
					BX.Grastin.Order.Modal.Select.showSelectPoint(event.data.point, true);
				}
				clearInterval(timerId);
			}
		}, 200);

		setTimeout(function () {
			clearInterval(timerId);
		}, 10000);
	}
});

