<?php

function impressive_blog_intro_text( $default_text ) {
	$default_text .= sprintf(
		'<div class="notice  notice-info impressive-blog-demo-data"><p class="demo-file-content">%1$s <a href="%2$s" target="_blank">%3$s</a></p></div>',
		esc_html__( 'Demo content files for Impressive Blog Theme.', 'impressive-blog' ),
		esc_url( 'https://docs.ascendoor.com/docs/impressive-blog/getting-started/import-demo-data/' ),
		esc_html__( 'Click here to download demo files.', 'impressive-blog' )
	);
	return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'impressive_blog_intro_text' );

/**
 * OCDI after import.
 */
function impressive_blog_after_import_setup() {
	// Assign menus to their locations.
	$primary_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$social_menu  = get_term_by( 'name', 'Social Menu', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations',
		array(
			'primary' => $primary_menu->term_id,
			'social'  => $social_menu->term_id,
		)
	);

}
add_action( 'ocdi/after_import', 'impressive_blog_after_import_setup' );
