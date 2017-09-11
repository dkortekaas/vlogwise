<article <?php post_class('post-standard'); ?>>

  <div class="post-header">
    <?php the_post_category(); ?>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php the_post_meta(array('reading_time', 'views', 'date', 'author', 'comments_count')); ?>
  </div>

  <?php the_post_media(); ?>

  <?php if (get_theme_mod('authentic_layout_post_summary_type','excerpt') == 'excerpt') { ?>
    <?php the_excerpt(); ?>
  <?php } else { ?>
    <?php the_content(''); ?>
  <?php } ?>

  <?php the_read_more('', 'btn btn-primary btn-effect', 'arrow-right'); ?>

  <div class="post-footer">
    <?php the_share_buttons('horizontal', true); ?>
  </div>

</article>
