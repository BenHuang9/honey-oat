<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	if(is_shop()){
		$terms = get_terms( array('taxonomy' => 'product_cat'));
		?>
		<nav>
		<ul class="food-category">
		<?php
			if($terms && ! is_wp_error($terms) ){
				foreach($terms as $term){
					$args = array(
						'post_type'      => 'product',
						'posts_per_page' => -1,
						'tax_query'      => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => $term->slug,
								)
							),
						);
						
						$query = new WP_Query( $args );
			
			if ( $query -> have_posts() ) {
				$product_cat_id = $term->term_id;
					$query -> the_post();?>
					<li><a href="#<?php echo $product_cat_id; ?>">
						<?php the_post_thumbnail('thumbnail'); ?>
							<p><?php echo $term->name; ?></p>
						</a></li>
				<?php
				wp_reset_postdata();
					}
						
				}
			}
				
			?>
			</ul>
			</nav>
			<?php
		if ( wc_get_loop_prop( 'total' ) ) {
		
			$terms = get_terms( array('taxonomy' => 'product_cat'));
			if($term && ! is_wp_error($terms) ){
				foreach($terms as $term){
					$args = array(
						'post_type'      => 'product',
						'posts_per_page' => -1,
						'tax_query'      => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => $term->slug,
							)
						),
					);
					$product_cat_id = $term->term_id;
					$product_cat_name = $term->name;
					?>
					<section class="<?php echo $term->name; ?>-Section">
					<h2 id="<?php echo $product_cat_id;?>"><?php echo $term->name ?></h2>
					<ul>
					<?php
					$query = new WP_Query( $args );
					if ( $query -> have_posts() ) {
						// Output Term name.
						

						while ( $query -> have_posts() ) {
							$query -> the_post();
						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action( 'woocommerce_shop_loop' );
			
						wc_get_template_part( 'content', 'product' );
						}
						?>
						</ul>
						</section>
						<?php
					}	
				}
			}
		}
	}else{
		woocommerce_product_loop_start();
	
	
		if ( wc_get_loop_prop( 'total' ) ) {
			while ( have_posts() ) {
				the_post();
	
				/**
				 * Hook: woocommerce_shop_loop.
				 */
				do_action( 'woocommerce_shop_loop' );
	
				wc_get_template_part( 'content', 'product' );
			}
		}
		
		woocommerce_product_loop_end();
	}

} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
?>

<button id="scroll-top" class="scroll-top">
					<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M11 2.206l-6.235 7.528-.765-.645 7.521-9 7.479 9-.764.646-6.236-7.53v21.884h-1v-21.883z"/></svg>
			<span class="screen-reader-text">Scroll To Top</span>
		</button>
		<?php
// do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
