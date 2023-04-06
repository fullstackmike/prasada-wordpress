<?php 
// TRUNCATE
function myTruncate($string, $limit, $break=" ", $pad="...")
{

  if(strlen($string) <= $limit) return $string;

  $string = substr($string, 0, $limit);
  if(false !== ($breakpoint = strrpos($string, $break))) {
    $string = substr($string, 0, $breakpoint);
  }

  return $string . $pad;
}

//ALLOW VCARD UPLOADS
add_filter('upload_mimes', 'add_custom_upload_mimes');
function add_custom_upload_mimes($existing_mimes){
    // to add more extensions, just copy the following line and
    // change the file extension in the ''
    $existing_mimes['vcf'] = 'text/vcf'; //allow vcf files
return $existing_mimes;
}  

//SHOW FUTURE POSTS ON SINGLE PAGES 
function show_future_posts($posts)
{
   global $wp_query, $wpdb;
   if(is_single() && $wp_query->post_count == 0)
   {
      $posts = $wpdb->get_results($wp_query->request);
   }
   return $posts;
}
add_filter('the_posts', 'show_future_posts');

//ALLOW VCF UPLOAD 
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
	// add your extension to the array
	$existing_mimes['vcf'] = 'text/x-vcard';
	return $existing_mimes;
}

//CHECKS TO SEE IF PAGE OR CHILD OF PAGE
function is_tree($pid) {
	global $post;
	if(is_page()&&($post->post_parent==$pid||is_page($pid))) 
    	return true;   // we're at the page or at a sub page
	else 
    	return false;  // we're elsewhere
}

// IF BLOG PAGE 
function is_blog () {
	global  $post;
	$posttype = get_post_type($post);
	return (((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_search()) || (is_tag())) && ( $posttype == 'post'));
}

// ALLOW EDITORS GRAVITY FORMS PERMISSIONS
function connect_adminimize_gravityforms(){
	$role = get_role('editor'); // Or whatever role you need to enable this for
	$role->add_cap('gform_full_access');
}
add_action('admin_init','connect_adminimize_gravityforms');

// GET THE CURRENT POSTS SLUG
function the_slug() {
    $post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug; 
}

// LIMIT SEARCH TO ONLY POSTS
function SearchFilter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','SearchFilter');

?>