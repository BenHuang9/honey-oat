<?php
/**
 * This is the template for homepage parallax
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/ 
 *
 * @package Honey_Oat
 */
?>

<section class="parallax-top">
    <?php
    if ( function_exists ('get_field') ):
        if( get_field('top_image') ):
            echo wp_get_attachment_image(get_field('top_image'), 'full' );
        endif;
    endif;

    if ( function_exists ('get_field') ):
        echo '<article>';
        if( get_field('top_one') ):
            echo '<h3>'.get_field("top_one").'</h3>';
        endif;

        if( get_field('top_two') ):
            echo '<p>'.get_field("top_two").'</p>';
        endif;

        $link = get_field('top_three');
        if (get_field('top_three')) { ?>
            <a class='top_three' href="<?php echo esc_url( $link ); ?>">
                <p>Our Locations</p>
            </a>
        <?php }
        echo '</article>';
    endif;
    ?>
 </section>

