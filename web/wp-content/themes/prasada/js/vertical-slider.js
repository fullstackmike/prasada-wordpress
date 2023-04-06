/* 
Plugin Name: Thunder Vertical Slider
Author Name: Burak Aydin
Author URI: http://burak-aydin.com
*/




(function($){


	$.fn.thunder_slider=function(options){


		var defaults={

			times:1000
			
		}

		options=$.extend(defaults,options);


		
		var th=this,			
			index=0,
			prevTotal=0,
			wnd=$(window),
			length=th.find('.slide-single').length,
			dot_height=0,
			slide_single=th.find('.slide-single'),
			height=th.find('.slide-single').eq(index).children().outerHeight();



		for(var i=0;i<length;i++){

			$('.dots-wrap').append('<span class="dot"></span>');

		}





		function active_dot(opt){

			th.find('.dot').removeClass('thunder-bgcolor thunder-border').end().find('.dot').eq(opt).addClass('thunder-bgcolor thunder-border');

		}

		active_dot(index);



		function dotheight_func(){

			var dotswrap=th.find('.dots-wrap');

			var dotsheight=dotswrap.outerHeight();

			dotswrap.css({
				marginTop:'-'+dotsheight/2+'px'
			});

		}

		dotheight_func();



		function text_height(){

			var textwrap=th.find('.slide-single').children('.text-wrap');

			var textHeight=textwrap.height();


			textwrap.css({
				marginTop:'-'+textHeight/2+'px'
			});

		}

		text_height();





		function prevHeight(opt){

			prevTotal=0;			

			th.find('.slide-single').eq(opt).prevAll().find('img').each(function(){

				prevTotal=$(this).outerHeight()+prevTotal;

			});

		}



		function set_action(opt){

			th.find('.slider-inner').animate({

				marginTop:'-'+opt+'px'

			},{duration:options.times,easing:'easeInOutCirc',queue:false});

		}



		function set_height(opt){

			th.find('.thunder-slider-inner').height(opt);

		}

		set_height(height-2);




		function set_animation(opt){

			slide_single.find('.text-wrap').stop().slideUp(500);

			slide_single.eq(index).find('.text-wrap').stop().delay(1000).slideDown();			

		}

		set_animation(index);		




		wnd.resize(function(){

			height=th.find('.slide-single').eq(index).children().outerHeight();

			set_height(height-2);

			prevHeight(index);

			th.find('.slider-inner').css({

				marginTop:'-'+prevTotal+'px'

			}); 		

		});



		th.find('.dot').stop().click(function(){

			index=$(this).index();	

			active_dot(index);

			height=th.find('.slide-single').eq(index).children().outerHeight();					

			prevHeight(index);

			set_height(height-2);		

			set_action(prevTotal);

			set_animation(index);

		});	




		th.find('.thunder-slider-inner').height(height);




		th.swipe({
			swipe:function(e,direct){

				if(direct=='right' && index>0){					

					index--;									

					active_dot(index);

					height=th.find('.slide-single').eq(index).children().outerHeight();					

					prevHeight(index);

					set_height(height-2);		

					set_action(prevTotal);

					set_animation(index);					

				}else if(direct=='left' && index>=0 && index<length-1){					

					index++;								

					active_dot(index);

					height=th.find('.slide-single').eq(index).children().outerHeight();					

					prevHeight(index);

					set_height(height-2);		

					set_action(prevTotal);

					set_animation(index);						
					

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