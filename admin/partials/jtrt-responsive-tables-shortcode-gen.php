<?php 

function jtrt_shortcode_table( $atts ){
	global $wpdb;
	$jtrt_settings = shortcode_atts( array(
        'id' => ''
    ), $atts );
	$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
	$retrieve_data = $wpdb->get_results( "SELECT * FROM $jtrt_tables_name WHERE jttable_IDD = " . $jtrt_settings['id'] );
    
    if($retrieve_data){   
       ob_start();
	   return html_entity_decode(stripslashes($retrieve_data[0]->object_type));
       return ob_get_clean();
    }else{
        echo "<strong>Oops, Looks like something went wrong,</strong><br/>Unfortunately the table you were looking for has not been found on the server, Please double check that you have the correct table ID set for the shortcode.";
    }

}

add_shortcode( 'jtrt_tables', 'jtrt_shortcode_table' );

?>