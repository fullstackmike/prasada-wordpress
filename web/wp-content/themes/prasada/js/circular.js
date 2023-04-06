/*
Plugin Name: Circular Progress Bar
Author: Burak Aydin
Author URI: http://burak-aydin.com
*/

(function($){


  $.fn.circular=function(options){


    /* Defining variables */
    var canvas=this[0],
        t=$(this),
        context=canvas.getContext('2d'),
        x=canvas.width / 2,
        y=canvas.height / 2,
        rate=t.data('rate'),
        radius=95,
        endPercent=rate,
        firstPercent=0,
        circle=Math.PI * 2,
        quarter=Math.PI / 2,
        xText=x-25,
        yText=y+10,
        color=t.data('color');




    var defaults={
      
    }


    options=$.extend(defaults,options);   


    window.requestAnimationFrame = (function(){
      return  window.requestAnimationFrame       ||
              window.webkitRequestAnimationFrame ||
              window.mozRequestAnimationFrame    ||
              function( callback ){
                window.setTimeout(callback, 1000 / 30);
              };
    })();


    function animate(cur) {

      /* Fixed Circle */
      context.beginPath();  
      context.clearRect(0, 0, canvas.width, canvas.height);
      context.strokeStyle="#7e7d7d"; 
      context.arc(x, y, radius,0,Math.PI*2,true);
      context.lineWidth = 9.6;
      context.stroke(); 

      /* Circular Animation */
      context.beginPath();
      context.lineWidth = 10;
      context.strokeStyle = color;
      context.arc(x, y, radius, -(quarter), -((circle) * cur) - quarter, true);
      context.stroke();
            

      /* Adding Text */
      context.beginPath();
      context.font="bold 30px Raleway";
      context.fillText(rate+'%',xText,yText);

               
      firstPercent++;
      if (firstPercent < endPercent) {
          requestAnimationFrame(function () {
              animate(firstPercent / 100)
          });
      }


    }

    animate();



        

  }

})(jQuery);