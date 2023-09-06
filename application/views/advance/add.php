<?php
// print_r($this->session->userdata('loggedin'));
$fyarra=$this->session->userdata('loggedin')['fin_yr']; 
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

	<div class="col-md-6 container form-wraper">

		<form method="POST" id="product" action="<?php echo site_url("adv/advAdd") ?>">

			<div class="form-header">

				<h4>Add Advance</h4>

			</div>

			<div class="form-group row">
				<label for="society" class="col-sm-2 col-form-label">Society:</label>
				<div class="col-sm-10">

					<select name="society" class="form-control sch_cd required" id="society" required>

						<option value="">Select Society</option>

						<?php

                            foreach($societyDtls as $soc){

                        ?>

						<option value="<?php echo $soc->soc_id;?>"><?php echo $soc->soc_name;?></option>

						<?php

                            }

                        ?>

					</select>

				</div>

				<!-- <label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>

				<div class="col-sm-4">

					<input type="date" id=trans_dt name="trans_dt" class="form-control" required />

				</div> -->

			</div>

			<div class="form-group row">
				<div></div>
			</div>

			<div class="form-group row">
				<label for="trans_type" class="col-sm-2 col-form-label">Transaction Type:</label>
				<div class="col-sm-4">

					<select name="trans_type" class="form-control required" id="trans_type" required>

						<option value="I">Deposit</option>

						<!-- <option value="O">Adjustment</option> -->

					</select>

				</div>

				<label for="adv_amt" class="col-sm-2 col-form-label">Amount:</label>
				<div class="col-sm-4">

					<input type="text" id=adv_amt name="adv_amt" class="form-control required" required />

				</div>
			</div>
			<div class="form-group row">
				<label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>

				<div class="col-sm-4">

				<input type="date" id=trans_dt name="trans_dt" class="form-control" min="<?=$thisyear?>-04-01" max="<?php $d=$thisyear+1;echo $d;?>-03-31" value="<?=date("Y-m-d") ?>" readonly required />

				</div>
				<div class="col-sm-2">

					<input id="cshbank" name="cshbank" type="radio" class="radio-label" value="0" checked required/>

					<label for="cshbank" class="radio-label">Cash</label>
				</div>
				
				<div class="col-sm-2">
					<input id="cshbank" name="cshbank" type="radio" class="radio-label" value="1" required/>

					<label for="cshbank" class="radio-label">Bank</label>
				</div>
			</div>

			<div class="form-group row acno">

				<label for="referenceNo" class="col-sm-2 col-form-label">Reference No :</label>
				<div class="col-sm-4">
					<input type="text" id="referenceNo" name="referenceNo" value="" class="form-control"
						 />
					

				</div>
			</div>
			
			<div class="form-group row acno">

				<label for="bank_id" class="col-sm-2 col-form-label">Bank:</label>
				<!-- <input type="text" style="width:200px" id="bank_id" name="bank_id"value=""  class="form-control bank_id"  /> -->
				<div class="col-sm-4">

					<select name="bank_id" class="form-control bank_id" id="bank_id" disabled>
						<option value="">Select</option>
						<?php
                       foreach($bnk_dtls as $bnk){
                            ?>
						<option value="<?php echo $bnk->sl_no;?>"><?php echo $bnk->bank_name;?></option>
						<?php    }    ?>
					</select>
				</div>
				<label for="ifsc" class="col-sm-2 col-form-label">IFSC :</label>
				<div class="col-sm-4">
					<input type="text" style="width:160px" id="ifsc" name="ifsc" value="" class="form-control"
						readonly />
					<!-- <input type="hidden" style="width:180px" id="comp_id" name="comp_id"value=""  class="form-control" readonly /> -->

				</div>
			</div>
			<div class="form-group row acno">
				<label for="ac_no" class="col-sm-2 col-form-label">A/C No:</label>
				<div class="col-sm-3">
					<input type="text" style="width:200px" id="ac_no" name="ac_no" value="" class="form-control"
						readonly />
				</div>
			</div>
			<div class="form-group row">
				<label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>
				<div class="col-sm-10">

					<textarea id=remarks name="remarks" class="form-control" required></textarea>
				</div>
			</div>

			<div class="col-sm-10">

				<input type="submit" id="submit" class="btn btn-info active_flag_c" value="Save" />

			</div>

	</div>

	</form>

</div>

</div>

<script>
	$(".sch_cd").select2();
</script>
<script>
	$(document).ready(function () {

		var i = 2;

		$('#bank_id').change(function () {

			$.get(

					'<?php echo site_url("adv/f_get_dist_bnk_dtls");?>', {

						bnk_id: $(this).val(),


					}

				)
				.done(function (data) {

					//console.log(data);
					var parseData = JSON.parse(data);
					var ac_no = parseData[0].ac_no;
					var ifsc = parseData[0].ifsc;
					$('#ac_no').val(ac_no);
					$('#ifsc').val(ifsc);

				});


		});

	});
</script>
<script>
	$(".acno").hide();
	$('#ifsc').attr('disabled', true);
	$('#ac_no').attr('disabled', true);
	$('input:radio[name="cshbank"]').change(function () {
		console.log('hi');
		if ($(this).val() == '1') {
			$('#referenceNo').attr('disabled', false);
			$('#referenceNo').attr('required', 'required');

			$('#bank_id').attr('disabled', false);
			$('#bank_id').attr('required', 'required');
			$('#ifsc').attr('required', 'required');
			$('#ac_no').attr('required', 'required');
			$('#ifsc').attr('disabled', false);
			$('#ac_no').attr('disabled', false);
			$(".acno").show();
		} else if ($(this).val() == '0') {

			$('#referenceNo').attr('disabled', true);
			$('#bank_id').attr('disabled', true);
			$('#ifsc').attr('disabled', true);
			$('#ac_no').attr('disabled', true);
			$(".acno").hide();
		}
	});

	$('.mindate').attr( 'min','<?=$date->end_yr ?>-<?php $month=$date->end_mnth+1; if($month==13){echo sprintf("%02d",1);}else{echo sprintf("%02d",$month);}?>-01');
</script>

