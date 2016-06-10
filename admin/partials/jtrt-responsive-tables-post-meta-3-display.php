<?php 

// Add a nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_save_meta_box_data', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'jtrt_style_settings',true );
	
	// echo '<input type="text" id="myplugin_new_field" name="jtrt_style_settings[setting2]" value="' . (isset($value['setting2']) ? $value['setting2'] : "Enter Value") . '" size="25" />';

?>

<strong>Style Settings Note:</strong>
<p>This feature is still a work in process, please report any unsual bugs you find/experience to the github page, Thank you! </p>
<hr>

<div class="section group">
    
    <div class="col span_7_of_12"> 
        <div id="accordion">
            <h3>Container Settings</h3>
            <div id="" class="group section accordion-content">
                <table>
                    <tr>
                        <td><label for="jtrt_container_style_pad">Container Padding:</label></td>
                        <td><input id="jtrt_container_style_pad" name="jtrt_style_settings[container_padding]" type="range" min="0" max="20" value="<?php echo isset($value['container_padding']) ? $value['container_padding'] : '0' ?>" /></td>
                        <td><p>__ pixels</p></td>
                    </tr>
                    <tr>
                        <td><label for="jtrt_container_style_bg">Background Color:</label></td>
                        <td><input id="jtrt_container_style_bg" data-jtrt-style="container_bg" name="jtrt_style_settings[container_bcolor]" type="text" value="<?php echo isset($value['container_bcolor']) ? $value['container_bcolor'] : '#ffffff' ?>" class="wp-color-picker-field" data-default-color="#ffffff" /></td>
                    </tr>
                    <tr>
                        <td><label for="jtrt_container_style_ta">Container Text Align:</label></td>
                        <td><select name="jtrt_style_settings[container_txtalign]" id="jtrt_container_style_ta">
                            <?php
                            
                            $jt_container_text_align = ["left","center","right"];
                            $selected_option = isset($value['container_txtalign']) ? $value['container_txtalign'] : "left";
                            foreach($jt_container_text_align as $option){
                                if($option == $selected_option){
                                    echo '<option selected value="'.$option.'">'.$option.'</option>';
                                }else{
                                    echo '<option value="'.$option.'">'.$option.'</option>';
                                }
                            }
                            
                            ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td><label for="jtrt_container_style_border_width">Container Border Width:</label></td>
                        <td><input id="jtrt_container_style_border_width" name="jtrt_style_settings[container_border_width]" type="range" min="0" max="20" value="<?php echo isset($value['container_border_width']) ? $value['container_border_width'] : '0' ?>" /></td>
                        <td><p>__ pixels</p></td>
                    </tr>
                    <tr>
                        <td><label for="jtrt_container_style_border_type">Container Border Style:</label></td>
                        <td><select name="jtrt_style_settings[container_border_type]" id="jtrt_container_style_border_type">
                            <?php
                            
                            $jt_container_text_align = ["solid","dashed","dotted"];
                            $selected_option = isset($value['container_border_type']) ? $value['container_border_type'] : "left";
                            foreach($jt_container_text_align as $option){
                                if($option == $selected_option){
                                    echo '<option selected value="'.$option.'">'.$option.'</option>';
                                }else{
                                    echo '<option value="'.$option.'">'.$option.'</option>';
                                }
                            }
                            
                            ?>
                        </select></td>                       
                    </tr>
                    <tr>
                        <td><label for="jtrt_container_style_border_color">Border Color:</label></td>
                        <td><input id="jtrt_container_style_border_color" data-jtrt-style="container_bordercol"" name="jtrt_style_settings[container_border_color]" type="text" value="<?php echo isset($value['container_border_color']) ? $value['container_border_color'] : '#eeeeee' ?>" class="wp-color-picker-field" data-default-color="#ffffff" /></td>
                    </tr>
                </table>             
                               
            </div>
            <h3>Table Settings</h3>
            <div class="accordion-content">
                <table>
                    <tr>
                        <td><label for="jtrt_table_style_border_width">Table Border Width:</label></td>
                        <td><input id="jtrt_table_style_border_width" name="jtrt_style_settings[table_border_width]" type="range" min="0" max="20" value="<?php echo isset($value['table_border_width']) ? $value['table_border_width'] : '0' ?>" /></td>
                        <td><p>__ pixels</p></td>
                    </tr>
                    <tr>
                        <td><label for="jtrt_table_style_border_type">Table Border Style:</label></td>
                        <td><select name="jtrt_style_settings[table_border_type]" id="jtrt_table_style_border_type">
                            <?php
                            
                            $jt_container_text_align = ["solid","dashed","dotted"];
                            $selected_option = isset($value['table_border_type']) ? $value['table_border_type'] : "left";
                            foreach($jt_container_text_align as $option){
                                if($option == $selected_option){
                                    echo '<option selected value="'.$option.'">'.$option.'</option>';
                                }else{
                                    echo '<option value="'.$option.'">'.$option.'</option>';
                                }
                            }
                            
                            ?>
                        </select></td>                       
                    </tr>
                    <tr>
                        <td><label for="jtrt_table_style_border_color">Table Border Color:</label></td>
                        <td><input id="jtrt_table_style_border_color" data-jtrt-style="table_bordercol"" name="jtrt_style_settings[table_border_color]" type="text" value="<?php echo isset($value['table_border_color']) ? $value['table_border_color'] : '#eeeeee' ?>" class="wp-color-picker-field" data-default-color="#ffffff" /></td>
                    </tr>
                </table>
            </div>
            <h3>Font Settings</h3>
            <div class="accordion-content">
                <p>
                Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
                Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
                ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
                lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
                </p>
                <ul>
                <li>List item one</li>
                <li>List item two</li>
                <li>List item three</li>
                </ul>
                <td><input type="text" name="jtrt_style_settings[filtere]" value="<?php echo isset($value['filtere']) ? $value['filtere'] : "empty" ?>"></td>
            </div>
            
            </div>
        
    </div> <!-- end of span 7 -->
    
    <div class="col span_5_of_12">
        <h3>Table Style View</h3>
       
        <div id="jtrt-style-pig-container">
        <table id="jtrt-style-pig">
                <thead>
                    <tr>
                        <th>
                            Title 1
                        </th>
                        <th >
                            Title 2
                        </th>
                        <th>
                            Title 3
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td >
                            Row 1
                        </td>
                        <td>
                            Row 1
                        </td>
                        <td>
                            Row 1
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Row 2
                        </td>
                        <td>
                            Row 2
                        </td>
                        <td>
                            Row 2
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Row 2
                        </td>
                        <td>
                            Row 2
                        </td>
                        <td>
                            Row 2
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Row 3
                        </td>
                        <td>
                            Row 3
                        </td>
                        <td>
                            Row 3
                        </td>
                    </tr>
                    </tbody>
                </table>
               </div>
    </div>
</div>