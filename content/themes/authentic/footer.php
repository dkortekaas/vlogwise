<?php get_template_part('parts/logo-slider'); ?>

<footer class="site-footer">

  <?php

  $mailchimp_embedded_form_url  = get_option('csco_mailchimp_embedded_form_url', '');
  $instagram_username           = get_theme_mod('authentic_footer_instagram_username', '');
  $subscribe_title              = get_theme_mod('authentic_subscribe_title', esc_html__('Subscribe','authentic'));
  $subscribe_message            = get_theme_mod('authentic_subscribe_message', esc_html__('Subscribe now to our newsletter','authentic'));
  $footer_logo_url              = get_theme_mod('authentic_footer_logo_url', get_template_directory_uri() . '/dist/img/logo-footer.png');
  $footer_text                  = get_theme_mod('authentic_footer_text', get_bloginfo('description'));
  $modules                      = get_theme_mod('authentic_footer_arrangement', array('widgets', 'logo'));

  if ( $modules && is_array($modules) ) {

    foreach($modules as $module) {

      // Instagram

      if ($module == 'instagram') {
        if ($instagram_username !== '') { ?>

          <div class="footer-instagram">
            <?php $args = array(
              'username' => $instagram_username,
              'size' => 'small',
              'number' => 6,
              'target' => '_blank',
              'link' => ''
              );
              if (function_exists('wpiw_widget')) {
                the_widget('null_instagram_widget', $args);
              } ?>
          </div>

        <?php }
      }

      // Subscribe

      if ($module == 'subscribe' && $mailchimp_embedded_form_url !== '') { ?>
        <div class="footer-section">
          <div class="container">
            <div class="footer-subscribe">
              <div class="subscribe-container">
                <h2><?php echo esc_html($subscribe_title); ?></h2>
                <p class="subscribe-message"><?php echo esc_html($subscribe_message); ?></p>
                <form method="post" action="<?php echo esc_url($mailchimp_embedded_form_url); ?>">
                  <div class="input-group">
                    <input type="text" name="EMAIL" class="email form-control" placeholder="<?php esc_html_e('Enter your Email here','authentic'); ?>">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-primary btn-effect"><span><?php esc_html_e('Subscribe','authentic');?></span><span><i class="icon icon-mail"></i></span></button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php }

      // Widgets

      if ( $module == 'widgets' && ( is_active_sidebar( 'sidebar-footer-1' ) || is_active_sidebar( 'sidebar-footer-2' ) || is_active_sidebar( 'sidebar-footer-3' ) ) ) { ?>
        <div class="footer-section">
          <div class="container">
            <div class="footer-widgets">
              <div class="footer-sidebars">
                <?php if ( is_active_sidebar( 'sidebar-footer' ) ) { ?>
                  <div class="footer-sidebar">
                    <?php dynamic_sidebar( 'sidebar-footer' ); ?>
                  </div>
                <?php } ?>
                <?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) { ?>
                  <div class="footer-sidebar">
                    <?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
                  </div>
                <?php } ?>
                <?php if ( is_active_sidebar( 'sidebar-footer-3' ) ) { ?>
                  <div class="footer-sidebar">
                    <?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      <?php }

      // Logo & Navbar

      if ($module == 'logo' && ( $footer_logo_url !== '' || $footer_text !== '' || has_nav_menu( 'footer_navigation' ) ) ) { ?>

        <div class="footer-section">
          <div class="container">
            <div class="footer-info">

              <?php if( $footer_logo_url !== '' ) { ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                  <img src="<?php echo esc_url($footer_logo_url); ?>" alt="<?php bloginfo('name');?>">
                </a>
              <?php } ?>

              <?php if ( has_nav_menu( 'footer-menu' ) ) { ?>
                <?php wp_nav_menu( array(
                  'menu'              => 'footer',
                  'theme_location'    => 'footer-menu',
                  'menu_class'        => 'nav navbar-nav',
                  'container'         => 'nav',
                  'container_class'   => 'nav navbar-footer navbar-lonely',
                  'depth'             => 1
                )); ?>
              <?php } ?>

                <div class="footer-copyright">
			            <a href="https://vlogwise.nl/wp-content/uploads/A4-Algemene-voorwaarden-Vlogwise.pdf" title="Algemene Voorwaarden">Algemene voorwaarden</a>
			            <?php echo esc_html($footer_text); ?>
                </div>
                <div class="copyright-info">Copyright © <?php echo date("Y"); ?> VlogWise | <a title="Internetbureau Weblogiq Houten" href="https://weblogiq.nl" target="_blank" rel="nofollow">Weblogiq</a>								</div>
            </div>
          </div>
        </div>

      <?php }
    }
  } ?>

</footer>

<div class="site-search" id="search">
  <button type="button" class="close"></button>
  <div class="form-container">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
          <?php get_search_form(true); ?>
          <p><?php esc_html_e('Input your search keywords and press Enter.','authentic'); ?></p>
        </div>
      </div>
    </div>
  </div>
</div>

<a href="#top" class="scroll-to-top hidden-sm-down"></a>

<?php wp_footer(); ?>
</body>
</html>
