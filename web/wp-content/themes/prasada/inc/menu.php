<!-- MENU -->
<header class="thunder-menu animated">
	
	<div class="container">

		<div class="row">					

			<div class="icon-wrap">
				
				<img src="<?php bloginfo('stylesheet_directory'); ?>/img/close.png" class="close-icon animated" alt="">

			</div>
			
			<div class="menu-wrap-scroll">
				
				<nav class="menu-wrap animated">						

					<ul id="m_menu">

						<li><a href="/resource-page">Resources</a>

						</li>

						<li><a href="/programs">Programs</a>

							<ul>
								<?php wp_list_pages('child_of=6&sort_column=menu_order&title_li='); ?>									
							</ul>

						</li>

						<li><a href="/places">Places</a>

							<ul>
								<?php wp_list_pages('child_of=20&sort_column=menu_order&title_li='); ?>									
							</ul>

						</li>

						<li><a href="/policies">Policies</a></li>								

						<li><a href="/about">About</a>
						
							<ul>
								<?php wp_list_pages('child_of=30&sort_column=menu_order&title_li='); ?>
								<li><a href="/our-clients">Clients</a></li>			
							</ul>
							
						</li>
						
						<li><a href="/team">Team</a>
						
							<ul>
								<?php wp_list_pages('child_of=34&sort_column=menu_order&title_li='); ?>									
							</ul>
							
						</li>
						
						<li><a href="/contact">Contact</a></li>
						
						<li><a href="/blog">Blog</a></li>			

					</ul>

				</nav> <!-- end menu-wrap -->

			</div> <!-- end menu-scroll-wrap -->					

		</div> <!-- end row -->						

	</div><!-- end .container -->			

</header>
<!-- END MENU -->