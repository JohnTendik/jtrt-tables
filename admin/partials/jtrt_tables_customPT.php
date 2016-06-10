<?php

$labels = array(
    'name'                  => _x( 'JTRT Tables', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'JTRT Table', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'JTRT Table', 'text_domain' ),
    'name_admin_bar'        => __( 'JTRT Table', 'text_domain' ),
    'archives'              => __( 'Table Archives', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Table:', 'text_domain' ),
    'all_items'             => __( 'All Tables', 'text_domain' ),
    'add_new_item'          => __( 'Add New Table', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Table', 'text_domain' ),
    'edit_item'             => __( 'Edit Table', 'text_domain' ),
    'update_item'           => __( 'Update Table', 'text_domain' ),
    'view_item'             => __( 'View Table', 'text_domain' ),
    'search_items'          => __( 'Search Table', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into table', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Table', 'text_domain' ),
    'items_list'            => __( 'Tables list', 'text_domain' ),
    'items_list_navigation' => __( 'Tables list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter Tables list', 'text_domain' ),
);
$args = array(
    'label'                 => __( 'JTRT Table', 'text_domain' ),
    'description'           => __( 'Easy tables for display! ', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title', ),
    'hierarchical'          => false,
    'public'                => false,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 75,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => false,
    'can_export'            => true,
    'has_archive'           => false,		
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
);

register_post_type( 'jtrt_tables_post', $args );

?>