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

.form-wraper {
    margin-bottom: 20px !important;
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

        <div class="col-md-12 container form-wraper">
    
                 <form method="POST" id="form" action="<?php echo site_url("fert/rep/salecompdelivery_reg");?>" >

                <div class="form-header">
                
                    <h4>Inputs</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_dt" class="col-sm-2 col-form-label">From Date:</label>

                    <div class="col-sm-6">

                        <input type="date"
                               name="from_date"
                               id="from_date"
                               class="form-control required"
                               value="<?php echo date('Y-m-d');?>"
                        />  

                    </div>

                </div>

                <div class="form-group row">

                    <label for="to_date" class="col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-6">

                        <input type="date"
                               name="to_date"
                               id="to_date"
                               class="form-control required"
                               value="<?php echo date('Y-m-d');?>"
                        />  

                    </div>

                </div> 

                
                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="button" id="populate_product" name="" class="btn btn-info" value="Populate product" />

                    </div>

                </div>

                <div class="col-sm-9">
            <div  >
                <?php foreach($distData as $dist){ 
                    ?>
                <label style="margin-right: 20px;">
                    <input type="radio" id="district" class="district" name="dist" value="<?=$dist->district_code?>" /> <?=$dist->dist_sort_code?>
                </label>
                
                <?php } ?>
                
            </div>
        </div>
                
                <div class="form-group row">

                    <div class="col-sm-10">

                        <!-- <input type="button" id="submit" name="submit" class="btn btn-info" value="Submit" /> -->

                    </div>

                </div>

            </form>    

        </div>
        
            <div class="col-lg-12 container contant-wraper" id="tabledata">
                
                

            </div>
        </div>
        


<script>
    function strDAte(dateData){
        var date=new Date(dateData);
       
        var returndate= date.getDate()+'/'+ (date.getMonth()+1) +'/'+date.getFullYear();
        return returndate;
    }

    $('#populate_product').click(function(){
       var fDate=$("#from_date").val();
       var tDate=$("#to_date").val();
        //var date=new Date(fDate);
        
       
       $('#overlay').fadeIn();

       $.ajax({
					type: "POST",
					url: "<?php echo site_url('fert/rep/sale_report_Popu_pro'); ?>",
					data: {fDate: fDate,tDate:tDate},
					dataType: 'html',
					success: function (result) {
						$('#tabledata').html(result);
                        $('#f_date').html(strDAte(fDate));
                        $('#t_date').html(strDAte(tDate));
                        $('#overlay').fadeOut();
					}
				});
       
    });


    $('.district').click(function(){
       var fDate=$("#from_date").val();
       var tDate=$("#to_date").val();
       var dist=$(this).val();

       $('#overlay').fadeIn();
       

       $.ajax({
					type: "POST",
					url: "<?php echo site_url('fert/rep/papulate_blance_sale'); ?>",
                    data: {fDate: fDate,tDate:tDate,dist:dist},
					dataType: 'html',
					success: function (result) {
                        $('#tabledata').html(result);
                        $('#f_date').html(strDAte(fDate));
                        $('#t_date').html(strDAte(tDate));
                        $('#overlay').fadeOut();
					}
				});
       
    });
</script>
