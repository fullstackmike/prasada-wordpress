<div id="top">

	<div class="top_bg">
	
		<div class="container">
		
			<div id="logo">
			
				<a href="/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/prasada.png" alt="Prasada - Wholebeing in the workplace" /></a>
				
			</div><!--end #logo-->
			
			<div id="new_nav">
			
				<div id="t_nav">
					&nbsp;
				<!--

					<span>|</span>

					<span>|</span>

					<span>|</span>

				-->
				</div><!--end #t_nav-->
			
				<ul id="main_nav">

					<li<?php if(is_tree(30)) { echo ' class="nav_on"'; } ?>><a href="/about">About</a></li>
					<!--<li<?php if(is_tree(34)) { echo ' class="nav_on"'; } ?><a href="/team">Team</a></li>-->
					<!--<a href="/our-clients"<?php if(is_page(2251)) { echo ' class="nav_on"'; } ?>>Clients</a>-->
					<li<?php if(is_tree(6)) { echo ' class="nav_on"'; } ?>><a href="/trainings">Trainings</a></li>

					<li<?php if(is_tree(5333)) { echo ' class="nav_on"'; } ?>><a href="/journeys">Journeys</a></li>

					<li<?php if(is_tree(3116)) { echo ' class="nav_on"'; } ?>><a href="/events">Events</a></li>
					<!--<li<?php if(is_tree(20)) { echo ' class="nav_on"'; } ?>><a href="/places">Places</a></li>-->

					<li<?php if(is_tree(2242)) { echo ' class="nav_on"'; } ?>><a href="/resource-page">Resources</a></li>

					<li<?php if(is_blog()) { echo ' class="nav_on"'; } ?>><a href="/blog">Blog</a></li>

					<li<?php if(is_page(38)) { echo ' class="nav_on"'; } ?>><a href="/contact">Contact</a></li>
					<!--<li<?php if(is_tree(28)) { echo ' class="nav_on"'; } ?>><a href="/policies">Policies</a></li>-->

				</ul>
			
			</div><!--end #new_nav-->
			
			<div id="mobile_menu">
			
					<div class="top-bars">
									
						<div class="fa-wrap">
							<i class="fa fa-bars"></i>
						</div> <!-- end fa-wrap -->
	
					</div>
					
			</div><!--end #mobile_menu-->
			
			<div class="clear"></div>
		
		</div><!--end .container-->
	
	</div><!--end .top_bg-->

</div><!--end #top-->

<?php include('menu.php'); ?>