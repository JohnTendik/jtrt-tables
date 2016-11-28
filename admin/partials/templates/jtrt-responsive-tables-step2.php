<?php $value = get_post_meta( $post->ID, 'jtrt_data_settings',true ); ?>

<div id="step2" class="jtrteditorsection">
        
    <div id="jtsupportcolumn">

        <div>
            <h3>Support Further Development!</h3>
            <p>If you like this plugin, please consider supporting future development by giving it a positive review on the wordpress plugin page. This help others see this plugin and motivates me to keep building.</p>
        </div>

        <div>
            <h3>Support</h3>
            <p>If you need support, or experience bugs or any issues, please create a ticket on my github page and I will do my best to help you out. Thank you!</p>
        </div>

        <div>
            <h3>Credits</h3>
            <p>I'd like to thank Footable, HandsOnTable, DataTables, jQuery, Wordpress, Freepik, colorPicker, StackOverflow, for making this plugin possible!</p>
        </div>
    </div>

    <div id="jtoptionsContainer">

        <div class="leftSidejt">
            <ul>
                <li data-jtrt-editor-section-id="1" class="active">General Options</li>
                <li data-jtrt-editor-section-id="2" >Responsive Options</li>
                <li data-jtrt-editor-section-id="3">Front-end Options</li>
                <li data-jtrt-editor-section-id="4">DOCS</li>
            </ul>
        </div>

        <div class="rightSidejt">

            <div id="optionsSection1" class="optionsPagejt jtoptionsshow">
                <h2>General Options</h2>
                <p>These are general options for your table.</p>
                <hr>
                <table>

                    <tbody>

                        <tr>
                            <td>
                                <label for="">Show Table Title</label>
                                <br>
                                <small>This will enable your table title in the front-end.</small>
                            </td>
                            <td><input name="jtrt-table-data[jtShowTableTitle]" type="checkbox" <?php echo (isset($value['jtShowTableTitle']) ? "checked" : ""); ?>></td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Title Position</label>
                                <br>
                                <small>Select the spot you want the title to show</small>
                            </td>
                            <td>
                                <select id="" name="jtrt-table-data[jtShowTableTitlePos]">
                                    <?php 
                                        $positionsTitlejt = array('top,left'=>'Top Left','top,center'=>'Top Center','top,right'=>'Top Right','bottom,left'=> 'Bottom Left','bottom,center'=>'Bottom Center','bottom,right'=>'Bottom Right'); 
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
                <h2>Responsive Options</h2>
                <p>JTRT Table include 3 different responsive options for you to choose from.</p>
                <hr>
                <table>

                    <tbody>

                        <tr>
                            <td>
                                <label for="">Responsive Type</label>
                                <br>
                                <small>Select how you want your table to respond on smaller screens</small>
                            </td>
                            <td>
                                <select id="jtresponsiveoptionscontainerselect" name="jtrt-table-data[jtTableResponsiveStyle]">
                                    <?php 
                                        $jtTableResponsivestyle = array("scroll"=>"Classic Scroller", "footable"=>"Column Hiding", "stack"=>"Column Stacking"); 
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
                        <strong>Scrolling</strong>
                        <p>This option will add a scrollbar on your table where you can scroll left-right when the size of the page gets smaller. This is usually the least responsive option.</p>
                    </div>
                    <div data-jtresponsive-select="footable">
                        <hr>
                        <strong>Hiding</strong>
                        <p>This option will hide some of your columns when the page gets smaller. Hidden columns can be easily accessed by clicking the row content. If you would like more information about this option, please refer to the FooTables documentation. </p>
                        <br/>
                        <em>Custom Breakpoints</em>
                        <table>

                            <tbody>
                                <tr>
                                    <td>
                                        <label for="">X-Large Breakpoint</label>
                                        <br>
                                        <small>Select the pixel size you want the X-Large breakpoint to take effect.</small>
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
                                        <label for="">Large Breakpoint</label>
                                        <br>
                                        <small>Select the pixel size you want the Large breakpoint to take effect.</small>
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
                                        <label for="">Medium Breakpoint</label>
                                        <br>
                                        <small>Select the pixel size you want the Medium breakpoint to take effect.</small>
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
                                        <label for="">Small Breakpoint</label>
                                        <br>
                                        <small>Select the pixel size you want the Small breakpoint to take effect.</small>
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
                                        <label for="">X-Small Breakpoint</label>
                                        <br>
                                        <small>Select the pixel size you want the X-Small breakpoint to take effect.</small>
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
                        <strong>Stacking</strong>
                        <p>This option will automatically stack your columns once the page is below 768px.</p>
                        <table>

                            <tbody>

                                <tr>
                                    <td>
                                        <label for="">Prefered Breakpoint</label>
                                        <br>
                                        <small>Select the table size at which you want your table columns to stack.</small>
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
                <h2>Front-End Options</h2>
                <p>These options will help you personalize your table for the customer facing part of your website.</p>
                <hr>
                <table>

                    <tbody>

                        <tr>
                            <td>
                                <label for="">Filtering</label>
                                <br>
                                <small>This will enable a searchbox on top of your table where users can search your table in real time.</small>
                            </td>
                            <td><input name="jtrt-table-data[jtTableEnableFilters]" type="checkbox" <?php echo (isset($value['jtTableEnableFilters']) ? "checked" : ""); ?>></td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Sorting</label>
                                <br>
                                <small>This will allow users in the frontend to sort your table by clicking on the column headers.</small>
                            </td>
                            <td><input name="jtrt-table-data[jtTableEnableSorting]" type="checkbox" <?php echo (isset($value['jtTableEnableSorting']) ? "checked" : ""); ?>></td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Pagination</label>
                                <br>
                                <small>This option will split your table into multiple pages. Recommended if your table has a lot of rows.</small>
                            </td>
                            <td><input name="jtrt-table-data[jtTableEnablePaging]" type="checkbox" <?php echo (isset($value['jtTableEnablePaging']) ? "checked" : ""); ?>></td>
                            <td><input name="jtrt-table-data[jtTableEnablePagingCnt]" type="number" value="<?php echo (isset($value['jtTableEnablePagingCnt']) ? $value['jtTableEnablePagingCnt'] : "10"); ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Row Highlighting</label>
                                <br>
                                <small>If enabled, this option will add a highlighting effect on your table rows when the user hovers over them.</small>
                            </td>
                            <td><input name="jtrt-table-data[jtTableEnableRowHighlight]" type="checkbox" <?php echo (isset($value['jtTableEnableRowHighlight']) ? "checked" : ""); ?>></td>
                            <td><input class="jtcoloreditpickerOpts" novalidate name="jtrt-table-data[jtTableEnableRowHighlightcol]" type="text" value="<?php echo (isset($value['jtTableEnableRowHighlightcol']) ? $value['jtTableEnableRowHighlightcol'] : "rgb(255,255,255)"); ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Column Highlighting</label>
                                <br>
                                <small>If enabled, this option will add a highlighting effect on your table columns when the user hovers over them.</small>
                            </td>
                            <td><input name="jtrt-table-data[jtTableEnableColHighlight]" type="checkbox" <?php echo (isset($value['jtTableEnableColHighlight']) ? "checked" : ""); ?>></td>
                            <td><input class="jtcoloreditpickerOpts" novalidate name="jtrt-table-data[jtTableEnableColHighlightcol]" type="text" value="<?php echo (isset($value['jtTableEnableColHighlightcol']) ? $value['jtTableEnableColHighlightcol'] : "rgb(255,255,255)"); ?>"></td>
                        </tr>
                    </tbody>

                </table>
            </div> <!-- opt sec 1 -->
            <div id="optionsSection4" class="optionsPagejt">
                <h2>Documentation</h2>
                <p>Coming Soon!</p>
                              
            </div> <!-- opt sec 1 -->
        </div>

    </div>
        

</div> <!-- step 2 -->