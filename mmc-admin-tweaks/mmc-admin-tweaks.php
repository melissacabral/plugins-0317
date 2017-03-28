<?php
/*
Plugin Name: MMC Admin Tweaks
Description: Customizes the login form, register form, and admin screens
Author: Melissa Cabral
Version: 0.1
License: GPLv3
*/

/**
 * Style the login, register, and forgot password forms with an external stylesheet
 */
function mmc_login_style(){
	$style_url = plugins_url( 'css/login.css', __FILE__ );
					//  handle, 	url
	wp_enqueue_style( 'login_css', 	$style_url );
}
add_action( 'login_enqueue_scripts', 'mmc_login_style' );

//change the "wordpress.org" link on the login logo
function mmc_login_logo_link(){
	return home_url();  //any valid URL can go here
}
add_filter( 'login_headerurl', 'mmc_login_logo_link' );

//change the tooltip on the login logo
function mmc_login_logo_title(){
	return 'Go back to ' . get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'mmc_login_logo_title' );

/**
 * Customize the Admin Bar (tool bar)
 * @see   https://codex.wordpress.org/Toolbar
 * @param $wp_admin_bar The global admin bar object
 */
function mmc_modify_toolbar( $wp_admin_bar ){
	//Get rid of WP logo and its dropdown menu
	$wp_admin_bar->remove_node('wp-logo');

	//add our own "help" button
	$wp_admin_bar->add_node( array(
		'id' 	=> 'mmc-help-menu',
		'title'	=> 'Contact Melissa',
		'href'	=> 'http://melissacabral.com',
		'meta'	=> array( 'target' => '_blank' ), //open in new tab
	) );
}
add_action( 'admin_bar_menu', 'mmc_modify_toolbar', 999 );

/**
 * Remove unneeded Dashboard Widgets and add our own
 */
function mmc_dashboard_widgets(){
					//  	 ID 				screen 		column
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );

	// $id, $title, $callback, $screen, $context, $priority, $callback_args
	add_meta_box( 'dashboard_mmc_help', 'Helpful Resources', 'mmc_dash_content', 
		'dashboard', 'side', 'high' );
}
add_action('admin_init', 'mmc_dashboard_widgets');

//callback for the widget content
function mmc_dash_content(){
	echo '<iframe width="300" height="200" src="https://www.youtube.com/embed/8OBfr46Y0cQ" frameborder="0" allowfullscreen></iframe>';
}