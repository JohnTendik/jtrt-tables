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



    }

    this.handleOnChange = function(){

        //create the onchange event
        this.styleTypeSelector.on('change',function(){
            $this.styleType = jQuery(this).val();
            jQuery(this).attr('data-table-style-type',jQuery(this).val());
            $this.stylesDivContainers.hide();
            $this.stylesDivContainers.filter('#jtrt_'+ $this.styleType +'_styles').show();
        });

    }

}