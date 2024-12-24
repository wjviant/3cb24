<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<span class="total">
		<a href="<?php bloginfo('url'); ?>/cart/">
			<?php echo WC()->cart->get_cart_contents_count(); ?> - 
			<?php echo WC()->cart->get_cart_subtotal(); ?>
		</a>
	</span>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<span class="buttons">
		<?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
	</span>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
