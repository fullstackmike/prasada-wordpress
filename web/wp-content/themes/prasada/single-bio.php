<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post();
$auth_id = types_render_field("auth_id", array());
$bio_title = types_render_field("bio_title", array());
$vcard = types_render_field("bio_vcard", array());
$fav_book = types_render_field("fav_book", array());
$book_link = types_render_field("book_link", array());

$currentpost = $post->ID;
$postcount++;
?>
		
	<!-- PAGE TITLE -->
	<section id="page-title">					

		<h1><?php the_title(); ?></h1>

		<div class="subtitle"><?php echo $bio_title; ?></div>

	</section>
	<!-- END PAGE TITLE -->


	<section id="page_content">
	
		<div id="main">
		
			<h2>Biography</h2>
			
			<?php the_content(); ?>
			
			<?php if($fav_book != '') { ?>
		
			<p><strong>Current Favorite Book:</strong><br>
			<?php if($book_link != '') { ?>
				
					<a href="<?php echo $book_link; ?>" target="_blank"><?php echo $fav_book; ?></a></p>
				
				<?php } else { ?>
				
					<?php echo $fav_book; ?>
				
				<?php } ?>
			
			<?php } ?>
			
			<div id="recent">
			
				<h2>Recent Blog Posts</h2>
				<ul>
				
					<?php $my_query = new WP_Query( array( 'author' => $auth_id, 'showposts' => 5));
					while ($my_query->have_posts()) : $my_query->the_post();
					$do_not_duplicate = $post->ID; 
					$postcount++; ?>
					
						<li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
							
					<?php endwhile; wp_reset_query(); ?>
				
				</ul>
			
			</div><!--end #recent-->

		</div><!-- end #main -->
		
		<?php include('inc/services.php'); ?>
	
		<div class="clear"></div>
	
	</section><!--end #page_content-->
	
	
<?php endwhile; endif; ?>


<?php get_footer(); ?>