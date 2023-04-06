$(function(){



'use strict';

/* ==============================================
Variables
=============================================== */
var windowHeight=$(window).height();
var windowWidth=$(window).width();
var detectmob = false;
var menuHeight=0;





/* ==============================================
Detect Mobile Devices
=============================================== */ 

if(navigator.userAgent.match(/Android/i)
	|| navigator.userAgent.match(/webOS/i)
	|| navigator.userAgent.match(/iPhone/i)
	|| navigator.userAgent.match(/iPad/i)
	|| navigator.userAgent.match(/iPod/i)
	|| navigator.userAgent.match(/BlackBerry/i)
	|| navigator.userAgent.match(/Windows Phone/i)) { 
	    detectmob = true;
}




/* ==============================================
Calling Plugins
=============================================== */

/* Preloader */

$('body').queryLoader2({
	backgroundColor:'#efefef',
	barColor:'#000',
	barHeight:2,
	fadeOutTime:500
});


$('body').imagesLoaded(function(){

	$('.page-loader-bg').delay(200).fadeOut(500);

	/* Sliders */

	$('.thunder-top-slider').thunder_slider();

	$('.section-testimonials').thunder_testi();

	$('.thunder-bg-slider').thunder_slider();

	$('.thunder-split-slider').split_slider();


	/* Counter Up */

	$('.count-number').counterUp({
	   time:1500
	});


	/* Circular Progress Bar */

	$('.section-circle-progress').waypoint(function(){

		$('#circular-1').circular();
		$('#circular-2').circular();
		$('#circular-3').circular();
		$('#circular-4').circular();

	},{triggerOnce:true,offset:'100%'});


	/* Masonry */
	$('.masonry-container').masonry();	

	$('.section-clients').find('.section-wrap').masonry();


});







/* Blog Video */

$(".player").mb_YTPlayer();




/* Scrollbar for Window */

$('html').niceScroll({
	cursorcolor:'#353535',
	cursorwidth:'8px',
	cursorborder:'1px solid #efefef',
	mousescrollstep:'90',
	autohidemode:false,
	hidecursordelay:'1000',
	horizrailenabled:false
});



/* Responsive Video */

$('.blog-single-wrap').fitVids();


/* ==============================================
Full Width Menu
=============================================== */

var thunderMenuWrap=$('.thunder-menu').find('.menu-wrap');
var thunderMenu=$('.thunder-menu').find('.menu-wrap > ul > li').children('ul');
var thunderMenuLength=thunderMenu.length;


thunderMenu.each(function(e){

	$(this).siblings('a').append('<i class="open-menu fa fa-angle-down"></i>');

});




/* Menu Slide Toggle */

$('.open-menu').on('click',function(e){

	e.preventDefault();
	
	if($(this).parent('a').parent('li').hasClass('active')){

		$('.open-menu').parent('a').parent('li').removeClass('active');

		$(this).parent('a').siblings('ul').stop().slideUp({
			duration:1000,
			easing: 'easeOutExpo'
		});

	}else{

		$('.open-menu').parent('a').parent('li').removeClass('active');

		$(this).parent('a').parent('li').addClass('active');

		$('.open-menu').parent('a').siblings('ul').stop().slideUp({
			duration:1000,
			easing: 'easeOutExpo'
		});

		$(this).parent('a').siblings('ul').stop().slideDown({
			duration:1000,
			easing: 'easeOutExpo'
		});

	}	


});





$('.open-menu').on({

	mouseenter:function(){

	$(this).stop().animate({
		paddingTop:'10px'
	},200);

	},mouseleave:function(){

		$(this).stop().animate({
			paddingTop:'7px'
		},200);

	}
});





$('.close-icon').on('click',function(){

	thunderMenuWrap.removeClass('fadeInDown');

	thunderMenuWrap.addClass('fadeOutUp');

	$('.thunder-menu').stop().delay(500).slideUp({
		duration:500,
		easing:'easeOutCubic'
	});	

	$('.top-bars').find('.fa').stop().delay(600).animate({
		opacity:1
	},300);

});





$('.top-bars').find('.fa').on('click',function(){
	
	thunderMenuWrap.removeClass('fadeOutUp');	
	
	thunderMenuWrap.addClass('fadeInDown');

	$('.thunder-menu').stop().slideDown({
		duration:500,
		easing:'easeInCubic'
	});

	$('.thunder-menu').css('display','block');

	$(this).stop().animate({
		opacity:0
	},300);

});



/* Menu Scroll */
function resizeMenu(){

	windowHeight=$(window).height();

	windowWidth=$(window).width();


	if(windowWidth<768){

		thunderMenuWrap.height(windowHeight-100);

	}else{

		thunderMenuWrap.height(windowHeight-200);

	}	

}

resizeMenu();
$(window).resize(resizeMenu);



/* Centering Menu */

var menu_width=0;

function header_top(){


		if($(window).width()>767){

			$('.menu-wrap, .menu-wrap-scroll').height($(window).height()-200);

			menu_width=$('.container').width();

			$('.menu-wrap').width(menu_width);			

		}else{

			$('.menu-wrap, .menu-wrap-scroll').height($(window).height()-100);

			menu_width=$('.container').width();

			$('.menu-wrap').width(menu_width);	

		}
	

		if($(window).scrollTop() > 300 && $(window).width()<768){

			$('.sticky-header .top-bars').css('marginTop','20px');

			$('.sticky-header .logo').css('marginTop','9px');

		}else{

			$('.sticky-header .top-bars').css('marginTop','56px');

			$('.sticky-header .logo').css('marginTop','42px');

		}
	

}

header_top();

$(window).scroll(header_top);
$(window).resize(header_top);





/* ==============================================
Thunder Button
=============================================== */

$('.loadmore-wrapper').on({
	mouseenter:function(){

	$(this).stop().animate({
		height:'49px',
		marginTop:'4px'
	},{duration:300,queue:false});

	$(this).find('.loadmore-button').stop().animate({
		padding:'11px 60px',
		marginTop:'-1px'
	},300);

	},mouseleave:function(){

		$(this).stop().animate({
			height:'57px',
			marginTop:0
		},{duration:300,queue:false});

		$(this).find('.loadmore-button').stop().animate({
			padding:'11px 45px',
			marginTop:'3px'
		},300);	

	}
});



$('.section-comment').find('.loadmore-wrapper').css({

	height:'57px',
	marginTop:0

});






/* ==============================================
Pricing Section
=============================================== */

var pricingWrap=$('.section-pricing').find('.h-product');

pricingWrap.on({
	mouseenter:function(){

	$(this).find('.p-price').stop().fadeOut(300);

	$(this).find('.icon').delay(100).stop().fadeIn(200);

	},mouseleave:function(){

		$(this).find('.p-price').stop().fadeIn(300);

		$(this).find('.icon').delay(200).stop().fadeOut(300);

	}
});




pricingWrap.on('mouseenter mouseleave',function(){

	$(this).find('.pricing-overlay').stop().fadeToggle(300);

});







/* ==============================================
Works v2
=============================================== */

$('.section-works-v2').find('.h-product').on({

	mouseenter:function(){	
		
	$(this).find('.img-overlay-wrap').stop().animate({
		padding:'20px 18px',
		opacity:'.6'
	},300);

	$(this).find('.img-plus').stop().animate({
		marginTop:'-35px',
		opacity:1
	});

	},
	mouseleave:function(){

		$(this).find('.img-overlay-wrap').stop().animate({
			padding:0,
			opacity:0
		},300);

		$(this).find('.img-plus').stop().animate({
			marginTop:'-55px',
			opacity:0
		});

	}
});





/* ==============================================
Progress Bar
=============================================== */

var progressVal=0;

$('body').imagesLoaded(function(){

	$('.section-skills').waypoint(function(){

		$('.progressbar-wrap').find('.progress-bar').each(function(){

			progressVal=$(this).attr('aria-valuenow');

			$(this).animate({
				width:progressVal+'%'
			});			

		});

	},{triggerOnce:true,offset:'100%'});

});





/* ==============================================
Works v3
=============================================== */

var workV3Meta=$('.section-works-v3').find('.meta-inner');
var workV3height=workV3Meta.height();


workV3Meta.css({
	marginTop:'-'+workV3height/2+'px'
});



$('.section-works-v3').find('.h-product').on({
	mouseenter:function(){

	$(this).find('.photo-overlay').stop().animate({
		opacity:1
	},250);

	$(this).find('.meta-inner').stop().delay(100).animate({
		opacity:1,
		top:'50%'
	},300);

	},
	mouseleave:function(){

		$(this).find('.photo-overlay').stop().delay(100).animate({
			opacity:0
		},250);

		$(this).find('.meta-inner').stop().animate({
			opacity:0,
			top:'45%'
		},300);

	}
});





/* ==============================================
Works v4
=============================================== */

var workV4with=$('.section-works-v4').find('.h-product-logo'),
	workV4Logo=workV4with.find('.logo-with'),
	v4LogoHeight=workV4Logo.height();

	workV4Logo.css({
		marginTop:'-'+v4LogoHeight/2+'px'
	});


workV4with.on({
	mouseenter:function(){

		$(this).find('.logo-with').stop().animate({
			opacity:1,
			top:'50%'
		},{duration:300,queue:false});

	},
	mouseleave:function(){

		$(this).find('.logo-with').stop().animate({
			opacity:0,
			top:'45%'
		},{duration:300,queue:false});

	}
});





/* ==============================================
Works v5
=============================================== */

var workV5=$('.section-works-v5').find('.h-product');

workV5.on({
	mouseenter:function(){

		$(this).find('.vertical-line').stop().animate({
			height:'72px'
		},400);

		$(this).find('.p-category').stop().animate({
			opacity:1
		},400);

		$(this).find('.p-name').stop().animate({
			opacity:1
		},500);

	},
	mouseleave:function(){

		$(this).find('.vertical-line').stop().animate({
			height:0
		});

		$(this).find('.p-category').stop().animate({
			opacity:0
		},500);

		$(this).find('.p-name').stop().animate({
			opacity:0
		},400);

	}
});





/* ==============================================
Split Slider
=============================================== */

var splitSlider=$('.thunder-split-slider').find('.h-product');


splitSlider.on({
	mouseenter:function(){

		$(this).find('.product-overlay').stop().fadeIn(250);

		$(this).find('.overlay-icon').stop().animate({
			top:'50%',
			opacity:1
		},{duration:250,queue:false});	

		$(this).find('.overlay-inner-wrap').stop().animate({
			padding:'10px',
			opacity:1
		},{duration:250,queue:false});

	},
	mouseleave:function(){

		$(this).find('.overlay-icon').stop().animate({
			top:'45%',
			opacity:0
		},{duration:250,queue:false});

		$(this).find('.overlay-inner-wrap').stop().animate({
			padding:0,
			opacity:0
		},{duration:250,queue:false});

		$(this).find('.product-overlay').stop().fadeOut(250);

	}
});





/* ==============================================
Team
=============================================== */

$('.section-team').find('.h-card').on({
	mouseenter:function(){

		$(this).find('.card-wrap').stop().animate({
			left:'5%',
			bottom:'3%',
			width:'90%',
			opacity:1
		},{duration:250,queue:false});

	},
	mouseleave:function(){

		$(this).find('.card-wrap').stop().animate({
			left:0,
			bottom:'0%',
			width:'100%',
			opacity:0
		},{duration:250,queue:false});

	}
});



/* ==============================================
Isotope
=============================================== */

$('.thunder-filters').find('a').on('click',function(){

	$('.thunder-filters').find('a').removeClass('thunder-active thunder-bgcolor');

	$(this).addClass('thunder-active thunder-bgcolor');

});




$('img').imagesLoaded(function(){


	/* Vol1 */
	var thunder_isotope = $('.thunder-isotope.vol1').isotope({

	  transitionDuration: '.9s',
	  masonry: {
	       columnWidth: '.col-xs-6.col-sm-4.col-md-3'
	   }

	});


	$('.thunder-filters.vol1').find('a').on('click',function(e){

	    var filterValue = $(this).attr('data-filter');
	    thunder_isotope.isotope({ filter: filterValue });

	    e.preventDefault();

	});





	/* Vol2 */

	var thunder_isotope_vol2 = $('.thunder-isotope.vol2');

	thunder_isotope_vol2.isotope({

	  transitionDuration: '.9s',
	  masonry:{
	  	columnWidth:'.col-sm-6.col-md-3'	  	
	  } 

	});


	$('.thunder-filters.vol2').find('a').on('click',function(e){

	    var filterValue = $(this).attr('data-filter');
	    thunder_isotope_vol2.isotope({ filter: filterValue });

	    e.preventDefault();

	});




	/* Vol3 */

	var thunder_isotope_vol3 = $('.thunder-isotope.vol3');

	thunder_isotope_vol3.isotope({

	  transitionDuration: '.9s',
	  masonry:{
	  	columnWidth:'.col-sm-12.col-md-3'
	  }

	});


	$('.thunder-filters.vol3').find('a').on('click',function(e){

	    var filterValue = $(this).attr('data-filter');
	    thunder_isotope_vol3.isotope({ filter: filterValue });

	    e.preventDefault();

	});


});




/* ==============================================
Map
=============================================== */

 function initialize() {

  var mapCanvas = document.getElementById('map_canvas');

  var myLocation = new google.maps.LatLng(39.9208, 32.8538);



  if(detectmob==false){

    var mapOptions = {
      center: myLocation,
      zoom: 17,
      streetViewControl:false,
      scrollwheel:false,
      mapTypeControl:false,
      draggable:true,
      panControl:false
    }

  }else{

    var mapOptions = {
      center: myLocation,
      zoom: 16,
      streetViewControl:false,
      scrollwheel:false,
      mapTypeControl:false,
      draggable:false,
      panControl:false
    }

  }
    

  var map = new google.maps.Map(mapCanvas, mapOptions);

  var marker = new google.maps.Marker({
      position: myLocation,
      map: map,
      icon: 'img/marker.png'      
  });


map.set('styles',  [ 
		 {
			"featureType": "road",
			"stylers": [
			  { "color": "#d4d1d1" }
			]
		  },{
			"featureType": "landscape",
			"stylers": [
			  { "color": "#e6e6e6" }
			]
		  },{
			"elementType": "labels.text.fill",
			"stylers": [
			  { "color": "#e4e4e4" }
			]
		  },{
			"featureType": "poi",
			"stylers": [
			  { "color": "#dedede" }
			]
		  },{
			"elementType": "labels.text",
			"stylers": [
			  { "saturation": 1 },
			  { "weight": 0.1 },
			  { "color": "#afafaf" }
			]
		  },{
	        "featureType": "transit",
	        "stylers": [{ "visibility": "off" }]
	    }




		 ]);
}


if($('.section-map').length){

  google.maps.event.addDomListener(window, 'load', initialize);
  
}



/* Map Height */

function window_height(){

	windowHeight=$(window).height();

	$('.section-map').find('#map_canvas').css({
		height:windowHeight+'px'
	});

}

window_height();

$(window).resize(window_height);






});



/* Scrollbar for Menu */

$(function(){

	$('.thunder-menu').find('.menu-wrap-scroll').niceScroll({
		cursorcolor:'#7e7d7d',
		cursorborder:'none',
		mousescrollstep:'50',
		autohidemode:false,
		cursorwidth:'4px'
	});

});