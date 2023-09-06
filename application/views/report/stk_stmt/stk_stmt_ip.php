<style>
    table {
        border-collapse: collapse;
    }

    table,
    td,
    th {
        border: 1px solid #dddddd;

        padding: 6px;

        font-size: 14px;
    }

    th {

        text-align: center;

    }

    tr:hover {
        background-color: #f5f5f5;
    }
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

        <form method="POST" id="form" action="<?php echo site_url("fert/rep/stkStmt"); ?>">

            <div class="form-header">

                <h4>Consolidated Stock Statement</h4>

            </div>

            <div class="form-group row">

                <label for="from_dt" class="col-sm-2 col-form-label">From Date:</label>

                <!--  <div class="col-sm-6">

                        <input type="date"
                               name="from_date"
                               class="form-control required"
                               value="<?php echo date('Y-m-d'); ?>"
                        />  

                    </div>-->
                <div class="col-sm-6">
                    <?php $fyear = $this->session->userdata['loggedin']['fin_yr'];
                    $year = explode('-', $fyear) ?>
                    <input type="date" name="from_date" class="form-control required from_dt" value="<?php //echo $year[0],'-04-01' //echo $frm_dt; ?>" min='<?= $year[0] ?>-04-01' max="<?= $year[0] + 1 ?>-03-31" required />

                </div>

            </div>

            <div class="form-group row">

                <label for="to_date" class="col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-6">

                        <input type="date" name="to_date" class="form-control required to_date" value="<?php echo date('Y-m-d'); ?>"  required />  

                    </div>

                </div>  


                <div class=" form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" id="submitid" value="Submit" />

                    </div>

                </div>
            </div>

        </form>

    </div>

</div>

<script>
    $("#submitid").click(function() {
        // $('#overlay').fadeIn().delay(55000).fadeOut();
        if($('.to_date').val()==''||$('.from_dt').val()==""){
                $('#overlay').fadeOut();
        }else{
            $('#overlay').fadeIn();
        }
    })
</script>