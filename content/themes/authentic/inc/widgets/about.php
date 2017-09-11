<?php

/**
 * Posts List
 */

class authentic_widget_about extends WP_Widget {

  public function __construct() {
    $widget_details = array(
      'classname' => 'authentic_widget_about',
      'description' => esc_html__( 'Display Image, Text and Social Accounts.', 'authentic' )
    );
    parent::__construct( 'authentic_widget_about', esc_html__( 'Authentic: About', 'authentic' ), $widget_details );
  }

  public function widget( $args, $instance ) {

    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'About us', 'authentic' );

    /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    echo $args['before_widget'];

    $widget_id            = $args['widget_id'];

    $subtitle             = _get_field('subtitle','widget_' . $widget_id);
    $image                = _get_field('image','widget_' . $widget_id);
    $text                 = _get_field('text','widget_' . $widget_id);
    $button_url           = _get_field('button_url','widget_' . $widget_id);
    $button_text          = _get_field('button_text','widget_' . $widget_id);
    $show_social_accounts = _get_field('social_accounts','widget_' . $widget_id);

    $social_accounts      = get_option('csco_social_accounts');

    if ($image) {
      echo wp_get_attachment_image( $image, 'thumbnail' );
    }

    if ( $title ) {
      echo $args['before_title'] . $title . $args['after_title'];
    }

    if ($subtitle) { ?>
    <p class="widget-about-lead"><?php echo $subtitle; ?></p>
    <?php } ?>

    <?php if ($text) { ?>
      <div class="widget-about-content">
        <?php echo $text; ?>
      </div>
    <?php } ?>

    <?php if ((!empty($button_url) && !empty($button_text)) || (is_array($social_accounts))) { ?>

      <div class="widget-about-footer">

        <?php if (!empty($button_url) && !empty($button_text)) { ?>
          <a href="<?php echo $button_url; ?>" class="btn btn-secondary btn-effect">
            <span><?php echo $button_text; ?></span>
            <span><i class="icon icon-arrow-right"></i></span>
          </a>
        <?php } ?>

        <?php if ($show_social_accounts == true && is_array($social_accounts)) { ?>
          <div class="social-accounts">
            <ul>
              <?php the_icon_list($social_accounts, 'li') ; ?>
            </ul>
          </div>
        <?php } ?>

      </div>

    <?php }

    echo $args['after_widget'];

  }

  public function form( $instance ) {

    $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

    ?>

    <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'authentic' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

    <?php

    // Main fields are handled by ACF Pro
  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    return $instance;
  }
}

if( function_exists('acf_add_local_field_group') ) {

acf_add_local_field_group(array (
  'key' => 'group_widget_about',
  'title' => esc_html__('About Widget','authentic'),
  'fields' => array (
    array (
      'key' => 'field_about_subtitle',
      'label' => esc_html__('Subtitle','authentic'),
      'name' => 'subtitle',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'readonly' => 0,
      'disabled' => 0,
    ),
    array (
      'key' => 'field_about_image',
      'label' => esc_html__('Image','authentic'),
      'name' => 'image',
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
      'preview_size' => 'mini',
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
      'key' => 'field_about_text',
      'label' => esc_html__('Text','authentic'),
      'name' => 'text',
      'type' => 'wysiwyg',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'tabs' => 'all',
      'toolbar' => 'basic',
      'media_upload' => 0,
    ),
    array (
      'key' => 'field_about_button_url',
      'label' => esc_html__('Button URL','authentic'),
      'name' => 'button_url',
      'type' => 'url',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
    ),
    array (
      'key' => 'field_about_button_text',
      'label' => esc_html__('Button Text','authentic'),
      'name' => 'button_text',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'readonly' => 0,
      'disabled' => 0,
    ),
    array (
      'key' => 'field_about_social',
      'label' => esc_html__('Social Accounts','authentic'),
      'name' => 'social_accounts',
      'type' => 'true_false',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'message' => esc_html__('Display list of social accounts','authentic'),
      'default_value' => 0,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'widget',
        'operator' => '==',
        'value' => 'authentic_widget_about',
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
