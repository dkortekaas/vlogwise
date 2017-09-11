<?php

/**
 * Include theme specific functions
 *
 * The $authentic_includes array determines the theme specific code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 */

$authentic_includes = array(

  '/lib/init.php',                                // Initial Theme Setup
  '/lib/plugins.php',                             // List of Required Plugins
  '/lib/dashboard.php',                           // Dashboard Functions
  '/lib/options.php',                             // Options
  '/lib/theme-mods.php',                          // Theme Mods
  '/lib/custom-fields.php',                       // Custom Fields
  '/lib/template-tags.php',                       // Functions
  '/lib/assets.php',                              // Theme Assets
  '/lib/gallery.php',                             // Gallery
  '/lib/projects.php',                            // Projects
  '/lib/cleanup.php',                             // WP Cleanup
  '/lib/login.php',                               // Login
);

foreach ($authentic_includes as $file) {
  include_once get_template_directory() . $file;
}


