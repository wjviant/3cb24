<?php
/**
 * Wiki archive for 3cb24 theme
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
			$terms = get_terms([
				'taxonomy' => 'epkb_post_type_1_category',
				'order'    => 'asc',
				'orderby'  => 'name',
				'parent'   => 0,
			]);
			if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) { ?>
					<div class="wikiCategory four columns padded white">
						<h3><?php echo esc_html( $term->name ); //echo ' - ID:'; echo $term->term_id; ?> </h3>
						<p><?php //echo esc_html( $term->description );?> </p>
						<?php
						// Get subcategories in this category
						$subCats = get_terms([
							'taxonomy' => 'epkb_post_type_1_category',
							'order'    => 'asc',
							'orderby'  => 'name',
							'parent'   => $term->term_id,
						]);
						
						// Build array of cats to exclude from top level list
						$categoriesToExclude = array();
						foreach ($subCats as $subCat) {
							$categoriesToExclude[] = $subCat->term_id;
						}
						
						$excludes = implode(', ', $categoriesToExclude);
						
						// Get posts in this category
						$args = [
							'post_type' => 'epkb_post_type_1',
							'tax_query' => array(
								array(
									'taxonomy' => 'epkb_post_type_1_category',
									'field'    => 'id',
									'terms'    => $term->term_id,
									'category__not_in' => $excludes,
									'include_children' => false,
								),
							),
							'posts_per_page'   => -1,
							
						];
						// var_dump($args);
						// var_dump($excludes);
						$query = new WP_Query( $args ); ?>
						<ul class="wikiDocs">
						<?php while ( $query->have_posts() ) {
							$query->the_post();
							?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
							<?php
						}
						wp_reset_query();
						?>
						</ul>
						<!-- Subcategories -->
						<?php 
						if ( !empty( $subCats ) && !is_wp_error( $subCats ) ) { ?>
							<ul class="wikiSubcats">
							<?php foreach ( $subCats as $subCat ) { ?>
								<li class="largeText"><a href="<?php echo get_term_link( $subCat ); ?>"><?php echo esc_html( $subCat->name ); //echo ' - ID:'; echo esc_html( $subCat->term_id ); ?></a></li>
							<?php } ?>
							</ul>
						<?php } ?>
					</div>
					<?php
				}
			}
		?>
	</div>
</div>
<?php get_footer(); ?>