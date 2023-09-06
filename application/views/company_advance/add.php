<div class="wraper">      
            
	<div class="col-md-11 container form-wraper">

		<form method="POST" id="form" action="<?php echo site_url("adv/company_advAdd") ?>" >

			<div class="form-header">
				<h4>Add Company Advance </h4>
			</div>

            <div class="form-group row">
				<label for="company" class="col-sm-2 col-form-label">Company:</label>
				<div class="col-sm-4">

					<select name="company" class="form-control sch_cd required" id="company" required>

						<option value="">Select Company</option>
                        <?php
                            foreach($compDtls as $comp){
                        ?>
                        <option value="<?php echo $comp->comp_id;?>"><?php echo $comp->comp_name;?></option>
                        <?php
                            }
                        ?>     
                    </select>
                </div>

                <label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>
				<div class="col-sm-4">

					<input type="date" id=trans_dt name="trans_dt" class="form-control" value="<?=date('Y-m-d')?>" readonly />

				</div>

            </div>
			<div class="form-group row">
				<label for="dist" class="col-sm-2 col-form-label">District:</label>
				<div class="col-sm-4">

					<select name="dist" class="form-control sch_cd required" id="dist" required>

						<option value="">Select District</option>
                        <?php
                            foreach($distDtls as $dist){
                        ?>
                        <option value="<?php echo $dist->district_code;?>"><?php echo $dist->district_name;?></option>
                        <?php
                            }
                        ?>     
                    </select>
                </div>

				<label for="bank" class="col-sm-2 col-form-label">Bank:</label>
				<div class="col-sm-4">

					<select name="bank" class="form-control sch_cd required" id="bank" required>
						<option value="">Select Bank</option>
                        <?php
                            foreach($bankDtls as $bank){
                        ?>
                        <option value="<?php echo $bank->sl_no;?>"><?php echo $bank->bank_name;?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
		</div>


            <div class="form-group row">
            <label for="Receipt No" class="col-sm-2 col-form-label">Receipt No:</label>
            
                
                  <!-- <input type="text" id=receipt_no name="receipt_no" class="form-control" value=""  /> -->
                  <div class="col-sm-4">

					<select name="receipt_no" class="form-control sch_cd" id="receipt_no" required>
						<option value="">Select Receipt No</option>
                        
                    </select>
                </div>

                <label for="memonumber" class="col-sm-2 col-form-label">Memo Number:</label>
            
                
                  <!-- <input type="text" id=receipt_no name="receipt_no" class="form-control" value=""  /> -->
                  <div class="col-sm-4">
                  <input type="text" id="memonumber " name="memonumber" class="form-control" value="" required />
					
                </div>

                <label for="Receipt No" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-4 poenbtn">
                <button class="btn btn-success" id="poenbtn">View Detail</button>
                <input type="hidden" value="" id="rep_id">
                </div>
                <!-- <label class="col-sm-2 col-form-label">Total Advance</label>
                <label class="col-sm-2 col-form-label">Amount Already paid</label>
                <label class="col-sm-2 col-form-label">Amount to be paid</label>
                <label  class="col-sm-2 col-form-label" id='tot_adv' ></label>
                <label class="col-sm-2 col-form-label" id='adv_paid' ></label>
                <label class="col-sm-2 col-form-label" id='adv_topaid' style="color:red;"></label> -->

            </div>

			<div class="form-group row">
				<label for="trans_type" class="col-sm-2 col-form-label">Transaction Type:</label>
				<div class="col-sm-4">
                <input type="hidden" id="trans_type" name="trans_type" class="form-control" value="I" />
                <input type="text" id="view_type" name="view_type" class="form-control" value="Advance Deposit to company" readonly />  
				<input type="hidden" id="p_tot" name="p_tot" class="form-control" value="" />
                
			</div>

                <!-- <label for="bank" class="col-sm-2 col-form-label">Debit Account Head:</label>
				<div class="col-sm-4">

					<select name="cr_head" class="form-control sch_cd" id="cr_head" required>
						<option value="">Select Account head</option>
                        <?php
                           // foreach($acc_head as $key){
                        ?>
                        <option value="<?php //echo $key->sl_no;?>"><?php //echo $key->ac_name;?></option>
                        <?php
                            //}
                        ?>
                    </select>
                </div> -->
			</div>
          
            <div class="form-group row">
				<label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>
				<div class="col-sm-10">
                    <textarea id=remarks name="remarks" class="form-control"  required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                <table class="table table-bordered">
                        <tbody id='list'></tbody>
                    </table>
                </div>	
            </div>
            <div class="form-group row">                
				<div class="col-sm-10">

					<input type="submit" id="submit" class="btn btn-info active_flag_c" value="Save" />

				</div>
            </div>
			</div>

		</form>

	</div>	

</div>
<script>
            $('#poenbtn').hide();

$( document ).ajaxComplete(function() {
    $("#receipt_no").change(function(){
        var receipt_no = $(this).val();
        $('#rep_id').val(receipt_no);
		 var comp_id = $('#company').val();
		  var dist    = $('#dist').val();
        $("#list").html('');
        $.ajax({
        type:'POST',
        url: '<?=base_url()?>index.php/adv/company_advAddlist',
        //data: {receipt_no:receipt_no,comp_id:comp_id},
		data: {receipt_no:receipt_no,comp_id:comp_id,branch_id:dist},
        success: function(data){
            $('#poenbtn').show();
		// if(data==0){
        //     alert('District Not Matched');
		// 	 $('#submit').attr('type', 'buttom');
        //      return true;

        //     }else{


            var tot_amt = 0.0;
            var i  = 1; var j = 0;
            var list = '<tr><th>Sl No</th><th style="width:33%">Advance No</th><th style="width:33%">Company Name</th><th style="width:33%">Product</th><th style="width:33%">Qty</th><th style="width:33%">Amount</th><th>Option</th></tr>';
            $.each(JSON.parse(data), function(index, value) {
                list += '<tr><td>'+ i +'</td><td><input type="hidden" class="form-control" value="'+value.detail_receipt_no+'" name="adv_receive_no[]" readonly>'+value.detail_receipt_no+'</td><td>'+value.COMP_NAME+'</td><td>'+value.PROD_DESC+'</td><td>'+value.qty+'</td><td>'+value.amount+'</td><td><input type="checkbox" id="ckamt" name="ckamt['+i +'][list]"  value ='+value.detail_receipt_no+' class="ckamt"><input type="hidden" name="ckamt['+ i +'][amt]" value="'+value.amount+'"></td></tr>';
                
                tot_amt += parseFloat(value.adv_amt);
                i++;
            });  
            
            list += '<tr style="font-weight: bold;"><td colspan="4">Total</td><td id="approve_qty"></td><td id="approve_tot">0.00</td></tr>';
        $("#list").html(list);
		    $.ajax({
            type:'POST',
            url: '<?=base_url()?>index.php/adv/company_advdetail',
            data: {receipt_no:receipt_no},
            success: function(data){
                var data = JSON.parse(data);
                $('#tot_adv').html(data.totadv);
                $('#adv_topaid').html(parseFloat(data.totadv)-parseFloat(data.totpaid));
                $('#adv_paid').html(data.totpaid);
                }
            });
			//}			
        }});
       /* $.ajax({
        type:'POST',
        url: '<?=base_url()?>index.php/adv/company_advdetail',
        data: {receipt_no:receipt_no},
        success: function(data){

            var data = JSON.parse(data);
            $('#tot_adv').html(data.totadv);
            $('#adv_topaid').html(parseFloat(data.totadv)-parseFloat(data.totpaid));
            $('#adv_paid').html(data.totpaid);
        }});*/
    });
   

}) 
$("#submit").hide();

    $(document).ajaxComplete(function() {

        $('.ckamt').change(function() {
            var approve_tot = parseFloat($('#approve_tot').html());
            var amt = 0.00; 
			var qty = 0.00; 
            $('.ckamt:checked').each(function() {
                qty += parseFloat($(this).parents('tr').find("td").eq(4).html()); 
            });
			$('.ckamt:checked').each(function() {
                amt += parseFloat($(this).parents('tr').find("td").eq(5).html()); 
            });
			$('#approve_qty').html(qty);
            $('#approve_tot').html(amt);
			
			 $('#p_tot').val(amt);
            if(amt!=0.00){
                $("#submit").show();
            }else{
                $("#submit").hide();
            }
        });
        //alert('hello')
       
   });
   $(document).ajaxComplete(function() {
    $('#form').submit(function(event){
        var approve_tot = parseFloat($('#approve_tot').html());  
            
            if(parseFloat(approve_tot) < parseFloat(100.00) ){

                alert("Please select a row");
                event.preventDefault();
            }
            else{
                
                $('#submit').attr('type', 'submit');
            }

    });
   });

   $(document).ready(function(){

    var i = 0;
    $("#dist").on("change", function(){
        var dist = $(this).val();
        
        $.get('<?php echo site_url("adv/get_fwdreceiptbydist");?>',
              { dist: $(this).val(),c_id:$('#company').val()}
             ).done(function(data){

            var string = '<option value="">Select</option>';

            $.each(JSON.parse(data), function( index, value ) {

                string += '<option value="' + value.fwd_receipt_no + '">' + value.fwd_receipt_no + '</option>'
            });

            $("#receipt_no").html(string);
            if(string!=null || string!=''){
                $('.poenbtn').show();
            }
            
          });

    });

});
</script>
<script>
    // $('#dist').change(function(){
    //     var bank=$(this).val();
    //     var comp=$('#company').val();

    //     $.ajax({
    //             url: "adv/company_advAdd",
    //             type: "post",
    //             data: {bank:bank,comp:comp},
    //             dataType: "json",
    //             success: function(data) {
    //                 alert(data);
    //             }
    //         });
    // })

    $('.poenbtn').hide();

    $('#poenbtn').click(function(){
        var recno=$('#rep_id').val();
       // alert(recno);
        if(recno!=null){
            // window.location.href = "<?=site_url('adv/editadv?rcpt=')?>"+recno;
            window.open("<?=site_url('adv/fwdadvdtls?fwd_receipt_no=')?>"+recno, '_blank');
        }
       
    });
</script>
