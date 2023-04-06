<div id="sidebar">

	<?php include('newsletter.php'); ?>
	  
	<script>
	// ADD SIDEBAR CALLOUTS
	jQuery(window).load(function() {
	
		jQuery('#newsletter').delay(500).fadeIn(500);
		
		<?php if (is_tree(6)) { ?>jQuery('#programs').remove();<?php } ?>
		<?php if (is_tree(20)) { ?>jQuery('#places').remove();<?php } ?>
		<?php if (is_tree(28)) { ?>jQuery('#policies').remove();<?php } ?>
		
		function fadeCtas() {
			jQuery('.side_cta').last().css('margin','0');
			jQuery('.side_cta').each(function(i) {
				jQuery(this).delay((i++) * 1000).fadeTo(500, 1); 
			});
		};
		
		// use setTimeout() to execute
		setTimeout(fadeCtas, 1000);
		
		jQuery(document).on({
		    mouseenter: function () {
		        jQuery(this).find('.side_overlay').fadeOut(300);
		    },
		    mouseleave: function () {
				jQuery(this).find('.side_overlay').fadeIn(300);
		    }
		}, '.side_cta');
		
	});	
	</script>
	
	<div class="side_cta" id="programs">
		<a href="/programs"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/cta_programs.jpg" /></a>
		<h4>Improve staff wellness with movement</h4>
		<p>Prasada's onsite programs get the ball rolling.</p>
		<a href="/programs">Learn More</a>
		<div class="side_overlay"><p>Programs</p></div>
	</div><!--end #programs-->
	
	<div class="side_cta" id="places">
		<a href="/places"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/cta_places.jpg" /></a>
		<h4>Office space uninspired, noisy, fatiguing?</h4>
		<p>Find out how Prasada can help you transform yours.</p>
		<a href="/places">Learn More</a>
		<div class="side_overlay"><p>Places</p></div>
	</div><!--end #places-->
	
	<div class="side_cta" id="policies">
		<a href="/policies"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/cta_policies.jpg" /></a>
		<h4>When health and happiness are corporate values</h4>
		<p>Prasada helps you frame policies that profitably promote wholebeing.</p>
		<a href="/policies">Learn More</a>
		<div class="side_overlay"><p>Policies</p></div>
	</div><!--end #policies-->
	
	

</div><!-- end #sidebar -->