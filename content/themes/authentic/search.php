<?php get_header(); ?>

<div class="site-content">
  <div class="container">
    <div class="page-content">
      <?php the_sidebar('left'); ?>
      <div class="main">

        <div class="page-header page-header-archive">
          <?php the_page_title(); ?>
        </div>

        <?php if (!have_posts()) : ?>
          <div class="alert alert-warning">
            <?php esc_html_e('Sorry, no results were found.', 'authentic'); ?>
          </div>
          <?php get_search_form(); ?>
        <?php endif; ?>

        <?php get_template_part('templates/archive', 'list' ); ?>

      </div>
      <?php the_sidebar('right'); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
