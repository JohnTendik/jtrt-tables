<?php

function jtrt_meta_box_callback_1( $post ) {
    require_once plugin_dir_path( __FILE__ ) . 'templates/jtrt-responsive-tables-post-meta-1-display.php';		
}

require_once plugin_dir_path( __FILE__ ) . 'jtrt-responsive-tables-shortcode-gen.php';	

?>