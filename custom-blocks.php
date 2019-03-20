<?php

// SIMPLY INCLUDE THIS FILE IN THE FUNCTIONS.PHP AND YOUR BLOCKS SHOULD LOAD

function getCustomBlockBaseUrl(){
  return get_stylesheet_directory_uri();
  // return plugin_dir_url(__FILE__);
}

function loadMyCustomblocks() {

  wp_enqueue_script(
    'all-blocks-handle',
    getCustomBlockBaseUrl().'/blocks/block.build.js',
    array('wp-blocks', 'wp-i18n', 'wp-editor'),
    true
  );
}

add_action('enqueue_block_editor_assets', 'loadMyCustomblocks');


// enque them there stylesheets
add_action( 'init', 'registerCustomBlockStylesheets' );
//load stylesheets
function registerCustomBlockStylesheets()
{
  wp_register_style('customBlockBackendStyles', getCustomBlockBaseUrl().'/blocks/build/built-backend-styles', array(), '1.0', 'all');
  wp_register_style('customBlockFrontendStyles', getCustomBlockBaseUrl().'/blocks/build/built-frontend-styles', array(), '1.0', 'all');

  wp_enqueue_style('customBlockFrontendStyles'); // Enqueue it!

  if( is_user_logged_in() && current_user_can( 'administrator' ) ) {
    wp_enqueue_style('customBlockBackendStyles'); // Enqueue it!
  }


}


//create custom block category
function registerCustomBlockCategories( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'block_category', // this must match the slug in the js
				'title' => 'Block Category Name',
			),
		)
	);
}
add_filter( 'block_categories', 'registerCustomBlockCategories', 10, 2);



/* To Save Post Meta from your block uncomment
  the code below and adjust the post type and
  meta name values accordingly. If you want to
  allow multiple values (array) per meta remove
  the 'single' property.

function myBlockMeta() {
  register_meta('post', 'color', array('show_in_rest' => true, 'type' => 'string', 'single' => true));
}
add_action('init', 'myBlockMeta');
