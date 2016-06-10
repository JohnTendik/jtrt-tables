/* global ajaxurl */
(function( $ ) {
	'use strict';

	var custom_uploader;
	var loader = $('div.loader');
    var hidden_cols = {
        xs:[],
        sm:[],
        md:[],
        lg:[]
    };
		

	$('div.loader').remove();
	$('body').prepend(loader);
	loader = $('body div.loader');
    jt_highlight_headers($('nav#column-hider-nav a.active_table_hider').attr('data-hider-jt'));
    initionatetion();
    
    $("#accordion").accordion();
    
    $('.wp-color-picker-field').wpColorPicker({
        'change':
        function(event, ui) {
            if($(this).attr('data-jtrt-style') == "container_bg"){
                $('#jtrt-style-pig-container').css("background",$(this).val()); 
            }
            if($(this).attr('data-jtrt-style') == "container_bordercol"){
                $('#jtrt-style-pig-container').css("border-color",$(this).val()); 
            }
            if($(this).attr('data-jtrt-style') == "table_bordercol"){
                $('#jtrt-style-pig').css("border-color",$(this).val()); 
            }
        }
    });
    
	// The Function for the media upload button
		jQuery('#upload_image_button').on('click', function(e){	
			e.preventDefault();
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}
			custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose CSV File',
				button: {
					text: 'Choose CSV File'
				},
				multiple: false
			});
			custom_uploader.on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				jQuery('#upload_image').val(attachment.url);
			});
			custom_uploader.open();
		});
		// End of media upload button function

		jQuery('#jtrt_generate_table').on("click",function(e){
            var upload_image_link = jQuery('#upload_image').val();
			e.preventDefault();
			loader.show();
			if(upload_image_link.indexOf(".csv") !== -1){
				var data = {
				'action': 'gen_table_1',
				'idd': $('input#post_ID').val(),
				'data': $('div.table-cotainer').html(),
				'table_name': $('input#title').val()
				};
                var filt_val = $('input[name="jtrt_general_settings[filter]"]:checked').val();
                var sort_val = $('input[name="jtrt_general_settings[sorting]"]:checked').val();
				jQuery.post(ajaxurl, data, function(response) {
					$('div.table-cotainer').CSVToTable($("#upload_image").val(),{tableClass:"footable toggle-circle-filled " + $('#jtrt_custom_class').val(),jtrt_table_sort:sort_val,jtrt_table_filter:filt_val});
                    loader.hide();
                    
                    window.setTimeout(function(){
                        jt_highlight_headers($('nav#column-hider-nav a.active_table_hider').attr('data-hider-jt'));
                        $('div.table-cotainer table').addClass("jtrt_table_"+$('input#post_ID').val());
                        $('div.table-cotainer .jtrt_table_container').addClass("jtrt_table_"+$('input#post_ID').val());
                        $('div.table-cotainer table td').each(function () {
                            if ($.isNumeric($(this).html())) {
                                $('div.table-cotainer table th').eq($(this).index()).attr('data-type','number');
                                
                            }
                        });
                        
                    },1000);
				});
			}else{
				loader.hide();
				alert("You must first insert a valid file ending in extension .csv");
			}
					
            
           	

		});

		jQuery('#publish').on("click",function(e){
    
                
				var data = {
				'action': 'gen_table_1',
				'idd': $('input#post_ID').val(),
				'data': $('div.table-cotainer').html(),
				'table_name': $('input#title').val(),
                'table_cols': hidden_cols,
                'table_styles': return_pig_styles_jt()
				};
                
                initiate_hidden_cols_jt();

				jQuery.post(ajaxurl, data, function(response) {
					jQuery('#publish').click();
				});
				
		});
        
        $('nav#column-hider-nav a').on('click',function(e){
            e.preventDefault();
            var currentLink = $('nav#column-hider-nav a.active_table_hider');
            currentLink.removeClass('active_table_hider');
            $(this).addClass('active_table_hider');
            var upload_image_link_data = $('nav#column-hider-nav a.active_table_hider').attr('data-hider-jt');
            
            jt_highlight_headers(upload_image_link_data);

        });
        
        $('div.table-wrapper').on('click','table th',function(){
           var upload_image_link = jQuery('nav#column-hider-nav a.active_table_hider'),
               upload_image_link_data = upload_image_link.attr('data-hider-jt');
           $(this).toggleClass('hidejt');
           if($(this).hasClass("hidejt")){
               hidden_cols[upload_image_link_data].push($(this).index());

           }else{
               var arrayindex = hidden_cols[upload_image_link_data].indexOf($(this).index());
               hidden_cols[upload_image_link_data].splice(arrayindex,1);
               
           }
           
        });
        
        
        function jt_highlight_headers(col_type){
            
            $('table th').removeClass('hidejt');
                        
           
            if(hidden_cols[col_type] !== undefined){
                for(var i = 0; i < hidden_cols[col_type].length; i++){
                    $('table th').eq(hidden_cols[col_type][i]).addClass('hidejt');
                }
            }
      
        }
        
        function initiate_hidden_cols_jt(){
            $('table th').attr('data-breakpoints', "");
            for(var hid_col in hidden_cols){
               for(var index_col in hidden_cols[hid_col]){
                   if($('table th').eq(hidden_cols[hid_col][index_col]).attr("data-breakpoints") == undefined){
                       $('table th').eq(hidden_cols[hid_col][index_col]).attr("data-breakpoints", hid_col);
                   }else{
                       var old_db = $('table th').eq(hidden_cols[hid_col][index_col]).attr('data-breakpoints');
                       var new_db = old_db + " " + hid_col;
                       if(old_db.indexOf(hid_col) == -1){
                            $('table th').eq(hidden_cols[hid_col][index_col]).attr("data-breakpoints", new_db);
                       }
                   }                   
               }
            }
            
        }
        
        function initionatetion(){
            
            var attras = $('table th');
            $.each(attras,function(e,n){
                var thisis = $(this);
                if($(this).attr('data-breakpoints') != undefined){
                    if($(this).attr('data-breakpoints').indexOf('xs') != -1){
                   hidden_cols["xs"].push(thisis.index());
                  
                }
                if($(this).attr('data-breakpoints').indexOf('sm') != -1){
                   hidden_cols["sm"].push(thisis.index());
                   
                }
                if($(this).attr('data-breakpoints').indexOf('md') != -1){
                   hidden_cols["md"].push(thisis.index());
                   
                }
                if($(this).attr('data-breakpoints').indexOf('lg') != -1){
                   hidden_cols["lg"].push(thisis.index());
                   
                }
                }
                
            });

            jt_highlight_headers("xs");
                                    
        }
        
        
        $("table.footable td, table.footable th").dblclick(function () {
        var OriginalContent = $(this).text();
        $(this).html("<input style='display:block;width:100%;' size=1 type='text' value='" + OriginalContent + "' />");
        $(this).children().first().focus();
        $(this).children().first().keypress(function (e) {
            if (e.which == 13) {
                var newContent = $(this).val();
                $(this).parent().text(newContent);         
            }
        });
        $(this).children().first().blur(function(){
            $(this).parent().text(OriginalContent);
        });
        $(this).find('input').dblclick(function(e){
            e.stopPropagation();
        });
    });
    
    update_style_pig();
    function update_style_pig(){
        
    var style_pig = $('#jtrt-style-pig');
    var style_pig_container = $('#jtrt-style-pig-container')
    var jt_pig_container_padding = $('#jtrt_container_style_pad');
    var jt_pig_container_txtalign = $('#jtrt_container_style_ta');
    var jt_pig_container_bgcolor = $('#jtrt_container_style_bg');
    var jt_pig_container_border_color = $("#jtrt_container_style_border_color");
    var jt_pig_container_border_type = $("#jtrt_container_style_border_type");
    var jt_pig_container_border_size = $("#jtrt_container_style_border_width");
    var jt_pig_table_border_size = $("#jtrt_table_style_border_width");
    var jt_pig_table_border_color = $("#jtrt_table_style_border_color");
    var jt_pig_table_border_type = $("#jtrt_table_style_border_type");
    
        function init_pig_styles(){
            style_pig_container.css({"border":jt_pig_container_border_type.val(),"border-width":jt_pig_container_border_size.val(),"border-color":jt_pig_container_border_color.val(), "padding": jt_pig_container_padding.val(), "text-align": jt_pig_container_txtalign.val(), "background": jt_pig_container_bgcolor.val() });
            
            style_pig.css({"border":jt_pig_table_border_type.val(),"border-width":jt_pig_table_border_size.val(),"border-color":jt_pig_table_border_color.val()});
            jt_pig_container_padding.parent().next().find('p').text(jt_pig_container_padding.val() + " Pixels");
            jt_pig_container_border_size.parent().next().find('p').text(jt_pig_container_border_size.val() + " Pixels");
            jt_pig_table_border_size.parent().next().find('p').text(jt_pig_table_border_size.val() + " Pixels");
        }
        
        init_pig_styles();
                    
        jt_pig_container_padding.on("change",function(){      
        style_pig_container.css("padding",$(this).val());
        jt_pig_container_padding.parent().next().find('p').text(jt_pig_container_padding.val() + " Pixels");
        });
        
        jt_pig_container_txtalign.on("change",function(){       
        style_pig_container.css("text-align",$(this).val()); 
        });
        
        jt_pig_container_border_size.on("change",function(){      
        style_pig_container.css("border-width",$(this).val());
        jt_pig_container_border_size.parent().next().find('p').text(jt_pig_container_border_size.val() + " Pixels");
        });
        
        jt_pig_container_border_type.on("change",function(){       
        style_pig_container.css("border",$(this).val()); 
        });
        
        jt_pig_table_border_type.on("change",function(){       
        style_pig.css("border",$(this).val()); 
        });
        
        jt_pig_table_border_size.on("change",function(){      
        style_pig.css("border-width",$(this).val());
        jt_pig_table_border_size.parent().next().find('p').text(jt_pig_table_border_size.val() + " Pixels");
        });
   
    }
    
    function return_pig_styles_jt(){
        
        var style_pig = $('#jtrt-style-pig');
        var style_pig_container = $('#jtrt-style-pig-container')
        var jt_pig_container_padding = $('#jtrt_container_style_pad').val();
        var jt_pig_container_txtalign = $('#jtrt_container_style_ta').val();
        var jt_pig_container_bgcolor = $('#jtrt_container_style_bg').val();
        var jt_pig_container_border_color = $("#jtrt_container_style_border_color").val();
        var jt_pig_container_border_type = $("#jtrt_container_style_border_type").val();
        var jt_pig_container_border_size = $("#jtrt_container_style_border_width").val();
        var jt_pig_table_border_size = $("#jtrt_table_style_border_width").val();
        var jt_pig_table_border_color = $("#jtrt_table_style_border_color").val();
        var jt_pig_table_border_type = $("#jtrt_table_style_border_type").val();
    
        var jtrt_styles = {
            container_styles : "",
            table_styles : ""
        };
        jtrt_styles.container_styles = "div.jtrt_table_"+$('input#post_ID').val()+"{border:"+jt_pig_container_border_type+" "+jt_pig_container_border_color+" "+jt_pig_container_border_size+"px;padding:"+jt_pig_container_padding+"px;background:"+jt_pig_container_bgcolor+";text-align:"+jt_pig_container_txtalign+";}";
        jtrt_styles.table_styles = "table.jtrt_table_"+$('input#post_ID').val()+"{border:"+jt_pig_table_border_type+" "+jt_pig_table_border_color+" "+jt_pig_table_border_size+"px;}";
        return jtrt_styles;
        
    }    
       
       
    $('#jtrt_container_style_border').on('click', function(){
        
    });
       
    var jtrt_html_generator_modal = $( "#dialog-message2" ).dialog({
      modal: true,
      buttons: [
            {
            text: "Close",
            click: function() {
                $( this ).dialog( "close" );
            }
        
            // Uncommenting the following line would hide the text,
            // resulting in the label being used as a tooltip
            //showText: false
            }
        ],
      autoOpen: false
    });   
    
    $('input#jtrt_generatehtml_table').on('click',function(){
        $('#dialog-message2 textarea').text($('div.table-cotainer').html());
        jtrt_html_generator_modal.dialog( "open" );
    });
       
})( jQuery );


