<?php

add_filter( 'post_gallery', 'authentic_post_gallery', 10, 3 );

function authentic_post_gallery( $output = '', $atts, $instance ) {

  $post = get_post();

  $default = array(
    'id'         => $post ? $post->ID : 0,
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'columns'    => 3,
    'size'       => 'thumbnail',
  );

  $atts = array_merge($default, $atts);

  $id = intval( $atts['id'] );

  if ( ! empty( $atts['include'] ) ) {
    $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif ( ! empty( $atts['exclude'] ) ) {
    $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
  } else {
    $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
  }

  if ( empty( $attachments ) ) {
    return '';
  }

  $selector = "gallery-{$instance}";

  if (isset($atts['layout'])) {

    $layout = $atts['layout'];

    // Justified

    if ($layout == 'justified') {

      $output = '<div class="gallery gallery-justified">';

      foreach ( $attachments as $id => $attachment ) {

        $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
        if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
          $image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
        } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
          $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
        } else {
          $image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
        }

        $output .= "<figure>";
        $output .= $image_output;
        $output .= "</figure>";
      }

      $output .= "</div>";

    }

    // Slider

    elseif ($layout == 'slider') {

      $output = '<div class="gallery gallery-slider owl-container owl-simple">';
      $output .= '<div class="owl-carousel">';

      foreach ( $attachments as $id => $attachment ) {

        $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
        if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
          $image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
        } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
          $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
        } else {
          $image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
        }

        $output .= "<div class='owl-slide'>";
        $output .= "<figure>";
        $output .= $image_output;
        $output .= "</figure>";
        $output .= "</div>";
      }

      $output .= "</div>";

      $output .= '<div class="owl-dots"></div>';

      $output .= "</div>";

    }

  } else {

    // Grid

    $columns = $atts['columns'];

    // Callback for sizes not supported by Bootstrap grid

    if     ($columns == 5) { $columns = 4;}
    elseif ($columns == 7) { $columns = 6; }
    elseif ($columns == 8) { $columns = 6; }
    elseif ($columns == 9) { $columns = 12; }

    $i = 0;

    $output = '<div class="gallery gallery-grid">';
    $output .= '<div class="row">';

    foreach ( $attachments as $id => $attachment ) {

      $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
      if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
        $image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
      } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
        $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
      } else {
        $image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
      }

      $output .= "<div class='gallery-item col-md-" . 12 / $columns . "'>";
      $output .= "<figure>";
      $output .= $image_output;
      if ( trim($attachment->post_excerpt) ) {
        $output .= "
          <figcaption class='wp-caption-text gallery-caption' id='$selector-$id'>
          " . wptexturize($attachment->post_excerpt) . "
          </figcaption>";
      }
      $output .= "</figure>";
      $output .= "</div>";

      $current = ++$i;

      if ( $columns > 0 && $current % $columns == 0 && $current !== count($attachments)) {
        $output .= '</div><div class="row">';
      }

      if ($current == count($attachments)) {
        $output .= '</div>';
      }

    }

    $output .= "</div>";

  }

  return $output;
}

/**
 * Add new sizes to sizes dropdown
 */

add_filter( 'image_size_names_choose', 'authentic_image_sizes_choose' );

function authentic_image_sizes_choose( $sizes ) {
  $addsizes = array(
    'standard' => esc_html__('Large Thumbnail','authentic'),
    'square' => esc_html__('Square Thumbnail','authentic'),
    'grid' => esc_html__('Horizontal Thumbnail','authentic'),
    'list' => esc_html__('Vertical Thumbnail','authentic'),
  );
  $newsizes = array_merge($sizes, $addsizes);
  return $newsizes;
}

/**
 * Add Gallery Layout Dropdown
 */

add_action('print_media_templates', 'authentic_gallery_dropdown');

function authentic_gallery_dropdown() {

  // define your backbone template;
  // the "tmpl-" prefix is required,
  // and your input field should have a data-setting attribute
  // matching the shortcode name
  $gallery_layouts = array(
    'grid'      => esc_html__('Grid','authentic'),
    'justified' => esc_html__('Justified','authentic'),
    'slider'    => esc_html__('Slider','authentic')
  );
  ?>
  <script type="text/html" id="tmpl-custom-gallery-layouts">
    <label class="setting">
      <span><?php esc_html_e('Layout','authentic'); ?></span>
      <select data-setting="layout"><?php
        foreach($gallery_layouts as $key => $value) {
          echo "<option value=\"$key\">$value</option>";
        }
        ?>
      </select>
    </label>
  </script>

  <script>

    jQuery(document).ready(function () {

      // add your shortcode attribute and its default value to the
      // gallery settings list; $.extend should work as well...
      _.extend(wp.media.gallery.defaults, {
        layout: 'grid'
      });

      // join default gallery settings template with yours -- store in list
      if (!wp.media.gallery.templates) wp.media.gallery.templates = ['gallery-settings'];
      wp.media.gallery.templates.push('custom-gallery-layouts');

      // loop through list -- allowing for other templates/settings
      wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
        template: function (view) {
          var output = '';
          for (var i in wp.media.gallery.templates) {
            output += wp.media.template(wp.media.gallery.templates[i])(view);
          }
          return output;
        }
      });

    });

  </script>
  <?php
}
