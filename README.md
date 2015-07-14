# JTRT Responsive Tables Plugin
This is a Wordpress Plugin designed to help users easily create responsive tables in the backend without having to read or write code. This is version 1, and is very basic but still functional. The plugin makes use of CSV table formats to convert it into responsive HTML. 

## FooTables
JT Responsive Tables plugin makes use of FooTable's engenius scripts to create responsive tables. 

### What is Footables?
[FooTable](https://github.com/fooplugins/FooTable/blob/V2/README.md) is a jQuery plugin that transforms your HTML tables into expandable responsive tables. This is how it works:

It hides certain columns of data at different resolutions (we call these breakpoints).
Rows become expandable to reveal any hidden data.
So simple! Any hidden data can always be seen just by clicking the row.

## Setup Instructions
1. Download the jtrt-tables folder onto your computer.
2. Upload the jtrt-tables folder into your wordpress plugins directory.
3. Activate the plugin in the backend from the plugins page. 
4. Enjoy.

## How To Use
The plugin is very simple but because it is in its first stage, it is still primative. 
You can access the JTRT tables settings page under the settings -> JT R. Tables sub menu. 

First, you need to upload a CSV file by either using the file uploader or using an external link. Once you paste the link into the inputbox, you have to save the form using the "Save Changes" button otherwise the generate table link wont work. 

Once the page has been saved, you can generate the table by clicking the "generate table" button. 

When you see the table, your job is to select the rows that you want hidden when on the mobile sizes by clicking on the header columns. When you click on the header, the rows will turn blue. These blue rows will be hidden when your shrink the size of the screen. The rows that are NOT blue, will be visible on the mobile sizes. 

Note** You should have a maximum of 4 rows visible when on the mobile sizes otherwise the table will stretch outside of the page. For example if your table has 12 columns, at least 8 of those should be hidden.

The last step is, once you select all the rows you want hidden, click the generate HTML link and a textarea will appear with your HTML code. Your job is to simply COPY & PASTE that into your posts and the table will be responsive! 

## Planned Features For The Future
This was a spin-off of a custom plugin I had to create for a client. I realized it was a great idea and it would help save a lot of time for some wordpress users who don't know how to handle HTML code properly. Its version 1 so its primative, but here are my planned updates for the future:

1. Ability to add custom JS and CSS
2. Ability to switch between different styles
3. Ability to add custom breakpoints, and sizes
4. Shortcode support

