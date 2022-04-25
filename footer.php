<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Honey_Oat
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-menus">
				<nav id="footer-navigation" class="footer-navigation">
					<?php
						wp_nav_menu( array( 'theme_location' => 'footer' ) );
					?>
				</nav>
				

		</div><!-- .footer-menus -->
		<div class="site-info">
			<p>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'honey-oat' ), 'honey-oat', '<a href="https://honeyoat.bcitwebdeveloper.ca/">FWD29</a>' );
				?>
				<br />
				<?php
				/* translators: 1: Team name, 2: Team member. */
				printf( esc_html__( 'Team Honey Oat: %1$s, %2$s, %3$s, %4$s.', 'honey-oat' ), '<a href="https://xlcoding.com/">Amy</a>', '<a href="https://bhuang.ca/">Ben</a>', '<a href="https://omerakdogan.com/">Omer</a>', '<a href="https://jschoi.ca/">James</a>' );
				?>
			</p>
			<nav class="social-navigation">
					<?php
						wp_nav_menu( array( 'theme_location' => 'social') );
					?>
			</nav>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
