<?php

function CheckIfJTRTExists(){
    $currentPage = get_current_screen();
    return ($currentPage->id === "jtrt_tables_post") ? true : false;
}

function jtrt_meta_box_html_callback( $post ) {
    require_once plugin_dir_path( __FILE__ ) . 'templates/jtrt-responsive-tables-post-meta-1-display.php';		
}

require_once plugin_dir_path( __FILE__ ) . 'jtrt-adminClass-shortcode.php';	