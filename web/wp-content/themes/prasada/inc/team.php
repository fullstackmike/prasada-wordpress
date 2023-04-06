<h2 class="extra_top">Meet the Team</h2>
				
<?php $my_query = new WP_Query( array( 'post_type' => 'bio', 'showposts' => -1));
while ($my_query->have_posts()) : $my_query->the_post();
$auth_id = types_render_field("auth_id", array());
$photo = types_render_field("bio_photo", array('raw' => 'true'));
$bio_title = types_render_field("bio_title", array());
$vcard = types_render_field("bio_vcard", array('raw' => 'true'));

$fav_book = types_render_field("fav_book", array());
$book_link = types_render_field("book_link", array());

$do_not_duplicate = $post->ID; 
$postcount++; ?>

	<div class="bio">
	
		<div class="bio_meta">
		
			<div class="bio_meta_l">
			
				<?php if($photo != '') { ?>
			
					<img src="<?php echo $photo; ?>" alt="<?php the_title(); ?>">
				
				<?php } ?>
			
			</div><!--end .bio_meta_l-->
			
			<div class="bio_meta_r">
		
				<h3><?php the_title(); ?></h3>
				<div class="bio_title"><?php echo $bio_title; ?></div>
				<?php if (!empty($vcard)) { ?><div class="bio_vcard"><a href="<?php echo $vcard; ?>">Download vCard</a></div><?php } ?>
			
			</div><!--end .bio_meta_r-->
			
			<div class="clear"></div>
		
		</div><!--end .bio_meta-->
		
		<?php the_content(); ?>
		
		<?php if($fav_book != '') { ?>
		
			<p><strong>Current Favorite Book:</strong><br>
			<?php if($book_link != '') { ?>
			
				<a href="<?php echo $book_link; ?>" target="_blank"><?php echo $fav_book; ?></a></p>
			
			<?php } else { ?>
			
				<?php echo $fav_book; ?></p>
			
			<?php } ?>
		
		<?php } ?>
		
		
		<?php if($auth_id != '') { ?>
		
			<?php $post_query = new WP_Query( array( 'author' => $auth_id, 'showposts' => 3));
			$postcount = $post_query->found_posts; wp_reset_query(); ?>
			
			<?php if ($postcount > 0) { ?>
			
			<strong>Recent Blog Posts:</strong><br>
			<ul>
					
				<?php $post_query = new WP_Query( array( 'author' => $auth_id, 'showposts' => 3));
				while ($post_query->have_posts()) : $post_query->the_post();
				$do_not_duplicate = $post->ID; 
				$postcount++; ?>
				
					<li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
						
				<?php endwhile; wp_reset_query(); ?>
			
			</ul>
			
			<?php } ?>
		
		<?php } ?>
	
	</div><!--end .bio-->

<?php endwhile; wp_reset_query(); ?>