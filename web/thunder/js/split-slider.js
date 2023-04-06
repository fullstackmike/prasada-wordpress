/*
Plugin Name: jQuery Split Slider
Author: Burak Aydin
Author URI: http://burak-aydin.com
*/

(function($){

	
	$.fn.split_slider=function(options){

		var defaults={
			times:800,
			easing:'easeOutCirc'
		}


		options=$.extend(defaults,options);


		
		var th=this,
			index=0,
			wnd=$(window),
			slide=th.find('.slide-single'),
			slide_length=slide.length,
			slider_inner=th.find('.slider-inner'),
			slide_height=slide.eq(index).outerHeight(),
			allTotal=0,			
			current_frame=th.find('.thunder-slider-inner');


			current_frame.height(slide_height);


		



		for(var i=0;i<slide_length;i++){

			$('.dots-wrap').append('<span class="dot"></span>');

		}


		var dotHeight=th.find('.dots-wrap').height();





		function set_action(opt){

			allTotal=0;

			slide.eq(opt).prevAll().each(function(){				

				allTotal=$(this).outerHeight()+allTotal;

			});

			slider_inner.stop().animate({
				marginTop:'-'+allTotal+'px'
			},{duration:options.times,easing:options.easing});

		}




		function dot_height(){

			th.find('.dots-wrap').css({
				marginTop:'-'+dotHeight/2+'px'
			});

		}

		dot_height();
	



		function set_dot(opt){

			th.find('.dot').removeClass('thunder-bgcolor thunder-border');

			th.find('.dot').eq(opt).addClass('thunder-bgcolor thunder-border');

		}

		set_dot(index);




		function set_height(opt){

			slide_height=slide.eq(opt).outerHeight();

			current_frame.height(slide_height);

		}

		set_height(index);		

		

		th.find('.dot').click(function(){

			index=$(this).index();

			set_action(index);

			set_dot(index);

			set_height(index);

		});



		wnd.resize(function(){

			set_height(index);

			set_action(index);

		});



		th.swipe({
			swipe:function(e,direct){

				if(direct=='right' && index>0){

					index--;

					set_action(index);

					set_dot(index);

					set_height(index);
					

				}else if(direct=='left' && index<slide_length-1){

					index++;

					set_action(index);

					set_dot(index);

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