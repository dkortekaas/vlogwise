<?php

/**
 * Posts List
 */

class authentic_widget_posts extends WP_Widget {

  public function __construct() {
    $widget_details = array(
      'classname' => 'authentic_widget_posts',
      'description' => esc_html__( 'Display a list of your posts.', 'authentic' )
    );
    parent::__construct( 'authentic_widget_posts', esc_html__( 'Authentic: Posts', 'authentic' ), $widget_details );
  }

  public function widget( $args, $instance ) {

    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    $widget_id          = $args['widget_id'];

    $layout             = _get_field('layout','widget_' . $widget_id, 'list');
    $category           = _get_field('category','widget_' . $widget_id);
    $posts_per_page     = _get_field('posts_per_page','widget_' . $widget_id, 4);
    $orderby            = _get_field('orderby','widget_' . $widget_id, 'date');
    $order              = _get_field('order','widget_' . $widget_id, 'DESC');
    $time_frame         = _get_field('time_frame','widget_' . $widget_id);
    $post_meta          = _get_field('post_meta','widget_' . $widget_id, array('date'));
    $post_meta_compact  = _get_field('post_meta_compact','widget_' . $widget_id);
    $featured           = _get_field('featured','widget_' . $widget_id);

    $posts_args = array(
      'posts_per_page'      => $posts_per_page,
      'orderby'             => $orderby,
      'order'               => $order,
      'no_found_rows'       => true,
      'post_status'         => 'publish',
      'ignore_sticky_posts' => true
    );

    if ($category) {
      $posts_args['cat'] = $category;
    }

    if ($orderby == 'meta_value_num') {
      $posts_args['meta_key'] = 'views';
    }

    if ($featured == true) {
      $posts_args['meta_query'] =  array(
        array(
          'key' => 'csco_post_featured',
          'compare' => 'LIKE',
          'value' => 'widget'
        )
      );
    }

    if ($time_frame) {
      $posts_args['date_query'] = array(
        array(
          'column' => 'post_date_gmt',
          'after'  => $time_frame . ' ago',
        )
      );
    }

    $posts = new WP_Query( $posts_args );

    if ($posts->have_posts()) {

      $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

      /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
      $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

      echo $args['before_widget'];

      if ( $title ) {
        echo $args['before_title'] . $title . $args['after_title'];
      } ?>

      <?php if ($layout == 'slider') { ?>

        <div class="owl-container owl-flip">
          <div class="owl-carousel">

            <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

              <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_ID(), 'square'); ?>

              <div class="owl-slide">

                <article <?php post_class('overlay overlay-ratio overlay-ratio-vertical'); ?> style="background-image: url(<?php echo $thumbnail[0]; ?>)">
                  <div class="overlay-container">
                    <div class="overlay-content">
                      <?php the_post_category(); ?>
                      <h2><?php the_title(); ?></h2>
                      <?php the_post_meta($post_meta, $post_meta_compact); ?>
                      <?php the_read_more('', 'btn btn-primary btn-effect', 'arrow-right'); ?>
                    </div>
                  </div>
                  <a href="<?php the_permalink(); ?>" class="overlay-link"></a>
                </article>

              </div>

            <?php endwhile; ?>

          </div>
          <div class="owl-dots"></div>
        </div>

      <?php } elseif ($layout == 'list') { ?>

        <ul class="<?php echo $layout; ?>">
        <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
          <li>

            <article class="media">
              <div class="d-flex mr-3">
                <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                  <?php the_post_thumbnail('mini'); ?>
                </a>
              </div>
              <div class="media-body">
                <h4 class="mb-0"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
                <?php the_post_meta($post_meta, $post_meta_compact); ?>
              </div>
            </article>

          </li>

        <?php endwhile; ?>
        </ul>

      <?php } elseif ($layout == 'numbered') { ?>

        <ul class="<?php echo $layout; ?>">
        <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
          <li>

            <article class="media">
              <div class="d-flex mr-3">
                <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                  <?php the_post_thumbnail('mini'); ?>
                  <span class="post-number-wrap">
                    <span class="post-number">
                      <span><?php echo $posts->current_post +1; ?></span>
                      <span><i class="icon icon-arrow-right"></i></span>
                    </span>
                  </span>
                </a>
              </div>
              <div class="media-body">
                <h4 class="mb-0"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
                <?php the_post_meta($post_meta, $post_meta_compact); ?>
              </div>
            </article>

          </li>

        <?php endwhile; ?>
        </ul>

      <?php } ?>

      <?php echo $args['after_widget'];

    }

    wp_reset_postdata();

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
    'key' => 'group_widget_posts',
    'title' => esc_html__('Posts Widget','authentic'),
    'fields' => array (
      array (
        'key' => 'field_posts_layout',
        'label' => esc_html__('Layout','authentic'),
        'name' => 'layout',
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
          'list' => esc_html__('List','authentic'),
          'numbered' => esc_html__('Numbered','authentic'),
          'slider' => esc_html__('Slider','authentic'),
        ),
        'default_value' => array (
          'list' => esc_html__('List','authentic'),
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
        'key' => 'field_posts_posts_per_page',
        'label' => esc_html__('Number of Posts','authentic'),
        'name' => 'posts_per_page',
        'type' => 'number',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 5,
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'min' => '',
        'max' => '',
        'step' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
      array (
        'key' => 'field_posts_orderby',
        'label' => esc_html__('Order by','authentic'),
        'name' => 'orderby',
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
          'date' => esc_html__('Date','authentic'),
          'meta_value_num' => esc_html__('Views','authentic'),
          'comment_count' => esc_html__('Comments','authentic'),
          'rand' => esc_html__('Random','authentic'),
        ),
        'default_value' => array (
          'date' => esc_html__('Date','authentic'),
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
        'key' => 'field_posts_order',
        'label' => esc_html__('Order','authentic'),
        'name' => 'order',
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
          'desc' => esc_html__('Descending','authentic'),
          'asc' => esc_html__('Ascending','authentic'),
        ),
        'default_value' => array (
          'desc' => esc_html__('Descending','authentic'),
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
        'key' => 'field_posts_time_frame',
        'label' => esc_html__('Time Frame','authentic'),
        'name' => 'time_frame',
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
        'placeholder' => '3 months',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
      array (
        'key' => 'field_posts_category',
        'label' => esc_html__('Category','authentic'),
        'name' => 'category',
        'type' => 'taxonomy',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'taxonomy' => 'category',
        'field_type' => 'checkbox',
        'allow_null' => 0,
        'add_term' => 0,
        'save_terms' => 0,
        'load_terms' => 0,
        'return_format' => 'id',
        'multiple' => 0,
      ),
      array (
        'key' => 'field_posts_meta',
        'label' => esc_html__('Post Meta','authentic'),
        'name' => 'post_meta',
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
          'date'            => esc_html__('Date','authentic'),
          'author'          => esc_html__('Author','authentic'),
          'reading_time'    => esc_html__('Reading Time','authentic'),
          'views'           => esc_html__('Views','authentic'),
          'comments_count'  => esc_html__('Comments Count','authentic'),
        ),
        'default_value' => array (
        ),
        'layout' => 'vertical',
        'toggle' => 0,
      ),
      array (
        'key' => 'field_posts_meta_compact',
        'label' => esc_html__('Compact Post Meta','authentic'),
        'name' => 'post_meta_compact',
        'type' => 'true_false',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => esc_html__('Display compact post meta','authentic'),
        'default_value' => 0,
      ),
      array (
        'key' => 'field_posts_featured_posts',
        'label' => esc_html__('Featured Posts','authentic'),
        'name' => 'featured',
        'type' => 'true_false',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => esc_html__('Include only featured posts','authentic'),
        'default_value' => 0,
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'widget',
          'operator' => '==',
          'value' => 'authentic_widget_posts',
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

};
