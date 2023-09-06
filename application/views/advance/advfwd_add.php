<?php $fyarra=$this->session->userdata('loggedin')['fin_yr']; 
$fy=explode('-',$fyarra);
$thisyear=$fy[0];

?>
<style>
	.radio-label {
		display: inline-block;
		vertical-align: top;
		margin-right: 3%;
	}

	.radio-input {
		display: inline-block;
		vertical-align: top;
	}
</style>
<div class="wraper">

	<div class="col-md-12 container form-wraper">
		<form method="POST" id="product" action="<?php echo site_url("adv/advancefwd_add") ?>">

			<div class="form-header">
				<h4>Advance Forward</h4>
			</div>

			<div class="form-group row">
                <label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>
				<div class="col-sm-2">
					<input type="date" id='trans_dt' name="trans_dt" value='<?=date("Y-m-d")?>'
					class="form-control" readonly />
				</div>
				<label for="society" class="col-sm-1 col-form-label">Company:</label>
				<div class="col-sm-3">
                        <select name="comp_id"  class="form-control comp_id" id="comp_id" required>
                            <option value="">Select</option>
                            <?php  foreach($compdtls as $key){  ?>
                            <option value="<?php echo $key->comp_id;?>"><?php echo $key->comp_name;?></option>
                            <?php  }  ?>
                        </select>
				</div>
                <label for="society" class="col-sm-1 col-form-label">Product:</label>
                <div class="col-sm-3">
                        <select name="prod_id"  class="form-control prod_id select2" id="prod_id" required>
                            <option value="">Select</option>
                        </select>
				</div>
			</div>

            <div class="form-header">
                <h4>Advance Details</h4>
            </div>

            <div class="form-group row">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <th style="text-align: center;width:200px">Receipt no</th>
						<th style="text-align: center;width:200px">Society Name</th>
                        <th style="text-align: center">FO</th>
                        <th style="text-align: center">RO Number</th>
						<th style="text-align: center">Qty</th>
                        <th style="text-align: center">Rate</th>
                        <th style="text-align: center">Cr Note Amt</th>
                        <th style="text-align: center">Amount</th>
                        <th>
                            <button class="btn btn-success" type="button" id="addrow" style="border-left: 10px"
                                data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i
                                    class="fa fa-plus" aria-hidden="true"></i></button></th>
                        </th>
                    </thead>

                <tbody id="intro">
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align:right">
                                <strong>Total:</strong>
                            </td>
							<td><span id='tot_qty'></span></td>
							<td></td>
							<td></td>
                            <td colspan="" style="text-align:right">
                                <strong id="tot_amt"></strong>
                            </td>
                            <td></td>

                        </tr>
                    </tfoot>

                </table>

            </div>
		<br>
		<div class="form-group row">
            <div class="col-sm-10">
				<input type="submit" id="submit" class="btn btn-info active_flag_c" value="Save" />
			</div>
		</div>   
	</div>
    </form>
</div>
<script>
	$(".sch_cd").select2();
</script>
<script>
$(document).ready(function () {

    var i = 0;
    $("#comp_id").change(function () {
        $("#prod_id").html('');
		$("#intro").html('');
		$('#tot_qty').html(parseFloat('0'));
		$('#tot_amt').html(parseFloat('0'));
		
        var comp_id = $(this).val();
        $.get('<?php echo site_url("stock/f_get_product");?>', {
            comp_id: $(this).val()
        }).done(function (data) {
            var string = '<option value="">Select</option>';
            $.each(JSON.parse(data), function (index, value) {
                string += '<option value="' + value.prod_id + '">' + value
                    .prod_desc + '</option>'
            });
            $("#prod_id").append(string);
			$('.select2').select2();
        });

    });
	$("#prod_id").change(function () {
		$("#intro").html('');
		$('#tot_qty').html(parseFloat('0'));
		$('#tot_amt').html(parseFloat('0'));
	})

});

$(document).ready(function(){
	
	$("#addrow").click(function()
	{
		var comp = $('#comp_id').val();
        var prd = $('#prod_id').val();

		if(comp > 0 && prd > 0 ){

			$.get('<?php echo site_url("adv/js_get_received_no") ?>', {comp_id: $('#comp_id').val(),prod_id:$('#prod_id').val()})
			.done(function(data){

				var string = '<option value="">Select</option>';
				$.each(JSON.parse(data), function( index, value ){

					string += '<option value="' + value.detail_receipt_no + '">' + value.detail_receipt_no +'</option>';
				})

				var newElement1= '<tr>'
								+'<td id= "detail_receipt_no" >'
									+'<select name="detail_receipt_no[]" id="detail_receipt_no" class= "form-control detail_receipt_no select2" required>'
										+string
									+'</select>'
								+'</td>'
								+'<td>'
									+'<input type="hidden" name="scoiety_id[]" value="" class="scoiety_id"><input type="text" name="scoiety_name[]" class="form-control scoiety_name" id="scoiety_name" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="hidden" name="receipt_no[]" value="" class="receipt_no"><input type="hidden" name="fo_no[]" class="form-control fo_no" id="fo_no" readonly><input type="text" name="" class="form-control fo_name" id="fo_no" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="ro_no[]" class="form-control ro_no" id="ro_no" style="" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="qty[]" class="form-control required qty" id="qty" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="rate[]" class="form-control rate" id="rate" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="cramt[]" class="form-control cramt" id="cramt" readonly>'
								+'</td>'
								+'<td>'
									+'<input type="text" name="amount[]" class="form-control amount" id="amount" readonly>'
								+'</td>'
								+'<td>'
									+'<button class="btn btn-danger removeRow" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>'
								+'</td>'
							+'</tr>';

				$("#intro").append($(newElement1));
				$('.select2').select2();
				   $(document).ready(function() {
						var tot = 0.00;
						$('.amount').each(function(){
							tot += parseFloat($(this).val())?parseFloat($(this).val()):0.00;
						});
						$('#tot_amt').html(parseFloat(tot));
					})
				})

		}else{
			alert('Please select Company and Product');
			return false;
		}
															
	});

	// Start code to Remove Bill row  
	$("#intro").on("click",".removeRow", function(){
			var tot = 0.00;
			var tot_qty = 0.00;
			$(this).parents('tr').remove();
			$('.amount').each(function(){
				tot += parseFloat($(this).val())?parseFloat($(this).val()):0.00;
			});
			$('#tot_amt').html(parseFloat(tot));
			$('.qty').each(function(){
				tot_qty += parseFloat($(this).val())?parseFloat($(this).val()):0.00;
			});
			$('#tot_qty').html(parseFloat(tot_qty));


			var row = $(this).closest('tr');
			var thidetail_receipt_no=row.find("td:eq(0) .detail_receipt_no").val();
			var r=1;
			
			
			$('.detail_receipt_no').each(function(){
				console.log($(this).val());
				var tvalue=$(this).val();
				if(thidetail_receipt_no == tvalue){
					r++;
				}
			});
			

			if(r > 1 ){
				// alert(r);
				$('#submit').removeAttr("disabled");
				$('#addrow').show();
			}else {
				// alert(r);
				// $('#submit').attr("disabled", true);
				// $('#addrow').hide();
			}
	});

	
	// $('.detail_receipt_no').each(function(){
	// 	$(this).val();
	// });
});

$("#intro").on("change", ".detail_receipt_no", function(){
	var st  = parseFloat($('#st').html());
	var tot = 0.00;
	var tot_qty = 0.00;
	var row = $(this).closest('tr');
	var detail_receipt_no = $(this).val();
	//var receipt_no = $('#').val();
		$.get('<?php echo site_url("adv/js_get_reciept_detail") ?>',{detail_receipt_no:detail_receipt_no})
		.done(function(data){
			var value = JSON.parse(data);
			row.find("td:eq(1) input[type='hidden']").val(value.soc_id);
			row.find("td:eq(1) input[type='text']").val(value.soc_name);
			row.find("td:eq(2) .receipt_no").val(value.receipt_no);
			row.find("td:eq(2) .fo_no").val(value.fo_no);
			row.find("td:eq(2) .fo_name").val(value.fo_name);
			row.find("td:eq(3) input[type='text']").val(value.ro_no);
			row.find("td:eq(4) input[type='text']").val(value.qty);
			row.find("td:eq(5) input[type='text']").val(value.rate);
			row.find("td:eq(6) input[type='text']").val(value.cr_amount);
			row.find("td:eq(7) input[type='text']").val(value.amount);
			$('.amount').each(function(){
				tot += parseFloat($(this).val())?parseFloat($(this).val()):0.00;
			});
			$('#tot_amt').html(parseFloat(tot));
			$('.qty').each(function(){
				tot_qty += parseFloat($(this).val())?parseFloat($(this).val()):0.00;
			});
			$('#tot_qty').html(parseFloat(tot_qty));
		})

})
$(document).ready(function(){
	//$(document).ajaxComplete(function(){
		
		$("#intro").on('change','.detail_receipt_no',function(){
			var cnts = 0;
			var row = $(this).closest('tr');
			var detail_receipt_no = $(this).val();
			$('.detail_receipt_no').each(function(){
					if(detail_receipt_no == $(this).val()){
						cnts++;
					}
			});
			if(cnts > 1){
				alert('Duplicate data');
				row.css("background","red");

				$('#submit').attr("disabled", true);
				$('#addrow').hide();
				//return false; // breaks
				//cnts = 0;
			}else{
				row.css("background","");
				// $('#submit').removeAttr("disabled");
				// $('#addrow').show();
			}
		});
		
	//})
})
</script>


