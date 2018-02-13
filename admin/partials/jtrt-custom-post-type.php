<?php

$labels = array(
    'name'                  => _x( 'JTRT Tables', 'Post Type General Name', $this->plugin_name ),
    'singular_name'         => _x( 'JTRT Table', 'Post Type Singular Name', $this->plugin_name ),
    'menu_name'             => __( 'JTRT Table', $this->plugin_name ),
    'name_admin_bar'        => __( 'JTRT Table', $this->plugin_name ),
    'archives'              => __( 'Table Archives', $this->plugin_name ),
    'parent_item_colon'     => __( 'Parent Table:', $this->plugin_name ),
    'all_items'             => __( 'All Tables', $this->plugin_name ),
    'add_new_item'          => __( 'Add New Table', $this->plugin_name ),
    'add_new'               => __( 'Add New', $this->plugin_name ),
    'new_item'              => __( 'New Table', $this->plugin_name ),
    'edit_item'             => __( 'Edit Table', $this->plugin_name ),
    'update_item'           => __( 'Update Table', $this->plugin_name ),
    'view_item'             => __( 'View Table', $this->plugin_name ),
    'search_items'          => __( 'Search Table', $this->plugin_name ),
    'not_found'             => __( 'Not found', $this->plugin_name ),
    'not_found_in_trash'    => __( 'Not found in Trash', $this->plugin_name ),
    'featured_image'        => __( 'Featured Image', $this->plugin_name ),
    'set_featured_image'    => __( 'Set featured image', $this->plugin_name ),
    'remove_featured_image' => __( 'Remove featured image', $this->plugin_name ),
    'use_featured_image'    => __( 'Use as featured image', $this->plugin_name ),
    'insert_into_item'      => __( 'Insert into table', $this->plugin_name ),
    'uploaded_to_this_item' => __( 'Uploaded to this Table', $this->plugin_name ),
    'items_list'            => __( 'Tables list', $this->plugin_name ),
    'items_list_navigation' => __( 'Tables list navigation', $this->plugin_name ),
    'filter_items_list'     => __( 'Filter Tables list', $this->plugin_name ),
);
$args = array(
    'label'                 => __( 'JTRT Table', $this->plugin_name ),
    'description'           => __( 'Easy tables for display! ', $this->plugin_name ),
    'labels'                => $labels,
    'supports'              => array('title'),
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
    'publicly_queryable'    => false,
    'capability_type'       => 'page',
);

register_post_type( 'jtrt_tables_post', $args );

?>