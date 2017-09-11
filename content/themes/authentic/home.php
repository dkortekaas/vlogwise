<?php get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if($paged == 1) {

  $slides_number = get_theme_mod('authentic_home_featured_slides_number', 3);

  $args = array(
    'posts_per_page' => $slides_number,
    'post_type'   => 'post',
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_query'  => array(
      array(
        'key'     => 'csco_post_featured',
        'value'     => 'home',
        'compare'   => 'LIKE',
      ),
    ),
  );

	$featured = new WP_Query( apply_filters( 'csco_slider_query_args', $args ) ); ?>

  <?php if ( $featured->have_posts() && get_theme_mod('authentic_home_featured', true) == true ) {

    $slider_type      = get_theme_mod('authentic_home_featured_type', 'center');
    $slider_thumbnail = get_theme_mod('authentic_home_featured_image_size', 'hd');
    $slider_parallax  = get_theme_mod('authentic_home_featured_parallax', true);


    ?>

    <div class="owl-container owl-featured owl-<?php echo esc_html($slider_type); ?><?php if ( true == $slider_parallax ) {?> owl-parallax<?php } ?>" <?php if ($slider_type == 'multiple') {?> data-slides-visible="<?php echo intval(get_theme_mod('authentic_home_featured_visible_slides_number', 3)); ?>"<?php } ?>>

      <div class="owl-carousel">
        <?php while ( $featured->have_posts() ) : $featured->the_post();

          $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_ID(), $slider_thumbnail);

          // Video Background

          $class = '';
          $attr = '';
          $format = get_post_format();
          if ( in_array($format, array('video')) ) {
            $video_url = _get_field('csco_post_embed', false, '', false);
            if ($video_url !== '') {
              $class = ' slide-video';
              $attr = ' data-video="' . $video_url . '"';
            }
          } ?>

          <div class="owl-slide overlay<?php echo $class; ?>" style="background-image: url(<?php echo $thumbnail[0]; ?>)"<?php echo $attr; ?>>
            <div class="overlay-container">
              <div class="overlay-content">
                <?php the_post_category(); ?>
                <h2><?php the_title(); ?></h2>
                <?php the_read_more('', 'btn btn-primary btn-effect', 'arrow-right');?>
              </div>
            </div>
            <a href="<?php the_permalink();?>" class="overlay-link"></a>
          </div>

        <?php endwhile; ?>
      </div>

      <div class="owl-arrows"></div>
      <div class="owl-dots"></div>

    </div>

    <?php wp_reset_postdata(); ?>
  <?php } ?>

  <?php

  $time_frame = get_theme_mod('authentic_home_trending_time_frame', '1 month');

  $args = array(
    'posts_per_page' => 8,
    'post_type'   => 'post',
    'orderby' => 'meta_value_num',
    'meta_key' => 'views',
    'order' => 'DESC',
    'date_query' => array(
      array(
        'column' => 'post_date_gmt',
        'after'  => $time_frame . ' ago',
      )
    )
  );

  $trending = new WP_Query( apply_filters( 'authentic_home_trending', $args ) ); ?>

  <?php if ( $trending->have_posts() && get_theme_mod('authentic_home_trending', true) == true ) { ?>

    <div class="container">
      <div class="post-archive post-archive-trending">

        <h6 class="title-trending"><?php esc_html_e('Trending','authentic');?></h6>

        <div class="owl-container owl-loop" data-slides="4">
          <div class="owl-carousel">
          <?php while ( $trending->have_posts() ) : $trending->the_post(); ?>
            <div class="owl-slide">
              <article <?php post_class('post-trending post-list'); ?>>
                <?php if ( has_post_thumbnail() ) { ?>
                  <div class="post-thumbnail">
                    <?php the_post_thumbnail('list'); ?>
                    <?php the_read_more(); ?>
                    <?php the_post_meta(array('reading_time', 'views'), true); ?>
                    <a href="<?php the_permalink();?>"></a>
                  </div>
                <?php } ?>
                <?php the_post_category(); ?>
                <h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
                <div class="hidden-sm-up"><?php the_post_meta(array('date', 'author'), true); ?></div>
              </article>
            </div>
          <?php endwhile; ?>
          </div>
          <div class="owl-dots"></div>
        </div>

        <?php wp_reset_postdata(); ?>
      </div>
    </div>

  <?php } ?>

<?php } ?>

<div class="site-content">
  <div class="container">
    <div class="page-content">
      <?php the_sidebar('left'); ?>
      <div class="main">

        <?php if (!have_posts()) { ?>
          <div class="alert alert-warning">
            <?php esc_html_e('Sorry, no results were found.', 'authentic'); ?>
          </div>
          <?php get_search_form(); ?>
        <?php } ?>

        <?php $archive_type = get_theme_mod('authentic_layout_archive', 'standard'); ?>

        <?php get_template_part('templates/archive', $archive_type ); ?>

      </div>
      <?php the_sidebar('right'); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
