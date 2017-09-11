<?php

/**
 * Variables
 */

// Typography

$font_family_base                       = 'Lato';
$font_family_headings                   = 'Montserrat';

$font_family_btn_primary                = 'Montserrat';
$font_family_btn_secondary              = 'Montserrat';

$color_base                             = '#777777';
$color_headings                         = '#000000';

$line_height_base                       = '1.5';
$line_height_headings                   = '1';

$font_size_base                         = '1rem';

$font_size_h1                           = '2rem';
$font_size_h2                           = '1.5rem';
$font_size_h3                           = '1.25rem';
$font_size_h4                           = '1rem';
$font_size_h5                           = '15px';
$font_size_h6                           = '15px';

// Colors

$link_color                             = '#000000';
$link_color_hover                       = '#888888';

$btn_primary_color                      = '#EEEEEE';
$btn_primary_color_hover                = '#FFFFFF';
$btn_primary_bg_color                   = '#282828';
$btn_primary_bg_color_hover             = '#000000';

$btn_secondary_color                    = '#A0A0A0';
$btn_secondary_color_hover              = '#000000';
$btn_secondary_bg_color                 = '#EEEEEE';
$btn_secondary_bg_color_hover           = '#F8F8F8';

/**
 * Typography
 */

Kirki::add_panel( 'typography', array(
  'priority'    => 5,
  'title'       => esc_html__( 'Typography', 'authentic' ),
));

/**
 * Typography > General
 */

Kirki::add_section( 'typography_general', array(
  'title'          => esc_html__( 'General', 'authentic' ),
  'panel'          => 'typography',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_base',
  'label'       => esc_html__( 'Base Font', 'authentic' ),
  'section'     => 'typography_general',
  'default'     => array(
    'font-family'    => $font_family_base,
    'variant'        => 'regular',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => $font_size_base,
    'line-height'    => $line_height_base,
    'color'          => $color_base,
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => 'body',
    ),
  ),
));

/**
 * Typography > Links & Buttons
 */

Kirki::add_section( 'typography_links', array(
  'title'          => esc_html__( 'Links & Buttons', 'authentic' ),
  'panel'          => 'typography',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'authentic_btn_link',
  'label'       => esc_html__( 'Link Color', 'authentic' ),
  'section'     => 'typography_links',
  'priority'    => 10,
  'choices'     => array(
    'default'   => esc_html__( 'Default', 'authentic' ),
    'hover'     => esc_html__( 'Hover', 'authentic' ),
  ),
  'default'     => array(
    'default'   => $link_color,
    'hover'     => $link_color_hover,
  ),
  'output'    => array(
    array(
      'choice'    => 'default',
      'element'   => 'a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => 'a:hover, a:active, a:focus, a:hover:active, a:focus:active',
      'property'  => 'color',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'authentic_headings_link',
  'label'       => esc_html__( 'Headings Link Color', 'authentic' ),
  'section'     => 'typography_links',
  'priority'    => 10,
  'choices'     => array(
    'default'   => esc_html__( 'Default', 'authentic' ),
    'hover'     => esc_html__( 'Hover', 'authentic' ),
  ),
  'default'     => array(
    'default'   => $link_color,
    'hover'     => $link_color_hover,
  ),
  'output'    => array(
    array(
      'choice'    => 'default',
      'element'   => 'h1 a, h2 a, h3 a, h4 a, h5 a, h6 a',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => 'h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover',
      'property'  => 'color',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_btn_primary_typography',
  'label'       => esc_html__( 'Primary Button Font', 'authentic' ),
  'section'     => 'typography_links',
  'default'     => array(
    'font-family'    => $font_family_btn_primary,
    'variant'        => 'regular',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '12px',
    'letter-spacing' => '1px',
    'text-transform' => 'uppercase',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.btn-primary, .link-more, .gallery-button, .post-pagination-title, .comment-reply-link, .list-social a span, #wp-calendar tfoot, .nav-tabs .nav-link, .nav-pills .nav-link, .panel .card-header, .title-share',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'authentic_btn_primary_text_color',
  'label'       => esc_html__( 'Primary Button Text Color', 'authentic' ),
  'section'     => 'typography_links',
  'priority'    => 10,
  'choices'     => array(
    'default'   => esc_html__( 'Default', 'authentic' ),
    'hover'     => esc_html__( 'Hover', 'authentic' ),
  ),
  'default'     => array(
    'default'   => $btn_primary_color,
    'hover'     => $btn_primary_color_hover,
  ),
  'output'    => array(
    array(
      'choice'    => 'default',
      'element'   => '.btn-primary',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.btn-primary:hover, .btn-primary:active, .btn-primary:focus, .btn-primary:active:focus, .btn-primary:active:hover',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'default',
      'element'   => '.overlay .btn.btn-primary',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.overlay .btn.btn-primary:hover, .overlay .btn.btn-primary:active, .overlay .btn.btn-primary:focus, .overlay .btn.btn-primary:active:focus, .overlay .btn.btn-primary:active:hover',
      'property'  => 'color',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'authentic_btn_primary_bg_color',
  'label'       => esc_html__( 'Primary Button Background Color', 'authentic' ),
  'section'     => 'typography_links',
  'priority'    => 10,
  'choices'     => array(
    'default'   => esc_html__( 'Default', 'authentic' ),
    'hover'     => esc_html__( 'Hover', 'authentic' ),
  ),
  'default'     => array(
    'default'   => $btn_primary_bg_color,
    'hover'     => $btn_primary_bg_color_hover,
  ),
  'output'    => array(
    array(
      'choice'    => 'default',
      'element'   => '.btn-primary, .nav-pills .nav-link.active, .nav-pills .nav-link.active:focus, .nav-pills .nav-link.active:hover',
      'property'  => 'background-color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.btn-primary:hover, .btn-primary:active, .btn-primary:focus, .btn-primary:active:focus, .btn-primary:active:hover',
      'property'  => 'background-color',
    ),
    array(
      'choice'    => 'default',
      'element'   => '.overlay .btn.btn-primary',
      'property'  => 'background-color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.overlay .btn.btn-primary:hover, .overlay .btn.btn-primary:active, .overlay .btn.btn-primary:focus, .overlay .btn.btn-primary:active:focus, .overlay .btn.btn-primary:active:hover',
      'property'  => 'background-color',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_btn_secondary_typography',
  'label'       => esc_html__( 'Secondary Button Font', 'authentic' ),
  'section'     => 'typography_links',
  'default'     => array(
    'font-family'    => $font_family_btn_secondary,
    'variant'        => 'regular',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '12px',
    'letter-spacing' => '1px',
    'text-transform' => 'uppercase',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.btn-secondary',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'authentic_btn_secondary_text_color',
  'label'       => esc_html__( 'Secondary Button Text Color', 'authentic' ),
  'section'     => 'typography_links',
  'priority'    => 10,
  'choices'     => array(
    'default'   => esc_html__( 'Default', 'authentic' ),
    'hover'     => esc_html__( 'Hover', 'authentic' ),
  ),
  'default'     => array(
    'default'   => $btn_secondary_color,
    'hover'     => $btn_secondary_color_hover,
  ),
  'output'    => array(
    array(
      'choice'    => 'default',
      'element'   => '.btn-secondary',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.btn-secondary:hover, .btn-secondary:active, .btn-secondary:focus, .btn-secondary:active:focus, .btn-secondary:active:hover',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'default',
      'element'   => '.overlay .btn.btn-secondary',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.overlay .btn.btn-secondary:hover, .overlay .btn.btn-secondary:active, .overlay .btn.btn-secondary:focus, .overlay .btn.btn-secondary:active:focus, .overlay .btn.btn-secondary:active:hover',
      'property'  => 'color',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'authentic_btn_secondary_bg_color',
  'label'       => esc_html__( 'Secondary Button Background Color', 'authentic' ),
  'section'     => 'typography_links',
  'priority'    => 10,
  'choices'     => array(
    'default'   => esc_html__( 'Default', 'authentic' ),
    'hover'     => esc_html__( 'Hover', 'authentic' ),
  ),
  'default'     => array(
    'default'   => $btn_secondary_bg_color,
    'hover'     => $btn_secondary_bg_color_hover,
  ),
  'output'    => array(
    array(
      'choice'    => 'default',
      'element'   => '.btn-secondary',
      'property'  => 'background-color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.btn-secondary:hover, .btn-secondary:active, .btn-secondary:focus, .btn-secondary:active:focus, .btn-secondary:active:hover',
      'property'  => 'background-color',
    ),
    array(
      'choice'    => 'default',
      'element'   => '.overlay .btn.btn-secondary',
      'property'  => 'background-color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.overlay .btn.btn-secondary:hover, .overlay .btn.btn-secondary:active, .overlay .btn.btn-secondary:focus, .overlay .btn.btn-secondary:active:focus, .overlay .btn.btn-secondary:active:hover',
      'property'  => 'background-color',
    ),
  ),
));

/**
 * Typography > Headings
 */

Kirki::add_section( 'typography_headings', array(
  'title'          => esc_html__( 'Headings', 'authentic' ),
  'panel'          => 'typography',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_page_header',
  'label'       => esc_html__( 'Page Header', 'authentic' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => '700',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '3rem',
    'line-height'    => $line_height_headings,
    'letter-spacing' => '-.2rem',
    'color'          => $color_headings,
    'text-transform' => 'none',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.page-header h1, .post-header h1',
      'media_query' => '@media (min-width: 992px)'
    ),
    array(
      'element' => '.post-standard h2',
      'media_query' => '@media (min-width: 992px)'
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_h1',
  'label'       => esc_html__( 'Heading 1', 'authentic' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => '700',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => $font_size_h1,
    'line-height'    => $line_height_headings,
    'letter-spacing' => '-.1rem',
    'color'          => $color_headings,
    'text-transform' => 'none',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => 'h1, .site-footer h2, .post-standard h2',
    ),
    array(
      'element' => '.post-featured h2',
      'media_query' => '@media (min-width: 992px)'
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_h2',
  'label'       => esc_html__( 'Heading 2', 'authentic' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => '700',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => $font_size_h2,
    'line-height'    => $line_height_headings,
    'letter-spacing' => '-.05rem',
    'color'          => $color_headings,
    'text-transform' => 'none',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => 'h2, .page-header-archive h1, .post-featured h2',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_h3',
  'label'       => esc_html__( 'Heading 3', 'authentic' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => '700',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => $font_size_h3,
    'line-height'    => $line_height_headings,
    'letter-spacing' => '-.05rem',
    'color'          => $color_headings,
    'text-transform' => 'none',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => 'h3',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_h4',
  'label'       => esc_html__( 'Heading 4', 'authentic' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => '700',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => $font_size_h4,
    'line-height'    => $line_height_headings,
    'letter-spacing' => '-.05rem',
    'color'          => $color_headings,
    'text-transform' => 'none',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => 'h4',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_h5',
  'label'       => esc_html__( 'Heading 5', 'authentic' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => 'regular',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => $font_size_h6,
    'line-height'    => $line_height_headings,
    'letter-spacing' => '-1px',
    'color'          => $color_headings,
    'text-transform' => 'uppercase',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => 'h5',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_h6',
  'label'       => esc_html__( 'Heading 6', 'authentic' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => '700',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => $font_size_h5,
    'line-height'    => $line_height_headings,
    'letter-spacing' => '-1px',
    'color'          => $color_headings,
    'text-transform' => 'none',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => 'h6, .comment .fn',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_block_title',
  'label'       => esc_html__( 'Title Block', 'authentic' ),
  'section'     => 'typography_headings',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => '700',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '16px',
    'line-height'    => $line_height_headings,
    'letter-spacing' => '-1px',
    'color'          => $color_headings,
    'text-transform' => 'none',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.title-widget, .title-trending, .title-related, .title-comments, .comment-reply-title, .nav-links, .list-categories',
    ),
  ),
));

/**
 * Typography > Post Content
 */

Kirki::add_section( 'typography_post_content', array(
  'title'          => esc_html__( 'Post Content', 'authentic' ),
  'panel'          => 'typography',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_post_content',
  'label'       => esc_html__( 'Paragraph', 'authentic' ),
  'section'     => 'typography_post_content',
  'default'     => array(
    'font-family'    => $font_family_base,
    'variant'        => 'regular',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => $font_size_base,
    'line-height'    => $line_height_base,
    'color'          => $color_base,
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.content',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_post_lead',
  'label'       => esc_html__( 'Lead', 'authentic' ),
  'section'     => 'typography_post_content',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => '700',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '1.75rem',
    'line-height'    => '1.25',
    'letter-spacing' => '-0.1rem',
    'color'          => $color_headings,
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.content .lead',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_post_dropcap_first_letter',
  'label'       => esc_html__( 'Drop Cap', 'authentic' ),
  'section'     => 'typography_post_content',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => 'regular',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '2.5rem',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.content .dropcap:first-letter',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_post_blockquote',
  'label'       => esc_html__( 'Blockquote', 'authentic' ),
  'section'     => 'typography_post_content',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => '700',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '1.75rem',
    'line-height'    => '1.25',
    'letter-spacing' => '-0.1rem',
    'color'          => $color_headings,
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.content blockquote',
    ),
  ),
));

/**
 * Typography > Miscellaneous
 */

Kirki::add_section( 'typography_misc', array(
  'title'          => esc_html__( 'Miscellaneous', 'authentic' ),
  'panel'          => 'typography',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_post_meta',
  'label'       => esc_html__( 'Post Meta', 'authentic' ),
  'section'     => 'typography_misc',
  'default'     => array(
    'font-family'    => $font_family_base,
    'subsets'        => array( 'latin-ext' ),
    'variant'        => 'regular',
    'font-size'      => '12px',
    'line-height'    => $line_height_base,
    'letter-spacing' => '0',
    'color'          => '#A0A0A0',
    'text-transform' => 'uppercase',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.post-meta, label, .post-categories, .widget-about-lead, .share-title, .post-count, .sub-title, .comment-metadata, blockquote cite, .post-tags, .tagcloud, .timestamp, #wp-calendar caption, .logged-in-as',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_page_excerpt',
  'label'       => esc_html__( 'Page Excerpt', 'authentic' ),
  'section'     => 'typography_misc',
  'default'     => array(
    'font-family'    => $font_family_base,
    'variant'        => '400',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '1.5rem',
    'line-height'    => '1.25',
    'letter-spacing' => '0',
    'color'          => '#000000',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.page-header .post-excerpt',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_widget_overlay_meta',
  'label'       => esc_html__( 'Posts Widget Number', 'authentic' ),
  'section'     => 'typography_misc',
  'default'     => array(
    'font-family'    => $font_family_base,
    'subsets'        => array( 'latin-ext' ),
    'variant'        => 'regular',
    'font-size'      => '1.25rem',
    'line-height'    => $line_height_headings,
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.post-number span:first-child',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_typography_search',
  'label'       => esc_html__( 'Search Form', 'authentic' ),
  'section'     => 'typography_misc',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'subsets'        => array( 'latin-ext' ),
    'variant'        => '700',
    'font-size'      => '4.25rem',
    'letter-spacing' => '-.25rem',
    'text-transform' => 'none',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '#search input[type="search"]',
      'media_query' => '@media (min-width: 992px)',
    ),
  ),
));

/*
 * Layout
 */

Kirki::add_panel( 'layout', array(
  'title'          => esc_html__( 'Layout', 'authentic' ),
  'priority'       => 5,
));

/*
 * Layout > General
 */

Kirki::add_section( 'layout_general', array(
  'title'          => esc_html__( 'General', 'authentic' ),
  'panel'          => 'layout',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'radio-image',
  'settings'    => 'authentic_layout_archive_page',
  'label'       => esc_html__( 'Archive Page Layout', 'authentic' ),
  'section'     => 'layout_general',
  'default'     => 'layout-sidebar-right',
  'priority'    => 10,
  'choices'     => array(
    'layout-sidebar-left'   => get_template_directory_uri() . '/dist/img/layout-sidebar-left.png',
    'layout-fullwidth'      => get_template_directory_uri() . '/dist/img/layout-full.png',
    'layout-sidebar-right'  => get_template_directory_uri() . '/dist/img/layout-sidebar-right.png',
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'radio-image',
  'settings'    => 'authentic_layout_post_page',
  'label'       => esc_html__( 'Post & Page Layout', 'authentic' ),
  'section'     => 'layout_general',
  'default'     => 'layout-sidebar-right',
  'priority'    => 10,
  'choices'     => array(
    'layout-sidebar-left'   => get_template_directory_uri() . '/dist/img/layout-sidebar-left.png',
    'layout-fullwidth'      => get_template_directory_uri() . '/dist/img/layout-full.png',
    'layout-sidebar-right'  => get_template_directory_uri() . '/dist/img/layout-sidebar-right.png',
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'authentic_container_width_home',
  'label'       => esc_html__( 'Home Page Width', 'authentic' ),
  'section'     => 'layout_general',
  'default'     => '1140px',
  'output' => array(
    array(
      'element'  => '.home .site-content .container',
      'property' => 'width',
      'media_query' => '@media (min-width: 992px)'
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'authentic_container_width_archive',
  'label'       => esc_html__( 'Archive Page Width', 'authentic' ),
  'section'     => 'layout_general',
  'default'     => '1140px',
  'output' => array(
    array(
      'element'  => '.archive .site-content .container',
      'property' => 'width',
      'media_query' => '@media (min-width: 992px)'
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'authentic_container_width_post_sidebar',
  'label'       => esc_html__( 'Sidebar Post Width', 'authentic' ),
  'section'     => 'layout_general',
  'default'     => '1140px',
  'output' => array(
    array(
      'element'  => '.single.layout-sidebar-right .site-content .container, .single.layout-sidebar-left .site-content .container,',
      'property' => 'max-width',
      'media_query' => '@media (min-width: 992px)'
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'authentic_container_width_post_fullwidth',
  'label'       => esc_html__( 'Fullwidth Post Width', 'authentic' ),
  'section'     => 'layout_general',
  'default'     => '940px',
  'output' => array(
    array(
      'element'  => '.single.layout-fullwidth .site-content .container',
      'property' => 'width',
      'media_query' => '@media (min-width: 992px)'
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'authentic_container_width_page_sidebar',
  'label'       => esc_html__( 'Sidebar Page Width', 'authentic' ),
  'section'     => 'layout_general',
  'default'     => '1140px',
  'output' => array(
    array(
      'element'  => '.page.layout-sidebar-right .site-content .container, .page.layout-sidebar-left .site-content .container,',
      'property' => 'max-width',
      'media_query' => '@media (min-width: 992px)'
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'authentic_container_width_page_fullwidth',
  'label'       => esc_html__( 'Fullwidth Page Width', 'authentic' ),
  'section'     => 'layout_general',
  'default'     => '940px',
  'output' => array(
    array(
      'element'  => '.page.layout-fullwidth .site-content .container',
      'property' => 'width',
      'media_query' => '@media (min-width: 992px)'
    )
  ),
));

/*
 * Layout > Posts & Pages
 */

Kirki::add_section( 'layout_posts_pages', array(
  'title'          => esc_html__( 'Posts', 'authentic' ),
  'panel'          => 'layout',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_layout_posts_share_buttons',
  'label'       => esc_html__( 'Show Share Buttons', 'authentic' ),
  'section'     => 'layout_posts_pages',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'select',
  'settings'    => 'authentic_layout_posts_featured_image',
  'label'       => esc_html__( 'Featured Image Type', 'authentic' ),
  'section'     => 'layout_posts_pages',
  'default'     => 'none',
  'priority'    => 10,
  'choices'     => array(
    'none'      => esc_html__('None','authentic'),
    'standard'  => esc_html__('Standard','authentic'),
    'wide'      => esc_html__('Wide','authentic'),
    'large'     => esc_html__('Large','authentic'),
  ),
));

/*
 * Layout > Post Archives
 */

Kirki::add_section( 'layout_post_archive', array(
  'title'          => esc_html__( 'Post Archives', 'authentic' ),
  'panel'          => 'layout',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'radio-image',
  'settings'    => 'authentic_layout_archive',
  'label'       => esc_html__( 'Post Archive Layout', 'authentic' ),
  'section'     => 'layout_post_archive',
  'default'     => 'standard',
  'priority'    => 10,
  'choices'     => array(
    'standard'  => get_template_directory_uri() . '/dist/img/layout-full.png',
    'list'      => get_template_directory_uri() . '/dist/img/layout-list.png',
    'grid'      => get_template_directory_uri() . '/dist/img/layout-grid.png',
    'masonry'   => get_template_directory_uri() . '/dist/img/layout-masonry.png',
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'select',
  'settings'    => 'authentic_layout_archive_columns',
  'label'       => esc_html__( 'Number of Columns', 'authentic' ),
  'section'     => 'layout_post_archive',
  'default'     => '2',
  'priority'    => 10,
  'choices'     => array(
    '2'         => '2',
    '3'         => '3',
  ),
  'active_callback' => array(
    array(
      array(
        'setting'  => 'authentic_layout_archive',
        'operator' => '==',
        'value'    => 'grid',
      ),
      array(
        'setting'  => 'authentic_layout_archive',
        'operator' => '==',
        'value'    => 'masonry',
      ),
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_layout_first_post',
  'label'       => esc_html__( 'First Standard Post', 'authentic' ),
  'description' => esc_html__( 'Valid for list, grid and masonry archive types only.', 'authentic' ),
  'section'     => 'layout_post_archive',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_layout_post_summary',
  'label'       => esc_html__( 'Show Post Summary', 'authentic' ),
  'section'     => 'layout_post_archive',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'radio',
  'settings'    => 'authentic_layout_post_summary_type',
  'label'       => esc_html__( 'Standard Post Summary', 'authentic' ),
  'section'     => 'layout_post_archive',
  'default'     => 'excerpt',
  'priority'    => 10,
  'choices'     => array(
    'excerpt'   => esc_html__( 'Excerpt', 'authentic' ),
    'content'   => esc_html__( 'Full', 'authentic' ),
  ),
  'active_callback' => array(
    array(
      array(
        'setting'  => 'authentic_layout_archive',
        'operator' => '==',
        'value'    => 'standard',
      ),
      array(
        'setting'  => 'authentic_layout_first_post',
        'operator' => '==',
        'value'    => true,
      ),
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'number',
  'settings'    => 'authentic_excerpt_length',
  'label'       => esc_html__( 'Excerpt Length', 'authentic' ),
  'description' => esc_html__( 'Number of words in excerpt.', 'authentic' ),
  'section'     => 'layout_post_archive',
  'priority'    => 10,
  'default'     => 30,
));


/**
 * Layout > Post Meta
 */

Kirki::add_section( 'layout_post_meta', array(
  'title'          => esc_html__( 'Post Meta', 'authentic' ),
  'priority'       => 15,
  'panel'          => 'layout'
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_meta_date',
  'label'       => esc_html__( 'Date', 'authentic' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_meta_comments',
  'label'       => esc_html__( 'Comments Number', 'authentic' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_meta_category',
  'label'       => esc_html__( 'Category', 'authentic' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_meta_reading_time',
  'label'       => esc_html__( 'Reading Time', 'authentic' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_meta_views',
  'label'       => esc_html__( 'Number of Views', 'authentic' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_meta_author',
  'label'       => esc_html__( 'Author', 'authentic' ),
  'section'     => 'layout_post_meta',
  'default'     => true,
  'priority'    => 10,
));

/**
 * Home
 */

Kirki::add_section( 'home', array(
  'title'          => esc_html__( 'Home', 'authentic' ),
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_home_featured',
  'label'       => esc_html__( 'Show Featured Posts Slider', 'authentic' ),
  'section'     => 'home',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'select',
  'settings'    => 'authentic_home_featured_type',
  'label'       => esc_html__( 'Slider Type', 'authentic' ),
  'section'     => 'home',
  'default'     => 'center',
  'priority'    => 10,
  'choices'     => array(
    'center'    => esc_html__('Center', 'authentic'),
    'large'     => esc_html__('Large', 'authentic'),
    'boxed'     => esc_html__('Boxed', 'authentic'),
    'multiple'  => esc_html__('Multiple', 'authentic'),
  ),
  'active_callback' => array(
    array(
      'setting'  => 'authentic_home_featured',
      'operator' => '==',
      'value'    => true,
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'select',
  'settings'    => 'authentic_home_featured_visible_slides_number',
  'label'       => esc_html__( 'Number of Visible Slides', 'authentic' ),
  'section'     => 'home',
  'default'     => '3',
  'priority'    => 10,
  'choices'     => array(
    '2'  => '2',
    '3'  => '3',
    '4'  => '4',
  ),
  'active_callback' => array(
    array(
      'setting'  => 'authentic_home_featured',
      'operator' => '==',
      'value'    => true,
    ),
    array(
      'setting'  => 'authentic_home_featured_type',
      'operator' => '==',
      'value'    => 'multiple',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'number',
  'settings'    => 'authentic_home_featured_slides_number',
  'label'       => esc_html__( 'Number of Slides', 'authentic' ),
  'section'     => 'home',
  'default'     => 3,
  'active_callback' => array(
    array(
      'setting'  => 'authentic_home_featured',
      'operator' => '==',
      'value'    => true,
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'authentic_home_featured_width',
  'label'       => esc_html__( 'Slider Width', 'authentic' ),
  'description' => esc_html__( 'Recommended width: 1560px for a wide slider and 1100px for a narrow one.', 'authentic' ),
  'section'     => 'home',
  'default'     => '1100px',
  'active_callback' => array(
    array(
      'setting'  => 'authentic_home_featured',
      'operator' => '==',
      'value'    => true,
    ),
    array(
      array(
        'setting'  => 'authentic_home_featured_type',
        'operator' => '==',
        'value'    => 'boxed',
      ),
      array(
        'setting'  => 'authentic_home_featured_type',
        'operator' => '==',
        'value'    => 'center',
      )
    ),
  ),
  'output' => array(
    array(
      'element'     => '.owl-center .owl-slide',
      'property'    => 'width',
      'media_query' => '@media (min-width: 1200px)'
    ),
    array(
      'element'     => '.owl-boxed',
      'property'    => 'max-width',
      'media_query' => '@media (min-width: 1200px)'
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'authentic_home_featured_height',
  'label'       => esc_html__( 'Slider Height', 'authentic' ),
  'description' => esc_html__( 'Recommended height: 600px.', 'authentic' ),
  'section'     => 'home',
  'default'     => '600px',
  'active_callback' => array(
    array(
      'setting'  => 'authentic_home_featured',
      'operator' => '==',
      'value'    => true,
    ),
    array(
      'setting'  => 'authentic_home_featured_type',
      'operator' => '!==',
      'value'    => 'large',
    ),
  ),
  'output' => array(
    array(
      'element'     => '.owl-featured .owl-slide .overlay-container',
      'property'    => 'height',
      'media_query' => '@media (min-width: 992px)'
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'select',
  'settings'    => 'authentic_home_featured_image_size',
  'label'       => esc_html__( 'Slider Image Size', 'authentic' ),
  'description' => esc_html__( 'For detailed image sizes please see "Media" section in theme documentation.', 'authentic' ),
  'section'     => 'home',
  'default'     => 'hd',
  'priority'    => 10,
  'choices'     => array(
    'large'     => esc_html__('Large', 'authentic'),
    'medium'    => esc_html__('Medium', 'authentic'),
    'hd'        => esc_html__('HD', 'authentic'),
    'standard'  => esc_html__('Standard', 'authentic'),
    'square'    => esc_html__('Square', 'authentic'),
    'grid'      => esc_html__('Grid', 'authentic'),
    'list'      => esc_html__('List', 'authentic'),
    'masonry'   => esc_html__('Masonry', 'authentic'),
  ),
  'active_callback' => array(
    array(
      'setting'  => 'authentic_home_featured',
      'operator' => '==',
      'value'    => true,
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_home_featured_parallax',
  'label'       => esc_html__( 'Parallax', 'authentic' ),
  'description' => esc_html__( 'Please mind that global Parallax settings defined in Effects are applied.', 'authentic' ),
  'section'     => 'home',
  'default'     => true,
  'priority'    => 10,
  'active_callback' => array(
    array(
      'setting'  => 'authentic_home_featured',
      'operator' => '==',
      'value'    => true,
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_home_featured_heading',
  'label'       => esc_html__( 'Featured Slider Heading', 'authentic' ),
  'section'     => 'home',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => '700',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '3rem',
    'line-height'    => $line_height_headings,
    'letter-spacing' => '-.2rem',
    'text-transform' => 'none',
  ),
  'priority'    => 10,
  'active_callback' => array(
    array(
      'setting'  => 'authentic_home_featured',
      'operator' => '==',
      'value'    => true,
    ),
  ),
  'output'      => array(
    array(
      'element' => '.owl-featured h2',
      'media_query' => '@media (min-width: 992px)'
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_home_trending',
  'label'       => esc_html__( 'Show Trending Posts', 'authentic' ),
  'section'     => 'home',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'authentic_home_trending_time_frame',
  'label'       => esc_html__( 'Trending Posts Period', 'authentic' ),
  'description' => esc_html__( 'Input period of trending posts in English, i.e. &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'authentic' ),
  'section'     => 'home',
  'default'     => '3 months',
  'priority'    => 10,
  'active_callback' => array(
    array(
      'setting'  => 'authentic_home_trending',
      'operator' => '==',
      'value'    => true,
    ),
  ),
));

/**
 * Header
 */

Kirki::add_panel( 'header', array(
  'title'          => esc_html__( 'Header', 'authentic' ),
  'priority'       => 5,
));

/**
 * Header > Logo
 */

Kirki::add_section( 'header_logo', array(
  'title'          => esc_html__( 'Logo', 'authentic' ),
  'panel'          => 'header',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'image',
  'settings'    => 'authentic_header_logo_dark_url',
  'label'       => esc_html__( 'Dark Logo', 'authentic' ),
  'section'     => 'header_logo',
  'default'     => get_template_directory_uri() . '/dist/img/logo-dark.png',
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'image',
  'settings'    => 'authentic_header_logo_light_url',
  'label'       => esc_html__( 'Light Logo', 'authentic' ),
  'section'     => 'header_logo',
  'default'     => get_template_directory_uri() . '/dist/img/logo-light.png',
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'authentic_header_logo_width',
  'label'       => esc_html__( 'Logo Width', 'authentic' ),
  'description' => esc_html__( 'Input logo width in pixels. Please note, that the size of the image must be 2x to look sharp on Retina screens.', 'authentic' ),
  'section'     => 'header_logo',
  'default'     => '200px',
  'output' => array(
    array(
      'element'  => '.header-logo img',
      'property' => 'width',
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'authentic_header_height',
  'label'       => esc_html__( 'Header Height', 'authentic' ),
  'description' => esc_html__( 'Input height in pixels.', 'authentic' ),
  'section'     => 'header_logo',
  'default'     => '100px',
  'output' => array(
    array(
      'element'  => '.header-content',
      'property' => 'height',
    )
  ),
));

/**
 * Header > Navigation Bar
 */

Kirki::add_section( 'header_navbar', array(
  'title'          => esc_html__( 'Navigation Bar', 'authentic' ),
  'panel'          => 'header',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'select',
  'settings'    => 'authentic_navbar_logo_select',
  'label'       => esc_html__( 'Logo', 'authentic' ),
  'section'     => 'header_navbar',
  'default'     => 'image',
  'priority'    => 10,
  'choices'     => array(
    'image'     => esc_html__( 'Image', 'authentic' ),
    'text'      => esc_html__( 'Text', 'authentic' ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'image',
  'settings'    => 'authentic_navbar_logo_dark_url',
  'label'       => esc_html__( 'Dark Logo Image', 'authentic' ),
  'section'     => 'header_navbar',
  'default'     => get_template_directory_uri() . '/dist/img/logo-navbar-dark.png',
  'priority'    => 10,
  'active_callback' => array(
    array(
      'setting'  => 'authentic_navbar_logo_select',
      'operator' => '==',
      'value'    => 'image',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'image',
  'settings'    => 'authentic_navbar_logo_light_url',
  'label'       => esc_html__( 'Light Logo Image', 'authentic' ),
  'section'     => 'header_navbar',
  'default'     => get_template_directory_uri() . '/dist/img/logo-navbar-light.png',
  'priority'    => 10,
  'active_callback' => array(
    array(
      'setting'  => 'authentic_navbar_logo_select',
      'operator' => '==',
      'value'    => 'image',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'authentic_navbar_logo_height',
  'label'       => esc_html__( 'Logo Height', 'authentic' ),
  'description' => esc_html__( 'Input logo height in pixels. Please note, that the size of the image must be 2x to look sharp on Retina screens. Max recommended height is 40px.', 'authentic' ),
  'section'     => 'header_navbar',
  'default'     => '22px',
  'output' => array(
    array(
      'element'  => '.navbar-brand > img',
      'property' => 'height',
    )
  ),
  'active_callback' => array(
    array(
      'setting'  => 'authentic_navbar_logo_select',
      'operator' => '==',
      'value'    => 'image',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'authentic_navbar_logo_text',
  'label'       => esc_html__( 'Text', 'authentic' ),
  'section'     => 'header_navbar',
  'default'     => get_bloginfo('name'),
  'priority'    => 10,
  'active_callback' => array(
    array(
      'setting'  => 'authentic_navbar_logo_select',
      'operator' => '==',
      'value'    => 'text',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_navbar_logo_font',
  'label'       => esc_html__( 'Font', 'authentic' ),
  'section'     => 'header_navbar',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'variant'        => '700',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '22px',
    'letter-spacing' => '-2px',
    'text-transform' => 'none',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.navbar-brand.navbar-text',
    ),
  ),
  'active_callback' => array(
    array(
      'setting'  => 'authentic_navbar_logo_select',
      'operator' => '==',
      'value'    => 'text',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_header_navbar_main_links_font',
  'label'       => esc_html__( 'Main Links Font', 'authentic' ),
  'section'     => 'header_navbar',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'subsets'        => array( 'latin-ext' ),
    'variant'        => 'regular',
    'font-size'      => '12px',
    'line-height'    => $line_height_base,
    'letter-spacing' => '1px',
    'text-transform' => 'uppercase',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.navbar-primary .navbar-nav > li.menu-item > a, .navbar-search, .widget_nav_menu .menu > li.menu-item > a, .widget_pages .page_item a, .widget_meta li a, select, .widget_categories li, .widget_archive li',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_header_navbar_submenu_links_font',
  'label'       => esc_html__( 'Submenu Links Font', 'authentic' ),
  'section'     => 'header_navbar',
  'default'     => array(
    'font-family'    => $font_family_base,
    'variant'        => 'regular',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '12px',
    'line-height'    => $line_height_base,
    'letter-spacing' => '0',
    'text-transform' => 'uppercase',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.navbar-primary .sub-menu a, .widget_nav_menu .sub-menu a, .widget_categories .children li a',
    ),
  ),
));

/**
 * Header > Top Bar
 */

Kirki::add_section( 'header_topbar', array(
  'title'          => esc_html__( 'Top Bar', 'authentic' ),
  'panel'          => 'header',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_header_topbar',
  'label'       => esc_html__( 'Show Top Bar', 'authentic' ),
  'section'     => 'header_topbar',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_header_topbar_main_links_font',
  'label'       => esc_html__( 'Main Links Font', 'authentic' ),
  'section'     => 'header_topbar',
  'default'     => array(
    'font-family'    => $font_family_base,
    'variant'        => 'regular',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '12px',
    'line-height'    => $line_height_base,
    'letter-spacing' => '1px',
    'text-transform' => 'uppercase',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.navbar-secondary .navbar-nav > li.menu-item > a',
    ),
  ),
  'active_callback' => array(
    array(
      'setting'  => 'authentic_header_topbar',
      'operator' => '==',
      'value'    => true,
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_header_topbar_submenu_links_font',
  'label'       => esc_html__( 'Submenu Links Font', 'authentic' ),
  'section'     => 'header_topbar',
  'default'     => array(
    'font-family'    => $font_family_base,
    'variant'        => 'regular',
    'subsets'        => array( 'latin-ext' ),
    'font-size'      => '12px',
    'line-height'    => $line_height_base,
    'letter-spacing' => '0',
    'text-transform' => 'uppercase',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.navbar-secondary .sub-menu a',
    ),
  ),
  'active_callback' => array(
    array(
      'setting'  => 'authentic_header_topbar',
      'operator' => '==',
      'value'    => true,
    )
  ),
));

/**
 * Header > Miscellaneous
 */

Kirki::add_section( 'header_misc', array(
  'title'          => esc_html__( 'Miscellaneous', 'authentic' ),
  'panel'          => 'header',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_header_subscribe_button',
  'label'       => esc_html__( 'Show Subscribe Button', 'authentic' ),
  'description' => esc_html__( 'Requires URL of MailChimp general form to be specified in the Connect section.', 'authentic' ),
  'section'     => 'header_misc',
  'default'     => false,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_header_search_button',
  'label'       => esc_html__( 'Show Search Button', 'authentic' ),
  'section'     => 'header_misc',
  'default'     => true,
  'priority'    => 10,
));

/**
 * Footer
 */

Kirki::add_panel( 'footer', array(
  'title'          => esc_html__( 'Footer', 'authentic' ),
  'priority'       => 5,
));

/**
 * Footer > Colors
 */

Kirki::add_section( 'footer_colors', array(
  'title'          => esc_html__( 'Colors', 'authentic' ),
  'panel'          => 'footer',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'color',
  'settings'    => 'authentic_footer_bg_color',
  'label'       => esc_html__( 'Background Color', 'authentic' ),
  'section'     => 'footer_colors',
  'default'     => '#000000',
  'output' => array(
    array(
      'element'  => '.site-footer',
      'property' => 'background-color',
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'color',
  'settings'    => 'authentic_footer_text_color',
  'label'       => esc_html__( 'Text Color', 'authentic' ),
  'section'     => 'footer_colors',
  'default'     => '#A0A0A0',
  'output' => array(
    array(
      'element'  => '.site-footer',
      'property' => 'color',
    ),
    array(
      'element'  => '.site-footer .owl-dot',
      'property' => 'background-color',
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'color',
  'settings'    => 'authentic_footer_title_color',
  'label'       => esc_html__( 'Title Color', 'authentic' ),
  'section'     => 'footer_colors',
  'default'     => '#777777',
  'output' => array(
    array(
      'element'  => '.site-footer .title-widget',
      'property' => 'color',
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'authentic_footer_link',
  'label'       => esc_html__( 'Link Color', 'authentic' ),
  'section'     => 'footer_colors',
  'priority'    => 10,
  'choices'     => array(
    'default'   => esc_html__( 'Default', 'authentic' ),
    'hover'     => esc_html__( 'Hover', 'authentic' ),
  ),
  'default'     => array(
    'default'   => '#FFFFFF',
    'hover'     => '#A0A0A0',
  ),
  'output'    => array(
    array(
      'choice'    => 'default',
      'element'   => '.site-footer a, .site-footer #wp-calendar thead th, .site-footer .owl-dot.active, .site-footer h2',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.site-footer a:hover, site-footer a:hover:active, .site-footer a:focus:active',
      'property'  => 'color',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'color',
  'settings'    => 'authentic_footer_border_color',
  'label'       => esc_html__( 'Border Color', 'authentic' ),
  'section'     => 'footer_colors',
  'default'     => '#242424',
  'output' => array(
    array(
      'element'  => '.site-footer .title-widget:after, .site-footer .authentic_widget_subscribe .widget-body:before, .site-footer #wp-calendar tfoot tr #prev + .pad:after, .site-footer #wp-calendar tbody td a',
      'property' => 'background-color',
    ),
    array(
      'element'  => '.site-footer .widget, .site-footer .widget_nav_menu .menu > .menu-item:not(:first-child) > a, .site-footer .widget_categories > ul > li:not(:first-child), .site-footer .widget_archive > ul > li:not(:first-child), .site-footer #wp-calendar tbody td, .site-footer .widget_pages li:not(:first-child) a, .site-footer .widget_meta li:not(:first-child) a, .site-footer .widget_recent_comments li:not(:first-child), .site-footer .widget_recent_entries li:not(:first-child), .site-footer .widget.authentic_widget_twitter .twitter-actions, .site-footer #wp-calendar tbody td#today:after, .footer-section + .footer-section > .container > *',
      'property' => 'border-top-color',
    ),
    array(
      'element'  => '.site-footer .widget.authentic_widget_twitter',
      'property' => 'border-color',
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'authentic_btn_footer_text_color',
  'label'       => esc_html__( 'Button Text Color', 'authentic' ),
  'section'     => 'footer_colors',
  'priority'    => 10,
  'choices'     => array(
    'default'   => esc_html__( 'Default', 'authentic' ),
    'hover'     => esc_html__( 'Hover', 'authentic' ),
  ),
  'default'     => array(
    'default'   => '#A0A0A0',
    'hover'     => '#FFFFFF',
  ),
  'output'    => array(
    array(
      'choice'    => 'default',
      'element'   => '.site-footer .btn',
      'property'  => 'color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.site-footer .btn:hover, .site-footer .btn:active, .site-footer .btn:focus, .site-footer .btn:active:focus, .site-footer .btn:active:hover',
      'property'  => 'color',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'multicolor',
  'settings'    => 'authentic_btn_footer_bg_color',
  'label'       => esc_html__( 'Button Background Color', 'authentic' ),
  'section'     => 'footer_colors',
  'priority'    => 10,
  'choices'     => array(
    'default'   => esc_html__( 'Default', 'authentic' ),
    'hover'     => esc_html__( 'Hover', 'authentic' ),
  ),
  'default'     => array(
    'default'   => '#242424',
    'hover'     => '#141414',
  ),
  'output'    => array(
    array(
      'choice'    => 'default',
      'element'   => '.site-footer .btn, .site-footer select, .site-footer .authentic_widget_posts .numbered .post-number',
      'property'  => 'background-color',
    ),
    array(
      'choice'    => 'hover',
      'element'   => '.site-footer .btn:hover, .site-footer .btn:active, .site-footer .btn:focus, .site-footer .btn:active:focus, .site-footer .btn:active:hover',
      'property'  => 'background-color',
    ),
  ),
));

/**
 * Footer > Logo & Navbar
 */

Kirki::add_section( 'footer_logo_navbar', array(
  'title'          => esc_html__( 'Logo & Navbar', 'authentic' ),
  'panel'          => 'footer',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'typography',
  'settings'    => 'authentic_footer_navbar_links_font',
  'label'       => esc_html__( 'Navbar Links Font', 'authentic' ),
  'section'     => 'footer_logo_navbar',
  'default'     => array(
    'font-family'    => $font_family_headings,
    'subsets'        => array( 'latin-ext' ),
    'variant'        => 'regular',
    'font-size'      => '12px',
    'line-height'    => $line_height_base,
    'letter-spacing' => '1px',
    'text-transform' => 'uppercase',
  ),
  'priority'    => 10,
  'output'      => array(
    array(
      'element' => '.navbar-footer .navbar-nav > li.menu-item > a',
    ),
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'image',
  'settings'    => 'authentic_footer_logo_url',
  'label'       => esc_html__( 'Logo', 'authentic' ),
  'section'     => 'footer_logo_navbar',
  'default'     => get_template_directory_uri() . '/dist/img/logo-footer.png',
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'dimension',
  'settings'    => 'authentic_footer_logo_width',
  'label'       => esc_html__( 'Logo Width', 'authentic' ),
  'description' => esc_html__( 'Input logo width in pixels. Please note, that the size of the image must be 2x to look sharp on Retina screens.', 'authentic' ),
  'section'     => 'footer_logo_navbar',
  'default'     => '160px',
  'output' => array(
    array(
      'element'  => '.footer-logo',
      'property' => 'max-width',
    )
  ),
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'authentic_footer_text',
  'label'       => esc_html__( 'Footer Text', 'authentic' ),
  'section'     => 'footer_logo_navbar',
  'default'     => get_bloginfo('description'),
  'priority'    => 10,
));

/**
 * Footer > Subscribe
 */

Kirki::add_section( 'footer_subscribe', array(
  'title'          => esc_html__( 'Subscribe', 'authentic' ),
  'description'    => esc_html__( 'Please make sure that MailChimp Embedded Form URL is filled in the Connect section.', 'authentic' ),
  'panel'          => 'footer',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'authentic_subscribe_title',
  'label'       => esc_html__( 'Subscribe Title', 'authentic' ),
  'section'     => 'footer_subscribe',
  'default'     => esc_html__('Subscribe','authentic'),
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'authentic_subscribe_message',
  'label'       => esc_html__( 'Subscribe Message', 'authentic' ),
  'section'     => 'footer_subscribe',
  'default'     => esc_html__('Subscribe now to our newsletter','authentic'),
  'priority'    => 10,
));

/**
 * Footer > Instagram
 */

Kirki::add_section( 'footer_instagram', array(
  'title'          => esc_html__( 'Instagram', 'authentic' ),
  'panel'          => 'footer',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'text',
  'settings'    => 'authentic_footer_instagram_username',
  'label'       => esc_html__( 'Instagram Username', 'authentic' ),
  'section'     => 'footer_instagram',
  'default'     => '',
  'priority'    => 10,
));

/**
 * Footer > Arrangement
 */

Kirki::add_section( 'footer_arrangement', array(
  'title'          => esc_html__( 'Arrangement', 'authentic' ),
  'panel'          => 'footer',
  'priority'       => 5,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'sortable',
  'settings'    => 'authentic_footer_arrangement',
  'label'       => esc_html__( 'Content Arrangement', 'authentic' ),
  'section'     => 'footer_arrangement',
  'default'     => array(
    'instagram',
    'subscribe',
    'widgets',
    'logo',
  ),
  'choices'     => array(
    'instagram' => esc_attr__( 'Instagram', 'authentic' ),
    'subscribe' => esc_attr__( 'Subscribe', 'authentic' ),
    'widgets' => esc_attr__( 'Widgets', 'authentic' ),
    'logo' => esc_attr__( 'Logo &amp; Navbar', 'authentic' ),
  ),
  'priority'    => 10,
));

/**
 * Effects
 */

Kirki::add_section( 'effects', array(
  'title'          => esc_html__( 'Effects', 'authentic' ),
  'priority'       => 15,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_effects_parallax',
  'label'       => esc_html__( 'Parallax', 'authentic' ),
  'section'     => 'effects',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_effects_lazy_load',
  'label'       => esc_html__( 'Posts Lazy Load', 'authentic' ),
  'section'     => 'effects',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_effects_navbar_scroll',
  'label'       => esc_html__( 'Navbar Scroll', 'authentic' ),
  'section'     => 'effects',
  'default'     => true,
  'priority'    => 10,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_effects_sticky_sidebar',
  'label'       => esc_html__( 'Sticky Sidebar', 'authentic' ),
  'section'     => 'effects',
  'default'     => true,
  'priority'    => 10,
));

/**
 * Connect
 */

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'toggle',
  'settings'    => 'authentic_pin_it',
  'label'       => esc_html__( 'Pin It Buttons on Images', 'authentic' ),
  'section'     => 'connect',
  'default'     => false,
  'priority'    => 10,
));

/**
 * Custom CSS
 */

Kirki::add_section( 'custom_css', array(
  'title'          => esc_html__( 'Custom CSS', 'authentic' ),
  'priority'       => 200,
));

Kirki::add_field( 'authentic_theme_mod', array(
  'type'        => 'code',
  'settings'    => 'authentic_custom_css',
  'label'       => esc_html__( 'Custom CSS Code', 'authentic' ),
  'section'     => 'custom_css',
  'default'     => '',
  'priority'    => 10,
  'choices'     => array(
    'language' => 'css',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));
