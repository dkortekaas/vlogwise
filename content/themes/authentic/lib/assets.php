<?php

/**
 * Assets
 */

if (!defined('WP_ENV')) {
  // Fallback if WP_ENV isn't defined in your WordPress config
  // Used to check for 'development' or 'production'
  define('WP_ENV', 'production');
}

function authentic_assets() {

  if (WP_ENV === 'development') {
    $assets = array(
      'css'       => '/assets/css/style.css',
      'slick_css' => '/assets/css/slick.css',
      'js'        => '/assets/js/scripts.js',
      'slick_js'  => '/assets/js/slick.js',
      'slider'    => '/assets/js/slider.js',
    );
    $version = time();
  } else {
    $assets     = array(
      'css'       => '/style.css',
      'slick_css' => '/dist/css/slick.css',
      'slick_js'  => '/dist/js/slick.min.js',
      'slider'    => '/dist/js/slider.js',
      'js'        => '/dist/js/scripts.min.js',      
    );
    $version = wp_get_theme()->get('Version');
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script( 'authentic_js', get_template_directory_uri() . $assets['js'], array(), $version, true);
  wp_register_script( 'slick_js', get_template_directory_uri() . $assets['slick_js'], array(), $version, true);
  wp_register_script( 'slider_js', get_template_directory_uri() . $assets['slider'], array(), $version, true);

  $translation_array = array(
    'next' => esc_html__( 'Next', 'authentic' ),
    'previous' => esc_html__( 'Previous', 'authentic' ),
  );
  wp_localize_script( 'authentic_js', 'translation', $translation_array );

  wp_enqueue_script('jquery');
  wp_enqueue_script('authentic_js');
  wp_enqueue_script('isotope_js');
  wp_enqueue_script('slick_js');
  wp_enqueue_script('slider_js');

  if (WP_ENV !== 'development') {
    wp_enqueue_style('authentic_vendors', get_template_directory_uri() . '/dist/css/vendors.min.css', false, $version);
  }

  wp_enqueue_style('authentic_css', get_template_directory_uri() . $assets['css'], false, $version);
  wp_enqueue_style('slick_css', get_template_directory_uri() . $assets['slick_css'], false, $version);
  

}
add_action('wp_enqueue_scripts', 'authentic_assets');

function isotope_projects() {
    wp_enqueue_script( 'isotope_js', get_stylesheet_directory_uri() . '/dist/js/isotope.pkgd.min.js', array( 'jquery' ), $version, true );
    wp_enqueue_script( 'projects_js', get_stylesheet_directory_uri() . '/dist/js/projects.js', array( 'jquery' ), $version, true );
}
add_action( 'wp_enqueue_scripts', 'isotope_projects' );
