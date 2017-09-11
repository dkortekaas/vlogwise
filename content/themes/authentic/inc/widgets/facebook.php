<?php

/**
 * Facebook Page Widget
 */

class authentic_widget_facebook extends WP_Widget {

  public function __construct() {
    $widget_details = array(
      'classname' => 'authentic_widget_facebook',
      'description' => esc_html__( 'Display Facebook Page Widget.', 'authentic' )
    );
    parent::__construct( 'authentic_widget_facebook', esc_html__( 'Authentic: Facebook', 'authentic' ), $widget_details );
  }

  public function widget( $args, $instance ) {

    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Facebook', 'authentic' );

    /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    echo $args['before_widget'];

    if ( $title ) {
      echo $args['before_title'] . $title . $args['after_title'];
    }

    $widget_id  = $args['widget_id'];
    $href       = _get_field('href','widget_' . $widget_id);
    $params     = _get_field('params','widget_' . $widget_id);

    if($params) {
      if( in_array('hide-cover', $params) ) {
        $hide_cover = true;
      }
      if( in_array('show-facepile', $params) ) {
        $show_facepile = true;
      }
      if( in_array('show-posts', $params) ) {
        $show_posts = true;
      }
      if( in_array('small-header', $params) ) {
        $small_header = true;
      }
    }

    $facebook_params = array(
      'href'          => $href,
      'hide-cover'    => ( isset($hide_cover) && $hide_cover == true ) ? 'true' : 'false',
      'show-facepile' => ( isset($show_facepile) && $show_facepile == true ) ? 'true' : 'false',
      'show-posts'    => ( isset($show_posts) && $show_posts == true ) ? 'true' : 'false',
      'small-header'  => ( isset($small_header) && $small_header == true ) ? 'true' : 'false',
      'adapt-container-width' => 'true'
    );

    $facebook_atts = array();
    foreach( $facebook_params as $k => $v ) {
      $facebook_atts[] = ' data-'. sanitize_key( $k ) .'="'. esc_attr( $v ) .'"';
    }

    echo '<div class="fb-page-wrapper"><div class="fb-page"'. implode( $facebook_atts ) .'></div></div>';

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
    'key' => 'group_widget_facebook',
    'title' => esc_html__('Facebook Widget','authentic'),
    'fields' => array (
      array (
        'key' => 'field_facebook_href',
        'label' => esc_html__('Facebook Page URL','authentic'),
        'name' => 'href',
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
        'key' => 'field_facebook_params',
        'label' => esc_html__('Display Options','authentic'),
        'name' => 'params',
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
          'hide-cover' => esc_html__('Hide Cover','authentic'),
          'show-facepile' => esc_html__('Show Facepile','authentic'),
          'show-posts' => esc_html__('Show Posts','authentic'),
          'small-header' => esc_html__('Small Header','authentic'),
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
          'param' => 'widget',
          'operator' => '==',
          'value' => 'authentic_widget_facebook',
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
