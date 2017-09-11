<?php

/**
 * Add classes to <body> tag
 */

function authentic_body_class( $classes ) {

  if (is_category()) {
    global $cat;
    $page_layout = _get_field('csco_category_layout_page', 'category_' . $cat, 'default');
    if ($page_layout == 'default') {
      $page_layout = get_theme_mod('authentic_layout_archive_page', 'layout-sidebar-right');
    }
  } elseif (is_single() || is_page()) {
    global $post;
    $page_layout = _get_field('csco_singular_layout_page', $post->ID, 'default');
    if ($page_layout == 'default') {
      $page_layout = get_theme_mod('authentic_layout_post_page', 'layout-sidebar-right');
    }
  } else {
    $page_layout = get_theme_mod('authentic_layout_archive_page', 'layout-sidebar-right');
  }

  $classes[] = $page_layout;

  if (get_theme_mod('authentic_pin_it', false) == true) {
    $classes[] = 'pin-it-enabled';
  }

  if (get_theme_mod('authentic_effects_parallax', true) == true) {
    $classes[] = 'parallax-enabled';
  } else {
    $classes[] = 'parallax-disabled';
  }

  if (get_theme_mod('authentic_effects_sticky_sidebar', true) == true) {
    $classes[] = 'sticky-sidebar-enabled';
  }

  if (get_theme_mod('authentic_effects_lazy_load', true) == true) {
    $classes[] = 'lazy-load-enabled';
  }

  if (get_theme_mod('authentic_effects_navbar_scroll', true) == true) {
    $classes[] = 'navbar-scroll-enabled';
  }

  if (is_single() || is_page()) {

    global $post;

    if (get_theme_mod('authentic_layout_posts_share_buttons', true) == true) {
      $classes[] = 'share-buttons-enabled';
    } else {
      $classes[] = 'share-buttons-disabled';
    }

    $featured_image_type = _get_field('csco_featured_image_type', $post->ID, 'default');

    if ( $featured_image_type == 'default' ) {
      $featured_image_type  = get_theme_mod('authentic_layout_posts_featured_image', 'none');
    }

    $classes[] = 'featured-image-' . $featured_image_type;

  }

  if (is_home() && get_theme_mod('authentic_home_featured_type') == 'large') {
    $paged =  get_query_var( 'paged' );
    if ($paged == 0) {
      $classes[] = 'featured-image-large';
    }
      $classes[] = 'paged-' . $paged;
  }

  return $classes;
}

add_filter( 'body_class', 'authentic_body_class' );

/**
 * Sidebars
 */

if ( ! function_exists( 'the_sidebar' ) ) {
  function the_sidebar($location) {

    if (is_category()) {
      global $cat;
      $page_layout = _get_field('csco_category_layout_page', 'category_' . $cat, 'default');
      if ($page_layout == 'default') {
        $page_layout = get_theme_mod('authentic_layout_archive_page', 'layout-sidebar-right');
      }
    } elseif (is_single() || is_page()) {
      global $post;
      $page_layout = _get_field('csco_singular_layout_page', $post->ID, 'default');
      if ($page_layout == 'default') {
        $page_layout = get_theme_mod('authentic_layout_post_page', 'layout-sidebar-right');
      }
    } else {
      $page_layout = get_theme_mod('authentic_layout_archive_page', 'layout-sidebar-right');
    }

    if ($location == 'left' && $page_layout == 'layout-sidebar-left') {
      get_sidebar();
    }

    if ($location == 'right' && $page_layout == 'layout-sidebar-right') {
      get_sidebar();
    }
  }
}

/**
 * Add wrapper div to the excerpt
 */

function authentic_wrap_excerpt($excerpt) {

  $summary = get_theme_mod('authentic_layout_post_summary', true);

  if (is_category()) {
    global $cat;
    $summary = _get_field('csco_category_layout_post_summary', 'category_' . $cat, 'default');
    if ($summary == 'default') {
      $summary = get_theme_mod('authentic_layout_post_summary', true);
    }
  }

  if ($excerpt && $summary == true) {
    return '<div class="post-excerpt">' . $excerpt . '</div>';
  }
}

add_filter('get_the_excerpt', 'authentic_wrap_excerpt');

/**
 * Excerpt Length
 */

function authentic_excerpt_length( $length ) {
  return get_theme_mod('authentic_excerpt_length', 30);
}

add_filter( 'excerpt_length', 'authentic_excerpt_length', 999 );

/**
 * Excerpt Suffix
 */

function authentic_excerpt_more( $more ) {
  return '&hellip;';
}

add_filter( 'excerpt_more', 'authentic_excerpt_more' );

/**
 * Check if post is a featured post
 */

if ( ! function_exists( 'is_featured' ) ) {
  function is_featured($id = null) {
    if ($id !== null) {
      if( in_array('loop', _get_field('csco_post_featured', $id)) ) {
        return true;
      }
    } else {
      $featured_post = _get_field('csco_post_featured', get_the_ID());
      if( is_array($featured_post) && in_array('loop', $featured_post) ) {
        return true;
      }
    }
  }
}

/**
 * Get Post Format Template
 */

if ( ! function_exists( 'the_post_media' ) ) {
  function the_post_media() {
    $format = get_post_format();
    if ( has_post_thumbnail() && in_array($format, array(false, 'image')) ) { ?>
        <?php if (is_single()) {
          if (in_array($format, array('image')) ) {
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
            <div class="post-media">
              <figure>
                <a href="<?php echo $thumb[0];?>">
                  <?php the_post_thumbnail('large'); ?>
                </a>
              </figure>
            </div>
        <?php }
        } else { ?>
          <div class="post-media">
            <a href="<?php the_permalink();?>">
              <?php the_post_thumbnail('large'); ?>
            </a>
          </div>
        <?php } ?>
    <?php } elseif ( in_array($format, array('gallery', 'video', 'audio')) ) { ?>
      <div class="post-media">
        <?php get_template_part('templates/format', $format);?>
      </div>
    <?php }
  }
}

/**
 * Comment Form Fields
 */

function authentic_comment_form_fields( $fields ) {
  $commenter = wp_get_current_commenter();

  $req      = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );

  $fields =  array(

    'author' =>
      '<div class="form-group comment-form-author"><label for="author">' . esc_html__( 'Name', 'authentic' ) . '</label> ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' /></div>',

    'email' =>
      '<div class="form-group comment-form-email"><label for="email">' . esc_html__( 'Email', 'authentic' ) . '</label> ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' /></div>',

    'url' =>
      '<div class="form-group comment-form-url"><label for="url">' . esc_html__( 'Website', 'authentic' ) . '</label>' .
      '<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></div>',
  );

  return $fields;
}

add_filter( 'comment_form_default_fields', 'authentic_comment_form_fields' );

/**
 * Comment Form Textarea and Submit Button
 */

function authentic_comment_form( $args ) {

  $args['comment_field'] =
    '<div class="form-group comment-form-comment">
      <label for="comment">' . esc_html__( 'Your Comment', 'authentic' ) . '</label> <span class="required">*</span>
      <textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea>
    </div>';

  $args['class_submit'] = 'btn btn-primary'; // since WP 4.1
  return $args;
}

add_filter( 'comment_form_defaults', 'authentic_comment_form' );

/**
 * Custom comments markup
 */

if ( ! function_exists( 'authentic_comments' ) ) {
  function authentic_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    $comment_class = 'comment-body media';
    $comment_class .= empty( $args['has_children'] ) ? '' : ' ' . 'parent';

  ?>
    <div <?php comment_class($comment_class); ?> id="comment-<?php comment_ID() ?>">

      <?php if ( $args['avatar_size'] != 0 && get_avatar($comment) !== '' ) { ?>
      <div class="comment-thumb d-flex mr-3">
        <?php echo get_avatar( $comment, $args['avatar_size'], null, null, array( 'class' => array( 'media-object' )));?>
      </div>
      <?php } ?>

      <div class="comment-content">

        <div class="comment-author"><?php echo get_comment_author_link(); ?></div>
        <div class="comment-meta">
          <?php
            /* translators: 1: date, 2: time */
            printf( esc_html__('%1$s at %2$s','authentic'), get_comment_date(),  get_comment_time() ); ?> <?php edit_comment_link( esc_html__( 'Edit', 'authentic' ), '  ', '' );
          ?>
        </div>

        <?php if ( $comment->comment_approved == '0' ) : ?>
        <div class="alert alert-info comment-awaiting-moderation" role="alert">
          <?php esc_html_e( 'Your comment is awaiting moderation.','authentic' ); ?>
        </div>
        <?php endif; ?>

        <div class="comment-text">
          <?php comment_text(); ?>
        </div>

        <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ))); ?>

      </div>
  <?php
  }
}

/**
 * Remove inline styles from Tag Clouds
 */

function authentic_tag_cloud_widget($tags){
   return preg_replace("/style='font-size:.+pt;'/", '', $tags);
}

add_filter( 'wp_generate_tag_cloud', 'authentic_tag_cloud_widget' );

/**
 * Page titles
 */

if ( ! function_exists( 'the_page_title' ) ) {
  function the_page_title() {

    $allowed_html = array(
      'span' => array(),
      'h1' => array(),
    );

    if (is_archive()) {

      if ( is_category() ) {

        // $subtitle = wp_kses( __('Posts <span>by</span> category','authentic'), $allowed_html );
        $title = single_cat_title( '', false );

      } elseif ( is_tag() ) {

        $subtitle = wp_kses( __('Posts <span>by</span> tag','authentic'), $allowed_html );
        $title = single_tag_title( '', false );

      } elseif ( is_author() ) {

        $subtitle = wp_kses( __('Posts <span>by</span> author','authentic'), $allowed_html );
        $title = get_the_author( '', false );

      } elseif ( is_year() ) {

        $subtitle = wp_kses( __('Posts <span>by</span> year','authentic'), $allowed_html );
        $title = get_the_date( 'Y' );

      } elseif ( is_month() ) {

        $subtitle = wp_kses( __('Posts <span>by</span> month','authentic'), $allowed_html );
        $title = get_the_date( 'F Y' );

      } elseif ( is_day() ) {

        $subtitle = wp_kses( __('Posts <span>by</span> day','authentic'), $allowed_html );
        $title = get_the_date( 'F j, Y' );

      } else {
        $title = get_the_archive_title();
      }

    } elseif (is_search()) {

      $subtitle = wp_kses( __('Search Results <span>for</span>','authentic'), $allowed_html );
      $title = get_search_query();

    } elseif (is_404()) {

      $subtitle = '404';
      $title = esc_html__('Page not found', 'authentic');

    } elseif (is_page()) {
      $title = get_the_title();
    }

    if (isset($title)) {
      if (isset($subtitle)) {
        echo '<p class="sub-title">' . $subtitle . '</p>';
      }
      echo '<h1>' . $title . '</h1>';
    }

  }
}

/**
 *  Add responsive container to embeds, except for Instagram
 */

function authentic_embed_html( $html ) {
  if (strpos($html,'instagram') == false && strpos($html,'twitter-tweet') == false) {
    return '<div class="embed embed-responsive embed-responsive-16by9">' . $html . '</div>';
  }
  else {
    return $html;
  }
}

add_filter( 'embed_oembed_html', 'authentic_embed_html', 10, 3 );

/**
 * Get locale for using in Facebook SDK
 */

if ( ! function_exists( 'authentic_get_locale' ) ) {
  function authentic_get_locale() {

    $authentic_locale = get_locale();

    if( preg_match( '#^[a-z]{2}\-[A-Z]{2}$#', $authentic_locale ) ) {
      $authentic_locale = str_replace( '-', '_', $authentic_locale );
    } elseif ( preg_match( '#^[a-z]{2}$#', $authentic_locale ) ) {
      $authentic_locale .= '_'. mb_strtoupper( $authentic_locale, 'UTF-8' );
    }

    if ( empty( $authentic_locale ) ) {
      $authentic_locale = 'en_US';
    }

    return $authentic_locale;

  }
}

/**
 * Post Category
 */

if ( ! function_exists( 'the_post_category' ) ) {
  function the_post_category( $post_id = '' ) {
    if (get_theme_mod('authentic_meta_category', true) == true) {
      if ( '' !== $post_id ) {
        the_category( '', '', $post_id );
      } else {
        the_category();
      }
    }
  }
}

/**
 * Post Date
 */

if ( ! function_exists( 'the_post_date' ) ) {
  function the_post_date($tag = 'span', $compact = false) {
    if (get_theme_mod('authentic_meta_date', true) == true) { ?>
      <<?php echo $tag; ?> class="meta-date">
        <time class="entry-date published updated" datetime="<?php the_date('c'); ?>">
          <?php if ( $compact == false ) {
            echo get_the_date();
          } else {
            echo get_the_date('d.m.y');
          } ?>
        </time>
      </<?php echo $tag; ?>>
    <?php }
  }
}

/**
 * Post Author
 */

if ( ! function_exists( 'the_post_author' ) ) {
  function the_post_author($tag = 'span', $compact = false) {
    if (get_theme_mod('authentic_meta_author',true) == true) { ?>
      <<?php echo $tag; ?> class="meta-author author vcard">
        <?php if ( $compact == false ) { ?><span><?php _e('by', 'authentic'); ?></span><?php } ?>
				<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
					<?php the_author(); ?>
				</a>
      </<?php echo $tag; ?>>
    <?php }
  }
}

/**
 * Post Comments Count
 */

if ( ! function_exists( 'the_post_comments_count' ) ) {
  function the_post_comments_count($tag = 'span', $compact = false) {
    if (get_theme_mod('authentic_meta_comments',true) == true) { ?>
      <<?php echo $tag; ?> class="meta-comments">
        <?php if ( $compact == true ) { ?><i class="icon icon-speech-bubble"></i><?php } ?>
        <?php if ( $compact == false ) {
            comments_popup_link(esc_html__('No comments','authentic'), esc_html__('One comment','authentic'), '% ' . esc_html__('comments','authentic'), 'comments-link', '');
          } else {
            comments_popup_link('0', '1', '%', 'comments-link', '');
          } ?>
      </<?php echo $tag; ?>>
    <?php }
  }
}

/**
 * Post Reading Time
 */

if ( ! function_exists( 'the_post_reading_time' ) ) {
  function the_post_reading_time($tag = 'span', $compact = false) {
    if ( get_theme_mod('authentic_meta_reading_time',true) == true) {
      $post_content = get_post_field('post_content', get_the_ID());
      $strip_shortcodes = strip_shortcodes($post_content);
      $strip_tags = strip_tags($strip_shortcodes);
      $word_count = str_word_count($strip_tags);
      $reading_time = ceil($word_count / 250); ?>
      <<?php echo $tag; ?> class="meta-reading-time">
        <?php if ( $compact == true ) { ?><i class="icon icon-clock"></i><?php } ?>
        <?php echo $reading_time;?>
        <?php if ($compact == false ) { ?><span> <?php esc_html_e('minute read', 'authentic'); ?></span><?php } ?>
      </<?php echo $tag; ?>>
    <?php }
  }
}

/**
 * Post Views
 */

if ( ! function_exists( 'the_post_views' ) ) {
  function the_post_views($tag = 'span', $compact = false) {
    if ( function_exists('postviews_round_number') && get_theme_mod('authentic_meta_views',true) == true) { ?>
      <<?php echo $tag; ?> class="meta-views">
        <?php if ( $compact == true ) { ?><i class="icon icon-eye"></i><?php } ?>
        <?php $postviews = intval( get_post_meta( get_the_ID(), 'views', true ) ); ?>
        <?php echo postviews_round_number($postviews); ?>
        <?php if ( $compact == false ) { ?> <?php esc_html_e('views', 'authentic'); ?><?php } ?>
      </<?php echo $tag; ?>>
    <?php }
  }
}

/**
 * Post Meta
 */

if ( ! function_exists( 'the_post_meta' ) ) {
  function the_post_meta( $meta, $compact = false, $class = '' ) {
    if ( !empty($meta) ) {
      if ($class !== '') { $class = ' float-xs-right'; }
      echo '<ul class="post-meta'. $class .'">';
      foreach ( $meta as $meta_function ) {
        $meta_function = "the_post_$meta_function";
        $meta_function( 'li', $compact );
      }
      echo '</ul>';
    }
  }
}

/**
 * List Social Accounts
 */

if ( ! function_exists( 'the_icon_list' ) ) {
  function the_icon_list($links = array(), $element = 'li', $class = '', $label = false) {
    if ($links) { ?>
      <?php foreach ($links as $link) {
        $text = $link['text'];
        $type = $link['type'];
        $url = $link['url'];
        if ($url !== '') { ?>
        <<?php echo $element;?><?php if ($class !== '') { ?> class="<?php echo $class; ?>"<?php } ?>>
          <a href="<?php echo esc_url($url); ?>">
            <i class="icon icon-<?php echo esc_html($type); ?>"></i>
            <?php if ($label == true && $text !== '') { ?>
              <span><?php echo esc_html($text); ?></span>
            <?php } ?>
          </a>
        </<?php echo $element;?>>
        <?php } ?>
      <?php } ?>
    <?php }
  }
}

/**
 * Post Author's Accounts List
 */

if ( ! function_exists( 'the_author_accounts_list' ) ) {
  function the_author_accounts_list() {
    foreach (csco_social_accounts() as $account => $name) {
      $author_accounts[] = array (
        'url' => get_the_author_meta($account),
        'text' => $name,
        'type' => $account,
      );
    } ?>
    <ul class="list-social list-social-compact post-author-social"><?php the_icon_list($author_accounts, 'li', '', true); ?></ul>
    <?php
  }
}

/**
 * Share Buttons
 */

if ( ! function_exists( 'the_share_buttons' ) ) {
  function the_share_buttons($type = 'horizontal', $title = false, $url = '', $post_title = '') {

    if ($url == '') {
      $url = get_permalink();
      $url = urlencode($url);
    }
    if ($post_title == '') {
      $post_title = get_the_title();
      $post_title = urlencode($post_title);
    } ?>

    <div class="post-share post-share-<?php echo $type; ?>">
      <?php if ($title == true) { ?>
      <h6 class="title-share"><?php esc_html_e('Share','authentic');?></h6>
      <?php } ?>
      <ul class="share-buttons">
        <li><a target="_blank" rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?php echo $url ;?>"><i class="icon icon-facebook"></i></a></li><li><a target="_blank" rel="nofollow" href="https://twitter.com/share?text=<?php echo $post_title;?>&amp;url=<?php echo $url ;?>"><i class="icon icon-twitter"></i></a></li><li><a target="_blank" rel="nofollow" href="https://pinterest.com/pin/create/bookmarklet/?media=<?php the_post_thumbnail_url(); ?>&amp;url=<?php echo $url ;?>"><i class="icon icon-pinterest"></i></a></li>
      </ul>
    </div>

  <?php }
}

/**
 * Previous and Next Posts
 */

if ( ! function_exists( 'the_prev_next_posts' ) ) {
  function the_prev_next_posts() {

    $previous_post = get_previous_post();
    $next_post = get_next_post();

    if (!empty( $previous_post ) || !empty( $next_post )) { ?>

    <div class="posts-pagination">

      <?php if (!empty( $previous_post )) { ?>
        <article <?php post_class('post-pagination post-previous'); ?>>
          <a href="<?php echo get_permalink( $previous_post->ID ); ?>" class="post-pagination-title"><?php _e('Previous Article','authentic');?></a>
          <div class="post-pagination-content">
            <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($previous_post->ID), 'square'); ?>
            <div class="overlay" style="background-image: url(<?php echo $thumbnail[0]; ?>)">
              <div class="overlay-container">
                <div class="overlay-content">
                  <?php the_post_category( $previous_post->ID ); ?>
                  <h3><?php echo get_the_title($previous_post->ID); ?></h3>
                  <?php the_read_more(get_permalink( $previous_post->ID ), 'btn btn-primary btn-effect', 'arrow-right');?>
                </div>
              </div>
              <a href="<?php echo get_permalink( $previous_post->ID ); ?>" class="overlay-link"></a>
            </div>
          </div>
        </article>
      <?php } ?>

      <?php if (!empty( $next_post )) { ?>
        <article <?php post_class('post-pagination post-next'); ?>>
          <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="post-pagination-title"><?php _e('Next Article','authentic');?></a>
          <div class="post-pagination-content">
            <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID), 'square'); ?>
            <div class="overlay" style="background-image: url(<?php echo $thumbnail[0]; ?>)">
              <div class="overlay-container">
                <div class="overlay-content">
                  <?php the_post_category( $next_post->ID ); ?>
                  <h3><?php echo get_the_title($next_post->ID); ?></h3>
                  <?php the_read_more(get_permalink( $next_post->ID ), 'btn btn-primary btn-effect', 'arrow-right');?>
                </div>
              </div>
              <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="overlay-link"></a>
            </div>
          </div>
        </article>
      <?php } ?>

    </div>

  <?php }

  }
}

/**
 * The Read More Button
 */

if ( ! function_exists( 'the_read_more' ) ) {
  function the_read_more($url = '', $class = '', $icon = '') {

    if ($url == '') {
      $url = get_permalink();
    }

    if ($class == '') {
      $class = 'link-more';
    }

    ?>

    <div class="post-more">
      <a href="<?php echo $url; ?>" class="<?php echo esc_html($class); ?>">
        <span><?php esc_html_e('View Post','authentic');?></span>
        <?php if ($icon !== '') { ?>
          <span><i class="icon icon-<?php echo $icon; ?>"></i></span>
        <?php } ?>
      </a>
    </div>

    <?php
  }
}

/**
 * Display Post Count in Archive Pages
 */

if ( ! function_exists( 'the_post_count' ) ) {
  function the_post_count() {
    global $wp_query;
    if (is_archive()) { ?>
      <div class="post-count"><span><?php echo $wp_query->found_posts; ?></span> <?php esc_html_e('posts','authentic'); ?></div>
    <?php }
  }
}

/**
 * is_subcategory()
 */

if ( ! function_exists( 'is_subcategory' ) ) {
  function is_subcategory( $cat_id = null ) {

    if ( !$cat_id ) {
      $cat_id = get_query_var( 'cat' );
    }

    if ( $cat_id ) {

      $cat = get_category( $cat_id );
      if ( $cat->category_parent > 0 ) {
        return true;
      }
    }

    return false;
  }
}

/**
 * The Category Title
 */

if ( ! function_exists( 'the_category_title' ) ) {
  function the_category_title() {

    if ( is_category() ) {

      $count = count( get_categories( array('parent' => 0, 'hide_empty' => 0) ) );

      if ( $count > 1 && !is_subcategory() ) {

        $current = get_category( get_query_var('cat') );
        $current_id = $current->term_id; ?>

        <ul class="list-categories">
          <?php wp_list_categories(array('echo' => true, 'current_category' => $current_id, 'title_li' => '', 'order' => 'DESC', 'depth' => 1 )); ?>
        </ul>

      <?php } else {

        the_page_title();

      }

      if ( category_description() ) {
      	?>
      	<div class="category-description">
      		<?php echo category_description(); ?>
      	</div>
      	<?php
      }

    }
  }
}

/**
 * The Related Posts
 */

if ( ! function_exists( 'the_related_posts' ) ) {
  function the_related_posts() {

    $post_id = get_the_ID();

    $categories = get_the_category($post_id);
    if ($categories) {

      $category_ids = array();
      foreach($categories as $category) $category_ids[] = $category->term_id;
      $related_args = array(
        'category__in'     => $category_ids,
        'post__not_in'     => array($post_id),
        'posts_per_page'   => 5,
        'orderby' => 'rand'
      );
      $related = new WP_Query( $related_args );

      if ( $related->have_posts() && $related->post_count >= 3) { ?>

        <div class="posts-related post-archive">
          <div class="post-archive-related">
            <h3 class="title-related" ><?php esc_html_e('You May also Like','authentic');?></h3>

            <div class="owl-container owl-loop" data-slides="3">
              <div class="owl-carousel">
              <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                <div class="owl-slide">
                  <article <?php post_class('post-related post-list'); ?>>
                    <?php if ( has_post_thumbnail() ) { ?>
                      <div class="post-thumbnail">
                        <?php the_post_thumbnail('list'); ?>
                        <?php the_read_more(); ?>
                        <?php the_post_meta(array('reading_time', 'views'), true); ?>
                        <a href="<?php the_permalink();?>"></a>
                      </div>
                    <?php } ?>
                    <h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
                  </article>
                </div>
              <?php endwhile; ?>
              </div>
              <div class="owl-dots"></div>
            </div>

          </div>
        </div>

        <?php wp_reset_postdata(); ?>

      <?php }
    }
  }
}

/**
 * Instagram
 */

function authentic_instagram_link_class() {
  return 'btn btn-secondary';
}

add_filter( 'wpiw_link_class', 'authentic_instagram_link_class' );

/**
 * Multipage Post Pagination
 */

function authentic_wp_link_pages($args){
  if($args['next_or_number'] == 'next_and_number'){
    global $page, $numpages, $multipage, $more, $pagenow;
    $args['next_or_number'] = 'number';
    $prev = '';
    $next = '';
    if ( $multipage ) {
      if ( $more ) {
        $i = $page - 1;
        if ( $i && $more ) {
          $prev .= _wp_link_page($i);
          $prev .= $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>';
        }
        $i = $page + 1;
        if ( $i <= $numpages && $more ) {
          $next .= _wp_link_page($i);
          $next .= $args['link_before']. $args['nextpagelink'] . $args['link_after'] . '</a>';
        }
      }
    }
    $args['before'] = $args['before'].$prev;
    $args['after'] = $next.$args['after'];
  }
  return $args;
}

add_filter('wp_link_pages_args','authentic_wp_link_pages');
