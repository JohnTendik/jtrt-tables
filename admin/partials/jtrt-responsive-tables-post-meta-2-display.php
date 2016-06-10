<?php 

// Add a nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_save_meta_box_data2', 'myplugin_meta_box_nonce2' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'jtrt_table_editor_settings',true );
	
	// echo '<input type="text" id="myplugin_new_field" name="jtrt_general_settings[setting2]" value="' . (isset($value['setting2']) ? $value['setting2'] : "Enter Value") . '" size="25" />';



?>

<div class="loader"><em>Feeding Unicorns, please wait..</em><img src="<?php echo plugin_dir_url( __FILE__ ) . '../img/cube.gif'?>" alt=""></div>
<div class="table-wrapper">
	<nav id="column-hider-nav">
		<ul>
			<li><a href="#" data-hider-jt="xs" class="active_table_hider">XS</a></li>
			<li><a href="#" data-hider-jt="sm">SM</a></li>
			<li><a href="#" data-hider-jt="md">MED</a></li>
			<li><a href="#" data-hider-jt="lg">LG</a></li>
		</ul>
	</nav>
	<div class="table-cotainer">

		<?php
		echo do_shortcode( '[jtrt_tables id="'.$post->ID.'"]' );
		?>

	</div>
</div>
<div id="dialog-message2" title="Download complete">
    <textarea style="width:100%;height:200px;"></textarea>
   
    </div>
<table id="jtrt_table_html_generator">
    
    <tr>
        <td>
            <input type="button" id="jtrt_generatehtml_table" class="button" value="View HTML">
        </td>
    </tr>
</table>
