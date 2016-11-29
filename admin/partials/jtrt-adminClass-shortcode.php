<?php

function jtrt_shortcode_table( $atts ){


	global $wpdb;
	$jtrt_settings = shortcode_atts( array(
        'id' => '',
        'filterrows' => '',
        'filtercols' => ''
    ), $atts );
	
    $table_post_meta = get_post_meta( $jtrt_settings['id'], 'jtrt_data_settings', false ); // get the table meta options
    $table_data_json = json_decode($table_post_meta[0]['tabledata'],true); // JSON decode the meta options, too many steps for php 5.3, y'all better appreciate the extra step i'm taking here.
    $table_data = $table_data_json[0]; // Get the table data, the first value is an array full of the table data. Used to generate the table.
    $table_cell_data = $table_data_json[1]; // Get the table cell options, these are the borders and alignment settings, we will input this into the textarea so our javascript on the frontent can do its thang
    
    if(!$table_data){
        echo 'Unfortunately we could not locate the table you\'re looking for.'; 
        return;
    }

    $showTableTitle = (isset($table_post_meta[0]['jtShowTableTitle']) ? "true" : "false");
    $showTableTitlePos = explode(",",$table_post_meta[0]['jtShowTableTitlePos']);
    $myTableTitle = get_the_title($jtrt_settings['id']);

    $myTableResponsiveStyle = $table_post_meta[0]['jtTableResponsiveStyle'];
    $myTableStackPrefWidth = $table_post_meta[0]['jtStackPrefWidth'];

    $myTableHoverRows = (isset($table_post_meta[0]['jtTableEnableRowHighlight']) ? "highlightRows" : "");
    $myTableHoverRowsCol = (isset($table_post_meta[0]['jtTableEnableRowHighlight']) ? "data-jtrt-rowhighligh-color='".$table_post_meta[0]['jtTableEnableRowHighlightcol']."'" : "");
    $myTableHoverCols = (isset($table_post_meta[0]['jtTableEnableColHighlight']) ? "highlightCols" : "");
    $myTableHoverColsCol = (isset($table_post_meta[0]['jtTableEnableColHighlight']) ? "data-jtrt-colhighligh-color='".$table_post_meta[0]['jtTableEnableColHighlightcol']."'" : "");
    
    $myjtbpfootab = array();
    

    if($myTableResponsiveStyle == "footable"){
        
        $myjtbpfootab['xlarge'] = $table_post_meta[0]['jtFootableBPxlarge'];
        $myjtbpfootab['large'] = $table_post_meta[0]['jtFootableBPlarge'];
        $myjtbpfootab['medium'] = $table_post_meta[0]['jtFootableBPmedium'];
        $myjtbpfootab['small'] = $table_post_meta[0]['jtFootableBPsmall'];
        $myjtbpfootab['xsmall'] = $table_post_meta[0]['jtFootableBPxsmall'];


    }
    
    $myjttableFiltering = (isset($table_post_meta[0]['jtTableEnableFilters']) ? "true" : "false");
    $myjttableSorting = (isset($table_post_meta[0]['jtTableEnableSorting']) ? "true" : "false");
    $myjttablePaging = (isset($table_post_meta[0]['jtTableEnablePaging']) ? "true" : "false");
    $myjttablePagingCnt = (isset($table_post_meta[0]['jtTableEnablePagingCnt']) ? $table_post_meta[0]['jtTableEnablePagingCnt'] : "10");

    $html = "";

    if($showTableTitle == "true" && $showTableTitlePos[0] == "top"){
        $html .= "<h3 style='margin-top:24px;margin-bottom:14px;text-align:".$showTableTitlePos[1].";'>".$myTableTitle."</h3>";
    }
    
    $html .= "<div id='jtHeaderHolder-".$jtrt_settings['id']."'></div>";
    $html .= "<div class='jtTableContainer jtrespo-".$myTableResponsiveStyle." ".$myTableHoverRows." ".$myTableHoverCols."' ".($myTableResponsiveStyle == 'stack' ? "data-jtrt-stack-width='".$myTableStackPrefWidth."'" : "")." ".$myTableHoverRowsCol." ".$myTableHoverColsCol.">";


    // We can only return once, so let's build our html!
    $html .= "<div class='jtsettingcontainer' style='display:none;position:absolute;left:-9999px;'><textarea data-jtrt-table-id='".$jtrt_settings['id']."' id='jtrt_table_settings_".$jtrt_settings['id']."' cols='30' rows='10'>".json_encode($table_data_json)."</textarea><textarea data-jtrt-table-id='".$jtrt_settings['id']."' id='jtrt_table_bps_".$jtrt_settings['id']."' cols='30' rows='10'>".json_encode($myjtbpfootab)."</textarea></div><table id='jtrt_table_".$jtrt_settings['id']."' data-sorting='".$myjttableSorting."' data-paging='".$myjttablePaging."' data-paging-size='".$myjttablePagingCnt."'  data-filtering='".$myjttableFiltering."' data-jtrt-table-id='".$jtrt_settings['id']."' class='jtrt-table' >";
    

    if($jtrt_settings['filterrows'] != ""){

        $filteredRows = explode(",",$jtrt_settings['filterrows']);

    }else{
        $filteredRows = array();
    }
    if($jtrt_settings['filtercols'] != ""){

        $filteredCols = explode(",",$jtrt_settings['filtercols']);

    }else{
        $filteredCols = array();
    }

    // For each loop to loop through the table data, the first loop is the rows. 
    foreach($table_data as $indx => $row){

        if(!in_array($indx+1,$filteredRows)){
            if($indx == 0){
                $html .= "<thead><tr>";
                foreach($row as $cellindx => $cell){
                // For each col item, insert the table data tag and put the data inside it.
                    if(!in_array($cellindx+1,$filteredCols)){
                        $html .= "<td>" .$cell. "</td>";
                    }                 
                }
                $html .= "</tr></thead><tbody>";
            }else{
                // For each row, add the table row tag
            
                $html .= "<tr>";
                // Start another loop just for good measure. just kidding, we need this loop for the columns within the rows.
                foreach($row as $cellindx => $cell){
                    // For each col item, insert the table data tag and put the data inside it.
                        if(!in_array($cellindx+1,$filteredCols)){
                            $html .= "<td>" .$cell. "</td>";
                        }                         
                }

                // close our tr so the HTML inspectors happy. Just kidding this is important.
                $html .= "</tr>";
                
            }
        }
        
    }

    $html .= "</tbody>";
    // Finalize our HTML 
    $html .= "</table>";

    $html .= "</div>";

    $html .= "<div id='jtFooterHolder-".$jtrt_settings['id']."'></div>";
    if($showTableTitle == "true" && $showTableTitlePos[0] == "bottom"){
        $html .= "<h3 style='margin-top:0;margin-bottom:14px;text-align:".$showTableTitlePos[1].";'>".$myTableTitle."</h3>";
    }


    if($myTableResponsiveStyle == "footable"){
        wp_enqueue_script( 'jtbackendfrontendfoo-js', plugin_dir_url( __FILE__ ) . '../../public/js/vendor/footable.min.js', array( 'jquery' ), '4.0', false );
        wp_enqueue_style( 'jtbackendfrontendss-jskka12', plugin_dir_url( __FILE__ ) . '../../public/css/font-awesome.min.css', '4.0', 'all' );
        wp_enqueue_style( 'jtbackendfrontendss-jskk', plugin_dir_url( __FILE__ ) . '../../public/css/footable.standalone.min.css', '4.0', 'all' );    
    }elseif($myTableResponsiveStyle == "scroll"){
        if($myjttableFiltering == "true" || $myjttablePaging == "true" || $myjttableSorting == "true"){
            wp_enqueue_style( 'jtbackendfrontendss-jskka', 'https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css', '4.0', 'all' );
            wp_enqueue_script( 'jtbackendfrontend-js-dtb', 'https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js', array( 'jquery' ), '4.0', false );         
        }
    }
    wp_enqueue_style( 'jtbackendfrontend-css', plugin_dir_url( __FILE__ ) . '../../public/css/jtrt-responsive-tables-public.css', '4.0', 'all' );  
    wp_enqueue_script( 'jtbackendfrontend-js', plugin_dir_url( __FILE__ ) . '../../public/js/jtrt-responsive-tables-public.js', array( 'jquery' ), '4.0', false );

    // Blast off! We've done our part here in the server, Javascript will handle the rest.
    return $html;


}

// Add our nifty little shortcode for use. 
add_shortcode( 'jtrt_tables', 'jtrt_shortcode_table' );

?>