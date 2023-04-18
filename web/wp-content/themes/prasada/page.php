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
			
			<!-- MAKING THE CASE PAGE -->
			<?php if (is_page(32)) { include('inc/research.php');  } ?>
			
			<!-- TEAM PAGE -->
			<?php if (is_page(30)) { include('inc/team.php');  } ?>
	
		</div><!-- end #main -->
		
		<?php include('inc/services.php'); ?>
	
		<div class="clear"></div>
	
	</section><!--end #page_content-->


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
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>