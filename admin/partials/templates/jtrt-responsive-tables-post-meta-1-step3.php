<!--STEP 3-->

<?php $value2 = get_post_meta( $post->ID, 'jtrt_styles_settings',true ); ?>

<div id="jt_step_3" class="">
    <h1>Table Styles</h1>
    <hr>
    <div class="jtrt_options_styles" id="">
        <fieldset id="jtrt_table_styles_type">
            <h2>Table Styles: <small>Choose what kind of style you want your table to have.</small></h2>    
            <ul>
                <li>
                    <select name="jtrt_styles_settings[styleType]" id="jtrt_table_style_type" data-table-style-type="<?php echo (isset($value2['styleType']) ? $value2['styleType'] : "inherit");?>">
                        <option value="inherit">Inherit</option>
                        <option value="bootstrap">Bootstrap</option>
                        <option value="example1">Example</option>
                        <option value="custom">Custom</option>
                    </select>
                </li>
            </ul>
        </fieldset>
        
        <div id="jtrt_inherit_styles" class="jtrt_stylediv">
            <h3>Inherit</h3>
            <p>Inheriting styles is the easiest option. If your wordpress theme already includes styles for tables, your tables created with this plugin will simply default to your theme's styling.</p>
        </div>

        <div id="jtrt_bootstrap_styles" class="jtrt_stylediv">
            <h3>Bootstrap</h3>
            <p>If you simply want minimal bootstrap styling, this is the best option. You can select some options which are included with bootstrap down below.</p>
            <div id="bootstrap_opts_jtrt">
                <fieldset id="">
                <h2>Table Striping: <small>If enabled this, your table rows will have zebra stripes.</small></h2>    
                <ul>
                    <li><label>Enable: <input data-bt-classes-jt="table-striped" type="checkbox" name="jtrt_styles_settings[btTstripes]" value="<?php echo (isset($value2['btTstripes']) ? $value2['btTstripes'] : 'false');?>" id=""></label></li>
                </ul>
                </fieldset>
                
                <fieldset id="">
                <h2>Table Bordered: <small>If enabled this will add border on all sides of the table and cells.</small></h2>    
                <ul>
                    <li><label>Enable: <input data-bt-classes-jt="table-bordered" type="checkbox" name="jtrt_styles_settings[btTborders]" value="<?php echo (isset($value2['btTborders']) ? $value2['btTborders'] : 'false');?>" id=""></label></li>
                </ul>
                </fieldset>
                
                <fieldset id="">
                <h2>Table Hover: <small>Enables a hover state on table rows within a <tbody></small></h2>    
                <ul>
                    <li><label>Enable: <input data-bt-classes-jt="table-hover" type="checkbox" name="jtrt_styles_settings[btThover]" value="<?php echo (isset($value2['btThover']) ? $value2['btThover'] : 'false');?>" id=""></label></li>
                </ul>
                </fieldset>
                
                <fieldset id="">
                <h2>Table Condensed: <small>Makes table more compact by cutting cell padding in half <tbody></small></h2>    
                <ul>
                    <li><label>Enable: <input data-bt-classes-jt="table-condensed" type="checkbox" name="jtrt_styles_settings[btTsmall]" value="<?php echo (isset($value2['btTsmall']) ? $value2['btTsmall'] : 'false');?>" id=""></label></li>
                </ul>
                </fieldset>
            </div>
            <hr>
    
            <div class="jtrt_table_container_styles">
                <table class="jtrt_style_pig_bt table">
                    <thead>
                        <th>Header 1</th>
                        <th>Header 2</th>
                        <th>Header 3</th>
                        <th>Header 4</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Row 1</td>
                            <td>Row 1</td>
                            <td>Row 1</td>
                            <td>Row 1</td>
                        </tr>
                        <tr>
                            <td>Row 2</td>
                            <td>Row 2</td>
                            <td>Row 2</td>
                            <td>Row 2</td>
                        </tr>
                        <tr>
                            <td>Row 3</td>
                            <td>Row 3</td>
                            <td>Row 3</td>
                            <td>Row 3</td>
                        </tr>
                        <tr>
                            <td>Row 4</td>
                            <td>Row 4</td>
                            <td>Row 4</td>
                            <td>Row 4</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="jtrt_example1_styles" class="jtrt_stylediv">
            <h3>Example Styles</h3>
            <p>The following are example styles created with the custom styling options. <strong>These will still style your tables in the front-end</strong>. These are some of the posibilities when using the custom styles section.</p>
            <div id="example_opts_jtrt">
                <fieldset id="">
                    <h2>Example Styles: <small>Choose what kind of style you want your table to have.</small></h2>    
                    <ul>
                        <li>
                            <select name="jtrt_styles_settings[exampleStyle]" id="jtrt_table_exstyle_type" data-table-style-type="<?php echo (isset($value2['exampleStyle']) ? $value2['exampleStyle'] : "example1");?>">
                                <option value="example1">Example 1</option>
                                <option value="example2">Example 2</option>
                                <option value="example3">Example 3</option>
                                <option value="example4">Example 4</option>
                                <option value="example5">Example 5</option>
                                <option value="example6">Example 6</option>
                                <option value="example7">Example 7</option>
                                <option value="example8">Example 8</option>
                                <option value="example9">Example 9</option>
                                <option value="example10">Example 10</option>
                            </select>
                        </li>
                    </ul>
                </fieldset>
            </div>
            <hr>
            <div id="jtrt_table_container_styles_example">
                <table class="jtrt_example_pig">
                    <thead>
                        <th>Header 1</th>
                        <th>Header 2</th>
                        <th>Header 3</th>
                        <th>Header 4</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Row 1</td>
                            <td>Row 1</td>
                            <td>Row 1</td>
                            <td>Row 1</td>
                        </tr>
                        <tr>
                            <td>Row 2</td>
                            <td>Row 2</td>
                            <td>Row 2</td>
                            <td>Row 2</td>
                        </tr>
                        <tr>
                            <td>Row 3</td>
                            <td>Row 3</td>
                            <td>Row 3</td>
                            <td>Row 3</td>
                        </tr>
                        <tr>
                            <td>Row 4</td>
                            <td>Row 4</td>
                            <td>Row 4</td>
                            <td>Row 4</td>
                        </tr>
                    </tbody>
                </table>
            </div>    
        </div>

        <div id="jtrt_custom_styles" class="jtrt_stylediv">
            <h3>Custom Styles</h3>
            <p>Coming soon! Unfortunately this is taking longer than expected. I didn't want to push an uncomplete feature which could potentially cause issues.</p>
        </div>
        
    </div>
    
    
    <div class="jt_nav_container clearfix">
        <a href="#" data-jt-steps-dir="next" class="jt_steps_nav_btn">NEXT</a>
        <a href="#" data-jt-steps-dir="prev" class="jt_steps_nav_btn">PREV</a>
    </div>
</div>
<!--STEP 3-->