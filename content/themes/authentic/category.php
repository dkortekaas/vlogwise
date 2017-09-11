<?php get_header(); ?>

<?php $thumbnail_id = _get_field('csco_category_thumbnail', 'category_' . $cat); ?>

<?php if (!empty($thumbnail_id)) {

  $thumbnail = wp_get_attachment_image_src($thumbnail_id, 'hd'); ?>

  <div class="page-header page-header-wide page-header-bg parallax overlay" style="background-image: url(<?php echo $thumbnail[0]; ?>)">
    <div class="overlay-container">
      <div class="container">
        <div class="overlay-content">
          <?php the_post_count(); ?>
          <?php the_category_title(); ?>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<div class="site-content">

  <div class="container">
    <div class="page-content">
      <?php the_sidebar('left'); ?>
      <div class="main">

        <?php if(empty($thumbnail_id)) { ?>
        <div class="page-header page-header-archive">
          <?php the_post_count(); ?>
          <?php the_category_title(); ?>
        </div>
        <?php } ?>

        <?php if (!have_posts()) { ?>
          <div class="alert alert-warning">
            <?php esc_html_e('Sorry, no results were found.', 'authentic'); ?>
          </div>
          <?php get_search_form(); ?>
        <?php }

        $archive_type = _get_field('csco_category_layout_archive', 'category_' . $cat, 'default');

        if ($archive_type == 'default') {
          $archive_type = get_theme_mod('authentic_layout_archive', 'standard');
        }

        get_template_part('templates/archive', $archive_type ); ?>

      </div>
      <?php the_sidebar('right'); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
