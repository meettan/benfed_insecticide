<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid #dddddd;

    padding: 6px;

    font-size: 14px;
}

th {

    text-align: center;

}

tr:hover {background-color: #f5f5f5;}

</style>



<style>
    #overlay {
        background: rgba(100, 100, 100, 0.2);
        color: #ffff;
        position: fixed;
        height: 100%;
        width: 100%;
        z-index: 5000;
        top: 0;
        left: 0;
        float: left;
        text-align: center;
        padding-top: 25%;
        opacity: .80;
    }



    .spinner {
        margin: 0 auto;
        height: 64px;
        width: 64px;
        animation: rotate 0.8s infinite linear;
        border: 5px solid #228ed3;
        border-right-color: transparent;
        border-radius: 50%;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>


<div id="overlay" style="display:none;">
            <div class="spinner"></div>
        </div>



    
    <div class="wraper">      

        <div class="col-md-6 container form-wraper">
    
                 <form method="POST" id="form" action="<?php echo site_url("fert/rep/stkScomp_ho");?>" >

                <div class="form-header">
                
                    <h4>Date range For Companywise Stock Statement</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_dt" class="col-sm-2 col-form-label">From Date:</label>

                    <div class="col-sm-6">

                        <input type="date"
                               name="from_date"
                               class="form-control required from_date"
                               value="<?php echo date('Y-m-d');?>"
                        />  

                    </div>

                </div>

                <div class="form-group row">

                    <label for="to_date" class="col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-6">

                        <input type="date"
                               name="to_date"
                               class="form-control required to_date"
                               value="<?php echo date('Y-m-d');?>"
                        />  

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="company" class="col-sm-2 col-form-label">Company:</label>

                    <div class="col-sm-6">

                            <select name="company" id="company" class="form-control company" required>

                                    <option value="">Select Company</option>
                                <?php
                                    foreach($company as $row){
                                ?>

                                    <option value="<?php echo $row->COMP_ID;?>"><?php echo $row->COMP_NAME;?></option>
                                <?php
                                    }
                                ?>
                            </select>
                       

                </div>

                </div> 

                <div class="form-group row">
                <label for="branch" class="col-sm-2 col-form-label">Branch:</label>
                <div class="col-sm-6">

                    <select name="br" class="form-control sch_cd required branch" id="br" required>

                        <option value="">Select Branch</option>
                        <option value="0">All Branch</option>

                        <?php

                            foreach($all_branch as $br){

                                
                        ?>

                        <option value="<?php echo $br->district_code;?>"><?php echo $br->district_name;?></option>

                        <?php

                            }

                        ?>     

                    </select>

                </div>

            </div>
                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" id="submitid" class="btn btn-info" value="Submit" />

                    </div>

                </div>

            </form>    

        </div>

    </div>


    <script>
    $("#submitid").click(function() {
        // $('#overlay').fadeIn().delay(55000).fadeOut();
        if($('.to_date').val()==''||$('.from_date').val()==""||$('.branch').val()==""||$('.company').val()==""){
                $('#overlay').fadeOut();
        }else{
            $('#overlay').fadeIn();
        }
    })
</script>