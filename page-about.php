<?php
/**
 * The template for displaying all pages
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
	
	<section>
	<h1><?php the_title(); ?></h1>
	<article class="our-story">
		<?php		
		if ( function_exists ( 'get_field' ) ) {

			if ( get_field( 'our_story' ) ) {
					the_field( 'our_story' );
			}

			?>
	</section>
	
	</article>
	<article class="store-staff">
			<section>	
				<?php
				echo '<h2>Company Founders</h2>';
				echo '<div class="company-founders">';
				if( have_rows('company_founders') ):
					while ( have_rows('company_founders') ) : the_row();
						
						$name= get_sub_field('founder_name');
						// Do something...
						echo '<article>';
						echo wp_get_attachment_image( get_sub_field('founder_photo'), 'medium' );
						echo '<h3>'.$name.'</h3>';
						echo '</article>';
					endwhile;
				endif;
				
				?>
			</section>

			<section>
				<?php
				echo '<h2>Company Managers</h2>';
				echo '<div class="company-managers">';
				if( have_rows('company_manager') ):
					while ( have_rows('company_manager') ) : the_row();
						$name= get_sub_field('manager_name');
						// Do something...
						echo '<article>';
						echo wp_get_attachment_image( get_sub_field('manager_photo'), 'medium' );
						echo '<h3>'.$name.'</h3>';
						echo '</article>';
					endwhile;
				endif;
				echo '</div>';
			}
				?>
			</section>
		</article>
		
        <section class="home-testimonials">
			<?php get_template_part( 'template-parts/testimonials' ); ?>
		</section>

	</main><!-- #main -->

<?php
get_footer();
