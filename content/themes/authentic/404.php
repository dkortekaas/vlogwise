<?php get_header(); ?>

<div class="site-content">
  <div class="container">

    <div class="page-header page-header-standard">
      <?php the_page_title(); ?>
    </div>

    <div class="content">
      <p><?php esc_html_e('Sorry, but the page you were trying to view does not exist.', 'authentic'); ?></p>
      <?php get_search_form(); ?>
    </div>

  </div>
</div>

<?php get_footer(); ?>
