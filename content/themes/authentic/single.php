<?php get_header(); ?>

<?php while (have_posts()) : the_post();

  $featured_image_type = _get_field('csco_featured_image_type', get_the_ID(), 'default');

  if ( $featured_image_type == 'default' ) {
    $featured_image_type  = get_theme_mod('authentic_layout_posts_featured_image', 'none');
  }

  $post_media_location = _get_field('csco_post_media_location', get_the_ID(), 'content'); ?>

  <?php if ($featured_image_type == 'large' || $featured_image_type == 'wide') {

    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_ID(), 'hd'); ?>

    <div class="page-header page-header-<?php echo $featured_image_type; ?> page-header-bg overlay parallax" style="background-image: url(<?php echo $thumbnail[0]; ?>)">
      <div class="overlay-container">
        <div class="container">
          <div class="overlay-content">
            <?php the_post_category(); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_post_meta(array('date', 'views', 'reading_time')); ?>
          </div>
        </div>
      </div>
    </div>

  <?php } ?>

  <?php if ($post_media_location == 'header') { ?>
    <div class="container">
      <?php the_post_media(); ?>
    </div>
  <?php } ?>

  <div class="site-content">
    <div class="container">
      <div class="page-content">
        <?php the_sidebar('left'); ?>
        <div class="main">

          <article <?php post_class(); ?>>

            <?php if ($featured_image_type == 'standard') {

              $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_ID(), 'square'); ?>

              <div class="page-header page-header-bg overlay overlay-ratio overlay-ratio-horizontal parallax" style="background-image: url(<?php echo $thumbnail[0]; ?>)">

                <div class="overlay-container">
                  <div class="container">
                    <div class="overlay-content">
                      <?php the_post_category(); ?>
                      <h1 class="entry-title"><?php the_title(); ?></h1>
                      <?php the_post_meta(array('date', 'views', 'reading_time')); ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

            <?php if ($featured_image_type == '' || $featured_image_type == 'none') { ?>
              <div class="page-header page-header-standard">
                <?php the_post_category(); ?>
                <h1><?php the_title(); ?></h1>
                <?php the_post_meta(array('date', 'views', 'reading_time')); ?>
              </div>
            <?php } ?>

            <?php if ($post_media_location == 'content') { the_post_media(); } ?>

            <div class="post-wrap">
              <?php if ( true == get_theme_mod('authentic_layout_posts_share_buttons', true) ) { ?>
              <div class="post-sidebar">
                <?php the_share_buttons('vertical'); ?>
              </div>
              <?php } ?>
              <div class="post-content">
                <div class="content">
                  <?php the_content(); ?>
                </div>
              </div>
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

            <?php the_tags( '<ul class="post-tags"><li>', '</li><li>', '</li></ul>' ); ?>

            <?php if (get_theme_mod('authentic_meta_author', true) == true) { ?>
              <div class="post-author author vcard">
                <?php echo get_avatar( get_the_author_meta('email'), '120', null, false, array('class' => 'rounded-circle') ); ?>
                <h4 class="fn"><?php the_author_posts_link(); ?></h4>
                <p><?php the_author_meta('description'); ?></p>
                <?php the_author_accounts_list(); ?>
              </div>
            <?php } ?>

          </article>

          <?php the_prev_next_posts(); ?>

          <?php the_related_posts(); ?>

          <?php if ( comments_open() || get_comments_number() ) { comments_template(); }; ?>

        </div>
      <?php the_sidebar('right'); ?>
      </div>
    </div>
  </div>

<?php endwhile; ?>

<?php get_footer(); ?>
