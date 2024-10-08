<?php get_header(); ?>

<?php while (have_posts()) : the_post();

  $featured_image_type = _get_field('csco_featured_image_type', get_the_ID(), 'default');

  $video_code = get_field('youtube_code');

  if ( $featured_image_type == 'default' ) {
    $featured_image_type  = get_theme_mod('authentic_layout_posts_featured_image', 'none');
  }

  ?>

<?php if( $video_code != null) { ?>

  <div class="page-header page-header-wide page-header-bg overlay parallax">
    <div class="video-background">
      <div class="video-foreground">
        <iframe src="https://player.vimeo.com/video/<?php echo $video_code; ?>?background=1&autoplay=1&loop=1&byline=0&title=0"
           frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay; fullscreen">></iframe>

        <!-- <iframe src="https://www.youtube.com/embed/<?php //echo $video_code; ?>?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&&playlist=<?php echo $youtube_code; ?>&mute=1" frameborder="0" allowfullscreen></iframe> -->
      </div>
      <div class="container">
        <div class="overlay-content">
          <h1><?php the_title(); ?></h1>
          <?php if (get_field('subtitle')) : ?>
          <h2><?php the_field('subtitle'); ?></h2>
          <?php endif; ?>
          <?php if (has_excerpt()) { the_excerpt(); } ?>
        </div>
      </div>
    </div>
  </div>

<?php } else { ?>

    <?php if ($featured_image_type == 'large' || $featured_image_type == 'wide') {

      $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_ID(), 'hd'); ?>

      <div class="page-header page-header-<?php echo $featured_image_type; ?><?php if (has_excerpt()) { ?> page-header-standard<?php } ?> page-header-bg overlay parallax" style="background-image: url(<?php echo $thumbnail[0]; ?>)">
        <div class="overlay-container">
          <div class="container">
            <div class="overlay-content">
              <h1><?php the_title(); ?></h1>
              <?php if (get_field('subtitle')) : ?>
              <h2><?php the_field('subtitle'); ?></h2>
              <?php endif; ?>
              <?php if (has_excerpt()) { the_excerpt(); } ?>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>
<?php } ?>

  <div class="site-content">
    <div class="container">
      <div class="page-content">
        <?php the_sidebar('left'); ?>
        <div class="main">

          <?php if ($featured_image_type == 'standard') {

            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_ID(), 'square'); ?>

            <div class="page-header page-header-bg overlay overlay-ratio overlay-ratio-horizontal parallax" style="background-image: url(<?php echo $thumbnail[0]; ?>)">
              <div class="overlay-container">
                <div class="overlay-content">
                  <h1><?php the_title(); ?></h1>
                  <?php if (get_field('subtitle')) : ?>
                  <h2><?php the_field('subtitle'); ?></h2>
                  <?php endif; ?>
                  <?php if (has_excerpt()) { the_excerpt(); } ?>
                </div>
              </div>
            </div>
          <?php } ?>

          <?php if ($featured_image_type == '' || $featured_image_type == 'none') { ?>
            <div class="page-header page-header-standard">
              <h1><?php the_title(); ?></h1>
              <?php if (get_field('subtitle')) : ?>
              <h2><?php the_field('subtitle'); ?></h2>
              <?php endif; ?>
              <?php if (has_excerpt()) {
                the_excerpt();
              } ?>
            </div>
          <?php } ?>

          <div class="content">
            <?php the_content(); ?>
          </div>

          <?php wp_link_pages(array(
            'before'           => '<div class="navigation pagination"><div class="nav-links">',
            'after'            => '</div></div>',
            'link_before'      => '<span class="page-number">',
            'link_after'       => '</span>',
            'next_or_number'   => 'next_and_number',
            'separator'        => ' ',
            'nextpagelink'     => esc_html__( 'Next page', 'authentic' ),
            'previouspagelink' => esc_html__( 'Previous page', 'authentic' ),
          )); ?>

          <?php if ( comments_open() || get_comments_number() ) { comments_template(); }; ?>

        </div>
        <?php the_sidebar('right'); ?>
      </div>
    </div>
  </div>

<?php endwhile; ?>

<?php get_footer(); ?>
