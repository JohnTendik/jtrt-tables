<!--STEP 1-->
    <div id="jt_step_1" class="active">
        <p class="jtrt_steps_desc">First step is to decide how you want to create your table. You can start from scratch, or you can import a CSV file from Google Spreadsheets, or Excel.</p>
        <div class="jtrt_table_creator_steps_container">
            <div class="jt_step1_container clearfix">
                <ul>
                    <li>
                        <input id="jt_start_scratch" type="button">
                        <label for="jt_start_scratch" class="jt_step_1_btn scratch">
                            <img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../img/step_1_paperpen.png" alt="paper & pen">
                            <p>Start From Scratch</p>                        
                        </label>
                    </li>
                    <li>
                        <input id="jt_upload_Csv" type="file" accept=".csv">
                        <label for="jt_upload_Csv" class="jt_step_1_btn">
                            <img src="<?php echo plugin_dir_url( __FILE__ ) ?>../../img/step_1_import.png" alt="paper & pen">
                            <p>Import CSV</p>                        
                        </label>
                    </li>
                </ul>
            </div> 
        </div>
    </div>
<!--STEP 1-->