<?php
/*
Plugin Name: MMC Product Post Type
Description: Registers the post type and taxonomies for our shop
Author: Melissa Cabral
Version: 0.1
License: GPLv3
*/

//Register the post type
add_action( 'init', 'mmc_post_type_register' );
function mmc_post_type_register(){
	register_post_type( 'product', array(
		'public' 		=> true,
		'has_archive' 	=> true,
		'menu_icon'		=> 'dashicons-cart',
		'menu_position'	=> 5,
		'rewrite'		=> array( 'slug' => 'shop' ),
		'supports'		=> array( 'title', 'editor', 'thumbnail', 'custom-fields', 
									'excerpt', 'comments', 'revisions' ),
		'labels'		=> array(
			'name' 			=> 'Products',
			'singular_name'	=> 'Product',
			'add_new_item'	=> 'Add New Product',
			'not_found'		=> 'No Products Found',
			'search_items'	=> 'Search Products',
		),
	) );
}
