<?php 

// Add a nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_save_meta_box_data', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'jtrt_general_settings',true );
	
	// echo '<input type="text" id="myplugin_new_field" name="jtrt_general_settings[setting2]" value="' . (isset($value['setting2']) ? $value['setting2'] : "Enter Value") . '" size="25" />';

?>

<strong>General Settings Note:</strong>
<p>Use the following options to setup and generate your table. Please note that you should only re-generate your table by pressing the "generate table" button ONLY if you update/change the settings below. If you regenerate your table, you will lose your other settings such as hidden columns and breakpoints.</p>
<hr>
<table>
	<tr>
		<td><label for="upload_image">CSV Table File:</label></td>
		<td><input type="text" id="upload_image" input placeholder="Please Enter A valid URL to a CSV file" name="jtrt_general_settings[setting1]" value="<?php echo (isset($value['setting1']) ? $value['setting1'] : ""); ?>" /><input id="upload_image_button" class="button" type="button" value="Upload file" /></td>		
		<td><em>Please enter a valid URL or use the uploader to include a CSV table.</em></td>
	</tr>
	<tr>
		<td><label for="jtrt_filter">Enable Filters:</label></td>
		<td><input type="radio" name="jtrt_general_settings[filter]" id="jtrt_table_filter_0" value="true" <?php if (isset($value['filter'])) {
			echo ($value['filter'] === 'true' ) ? 'checked' : '';
		}else{echo "";} ?>>
		<label for="jtrt_table_filter_0">Enable</label>
		<input type="radio" name="jtrt_general_settings[filter]" id="jtrt_table_filter_1" value="false" <?php if (isset($value['filter'])) {
			echo ($value['filter'] === 'false' ) ? 'checked' : '';
		}else{echo "checked";} ?>>
		<label for="jtrt_table_filter_1">Disable</label></td>
		<td><em>Enable filtering for the table rows [ search ]</em></td>
	</tr>
	<tr>
		<td><label for="jtrt_sort">Enable Sorting:</label></td>
		<td><input type="radio" name="jtrt_general_settings[sorting]" id="jtrt_table_sorting_0" value="true" <?php if (isset($value['sorting'])) {
			echo ($value['sorting'] === 'true' ) ? 'checked' : '';
		}else{echo "";} ?>>
		<label for="jtrt_table_sorting_0">Enable</label>
		<input type="radio" name="jtrt_general_settings[sorting]" id="jtrt_table_sorting_1" value="false" <?php if (isset($value['sorting'])) {
			echo ($value['sorting'] === 'false' ) ? 'checked' : '';
		}else{echo "checked";} ?>>
		<label for="jtrt_table_sorting_1">Disable</label></td>	
		<td><em>Enable sorting for the table rows [ orderByColumn ]</em></td>
	</tr>
	<tr>
		<td><label for="jtrt_custom_class">Custom CSS Class:</label></td>
		<td><input type="text" id="jtrt_custom_class" input placeholder="table_class" name="jtrt_general_settings[table_cclass]" value="<?php echo (isset($value['table_cclass']) ? $value['table_cclass'] : ""); ?>" /></td>	
		<td><em>Add a custom CSS class to your table</em></td>
	</tr>
	<tr><td><input type="button" id="jtrt_generate_table" class="button" value="Generate Table"></td></tr>
</table>
