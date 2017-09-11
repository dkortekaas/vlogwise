<article <?php post_class('post-grid'); ?>>

  <?php if ( has_post_thumbnail() ) { ?>
    <div class="post-thumbnail">
      <?php the_post_thumbnail('grid'); ?>
      <?php the_read_more(); ?>
      <?php the_post_meta(array('reading_time', 'views')); ?>
      <a href="<?php the_permalink();?>"></a>
    </div>
  <?php } ?>

  <?php the_post_category(); ?>
  <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php the_post_meta(array('date', 'author', 'comments_count')); ?>
  <?php the_excerpt(); ?>
  <?php the_read_more('', 'btn btn-primary btn-effect', 'arrow-right'); ?>

</article>
