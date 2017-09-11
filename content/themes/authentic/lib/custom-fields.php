<?php

/**
 * ACF Pro Custom Fields
 */

if( function_exists('acf_add_local_field_group') ) {

// Post Format: Gallery

acf_add_local_field_group(array (
  'key' => 'group_post_gallery',
  'title' => esc_html__('Gallery','authentic'),
  'fields' => array (
    array (
      'key' => 'field_post_gallery',
      'label' => esc_html__('Images','authentic'),
      'name' => 'csco_post_gallery',
      'type' => 'gallery',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'min' => '',
      'max' => '',
      'preview_size' => 'thumbnail',
      'library' => 'all',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
      array (
        'param' => 'post_format',
        'operator' => '==',
        'value' => 'gallery',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'acf_after_title',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

// Post Format: Video

acf_add_local_field_group(array (
  'key' => 'group_post_embed',
  'title' => esc_html__('Embed','authentic'),
  'fields' => array (
    array (
      'key' => 'field_post_embed',
      'label' => esc_html__('Embed','authentic'),
      'name' => 'csco_post_embed',
      'type' => 'oembed',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'width' => '',
      'height' => '',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
      array (
        'param' => 'post_format',
        'operator' => '==',
        'value' => 'audio',
      ),
    ),
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
      array (
        'param' => 'post_format',
        'operator' => '==',
        'value' => 'video',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'acf_after_title',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

// Post: Media

acf_add_local_field_group(array (
  'key' => 'group_post_media_options',
  'title' => esc_html__('Media Options','authentic'),
  'fields' => array (
    array (
      'key' => 'field_post_media_location',
      'label' => esc_html__('Media Location','authentic'),
      'name' => 'csco_post_media_location',
      'type' => 'select',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array (
        'content' => esc_html__('Post Content','authentic'),
        'header' => esc_html__('Post Header','authentic'),
      ),
      'default_value' => array (
        0 => 'content',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'placeholder' => '',
      'disabled' => 0,
      'readonly' => 0,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
      array (
        'param' => 'post_format',
        'operator' => '!=',
        'value' => 'standard',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'side',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

// Post: Options

acf_add_local_field_group(array (
  'key' => 'group_post_options',
  'title' => esc_html__('Featured Post','authentic'),
  'fields' => array (
    array (
      'key' => 'field_post_featured',
      'label' => esc_html__('Featured Post Location','authentic'),
      'name' => 'csco_post_featured',
      'type' => 'checkbox',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array (
        'home' => esc_html__('Home Slider','authentic'),
        'widget' => esc_html__('Posts Widget','authentic'),
        'loop' => esc_html__('Post Archives','authentic'),
      ),
      'default_value' => array (
      ),
      'layout' => 'vertical',
      'toggle' => 0,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'side',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

// Post: Gallery Options

acf_add_local_field_group(array (
  'key' => 'group_post_gallery_options',
  'title' => 'Gallery Options',
  'fields' => array (
    array (
      'key' => 'field_post_gallery_type',
      'label' => esc_html__('Gallery Type','authentic'),
      'name' => 'csco_post_gallery_type',
      'type' => 'select',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array (
        'slider' => esc_html__('Slider','authentic'),
        'justified' => esc_html__('Justified','authentic'),
      ),
      'default_value' => array (
        0 => 'slider',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'placeholder' => '',
      'disabled' => 0,
      'readonly' => 0,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
      array (
        'param' => 'post_format',
        'operator' => '==',
        'value' => 'gallery',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'side',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

// Post & Page: Featured Image

acf_add_local_field_group(array (
  'key' => 'group_featured_image_options',
  'title' => esc_html__('Featured Image Options','authentic'),
  'fields' => array (
    array (
      'key' => 'field_featured_image_type',
      'label' => esc_html__('Featured Image Type','authentic'),
      'name' => 'csco_featured_image_type',
      'type' => 'select',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array (
        'default'  => esc_html__('Default','authentic'),
        'none'     => esc_html__('None','authentic'),
        'standard' => esc_html__('Standard','authentic'),
        'wide'     => esc_html__('Wide','authentic'),
        'large'    => esc_html__('Large','authentic'),
      ),
      'default_value' => array (
        0 => 'default',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'placeholder' => '',
      'disabled' => 0,
      'readonly' => 0,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
    ),
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'page',
      ),
    ),
  ),
  'menu_order' => 10,
  'position' => 'side',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

// Post & Page: Layout

acf_add_local_field_group(array (
  'key' => 'group_singular_layout_options',
  'title' => esc_html__('Layout Options','authentic'),
  'fields' => array (
    array (
      'key' => 'field_singular_layout_page',
      'label' => esc_html__('Sidebar','authentic'),
      'name' => 'csco_singular_layout_page',
      'type' => 'select',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array (
        'default' => esc_html__('Default','authentic'),
        'layout-sidebar-left' => esc_html__('Left Sidebar','authentic'),
        'layout-sidebar-right' => esc_html__('Right Sidebar','authentic'),
        'layout-fullwidth' => esc_html__('Fullwidth','authentic'),
      ),
      'default_value' => array (
        0 => 'default',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'placeholder' => '',
      'disabled' => 0,
      'readonly' => 0,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
    ),
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'page',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'side',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

// Category

acf_add_local_field_group(array (
  'key' => 'group_category_options',
  'title' => esc_html__('Category Options','authentic'),
  'fields' => array (
    array (
      'key' => 'field_category_thumbnail',
      'label' => esc_html__('Image','authentic'),
      'name' => 'csco_category_thumbnail',
      'type' => 'image',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'id',
      'preview_size' => 'thumbnail',
      'library' => 'all',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
    array (
      'key' => 'field_category_layout_archive',
      'label' => esc_html__('Post Archive Layout','authentic'),
      'name' => 'csco_category_layout_archive',
      'type' => 'select',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array (
        'default'   => esc_html__('Default','authentic'),
        'standard' => esc_html__('Standard','authentic'),
        'list'     => esc_html__('List','authentic'),
        'grid'     => esc_html__('Grid','authentic'),
        'masonry'  => esc_html__('Masonry','authentic'),
      ),
      'default_value' => array (
        0 => 'default',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'placeholder' => '',
      'disabled' => 0,
      'readonly' => 0,
    ),
    array (
      'key' => 'field_category_layout_post_summary',
      'label' => esc_html__('Show Post Summary','authentic'),
      'name' => 'csco_category_layout_post_summary',
      'type' => 'select',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array (
        'default' => esc_html__('Default','authentic'),
        true => esc_html__('Show','authentic'),
        false => esc_html__('Don\'t show','authentic'),
      ),
      'default_value' => array (
        0 => 'default',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'placeholder' => '',
      'disabled' => 0,
      'readonly' => 0,
    ),
    array (
      'key' => 'field_category_layout_archive_columns',
      'label' => esc_html__('Number of Columns','authentic'),
      'name' => 'csco_category_layout_archive_columns',
      'type' => 'select',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => array (
        array (
          array (
            'field' => 'field_category_layout_archive',
            'operator' => '==',
            'value' => 'grid',
          ),
        ),
        array (
          array (
            'field' => 'field_category_layout_archive',
            'operator' => '==',
            'value' => 'masonry',
          ),
        ),
      ),
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array (
        'default' => esc_html__('Default','authentic'),
        '2' => '2',
        '3' => '3',
      ),
      'default_value' => array (
        0 => 'default',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'placeholder' => '',
      'disabled' => 0,
      'readonly' => 0,
    ),
    array (
      'key' => 'field_category_layout_first_post',
      'label' => esc_html__('First Post','authentic'),
      'name' => 'csco_category_layout_first_post',
      'type' => 'select',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => array (
        array (
          array (
            'field' => 'field_category_layout_archive',
            'operator' => '==',
            'value' => 'grid',
          ),
        ),
        array (
          array (
            'field' => 'field_category_layout_archive',
            'operator' => '==',
            'value' => 'masonry',
          ),
        ),
        array (
          array (
            'field' => 'field_category_layout_archive',
            'operator' => '==',
            'value' => 'list',
          ),
        ),
      ),
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array (
        'default' => esc_html__('Default','authentic'),
        false => esc_html__('Normal','authentic'),
        true => esc_html__('Standard','authentic'),
      ),
      'default_value' => array (
        0 => 'default',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'placeholder' => '',
      'disabled' => 0,
      'readonly' => 0,
    ),
    array (
      'key' => 'field_category_layout_page',
      'label' => esc_html__('Layout','authentic'),
      'name' => 'csco_category_layout_page',
      'type' => 'select',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array (
        'default' => esc_html__('Default','authentic'),
        'layout-sidebar-left' => esc_html__('Left Sidebar','authentic'),
        'layout-sidebar-right' => esc_html__('Right Sidebar','authentic'),
        'layout-fullwidth' => esc_html__('Fullwidth','authentic'),
      ),
      'default_value' => array (
        0 => 'default',
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'placeholder' => '',
      'disabled' => 0,
      'readonly' => 0,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'taxonomy',
        'operator' => '==',
        'value' => 'category',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

}
