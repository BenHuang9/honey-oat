<?php

function ho_register_custom_post_types() {
    // add Testimonial CPT
    $labels = array(
        'name'               => _x( 'Testimonial', 'post type general name' ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name'),
        'menu_name'          => _x( 'Testimonial', 'admin menu' ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'testimonial' ),
        'add_new_item'       => __( 'Add New Testimonial' ),
        'new_item'           => __( 'New Testimonial' ),
        'edit_item'          => __( 'Edit Testimonial' ),
        'view_item'          => __( 'View Testimonial' ),
        'all_items'          => __( 'All Testimonial' ),
        'search_items'       => __( 'Search Testimonial' ),
        'parent_item_colon'  => __( 'Parent Testimonial:' ),
        'not_found'          => __( 'No testimonial found.' ),
        'not_found_in_trash' => __( 'No testimonial found in Trash.' ),
        'archives'           => __( 'Testimonial Archives'),
        'insert_into_item'   => __( 'Insert into testimonial'),
        'uploaded_to_this_item' => __( 'Uploaded to this testimonial'),
        'filter_item_list'   => __( 'Filter testimonial list'),
        'items_list_navigation' => __( 'Testimonial list navigation'),
        'items_list'         => __( 'Testimonial list'),
        'featured_image'     => __( 'Testimonial featured image'),
        'set_featured_image' => __( 'Set testimonial featured image'),
        'remove_featured_image' => __( 'Remove testimonial featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonial' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title', 'editor' ),
        'template'           => array( array( 'core/quote' ) ),
        'template_lock'      => 'all',
    );
    register_post_type( 'ho-testimonial', $args );
}
add_action( 'init', 'ho_register_custom_post_types' );

function ho_rewrite_flush() {
    ho_register_custom_post_types();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ho_rewrite_flush' );