<?php
/*
Template Name: Clients
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
		
			<?php the_content(); ?>
			
			<h2>Client List</h2>
			
			<div id="clients">
			
				<?php $my_query = new WP_Query( array( 'post_type' => 'client', 'showposts' => -1, 'orderby' => 'title', 'order' => 'ASC'));
				while ($my_query->have_posts()) : $my_query->the_post();
				$loc = types_render_field("client_loc", array());
				$casestudy = types_render_field("cs_link", array());
				
				$do_not_duplicate = $post->ID; 
				$postcount++; ?>
				
					<div class="client">
					
						<h4><?php the_title(); ?></h4>
						
						<div class="loc"><?php echo $loc; ?></div>
						
						<?php if($casestudy != '') { ?><a href="<?php echo $casestudy; ?>">View Case Study</a><?php } ?>
						
					</div><!--end .client-->
				
				<?php endwhile; wp_reset_query(); ?>
			
			</div><!--end #clients-->
	
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

jQuery('.client').last().css('margin','0');

</script>

<?php get_footer(); ?>