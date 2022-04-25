<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
do_action( 'woocommerce_cart_is_empty' );

if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<p class="return-to-shop">
		<a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php
				/**
				 * Filter "Return To Shop" text.
				 *
				 * @since 4.6.0
				 * @param string $default_text Default text.
				 */
				echo esc_html( apply_filters( 'woocommerce_return_to_shop_text', __( 'Return to shop', 'woocommerce' ) ) );
			?>
		</a>
	</p>
    <section class="cart-empty-popular">
			<?php
				$top_selling_products = wc_get_products( array(
					'meta_key' => 'total_sales', 
					'return'   => 'ids', 
					'orderby'  => array( 'meta_value_num' => 'DESC', 'title' => 'ASC' ),
					'limit'	   => '3',
				) );
				if ( $top_selling_products ) {
					?>
					<h2 class="home-h2">Popular Items</h2>
					<?php
					do_action( 'woocommerce_before_shop_loop' );
					woocommerce_product_loop_start();
					foreach ( $top_selling_products as $top_selling_product ) {
						$post_object = get_post( $top_selling_product );
						setup_postdata( $GLOBALS['post'] =& $post_object );
						do_action( 'woocommerce_shop_loop' );
						wc_get_template_part( 'content', 'product' );
					}
					wp_reset_postdata();
					woocommerce_product_loop_end();
					do_action( 'woocommerce_after_shop_loop' );
				} else {
					do_action( 'woocommerce_no_products_found' );
				}
			?>
		</section>
<?php endif; ?>
