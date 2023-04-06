<h2 class="extra_top">The Research</h2>
				
<?php $my_query = new WP_Query( array( 'post_type' => 'research-article', 'showposts' => -1));
while ($my_query->have_posts()) : $my_query->the_post();
$footnotes = types_render_field("footnotes", array());
$ext_link = types_render_field("ext_link", array());
$ext_link_text = types_render_field("ext_link_text", array());
$do_not_duplicate = $post->ID; 
$postcount++; ?>

	<div class="article">
	
		<h3><?php the_title(); ?></h3>
		
		<?php the_content(); ?>
		
		<?php if ($ext_link != '') { ?>
		
			<div id="ext_link">
			
				<a href="<?php echo $ext_link; ?>" target="blank"><?php echo $ext_link_text; ?></a>
			
			</div><!--end #ext_link-->
			
		<?php } ?>
		
		<?php if ($footnotes != '') { ?>
		
			<div id="footnotes">
			
				<ul>
					<li><?php echo do_shortcode('[types field="footnotes" separator="</li><li>"][/types]'); ?></li>
				</ul>
			
			</div><!--end #footnotes-->
			
		<?php } ?>
	
	</div><!--end .article-->

<?php endwhile; wp_reset_query(); ?>