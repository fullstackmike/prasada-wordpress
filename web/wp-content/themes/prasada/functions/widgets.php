<?php
if ( function_exists('register_sidebar') )
    register_sidebar();

if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Blog - Main',
'before_widget' => '<div class="side_block">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

?>