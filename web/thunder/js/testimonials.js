/*
Plugin Name: Testimonials jQuery Slider
Author: Burak Aydin
Author URI: http://burak-aydin.com
*/


(function($){


	$.fn.thunder_testi=function(options){


		var th=this,
			dots=th.find('.dots'),
			dotsHeight=dots.outerHeight(),
			dotsHalf=dotsHeight/2,
			slide=th.find('.h-review'),
			length=slide.length,
			prevTotal=0,
			height,
			index=0;


		var defaults={
			times:750,
			easing:'easeInOutExpo'
		}


		options=$.extend(defaults,options);


		dots.css({
			marginTop:'-'+dotsHalf+'px'
		});




		function prevHeight(opt){

			prevTotal=0;

			slide.eq(opt).prevAll().each(function(){

				prevTotal=$(this).outerHeight()+prevTotal;

			});

		}



		function active_dot(opt){

			th.find('.dot').removeClass('dot-active thunder-bgcolor');			

			th.find('.dot').eq(opt).addClass('dot-active thunder-bgcolor');

		}

		active_dot(index);



		function set_height(opt){

			height=th.find('.h-review').eq(opt).outerHeight();

			th.find('.slide-height').outerHeight(height);

		}		





		function set_action(opt){

			prevHeight(index);

			th.find('.testi-inner').stop().animate({
				marginTop:'-'+prevTotal+'px'
			},{duration:options.times,easing:options.easing});

		}





		th.find('.dot').click(function(){

			index=$(this).index();

			set_action(index);

			active_dot(index);

			set_height(index);


		});



		function responsive(){

			set_action(index);

			set_height(index);

		}

		responsive();

		$(window).resize(responsive);


		
		th.swipe({
			swipe:function(e,direct){

				if(direct=='right' && index>0){

					index--;						

					set_action(index);

					active_dot(index);

					set_height(index);

				}else if(direct=='left' && index>=0 && index<length-1){

					index++;					

					set_action(index);

					active_dot(index);

					set_height(index);					

				}else if(direct=='up'){

					th.swipe('option', 'allowPageScroll', $.fn.swipe.pageScroll.VERTICAL);

				}else if(direct=='down'){

					th.swipe('option', 'allowPageScroll', $.fn.swipe.pageScroll.VERTICAL);

				}else{

				}

			}

		});






	}


})(jQuery);