# JTRT Responsive Tables Plugin
This is a Wordpress Plugin designed to help users easily create responsive tables in the backend of their website, without having to read or write code. The plugin makes use of CSV table formats to convert it into responsive HTML. It then uses FooTable's engenius responsive scripts to make the html5 behave responsively. 

## FooTables
JT Responsive Tables plugin makes use of FooTable's engenius scripts to create responsive tables. 

### What is Footables?
[FooTable](https://github.com/fooplugins/FooTable/blob/V2/README.md) is a jQuery plugin that transforms your HTML tables into expandable responsive tables. This is how it works:

It hides certain columns of data at different resolutions (we call these breakpoints).
Rows become expandable to reveal any hidden data.
So simple! Any hidden data can always be seen just by clicking the row.

## Demo Preview
(http://cdn.makeagif.com/media/7-21-2015/qHS6BO.gif)

## Setup Instructions
1. Download the jtrt-tables-master folder onto your computer.
2. Upload the jtrt-tables.zip file into your wordpress plugins page.
3. Activate the plugin in the backend from the plugins page. 
4. Enjoy.

## How To Use
Before you start using this plugin, always rememeber to press "Save Changes" button to save changes after you've changed values. Otherwise, the plugin is known to throw off some errors. 

###Step 1: Table Settings
Under the Table Settings page is where you can change the breakpoints sizes for both mobile and tablet sizes. Currently there are two settings available in the plugin, those being the custom breakpoints. More settings will appear in this tab when they become available.

###Step 2: Table Generator [1]
Under the table generator tab, you first need to upload a CSV file to the database by either using an external link or the file uploader. Once you've uploaded the file, you must press the blue "Save Changes" button for the plugin to register the CSV file. 

###Step 3: Table Generator [2]
Once you've saved changes, you can press the "Generate Table" button and a live representation of your table will appear below. 

###Step 4: Table Generator [3]
Your job now is to select which columns you want hidden on the tablet and phone sizes. You can do this by clicking on the headers in the live preview table that you generated in the step before.
(http://cdn.makeagif.com/media/7-21-2015/p5UNG4.gif)

###Step 5: Table Generator [4]
There are two buttons under the table controls settings labeled "Mobile" and "Tablet". These buttons allows you to select which columns you want hidden on both phone and tablet sizes. The blue highlighted columns will ONLY be hidden on the Phone sizes. The yellow highlighted columns with ONLY be hidden on the Tablet sizes. The red highlighted columns will be hidden on both the Tablet and Mobile sizes. The columns with no highlight will show up no matter what size. 
(http://cdn.makeagif.com/media/7-21-2015/100PDB.gif)

###Step 6: Table Generator [5]
Once you have selected which columns you want to hide on which sizes, you can click the "Generate HTML" button and your custom made, responsive html5 will be ready to copy and paste into your wordpress website. 

## Planned Features For The Future
This was a spin-off of a custom plugin I had to create for a client. I realized it was a great idea and it would help save a lot of time for some wordpress users who don't know how to handle HTML code properly. Its version 1 so its primative, but here are my planned updates for the future:

1. Ability to add custom JS and CSS
2. Ability to switch between different styles
3. Ability to add custom breakpoints, and sizes
4. Shortcode support

