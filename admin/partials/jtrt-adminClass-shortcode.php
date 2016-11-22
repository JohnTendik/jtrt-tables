<?php

function jtrt_shortcode_table( $atts ){


	global $wpdb;
	$jtrt_settings = shortcode_atts( array(
        'id' => ''
    ), $atts );
	
    $table_post_meta = get_post_meta( $jtrt_settings['id'], 'jtrt_data_settings', false ); // get the table meta options
    $table_data_json = json_decode($table_post_meta[0]['tabledata'],true); // JSON decode the meta options, too many steps for php 5.3, y'all better appreciate the extra step i'm taking here.
    $table_data = $table_data_json[0]; // Get the table data, the first value is an array full of the table data. Used to generate the table.
    $table_cell_data = $table_data_json[1]; // Get the table cell options, these are the borders and alignment settings, we will input this into the textarea so our javascript on the frontent can do its thang

    

    // We can only return once, so let's build our html!
    $html = "<div id='jtrt_options' style='display:none;position:absolute;left:-9999px;'><textarea name='' id='' cols='30' rows='10'>".json_encode($table_data_json)."</textarea></div><table>";
    
    // For each loop to loop through the table data, the first loop is the rows. 
    foreach($table_data as $indx => $row){
        // For each row, add the table row tag
        $html .= "<tr>";
        // Start another loop just for good measure. just kidding, we need this loop for the columns within the rows.
        foreach($row as $cellindx => $cell){
            // For each col item, insert the table data tag and put the data inside it.
                $html .= "<td>" .$cell. "</td>";                         
        }

        // close our tr so the HTML inspectors happy. Just kidding this is important.
        $html .= "</tr>";
    }

    // Finalize our HTML 
    $html .= "</table>";

    // Blast off! We've done our part here in the server, Javascript will handle the rest.
    return $html;

}

// Add our nifty little shortcode for use. 
add_shortcode( 'jtrt_tables', 'jtrt_shortcode_table' );

?>