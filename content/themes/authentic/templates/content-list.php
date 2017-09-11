<article <?php post_class('post-list'); ?>>

  <div class="row">

    <div class="col-md-4">
      <?php if ( has_post_thumbnail() ) { ?>
        <div class="post-thumbnail">
          <?php the_post_thumbnail('list'); ?>
          <?php the_read_more(); ?>
          <?php the_post_meta(array('reading_time', 'views'), true); ?>
          <a href="<?php the_permalink();?>"></a>
        </div>
      <?php } ?>
    </div>

    <div class="col-md-8">
      <?php the_post_category(); ?>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php the_post_meta(array('date', 'author', 'comments_count')); ?>
      <?php the_excerpt(); ?>
      <?php the_read_more('', 'btn btn-primary btn-effect', 'arrow-right'); ?>
    </div>

  </div>

</article>




