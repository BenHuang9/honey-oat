<?php
/**
 * Template Name: Contact Template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Honey_Oat
 */

get_header();
?>

	<main id="primary" class="site-main">

		<h1><?php the_title(); ?></h1>
		
		<h2>Locations</h2>

	<!-- map -->
		<?php if( have_rows('location_info') ): ?>
			<section class="map-contact">
				<section class="map">
					<div class="acf-map" data-zoom="16">
						<?php while ( have_rows('location_info') ) : the_row(); 
							// Load sub field values.
							$location = get_sub_field('location_address');
							$direction = get_sub_field('get_direction');
						?>
						<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
							<p><em><?php echo get_sub_field('location_name');?></em></p>   
							<p><em><?php echo esc_html( $location['address'] );?></em></p>
							<a class="button" href="<?php echo esc_url( $direction['url'] ); ?>" target="_blank" >Get Direction</a>
						</div>
						<?php endwhile; ?>
					</div>
				</section>
				<!-- stores -->
				<section class="stores">
					<?php while ( have_rows('location_info') ) : the_row(); 
						// Load sub field values.
						$location_name 	= get_sub_field('location_name');
						$location_phone = get_sub_field('location_phone');
						$location_hours = get_sub_field('location_hours');
					?>
					<div class="store">
						<h3><?php echo $location_name; ?></h3>
						<h4>Phone:</h4>
						<p><?php echo $location_phone; ?></p>
						<h4>Hours</h4>
						<p><?php echo $location_hours; ?></p>
					</div>
					<?php endwhile; ?>
				</section>
			</section>	
		<?php endif; ?>
	
		<!-- contact -->
		<div class="contact-form">
			<h2>Get in Touch</h2>
			
			<section class="contact">
				<?php echo apply_shortcodes( '[contact-form-7 id="17" title="Get in Touch"]' ); ?>	
			</section>	
		</div>
	</main><!-- #main -->

	<?php

	get_footer();
