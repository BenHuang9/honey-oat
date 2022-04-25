<?php
/**
 * This is the template for testimonials
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/ 
 *
 * @package Honey_Oat
 */
?>

<?php
    $args = array(
        'post_type'      => 'ho-testimonial',
        'orderby'        => 'rand',
        'posts_per_page' => '1'
    );

    $query = new WP_Query( $args );

    if ( $query -> have_posts() ){
        while ( $query -> have_posts() ) {
            $query -> the_post();
            ?>
            <h2>Testimonial</h2>
            <?php
            the_content();
        }
        wp_reset_postdata();
    } 
?>