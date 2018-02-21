var JTrtEditor = function (tableContainer) {

    // Initialize a var Iam to equal the main container just in case we need it
    Iam = this;
    // Grab the container element from the initializing callback
    this.container = tableContainer;
    // Grab the textarea box that stores all our table data
    this.dataBox = jQuery('textarea#jtrt-table-data');

    this.handsOnTab;

    this.farModal = jQuery('#jtFindAndReplaceModal');
    this.linkModal = jQuery('#jtlinkModal');

    this.loader = jQuery('#loaderIco').detach().hide().appendTo('body').css('height',document.documentElement.scrollHeight + 121);

    this.savedTableData = this.getData();

    // This is the settings used to init handsontable the best table editor by far. TY handsontable <3
    this.tableSettings =  {
        autoColumnSize: { syncLimit: 100 }, // first 100 columns will sync resize (browser blocking) - the rest will async resize
        autofill: true, // drag-down, copy-down
        autoRowSize: { syncLimit: 100 },
        autoWrapRow: true, // I dont know, but its useful
        colHeaders: true, // Allow col headers [a,b,c,d,etc]
        columnSorting: true, // allow column sorting        
        customBorders: this.savedTableData[2], // Custom border data for each cell, the way handsontable is setup i have to have separate data for these 
        data: this.savedTableData[0], // Get the table data        
        formulas: true,
        height: 441, // Height of the table editor, this is necessary otherwise the table has problems with rendering        
        manualColumnMove: true, // manual column moving, very nice            
        manualColumnResize: true,
        manualRowMove: true, // Manually move rows. probably not needed since editting the tables are so friken easy
        manualRowResize: true,
        outsideClickDeselects: false, // do not deselect the selected cell(s) if they click outside of the table. VERY IMPORTANT
        renderer: this.safeHtmlRenderer, // Custom renderer so HTML, and custom styles will show up. So mach work man            
        rowHeaders: true, // Allow row headers [1,2,3,4,etc]        
        sortIndicator: true, // the little arrow that shows up if you sort your table by clicking on the headers
        stretchH: 'all', // Stretch the columns to fit max size

        afterOnCellMouseDown: function(event,location,smth){
            // This is the call back I used to change the 'value' input box 
            var jtrt_toolbar_value_input = jQuery('#jtinputvalbox');
            jtrt_toolbar_value_input.val(jQuery(Iam.handsOnTab.getCell(location['row'],location['col'])).html()); // set the value of the input box to equal the first selected cell's data'
            jtrt_toolbar_value_input.attr('data-editting-row',location['row']); // add helper data attributes so I can do more editting later for when the input box is changed
            jtrt_toolbar_value_input.attr('data-editting-col',location['col']); // same as above jeez

            // Get the active editor for handsontable so I can unescape the html characters when they double click to edit
            var activeeditor = Iam.handsOnTab.getCellMeta(location['row'],location['col']).instance.getActiveEditor();
            // Set the original value of the cell to something more legible decodeHTML BRAH
            activeeditor.originalValue = Iam.decodeHtml(activeeditor.originalValue);
		}
	};

    // Start things rolling
    this.init();
};

JTrtEditor.prototype.init = function(){

    // Initializing the handsontable editor
    this.handsOnTab = new Handsontable(this.container, this.tableSettings);    
    
    // there's probably a better way
    var defaultItems = {
        'row_above': {},
        'row_below': {},
        'hsep1': '---------',
        'col_left': {},
        'col_right': {},
        'hsep2': '---------',
        'remove_row': {},
        'remove_col': {},
        'hsep3': '---------',
        'undo': {},
        'redo': {},
        'hsep4': '---------',
        'make_read_only': {},
        'hsep5': '---------',
        'alignment': {},
        'hsep6': '---------',
        'borders': {}
    }

    // placeholder for possible context menu expansion
    var newItems = {};    
    
    this.handsOnTab.updateSettings({
        contextMenu: {
            items: Object.assign({}, defaultItems, newItems)
        },
        cell: this.savedTableData[1]
    });

    // rerender the table after init to get rid of sizing issue
    this.reRenderTable();

    jQuery('.jtedittexttoolbar').on('click',function(){
        Iam.editCellText(jQuery(this).attr('data-jtrt-toolbar-opt'),jQuery(this).attr('data-jtrt-toolbar-opt-val'));
    });

    jQuery(document).on("keypress", "#jteditfont ul input[type='number'],#jtinsertlink ul input[type='text'],#jtinputvalbox,.jtcoloreditpicker,#jtlink", function(event) { 
        return event.keyCode != 13;
    });

    jQuery('.jtrt-toolbar-more').on('click', function(event){

        event.preventDefault();
		event.stopPropagation();

        var selected = Iam.handsOnTab.getSelectedLast();
        if(selected != undefined && selected.length > 0){

            if(jQuery(this).attr('id') == "jtinsertlink"){
                var curlink = "";
                var curval = Iam.decodeHtml(Iam.handsOnTab.getDataAtCell(selected[0],selected[1]));
                if(curval.indexOf('</a>') != -1){
                    curlink = jQuery(Iam.handsOnTab.getCell(selected[0],selected[1])).find('a').attr('href');
                }

                jQuery(this).find('ul input').val(curlink);
                			
            }

            if(jQuery(this).attr('id') == "jteditfont"){
                var selectopt = (Iam.handsOnTab.getCellMeta(selected[0],selected[1])['jtcellstyle'] && Iam.handsOnTab.getCellMeta(selected[0],selected[1])['jtcellstyle']['font-family'] != undefined) ? Iam.handsOnTab.getCellMeta(selected[0],selected[1])['jtcellstyle']['font-family'] : "Inherit";
				var selectopt2 = (Iam.handsOnTab.getCellMeta(selected[0],selected[1])['jtcellstyle'] && Iam.handsOnTab.getCellMeta(selected[0],selected[1])['jtcellstyle']['font-size'] != undefined) ? parseInt(Iam.handsOnTab.getCellMeta(selected[0],selected[1])['jtcellstyle']['font-size']) : 14;
				var selectopt3 = (Iam.handsOnTab.getCellMeta(selected[0],selected[1])['jtcellstyle'] && Iam.handsOnTab.getCellMeta(selected[0],selected[1])['jtcellstyle']['color'] != undefined) ? Iam.handsOnTab.getCellMeta(selected[0],selected[1])['jtcellstyle']['color'] : "#000000";
				
				jQuery(this).find('ul select').val(selectopt);
				jQuery(this).find('ul input[type="number"]').val(selectopt2);

                jQuery(this).find('ul input#jtfontcolor').val(selectopt3).trigger('keyup');
                jQuery(this).find('.wp-color-result').css('background',selectopt3);
            }

            if(jQuery(this).attr('id') == "jthighlight"){
                var selectopt3 = (Iam.handsOnTab.getCellMeta(selected[0],selected[1])['jtcellstyle'] && Iam.handsOnTab.getCellMeta(selected[0],selected[1])['jtcellstyle']['background'] != undefined) ? Iam.handsOnTab.getCellMeta(selected[0],selected[1])['jtcellstyle']['background'] : "#ffffff";
                jQuery(this).find('ul input#jtcellcolor').val(selectopt3).trigger('keyup');
                jQuery(this).find('.wp-color-result').css('background',selectopt3);
            }

            if(jQuery(this).attr('id') == "jthidecolsbtn"){
                var selectopt = (Iam.handsOnTab.getCellMeta(0,selected[1])['jtfootablebps'] ? Iam.handsOnTab.getCellMeta(0,selected[1])['jtfootablebps'] : {
                    "xsmall":"",
                    "small":"",
                    "medium":"",
                    "large":"",
                    "xlarge":""     
                });
								
				var bpopts = jQuery(this).find('.jtfootablehide');
                bpopts.each(function(element,uindx) {
   
                    var thisElem = jQuery(this);
                    var thisvarvaljt = thisElem.attr('data-footab-hidden');

                    if(selectopt[thisvarvaljt] == thisvarvaljt){
                        jQuery(this).addClass('selectedCol');
                    }else{
                        
                        jQuery(this).removeClass('selectedCol');
                    }

                }, this);

                var headerBreakPoints = Iam.handsOnTab.getCellMeta(0,selected[1])['jtfootabcoltype'] || "text";
                jQuery('#jtavailcoltype').val(headerBreakPoints);

            }

            if(jQuery(this).find('ul').css('display') == "none"){
                jQuery(this).find('ul').show();
            }else{
                jQuery(this).find('ul').hide('fast');
            }	
            
        }
    });


    jQuery('.jtrt-toolbar-more, .cp-color-picker').on('click','ul',function(elem){
        elem.preventDefault();
        elem.stopPropagation();
    });

    jQuery('body').on('click',function(event){
        jQuery('.jtrt-toolbar-more ul').hide('fast');
        
    });

    jQuery('#jteditfont ul select').on('change',function(elem){
			
        var vall = jQuery(this).val();			
        Iam.editCellText('font-family',vall);
        
    });

    jQuery('#jteditfont ul button#jtsetfontsizebtn').on('click',function(elem){
			
        var vall = jQuery("#jteditfont ul input[type='number']").val();			
        Iam.editCellText('font-size',vall);
        
    });

    jQuery('#jteditfont ul button#jtsetfontcolorbtn').on('click',function(elem){
			
        var vall = jQuery("#jteditfont ul input#jtfontcolor").val();			
        Iam.editCellText('color',vall);
        
    });

    jQuery('#jthighlight ul button#jtsetcellcolorbtn').on('click',function(elem){
			
        var vall = jQuery("#jthighlight ul input#jtcellcolor").val();			
        Iam.editCellText('background',vall);
        
    });

    jQuery('.jtalignbtn').on('click',function(){

		var vall = jQuery(this).attr('data-align-opt');
        Iam.editCellText("className",vall);
        Iam.reRenderTable();

    });

    jQuery('#jtinsertlink ul button').on('click',function(elem){
			
		var vall = jQuery("#jtinsertlink ul input[type='text']").val();
        Iam.editCellText("insertlink", vall);

    });

    jQuery('.jtbordrs').on('click',function(){

			var selectedBorder = JSON.parse(jQuery(this).attr('data-border-type'));
            var selectedBorderOpt = jQuery(this).attr('id');
			Iam.editCellText("customBorders",selectedBorder,selectedBorderOpt);

    });

    jQuery('#jtprinttab').on('click',Iam.printTable);

    jQuery('#jtinputvalbox').on('keyup',function(){

        var edittingRow = jQuery(this).attr('data-editting-row');
        var edittingCol = jQuery(this).attr('data-editting-col');
        
        if(edittingRow != undefined && edittingCol != undefined){
            Iam.handsOnTab.setDataAtCell(parseInt(edittingRow),parseInt(edittingCol),jQuery(this).val());
        }

    });

    jQuery('.jttableditor-menubtns').on('click',function(e){
        
        e.preventDefault();
        var iam = jQuery(this);

        var func = jQuery(this).attr('data-jtrt-editor-func'),
            funcval = jQuery(this).attr('data-jtrt-editor-func-val');
        if(func == "findAndReplace"){
            Iam.farModal.css('display','block');
        }else if(func == "insertImg"){
            Iam.renderMediaUploader();
        }else if(func == "insertLink"){
            Iam.linkModal.css('display','block');
        }else if(func == "editCellText"){
            var txtVal = iam.attr('data-jtrt-editor-func-val2');
            Iam.editCellText(funcval,txtVal);
        }else{
            Iam[func](funcval,jQuery(this));
        }
        
    });

    
    jQuery('.jtclose').on('click', function() {
        Iam.farModal.css('display','none');
        Iam.linkModal.css('display','none');
    });

    Iam.farModal.find('table td button').on('click', function(e) {
        e.preventDefault();
        var findVal = jQuery('#jtfindandreplacefind').val(),
            repVal = jQuery('#jtfindandreplacereplace').val();

        if(findVal == "" || repVal == ""){
            return;
        }else{
            Iam.farModal.css('display','none');
            Iam.findAndReplace(findVal + "," + repVal);
        }         
    });

    Iam.linkModal.find('table td button').on('click', function(e) {
        e.preventDefault();
        var jtLink = jQuery('#jtlink').val();
        Iam.linkModal.css('display','none');
        Iam.editCellText("insertlink", jtLink);  
    });   


    jQuery('#jthidecolsbtn .jtfootablehide').on('click',function(){
        
        if(jQuery(this).hasClass('selectedCol')){
            jQuery(this).removeClass('selectedCol');
        }else{
            jQuery(this).addClass('selectedCol');
        }

        var hiddenSelectJt = jQuery(this).attr('data-footab-hidden');
        var Iamyo = jQuery(this);
        Iam.loader.fadeIn();

    window.setTimeout(function(){
        var selected = Iam.handsOnTab.getSelectedLast();
        
        if(selected != undefined && selected.length > 0){
            
            Iam.generateSelectionFunc(selected,function(i,t){
                var headerBreakPoints = Iam.handsOnTab.getCellMeta(0,t)['jtfootablebps'] || {
                    "xsmall":"",
                    "small":"",
                    "medium":"",
                    "large":"",
                    "xlarge":""     
                };
               
                if(headerBreakPoints[hiddenSelectJt] != hiddenSelectJt){
                    headerBreakPoints[hiddenSelectJt] = hiddenSelectJt;
                }else{
                    headerBreakPoints[hiddenSelectJt] = "";
                }
                
                Iam.handsOnTab.setCellMeta(0,t,'jtfootablebps',headerBreakPoints);
                Iam.reRenderTable();
            });


        }else{
            alert('You have to first select cells that you want to edit');
        }

        Iam.loader.fadeOut();
    },300);
        
    });



    jQuery('#jtavailcoltype').on('change',function(){


        var coltypejt = jQuery(this).val();
        Iam.loader.fadeIn();

        window.setTimeout(function(){
            var selected = Iam.handsOnTab.getSelectedLast();
            
            if(selected != undefined && selected.length > 0){
                
                Iam.generateSelectionFunc(selected,function(i,t){                                      
                    Iam.handsOnTab.setCellMeta(0,t,'jtfootabcoltype',coltypejt);
                    Iam.reRenderTable();
                });


            }else{
                alert('You have to first select cells that you want to edit');
            }

            Iam.loader.fadeOut();
        },300);

    });

    Iam.reRenderTable();
   

} // init

JTrtEditor.prototype.getData = function(){

    if(this.dataBox.html() !== ""){
        var jtrt_saved_data = JSON.parse(this.dataBox.html());		
        
        return [jtrt_saved_data[0],jtrt_saved_data[1] || {},jtrt_saved_data[2] || [{
        row: 0,
        col: 0,
        left: {
          width: 2,
          color: 'red'
        }
      }]];

    }else{
        return [[
        ['Header 1', 'Header 2', 'Header 3'],
        ['Cell 1', "Cell 2", "Cell 3"],
        ['Cell 1', "Cell 2", "Cell 3"]
        ],[],[{
        row: 0,
        col: 0,
        left: {
          hide:true
        }
      }]];
    }

}

JTrtEditor.prototype.decodeHtml = function(html){
    var txt = document.createElement("textarea");
	txt.innerHTML = html;
	return txt.value;
}

JTrtEditor.prototype.strip_tags = function(input, allowed){

    var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
    commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;

    // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
    allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');

    return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
        return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
    });

}

JTrtEditor.prototype.safeHtmlRenderer = function(instance, td, row, col, prop, value, cellProperties){
  

    Handsontable.renderers.TextRenderer.apply(this, arguments);
    var escaped = Handsontable.helper.stringify(value);
    escaped = Iam.strip_tags(escaped, '<em><b><strong><a><u><big><img><i><br><caption><figure><span><hr><ul><li><dl><dd><dt><form><input><div><select><option>'); //be sure you only allow certain HTML tags to avoid XSS threats (you should also remove unwanted HTML attributes)
    if(value){
        if (value.substring(0,1) != "=") {
            td.innerHTML = jQuery('<textarea />').html(escaped).text();
        }
    }
    

    if(cellProperties['jtcellstyle']!= undefined && cellProperties['jtcellstyle']['font-family'] != undefined){
        td.style.fontFamily = cellProperties['jtcellstyle']['font-family'];
    }
    if(cellProperties['jtcellstyle']!= undefined && cellProperties['jtcellstyle']['font-size'] != undefined){
        jQuery(td).css('font-size', cellProperties['jtcellstyle']['font-size']);
    }
    if(cellProperties['jtcellstyle']!= undefined && cellProperties['jtcellstyle']['font-weight'] != undefined){
        jQuery(td).css('font-weight', cellProperties['jtcellstyle']['font-weight']);
    }
    if(cellProperties['jtcellstyle']!= undefined && cellProperties['jtcellstyle']['font-style'] != undefined){
        jQuery(td).css('font-style', cellProperties['jtcellstyle']['font-style']);
    }
    if(cellProperties['jtcellstyle']!= undefined && cellProperties['jtcellstyle']['text-decoration'] != undefined){
        jQuery(td).css('text-decoration', cellProperties['jtcellstyle']['text-decoration']);
    }
    if(cellProperties['jtcellstyle']!= undefined && cellProperties['jtcellstyle']['color'] != undefined){
        jQuery(td).css('color', cellProperties['jtcellstyle']['color']);
    }
    if(cellProperties['jtcellstyle']!= undefined && cellProperties['jtcellstyle']['background'] != undefined){
        jQuery(td).css('background', cellProperties['jtcellstyle']['background']);
    }

    return td;

}

JTrtEditor.prototype.reRenderTable = function(){
    if (!window.MSInputMethodContext && !document.documentMode) window.dispatchEvent(new Event('resize'));
    this.handsOnTab.colOffset();
    this.handsOnTab.rowOffset();
    this.handsOnTab.render();
    this.handsOnTab.validateCells();
}

JTrtEditor.prototype.handleOnSave = function(event){

    event.preventDefault();

    var tableDataJT = JSON.stringify(Iam.handsOnTab.getData()),
				tableCellDataJT = Iam.handsOnTab.getCellsMeta(),
				tableCellDataNew = [],
				tableCellBorderData = [],
                tableFuncResData = [];

    
    
    JSON.parse(tableDataJT).forEach(function(emel,dataRowIndex){
        

        emel.forEach(function(colEmel,dataColIndex){
            if (colEmel != null && colEmel[0] === "=") {	
                var calculatedCell = jQuery(Iam.handsOnTab.getCell(dataRowIndex,dataColIndex)).html();
                var funcCellData = {
                    "row": dataRowIndex,
                    "col": dataColIndex,
                    "val": calculatedCell
                };
                tableFuncResData.push(funcCellData);
            }
        });
        
    });

    tableCellDataJT.forEach(function(element) {
        var tableCellData = {};

        for (var key in element) {
            // skip loop if the property is from prototype
            if (!element.hasOwnProperty(key)) continue;
            switch(key){
                case "borders":
                    tableCellData[key] = element[key];
                    var tmpBorderObj = {
                        "row": element[key]["row"],
                        "col": element[key]["col"],
                        "top": element[key]["top"],
                        "right": element[key]["right"],
                        "bottom": element[key]["bottom"],
                        "left": element[key]["left"],
                        "border": element[key]["border"],
                    }
                    tableCellBorderData.push(tmpBorderObj);
                    break;
                case "className":
                    tableCellData[key] = element[key].trim();
                    break;
                case "col":
                    tableCellData[key] = element[key];
                    break;
                case "row":
                    tableCellData[key] = element[key];
                    break;
                case "visualCol":
                    tableCellData[key] = element[key];
                    break;
                case "visualRow":
                    tableCellData[key] = element[key];
                    break;
                case "readOnly":
                    tableCellData[key] = element[key];
                    break;
                case "prop":
                    tableCellData[key] = element[key];
                    break;
                case "jtcellstyle":
                    tableCellData[key] = element[key];
                    break;
                case "jtfootablebps":
                    tableCellData[key] = element[key];
                    break;
                case "jtfootabcoltype":
                    tableCellData[key] = element[key];
                    break;
            }				
        }
        tableCellDataNew.push(tableCellData);
    }, this);

    Iam.dataBox.html("["+tableDataJT+","+JSON.stringify(tableCellDataNew)+"," +JSON.stringify(tableCellBorderData)+","+JSON.stringify(tableFuncResData)+"]");
    
    $(this).parents('form#post').submit();
} // End of handleOnSave
	

JTrtEditor.prototype.rudo = function(btnType){
    if(btnType == "undo"){
        if(this.handsOnTab.isUndoAvailable()){
            this.handsOnTab.undo();
        }
    }else{
        if(this.handsOnTab.isRedoAvailable()){
            this.handsOnTab.redo();
        }
    }
}

JTrtEditor.prototype.editCellText = function(opt,vals,borderc){
   
    this.loader.fadeIn();

    window.setTimeout(function() {
        var selected = Iam.handsOnTab.getSelectedLast();
        
        if(selected != undefined && selected.length > 0){
            
            if(opt == "className"){
                Iam.generateSelectionFunc(selected,function(i,t){
                    Iam.handsOnTab.setCellMeta(i,t,'className',vals);
                    Iam.reRenderTable();
                });
            }else if(opt == "insertlink"){
                Iam.generateSelectionFunc(selected,function(i,t){
                    var curval = Iam.decodeHtml(Iam.handsOnTab.getDataAtCell(i,t));
                    if(curval.indexOf('</a>') != -1){
                        var curlink = jQuery(Iam.handsOnTab.getCell(i,t)).find('a').attr('href');
                        var newvl = Iam.strip_tags(curval, '<em><b><strong><u><big><img><i><br><caption><figure><span><hr><ul><li><dl><dd><dt><form><input><div><select><option>');
                        Iam.handsOnTab.setDataAtCell(i, t,"<a href='"+vals+"'>"+newvl+"</a>");
                    }else{
                        Iam.handsOnTab.setDataAtCell(i, t, "<a href='"+vals+"'>"+curval+"</a>");
                    }
                });
                
            }else if(opt == "customBorders"){
                var newbrd = {"border": {
                    "width": 1,
                    "color": "#000",
                    "cornerVisible": false
                }};

                var newupdateborder = {
                    customBorders: [{}]
                }

                
                for(var keyjt in vals){
                    newbrd[keyjt] = vals[keyjt];
                    newupdateborder['customBorders'][0][keyjt] = vals[keyjt];
                }
                Iam.generateSelectionFunc(selected,function(i,t){

                    newbrd['row'] = i;
                    newbrd['col'] = t;

                    newupdateborder['customBorders'][0]['range'] = {
                        from: {
                            row: selected[0],
                            col: selected[1]
                        },
                        to: {
                            row: selected[2],
                            col: selected[3]
                        }
                    }
                    if(borderc == "jtbrdnone"){
                        var borders = document.querySelectorAll('.border_row'+i+'col'+t);
                        
                        for (var Di = 0; Di < borders.length; Di++) {
                            if (borders[Di]) {
                            if (borders[Di].nodeName != 'TD') {
                                var parent = borders[Di].parentNode;

                                if (parent.parentNode) {
                                parent.parentNode.removeChild(parent);
                                }
                            }
                        }}
                        
                    }
                    Iam.handsOnTab.updateSettings(newupdateborder);
                    Iam.handsOnTab.setCellMeta(i,t,'borders',newbrd);
                  
                                    
                    
                });
                 Iam.handsOnTab.runHooks('afterInit');
            }else{
                Iam.generateSelectionFunc(selected,function(i,t){
                    var currentMeta = Iam.handsOnTab.getCellMeta(i,t)['jtcellstyle'] || {};
                    var vall = "inherit";
                    if(currentMeta[opt] != vals){
                        vall = vals;
                    }
                    if(opt == "font-size"){
                    jQuery(Iam.handsOnTab.getCell(i,t)).css('font-size', vall+"px"); 
                    vall += "px";
                    }
                    currentMeta[opt] = vall;
                    jQuery(Iam.handsOnTab.getCell(i,t)).css(opt,vall);
                    Iam.handsOnTab.setCellMeta(i,t,'jtcellstyle',currentMeta);
                });
            }      
            
        }else{
            alert('You have to first select cells that you want to edit');
        }

        Iam.loader.fadeOut();
    },300);
}

JTrtEditor.prototype.generateSelectionFunc = function(selected,callback){
    if(selected[0] > selected[2]){
        for(var i = selected[2]; i < selected[0]+1;i++){
            if(selected[1] > selected[3]){
                for(var t = selected[3]; t < selected[1]+1; t++){
                    callback(i,t);
                }
            }else{
                for(var t = selected[1]; t < selected[3]+1; t++){
                    callback(i,t)
                }
            }
        }
    }else{
        for(var i = selected[0]; i < selected[2]+1;i++){
            if(selected[1] > selected[3]){
                for(var t = selected[3]; t < selected[1]+1; t++){
                    callback(i,t)
                }
            }else{
                for(var t = selected[1]; t < selected[3]+1; t++){
                    callback(i,t)
                }
            }
        }
    }
}

JTrtEditor.prototype.findAndReplace = function(replceval){
    Iam.loader.fadeIn();

    var args = replceval.split(",");

    window.setTimeout(function(){
        Iam.handsOnTab.getData().forEach(function(element,row) {
            element.forEach(function(element2,td) {
                if(element2.indexOf(args[0]) != -1 ){
                    Iam.handsOnTab.setDataAtCell(row,td,element2.replace(args[0],args[1]));
                }
            }, this);
        }, this);

        Iam.loader.fadeOut();
    },300);

}

JTrtEditor.prototype.printTable = function(){
    var divToPrint= jQuery(Iam.container).find('table.htCore')[0];
    newWin= window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
}

JTrtEditor.prototype.handleImport = function(type,elem){
    if(type == "import"){

        elem.siblings( "#inputCSVbox" ).find('input').click().on('change',function(){
          Iam.loader.show();
          var csvFile = jQuery(this)[0].files[0];
          window.setTimeout(function(){            
                Papa.parse(csvFile, {
                        complete: function(results) {
                            if(results.errors.length > 0){
                                alert(results.errors);
                                return;
                            }else{
                                Iam.handsOnTab.populateFromArray(0,0,results.data);
                            }
                            Iam.loader.hide();                    
                        }
                    });
          },300);
        });

    }else if(type == "export"){
        var filename = "JTRTTable.csv";

        var csv = "";

        Iam.handsOnTab.getData().map(function(val,indx){
            val.map(function(v,t){
                csv += v + ",";
            });
            csv += "\n";
        }).join(",");
        
        if (csv == null) return;

        if (navigator.msSaveBlob) { // IE 10+
            var blob = new Blob([csv],{type: "text/csv;charset=utf-8;"});
            navigator.msSaveBlob(blob, filename);
        }
        else {
            if (!csv.match(/^data:text\/csv/i)) {
                csv = 'data:text/csv;charset=utf-8,' + csv;
            }
            data = encodeURI(csv);
            var link = document.createElement('a');
            link.setAttribute('href', data);
            link.setAttribute('download', filename);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}

JTrtEditor.prototype.clearTable = function(type){
    Iam.handsOnTab.clear();
}


JTrtEditor.prototype.deleteStuff = function(type,elem){
    this.loader.fadeIn();

    window.setTimeout(function(){
        var selected = Iam.handsOnTab.getSelectedLast();
        
        if(selected != undefined && selected.length > 0){
            if(type == "value"){
                Iam.generateSelectionFunc(selected,function(i,t){         
                    Iam.handsOnTab.setDataAtCell(i,t,'');
                });
            }
        }else{
            alert('You have to first select cells that you want to edit');
        }
    Iam.loader.fadeOut();
    },300);

}

JTrtEditor.prototype.insertStuff = function(type,elem){
    this.loader.fadeIn();

    var typeStuff = type.split(",");

    window.setTimeout(function(){
        var selected = Iam.handsOnTab.getSelectedLast();
        
        if(selected != undefined && selected.length > 0){
            if(typeStuff[0] == "row"){
                Iam.handsOnTab.alter('insert_row',selected[0] + parseInt(typeStuff[1]));
            }else if(typeStuff[0] == "col"){
                Iam.handsOnTab.alter('insert_col',selected[1] + parseInt(typeStuff[1]));
            }
        }else{
            alert('You have to first select cells that you want to edit');
        }
    Iam.loader.fadeOut();
    },300);

}

JTrtEditor.prototype.renderMediaUploader = function() {
    this.loader.fadeIn();
    
    window.setTimeout(function(){
        var selected = Iam.handsOnTab.getSelectedLast();
        
        if(selected != undefined && selected.length > 0){

            var file_frame, image_data;
        
            if ( undefined !== file_frame ) {
                file_frame.open();
                return;  
            }

            file_frame = wp.media({
                frame:    'post',
                state:    'insert',
                multiple: false
            });

            file_frame.on( 'insert', function() {
                var attachment = file_frame.state().get('selection').first().toJSON();
                Iam.generateSelectionFunc(selected,function(i,t){         
                    Iam.handsOnTab.setDataAtCell(i,t,'<img src="'+attachment.url+'">');
                });
            });

            file_frame.state('embed').on( 'select', function() {
                var state = file_frame.state(),
                    embed = state.props.toJSON();
                Iam.generateSelectionFunc(selected,function(i,t){         
                    Iam.handsOnTab.setDataAtCell(i,t,'<img src="'+embed.url+'">');
                });   
            });
        
            file_frame.open();
        }else{
            alert('You have to first select cells that you want to edit');
        }

    Iam.loader.fadeOut();
    },300);   
}

JTrtEditor.prototype.hideGuideLines = function(type,elem){
    
    if(type == "hide"){
        jQuery(Iam.container).find('table tbody tr td').css('border','none');
    }else if(type == "show"){
        jQuery(Iam.container).find('table tbody tr td').css({
            'border-bottom' : 'solid 1px #ccc',
            'border-right' : 'solid 1px #ccc',
        });
        jQuery(Iam.container).find('table tbody tr:first-child td').css({
            'border-top' : 'solid 1px #ccc',
        });
        jQuery(Iam.container).find('table tbody tr th:first-child').css({
            'border-right' : 'solid 1px #ccc',
        });
    }

}

JTrtEditor.prototype.hideInputBox = function(type,elem){
    
    var jtrt_toolbar_value_input = jQuery('#jteditbottomvalbar');
    if(jtrt_toolbar_value_input.css('display') == "none"){
        jtrt_toolbar_value_input.css('display','block');
    }else{
        jtrt_toolbar_value_input.css('display','none');
    }

}

JTrtEditor.prototype.hideHeaders = function(type,elem){
    
    var upSetting = {};
    

    if(elem.attr('data-jtrow-headers') == "hidden"){
        upSetting[type] = true;
        Iam.handsOnTab.updateSettings(upSetting);
        elem.attr('data-jtrow-headers','shown');
    }else{
        upSetting[type] = false;
        Iam.handsOnTab.updateSettings(upSetting);
        elem.attr('data-jtrow-headers','hidden');
    }

}

JTrtEditor.prototype.sortData = function(type,elem){
    
    this.loader.fadeIn();
    
    window.setTimeout(function(){
        var selected = Iam.handsOnTab.getSelectedLast();
        
        if(selected != undefined && selected.length > 0){
            console.log(type);
            if(type == "true"){
                Iam.handsOnTab.sort(selected[1],true);
                Iam.reRenderTable();
            }else{
                Iam.handsOnTab.sort(selected[1],false);
                Iam.reRenderTable();
            }
        }else{
            alert('You have to first select cells that you want to edit');
        }

    Iam.loader.fadeOut();
    },300);

}