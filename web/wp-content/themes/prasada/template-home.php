<?php
/*
Template Name: Home
*/
?>

<?php 
$nav_on = 'home';
get_header(); 
?>

<!-- SLIDER -->
<section class="thunder-top-slider row">

	<div class="thunder-slider-inner">
		
		<div class="slider-inner">
		
			<?php $my_query = new WP_Query( array( 'post_type' => 'slide', 'showposts' => -1));
			while ($my_query->have_posts()) : $my_query->the_post();
			$do_not_duplicate = $post->ID;
			$slide_img = types_render_field("slide_img", array('raw' => 'true'));
			$slide_content = types_render_field("slide_content", array());
			$slide_content = strip_tags($slide_content);
			$link_text = types_render_field("link_text", array());
			$slide_link = types_render_field("slide_link", array());
			$postcount++; ?>
			
				<div class="slide-single">
					
					<img src="<?php echo $slide_img; ?>" alt="">	
	
					<div class="text-wrap">
						
						<h1><?php the_title(); ?></h1>
						<p><?php echo $slide_content; ?></p>
						
						<a class="slide_more" href="<?php echo $slide_link; ?>"><?php echo $link_text; ?></a>
	
					</div> <!-- end text-wrap -->				
	
				</div> <!-- end slider-single -->
			
			<?php endwhile; wp_reset_query(); ?>
			
		</div> <!-- end slider-inner -->

	</div> <!-- end thunder-slider-inner -->

	<div class="dots-wrap"></div> <!-- end dots-wrap -->

</section>
<!-- END SLIDER -->
			

<section id="services">

	<div class="row">

		<div class="service">
		
			<div class="s_content">
			
				<span class="icon icon-Users"></span>

				<h3>Programs</h3>
				<p>Engage employees in healthier habits</p>
				
				<a href="/programs"></a>
			
			</div><!--end .s_content-->
		
		</div><!--end .service-->
		
		<div class="service s_mid">
		
			<div class="s_content">
			
				<span class="icon icon-Pointer"></span>
				<!--<span class="icon icon-House"></span>-->

				<h3>Places</h3>
				<p>Create more productive workspaces</p>
				
				<a href="/places"></a>
			
			</div><!--end .s_content-->
		
		</div><!--end .service-->
		
		<div class="service">
		
			<div class="s_content">
			
				<span class="icon icon-Layers"></span>

				<h3>Policies</h3>
				<p>Encourage smarter choices</p>
				
				<a href="/policies"></a>
			
			</div><!--end .s_content-->
		
		</div><!--end .service-->
		
		<div class="clear"></div>
	
	</div> <!-- end row -->

</section><!--end #services-->




<!-- BLOG -->
<section class="section-blog-hook">	

	<div class="row">	
		
		<h4 class="headtitle">Featured Blog Posts</h4>

		<div class="separator-line"></div>

		<p class="section-desc">Musings on wholebeing@work</p>

		<div class="section-wrap clearfix" id="featured_posts">
			
			<?php $my_query = new WP_Query( array( 'post_type' => 'post', 'orderby' => 'rand', 'layout-option' => 'featured', 'showposts' => 2));
			while ($my_query->have_posts()) : $my_query->the_post();
			$do_not_duplicate = $post->ID;
			$featured_img = types_render_field("featured_img", array('raw' => 'true'));
			$content = strip_tags($post->post_content);
			$short = myTruncate($content, 290);
			$postcount++; ?>
			
				<article class="h-entry col-sm-6">							
				
					<figure>							
	
						<div class="img-wrapper">
	
							<a href="<?php the_permalink(); ?>">
	
								<img src="<?php echo $featured_img; ?>" alt="<?php the_title(); ?>">
	
							</a>
	
						</div>
						
						<div class="dt-published"><?php the_time('m'); ?> . <?php the_time('d'); ?></div>	
	
					</figure>
										
					<div class="text-content">
						
						<div class="f_top">
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<p>by <?php the_author_posts_link(); ?></p>
						</div><!--end .f_top-->
	
						<p class="p-summary"><?php echo $short; ?></p>
	
						<div class="blog-separator"></div>
	
						<div class="featured-meta">
	
							posted in: <?php the_category(', '); ?>
	
						</div> <!-- end .featured-meta -->
	
					</div> <!-- end text-content -->
	
				</article> <!-- end h-entry -->
					
			<?php endwhile; wp_reset_postdata(); ?>
			
		</div> <!-- end section-blog-wrap -->	

	</div> <!-- end row -->

</section>
<!-- END BLOG -->



<!-- NEW TESTIMONIAL -->
<?php if (have_posts()) : while (have_posts()) : the_post(); 
$pg_quote = strip_tags(types_render_field("pg_quote", array()));
$quote_author = types_render_field("quote_author", array());
$author_info = types_render_field("author_info", array());
?>

	<?php if($pg_quote != '') { ?>
		
		<section class="new-testimonial clearfix row">

			<div class="pad">
			
				<p>&#8220; <?php echo $pg_quote; ?>&#8221;</p>
			
				<?php if($quote_author != '') { ?>
					<div class="test-name"><?php echo $quote_author; ?></div>
				<?php } ?>
				
				<?php if($author_info != '') { ?>
					<div class="test-info"><?php echo $author_info; ?></div>
				<?php } ?>
		
			</div><!--end .pad-->
		
		</section>
		
	<?php } ?>

<?php endwhile; endif; wp_reset_postdata(); ?>

<!-- END NEW TESTIMONIAL -->
			
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.equalheights.js"></script>
<script>
jQuery(window).load(function() {
	
	//EQUAL HEIGHTS
	jQuery('.f_top').equalHeights();
	jQuery('.s_content').equalHeights();
	
});	


jQuery(window).resize(function(){

	//EQUAL HEIGHTS RESIZABLE
	jQuery('.f_top, .s_content').css('height','auto');
	jQuery('.f_top').equalHeights();
	jQuery('.s_content').equalHeights();
    
});
</script>

<?php get_footer(); ?>