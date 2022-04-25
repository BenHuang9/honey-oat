<?php
/**
 * This is the template that displays the homepage
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/ 
 *
 * @package Honey_Oat
 */

get_header();
?>

	<section class="home-banner">
			<?php 
				if ( function_exists ('get_field') ):
					if( get_field('homepage_banner') ):
						echo wp_get_attachment_image(get_field('homepage_banner'), 'full' );
					endif;
				endif;
			?>

		<section class="home-cta">
            <?php
				if (function_exists('get_field')) {

					if (get_field('cta_logo')) {
						echo wp_get_attachment_image(get_field('cta_logo'), 'medium' );

					}

					if (get_field('cta_message')) {
						echo '<h2>';
							the_field('cta_message');
						echo '</h2>';
					}

					$link = get_field('cta_link');
					if (get_field('cta_link')) { ?>
						<a class='order-online' href="<?php echo esc_url( $link ); ?>">
							<h3>Order Online</h3>
						</a>
					<?php }
				}
			?>
        </section>
	</section><!-- #end-home-banner -->

	<main id="primary" class="site-main front-page">

		<?php
			while ( have_posts() ) :
				the_post();
		?>

		<section class="home-extra-info">
			<?php
				if ( function_exists ('have_rows') ):
					if( have_rows('extra_info') ):
						while ( have_rows('extra_info') ) : the_row();
							$title = get_sub_field('extra_title');
							$info = get_sub_field('extra_content');
							// Do something...
							echo '<article>';
							echo '<h4>'.$title.'</h4>';
							echo '<p>'.$info.'</p>';
							echo '</article>';
						endwhile;
					endif;
				endif;
			?>
		</section>

		<section class="home-parallax">
			<?php get_template_part( 'template-parts/home-parallax'); ?>
		</section>

		<div class="home-parallax-background">
			<section class="parallax-bottom">
				<?php
				if ( function_exists ('get_field') ):
					echo '<article>';
					if( get_field('bottom_one') ):
						echo '<h3>'.get_field("bottom_one").'</h3>';
					endif;

					if( get_field('bottom_two') ):
						echo '<p>'.get_field("bottom_two").'</p>';
					endif;

					if (get_field('bottom_three')) {
						echo '<p>'.get_field("bottom_three").'</p>';

					}
					echo '</article>';
				endif;
				?>
			</section>
		</div>

        <section class="home-promotions with-margin">
            <h2 class="home-h2">Promotions</h2>
			
			<section class="promotion-items">
				<?php get_template_part( 'template-parts/promotions'); ?>
			</section>
        </section>

        <section class="home-popular with-margin">
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

		<section class="home-about">
			<?php 
				if ( function_exists ( 'get_field' ) ) {
					if ( get_field( 'our_story' ) ) {
							the_field( 'our_story' );
					}
				}
			?>
        </section>

        <section class="home-testimonials with-margin">
			<?php get_template_part( 'template-parts/testimonials' ); ?>
		</section>
		<?php if( have_rows('location_info', 44) ): ?>
    		<div class="acf-map" data-zoom="16">
        <?php while ( have_rows('location_info', 44) ) : the_row(); 
            // Load sub field values.
            $location = get_sub_field('location_address', 44);
			$direction = get_sub_field('get_direction');
            ?>
            <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
			<p><em><?php echo get_sub_field('location_name', 44); ?></em></p>   
			<p><em><?php echo esc_html( $location['address'] ); ?></em></p>
			<a class="button" href="<?php echo esc_url( $direction['url'] ); ?>" target="_blank" >Get Direction</a>
            </div>
    	<?php endwhile; ?>
    		</div>
		<?php endif; ?>

		<?php endwhile; ?>
	</main><!-- #primary -->

<?php
get_footer();