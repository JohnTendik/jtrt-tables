function Jtrt_styles_editor(stylesContainer){

    $this = this;
    this.container = stylesContainer,
    this.styleTypeSelector = this.container.find('select#jtrt_table_style_type'),
    this.styleType = this.styleTypeSelector.attr('data-table-style-type'),
    this.stylesDivContainers = this.container.find('.jtrt_stylediv');

    this.handleOnLoad = function(){
        
        // Check style Type
        this.styleType = this.styleTypeSelector.attr('data-table-style-type');
        this.styleTypeSelector.val(this.styleType);
        // Load the div that is selected
        this.container.find('#jtrt_'+ this.styleType +'_styles').show();

        this.stylesDivContainers.find('#bootstrap_opts_jtrt input').each(function(elem){
            var e = jQuery(this);
            var tablePig = $this.stylesDivContainers.find('.jtrt_style_pig_bt');
            if(e.val() == "true"){
                e.prop('checked',true);
                tablePig.addClass(jQuery(this).attr('data-bt-classes-jt'));
            }else{
                e.prop('checked',false);
                tablePig.removeClass(jQuery(this).attr('data-bt-classes-jt'));
            }
        });

        this.stylesDivContainers.find('#jtrt_table_exstyle_type').val(this.stylesDivContainers.find('#jtrt_table_exstyle_type').attr('data-table-style-type'));
        this.stylesDivContainers.find('.jtrt_example_pig').addClass(this.stylesDivContainers.find('#jtrt_table_exstyle_type').attr('data-table-style-type'));
    }

    this.handleOnChange = function(){

        //create the onchange event
        this.styleTypeSelector.on('change',function(){
            $this.styleType = jQuery(this).val(); // set this.styleType var to the current value of the select box.
            jQuery(this).attr('data-table-style-type',jQuery(this).val()); // Set the selectbox element attribute to reflect the current selected value
            $this.stylesDivContainers.hide(); // hide all shown divs containing different options
            $this.stylesDivContainers.filter('#jtrt_'+ $this.styleType +'_styles').show(); // show the div that equals the value of the select box
        });

        //the onchange event for the bootstrap style checkboxes
        this.stylesDivContainers.find('#bootstrap_opts_jtrt input').on('change',function(){
            var tablePig = $this.stylesDivContainers.find('.jtrt_style_pig_bt');
            jQuery(this).val(jQuery(this).prop('checked'));
            if(jQuery(this).val() === "true"){     
                tablePig.addClass(jQuery(this).attr('data-bt-classes-jt'));
            }else{          
                tablePig.removeClass(jQuery(this).attr('data-bt-classes-jt'));
            }
        });

        //the onchange event for the example style select box
        this.stylesDivContainers.find('#example_opts_jtrt select').on('change',function(){
            var tablePig = $this.stylesDivContainers.find('.jtrt_example_pig');
            jQuery(this).attr('data-table-style-type',jQuery(this).val()); // Set the selectbox element attribute to reflect the current selected value
            tablePig.removeClass("example1 example2 example3 example4 example5 example6 example7 example8 example9 example10");
            tablePig.addClass(jQuery(this).val());
        });

    }

}