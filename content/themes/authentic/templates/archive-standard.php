<?php if (have_posts()) : ?>
  <div class="post-archive">
    <div class="post-archive-standard">
      <?php while (have_posts()) : the_post(); ?>
        <?php is_featured() ? get_template_part('templates/content', 'featured') : get_template_part('templates/content', 'standard'); ?>
      <?php endwhile; ?>
    </div>
    <?php the_posts_pagination( array(
      'mid_size'  => 2,
      'prev_text' => esc_html__( 'Previous', 'authentic' ),
      'next_text' => esc_html__( 'Next', 'authentic' ),
    ) ); ?>
  </div>
<?php endif; ?>
