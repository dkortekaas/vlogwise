<?php

/**
 * Include TGM Class
 */

include_once get_template_directory() . '/inc/classes/class-tgm-plugin-activation.php';

/**
 * Register Required Plugins
 */

function authentic_theme_register_required_plugins() {

  $plugins = array(

    array(
      'name'          => 'Advanced Custom Fields PRO',
      'slug'          => 'advanced-custom-fields-pro',
      'source'        => 'http://assets.codesupply.co/advanced-custom-fields-pro.zip',
      'required'      => true,
      'version'       => '5.3.10',
      'external_url'  => 'http://www.advancedcustomfields.com/',
    ),

    array(
      'name'          => 'WP-PostViews',
      'slug'          => 'wp-postviews',
      'required'      => false,
    ),

    array(
      'name'          => 'One Click Demo Import',
      'slug'          => 'one-click-demo-import',
      'required'      => false,
    ),

    array(
      'name'          => 'Envato Market',
      'slug'          => 'envato-market',
      'source'        => 'http://envato.github.io/wp-envato-market/dist/envato-market.zip',
      'required'      => false,
      'external_url'  => 'https://github.com/envato/wp-envato-market',
    ),

    array(
      'name'          => 'CSCO: Shortcodes',
      'slug'          => 'csco-shortcodes',
      'source'        => 'http://assets.codesupply.co/csco-shortcodes.zip',
      'required'      => false,
      'version'       => '1.0.0',
      'external_url'  => 'http://www.codesupply.co/',
    ),

    array(
      'name'          => 'CSCO: Twitter API',
      'slug'          => 'csco-twitter-api',
      'source'        => 'http://assets.codesupply.co/csco-twitter-api.zip',
      'required'      => false,
      'version'       => '1.0.0',
      'external_url'  => 'http://www.codesupply.co/',
    ),

    array(
      'name'          => 'WP Instagram Widget',
      'slug'          => 'wp-instagram-widget',
      'required'      => false,
    ),

    array(
      'name'          => 'Contact Form 7',
      'slug'          => 'contact-form-7',
      'required'      => false,
    ),

    array(
      'name'          => 'Bootstrap for Contact Form 7',
      'slug'          => 'bootstrap-for-contact-form-7',
      'required'      => false,
    ),

  );

  $config = array(
    'id'           => 'authentic',
    'default_path' => '',
    'menu'         => 'authentic-install-plugins',
    'has_notices'  => true,
    'dismissable'  => true,
    'dismiss_msg'  => '',
    'is_automatic' => true,
    'message'      => '',
  );

  tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'authentic_theme_register_required_plugins' );
