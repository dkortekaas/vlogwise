<?php if (have_posts()) {

  $total = $wp_query->post_count;
  $columns = get_theme_mod('authentic_layout_archive_columns', '2');
  $show_first = get_theme_mod('authentic_layout_first_post', true);

  if (is_category()) {
    global $cat;
    $archive_type = _get_field('csco_category_layout_archive', 'category_' . $cat, 'default');
    $columns = _get_field('csco_category_layout_archive_columns', 'category_' . $cat, 'default');
    $show_first = _get_field('csco_category_layout_first_post', 'category_' . $cat, 'default');
    if ($columns == 'default' || $archive_type == 'default') {
      $columns = get_theme_mod('authentic_layout_archive_columns', '2');
    }
    if ($show_first == 'default' || $archive_type == 'default') {
      $show_first = get_theme_mod('authentic_layout_first_post', true);
    }
  }

  // reset if in search results
  if (is_search()) {
    $show_first = false;
  }

  echo '<div class="post-archive">';

  while (have_posts()) : the_post();

    $current = $wp_query->current_post + 1;

    if ($current == 1) {

      if ($show_first == true) {
        echo '<div class="post-archive-standard">';
        is_featured() ? get_template_part('templates/content', 'featured') : get_template_part('templates/content', 'standard');
        echo '</div>';
      }

      echo '<div class="post-archive-masonry">';
      echo '<div class="row">';

      if ($show_first == false) {
        echo '<div class="col-masonry col-lg-' . 12 / $columns . '">';
        is_featured() ? get_template_part('templates/content', 'featured') : get_template_part('templates/content', 'masonry');
        echo '</div>';
      }
    }

    else {
      echo '<div class="col-masonry col-lg-' . 12 / $columns . '">';
      is_featured() ? get_template_part('templates/content', 'featured') : get_template_part('templates/content', 'masonry');
      echo '</div>';
    }

  endwhile;

  // .row
  echo '</div>';

  // .post-archive-masonry
  echo '</div>';

  the_posts_pagination( array(
    'mid_size'  => 2,
    'prev_text' => esc_html__( 'Previous', 'authentic' ),
    'next_text' => esc_html__( 'Next', 'authentic' ),
  ) );

  // .post-archive
  echo '</div>';

}
