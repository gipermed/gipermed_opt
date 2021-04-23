$(document).ready(function () {
  const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // ссылка на оригинальное изображение хранится в атрибуте "data-src"
                entry.target.src = entry.target.dataset.src
                observer.unobserve(entry.target)
            }
        })
    }, { threshold: 0.5 })

  $('.product-card .product-thumb img').each(function(index, item){
    observer.observe(item);
  });
});
$(document).ready(function() {

	(function () {
		var $item = $(".js-sticky");
		if ( $item.length ) {
			$item.before("<div class='js-sticky-spacer'></div>");

			var $spacer = $(".js-sticky-spacer");
			$spacer
				.css("display", "none")
				.css("height", $item.outerHeight())
			;

			var headerHeight = $item.offset().top;

			$(window).on("scroll", function() {
				var fromTop = $(document).scrollTop();

				if (fromTop >= headerHeight) {
					$item.addClass("fix-to-top");
					$spacer.show();
				}
				else {
					$item.removeClass("fix-to-top");
					$spacer.hide();
				}
			});
		}
	})();

	// sliding menu

	$(function() {
		slidingMenu();

		function slidingMenu() {
			$nav = $(".nav, .nav-category");
			$nav_item = $nav.find("li");
			$dropdown = $nav_item.has("ul").addClass("dropdown");
			$back_btn = $nav.find("ul").prepend("<li class='js-back'></li>");
			
			$(".nav li, .nav-category li").each(function(){
				$back_btn_title = $(this).find("a:first").text();
				$(this).find("li.js-back").html($back_btn_title);
			});
			
			$('.catalog-item ul').parent().find('div a').attr('href', 'javascript:void(0);');

			// open sub-level
			$dropdown.on("click", function(e) {
				console.debug('$dropdown.on("click")');
				e.stopPropagation();
				$(this).addClass("is-open");
				$(this).parent().addClass("slide-out");
			});

			// go back
			$back_btn.on("click", ".js-back", function(e) {
				console.debug('$back_btn.on("click")');
				e.stopPropagation();
				$(this).parents('.is-open').first().removeClass("is-open");
				$(this).parents('.slide-out').first().removeClass("slide-out");
			});
		}

	});

	//alphabet 

	$('.alphabet-filter-box.en').slick({
		slidesToShow: 22,
		slidesToScroll: 1,
		arrows: false,
		fade: false,
		infinite: false,
		dots: false,
		autoplay: false,
		focusOnSelect: true,
		responsive: [
		{
			breakpoint: 992,
			settings: {
				slidesToShow: 12,
				slidesToScroll: 7,
			}
		},
		{
			breakpoint: 768,
			settings: {
				slidesToShow: 9,
				slidesToScroll: 5,
			}
		},
		{
			breakpoint: 600,
			settings: {
				slidesToShow: 6,
				slidesToScroll: 3,
			}
		}
		]
	});

	$('.alphabet-filter-box.rus').slick({
		slidesToShow: 34,
		slidesToScroll: 1,
		arrows: false,
		fade: false,
		infinite: false,
		dots: false,
		autoplay: false,
		focusOnSelect: true,
		responsive: [
		{
			breakpoint: 992,
			settings: {
				slidesToShow: 12,
				slidesToScroll: 7,
			}
		},
		{
			breakpoint: 768,
			settings: {
				slidesToShow: 9,
				slidesToScroll: 5,
			}
		},
		{
			breakpoint: 600,
			settings: {
				slidesToShow: 6,
				slidesToScroll: 3,
			}
		}
		]
	});


	$('.main-carousel').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		fade: false,
		infinite: true,
		dots: true,
		autoplay: true,
		autoplaySpeed: 7000,
		responsive: [
		{
			breakpoint: 992,
			settings: {
				dots: false,
				arrows: false
			}
		}
		]
	});

	$('.manufacturer-carousel, .all-manufacturer-carousel').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		arrows: true,
		fade: false,
		infinite: true,
		dots: false,
		responsive: [
			{
				breakpoint: 1070,
				settings:
				{
					slidesToShow: 4,
				}
			},
			{
				breakpoint: 992,
				settings:
				{
					slidesToShow: 4,
					centerMode: false,
				}
			},
			{
				breakpoint: 768,
				settings:
				{
					slidesToShow: 3,
					centerMode: false,
				}
			},
			{
				breakpoint: 600,
				settings:
				{
					slidesToShow: 2,
					centerMode: false,
				}
			},
			{
				breakpoint: 480,
				settings:
				{
					slidesToShow: 1,
					centerMode: true,
				}
			}
		]
	});


	$('.similar-carousel').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		arrows: true,
		fade: false,
		infinite: false,
		dots: false,
		responsive: [
		{
			breakpoint: 1070,
			settings: 
			{
				slidesToShow: 3,
			}
		},
		{
			breakpoint: 992,
			settings: "unslick"
		}
		]
	});

	// category
	$('.showPodCat').click(function(){
		$(this).toggleClass('active');
		$(this).next().toggleClass('active');
		$(this).parents('.cat-li').find('.subcat').toggleClass('show');
	});
	$('.category-col .more span').click(function(){
		$(this).parents('.category-col').find('.hidden-box').toggleClass('display');
		$(this).toggleClass('active');
		var text = $(this).text();
   		$(this).text(
        	text == "Еще" ? "Свернуть" : "Еще");	
   	});

   	// catalog-sub

 //   	$(".catalog-sub").mCustomScrollbar({
	// 	theme: "light-thick",
	// 	scrollInertia: 0,
	// 	contentTouchScroll: true,
	// 	advanced: {
	// 		updateOnBrowserResize: true
	// 	}
	// });

   	// product-slider

	$('.product-slider').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      infinite: false,
      asNavFor: '.product-slider-nav',
      responsive: [
        {
          breakpoint: 961,
          settings: {
            centerMode: false,
            fade: false
          }
        }
      ]
    });
    $('.product-slider-nav').slick({
      slidesToShow: 4,
      slidesToScroll: 2,
      asNavFor: '.product-slider',
      dots: false,
      centerMode: false,
      focusOnSelect: true,
      vertical: true,
      verticalSwiping: true,
      infinite: false,
      arrows: true
    });

    $('.delivery-item .heading').click(function(){
    	if($(this).parents('.delivery-item').hasClass('active')){
    		$(this).next().slideUp();
    		$(this).parents('.delivery-item').removeClass('active');
    	}else{
    		$(this).next().slideDown();
    		$(this).parents('.delivery-item').addClass('active');
    	}
    })

    var go_down = $('body');
	$(function() {
	  $('#Go_Top').hide().removeAttr('href');
	  if ($(window).scrollTop() >= '250') $('#Go_Top').fadeIn('slow')
	  var scrollDiv = $('#Go_Top');
	  $(window).scroll(function() {
	   if ($(window).scrollTop() <= '250') $(scrollDiv).fadeOut('slow')
	   else $(scrollDiv).fadeIn('slow')
	  });
	  $('#Go_Bottom').hide().removeAttr('href');
	  if ($(window).scrollTop() <= go_down.height()-'999') $('#Go_Bottom').fadeIn('slow')
	  var scrollDiv_2 = $('#Go_Bottom');
	  $(window).scroll(function() {
	   if ($(window).scrollTop() >= go_down.height()-'999') $(scrollDiv_2).fadeOut('slow')
	   else $(scrollDiv_2).fadeIn('slow')
	  });
	  $('#Go_Top').click(function() {
	   $('html, body').animate({scrollTop: 0}, 'slow')
	  })
	  $('#Go_Bottom').click(function() {
	   $('html, body').animate({scrollTop: go_down.height()}, 'slow')
	  })
	});

	//catalog-list

	$('.m-catalog-button').click(function(){
		$('.menu-wrapper').slideToggle(0);
		$(this).toggleClass('active');
	});

	$('.page .catalog-button').click(function(){
		$('.page .catalog-list').slideToggle(0);
		$(this).toggleClass('active');
	});

	// msearch

	$('.msearch-button').click(function(){
		$('.msearch').slideToggle(0);
		$(this).toggleClass('active');
	});

	//mmenu

	$('.mmenu-button').click(function(){
		$('.mobile-menu').slideToggle(0);
		$(this).toggleClass('active');
		$('.mobile-menu .close').toggleClass('active');
	});
	$('.mobile-menu .close').click(function(){
		$('.mobile-menu').hide();
		$(this).removeClass('active');
		$('.mmenu-button').removeClass('active');
	});

	$('.attention a, .find-out-btn, .contact-manager').click(function(event){
		event.preventDefault();
	});

	$('input[type="tel"]').inputmask('+7(999)999-99-99');
	$('input.tel').inputmask('+7(999)999-99-99');



	var ajaxOpt = {
		beforeSubmit:  function(){
			// show preloader
		},
		success:       function(data, statusText, xhr, $form){
			$form.parent().find(".desc").html(data.text);

			if(!data.error){
				$form.resetForm();
				$form.hide();
			}

			$.getJSON('/ajax/forms/reload_captcha.php', function(data) {
				$('input[name="captcha_sid"]').val(data);
				Recaptchafree.reset();
			});
		},
		dataType: 'json',
		data: { ajaxForm: 'Y' },
		type:      'post',
	};
	$('.js-ajax-form').each(function (index) {
		$(this).ajaxForm(ajaxOpt);
	});


	// enquire

	enquire.register("screen and (max-width:992px)", {

		match: function() {
			
			$('.product-info').insertAfter('.product-slider-wrap');
			$('.related-products').insertBefore('.similar-product');

			// catalog-list

			$('.product .catalog-button').click(function(){
				$('.product .catalog-list').slideToggle(0);
				$(this).toggleClass('active');
			});
			$('.product .catalog-list').css({'display' : 'none'});

			// catalog-list

			$('.main .catalog-button').click(function(){
				$('.main .catalog-list').slideToggle(0);
				$(this).toggleClass('active');
			});
			$('.main .catalog-list').css({'display' : 'none'});
			
		},

		unmatch: function() {
			$('.product-info').insertBefore('.product-sidebar .more');
			$('.related-products').insertAfter('.product-info');
			

			// catalog-list

			$('.product .catalog-list').css({'display' : 'block'});
			$('.product .catalog-button').click(function(){
				$('.product .catalog-list').slideToggle(0).stop();
				$(this).toggleClass('active').stop();
			});

			$('.main .catalog-list').css({'display' : 'block'});
			$('.main .catalog-button').click(function(){
				$('.main .catalog-list').slideToggle(0).stop();
				$(this).toggleClass('active').stop();
			});
			
		},
	});

});


$(window).on('resize orientationChange', function(event) {
	$('.product-carousel').slick('resize');
	$('.similar-carousel').slick('resize');
});


jQuery(function($) {
	$(document).mouseup(function(e) { // событие клика по веб-документу
		var menu = $("mmenu-button, .mobile-menu"); // тут указываем ID элемента
		if (!menu.is(e.target) // если клик был не по нашему блоку
			&& menu.has(e.target).length === 0) { // и не по его дочерним элементам
			$("mmenu-button").removeClass("active");
			$(".mobile-menu").hide();
		};
	});
});


jQuery(function($) {
	$(document).mouseup(function(e) { // событие клика по веб-документу
		var menu = $(".page .catalog-list, .page .catalog-button"); // тут указываем ID элемента
		if (!menu.is(e.target) // если клик был не по нашему блоку
			&& menu.has(e.target).length === 0) { // и не по его дочерним элементам
			$(".page .catalog-button").removeClass("active");
			$('.page .catalog-list').hide();
		};
	});
});

jQuery(function($) {
	$(document).mouseup(function(e) { // событие клика по веб-документу
		var menu = $(".menu-wrapper, .m-catalog-button"); // тут указываем ID элемента
		if (!menu.is(e.target) // если клик был не по нашему блоку
			&& menu.has(e.target).length === 0) { // и не по его дочерним элементам
			$(".menu-wrapper").hide();
			$(".m-catalog-button").removeClass("active");
		};
	});
});