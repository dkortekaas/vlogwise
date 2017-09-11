<?php

/**
 * One Click Demo Import
 */

// Import Paths

function authentic_ocdi_import_files() {
	return array(
		array(
			'import_file_name'             => esc_html__('Demo 1', 'authentic'),
			'local_import_file'            => get_template_directory() . '/dist/demo/demo-content.xml',
			'local_import_widget_file'     => get_template_directory() . '/dist/demo/widgets.json',
			'local_import_customizer_file' => get_template_directory() . '/dist/demo/customizer-1.dat',
			'import_preview_image_url'     => 'http://preview.codesupply.co/authentic/dist/img/home-1.jpg',
		),
		array(
			'import_file_name'             => esc_html__('Demo 2', 'authentic'),
			'local_import_file'            => get_template_directory() . '/dist/demo/demo-content.xml',
			'local_import_widget_file'     => get_template_directory() . '/dist/demo/widgets.json',
			'local_import_customizer_file' => get_template_directory() . '/dist/demo/customizer-2.dat',
			'import_preview_image_url'     => 'http://preview.codesupply.co/authentic/dist/img/home-2.jpg',
		),
		array(
			'import_file_name'             => esc_html__('Demo 3', 'authentic'),
			'local_import_file'            => get_template_directory() . '/dist/demo/demo-content.xml',
			'local_import_widget_file'     => get_template_directory() . '/dist/demo/widgets.json',
			'local_import_customizer_file' => get_template_directory() . '/dist/demo/customizer-3.dat',
			'import_preview_image_url'     => 'http://preview.codesupply.co/authentic/dist/img/home-3.jpg',
		),
		array(
			'import_file_name'             => esc_html__('Demo 4', 'authentic'),
			'local_import_file'            => get_template_directory() . '/dist/demo/demo-content.xml',
			'local_import_widget_file'     => get_template_directory() . '/dist/demo/widgets.json',
			'local_import_customizer_file' => get_template_directory() . '/dist/demo/customizer-4.dat',
			'import_preview_image_url'     => 'http://preview.codesupply.co/authentic/dist/img/home-4.jpg',
		),
		array(
			'import_file_name'             => esc_html__('Demo 5', 'authentic'),
			'local_import_file'            => get_template_directory() . '/dist/demo/demo-content.xml',
			'local_import_widget_file'     => get_template_directory() . '/dist/demo/widgets.json',
			'local_import_customizer_file' => get_template_directory() . '/dist/demo/customizer-5.dat',
			'import_preview_image_url'     => 'http://preview.codesupply.co/authentic/dist/img/home-5.jpg',
		),
		array(
			'import_file_name'             => esc_html__('Demo 6', 'authentic'),
			'local_import_file'            => get_template_directory() . '/dist/demo/demo-content.xml',
			'local_import_widget_file'     => get_template_directory() . '/dist/demo/widgets.json',
			'local_import_customizer_file' => get_template_directory() . '/dist/demo/customizer-6.dat',
			'import_preview_image_url'     => 'http://preview.codesupply.co/authentic/dist/img/home-6.jpg',
		),
		array(
			'import_file_name'             => esc_html__('Demo 7', 'authentic'),
			'local_import_file'            => get_template_directory() . '/dist/demo/demo-content.xml',
			'local_import_widget_file'     => get_template_directory() . '/dist/demo/widgets.json',
			'local_import_customizer_file' => get_template_directory() . '/dist/demo/customizer-7.dat',
			'import_preview_image_url'     => 'http://preview.codesupply.co/authentic/dist/img/home-7.jpg',
		),
		array(
			'import_file_name'             => esc_html__('Demo 8', 'authentic'),
			'local_import_file'            => get_template_directory() . '/dist/demo/demo-content.xml',
			'local_import_widget_file'     => get_template_directory() . '/dist/demo/widgets.json',
			'local_import_customizer_file' => get_template_directory() . '/dist/demo/customizer-8.dat',
			'import_preview_image_url'     => 'http://preview.codesupply.co/authentic/dist/img/home-8.jpg',
		),
		array(
			'import_file_name'             => esc_html__('Demo 9', 'authentic'),
			'local_import_file'            => get_template_directory() . '/dist/demo/demo-content.xml',
			'local_import_widget_file'     => get_template_directory() . '/dist/demo/widgets.json',
			'local_import_customizer_file' => get_template_directory() . '/dist/demo/customizer-9.dat',
			'import_preview_image_url'     => 'http://preview.codesupply.co/authentic/dist/img/home-9.jpg',
		),
	);
}

add_filter( 'pt-ocdi/import_files', 'authentic_ocdi_import_files' );

// Assign menus after import

function authentic_ocdi_after_import_setup() {

	$main_menu = get_term_by( 'name', 'Main', 'nav_menu' );
	$categories_menu = get_term_by( 'name', 'Categories', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
		'primary-menu'   => $main_menu->term_id,
		'secondary-menu' => $categories_menu->term_id,
		'footer-menu'    => $categories_menu->term_id,
	));
}

add_action( 'pt-ocdi/after_import', 'authentic_ocdi_after_import_setup' );

/**
 * Define List of Social Accounts
 */

// Mind the csco_ prefix!

if ( ! function_exists( 'csco_social_accounts' ) ) {
	function csco_social_accounts() {
		return array(
			'facebook'    => esc_html__( 'Facebook', 'authentic' ),
			'twitter'     => esc_html__( 'Twitter', 'authentic'),
			'instagram'   => esc_html__( 'Instagram', 'authentic'),
			'youtube'     => esc_html__( 'YouTube', 'authentic'),
			'tumblr'      => esc_html__( 'Tumblr', 'authentic'),
			'pinterest'   => esc_html__( 'Pinterest', 'authentic'),
			'google-plus' => esc_html__( 'Google Plus', 'authentic'),
			'linkedin'    => esc_html__( 'LinkedIn', 'authentic'),
			'skype'       => esc_html__( 'Skype', 'authentic'),
			'pocket'      => esc_html__( 'Pocket', 'authentic'),
			'whatsapp'    => esc_html__( 'WhatsApp', 'authentic'),
			'vimeo'       => esc_html__( 'Vimeo', 'authentic'),
			'dribbble'    => esc_html__( 'Dribbble', 'authentic'),
			'bloglovin'   => esc_html__( 'Bloglovin', 'authentic'),
			'spotify'     => esc_html__( 'Spotify', 'authentic'),
			'behance'     => esc_html__( 'Behance', 'authentic'),
			'rss'         => esc_html__( 'RSS', 'authentic'),
		);
	}
}

/**
 * Add custom user contact methods
 */

function authentic_contacts( $contacts ) {
	$authentic_contacts = csco_social_accounts();
	$contacts = array_merge($contacts, $authentic_contacts);
	return $contacts;
}

add_filter('user_contactmethods','authentic_contacts', 10, 1);

/**
 * Registers an editor stylesheet for the theme.
 */

function authentic_theme_add_editor_styles() {
	add_editor_style(get_template_directory_uri() . '/dist/css/editor-style.min.css');
}

add_action( 'admin_init', 'authentic_theme_add_editor_styles' );

/**
 * Add Dropcap style
 */

// Add Style Select Dropdown

function authentic_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}

add_filter('mce_buttons_2', 'authentic_mce_buttons_2');

// Add Styles to Dropdown

function authentic_mce_before_init_insert_formats( $init_array ) {
	$style_formats = array(
		array(
			'title' => esc_html__('Drop Cap','authentic'),
			'items' => array(
				array(
					'title' => esc_html__('Simple','authentic'),
					'block' => 'p',
					'classes' => 'dropcap dropcap-simple',
					'wrapper' => false,
				),
				array(
					'title' => esc_html__('Bordered','authentic'),
					'block' => 'p',
					'classes' => 'dropcap dropcap-borders',
					'wrapper' => false,
				),
				array(
					'title' => esc_html__('Border Right','authentic'),
					'block' => 'p',
					'classes' => 'dropcap dropcap-border-right',
					'wrapper' => false,
				),
				array(
					'title' => esc_html__('Background Dark','authentic'),
					'block' => 'p',
					'classes' => 'dropcap dropcap-bg-dark',
					'wrapper' => false,
				),
				array(
					'title' => esc_html__('Background Light','authentic'),
					'block' => 'p',
					'classes' => 'dropcap dropcap-bg-light',
					'wrapper' => false,
				),
			),
		),
		array(
			'title' => esc_html__('Lead','authentic'),
			'block' => 'p',
			'classes' => 'lead'
		),
		array(
			'title' => esc_html__('Container','authentic'),
			'items' => array(
				array(
					'title' => esc_html__('Borders','authentic'),
					'items' => array(
						array(
							'title' => esc_html__('Top','authentic'),
							'block' => 'div',
							'classes' => 'content-block block-border-top'
						),
						array(
							'title' => esc_html__('Bottom','authentic'),
							'block' => 'div',
							'classes' => 'content-block block-border-bottom'
						),
						array(
							'title' => esc_html__('Left','authentic'),
							'block' => 'div',
							'classes' => 'content-block block-border-left'
						),
						array(
							'title' => esc_html__('Right','authentic'),
							'block' => 'div',
							'classes' => 'content-block block-border-right'
						),
						array(
							'title' => esc_html__('All','authentic'),
							'block' => 'div',
							'classes' => 'content-block block-border-all'
						),
					),
				),
				array(
					'title' => esc_html__('Background','authentic'),
					'items' => array(
						array(
							'title' => esc_html__('Dark','authentic'),
							'block' => 'div',
							'classes' => 'content-block block-bg block-bg-dark',
						),
						array(
							'title' => esc_html__('Light','authentic'),
							'block' => 'div',
							'classes' => 'content-block block-bg block-bg-light'
						),
					),
				),
				array(
					'title' => esc_html__('Float','authentic'),
					'items' => array(
						array(
							'title' => esc_html__('Left','authentic'),
							'block' => 'div',
							'classes' => 'content-block block-float-left'
						),
						array(
							'title' => esc_html__('Right','authentic'),
							'block' => 'div',
							'classes' => 'content-block block-float-right'
						),
					),
				),
			),
		),
	);
	$init_array['style_formats'] = json_encode( $style_formats );
	return $init_array;
}

add_filter( 'tiny_mce_before_init', 'authentic_mce_before_init_insert_formats' );
