<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post();
//$auth_id = types_render_field("auth_id", array());
$terms = wp_get_post_terms($post->ID, 'related-service');
$count = count($terms);
if ( $count == 1 ) {
    foreach ( $terms as $term ) {
    	$service = $term->name;
    }
};

$postcount++;
?>
		
	<!-- PAGE TITLE -->
	<section id="page-title">					

		<h1><?php the_title(); ?></h1>

		<div class="subtitle">Case Study<?php if($service != '') { echo ": " . $service; } ?></div>			
	
	</section>
	<!-- END PAGE TITLE -->


	<section id="page_content">
	
		<div id="main">
		
			<h2>Details</h2>
			
			<?php the_content(); ?>

		</div><!-- end #main -->
		
		<?php include('inc/sidebar-case-study.php'); ?>
	
		<div class="clear"></div>
	
	</section><!--end #page_content-->
	
	
<?php endwhile; endif; ?>


<?php get_footer(); ?>