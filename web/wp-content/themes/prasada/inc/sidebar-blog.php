<div id="sidebar">

	<div class="pad">
	 
		<!-- UNCOMMENT TO USE WIDGET -->
		<?php //if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog - Main') ) : ?>
		<?php //endif; ?>
		
		<div class="sb_block">
		
			<?php if($searchterm != '') {
				$placeholder = $searchterm;
			} else {
				$placeholder = 'Search';
			}
			?>
		
			<form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
			    <input type="text" id="s" name="s" value="" class="search_field" placeholder="<?php echo $placeholder; ?>" />     
			    <input type="submit" value="GO" id="searchsubmit" class="button" />
			</form>
		
		</div><!--end .sb_block-->
		
		<div class="sb_block">
		
			<h4>Categories</h4>
			
			<ul class="with_count">
				<?php wp_list_categories('title_li=&show_count=1'); ?>
			</ul>
		
		</div><!--end .sb_block-->
		
		<div class="sb_block">
		
			<h4>Archives</h4>
			
			<ul class="with_count">
				<?php wp_get_archives(array('type' => 'monthly', 'limit' => 12, 'show_post_count' => true)); ?>
			</ul>
		
		</div><!--end .sb_block-->
		
		<div class="sb_block">
		
			<h4>Subscribe by Email</h4>
			
			<form action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=Prasada', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" id="fb_form">
				<input type="text" name="email" placeholder="Enter Email" />
				<input type="hidden" value="Prasada" name="uri"/>
				<input type="hidden" name="loc" value="en_US"/>
				<input type="submit" value="GO" id="fb_submit" />
			</form>
		
		</div><!--end .sb_block-->
		
		<div class="sb_block">
		
			<h4>Featured Posts</h4>
			
			<?php $my_query = new WP_Query(array('post_type' => 'post','layout-option' => 'featured', 'showposts' => 4, 'post__not_in'  => array( $currentpost )));
			while ($my_query->have_posts()) : $my_query->the_post();
			$do_not_duplicate = $post->ID;
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'sm-thumb' );
			$picurl = $thumb['0'];
			$postcount++; ?>
			
				<div class="sb_post">
				
					<div class="sb_post_l">
						<img src="<?php echo $picurl;?>">
					</div><!--end .sb_post_l-->
					
					<div class="sb_post_r">
						<a href="<?php the_permalink(); ?>" onclick="ga('send', 'event', 'Sidebar - Featured Posts', 'Click', '<?php the_title(); ?>');"><?php the_title(); ?></a>
						<?php the_time('F j, Y'); ?>
					</div><!--end .sb_post_r-->
					
					<div class="clear"></div>
				
				</div><!--end .sb_post-->
			
			<?php endwhile; wp_reset_query(); ?>
		
		</div><!--end .sb_block-->
	
	</div><!--end .pad-->
	

</div><!-- end #sidebar -->