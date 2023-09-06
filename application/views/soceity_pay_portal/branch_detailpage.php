<div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Society payment Detail</strong></h1>

            </div>

        </div>

        <div class="col-lg-10 container contant-wraper">    

            <h3>
		        <small></small>
                    <span class="confirm-div" style="float:right; color:green;"></span>
                <div class="input-group" style="margin-left:75%;">
                   
                </div>
            </h3>
                    <div class="form-group row">
                    <label for="soc_name" class="col-sm-2 col-form-label">Date:</label>
                        <div class="col-sm-4">
                            <input type="trans_dt" readonly name="trans_dt" class="form-control"  value='<?php echo date("d/m/Y",strtotime($payment->trans_date)); ?>'/>
                        </div>
                        <label for="soc_name" class="col-sm-2 col-form-label">Branch:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="trans_dt" class="form-control"  value='<?php echo get_district_name($payment->brn_id); ?>'/>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>
                        <div class="col-sm-5">
                            <input type="socname" readonly name="socname" class="form-control"  value='<?php echo get_fertisoc_name($payment->soc_id); ?>'/>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="soc_name" class="col-sm-2 col-form-label">Type:</label>
                        <div class="col-sm-4">
                            <input type="trans_dt" readonly name="trans_dt" class="form-control"  value='<?php if($payment->payment_type == 'A'){ echo 'ADVANCE';}else{
                                    echo 'INVOICE';
                                } ?>'/>
                        </div>
                        <label for="soc_name" class="col-sm-2 col-form-label">Amount:</label>
                        <div class="col-sm-4">
                            <input type="trans_dt" readonly name="trans_dt" class="form-control"  value='<?php echo $payment->amount; ?>'/>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="soc_name" class="col-sm-2 col-form-label">Payment mode:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="trans_dt" class="form-control"  value='<?php if($payment->payment_mode == 'C'){ echo 'CASH';}
                                elseif($payment->payment_mode == 'Q'){
                                    echo 'CHEQUE';
                                }else{
                                    echo 'INTERNET BANKING';
                                } ?>'/>
                        </div>
                       
                    </div>
                    <?php   if($payment->payment_mode == 'Q'){ ?>
                    <div class="form-group row">
                        <label for="soc_name" class="col-sm-2 col-form-label">Cheque no:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="trans_dt" class="form-control"  value='<?php echo $payment->cheque_no; ?>'/>
                        </div>
                        <label for="soc_name" class="col-sm-2 col-form-label">Cheque dt:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="trans_dt" class="form-control"  value='<?php echo $payment->cheque_dt; ?>'/>
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <label for="soc_name" class="col-sm-2 col-form-label">Cheque no:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="trans_dt" class="form-control"  value='<?php echo $payment->bank_name; ?>'/>
                        </div>
                        <label for="soc_name" class="col-sm-2 col-form-label">Cheque dt:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="trans_dt" class="form-control"  value='<?php echo $payment->ifs_code; ?>'/>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group row">
                        <label for="soc_name" class="col-sm-2 col-form-label">Payment ID:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="trans_dt" class="form-control"  value='<?php echo $payment->payment_id; ?>'/>
                        </div>
                        <label for="soc_name" class="col-sm-2 col-form-label">Status :</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="trans_dt" class="form-control"  value='<?php echo $payment->status; ?>'/>
                        </div>
                    </div>
                    <?php   if($payment->payment_mode == 'I'){ ?>
                    <div class="form-group row">
                        <label for="soc_name" class="col-sm-2 col-form-label">Invoice ID:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="trans_dt" class="form-control"  value='<?php echo $payment->invoice_id; ?>'/>
                        </div>
                    </div>
                    <?php } ?>
                    <?php   if($payment->method != null ){ ?>
                    <div class="form-group row">
                        <label for="soc_name" class="col-sm-2 col-form-label">Method:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control"  value='<?php echo $payment->method; ?>'/>
                        </div>
                        <label for="soc_name" class="col-sm-2 col-form-label">Bank:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control"  value='<?php echo $payment->bank; ?>'/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="soc_name" class="col-sm-2 col-form-label">Settlement date:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control"  value='<?php echo $payment->settlement_date; ?>'/>
                        </div>
                        <label for="soc_name" class="col-sm-2 col-form-label">Bank Status:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control"  value='<?php echo $payment->bank_status; ?>'/>
                        </div>
                       
                    </div>
                    

                    <?php } ?>
                    <div class="form-group row">
                        <label for="soc_name" class="col-sm-2 col-form-label">Remarks:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" readonly><?php echo $payment->note; ?></textarea>
                        </div>
                    </div>
                    <?php   if($payment->payment_at != null){ ?>
                  
                    <div class="form-group row">
                        <label for="soc_name" class="col-sm-2 col-form-label">Payment at:</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="trans_dt" class="form-control"  value='<?php echo date('d/m/Y h:i:sa',strtotime($payment->payment_at)); ?>'/>
                        </div>
                    </div>
                    <?php } ?>
            
            <h3></h3>
                <!-- <div class="row">
                    <div class="col-md-12" style="text-align:center;margin-bottom:20px">
                    <a href="<?=base_url() ; ?>index.php/fert/sppay/bpaymentlist"  class='btn btn-primary'
                                            title="Back">Back
                                        </a> 
                        
                            
                    </div>
                
                </div> -->
            <?php if($payment->bank_status == 'Captured'){  ?> 
            <div class="row">
                <div class="col-md-12" style="text-align:center;margin-bottom:20px">
                        <?php if($payment->payment_type == 'A'){  ?> 
                            <a href="<?=base_url() ; ?>index.php/fert/sppay/advpayapprove?order_id=<?php echo $payment->order_id;?>"  class='btn btn-primary'
                                         title="Approve">Approve
                                    </a> 
                     <?php   }else{  ?>
                        <a href="<?=base_url() ; ?>index.php/fert/sppay/invpay_approve?order_id=<?php echo $payment->order_id;?>"  class='btn btn-primary'
                                         title="Approve">Approve
                                    </a> 

                        <?php } ?>
                         
                </div>
             
            </div>
            <?php } ?>
            

        </div>

    </div>

<script>

    $(document).ready(function() {

    <?php if($this->session->flashdata('msg')){ ?>
	window.alert("<?php echo $this->session->flashdata('msg'); ?>");
    <?php } ?>
    });

    

</script>

<link href  = "https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href  = "https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />
<script src = "https://code.jquery.com/jquery-3.5.1.js"></script>
<script src = "https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

