<?php
/**
 * This is the template for promotions
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/ 
 *
 * @package Honey_Oat
 */
?>

<?php
if ( function_exists ('have_rows') ):
    if( have_rows('promotions') ):
        while ( have_rows('promotions') ) : the_row();
            $title = get_sub_field('promotion_title');
            $info = get_sub_field('promotion_info');
            // Do something...
            echo '<article>';
            echo '<h3>'.$title.'</h3>';
            echo wp_get_attachment_image( get_sub_field('promotion_image'), 'medium' );
            echo '<p>'.$info.'</p>';
            echo '</article>';
        endwhile;
    endif;
endif;
?>

