<?php
/*
Template Name: Resources
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); 
$subtitle = types_render_field("subtitle", array());
$pg_quote = strip_tags(types_render_field("pg_quote", array()));
$quote_author = types_render_field("quote_author", array());
$author_info = types_render_field("author_info", array());
$postid = get_the_ID();
?>

		
	<!-- PAGE TITLE -->
	<section id="page-title">					

		<h1><?php the_title(); ?></h1>
		
		<?php if($subtitle != '') { ?>
			<div class="subtitle"><?php echo $subtitle; ?></div>
		<?php } ?>						
	
	</section>
	<!-- END PAGE TITLE -->


	<section id="page_content">
	
		<div id="main">
			
			<div id="resources">
			
				<div class="res_section">
				
					<h2>Glossary</h2>
					
					<?php $my_query = new WP_Query( array( 'post_type' => 'resource', 'resource-type' => 'definition', 'showposts' => -1, 'orderby' => 'title', 'order' => 'ASC'));
					while ($my_query->have_posts()) : $my_query->the_post();
					$definition = types_render_field("res_def", array());
					$do_not_duplicate = $post->ID; 
					$postcount++; ?>
					
						<div class="defi">
						
							<a name="<?php the_title(); ?>"></a><h4><?php the_title(); ?></h4>
							
							<?php echo $definition; ?>
	
						</div><!--end .defi-->
					
					<?php endwhile; wp_reset_query(); ?>
				
				</div><!--end .res_section-->
			
				<div class="res_section">
				
					<h2>Audio Files</h2>
				
					<?php $my_query = new WP_Query( array( 'post_type' => 'resource', 'resource-type' => 'audio', 'showposts' => -1));
					while ($my_query->have_posts()) : $my_query->the_post();
					$audio = types_render_field("res_audio", array());
					$do_not_duplicate = $post->ID; 
					$postcount++; ?>
					
						<div class="audio">
						
							<h4><?php the_title(); ?></h4>
							
							<div class="audio_box">
								<?php echo do_shortcode('[audio src="'. $audio .'"]'); ?>
							</div><!--end .audio_box-->
	
						</div><!--end .audio-->
					
					<?php endwhile; wp_reset_query(); ?>
				
				</div><!--end .res_section-->
				
				<div class="res_section">
				
					<h2>Recommended Books</h2>
				
					<ul>
					
					<?php $my_query = new WP_Query( array( 'post_type' => 'resource', 'resource-type' => 'book', 'showposts' => -1, 'orderby' => 'title', 'order' => 'ASC'));
					while ($my_query->have_posts()) : $my_query->the_post();
					$booklink = types_render_field("res_book", array());
					$do_not_duplicate = $post->ID; 
					$postcount++; ?>
					
						<li>
							<a href="<?php echo $booklink; ?>" target="_blank" onclick="ga('send', 'event', 'Recommended Books', 'Click', '<?php the_title(); ?>');"><?php the_title(); ?></a>
						</li>
					
					<?php endwhile; wp_reset_query(); ?>
					
					</ul>
				
				</div><!--end .res_section-->
				
				<div class="res_section">
				
					<h2>Helpful Links</h2>
				
					<ul>
					
					<?php $my_query = new WP_Query( array( 'post_type' => 'resource', 'resource-type' => 'helpful-link', 'showposts' => -1, 'orderby' => 'title', 'order' => 'ASC'));
					while ($my_query->have_posts()) : $my_query->the_post();
					$link = types_render_field("res_link", array());
					$do_not_duplicate = $post->ID; 
					$postcount++; ?>
					
						<li>
							<a href="<?php echo $link; ?>" target="_blank" onclick="ga('send', 'event', 'Helpful Links', 'Click', '<?php the_title(); ?>');"><?php the_title(); ?></a>
						</li>
					
					<?php endwhile; wp_reset_query(); ?>
					
					</ul>
				
				</div><!--end .res_section-->
			
			</div><!--end #resources-->
	
		</div><!-- end #main -->
		
		<?php include('inc/services.php'); ?>
	
		<div class="clear"></div>
	
	</section><!--end #page_content-->


	<?php if($pg_quote != '') { ?>
		
		<section class="new-testimonial clearfix row">

			<div class="pad">
			
				<p>&#8220;<?php echo $pg_quote; ?>&#8221;</p>
			
				<?php if($quote_author != '') { ?>
					<div class="test-name"><?php echo $quote_author; ?></div>
				<?php } ?>
				
				<?php if($author_info != '') { ?>
					<div class="test-info"><?php echo $author_info; ?></div>
				<?php } ?>
		
			</div><!--end .pad-->
		
		</section>
		
	<?php } ?>
	
<?php endwhile; endif; ?>

<script>

jQuery('.res_section').last().css('margin','0');

</script>

<?php get_footer(); ?>