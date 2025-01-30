<?php
/**
 * Wiki homepage for 3cb24 theme
 *
 * @package tcb24
 */

get_header(); ?>
<div id="tcbWiki">
	<div class="blogBanner banners">
	<?php
		$page_for_posts = get_option( 'page_for_posts' );
		echo get_the_post_thumbnail( $page_for_posts, 'large' );
	?>
		<div class="inner">
			<div class="container">
				<div class="twelve columns centre">
					<h1>Information Centre</h1>
					<div id="wikiSearch"><?php get_search_form(); ?></div>
				</div>
			</div>
		</div>
	</div> 
	<div id="tcbWikiContent" class="container">
		<?php
			$terms = get_terms(
				array(
					'taxonomy' => 'epkb_post_type_1_category',
					'order'    => 'asc',
					'orderby'  => 'name',
					'parent'   => 0,
				)
			);
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					?>
					<div class="wiki-category four columns padded white">
						<h3><?php echo esc_html( $term->name ); ?> </h3>
						<?php
						// Get subcategories in this category.
						$sub_cats = get_terms(
							array(
								'taxonomy' => 'epkb_post_type_1_category',
								'order'    => 'asc',
								'orderby'  => 'name',
								'parent'   => $term->term_id,
							),
						);

						// Build array of cats to exclude from top level list.
						$categories_to_exclude = array();
						foreach ( $sub_cats as $sub_cat ) {
							$categories_to_exclude[] = $sub_cat->term_id;
						}
						$excludes = implode( ', ', $categories_to_exclude );

						// Get posts in this category.
						$args  = array(
							'post_type'      => 'epkb_post_type_1',
							'tax_query'      => array(
								array(
									'taxonomy'         => 'epkb_post_type_1_category',
									'field'            => 'id',
									'terms'            => $term->term_id,
									'category__not_in' => $excludes,
									'include_children' => false,
								),
							),
							'posts_per_page' => -1,
						);
						$query = new WP_Query( $args );
						?>
						<ul class="wiki-docs">
						<?php
						while ( $query->have_posts() ) {
							$query->the_post();
							?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
							<?php
						}
						wp_reset_postdata();
						?>
						</ul>
						<!-- sub_categories -->
						<?php
						if ( ! empty( $sub_cats ) && ! is_wp_error( $sub_cats ) ) {
							?>
							<ul class="wiki-subcats">
							<?php foreach ( $sub_cats as $sub_cat ) { ?>
								<li class="largeText"><a href="<?php echo esc_html( get_term_link( $sub_cat ) ) ; ?>"><?php echo esc_html( $sub_cat->name ); ?></a></li>
								<?php
							}
							?>
							</ul>
							<?php
						}
						?>
					</div>
					<?php
				}
			}
			?>
	</div>
</div>
<?php get_footer(); ?>