<?php

/**
 * Posts List
 */

class authentic_widget_subscribe extends WP_Widget {

  public function __construct() {
    $widget_details = array(
      'classname' => 'authentic_widget_subscribe',
      'description' => esc_html__( 'Display MailChimp Subscribe Form.', 'authentic' )
    );
    parent::__construct( 'authentic_widget_subscribe', esc_html__( 'Authentic: Subscribe', 'authentic' ), $widget_details );
  }

  public function widget( $args, $instance ) {

    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Subscribe', 'authentic' );

    /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    echo $args['before_widget'];

    $mailchimp_embedded_form_url  = get_option('csco_mailchimp_embedded_form_url', '');

    $subscribe_message            = _get_field('text','widget_' . $args['widget_id']);

    ?>

    <div class="widget-body">
      <div class="widget-content">

      <?php if ( $title ) {
        echo $args['before_title'] . $title . $args['after_title'];
      }

      if ( $mailchimp_embedded_form_url !== '') { ?>

        <form method="post" action="<?php echo esc_url($mailchimp_embedded_form_url); ?>">
          <fieldset>
            <div class="form-group">
              <?php if ( $subscribe_message ) { ?><p class="widget-subscribe-message"><?php echo esc_html($subscribe_message); ?></p><?php } ?>
              <input type="text" name="EMAIL" class="email form-control" placeholder="<?php esc_html_e('Enter your Email here','authentic'); ?>">
            </div>
          </fieldset>
          <button type="submit" class="search-submit btn btn-primary btn-effect"><span><?php esc_html_e('Subscribe', 'authentic'); ?></span><span><i class="icon icon-mail"></i></span></button>
        </form>

      <?php } ?>

      </div>
    </div>

    <?php echo $args['after_widget'];

  }

  public function form( $instance ) {

    $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

    ?>

    <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'authentic' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
    <p><?php esc_html_e('MailChimp Embedded Form URL can be configured in Wordpress Customizer.','authentic');?></p>
    <?php

  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    return $instance;
  }
}

if( function_exists('acf_add_local_field_group') ) {

  acf_add_local_field_group(array (
    'key' => 'group_widget_subscribe',
    'title' => esc_html__('Subscribe Widget','authentic'),
    'fields' => array (
      array (
        'key' => 'field_subscribe_message',
        'label' => esc_html__('Subscribe Message','authentic'),
        'name' => 'text',
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
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'widget',
          'operator' => '==',
          'value' => 'authentic_widget_subscribe',
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
