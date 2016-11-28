<?php

function checkOldTables(){
    global $post;
    global $wpdb;

    $jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
	$retrieve_data = $wpdb->get_results( "SELECT * FROM $jtrt_tables_name WHERE jttable_IDD = '".$post->ID."'" );
    if($retrieve_data){ 
    
	    echo '<div id="jtConverAvailMessage"><h4>Table Converter</h4><p>This plugin has detected previous data for this table. If you would like to recover/convert your previous table to be compatible with this version, you can use the option below. Note however, this feature does not work 100% so your tables will appear somewhat broken. Also you must re-add the table breakpoints/options you had before since these options are not backwards compatible.</p>
        <div>
        <a href="#0" id="jtrt-dontshowconvert">Dont Show Me This Message Again.</a>
        <a href="#0" id="jtrt-trytoconvertolddata">Convert My Table. <small>I accept the risks.</small></a>
        </div>
        </div>';
	
    }
    
}

wp_nonce_field( 'jtrt_save_metabox_data', 'jtrt_save_nonce_check' );
$value = get_post_meta( $post->ID, 'jtrt_data_settings',true );
$text_domain = 'jtrt-responsive-tables';
checkOldTables();

?>

<div id="loaderIco"><p><?php _e('Doing calculations, please wait..',$text_domain); ?></p></div>

<form action="">
<textarea name="jtrt-table-data[tabledata]" style="display:none;position:absolute;left:-9999px" id="jtrt-table-data" cols="30" rows="10"><?php echo (isset($value['tabledata']) ? $value['tabledata'] : ""); ?></textarea>
</form>

<div id="jt-editor-container">

    <header class="group">
        <h2>JTRT Responsive Tables</h2>
        <ul id="jt-steps">
            <li data-jtrt-editor-section-id="1" class="active"><?php _e('Table Editor',$text_domain); ?></li>
            <li data-jtrt-editor-section-id="2" ><?php _e('Table Options',$text_domain); ?></li>
        </ul>
    </header>

    <?php require_once plugin_dir_path( __FILE__ ) . 'jtrt-responsive-tables-step1.php'; ?>
    <?php require_once plugin_dir_path( __FILE__ ) . 'jtrt-responsive-tables-step2.php'; ?>
    <?php require_once plugin_dir_path( __FILE__ ) . 'jtrt-responsive-tables-step3.php'; ?>
    <?php require_once plugin_dir_path( __FILE__ ) . 'extras/jtrt-responsive-tables-extra-temps.php'; ?>

</div>