<div id="sidebar">

	<?php include('newsletter.php'); ?>
	  
	<script>
	// ADD SIDEBAR CALLOUTS
	jQuery(window).load(function() {
	
		jQuery('#newsletter').delay(500).fadeIn(500);
		
//		<?php //if (is_tree(6)) { ?>//jQuery('#trainings').remove();<?php //} ?>
//		<?php //if (is_tree(20)) { ?>//jQuery('#places').remove();<?php //} ?>
//		<?php //if (is_tree(28)) { ?>//jQuery('#journeys').remove();<?php //} ?>
		
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
	
	<div class="side_cta" id="trainings">
		<a href="/workplace-wellness-programs"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/services-wellness.jpg" /></a>
		<h4>Workplace Wellness Programs</h4>
		<a href="/workplace-wellness-programs">Learn More</a>
	</div><!--end #programs-->
	
	<div class="side_cta" id="places">
		<a href="/places"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/services-leadership.jpg" /></a>
		<h4>Leadership + Professional Development Training</h4>
		<a href="/places">Learn More</a>
	</div><!--end #places-->
	
	<div class="side_cta" id="journeys">
		<a href="/journeys"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/services-wholebeing.jpg" /></a>
		<h4>Wholebeing for Individuals</h4>
		<a href="/journeys">Learn More</a>
	</div><!--end #policies-->
	
	

</div><!-- end #sidebar -->