<?php
/*
Template Name: Order Page
*/
?>
<?php get_header(); ?>
	<div id="content" class="clear">
		<div class="container">
			<div class="twelve columns">
				
				<h1>Shop listing</h1>
				
				<h2>Phones</h2>
				<ul class="products">
	<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 12,
			'product_cat' => 'phones'
			);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
			
				//wc_get_template_part( 'content', 'product' );
				
				global $product;

				// Ensure visibility.
				if ( empty( $product ) || false === wc_get_loop_product_visibility( $product->get_id() ) || ! $product->is_visible() ) {
					return;
				}
				?>
				<li <?php wc_product_class( '', $product ); ?>>
					<?php
					/**
					 * Hook: woocommerce_before_shop_loop_item.
					 *
					 * @hooked woocommerce_template_loop_product_link_open - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item' );
				
					/**
					 * Hook: woocommerce_before_shop_loop_item_title.
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				
					/**
					 * Hook: woocommerce_shop_loop_item_title.
					 *
					 * @hooked woocommerce_template_loop_product_title - 10
					 */
					do_action( 'woocommerce_shop_loop_item_title' );
				
					/**
					 * Hook: woocommerce_after_shop_loop_item_title.
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
					
					
					// Get the attibutes
					echo $field_groups;
				
					/**
					 * Hook: woocommerce_after_shop_loop_item.
					 *
					 * @hooked woocommerce_template_loop_product_link_close - 5
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item' );
					?>
				</li>
				
			<?php	
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>
</ul><!–/.products–>
				
				
				<h2 class="clear">Laptops</h2>
				<ul class="products">
	<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 12,
			'product_cat' => 'laptops'
			);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
			
				//wc_get_template_part( 'content', 'product' );
				
				global $product;

				// Ensure visibility.
				if ( empty( $product ) || false === wc_get_loop_product_visibility( $product->get_id() ) || ! $product->is_visible() ) {
					return;
				}
				?>
				<li <?php wc_product_class( '', $product ); ?>>
					<?php
					/**
					 * Hook: woocommerce_before_shop_loop_item.
					 *
					 * @hooked woocommerce_template_loop_product_link_open - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item' );
				
					/**
					 * Hook: woocommerce_before_shop_loop_item_title.
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				
					/**
					 * Hook: woocommerce_shop_loop_item_title.
					 *
					 * @hooked woocommerce_template_loop_product_title - 10
					 */
					do_action( 'woocommerce_shop_loop_item_title' );
				
					/**
					 * Hook: woocommerce_after_shop_loop_item_title.
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
				
					/**
					 * Hook: woocommerce_after_shop_loop_item.
					 *
					 * @hooked woocommerce_template_loop_product_link_close - 5
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item' );
					?>
				</li>
				
			<?php	
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>
</ul><!–/.products–>

			</div>
		</div>
	</div>
<?php get_footer(); ?>