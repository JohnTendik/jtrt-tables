<?php 

function jtrt_shortcode_table( $atts ){
	global $wpdb;
	$jtrt_settings = shortcode_atts( array(
        'id' => ''
    ), $atts );
	$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
	$retrieve_data = $wpdb->get_results( "SELECT * FROM $jtrt_tables_name WHERE jttable_IDD = " . $jtrt_settings['id'] );
    
    if($retrieve_data){ 
       $get_post_meta = get_post_meta($jtrt_settings['id'], 'jtrt_general_settings');
       $post_title_setting = (isset($get_post_meta[0]['showTitle']) ? $get_post_meta[0]['showTitle'] : null);
       $htmlContent = "";
       if($post_title_setting !== null && $post_title_setting === "true"){
          $htmlContent .="<h2 style='text-align:". (isset($get_post_meta[0]['titlePos']) ? $get_post_meta[0]['titlePos'] : "Left") .";'>".$retrieve_data[0]->jttable_name."</h2>";
       }
       ob_start();

       // Check if breakpoints is set
       $custom_bp_jtrt = "";
       if(isset($get_post_meta[0]['hiddenCols'])){
            $custom_bp_jtrt = $get_post_meta[0]['hiddenCols'];
       }

       echo "<p><input name='' id='jtrt_hidden_tableBP".$jtrt_settings['id']."' type='hidden' value='".$custom_bp_jtrt."'></p>";
	   echo html_entity_decode(stripslashes($retrieve_data[0]->object_type));
       $htmlContent .= ob_get_clean();
       if(strpos($retrieve_data[0]->jttable_styles, 'example') !== false){
           $jtrt_example_style = explode(",",$retrieve_data[0]->jttable_styles);
           $htmlContent = str_replace("jtrt_table_creator","jtrt_table_creator jtrt_".$jtrt_settings['id']."_exStyle_".$jtrt_example_style[1],$htmlContent);
       }
       wp_enqueue_style( 'jtrt-table-styles-public' );
       $file = WP_PLUGIN_DIR . '/jtrt-responsive-tables/dist/public/css/jtrt_custom_styles.css';
       $current = file_get_contents($file);
        // Append a new person to the file
        $current .= jtrt_custom_styler($retrieve_data);
        // Write the contents back to the file
        file_put_contents($file, $current);
       wp_enqueue_style( "jtrt-table-custom-styles-public" );
       wp_enqueue_script( "jtrt-table-vendor-scripts" );
	   wp_enqueue_script( "jtrt-table-scripts" );
       return do_shortcode($htmlContent);
       
        

    }else{
        echo "<div class='jtrt_error_message'><strong>Oops, Looks like something went wrong,</strong><br/>Unfortunately the table you were looking for has not been found on the server, Please double check that you have the correct table ID set for the shortcode.</div>";
        return "error:cannotLocateTable";
    }

}

add_shortcode( 'jtrt_tables', 'jtrt_shortcode_table' );

?>