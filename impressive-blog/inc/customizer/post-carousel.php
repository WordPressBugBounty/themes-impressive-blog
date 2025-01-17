<?php
/**
 * Post Carousel Section
 *
 * @package Impressive_Blog
 */

$wp_customize->add_section(
	'impressive_blog_post_carousel_section',
	array(
		'panel'    => 'city_blog_front_page_options',
		'title'    => esc_html__( 'Post Carousel Section', 'impressive-blog' ),
		'priority' => 15,
	)
);

// Post Carousel Section - Enable Section.
$wp_customize->add_setting(
	'impressive_blog_enable_post_carousel_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'city_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new City_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'impressive_blog_enable_post_carousel_section',
		array(
			'label'    => esc_html__( 'Enable Post Carousel Section', 'impressive-blog' ),
			'section'  => 'impressive_blog_post_carousel_section',
			'settings' => 'impressive_blog_enable_post_carousel_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'impressive_blog_enable_post_carousel_section',
		array(
			'selector' => '#impressive_blog_post_carousel_section .section-link',
			'settings' => 'impressive_blog_enable_post_carousel_section',
		)
	);
}

// Post Carousel Section - Section Title.
$wp_customize->add_setting(
	'impressive_blog_post_carousel_title',
	array(
		'default'           => __( 'Post Carousel', 'impressive-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'impressive_blog_post_carousel_title',
	array(
		'label'           => esc_html__( 'Section Title', 'impressive-blog' ),
		'section'         => 'impressive_blog_post_carousel_section',
		'settings'        => 'impressive_blog_post_carousel_title',
		'type'            => 'text',
		'active_callback' => 'impressive_blog_is_post_carousel_section_enabled',
	)
);

// Post Carousel Section - Content Type.
$wp_customize->add_setting(
	'impressive_blog_post_carousel_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'city_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'impressive_blog_post_carousel_content_type',
	array(
		'label'           => esc_html__( 'Select Content Type', 'impressive-blog' ),
		'section'         => 'impressive_blog_post_carousel_section',
		'settings'        => 'impressive_blog_post_carousel_content_type',
		'type'            => 'select',
		'active_callback' => 'impressive_blog_is_post_carousel_section_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'impressive-blog' ),
			'category' => esc_html__( 'Category', 'impressive-blog' ),
		),
	)
);

for ( $i = 1; $i <= 4; $i++ ) {
	// Post Carousel Section - Select Post.
	$wp_customize->add_setting(
		'impressive_blog_post_carousel_content_post_' . $i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'impressive_blog_post_carousel_content_post_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Select Post %d', 'impressive-blog' ), $i ),
			'section'         => 'impressive_blog_post_carousel_section',
			'settings'        => 'impressive_blog_post_carousel_content_post_' . $i,
			'active_callback' => 'impressive_blog_is_post_carousel_section_and_content_type_post_enabled',
			'type'            => 'select',
			'choices'         => city_blog_get_post_choices(),
		)
	);

}

// Post Carousel Section - Select Category.
$wp_customize->add_setting(
	'impressive_blog_post_carousel_content_category',
	array(
		'sanitize_callback' => 'city_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'impressive_blog_post_carousel_content_category',
	array(
		'label'           => esc_html__( 'Select Category', 'impressive-blog' ),
		'section'         => 'impressive_blog_post_carousel_section',
		'settings'        => 'impressive_blog_post_carousel_content_category',
		'active_callback' => 'impressive_blog_is_post_carousel_section_and_content_type_category_enabled',
		'type'            => 'select',
		'choices'         => city_blog_get_post_cat_choices(),
	)
);
