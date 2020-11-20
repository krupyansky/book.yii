/* =================================
------------------------------------
	Divisima | eCommerce Template
	Version: 1.0
 ------------------------------------
 ====================================*/


'use strict';


$(window).on('load', function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut();
	$("#preloder").delay(400).fadeOut("slow");

});

(function($) {
	/*------------------
		Navigation
	--------------------*/
	$('.main-menu').slicknav({
		prependTo:'.main-navbar .container',
		closedSymbol: '<i class="flaticon-right-arrow"></i>',
		openedSymbol: '<i class="flaticon-down-arrow"></i>'
	});


	/*------------------
		ScrollBar
	--------------------*/
	$(".cart-table-warp, .product-thumbs").niceScroll({
		cursorborder:"",
		cursorcolor:"#afafaf",
		boxzoom:false
	});


	/*------------------
		Category menu
	--------------------*/
	$('.category-menu > li').hover( function(e) {
		$(this).addClass('active');
		e.preventDefault();
	});
	$('.category-menu').mouseleave( function(e) {
		$('.category-menu li').removeClass('active');
		e.preventDefault();
	});


	/*------------------
		Background Set
	--------------------*/
	$('.set-bg').each(function() {
		var bg = $(this).data('setbg');
		$(this).css('background-image', 'url(' + bg + ')');
	});



	/*------------------
		Hero Slider
	--------------------*/
	var hero_s = $(".hero-slider");
    hero_s.owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        dots: true,
        animateOut: 'fadeOut',
    	animateIn: 'fadeIn',
        navText: ['<i class="flaticon-left-arrow-1"></i>', '<i class="flaticon-right-arrow-1"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        onInitialized: function() {
        	var a = this.items().length;
            $("#snh-1").html("<span>1</span><span>" + a + "</span>");
        }
    }).on("changed.owl.carousel", function(a) {
        var b = --a.item.index, a = a.item.count;
    	$("#snh-1").html("<span> "+ (1 > b ? b + a : b > a ? b - a : b) + "</span><span>" + a + "</span>");

    });

	hero_s.append('<div class="slider-nav-warp"><div class="slider-nav"></div></div>');
	$(".hero-slider .owl-nav, .hero-slider .owl-dots").appendTo('.slider-nav');



	/*------------------
		Brands Slider
	--------------------*/
	$('.product-slider').owlCarousel({
//		loop: true,
                loop: false,
                rewind: true,
		nav: true,
		dots: false,
		margin : 30,
		autoplay: true,
		navText: ['<i class="flaticon-left-arrow-1"></i>', '<i class="flaticon-right-arrow-1"></i>'],
		responsive : {
			0 : {
				items: 1,
			},
			480 : {
				items: 2,
			},
			768 : {
				items: 3,
			},
			1200 : {
				items: 4,
			}
		}
	});


	/*------------------
		Popular Services
	--------------------*/
	$('.popular-services-slider').owlCarousel({
		loop: true,
		dots: false,
		margin : 40,
		autoplay: true,
		nav:true,
		navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		responsive : {
			0 : {
				items: 1,
			},
			768 : {
				items: 2,
			},
			991: {
				items: 3
			}
		}
	});


	/*------------------
		Accordions
	--------------------*/
	$('.panel-link').on('click', function (e) {
		$('.panel-link').removeClass('active');
		var $this = $(this);
		if (!$this.hasClass('active')) {
			$this.addClass('active');
		}
		e.preventDefault();
	});


	/*-------------------
		Range Slider
	--------------------- */
	var rangeSlider = $(".price-range"),
		minamount = $("#minamount"),
		maxamount = $("#maxamount"),
		minPrice = rangeSlider.data('min'),
		maxPrice = rangeSlider.data('max');
	rangeSlider.slider({
		range: true,
		min: minPrice,
		max: maxPrice,
		values: [minPrice, maxPrice],
		slide: function (event, ui) {
			minamount.val('$' + ui.values[0]);
			maxamount.val('$' + ui.values[1]);
		}
	});
	minamount.val('$' + rangeSlider.slider("values", 0));
	maxamount.val('$' + rangeSlider.slider("values", 1));


	/*-------------------
		Quantity change
	--------------------- */
    let proQty = $('.pro-qty');
	proQty.prepend('<span class="dec qtybtn">-</span>');
	proQty.append('<span class="inc qtybtn">+</span>');
	proQty.on('click', '.qtybtn', function () {
            let $button = $(this),
                id = $button.parent().data('id'),
                // newVal = 0,
                oldValue = $button.parent().find('input').val(),
                qty = 0;
            $('.cart-table .overlay').fadeIn();
            
            if ($button.hasClass('inc')) {
                // newVal = parseFloat(oldValue) + 1;
                qty = 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    // newVal = parseFloat(oldValue) - 1;
                    qty = -1;
                } else {
                    // newVal = 0;
                    qty = 0;
                }
            }
            
            $.ajax({
                url: 'cart/change-cart',
                data: {id: id, qty: qty},
                type: 'GET',
                success: function(res){
                    if(!res) alert('Ошибка изменения кол-ва товара!');
                    document.location = 'cart/view';
                },
                error: function(){
                    alert('Попробуйте позже!');
                }
            });
            
            // $button.parent().find('input').val(newVal);
	});



	/*------------------
		Single Product
	--------------------*/
	$('.product-thumbs-track > .pt').on('click', function(){
		$('.product-thumbs-track .pt').removeClass('active');
		$(this).addClass('active');
		var imgurl = $(this).data('imgbigurl');
		var bigImg = $('.product-big-img').attr('src');
		if(imgurl != bigImg) {
			$('.product-big-img').attr({src: imgurl});
			$('.zoomImg').attr({src: imgurl});
		}
	});

	$('.product-pic-zoom').zoom();
        
        /*------------------
		Валидация номера телефона
	--------------------*/
        $('#order-phone').mask("+7 (999) 999-99-99");

})(jQuery);

/*------------------
        Козина
--------------------*/
    
function showCart(cart){
    $('#modal-cart .modal-body').html(cart);
    $('#modal-cart').modal();
    let cartQty = $('#cart-qty').text() ? $('#cart-qty').text() : '0';
    if(cartQty){
        $('.cart-qty').text(cartQty);
    }
}

function getCart(){
    $.ajax({
       url: 'cart/show',
       type: 'GET',
       success: function(res){
           if(!res) alert('Ошибка добавления товара!');
           showCart(res);
       },
       error: function(){
           alert('Попробуйте позже!');
       }
    });    
}

function clearCart(){
    $.ajax({
       url: 'cart/clear',
       type: 'GET',
       success: function(res){
           if(!res) alert('Ошибка очистки корзины!');
           showCart(res);
       },
       error: function(){
           alert('Попробуйте позже!');
       }
    });  
}
    
$('.add-to-cart').on('click', function(){
    let id = $(this).data('id');
    $.ajax({
       url: 'cart/add',
       data: {id: id},
       type: 'GET',
       success: function(res){
           if(!res) alert('Корзина сейчас не доступна!');
           showCart(res);
       },
       error: function(){
           alert('Попробуйте позже!');
       }
    });
    return false;
});

$('#modal-cart .modal-body').on('click', '.del-item', function(){
    let id = $(this).data('id');
    $.ajax({
       url: 'cart/del-item',
       data: {id: id},
       type: 'GET',
       success: function(res){
           if(!res) alert('Невозможно удалить товар!');
           let now_location = document.location.pathname;
           if(now_location == '/cart/view'){
               document.location = 'cart/view';
           }else if(now_location == '/cart/checkout'){
               document.location = 'cart/checkout';
           }
           showCart(res);
       },
       error: function(){
           alert('Попробуйте позже!');
       }
    });
});
