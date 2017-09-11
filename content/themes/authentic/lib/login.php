<?php


// Add custom login logo
if ( ! function_exists( 'authentic_login_logo' ) ) :
function authentic_login_logo() {
    $css = '<style type="text/css">';
        $css.= '.login{background-color:#18222a !important;}';
        $css.= '.login #backtoblog a,.login #nav a{color:#a9a9a9 !important;}';
        $css.= '.wp-core-ui .button-primary{background:#378ec9 !important;border-color:#378ec9 !important;-webkit-box-shadow:0 1px 0 #378ec9 !important;box-shadow:0 1px 0 #378ec9 !important;text-shadow: 0 -1px 1px #378ec9, 1px 0 1px #378ec9, 0 1px 1px #378ec9, -1px 0 1px #378ec9 !important;}';
        $css.= '.login #login_error, .login .message{border-left: 4px solid #378ec9 !important;}';
        $css.= '.login #nav{width: auto;float:right;padding:25px 5px 0 0 !important;margin:0 !important;}';
        $css.= '.login #backtoblog{width:auto;float:left;padding:25px 0 0 5px !important;margin:0 !important;}';
        $css.= '.login #backtoblog a:hover,.login #nav a:hover,.login #backtoblog a:focus,.login #nav a:focus,.login #backtoblog a:active,.login #nav a:active{color: #378ec9 !important;}';
        $css.= '.login h1 a{background-image: url('.get_parent_theme_file_uri('/images/login/weblogiq-logo.svg').') !important;-webkit-background-size:260px !important;background-size:260px !important;width:260px !important;59px !important;}';
        $css.= 'a:focus {-webkit-box-shadow: none !important;box-shadow: none !important;}';
    $css.= '</style>';
    echo $css;
}
add_action( 'login_enqueue_scripts', 'authentic_login_logo' );
endif;

// Add custom login url
if ( ! function_exists( 'authentic_login_logo_url' ) ) :
function authentic_login_logo_url() {
    return "https://weblogiq.nl";
}
add_filter( 'login_headerurl', 'authentic_login_logo_url' );
endif;

// Add custom login url title
if ( ! function_exists( 'authentic_login_logo_url_title' ) ) :
function authentic_login_logo_url_title() {
    return 'Ontwikkeld door internetbureau Weblogiq';
}
add_filter( 'login_headertitle', 'authentic_login_logo_url_title' );
endif;
?>