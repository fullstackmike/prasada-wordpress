<?php
/*
Template Name: No Nav or Sidebar
*/
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]> <html class="no-js" lang="en"> <!--<![endif]-->

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
      
<head profile="http://gmpg.org/xfn/11">

<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1" />

<title><?php wp_title(); ?></title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.png">
<link href="<?php bloginfo('stylesheet_directory'); ?>/apple-touch-icon.png" rel="apple-touch-icon" />
<link href="<?php bloginfo('stylesheet_directory'); ?>/apple-touch-icon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
<link href="<?php bloginfo('stylesheet_directory'); ?>/apple-touch-icon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
<link href="<?php bloginfo('stylesheet_directory'); ?>/apple-touch-icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />

<?php include('inc/css.php'); ?>

<!-- ********** SOCIAL META ********** -->

<!-- ********** SOCIAL META ********** -->
    
<script src='https://www.google.com/recaptcha/api.js'></script>
    
<?php wp_head(); ?>

<?php include('inc/js.php'); ?>

</head>

<body <?php body_class(); ?>>

	<div class="page-loader-bg"></div>
	
	<div id="top">

	<div class="top_bg">
	
		<div class="container">
		
			<div id="logo">
			
				<a href="/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/prasada.png" alt="Prasada - Wholebeing in the workplace" /></a>
				
			</div><!--end #logo-->
			
			<div class="clear"></div>
		
		</div><!--end .container-->
	
	</div><!--end .top_bg-->

</div><!--end #top-->

	<div class="container">

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
	
		<div id="main" class="fullwidth">
					
			<?php the_content(); ?>
	
		</div><!-- end #main -->
	
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