<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-100766070-1', 'auto');
    ga('send', 'pageview');

  </script>
  <!-- Facebook Pixel Code -->
  <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window,document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1983737868576338'); 
  fbq('track', 'PageView');
  </script>
  <noscript>
  <img height="1" width="1" src="https://www.facebook.com/tr?id=1983737868576338&ev=PageView&noscript=1"/>
  </noscript>
  <!-- End Facebook Pixel Code -->
</head>

<body <?php body_class(); ?>>

<?php $facebook_sdk = get_option( 'csco_facebook_sdk', false );
$facebook_app_id = get_option( 'csco_facebook_app_id', '' );

if ( $facebook_sdk == true && $facebook_app_id !== '') { ?>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/<?php echo authentic_get_locale(); ?>/sdk.js#xfbml=1&version=v2.5&appId=<?php echo esc_html($facebook_app_id); ?>";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
<?php } ?>

<header class="site-header">

  <?php if ( get_theme_mod('authentic_header_topbar', true) == true ) { ?>

  <div class="header-navbar-secondary">
    <nav class="navbar navbar-secondary clearfix">
      <div class="container">

        <?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>
          <?php wp_nav_menu( array(
            'menu'              => 'secondary',
            'theme_location'    => 'secondary-menu',
            'menu_class'        => 'nav navbar-nav hidden-sm-down',
            'container'         => '',
            'container_class'   => '',
          )); ?>
        <?php } ?>

        <ul class="nav navbar-nav navbar-icons float-md-right">
          <?php the_icon_list(get_option( 'csco_social_accounts' ), 'li','menu-item'); ?>
        </ul>

      </div>
    </nav>
  </div>

  <?php } ?>

  <?php

  $header_logo_dark_url       = get_theme_mod('authentic_header_logo_dark_url', get_template_directory_uri() . '/dist/img/logo-dark.png');
  $header_logo_light_url      = get_theme_mod('authentic_header_logo_light_url', get_template_directory_uri() . '/dist/img/logo-light.png');
  $mailchimp_general_form_url = get_option('csco_mailchimp_general_form_url', '');
  $subscribe_button           = get_theme_mod('authentic_header_subscribe_button', false);
  $search_button              = get_theme_mod('authentic_header_search_button', true);

  if (is_single() || is_page()) {
    $featured_image_type = _get_field('csco_featured_image_type', get_the_ID(), 'default');
    if ( $featured_image_type == 'default' ) {
      $featured_image_type  = get_theme_mod('authentic_layout_posts_featured_image', 'none');
    }
  }

  if (is_home() && get_theme_mod('authentic_home_featured_type') == 'large') {
    $paged = get_query_var( 'paged' );
    if ($paged == 0) {
      $featured_image_type = 'large';
    }
  }
  ?>

  <div class="header">
    <div class="container">
      <div class="header-content">

        <div class="header-left">
          <button class="navbar-toggle hidden-md-up" type="button" data-toggle="collapse" data-target="#navbar-primary">
            <i class="icon icon-menu"></i>
          </button>
          <?php if ($subscribe_button == true && $mailchimp_general_form_url !== '') { ?>
            <a href="<?php echo esc_url($mailchimp_general_form_url); ?>" class="btn btn-secondary btn-subscribe btn-effect hidden-sm-down" target="_blank">
              <span><?php esc_html_e('Subscribe','authentic'); ?></span>
              <span><i class="icon icon-mail"></i></span>
            </a>
          <?php } ?>
        </div>

        <div class="header-center">
          <?php if( isset($featured_image_type) && $featured_image_type == 'large' && $header_logo_light_url !== '') { ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo">
            <img src="<?php echo esc_url($header_logo_light_url); ?>" alt="<?php bloginfo('name');?>">
          </a>
          <?php } elseif( $header_logo_dark_url !== '' ) { ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo">
            <img src="<?php echo esc_url($header_logo_dark_url); ?>" alt="<?php bloginfo('name');?>">
          </a>
          <?php } ?>
        </div>

        <div class="header-right">
          <?php if ($search_button == true) { ?>
          <a href="#search" class="header-btn-search"><i class="icon icon-search"></i></a>
          <?php } ?>
        </div>

      </div>
    </div>
  </div>

  <div class="header-navbar-primary">
    <div class="container">
      <div class="collapse navbar-toggleable" id="navbar-primary">
        <nav class="navbar navbar-primary">

          <?php

          $navbar_logo            = get_theme_mod('authentic_navbar_logo_select', 'image');
          $navbar_logo_dark_url   = get_theme_mod('authentic_navbar_logo_dark_url', get_template_directory_uri() . '/dist/img/logo-navbar-dark.png');
          $navbar_logo_light_url  = get_theme_mod('authentic_navbar_logo_light_url', get_template_directory_uri() . '/dist/img/logo-navbar-light.png');
          $navbar_logo_text       = get_theme_mod('authentic_navbar_logo_text', get_bloginfo('name')); ?>

          <?php if ( $navbar_logo == 'image' ) { ?>

            <?php if( isset($featured_image_type) && $featured_image_type == 'large' && $navbar_logo_light_url !== '') { ?>
              <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand">
                <img src="<?php echo esc_url($navbar_logo_light_url); ?>" alt="<?php bloginfo('name');?>">
              </a>
            <?php } elseif( $navbar_logo_dark_url !== '' ) { ?>
              <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand">
                <img src="<?php echo esc_url($navbar_logo_dark_url); ?>" alt="<?php bloginfo('name');?>">
              </a>
            <?php } ?>

          <?php } elseif ( $navbar_logo == 'text' && $navbar_logo_text !== '') { ?>

            <a class="navbar-brand navbar-text" href="<?php echo esc_url(home_url('/')); ?>">
              <?php echo esc_html($navbar_logo_text); ?>
            </a>

          <?php } ?>

          <?php if ( has_nav_menu( 'primary-menu' ) ) {
             wp_nav_menu( array(
              'menu'              => 'primary',
              'theme_location'    => 'primary-menu',
              'menu_class'        => 'nav navbar-nav',
              'container'         => '',
              'container_class'   => '',
            )); } ?>

          <a href="#search" class="navbar-search"><i class="icon icon-search"></i></a>
        </nav>
      </div>
    </div>
  </div>

</header>

