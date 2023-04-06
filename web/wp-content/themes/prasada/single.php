<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post();
$featured_img = types_render_field("featured_img", array('raw' => 'true'));
$name = get_the_author_meta('display_name');
$email = get_the_author_meta('user_email');
$login = get_the_author_meta('user_login');
$description = get_the_author_meta('description');
$first_name = get_the_author_meta('first_name');


$photo_credit = types_render_field("photo_credit", array());
$credit_link = types_render_field("credit_link", array());

$currentpost = $post->ID;
?>
		
	<!-- PAGE TITLE -->
	<section id="page-title">					

		<h1><?php the_title(); ?></h1>

		<div class="subtitle">by <?php the_author(); ?></div>			
	
	</section>
	<!-- END PAGE TITLE -->


	<section id="page_content">
	
		<div id="main">
		
			<div class="sep">
			
				<div class="single-meta">
			
					<div class="meta_date"><?php the_time('F j, Y'); ?></div>
					
					<div class="post_cats"><?php the_category(', '); ?></div>
					
					<div class="clear"></div>
				
				</div><!--end .single-meta-->
			
			</div><!--end .sep-->
		
			<?php if ($featured_img != '') { ?>
				<div id="featured_img">
					<img src="<?php echo $featured_img; ?>" alt="<?php the_title(); ?>">
				</div><!--end #featured_img-->
			<?php } ?>
			
			
			<?php the_content(); ?>
			
			<div id="author">
				
				<div class="author_l">
				
					<?php echo get_avatar(get_the_author_meta('ID'), 100); ?>
				
				</div><!--end .author_l-->
				
				<div class="author_r">
				
					<div class="pad">
				
						<h4><?php echo $name; ?></h4>
						<p><?php echo $description; ?></p>
						<a href="/author/<?php echo $login; ?>">View my other posts</a>
									
					</div><!--end .pad-->
				
				</div><!--end .author_r-->
				
				<div class="clear"></div>
			
			</div><!--end #author-->
			
			<?php if ($photo_credit != '') { ?>
			
				<div id="photo_credit">
				
					<p><strong>Photo Credit:</strong> <?php echo $photo_credit; ?>
					<?php if ($credit_link != '') { ?>
						(<a href="<?php echo $credit_link; ?>" target="_blank">Link</a>)
					<?php } ?></p>
				
				</div><!--end #photo_credit-->
			
			<?php } ?>

		</div><!-- end #main -->
		
		<?php include('inc/sidebar-blog.php'); ?>
	
		<div class="clear"></div>
	
	</section><!--end #page_content-->
	
	
<?php endwhile; endif; ?>


<?php get_footer(); ?>