<?php 

function jtrt_shortcode_table( $atts ){
	global $wpdb;
	$jtrt_settings = shortcode_atts( array(
        'id' => ''
    ), $atts );
	$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
	$retrieve_data = $wpdb->get_results( "SELECT * FROM $jtrt_tables_name WHERE jttable_IDD = " . $jtrt_settings['id'] );
    
    if($retrieve_data){   
       $htmlContent = "";
       if(get_post_meta($jtrt_settings['id'], 'jtrt_general_settings')[0]['showTitle'] !== undefined && get_post_meta($jtrt_settings['id'], 'jtrt_general_settings')[0]['showTitle'] === "true"){
          $htmlContent .="<h2 style='text-align:". get_post_meta($jtrt_settings['id'], 'jtrt_general_settings')[0]['titlePos'] .";'>".$retrieve_data[0]->jttable_name."</h2>";
       }
       ob_start();
       echo "<input name='' id='jtrt_hidden_tableBP".$jtrt_settings['id']."' type='hidden' value='".(isset(get_post_meta($jtrt_settings['id'], 'jtrt_general_settings')[0]['hiddenCols']) ? get_post_meta($jtrt_settings['id'], 'jtrt_general_settings')[0]['hiddenCols'] : '')."'>";
	   echo html_entity_decode(stripslashes($retrieve_data[0]->object_type));
       $htmlContent .= ob_get_clean();
       if(strpos($retrieve_data[0]->jttable_styles, 'example') !== false){
           $jtrt_example_style = explode(",",$retrieve_data[0]->jttable_styles);
           $htmlContent = str_replace("jtrt_table_creator","jtrt_table_creator jtrt_".$jtrt_settings['id']."_exStyle_".$jtrt_example_style[1],$htmlContent);
       }
       return $htmlContent;
    }else{
        echo "<div class='jtrt_error_message'><strong>Oops, Looks like something went wrong,</strong><br/>Unfortunately the table you were looking for has not been found on the server, Please double check that you have the correct table ID set for the shortcode.</div>";
        return "error:cannotLocateTable";
    }

}

add_shortcode( 'jtrt_tables', 'jtrt_shortcode_table' );

?>