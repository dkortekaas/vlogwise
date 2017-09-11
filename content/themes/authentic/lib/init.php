<?php

/**
 * Initial setup and constants
 */

function authentic_setup() {

  // Make theme available for translation
  load_theme_textdomain('authentic', get_template_directory() . '/lang');

  // Add post thumbnails
  add_theme_support('post-thumbnails');

  // Add excerpts on pages
  add_post_type_support('page','excerpt');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

  // Automatic Feed Links
  add_theme_support('automatic-feed-links');

  // Add post formats
  add_theme_support('post-formats', array( 'gallery', 'video', 'audio', 'image' ));

  // Add custom image sizes
  add_image_size( 'hd', 1920, '', false );
  add_image_size( 'standard', 1100, 640, true );
  add_image_size( 'square', 1100, 1100, true );
  add_image_size( 'grid', 530, 380, true );
  add_image_size( 'list', 530, 640, true );
  add_image_size( 'masonry', 530, '', false );
  add_image_size( 'mini', 100, 100, true );

}

add_action('after_setup_theme', 'authentic_setup');

/**
 * Set default options upon theme activation
 */

function authentic_theme_activated() {

  // Media Sizes

  update_option( 'thumbnail_size_w', 440 );
  update_option( 'thumbnail_size_h', 290 );
  update_option( 'thumbnail_crop', 1 );
  update_option( 'large_size_w', 1100 );
  update_option( 'large_size_h', '' );
  update_option( 'medium_size_h', 270 );
  update_option( 'medium_size_h', '' );

}

add_action( 'after_switch_theme', 'authentic_theme_activated' );

/**
 * Register header menus
 */

function authentic_register_header_menus() {

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus(array(
    'primary-menu'   => esc_html__('Primary Menu', 'authentic'),
    'secondary-menu' => esc_html__('Secondary Menu', 'authentic'),
    'footer-menu'    => esc_html__('Footer Menu', 'authentic'),
  ));

}

add_action('init', 'authentic_register_header_menus');

/**
 * Register sidebars
 */

function authentic_widgets_init() {

  register_sidebar(array(
    'name'          => esc_html__('Default Sidebar', 'authentic'),
    'id'            => 'sidebar-main',
    'before_widget' => '<div class="widget %1$s %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5 class="title-widget">',
    'after_title'   => '</h5>'
  ));

  register_sidebars( 3, array(
    'name'          => esc_html__('Footer Sidebar %d', 'authentic'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<div class="widget %1$s %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5 class="title-widget">',
    'after_title'   => '</h5>'
  ));
}

add_action('widgets_init', 'authentic_widgets_init');

/**
 * Include and register widgets
 */

function authentic_register_widgets() {
  $authentic_widgets = array(
    'posts'         => 'authentic_widget_posts',
    'facebook'      => 'authentic_widget_facebook',
    'twitter'       => 'authentic_widget_twitter',
    'about'         => 'authentic_widget_about',
    'social'        => 'authentic_widget_social',
    'subscribe'     => 'authentic_widget_subscribe',
  );
  foreach ( $authentic_widgets as $key => $value ) {
    require_once get_template_directory() .'/inc/widgets/'. sanitize_key( $key ) .'.php';
    register_widget( $value );
  }
}

add_action( 'widgets_init', 'authentic_register_widgets' );

/**
 * Set Default Content Width
 */

if ( ! isset( $content_width ) ) $content_width = 1170;

/**
 * Kirki
 */

include_once( get_template_directory() . '/inc/kirki/kirki.php' );

// Kirki Options

function authentic_kirki_styling( $config ) {
  $config['logo_image']   = get_template_directory_uri() . '/dist/img/logo-customizer.png';
  $config['description']  = esc_html__( 'Creative Theme for Blogs & Magazines', 'authentic' );
  $config['disable_loader'] = true;
  $config['url_path'] = get_template_directory_uri() . '/inc/kirki/';
  return $config;
}

add_filter( 'kirki/config', 'authentic_kirki_styling' );

// Register Theme Mods

Kirki::add_config( 'authentic_theme_mod', array(
  'capability'    => 'edit_theme_options',
  'option_type'   => 'theme_mod',
));

// Register Options

Kirki::add_config( 'csco_option', array(
  'capability'    => 'edit_theme_options',
  'option_type'   => 'option',
));

// Add Custom CSS after Kirki inline styles

function authentic_custom_css( $css ) {
  $custom_css = get_theme_mod( 'authentic_custom_css', '' );
  return $css . $custom_css;
}

add_filter( 'kirki/authentic_theme_mod/dynamic_css', 'authentic_custom_css' );

/**
 * ACF Pro
 */

// Hide ACF field group menu item

add_filter('acf/settings/show_admin', '__return_false');

// Disable ACF Update Notification

function authentic_filter_plugin_updates($value) {
  if ( isset( $value ) && is_object( $value ) ) {
    unset($value->response[ 'advanced-custom-fields-pro/acf.php' ]);
  }
  return $value;
}

add_filter('site_transient_update_plugins', 'authentic_filter_plugin_updates');

// ACF Wrapper Function

function _get_field( $key, $id = false, $default = '', $format_value = true ) {
  global $post;
  $key = trim( filter_var( $key, FILTER_SANITIZE_STRING ) );
  $result = '';
  if ( function_exists( 'get_field' ) ) {
    if ( isset( $post->ID ) && !$id ) {
      $result = get_field( $key, false, $format_value );
    } else {
      $result = get_field( $key, $id, $format_value );
      if ($result == '' && $default !== '') {
        $result = $default;
      }
    }
  } else {
    $result = $default;
  }
  return $result;
}

function _the_field( $key, $id = false, $default = '', $format_value = true ) {
  echo _get_field( $key, $id, $default, $format_value );
}

function _get_sub_field( $key, $default = '' ) {
  if ( function_exists( 'get_sub_field' ) &&  get_sub_field( $key ) ) {
    return get_sub_field( $key );
  }
   else {
    return $default;
  }
}

function _the_sub_field( $key, $default = '' ) {
  echo _get_sub_field( $key, $default );
}

function _has_sub_field( $key, $id = false ) {
  if ( function_exists('has_sub_field') ) {
    return has_sub_field( $key, $id );
  }
  else {
    return false;
  }
}
