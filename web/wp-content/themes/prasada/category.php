<?php get_header(); ?>

<?php $subtitle = get_post_meta( 40, 'wpcf-subtitle', true ); wp_reset_postdata(); ?>
		
	<!-- PAGE TITLE -->
	<section class="row clearfix no-margin" id="page-title">					

		<h1>Category: <?php single_cat_title(); ?></h1>
		
		<?php if($subtitle != '') { ?>
			<div class="subtitle"><?php echo $subtitle; ?></div>
		<?php } ?>					
	
	</section>
	<!-- END PAGE TITLE -->


	<section id="page_content">
	
		<div id="blog">

		<?php if (have_posts()) : while (have_posts()) : the_post();
		$clean = strip_tags($post->post_content);
		$short = myTruncate($clean, 300);
		?>
		
			<div class="post">
			
				<div class="post_top">
				
					<div class="post_top_l">
					
						<?php 
						if ( has_post_thumbnail() ) {
							$thepicurl = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-thumb' , false ); ?>
							<img src="<?php echo $thepicurl[0]; ?>" alt="<?php the_title(); ?>" />
						<?php }  else { ?>
							<img src="<?php bloginfo('stylesheet_directory'); ?>/images/default_thumb.jpg" alt="<?php the_title(); ?>" />
						<?php } ?>
					
					</div><!--end .post_top_l-->
					
					<div class="post_top_r">
					
						<div class="post_date">
							<?php the_time('F j, Y'); ?>
						</div><!--end .post_date-->
						
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						
						<div class="post-meta">
					
							<div class="post_author"><?php the_author_posts_link(); ?></div>
							
							<div class="post_cats"><?php the_category(', '); ?></div>
							
							<div class="clear"></div>
						
						</div><!--end .post-meta-->
					
					</div><!--end .post_top_r-->
					
					<div class="clear"></div>
				
				</div><!--end .post_top-->
			
				<div class="post_excerpt">
				
					<p><?php echo $short; ?></p>
					
					<a href="<?php the_permalink(); ?>" class="more">Read More</a>
				
				</div><!--end .post_excerpt-->
				
			</div><!--end .post-->
			
		<?php endwhile; ?>
			
				<?php if(function_exists('wp_paginate')) {
				    wp_paginate();
				} ?>
			
		<?php endif; ?>

		</div><!-- end #blog -->
		
		<?php include('inc/sidebar-blog.php'); ?>
	
		<div class="clear"></div>
	
	</section><!--end #page_content-->


<?php get_footer(); ?>