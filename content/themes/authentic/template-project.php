<?php
/**
 * Template Name: Projects
 */

get_header(); ?>

<?php while (have_posts()) : the_post();

  $featured_image_type = _get_field('csco_featured_image_type', get_the_ID(), 'default');

  if ( $featured_image_type == 'default' ) {
    $featured_image_type  = get_theme_mod('authentic_layout_posts_featured_image', 'none');
  }

  ?>

  <?php if ($featured_image_type == 'large' || $featured_image_type == 'wide') {

    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_ID(), 'hd'); ?>

    <div class="page-header page-header-<?php echo $featured_image_type; ?><?php if (has_excerpt()) { ?> page-header-standard<?php } ?> page-header-bg overlay parallax" style="background-image: url(<?php echo $thumbnail[0]; ?>)">
      <div class="overlay-container">
        <div class="container">
          <div class="overlay-content">
            <h1><?php the_title(); ?></h1>
            <?php if (has_excerpt()) { the_excerpt(); } ?>
          </div>
        </div>
      </div>
    </div>

  <?php } ?>

  <div class="site-content">
    <div class="container">
      <div class="page-content">
        <?php the_sidebar('left'); ?>
        <div class="main full">

          <?php if ($featured_image_type == 'standard') {

            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_ID(), 'square'); ?>

            <div class="page-header page-header-bg overlay overlay-ratio overlay-ratio-horizontal parallax" style="background-image: url(<?php echo $thumbnail[0]; ?>)">
              <div class="overlay-container">
                <div class="overlay-content">
                  <h1><?php the_title(); ?></h1>
                  <?php if (has_excerpt()) { the_excerpt(); } ?>
                </div>
              </div>
            </div>
          <?php } ?>

          <?php if ($featured_image_type == '' || $featured_image_type == 'none') { ?>
            <div class="page-header page-header-standard">
              <h1><?php the_title(); ?></h1>
              <?php if (has_excerpt()) {
                the_excerpt();
              } ?>
            </div>
          <?php } ?>

          <div class="content">
            <?php the_content(); ?>
            <?php
                $terms = get_terms( 'project_type' );
                if ( $terms && ! is_wp_error( $terms ) ) :
                    echo '<ul id="filters" class="col-lg-12">';
                      echo '<li class="filter" data-filter="*">'. __('All', 'authentic') .'</li>';
                      foreach ( $terms as $term ) :
                      echo '<li class="filter" data-filter=".'. $term->slug .'">'. $term->name . '</li>';
                      endforeach;
                    echo '</ul>';
                endif;
            ?>
            <ul class="grid">
            <?php
              $args = array( 'posts_per_page' => 40, 'sort_column' => 'menu_order', 'sort_order'=> 'asc', 'post_type' => 'project' );
				      $projects = get_posts( $args );
				      foreach ( $projects as $post ) :
					      setup_postdata( $post );

                $terms = get_the_terms( $post->ID , 'project_type' );
					      //$terms = get_the_terms( $post->ID, 'tag' );
											
					      if ( $terms && ! is_wp_error( $terms ) ) : 
						      $links = array();
						      foreach ( $terms as $term ) :
							      $links[] = $term->slug;
						      endforeach;
						      $itemlinks = join( " ", $links );
						      $itemlinks = strtolower($itemlinks);
					      endif;
					  ?>
					    <li class="element-item <?php echo $itemlinks ?>" data-category="<?php echo $itemlinks ?>">
                <a href="<?php the_permalink(); ?>" title="" itemprop="image">
							    <?php echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); ?>
						    </a>
						    <span class="meta-category">
							    <ul class="post-categories">
                  <?php
                    $terms = get_the_terms( $post->ID , 'project_type' );
                    foreach ( $terms as $term ) :
                      echo '<li><a href="'. get_term_link($term->term_id) .'" rel="category tag">'. $term->name . '</a></li>';
                    endforeach;
                  ?>
							    </ul>
						    </span>
						    <h2 class="entry-title">
							    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						    </h2>
					    </li>
            	<?php endforeach;
            	wp_reset_postdata();?>
            </ul>

          </div>

        </div>
      </div>
    </div>
  </div>

<?php endwhile; ?>

<?php get_footer(); ?>