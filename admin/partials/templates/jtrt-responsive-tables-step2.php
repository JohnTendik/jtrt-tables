<?php 

$value = get_post_meta( $post->ID, 'jtrt_data_settings',true ); 
$text_domain = 'jtrt-responsive-tables';

?>

<div id="step2" class="jtrteditorsection">
        
    <div id="jtsupportcolumn">

        <div>
            <h3><?php _e('Support Further Development!',$text_domain); ?></h3>
            <p><?php _e('If you like this plugin, please consider supporting future development by giving it a ',$text_domain); ?><a href="https://wordpress.org/support/plugin/jtrt-responsive-tables/reviews/"><?php _e('positive review on the wordpress plugin page',$text_domain); ?></a>. <?php _e('This help others see this plugin and motivates me to keep building.',$text_domain); ?></p>
        </div>

        <div>
            <h3><?php _e('Support',$text_domain); ?></h3>
            <p><?php _e('If you need support, or experience bugs or any issues,',$text_domain); ?> <a href="https://github.com/mythirdeye/jtrt-tables"><?php _e('please create a ticket on my github page',$text_domain); ?></a> <?php _e('and I will do my best to help you out. Thank you!',$text_domain); ?></p>
        </div>

        <div>
            <h3><?php _e('Credits',$text_domain); ?></h3>
            <p><?php _e('I\'d like to thank Footable, HandsOnTable, DataTables, jQuery, PapaParse, Wordpress, Freepik, colorPicker, StackOverflow, for making this plugin possible!',$text_domain); ?></p>
        </div>
    </div>

    <div id="jtoptionsContainer">

        <div class="leftSidejt">
            <ul>
                <li data-jtrt-editor-section-id="1" class="active"><?php _e('General Options',$text_domain); ?></li>
                <li data-jtrt-editor-section-id="2" ><?php _e('Responsive Options',$text_domain); ?></li>
                <li data-jtrt-editor-section-id="3"><?php _e('Front-end Options',$text_domain); ?></li>
                <li data-jtrt-editor-section-id="4"><?php _e('DOCS',$text_domain); ?></li>
            </ul>
        </div>

        <div class="rightSidejt">

            <div id="optionsSection1" class="optionsPagejt jtoptionsshow">
                <h2><?php _e('General Options',$text_domain); ?></h2>
                <p><?php _e('These are general options for your table.',$text_domain); ?></p>
                <hr>
                <table>

                    <tbody>

                        <tr>
                            <td>
                                <label for=""><?php _e('Show Table Title',$text_domain); ?></label>
                                <br>
                                <small><?php _e('This will enable your table title in the front-end.',$text_domain); ?></small>
                            </td>
                            <td><input name="jtrt-table-data[jtShowTableTitle]" type="checkbox" <?php echo (isset($value['jtShowTableTitle']) ? "checked" : ""); ?>></td>
                        </tr>
                        <tr>
                            <td>
                                <label for=""><?php _e('Title Position',$text_domain); ?></label>
                                <br>
                                <small><?php _e('Select the position you want the title to show',$text_domain); ?></small>
                            </td>
                            <td>
                                <select id="" name="jtrt-table-data[jtShowTableTitlePos]">
                                    <?php 
                                        $positionsTitlejt = array('top,left'=>__('Top Left'),'top,center'=>__('Top Center'),'top,right'=>__('Top Right'),'bottom,left'=> __('Bottom Left'),'bottom,center'=>__('Bottom Center'),'bottom,right'=>__('Bottom Right')); 
                                        $currentSelected = (isset($value['jtShowTableTitlePos']) ? $value['jtShowTableTitlePos'] : "topleft");
                                        foreach ($positionsTitlejt as $key => $value2) {
                                            if($key == $currentSelected){
                                                echo "<option value='$key' selected>$value2</option>";
                                            }else{
                                                echo "<option value='$key'>$value2</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div> <!-- opt sec 1 -->
            <div id="optionsSection2" class="optionsPagejt">
                <h2><?php _e('Responsive Options',$text_domain); ?></h2>
                <p><?php _e('JTRT Table include 3 different responsive options for you to choose from.',$text_domain); ?></p>
                <hr>
                <table>

                    <tbody>

                        <tr>
                            <td>
                                <label for=""><?php _e('Responsive Type',$text_domain); ?></label>
                                <br>
                                <small><?php _e('Select how you want your table to respond on smaller screens',$text_domain); ?></small>
                            </td>
                            <td>
                                <select id="jtresponsiveoptionscontainerselect" name="jtrt-table-data[jtTableResponsiveStyle]">
                                    <?php 
                                        $jtTableResponsivestyle = array("scroll"=>__("Classic Scroller"), "footable"=>__("Column Hiding"), "stack"=>__("Column Stacking")); 
                                        $currentSelected = (isset($value['jtTableResponsiveStyle']) ? $value['jtTableResponsiveStyle'] : "scroll");
                                        foreach ($jtTableResponsivestyle as $key2 => $value3) {
                                            if($key2 == $currentSelected){
                                                echo "<option value='$key2' selected>$value3</option>";
                                            }else{
                                                echo "<option value='$key2'>$value3</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                
                            </td>
                        </tr>
                    </tbody>

                </table>
                <div id="jtresponsiveoptionscontainer">
                    <div data-jtresponsive-select="scroll">
                        <hr>
                        <strong><?php _e('Scrolling',$text_domain); ?></strong>
                        <p><?php _e('This option will add a scrollbar on your table where you can scroll left-right when the size of the page gets smaller. This is usually the least responsive option.',$text_domain); ?></p>
                    </div>
                    <div data-jtresponsive-select="footable">
                        <hr>
                        <strong><?php _e('Hiding',$text_domain); ?></strong>
                        <p><?php _e('This option will hide some of your columns when the page gets smaller. Hidden columns can be easily accessed by clicking the row content. If you would like more information about this option, please refer to the FooTables documentation.',$text_domain); ?> </p>
                        <p><?php _e('Please note, if you chose this option you will need to add extra options to your table in the editor, pease refer to the tutorial/video on my github page for more information.',$text_domain); ?></p>
                        <br/>
                        <em><?php _e('Custom Breakpoints',$text_domain); ?></em>
                        <table>

                            <tbody>
                                <tr>
                                    <td>
                                        <label for=""><?php _e('X-Large Breakpoint',$text_domain); ?></label>
                                        <br>
                                        <small><?php _e('Select the pixel size you want the X-Large breakpoint to take effect.',$text_domain); ?></small>
                                    </td>
                                    <td>
                                        <?php 
                                        $jtBPxlarge = 1400;
                                        if(isset($value['jtFootableBPxlarge']) && $value['jtFootableBPxlarge'] != ""){
                                            $jtBPxlarge = $value['jtFootableBPxlarge'];
                                        }
                                        ?>
                                        <input type="number" name="jtrt-table-data[jtFootableBPxlarge]" value="<?php echo $jtBPxlarge; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for=""><?php _e('Large Breakpoint',$text_domain); ?></label>
                                        <br>
                                        <small><?php _e('Select the pixel size you want the Large breakpoint to take effect.',$text_domain); ?></small>
                                    </td>
                                    <td>
                                        <?php 
                                        $jtBPlarge = 1200;
                                        if(isset($value['jtFootableBPlarge']) && $value['jtFootableBPlarge'] != ""){
                                            $jtBPlarge = $value['jtFootableBPlarge'];
                                        }
                                        ?>
                                        <input type="number" name="jtrt-table-data[jtFootableBPlarge]" value="<?php echo $jtBPlarge; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for=""><?php _e('Medium Breakpoint',$text_domain); ?></label>
                                        <br>
                                        <small><?php _e('Select the pixel size you want the Medium breakpoint to take effect.',$text_domain); ?></small>
                                    </td>
                                    <td>
                                        <?php 
                                        $jtBPmedium = 992;
                                        if(isset($value['jtFootableBPmedium']) && $value['jtFootableBPmedium'] != ""){
                                            $jtBPmedium = $value['jtFootableBPmedium'];
                                        }
                                        ?>
                                        <input type="number" name="jtrt-table-data[jtFootableBPmedium]" value="<?php echo $jtBPmedium; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for=""><?php _e('Small Breakpoint',$text_domain); ?></label>
                                        <br>
                                        <small><?php _e('Select the pixel size you want the Small breakpoint to take effect.',$text_domain); ?></small>
                                    </td>
                                    <td>
                                        <?php 
                                        $jtBPsmall = 768;
                                        if(isset($value['jtFootableBPsmall']) && $value['jtFootableBPsmall'] != ""){
                                            $jtBPsmall = $value['jtFootableBPsmall'];
                                        }
                                        ?>
                                        <input type="number" name="jtrt-table-data[jtFootableBPsmall]" value="<?php echo $jtBPsmall; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for=""><?php _e('X-Small Breakpoint',$text_domain); ?></label>
                                        <br>
                                        <small><?php _e('Select the pixel size you want the X-Small breakpoint to take effect.',$text_domain); ?></small>
                                    </td>
                                    <td>
                                        <?php 
                                        $jtBPxsmall = 440;
                                        if(isset($value['jtFootableBPxsmall']) && $value['jtFootableBPxsmall'] != ""){
                                            $jtBPxsmall = $value['jtFootableBPxsmall'];
                                        }
                                        ?>
                                        <input type="number" name="jtrt-table-data[jtFootableBPxsmall]" value="<?php echo $jtBPxsmall; ?>">
                                    </td>
                                </tr>
                            </tbody>

                        </table>  
                                     
                    </div>
                    <div data-jtresponsive-select="stack">
                       <hr>
                        <strong><?php _e('Stacking',$text_domain); ?></strong>
                        <p><?php _e('This option will automatically stack your columns once the table size is below the set value down below. For example, the default is 500px,if your table gets below 500px, all of the rows will turn into block content. This usually only works with certain types of tables. I\'m including it just in case, this shouldn\'t be your first pick.',$text_domain); ?></p>
                        <table>

                            <tbody>

                                <tr>
                                    <td>
                                        <label for=""><?php _e('Prefered Breakpoint',$text_domain); ?></label>
                                        <br>
                                        <small><?php _e('Select the table size at which you want your table columns to stack.',$text_domain); ?></small>
                                    </td>
                                    <td>
                                        <?php 
                                        $jtStackWidth = 500;
                                        if(isset($value['jtStackPrefWidth']) && $value['jtStackPrefWidth'] != ""){
                                            $jtStackWidth = $value['jtStackPrefWidth'];
                                        }
                                        ?>
                                        <input type="number" name="jtrt-table-data[jtStackPrefWidth]" value="<?php echo $jtStackWidth; ?>">
                                    </td>
                                </tr>
                                
                            </tbody>

                        </table>  
                    </div>
                </div>
            </div>
            <div id="optionsSection3" class="optionsPagejt">
                <h2><?php _e('Front-End Options',$text_domain); ?></h2>
                <p><?php _e('These options will help you personalize your table for the customer facing part of your website.',$text_domain); ?></p>
                <hr>
                <table>

                    <tbody>

                        <tr>
                            <td>
                                <label for=""><?php _e('Filtering',$text_domain); ?></label>
                                <br>
                                <small><?php _e('This will enable a searchbox on top of your table where users can search your table in real time.',$text_domain); ?></small>
                            </td>
                            <td><input name="jtrt-table-data[jtTableEnableFilters]" type="checkbox" <?php echo (isset($value['jtTableEnableFilters']) ? "checked" : ""); ?>></td>
                        </tr>
                        <tr>
                            <td>
                                <label for=""><?php _e('Sorting',$text_domain); ?></label>
                                <br>
                                <small><?php _e('This will allow users in the frontend to sort your table by clicking on the column headers.',$text_domain); ?></small>
                            </td>
                            <td><input name="jtrt-table-data[jtTableEnableSorting]" type="checkbox" <?php echo (isset($value['jtTableEnableSorting']) ? "checked" : ""); ?>></td>
                        </tr>
                        <tr>
                            <td>
                                <label for=""><?php _e('Pagination',$text_domain); ?></label>
                                <br>
                                <small><?php _e('This option will split your table into multiple pages. Recommended if your table has a lot of rows.',$text_domain); ?></small>
                            </td>
                            <td><input name="jtrt-table-data[jtTableEnablePaging]" type="checkbox" <?php echo (isset($value['jtTableEnablePaging']) ? "checked" : ""); ?>></td>
                            <td><input name="jtrt-table-data[jtTableEnablePagingCnt]" type="number" value="<?php echo (isset($value['jtTableEnablePagingCnt']) ? $value['jtTableEnablePagingCnt'] : "10"); ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <label for=""><?php _e('Row Highlighting',$text_domain); ?></label>
                                <br>
                                <small><?php _e('If enabled, this option will add a highlighting effect on your table rows when the user hovers over them.',$text_domain); ?></small>
                            </td>
                            <td><input name="jtrt-table-data[jtTableEnableRowHighlight]" type="checkbox" <?php echo (isset($value['jtTableEnableRowHighlight']) ? "checked" : ""); ?>></td>
                            <td><input class="jtcoloreditpickerOpts" novalidate name="jtrt-table-data[jtTableEnableRowHighlightcol]" type="text" value="<?php echo (isset($value['jtTableEnableRowHighlightcol']) ? $value['jtTableEnableRowHighlightcol'] : "rgb(255,255,255)"); ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <label for=""><?php _e('Column Highlighting',$text_domain); ?></label>
                                <br>
                                <small><?php _e('If enabled, this option will add a highlighting effect on your table columns when the user hovers over them.',$text_domain); ?></small>
                            </td>
                            <td><input name="jtrt-table-data[jtTableEnableColHighlight]" type="checkbox" <?php echo (isset($value['jtTableEnableColHighlight']) ? "checked" : ""); ?>></td>
                            <td><input class="jtcoloreditpickerOpts" novalidate name="jtrt-table-data[jtTableEnableColHighlightcol]" type="text" value="<?php echo (isset($value['jtTableEnableColHighlightcol']) ? $value['jtTableEnableColHighlightcol'] : "rgb(255,255,255)"); ?>"></td>
                        </tr>
                    </tbody>

                </table>
            </div> <!-- opt sec 1 -->
            <div id="optionsSection4" class="optionsPagejt">
                <h2><?php _e('Documentation',$text_domain); ?></h2>
                <p><?php _e('Coming Soon!',$text_domain); ?></p>
                              
            </div> <!-- opt sec 1 -->
        </div>

    </div>
        

</div> <!-- step 2 -->