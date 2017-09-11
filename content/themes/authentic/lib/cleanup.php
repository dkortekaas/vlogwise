<?php

if ( ! function_exists( 'authentic_start_cleanup' ) ) :
function authentic_start_cleanup() {

	// Launching operation cleanup.
	add_action( 'init', 'authentic_cleanup_head' );

	// Remove WP version from RSS.
	add_filter( 'the_generator', 'authentic_remove_rss_version' );

	// Remove pesky injected css for recent comments widget.
	add_filter( 'wp_head', 'authentic_remove_wp_widget_recent_comments_style', 1 );

	// Clean up comment styles in the head.
	add_action( 'wp_head', 'authentic_remove_recent_comments_style', 1 );

	// Clean up gallery output in wp.
	add_filter( 'authentic_gallery_style', 'authentic_gallery_style' );

}
add_action( 'after_setup_theme','authentic_start_cleanup' );
endif;

/**
 * Clean up head.+
 * ----------------------------------------------------------------------------
 */

if ( ! function_exists( 'weblogiqpress_cleanup_head' ) ) :
function authentic_cleanup_head() {

	// EditURI link.
	remove_action( 'wp_head', 'rsd_link' );

	// Category feed links.
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Post and comment feed links.
	remove_action( 'wp_head', 'feed_links', 2 );

	// Windows Live Writer.
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Index link.
	remove_action( 'wp_head', 'index_rel_link' );

	// Previous link.
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

	// Start link.
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	// Canonical.
	remove_action( 'wp_head', 'rel_canonical', 10, 0 );

	// Shortlink.
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	// Links for adjacent posts.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	// WP version.
	remove_action( 'wp_head', 'wp_generator' );
}
endif;

// Remove WP version from RSS.
if ( ! function_exists( 'authentic_remove_rss_version' ) ) :
function authentic_remove_rss_version() { return ''; }
endif;

// Remove injected CSS for recent comments widget.
if ( ! function_exists( 'authentic_remove_wp_widget_recent_comments_style' ) ) :
function authentic_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
	  remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}
endif;

// Remove injected CSS from recent comments widget.
if ( ! function_exists( 'authentic_remove_recent_comments_style' ) ) :
function authentic_remove_recent_comments_style() {
	global $wp_widget_factory;
	if ( isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']) ) {
	remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}
endif;

// Remove injected CSS from gallery.
if ( ! function_exists( 'authentic_gallery_style' ) ) :
function authentic_gallery_style( $css ) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}
endif;


// Remove WP update notification for all users except sysadmin
global $user_login;
get_currentuserinfo();
if ( ! current_user_can( 'update_plugins' ) ) :
    add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
    add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
endif;


// Disable emojicons introduced with WP 4.2
if ( ! function_exists( 'authentic_disable_wp_emojicons' ) ) :
function authentic_disable_wp_emojicons() {
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}

add_action( 'init', 'authentic_disable_wp_emojicons' );
endif;

if ( ! function_exists( 'authentic_disable_emojicons_tinymce' ) ) :
function authentic_disable_emojicons_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
endif;

// Remove WP Version From styles and scripts
add_filter( 'style_loader_src', 'authentic_remove_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'authentic_remove_ver_css_js', 9999 );

if ( ! function_exists( 'authentic_remove_ver_css_js' ) ) :
function authentic_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
endif;

?>
