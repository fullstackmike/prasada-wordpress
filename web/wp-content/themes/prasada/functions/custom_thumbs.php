<?php
//Adding in the Featured Image functionality and adding in our custom sizes
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 340, 9999 ); // Normal post thumbnails
add_image_size( 'blog-thumb', 340, 340, true ); // Cropped to exact size
add_image_size( 'sm-thumb', 140, 140, true );
?>