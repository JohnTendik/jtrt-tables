<?php 

// Add a nonce field so we can check for it later.
	wp_nonce_field( 'jtrt_save_metabox_data', 'jtrt_save_nonce_check' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'jtrt_general_settings',true );
	// echo '<input type="text" id="myplugin_new_field" name="jtrt_general_settings[setting2]" value="' . (isset($value['setting2']) ? $value['setting2'] : "Enter Value") . '" size="25" />';

?>

<!--STEP 2-->
<div id="jt_step_2">
    <h1>Table Options</h1>
    <hr>
    <div class="jtrt_options_styles" id="jtrt_table_creator_options_container">
        <fieldset id="data-breakpoints">
            <h2>Table Breakpoints: <small>These are the breakpoints at which your columns start to hide.</small></h2>    
            <ul>
                <li><label for="jtrt_table_breakpoints_1">X-Small</label><input name="jtrt_general_settings[xsBP]" type="number" min="1" value="<?php echo (isset($value['xsBP']) ? $value['xsBP'] : "480"); ?>" data-jtbp="x-small" id="jtrt_table_breakpoints_1"></li>
                <li><label for="jtrt_table_breakpoints_2">Small</label><input name="jtrt_general_settings[smBP]" type="number" min="1" value="<?php echo (isset($value['smBP']) ? $value['smBP'] : "768"); ?>" data-jtbp="small" id="jtrt_table_breakpoints_2"></li>
                <li><label for="jtrt_table_breakpoints_3">Medium</label><input name="jtrt_general_settings[mdBP]" type="number" min="1" value="<?php echo (isset($value['mdBP']) ? $value['mdBP'] : "992"); ?>" data-jtbp="medium" id="jtrt_table_breakpoints_3"></li>
                <li><label for="jtrt_table_breakpoints_4">Large</label><input name="jtrt_general_settings[lgBP]" type="number" min="1" value="<?php echo (isset($value['lgBP']) ? $value['lgBP'] : "1200"); ?>" data-jtbp="large" id="jtrt_table_breakpoints_4"></li>
                <li><label for="jtrt_table_breakpoints_5">X-Large</label><input name="jtrt_general_settings[xlBP]" type="number" min="1" value="<?php echo (isset($value['xlBP']) ? $value['xlBP'] : "1400"); ?>" data-jtbp="x-large" id="jtrt_table_breakpoints_5"></li>
                <input name="jtrt_general_settings[hiddenCols]" id="jtrt_hidden_tableBP" type="hidden" value='<?php echo (isset($value['hiddenCols']) ? $value['hiddenCols'] : ""); ?>'>
            </ul>
        </fieldset>
        <fieldset>
            <h2>Show Title: <small>If enabled this, your table title will be shown on the front-end. The position is where the title will appear.</small></h2>    
            <ul>
                <li><label>Enable: <input type="checkbox" name="jtrt_general_settings[showTitle]" id="jtrt_table_show_title" value="<?php echo (isset($value['showTitle']) ? $value['showTitle'] : "false");?>"></label></li>
                <li><label>Position:
                    <select id="jtrt_showTitle_pos" name="jtrt_general_settings[titlePos]" data-jt-titlepos="<?php echo (isset($value['titlePos']) ? $value['titlePos'] : "topLeft");?>">
                        <option value="Left">Top Left</option> 
                        <option value="Center" selected>Top Center</option>
                        <option value="Right">Top Right</option>
                    </select>    
                </label></li>
            </ul>
        </fieldset>
        <fieldset id="data-filtering">
            <h2>Allow Filtering: <small>If enabled this, your table will be filterable with a searchbox.</small></h2>    
            <ul>
                <li><label>Enable: <input type="checkbox" name="jtrt_general_settings[allowFiltering]" value="<?php echo (isset($value['allowFiltering']) ? $value['allowFiltering'] : "false");?>" id="jtrt_table_allow_filter" value="false"></label></li>
            </ul>
        </fieldset>
        <fieldset id="data-sorting">
            <h2>Allow Sorting: <small>If enabled this, your table will be sortable by its row values. For this option to work properly, you must correctly set the data-type attribute for your columns.</small></h2>    
            <ul>
                <li><label>Enable: <input type="checkbox" name="jtrt_general_settings[allowSorting]" value="<?php echo (isset($value['allowSorting']) ? $value['allowSorting'] : "false");?>" id="jtrt_table_allow_sorting" value="false"></label></li>
            </ul>
        </fieldset>
        <fieldset id="data-paging">
            <h2>Enable Pagination: <small>If enabled this, your table will be split up into pages for neater viewing. Usually best for tables with large amounts of row data.</small></h2>    
            <ul>
                <li><label>Enable: <input type="checkbox" name="jtrt_general_settings[enablePaging]" value="<?php echo (isset($value['enablePaging']) ? $value['enablePaging'] : "false");?>" id="jtrt_table_allow_paging" value="false"></label></li>
                <li><label>Number Of Rows To Show: <input type="number" name="jtrt_general_settings[enablePagingCount]" value="<?php echo (isset($value['enablePagingCount']) ? $value['enablePagingCount'] : "10");?>" id="jtrt_table_allow_paging_rowCount" min="1"></label></li>
            </ul>
        </fieldset>
    </div>
    <hr>
    <h1>Table Generator</h1>
    <div class="jtrt__table_creator_container">
        <div id="jtrt_table_container">
            <?php 
            
            $testcondition = do_shortcode( '[jtrt_tables id="'.$post->ID.'"]' );

            if($testcondition !== "error:cannotLocateTable"){
                echo $testcondition;
            }else{
               ?>
               <table class="jtrt_table_creator" data-use-parent-width="true" data-filtering="false" data-sorting="false" data-paging="false" >
            <thead>
                <tr class="jtrt_custom_header">
                    <td></td>
                    <td>A</td>
                    <td>B</td>
                    <td>C</td>
                    <td class="jt_addrowcol">+</td>
                </tr>
                <tr class="sorted_head">
                    <td class="jtrt_custom_td">1</td>
                    <td data-breakpoints="" data-type="text">Header 1</td>
                    <td data-breakpoints="" data-type="text">Header 2</td>
                    <td data-breakpoints="" data-type="text">Header 3</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="jtrt_custom_td">2</td>
                    <td>cell 1</td>
                    <td>cell 2</td>
                    <td>cell 3</td>
                </tr>
                <tr>
                    <td class="jtrt_custom_td">3</td>
                    <td>cell 1</td>
                    <td>cell 2</td>
                    <td>cell 3</td>
                </tr>
                <tr>
                    <td data-jttable-controller="rowAdd" class="jtrt_custom_td jt_addrowcol">+</td>
                </tr>
            </tbody>
        </table>
               <?php 
            }
            
            ?>
            
        </div>
        
        <div class="modal fade jtrt_btstles" id="jtrt_edit_row_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-jt-row-editting="1">
            <div class="jtrt_btstles modal-lg modal-dialog" role="document">
            <div class="jtrt_btstles modal-content">
                <div class="jtrt_btstles modal-header">
                <button type="button" class="jtrt_btstles close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="jtrt_btstles modal-title" id="myModalLabel">Edit Row</h4>
                </div>
                <div class="jtrt_btstles modal-body">
                <p>You are about to edit row </p>
                <nav id="jtmodal_hidden_nav">
                    <ul>
                        <li><a href="#0" id="bold"><strong>Bold</strong></a></li>
                        <li><a href="#0" id="italic"><em>Italic</em></a></li>
                        <li><a href="#0" id="image">Insert Image</a></li>
                        <li><a href="#0" id="link">Insert Link</a></li>
                    </ul>
                </nav>
                <div class="jtrt_edit_cont">
                    <table>
                        <tr>
                            <td></td>  
                        </tr>
                            
                        <tr>
                            
                        </tr>
                    </table>
                </div>

                <div id="dialog-form-image" title="Insert an Image">
                <p class="validateTips">Only the link is required. Set a width and height if you need to.</p>
        
                <form>
                    <fieldset>
                    <label for="link">Image Link</label>
                    <input type="URL" name="link" id="link" placeholder="http://linktoimage.png" value="" class="text ui-widget-content ui-corner-all">
                    <label for="width">width</label>
                    <input type="text" name="width" id="width" placeholder="190px" value="" class="text ui-widget-content ui-corner-all">
                    <label for="height">height</label>
                    <input type="text" name="height" id="height" placeholder="190px" value="" class="text ui-widget-content ui-corner-all">
                
                    <!-- Allow form submission with keyboard without duplicating the dialog button -->
                    <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
                    </fieldset>
                </form>
                </div>

                <div id="dialog-form-link" title="Insert a link">
                <p class="validateTips">Insert a link and the text for the link.</p>
        
                <form>
                    <fieldset>
                    <label for="link2">Link</label>
                    <input type="URL" name="link" id="link2" placeholder="http://linktoimage.png" value="" class="text ui-widget-content ui-corner-all">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Link name" value="" class="text ui-widget-content ui-corner-all">

                    <!-- Allow form submission with keyboard without duplicating the dialog button -->
                    <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
                    </fieldset>
                </form>
                </div>

                </div>
                <div class="jtrt_btstles modal-footer">
                
                <button type="button" class="jtrt_btstles btn btn-danger" id="jt-table-delete-btn">Delete Row</button>
                <label for="jt_moveRowTo" id="jt_moveRowToLabel">Move Row To:</label>
                <select name="jt_moveRowTo" class="jtrt_btstles" id="jt_moveRowTo">
                     
                </select>
                <button type="button" class="jtrt_btstles btn btn-warning" id="jt-table-move-btn">Move Row</button>
                <button type="button" class="jtrt_btstles btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="jt-table-save-btn" class="jtrt_btstles btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div> <!-- end modal-->
        
        <div class="modal fade" id="jtrt_edit_col_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-jt-col-editting="1">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Column</h4>
                </div>
                <div class="modal-body row">
                    
                <div class="col-md-6">
                    <h2>Edit Column</h2>
                    <div class="jt_foo_setting_container">
                        <fieldset>
                            <label for="jtfoocolumnType">Column Type</label>
                            <select name="jtfoocolumnType" id="jtfoocolumnType">
                                <option value="text">String</option>
                                <option value="html">HTML</option>
                                <option value="number">Number</option>
                                <option value="date">Date</option>
                            </select>
                        </fieldset>
                        
                        <fieldset>
                            <span>Hide Columns:</span>
                            <small>Select the column breakpoints that you want this column to hide at.</small>
                            <a href="#" id="xs">X-Small</a>
                            <a href="#" id="sm">Small</a>
                            <a href="#" id="md">Medium</a>
                            <a href="#" id="lg">Large</a>
                        </fieldset>
                    </div>
                </div>  
                    
                <div class="col-md-6">
                    <p>You are about to edit column </p>
                    <div class="jt_col_form_cont">
                        <table>
                            
                        </table>
                    </div>
                </div>
                
                
                </div>
                <div class="modal-footer">
                <button type="button" class="jtrt_btstles btn btn-danger" id="jt-table-delete-btn-col">Delete Column</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="jt-table-save-btn-col" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div> <!-- end modal -->
        
    </div> <!-- Table container -->
    
    <div class="jt_nav_container clearfix">
        <a href="#" data-jt-steps-dir="next" class="jt_steps_nav_btn">NEXT</a>
        <a href="#" data-jt-steps-dir="prev" class="jt_steps_nav_btn">PREV</a>
    </div>
</div>
<!--STEP 2-->