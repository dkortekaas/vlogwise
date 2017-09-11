<?php

$overlay_class = ' overlay';
$overlay_attr = '';

$show_first = get_theme_mod('authentic_layout_first_post', true);
$layout_archive = get_theme_mod('authentic_layout_archive', 'standard');

if (is_category()) {
  global $cat;
  $archive_type = _get_field('csco_category_layout_archive', 'category_' . $cat, 'default');
  $layout_archive = _get_field('csco_category_layout_archive', 'category_' . $cat, 'default');
  $show_first = _get_field('csco_category_layout_first_post', 'category_' . $cat, 'default');
  if ($show_first == 'default' || $archive_type == 'default') {
    $show_first = get_theme_mod('authentic_layout_first_post', true);
  }
  if ($layout_archive == 'default' || $archive_type == 'default') {
    $layout_archive = get_theme_mod('authentic_layout_archive', 'standard');
  }
}

$current = $wp_query->current_post + 1;

if ($current == 1 && $show_first == true ) {

  $layout_archive = 'standard';
  $thumbnail = $layout_archive;
  $overlay_class .= ' overlay-ratio overlay-ratio-horizontal';

} else {

  if ($layout_archive == 'standard') {
    $overlay_class .= ' overlay-ratio overlay-ratio-horizontal';
  }

  if ($layout_archive == 'list') {
    $layout_archive = 'standard';
    $thumbnail = 'standard';
    $overlay_class .= ' overlay-ratio overlay-ratio-horizontal';
  }

  elseif ($layout_archive == 'masonry') {
    $thumbnail = 'list';
    $overlay_class .= ' overlay-ratio overlay-ratio-vertical';
  }

  elseif ($layout_archive == 'grid') {
    $thumbnail = 'list';
    $overlay_class .= ' overlay-ratio overlay-ratio-vertical';
  }

  else {
    $thumbnail = $layout_archive;
  }
}

$format = get_post_format();
if ( in_array($format, array('video')) ) {
  $video_url = _get_field('csco_post_embed', false, '', false);
  if ($video_url !== '') {
    $overlay_class .= ' parallax-video';
    $overlay_attr = ' data-video="' . $video_url . '"';
  }
} else {
  $overlay_class .= ' parallax';
}

$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_ID(), $thumbnail);

?>

<article <?php post_class('post-featured post-' . $layout_archive . $overlay_class); ?> style="background-image: url(<?php echo $thumbnail[0]; ?>);"<?php echo $overlay_attr; ?>>

  <span class="overlay-label"><i class="icon icon-ribbon"></i></span>

  <div class="overlay-container">
    <div class="overlay-content">
      <?php the_post_category(); ?>
      <h2 class="entry-title"><?php the_title(); ?></h2>
      <?php the_read_more('', 'btn btn-primary btn-effect', 'arrow-right'); ?>
    </div>
    <?php the_post_meta(array('reading_time', 'views')); ?>
  </div>

  <a href="<?php the_permalink();?>" class="overlay-link"></a>

</article>
