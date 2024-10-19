<?php
/**
 * Theme Customizer
 *
 * @package Impressive_Blog
 */

function impressive_blog_customize_register( $wp_customize ) {

	require get_theme_file_path() . '/inc/customizer/post-carousel.php';

	// Upsell Section.
	$wp_customize->add_section(
		new Impressive_Blog_Upsell_Section(
			$wp_customize,
			'upsell_sections',
			array(
				'title'            => __( 'Impressive Blog Pro', 'impressive-blog' ),
				'button_text'      => __( 'Buy Pro', 'impressive-blog' ),
				'url'              => 'https://ascendoor.com/themes/impressive-blog-pro/',
				'background_color' => '#9e1140',
				'text_color'       => '#fff',
				'priority'         => 0,
			)
		)
	);

}
add_action( 'customize_register', 'impressive_blog_customize_register' );

function impressive_blog_customize_preview_js() {
	wp_enqueue_script( 'impressive-blog-customizer', get_stylesheet_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview', 'city-blog-customizer' ), CITY_BLOG_VERSION, true );
}
add_action( 'customize_preview_init', 'impressive_blog_customize_preview_js' );

function impressive_blog_custom_control_scripts() {
	wp_enqueue_style( 'impressive-blog-custom-controls-css', get_stylesheet_directory_uri() . '/assets/css/custom-controls.css', array( 'city-blog-custom-controls-css' ), '1.0', 'all' );
	wp_enqueue_script( 'impressive-blog-custom-controls-js', get_stylesheet_directory_uri() . '/assets/js/custom-controls.js', array( 'city-blog-custom-controls-js', 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'impressive_blog_custom_control_scripts' );

/*=====================Active Callback=================*/

// Posts Carousel section.
function impressive_blog_is_post_carousel_section_enabled( $control ) {
	return ( $control->manager->get_setting( 'impressive_blog_enable_post_carousel_section' )->value() );
}
function impressive_blog_is_post_carousel_section_and_content_type_post_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'impressive_blog_post_carousel_content_type' )->value();
	return ( impressive_blog_is_post_carousel_section_enabled( $control ) && ( 'post' === $content_type ) );
}
function impressive_blog_is_post_carousel_section_and_content_type_category_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'impressive_blog_post_carousel_content_type' )->value();
	return ( impressive_blog_is_post_carousel_section_enabled( $control ) && ( 'category' === $content_type ) );
}
