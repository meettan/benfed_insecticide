<div class="wraper">

    <div class="col-md-11 container form-wraper">
    <?php if($this->session->userdata['loggedin']['branch_id']!=342){ ?>
        <form method="POST" id="product" action="<?php echo site_url("adv/editadv") ?>">
<?php } ?>
            <div class="form-header">

                <h4>Edit Advance</h4>

            </div>

            <div class="form-group row">
                <label for="receipt_no" class="col-sm-2 col-form-label">Receipt No.:</label>

                <div class="col-sm-4">

                    <input type="text" id=receipt_no name="receipt_no" class="form-control"
                        value="<?php echo $advDtls->receipt_no; ?>" readonly />

                </div>
                <label for="society" class="col-sm-2 col-form-label">Society:</label>
                <div class="col-sm-4">

                    <select name="society" class="form-control sch_cd required" id="society" required disabled>

                        <option value="">Select Society</option>

                        <?php

                            foreach($societyDtls as $val){

                        ?>

                        <option value="<?php echo $val->soc_id;?>"
                            <?php echo($advDtls->soc_id==$val->soc_id)?'selected':'';?>><?php echo $val->soc_name;?>
                        </option>

                        <?php

                            }

                        ?>

                    </select>

                </div>

            </div>

            <div class="form-group row">
                <label for="trans_type" class="col-sm-2 col-form-label">Transaction Type:</label>
                <div class="col-sm-4">

                    <select name="trans_type" class="form-control required" id="trans_type" disabled>

                        <option value="I" <?php echo($advDtls->trans_type=='I')?'selected':'';?>>Deposit</option>

                        <!--    <option value="O"<?php //echo($advDtls->trans_type=='O')? 'selected' : '';?>>Adjustment</option> -->

                    </select>

                </div>

                <label for="adv_amt" class="col-sm-2 col-form-label">Amount:</label>
                <div class="col-sm-4">

                    <input type="text" id=adv_amt name="adv_amt" class="form-control required"
                        value="<?php echo $advDtls->adv_amt; ?>" required readonly />

                </div>
            </div>
            <div class="form-group row">
                <label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>

                <div class="col-sm-4">

                    <input type="date" id=trans_dt name="trans_dt" class="form-control"
                        value="<?php echo $advDtls->trans_dt; ?>" required readonly/>

                </div>
                <div class="col-sm-2">

                    <input id="cshbank" name="cshbank" type="radio" class="radio-label"
                        <?php if($advDtls->cshbnk_flag=='0') echo "checked='checked'"; ?> value="0" disabled />

                    <label for="cshbank" class="radio-label">Cash</label>
                </div>
                <div class="col-sm-2">
                    <input id="cshbank" name="cshbank" type="radio" class="radio-label"
                        <?php if($advDtls->cshbnk_flag=='1') echo "checked='checked'"; ?>value="1" disabled />

                    <label for="cshbank" class="radio-label">Bank</label>
                </div>
            </div>
<?php if($advDtls->cshbnk_flag=='1'){ ?>
            <div class="form-group row acno">

				<label for="referenceNo" class="col-sm-2 col-form-label">Reference No :</label>
				<div class="col-sm-4">
					<input type="text" id="referenceNo" name="referenceNo" class="form-control" value="<?php echo $advDtls->referenceNo; ?>" readonly/>
					

				</div>
			</div>
            <div class="form-group row">
                <label for="bank" class="col-sm-2 col-form-label">Bank:</label>

                <div class="col-sm-4">

                    <select name="bank" class="form-control sch_cd required" id="bank" disabled>

                        <option value="">Select bank</option>

                        <?php

                            foreach($bnk_dtls as $val){

                        ?>

                        <option value="<?php echo $val->sl_no;?>"
                            <?php echo($advDtls->bank==$val->sl_no)?'selected':'';?>><?php echo $val->bank_name;?>
                        </option>

                        <?php

                            }

                        ?>
                       <option value="43" <?php echo($advDtls->bank==43)?'selected':'';?>>HDFC BANK (3772) </option>
                    </select>
                </div>
                <label for="ac_no" class="col-sm-2 col-form-label">A/C No.:</label>
                <div class="col-sm-4">

                    <input type="text" id=ac_no name="ac_no" class="form-control ac_no"
                        value="<?php echo $advDtls->ac_no; ?>" readonly />

                </div>



            </div>
            <?php } ?>
            <div class="form-group row">
                <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>
                <div class="col-sm-10">

                    <textarea id=remarks name="remarks" class="form-control"><?php echo $advDtls->remarks; ?></textarea>
                </div>
            </div>
            <?php if($this->session->userdata['loggedin']['branch_id']!=342){ ?>
            <div class="form-group row">
                <div class="col-sm-10">

                    <input type="submit" id="submit" class="btn btn-info active_flag_c" value="Save" />
                </div>


            </div>
           
        </form>
        <?php } ?>
       
        <div class="form-group row">
            <div class="col-sm-10">


            </div>
            <div class="col-sm-2">
                <a href="<?php echo base_url();?>index.php/adv/add_advdetail?rcpt=<?php echo $advDtls->receipt_no; ?>"
                    class="btn btn-success">Detail Entry</a>

            </div>

        </div>
        

    </div>
</div>


<script>
    $(".sch_cd").select2();
</script>

<script>
    $(document).ready(function () {

        var i = 2;

        $('#bank').change(function () {

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
                    // $('#ifsc').val(ifsc);

                });


        });

    });
</script>
<script>
    $('input:radio[name="cshbank"]').change(function () {
        console.log('hi');
        if ($(this).val() == '1') {
            $('#bank').attr('disabled', false);
            $('#bank').attr('required', 'required');
        } else if ($(this).val() == '0') {
            $('#bank').attr('disabled', true);
            $("#ac_no").val("");
            //  $("#bank").val('Select bank', 'Select bank'); 
            $("#bank")[0].selectedIndex = 0;
            $("#bank").trigger("change");
            $("#remarks").val("");

        }
    });

    $(document).ready(function () {

        var i = 0;
        $("#intro").on("change", ".comp_id", function () {

            var row = $(this).closest('tr');
            var comp_id = $(this).val();
            row.find("td:eq(1) .prod_id").html('');
            $.get('<?php echo site_url("stock/f_get_product");?>', {
                comp_id: $(this).val()
            }).done(function (data) {

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function (index, value) {

                    string += '<option value="' + value.prod_id + '">' + value
                        .prod_desc + '</option>'
                });

                row.find("td:eq(1) .prod_id").append(string);

            });

        });

    });

    $(document).ready(function () {

        $("#addrow").click(function () {

            var string = '';

            '<?php  foreach($compdtls as $key){  ?>';

            string +=
                '<option value="<?php echo $key->comp_id;?>"><?php echo $key->comp_name;?></option>';

            '<?php  }  ?>';


            var newElement1 = '<tr>' +
                '<td id= "td_cdpo" >' +
                '<select name="comp_id[]" style="width:250px" class= "form-control comp_id" required><option value="">Select</option>' +
                string +
                '</select>' +
                '</td>' +
                '<td id="td_pb_no">' +
                '<select name="prod_id[]" style="width:200px" class= "form-control prod_id" required>' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<input type="text" name="fo_no[]" class="form-control fo_no" id="" required>' +
                '</td>' +
                '<td>' +
                '<input type="text" name="ro_no[]" class="form-control ro_no" id="" required>' +
                '</td>' +
                '<td>' +
                '<input type="text" name="amount[]" class="form-control amount" id="" required>' +
                '</td>' +
                '<td>' +
                '<button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>' +
                '</td>' +
                '</tr>';

            $("#intro").append($(newElement1));
        })

        $("#intro").on("click", "#removeRow", function () {
            $(this).parents('tr').remove();
            //$('.amount_cls').change();
        });

    });
</script>

