<?php

function CheckIfJTRTExists(){
    $currentPage = get_current_screen();
    return ($currentPage->id === "jtrt_tables_post") ? true : false;
}

function jtrt_meta_box_html_callback( $post ) {
    require_once plugin_dir_path( __FILE__ ) . 'templates/jtrt-responsive-tables-post-meta-1-display.php';		
}

require_once plugin_dir_path( __FILE__ ) . 'jtrt-adminClass-shortcode.php';	

// functions to display custom columns on our custom post type table
add_filter('manage_jtrt_tables_post_posts_columns', 'bs_event_table_head');
function bs_event_table_head( $defaults ) {
    $defaults['short_code_jt']  = 'Shortcode';
    return $defaults;
}
add_action( 'manage_jtrt_tables_post_posts_custom_column', 'bs_event_table_content', 10, 2 );
function bs_event_table_content( $column_name, $post_id ) {
    if ($column_name == 'short_code_jt') {
      echo "[jtrt_tables id='" . $post_id . "']";
    }
}