<div id="step1" class="jtrteditorsection jtrteditorshow">
        <nav id="jteditortoobar">
            <ul>
                <li><?php _e('File',$text_domain); ?>
                    <ul>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="handleImport" data-jtrt-editor-func-val="import"><?php _e('Import CSV',$text_domain); ?></li>
                        <li style="display:none;" id="inputCSVbox"><input style="" type="file" name="pic" accept="text/csv, .csv, .tsv"></li>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="handleImport" data-jtrt-editor-func-val="export"><?php _e('Export Table',$text_domain); ?></li>
                        <span></span>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="clearTable" data-jtrt-editor-func-val="clearTable"><?php _e('Clear Table',$text_domain); ?></li>
                        <span></span>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="printTable" data-jtrt-editor-func-val="print"><?php _e('Print',$text_domain); ?></li>                        
                    </ul>
                </li>
                <li><?php _e('Edit',$text_domain); ?>
                    <ul>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="rudo" data-jtrt-editor-func-val="undo"><?php _e('Undo',$text_domain); ?><div class="jtkeycodetoolbar">Ctrl + Z</div></li>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="rudo" data-jtrt-editor-func-val="redo"><?php _e('Redo',$text_domain); ?><div class="jtkeycodetoolbar">Ctrl + Y</div></li>
                        <span></span>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="findAndReplace" data-jtrt-editor-func-val=""><?php _e('Find & Replace',$text_domain); ?></li>         <span></span>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="deleteStuff" data-jtrt-editor-func-val="value"><?php _e('Delete Values',$text_domain); ?></li>       
                    </ul>
                </li>
                <li><?php _e('Insert',$text_domain); ?>
                    <ul>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="insertStuff" data-jtrt-editor-func-val="row,0"><?php _e('Row above',$text_domain); ?></li>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="insertStuff" data-jtrt-editor-func-val="row,1"><?php _e('Row below',$text_domain); ?></li>
                        <span></span>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="insertStuff" data-jtrt-editor-func-val="col,0"><?php _e('Column left',$text_domain); ?></li>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="insertStuff" data-jtrt-editor-func-val="col,1"><?php _e('Column right',$text_domain); ?></li>
                        <span></span>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="insertImg" data-jtrt-editor-func-val=""><?php _e('Image',$text_domain); ?></li>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="insertLink" data-jtrt-editor-func-val=""><?php _e('Link',$text_domain); ?></li> 
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="addGraph" data-jtrt-editor-func-val=""><?php _e('Graph',$text_domain); ?><div class="jtkeycodetoolbar">Coming Soon!</div></li>      
                    </ul>
                </li>
                <li><?php _e('Format',$text_domain); ?>
                    <ul>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="editCellText" data-jtrt-editor-func-val="font-weight" data-jtrt-editor-func-val2="bold"><?php _e('Bold',$text_domain); ?></li>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="editCellText" data-jtrt-editor-func-val="font-style" data-jtrt-editor-func-val2="italic"><?php _e('Italic',$text_domain); ?></li>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="editCellText" data-jtrt-editor-func-val="text-decoration" data-jtrt-editor-func-val2="underline"><?php _e('Underline',$text_domain); ?></li>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="editCellText" data-jtrt-editor-func-val="text-decoration" data-jtrt-editor-func-val2="line-through"><?php _e('Strikethrough',$text_domain); ?></li>
                        <span></span>
                        <li><?php _e('Align',$text_domain); ?>
                            <ul class="jtfileinnerul">
                                <li class="jttableditor-menubtns" data-jtrt-editor-func="editCellText" data-jtrt-editor-func-val="className" data-jtrt-editor-func-val2="htLeft"><?php _e('Left',$text_domain); ?></li>
                                <li class="jttableditor-menubtns" data-jtrt-editor-func="editCellText" data-jtrt-editor-func-val="className" data-jtrt-editor-func-val2="htCenter"><?php _e('Center',$text_domain); ?></li>
                                <li class="jttableditor-menubtns" data-jtrt-editor-func="editCellText" data-jtrt-editor-func-val="className" data-jtrt-editor-func-val2="htRight"><?php _e('Right',$text_domain); ?></li>
                                <li class="jttableditor-menubtns" data-jtrt-editor-func="editCellText" data-jtrt-editor-func-val="className" data-jtrt-editor-func-val2="htJustify"><?php _e('Justify',$text_domain); ?></li>
                            </ul>
                        </li>
                        
                    </ul>
                </li>
                <li><?php _e('View',$text_domain); ?>
                    <ul>
                        <li><?php _e('Guidelines',$text_domain); ?>
                            <ul class="jtfileinnerul">
                                <li class="jttableditor-menubtns" data-jtrt-editor-func="hideGuideLines" data-jtrt-editor-func-val="show"><?php _e('Show',$text_domain); ?></li>
                                <li class="jttableditor-menubtns" data-jtrt-editor-func="hideGuideLines" data-jtrt-editor-func-val="hide"><?php _e('Hide',$text_domain); ?></li>
                            </ul>
                        </li>
                        <span></span>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="hideInputBox" data-jtrt-editor-func-val="hideshow"><?php _e('Value Box',$text_domain); ?></li>                  
                        <span></span>
                        <li class="jttableditor-menubtns" data-jtrt-editor-func="hideHeaders" data-jtrow-headers='shown' data-jtrt-editor-func-val="colHeaders"><?php _e('Column Headers',$text_domain); ?></li>
                    </ul>
                </li>
                <li><?php _e('Tools',$text_domain); ?>
                    <ul>
                        <li><?php _e('Sort Column',$text_domain); ?>
                            <ul class="jtfileinnerul">
                                <li class="jttableditor-menubtns" data-jtrt-editor-func="sortData" data-jtrt-editor-func-val="true"><?php _e('Asc',$text_domain); ?></li>
                                <li class="jttableditor-menubtns" data-jtrt-editor-func="sortData" data-jtrt-editor-func-val="false"><?php _e('Desc',$text_domain); ?></li>
                                
                            </ul>
                        </li>           
                    </ul>
                </li>
            </ul>
        </nav>
        <nav id="jteditbottomtoolbar">
            <ul>
                <li id="jtundo" data-jtrt-btnType="undo"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/undo.png" alt=""></li>
                <li id="jtredo" data-jtrt-btnType="redo"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/redo.png" alt=""></li>
                <span></span>
                <li class="jtedittexttoolbar" id="jtboldtext" data-jtrt-toolbar-opt="font-weight" data-jtrt-toolbar-opt-val="bold"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/bold-text.png" alt=""></li>
                <li class="jtedittexttoolbar" id="jtitalictext" data-jtrt-toolbar-opt="font-style" data-jtrt-toolbar-opt-val="italic"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/italic-text.png" alt=""></li>
                <li class="jtedittexttoolbar" id="jtunderlinetext" data-jtrt-toolbar-opt="text-decoration" data-jtrt-toolbar-opt-val="underline"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/underline-text.png" alt=""></li>
                <li id="jteditfont" class="jtrt-toolbar-more">
                    <img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/edit-font.png" alt="">
                    <ul>
                        <div>
                            <p style="margin:0;"><?php _e('Font Family:',$text_domain); ?></p>
                            <select id="">
                                <?php
                                    $availableFonts = explode(",","Inherit,Arial,Helvetica,Arial Black,Bookman Old Style,Comic Sans MS,Courier,Courier New,Garamond,Georgia,Impact,Lucida Console,Lucida Sans Unicode,MS Sans Serif,MS Serif,Palatino Linotype,Symbol,Tahoma,Times New Roman,Trebuchet MS,Verdana");
                                    foreach ($availableFonts as $value){
                                        echo "<option value='$value'>$value</option>";
                                    }
            
                                ?>
                            </select>
                        </div>
                        <div>
                            <p style="margin:0;"><?php _e('Font Size:',$text_domain); ?></p>
                            <div class="jtrtEditorBtnGrp">
                                <input novalidate type="number" min='10' max='72' style="width:100%;">
                                <button id="jtsetfontsizebtn"><?php _e('Set',$text_domain); ?></button>
                            </div>
                        </div>
                        <div>
                            <p style="margin:0;"><?php _e('Font Color:', $text_domain); ?></p>
                            <div class="jtrtEditorBtnGrp">
                                <input class="jtcoloreditpicker" id="jtfontcolor" type="text" novalidate>
                                <button class="jtsetbutton" id="jtsetfontcolorbtn"><?php _e('Apply',$text_domain); ?></button>
                            </div>
                        </div>
                       
                    </ul>
                </li>
                <li id="jthighlight" class="jtrt-toolbar-more"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/highlight.png" alt="">
                    <ul>
                        <div>
                            <p style="margin:0;"><?php _e('Cell Color',$text_domain); ?></p>
                            <div class="jtrtEditorBtnGrp">
                                <input class="jtcoloreditpicker" id="jtcellcolor" type="text" novalidate>
                                <button class="jtsetbutton" id="jtsetcellcolorbtn"><?php _e('Apply',$text_domain); ?></button>
                            </div>
                        </div>             
                    </ul>
                </li>
                <span></span>
                <li class="jtalignbtn" data-align-opt="htLeft"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/align-left.png" alt=""></li>
                <li class="jtalignbtn" data-align-opt="htCenter"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/align-center.png" alt=""></li>
                <li class="jtalignbtn" data-align-opt="htRight"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/align-right.png" alt=""></li>
                <li class="jtalignbtn" data-align-opt="htJustify"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/align-justify.png" alt=""></li>
                <span></span>
                <li id="jtinsertlink" class="jtrt-toolbar-more"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/link.png" alt="">
                    <ul>
                        <table>
                            <tr>
                                <td><?php _e('Link:',$text_domain); ?></td>
                                <td><input type="text" novalidate><button><?php _e('Insert',$text_domain); ?></button></td>
                            </tr>
                        </table>      
                    </ul>
                </li>
                <span></span>
                <li id="jtbordersbtn" class="jtrt-toolbar-more"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders.png" alt="">
                    <ul>
                        <table>
                            <tr>
                                <td><img class="jtbordrs" data-border-type='{"top":{"hide":true},"right":{"hide":true},"bottom":{"hide":true},"left":{"hide":true}}' src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders-border-none.png" id="jtbrdnone" alt=""></td>
                                <td><img class="jtbordrs" data-border-type='{"top":{"width":1,"color":"#000"},"right":{"width":1,"color":"#000"},"bottom":{"width":1,"color":"#000"},"left":{"width":1,"color":"#000"}}' src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders-border-all.png" id="jtbrdall" alt=""></td>
                                <td><img class="jtbordrs" data-border-type='{"top":{"hide":true},"right":{"hide":true},"bottom":{"hide":true},"left":{"width":"1","color":"#000"}}' src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders-border-left.png" id="jtbrdleft" alt=""></td>
                                <td><img class="jtbordrs" data-border-type='{"top":{"width":"1","color":"#000"},"right":{"hide":true},"bottom":{"hide":true},"left":{"hide":true}}' src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders-border-left.png" id="jtbrdtop" alt=""></td>
                                <td><img class="jtbordrs" data-border-type='{"top":{"hide":true},"right":{"width":"1","color":"#000"},"bottom":{"hide":true},"left":{"hide":true}}' src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders-border-left.png" id="jtbrdright" alt=""></td>
                                <td><img class="jtbordrs" data-border-type='{"top":{"hide":true},"right":{"hide":true},"bottom":{"width":"1","color":"#000"},"left":{"hide":true}}' src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders-border-left.png" id="jtbrdbottom" alt=""></td>
                            </tr>
                            <tr>
                                <td><img class="jtbordrs" data-border-type='{"top":{"hide":true},"right":{"width":"1","color":"#000"},"bottom":{"hide":true},"left":{"width":"1","color":"#000"}}' src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders-border-rightleft.png" alt=""></td>
                                <td><img class="jtbordrs" data-border-type='{"top":{"width":"1","color":"#000"},"right":{"hide":true},"bottom":{"width":"1","color":"#000"},"left":{"hide":true}}' src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders-border-rightleft.png" id="jtbrdtopbot" alt=""></td>
                                <td><img class="jtbordrs" data-border-type='{"top":{"width":"1","color":"#000"},"right":{"hide":true},"bottom":{"hide":true},"left":{"width":"1","color":"#000"}}' src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders-border-lefttop.png" id="jtbrdlefttop" alt=""></td>
                                <td><img class="jtbordrs" data-border-type='{"top":{"width":"1","color":"#000"},"right":{"width":"1","color":"#000"},"bottom":{"hide":true},"left":{"hide":true}}' src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders-border-lefttop.png" id="jtbrdtopright" alt=""></td>
                                <td><img class="jtbordrs" data-border-type='{"top":{"hide":true},"right":{"width":"1","color":"#000"},"bottom":{"width":"1","color":"#000"},"left":{"hide":true}}' src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders-border-lefttop.png" id="jtbrdrightbot" alt=""></td>
                                <td><img class="jtbordrs" data-border-type='{"top":{"hide":true},"right":{"hide":true},"bottom":{"width":"1","color":"#000"},"left":{"width":"1","color":"#000"}}' src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/borders-border-lefttop.png" id="jtbrdbotleft" alt=""></td>
                            </tr>
                        </table>      
                    </ul>
                </li>
                <li id="jthidecolsbtn" class="jtrt-toolbar-more"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/cols.png" alt="">
                    <ul>
                        <table>
                            <tr>
                                <td class="jtfootablehide" data-footab-hidden="xsmall">X-Small</td>
                                <td class="jtfootablehide" data-footab-hidden="small">Small</td>
                                <td class="jtfootablehide" data-footab-hidden="medium">Medium</td>
                                <td class="jtfootablehide" data-footab-hidden="large">Large</td>
                                <td class="jtfootablehide" data-footab-hidden="xlarge">X-Large</td>
                            </tr>
                            <tr>
                                <td><?php _e('Column Type: ',$text_domain); ?></td>
                                <td>
                                    <select id="jtavailcoltype">
                                    <?php
                                        $availColTypes = explode(",",'html,number,text,date');
                                        foreach ($availColTypes as $value){
                                            echo "<option value='$value'>$value</option>";
                                        }
                
                                    ?>
                                    </select>
                                </td>
                                
                            </tr>
                        </table>      
                    </ul>
                </li>
                <li id="jtprinttab"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../css/icons/print.png" alt=""></li>
            </ul>
        </nav>
        <nav id="jteditbottomvalbar">
            <ul>
                <li><?php _e('Value:',$text_domain); ?></li>
                <li><input type="text" style="width:100%" id="jtinputvalbox"></li>
            </ul>
        </nav>
        <div id="jtrt-table-handson" style="overflow:hidden;max-height:441px;height:auto;width:100%;max-width:100%;overflow-y:scroll"></div>
</div>
        
