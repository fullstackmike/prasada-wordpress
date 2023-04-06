<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post();
$definition = types_render_field("res_def", array());
$audio = types_render_field("res_audio", array());
$booklink = types_render_field("res_book", array());
$link = types_render_field("res_link", array());

$currentpost = $post->ID;
?>
		
	<!-- PAGE TITLE -->
	<section id="page-title">					

		<h1>Resources</h1>
	
	</section>
	<!-- END PAGE TITLE -->


	<section id="page_content">
	
		<div id="main">

			<?php if (!empty($definition)) { ?>
				<h2>Glossary</h2><p><strong><?php the_title(); ?></strong></p><p><?php echo $definition; ?></p>
			<?php } ?>
			
			<?php if (!empty($audio)) { ?>
				<div class="audio">
					<h2><?php the_title(); ?></h2>
					<div class="audio_box">
						<?php echo do_shortcode('[audio src="'. $audio .'"]'); ?>
					</div><!--end .audio_box-->
				</div>
			<?php } ?>
			
			<?php if (!empty($booklink)) { ?>
				<h2>Recommended Book</h2>
				<p><a href="<?php echo $booklink; ?>" target="_blank" onclick="ga('send', 'event', 'Recommended Books', 'Click', '<?php the_title(); ?>');"><?php the_title(); ?></a></p>
			<?php } ?>
			
			<?php if (!empty($link)) { ?>
				<h2>Helpful Link</h2>
				<p><a href="<?php echo $link; ?>" target="_blank" onclick="ga('send', 'event', 'Helpful Links', 'Click', '<?php the_title(); ?>');"><?php the_title(); ?></a></p>
			<?php } ?>

		</div><!-- end #main -->
		
		<?php include('inc/sidebar-blog.php'); ?>
	
		<div class="clear"></div>
	
	</section><!--end #page_content-->
	
	
<?php endwhile; endif; ?>


<?php get_footer(); ?>