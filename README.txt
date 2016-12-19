=== JTRT Responsive Tables ===
Contributors: MyThirdEye
Donate link: //
Tags: responsive tables, responsive, table, table generator, csv to table, csv, convert csv, responsive table generator, foo tables, responsive table, mobile tables, html table generator, html5 table
Requires at least: 4.0
Tested up to: 4.6.1
Stable tag: 4.0.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily create beautiful, responsive HTML tables in the backend using the most advanced table editor for Wordpress.

== Description ==

= JTRT Responsive Tables =
 
JTRT Responsive Tables is a plugin designed to help average wordrpess users with creating amazing responsive tables for their websites without having to deal with HTML or CSS. It is now easier than ever to create tables!

= Features =

* Simple WYSIWYG backend table editor
* Covert your excel CSV files to responsive html with a few clicks
* 5 Custom responsive breakpoint sizes (XS SM MD LG XL)
* Edit table cells within the backend
* Easily add links/images to your table
* Custom breakpoints for each table
* Support for multiple tables on one page
* Custom shortcode, easy to use
* 3 Different responsive types
* Edit Cell font-weight, font-family, text-decoration, font-size, font-color with the click of a button!
* Custom borders for your cells. 
* Custom alignment for your cells
* Table sorting! Sort by column headers.
* Table filtering! Search through your table with a searchbox
* Table pagination! Divide your table up into pages
* Search and Replace
* Multiselect/multiedit cells
* Support for html/images/shortcodes in cells
* UNDO / REDO !!! 
* Context menu, right click to edit
* KEYBOARD SHORTCUTS! CTRL + Z (undo) CTRL + C (COPY) etc
* Read only cells
* Edit Cell Backgrouns
* Custom hover highlight color for rows / columns
* value box for easy value editting
* & more! 

= Getting Started =

This plugin will look and feel very familiar to how you normally edit your tables. I have tried to make it very simple to use, however I'm in the process of updating the documentation for V4, so stay tuned for written guides/videos. 

= Credits =

I'm a 22 year old self-taught student who created to plugin to help users easily create responsive tables on their wordpress website. Originally this was a simple personal project but grew to over 2000+ active installs. I want to thank each and everyone of you who downloaded and used my plugin, it means a lot and I hope it has served you well. Having said this, I didn't create this plugin entirely from scratch. I made use of amazing frameworks and scripts developed by other amazing people who deserve all the credit for their work. This plugin makes use of other plugins which I have not created or contributed to in any way, I do not take credit for these works, the credits belong to their respective authors. These plugins are:
1. [Footable](http://fooplugins.com/plugins/footable-jquery/)
3. [jQuery](https://jquery.com/)
4. [PapaParse](http://papaparse.com/)
5. [HandsOnTable](https://handsontable.com/)
6. [DataTables](https://datatables.net/)
4. Much love to those who helped me with issues, too many awesome people to list, love you all! 

= Support =

If you have any issues, the best way to get help is to contact me through [GitHub](https://github.com/mythirdeye/jtrt-tables). 

== Installation ==

1. Upload `jtrt-tables folder` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Enjoy

== Frequently Asked Questions ==

= How does this plugin work? =

Before this plugin worked by converting CSV files into HTML Tables, but now you can start from scratch and build your table in the backend. The ability to convert CSV files is still here, and improved graatly.  

= How does the responsiveness work? =

This plugin uses FooTables to make the responsiveness happen. It 'hides' columns on smaller sizes so the table isn't squished and looking ugly. Although it hides columns, you can always view the hidden columns by clicking on the rows. 

= Do I need to know any HTML/CSS to use this plugin? =

No, everything happens in the backend using a live representation of your table. You can manually select which columns to hide on the tablet and mobile sizes just by clicking your mouse.

= My table wont show up, I'm getting a cannot found error =

This is mainly caused by the plugin having issues saving to the backend. This issue is usually caused by updating the plugin from previous versions. If you encounter this issue and you upgraded plugins, simply re-install the new version after removing the previous. 

= My links/images wont show up in the front end =

If you can see your images/links in the backend but not on the frontend, then that means you have to set your column type to "html". The plugin does html character escaping unless you specify not to in the column options. 


== Screenshots ==

1. All Tables Page.
2. Table Editor
4. Front End Sample 1
5. Front End Sample 2
6. Front End Sample 2.2

== Changelog ==

= 4.0.2 = 
* Added duplicate function for easy table copying
* Added .pot file for my multilangual friends
* Fixed stacking responsive style
* Cells now accepts the following tags: <em><b><strong><a><u><big><img><i><br><caption><figure><span><hr><ul><li><dl><dd><dt><form><input><div><select><option>
* Fixed undefined column header for stacked columns

= 4.0.1 =
* HotFix* 
* added "apply" button for selecting colors :)
* fixed insert link not working properly
* fixed stacking responsive styler
* POT file incoming for multi-langual support! 
* TSV file support for importing
* Added shortcode Filter [jtrt_table id="1" filterRow="1,2,3" filterCol="2,4"] will hide row 1,2,3 and columns 2 and 4. 
* Fixed issue with table title

= 4.0 =
* added 2 new responsive types
* new table editor
* fixed saving issue
* added new bugs to fix later
* new features include cell styles! 
* lots of new stuff

= 3.0.3.1 =
* Quick hotfix for non saving tables
* php 5.3 Support

= 3.0.3 = 
* Added default column sorting
* Fixed issues with styling

= 3.0.2 =
* Added the the ability to quickly and easily insert links/images
* Fixed issues with page builders not properly loading scripts
* Fixed issues with deactivating plugin
* Fixed uninstall so that the plugin will cleanup after itself
* Minor text fixes -pokes Niantic-

= 3.0.1 =
* Added the ability to move rows
* Minor text fixes

= 3.0.0 = 
* The best update, trust me. - Trump
* add/edit/remove/sort columns
* starting tables from scratch
* 10 sample styles
* minified code
* each table has their own breakpoints
* pagination

= 2.0.4 = 
* fixed sql errors
* better fallback handling
* fixed issues with table styles
* added a "view html" button that now lets you view/copy your table html code.

= 2.0.0 =
* Updated plugin framework (More OOP oriented/modular/faster/cleaner)
* Custom post type
* Better table organization
* Simpler UI
* Updated DOCS / Video Tutorial
* Ability to add custom classes to tables
* Ability to edit/change table values
* Added 2 more breakpoints for SM and MED breakpoints!
* Improved database saving
* Fixed issue with editing multiple tables at once
* Fixed issue with improper loading of libraries
* etc.. Too many to count!

= 1.3.2 =
* Updated backend styles
* Added a new "General Tips" area to the Docs section
* Added a new "Support the plugin" area to the Docs section
* Added a table name option to help better identify different tables
* Fixed issues with tables updating when they aren't supposed to
* Fixed issues with tables showing up above other content

= 1.3 =
* Added a new shortcode method, you can now save tables as shortcodes
* Fixed issues with csv conversion
* Updated backend styles

= 1.2.2 =
* Added the ability to sort and filter the tables
* Fixed headers error
* Fixed some styling issues
* Updated the backend styling
* Added a new video tutorial to the docs section

= 1.2.1 =
* Updated the readme file.

= 1.2 =
* Added A Tabbed menu layout for the back-end.

== Upgrade Notice ==

= 3.0.2 =
Fixed bugs, added ability to quickly and easily insert images/links

= 2.0.4 =
fixed various bugs and issues, improved fallback handling, added view html button that now lets you see your table html code.

= 2.0.3 =
New breakpoints, faster code, cleaner ui, custom classes, WIP table styler, varius bug fixes!

== Arbitrary section ==

This plugin makes use of Foo Tables to create the responsiveness of the tables. 