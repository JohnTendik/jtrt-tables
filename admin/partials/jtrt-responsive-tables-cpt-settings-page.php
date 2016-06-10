<?php 

add_action('admin_menu' , 'jtrt_settings_enable_pages'); 

function jtrt_settings_enable_pages() {
    add_submenu_page('edit.php?post_type=jtrt_tables_post', 'JT Responsive tables settings', 'JTRT Settings', 'edit_posts', basename(__FILE__), 'jtrt_display_settings_page');
    add_action( 'admin_init', 'register_jtrt_settings_page_options' );
}

function register_jtrt_settings_page_options() {
	//register our settings
	register_setting( 'jtrt-responsive-options-group', 'xs-bp' );
	register_setting( 'jtrt-responsive-options-group', 'sm-bp' );
	register_setting( 'jtrt-responsive-options-group', 'md-bp' );
    register_setting( 'jtrt-responsive-options-group', 'lg-bp' );
}

function jtrt_display_settings_page(){
    ?>
    
        <div class="wrap">
            <h2>JT Responsive Tables</h2>
            <div class="description">Documentation & Information</div>
            <br/>
            <div class="section group top-header-jtrt-settings">
                <div class="col span_3_of_12">
                    <h3>Getting Started</h3>
                    <p>To get started, please visit the github page by clicking <a href="https://github.com/mythirdeye/jtrt-tables">here</a>, or simply</p>
                    <a href="https://www.youtube.com/watch?v=OTxaksRothY" class="large-btn">Watch Video Tutorial</a>
                </div>
                <div class="col span_3_of_12">
                    <h3>Useful Links</h3>
                    <ul>
                        <li><a href="https://wordpress.org/support/view/plugin-reviews/jtrt-responsive-tables">Review JTRT Tables Plugin</a></li>
                        <li><a href="https://wordpress.org/support/view/plugin-reviews/jtrt-responsive-tables">Rate JTRT Tables Plugin</a></li>
                        <li><a href="https://wordpress.org/plugins/jtrt-responsive-tables/faq/">Frequently Asked Questions</a></li>
                        <li><a href="https://github.com/mythirdeye/jtrt-tables">Bug? Stuck? Need Help?</a></li>
                    </ul>
                </div>
                <div class="col span_6_of_12">
                    <h3>Letter From The Author</h3>
                    <p>Hello, and thank you for downloading my plugin I hope it serves you well.
                    I’m a 21 year old self taught developer trying to learn as much as I can. 
                    This plugin is a portfolio project which happened to be more popular than I 
                    expected. 60+ active users and growing. It doesn’t seem like much but I want
                    to do my best to improve this plugin to better suit you all. </p>
                </div>
            </div>
            <div class="section group">
                <div class="col span_8_of_12">
                    <h3>Footable Breakpoint Settings</h3>
                    <p class="quote-block">
                        "Breakpoints are the heart and soul of FooTable. Whenever your site is viewed on a mobile device, or if the browser window is resized, FooTable checks the width of the table. If that width is smaller than the width of a breakpoint, certain columns in the table will be hidden. FooTable has two default breakpoints : tablet and phone. You can change the default size of these breakpoints below, so that they match your site's theme. "

                        Read more at the plugin documentation
                    </p>
                    <form method="post" action="options.php">
                        <?php settings_fields( 'jtrt-responsive-options-group' ); ?>
                        <?php do_settings_sections( 'jtrt-responsive-options-group' ); ?>
                        <table class="form-table">
                            <tr valign="top">
                            <th scope="row">XS Breakpoint</th>
                            <td><input type="text" name="xs-bp" value="<?php echo get_option('xs-bp') != false ? esc_attr( get_option('xs-bp') ) : "481"; ?>" />px</td>
                            </tr>
                            
                            <tr valign="top">
                            <th scope="row">SM Breakpoint</th>
                            <td><input type="text" name="sm-bp" value="<?php echo get_option('sm-bp') != false ? esc_attr( get_option('sm-bp') ) : "761"; ?>" />px</td>
                            </tr>
                            
                            <tr valign="top">
                            <th scope="row">MD Breakpoint</th>
                            <td><input type="text" name="md-bp" value="<?php echo get_option('md-bp') != false ? esc_attr( get_option('md-bp') ) : "993"; ?>" />px</td>
                            </tr>
                            
                            <tr valign="top">
                            <th scope="row">LG Breakpoint</th>
                            <td><input type="text" name="lg-bp" value="<?php echo get_option('lg-bp') != false ? esc_attr( get_option('lg-bp') ) : "1202"; ?>" />px</td>
                            </tr>
                        </table>
                        
                        <?php submit_button(); ?>

                    </form>
                </div>
                <div class="col span_4_of_12">
                    <h3>Update Notes / Changes (Ver 2.0)</h3>
                    <ol>
                        <li>Updated plugin framework (More OOP oriented/modular/faster/cleaner)</li>
                        <li>Custom post type</li>
                        <li>Better table organization</li>
                        <li>Simpler UI</li>
                        <li>Updated DOCS / Video Tutorial</li>
                        <li>Ability to add custom classes to tables</li>
                        <li>Ability to edit/change table values</li>
                        <li>Added 2 more breakpoints for SM and MED breakpoints!</li>
                        <li>Improved database saving</li>
                        <li>Fixed issue with editing multiple tables at once</li>
                        <li>Fixed issue with improper loading of libraries</li>
                        <li>etc.. Too many to count!</li>
                    </ol>
                    <h3>Please Support This Plugin!</h3>
                    <p>The best and easiest way to support this plugin and the author is to simply post a constructive review or rate the plugin. This will help other users find this plugin and it will help by finding issues and adding features.</p>
                    <h3>Credits</h3>
                    <p>So far this plugin is built and run by me only, no other contributers to this project. However, I make use of various other free scripts, libraries and tools that I did not create or contribute to in any way shape or form therefore I do not take credit for those works. These plugins are Jquery, Footables, and jquerycsvtotable. Full credits goes to their respective authors and contributers. 

                    To learn more about Jquery, click here 
                    To learn more about FooTables, click here 
                    To learn more about jquerycsvtotable, click here</p>
                </div>
            </div>
        </div>
    
    <?php
}


?>