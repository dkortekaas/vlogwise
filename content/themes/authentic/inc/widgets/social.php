<?php

/**
 * Posts List
 */

class authentic_widget_social extends WP_Widget {

  public function __construct() {
    $widget_details = array(
      'classname' => 'authentic_widget_social',
      'description' => esc_html__( 'Display links to social accounts .', 'authentic' )
    );
    parent::__construct( 'authentic_widget_social', esc_html__( 'Authentic: Social Accounts', 'authentic' ), $widget_details );
  }

  public function widget( $args, $instance ) {

    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Follow Us', 'authentic' );

    /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    echo $args['before_widget'];

    if ( $title ) {
      echo $args['before_title'] . $title . $args['after_title'];
    }

    $social_accounts = get_option('csco_social_accounts');

    if (is_array($social_accounts)) { ?>
    <div class="social-accounts">

      <ul class="social-bg-hover">
        <?php the_icon_list($social_accounts, 'li') ; ?>
      </ul>

    </div>
    <?php } ?>

    <?php echo $args['after_widget'];

  }

  public function form( $instance ) {

    $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

    ?>

    <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'authentic' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
    <p><?php esc_html_e('Social Accounts can be configured in Wordpress Customizer.','authentic');?></p>
    <?php

  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    return $instance;
  }
}
