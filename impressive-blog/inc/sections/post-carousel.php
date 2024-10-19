<?php
if ( ! get_theme_mod( 'impressive_blog_enable_post_carousel_section', false ) ) {
	return;
}

$content_ids  = array();
$content_type = get_theme_mod( 'impressive_blog_post_carousel_content_type', 'post' );

if ( $content_type === 'post' ) {

	for ( $i = 1; $i <= 4; $i++ ) {
		$content_ids[] = get_theme_mod( 'impressive_blog_post_carousel_content_post_' . $i );
	}

	$args = array(
		'post_type'           => 'post',
		'posts_per_page'      => absint( 4 ),
		'ignore_sticky_posts' => true,
	);
	if ( ! empty( array_filter( $content_ids ) ) ) {
		$args['post__in'] = array_filter( $content_ids );
		$args['orderby']  = 'post__in';
	} else {
		$args['orderby'] = 'date';
	}
} else {
	$cat_content_id = get_theme_mod( 'impressive_blog_post_carousel_content_category' );
	$args           = array(
		'cat'            => $cat_content_id,
		'posts_per_page' => absint( 4 ),
	);
}

$args = apply_filters( 'impressive_blog_post_carousel_section_args', $args );

impressive_blog_render_post_carousel_section( $args );

/**
 * Render Post Carousel Section.
 */
function impressive_blog_render_post_carousel_section( $args ) {
	$section_title = get_theme_mod( 'impressive_blog_post_carousel_title', __( 'Post Carousel', 'impressive-blog' ) );

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
		?>
		<section id="impressive_blog_post_carousel_section" class="impressive-blog-frontpage-section impressive-blog-post-carousel-section">
			<?php
			if ( is_customize_preview() ) :
				impressive_blog_section_link( 'impressive_blog_post_carousel_section' );
			endif;
			?>
			<div class="ascendoor-wrapper">
				<?php if ( ! empty( $section_title ) ) { ?>
					<div class="section-header">
						<h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
						<span class="section-title-icon">
							<?php require get_theme_file_path() . '/assets/svg-icon.svg'; ?>
						</span>
					</div>
				<?php } ?>
				<div class="impressive-blog-section-body">
					<div class="impressive-blog-post-carousel-section-wrapper post-carousel city-blog-carousel-slider-navigation">
						<?php
						while ( $query->have_posts() ) :
							$query->the_post();
							?>
							<div class="carousel-item">
								<div class="mag-post-single has-image">
									<div class="mag-post-img">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>
									</div>
									<div class="mag-post-detail">
										<div class="mag-post-category">
											<?php city_blog_categories_list(); ?>
										</div>
										<h3 class="mag-post-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h3>
										<div class="mag-post-meta">
											<span class="post-author">
												<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fas fa-user"></i><?php echo esc_html( get_the_author() ); ?></a>
											</span>
											<span class="post-date">
												<a href="<?php the_permalink(); ?>"><i class="far fa-clock"></i><?php echo esc_html( get_the_date() ); ?></a>
											</span>
										</div>
									</div>
								</div>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		</section>
		<?php
	endif;
}
