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

<script>
  function printDiv() {

        var divToPrint = document.getElementById('divToPrint');

        var WindowObject = window.open('', 'Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
            '                                          table { border-collapse: collapse; font-size: 12px;}' +
            '                                          th, td { border: 1px solid black; border-collapse: collapse; padding: 6px;}' +
            '                                           th, td { }' +
            '                                         .border { border: 1px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed ' +
            '                                       ' +
            '                                   } } </style>');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function () {
            WindowObject.close();
        }, 10);

  }
  function printadvDiv() {
        var divToPrint = document.getElementById('divadvToPrint');
        var WindowObject = window.open('', 'Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title></title><style type="text/css">');

        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
                                                      ' .headeraddress { font-weight: normal;}' +
                                                     ' .headertitle { font-weight: bold;font-size: 22px;}' +
            '                                         .inline { display: inline; }' +
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
            '                                          table { border-collapse: collapse; font-size: 18px;}' +
            '                                          th, td { border: 0px solid black; border-collapse: collapse; padding: 6px;}' +
            '                                           th, td { }' +
            '                                         .border { border: 0px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed ' +
            '                                       ' +
            '                                   } } </style>');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function() {
            WindowObject.close();
        }, 10);
    }
</script>

        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div style="text-align:center;">

                        <h2>THE WEST BENGAL STATE CO.OP.MARKETING FEDERATION LTD.</h2>
                        <h4>HEAD OFFICE: SOUTHEND CONCLAVE, 3RD FLOOR, 1582 RAJDANGA MAIN ROAD, KOLKATA-700107.</h4>
                        <h4>Company Payment Statement of Insecticide Between:<?php echo  date("d/m/Y", strtotime($fDate)).' To '.date("d/m/Y", strtotime($tDate)) ?></h4>
    <?php //print_r($total_Voucher);  ?>
                        <h5 style="text-align:left"><label><?php echo $companyName; ?>:</label>  &ensp;&ensp;<?php echo round($total_Voucher->taxable_amt,2); ?> Dr</h5> 
                     <h5 style="text-align:left"><label><?php foreach($tableData as $bnk){ echo $bnk->bnk; break; };?>:</label> &ensp;&ensp;<?php echo round(($total_Voucher->taxable_amt - $total_Voucher->tds_amt),2); ?> Cr</h5>
						<h5 style="text-align:left"><label>TDS U/S 194Q:</label> &ensp;&ensp;<?php echo round($total_Voucher->tds_amt,2); ?> Cr </h5>
                     <!--<h5 style="text-align:left"><label>Product:</label> <?php //echo $product->PROD_DESC; ?></h5>-->

                    </div>
                    <br>  

                    <table style="width: 100%;" id="example">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>
                                <th>Date</th>
                                <th>District</th>
                                <th>Purchase Invoice</th>
								<th>FO Name</th>
                                <th>Product</th>
                                <th>Purchase Ro</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                <th>TDS</th>
                                <th>NET Amount</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($tableData){ 
                                    $i = 1;
                                  $totalRate=0;
                                  $totalAmount=0;
                                  $totalTDS=0;
                                  $totalNETAmount=0;
                                    foreach($tableData as $ptableData){
                                       // $total=($ptableData->adv_amt+$total);
                                       //$total +=$ptableData->adv_amt;
                            ?>
<!-- a.pay_dt,c.district_name,a.pur_inv_no,b.PROD_DESC,a.pur_ro,a.qty,a.rate_amt,a.taxable_amt,a.tds_amt,a.net_amt -->
                                <tr>
                                     <td><?php echo $i++; ?></td>
                                     <td><?php echo date("d/m/Y", strtotime($ptableData->pay_dt)); ?></td>
                                     <td><?php echo $ptableData->br_dist; ?></td>
                                     <td><?php echo $ptableData->pur_inv_no; ?></td>
                                     <td><?php echo $ptableData->fo_nm; ?></td>
                                     <td><?php echo $ptableData->PROD_DESC; ?></td>
                                     <!-- <td><?= $ptableData->PROD_DESC; ?></td> -->
                                     <td><?php echo $ptableData->pur_ro; ?></td>
                                     <td><?php echo $ptableData->qty; ?></td>
                                     <td><?php echo  $ptableData->rate_amt ; $totalRate+=$ptableData->rate_amt; ?></td>

                                     <td><?php echo $ptableData->taxable_amt ;$totalAmount+=$ptableData->taxable_amt; ?></td>

                                     <td><?php echo $ptableData->tds_amt;$totalTDS+=$ptableData->tds_amt;?></td>

                                     <!--<td><?php //echo $ptableData->net_amt;$totalNETAmount+=$ptableData->net_amt;?></td>-->
                                     <td><?php echo $ptableData->taxable_amt - $ptableData->tds_amt; $totalNETAmount+=$ptableData->taxable_amt - $ptableData->tds_amt;?></td>
                                </tr>
                               
 
                                <?php    } ?>

                                <tr>
                                    <td><b></b></td>
                                    <td><b></b></td>
                                    <td><b></b></td>
                                    <td><b></b></td>
                                    <td><b></b></td>
                                    <td><b></b></td>
                                    <td><b></b></td>
                                    <td><b>Total</b></td>
                                    <td><b><?php //echo round($totalRate,2); ?></b></td>
                                    <td><b><?php echo $totalAmount; ?></b></td>
                                    <td><b><?php echo $totalTDS; ?></b></td>
                                    <td><b><?php echo  $totalNETAmount; ?></b></td>
                                </tr>
                                <?php 
                                       }
                                else{

                                    echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                }   

                            ?>

                        </tbody>

                    </table>



                    <h4 style="text-align:left; margin-top: 30px;">Summary </h4>

                    <table style="width: 100%;  background-color: #D5D5D5;"" id="example">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>
                                <th>District/Fo Number</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>TDS</th>
                                <th>NET Amount</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            

                                if($tableData){ 

                                    $i = 1;
                                  $totalRate=0;
                                  $totalAmount=0;
                                  $totalTDS=0;
                                  $totalNETAmount=0;
                                    foreach($tableData_district_name as $ptableDatasidt){
                                       // $total=($ptableData->adv_amt+$total);
                                       //$total +=$ptableData->adv_amt;
                            ?>
<!-- a.pay_dt,c.district_name,a.pur_inv_no,b.PROD_DESC,a.pur_ro,a.qty,a.rate_amt,a.taxable_amt,a.tds_amt,a.net_amt -->
                                <tr>
                                     <td><?php echo $i++; ?></td>
                                     
                                     <td><?php  if(!empty($ptableDatasidt->fo_nm)){echo $ptableDatasidt->fo_nm;}else{ echo $ptableDatasidt->district_name;} ?></td>
                                     
                                     <td><?php echo $ptableDatasidt->qty; ?></td>
                                    

                                     <td><?php echo $ptableDatasidt->taxable_amt ;$totalAmount+=$ptableDatasidt->taxable_amt; ?></td>

                                     <td><?php echo $ptableDatasidt->tds_amt;$totalTDS+=$ptableDatasidt->tds_amt;?></td>

                                     
                                     <td><?php echo $ptableDatasidt->net_amt; $totalNETAmount+=$ptableDatasidt->net_amt;?></td>
                                </tr>
                               
 
                                <?php    } ?>

                                <tr>
                                    <td><b></b></td>
                                    <td><b></b></td>
                                    <td><b></b></td>
                                    
                                    <td><b><?php echo $totalAmount; ?></b></td>
                                    <td><b><?php echo $totalTDS; ?></b></td>
                                    <td><b><?php echo  $totalAmount-$totalTDS; ?></b></td>
                                </tr>
                                <?php 
                                       }
                                else{

                                    echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                }   

                            ?>

                        </tbody>

                    </table>


					<table style="margin-top: 100px; border:none;" id="example" width="100%" cellspacing="0" cellpadding="0" border="0">
				<tbody style="border:none;">
					<tr style="border:none;">
					 
					  <td style="border:none;">Prepared By</td>
					 
					  						<td style="border:none;">Asst Manager/Dy. Manager</td>
					  <td style="border:none;">Departmental Manager(S)</td>
					  <td style="border:none;">CA&amp;AO</td>
					  <td style="border:none;">General Manager</td>
					  					</tr>
				</tbody>
						
						</table>

                </div>   
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
                    <button class="btn btn-primary" type="button" onclick="printadvDiv();">Print Advice</button>
                   <!-- <button class="btn btn-primary" type="button" id="btnExport" >Excel</button>-->

                </div>

            </div>
            
        </div>

        <div id="divadvToPrint"   style="display:none">
            <table style="width:100%;border:none !important;" >
                <tr>
                    <td style="width:20%"><img src="<?=base_url()?>benfed.png"></td>
                    <td style="width:79%"><span class="headertitle">The West Bengal State Co-operative Markrting Federation Ltd.</span>
                <br><span class="headeraddress">Southend Conclave, 3rd Floor,<br> 1582 Rajdanga Main Road, Kolkata-700107.</span>
        
                 </td>
                </tr>
            </table>
            <div style="text-align:center;">
              
                <?php  $bank_name = '';$branch_name = ''; $acc_num = '';$address ='';
                       $cbank_name ='';$cbranch_name = '';$cacc_num = '';$cifsc ='';
                foreach ($tableData as $bnk) {
                    $bank_name = $bnk->bnk;$branch_name = $bnk->bnk_branch_name; $acc_num = $bnk->acc_num;
                    $cbank_name = $bnk->cbank;$cbranch_name = $bnk->cbnk_branch_name; $cacc_num = $bnk->cac_no;$cifsc=$bnk->cifsc;
                                                        break;
                                                    }; ?>
                <p style="text-align:left"> &ensp;SCMF/FIN/&ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp;&ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp;<b>Date:<?=date('d/m/Y')?></b></p>
                <h5 style="text-align:left;font-size:18px"><label>To</label> &ensp;&ensp;<br>The Manager</br><?=$bank_name?>,<br><?=$branch_name?>,
                <br>Kolkata - 700019</h5>
            </div>
            <br>
           <div style="line-height: 1.6;font-size:18px">
            Sir,<br>&ensp;&ensp; &ensp;&ensp; We are authorizing you to remit by debiting our Savings Account No.  <?=$acc_num?> through NEFT/RTGS/Fund Transfer, details are being provided below:

           <br><br>
           <?php if($company_id == 1) { ?>
           <table style="width:100%;border: 1px solid black !important;border-collapse:collapse !important;" >
           <thead>
                    <tr  >
                        <th style="border: 1px solid black !important">DISTRICT</th>
                        <th style="border: 1px solid black !important">IFS CODE</th>
                        <th style="border: 1px solid black !important">BENEACCNO</th>
                        <th style="border: 1px solid black !important">BENENAME</th>
                        <th style="border: 1px solid black !important">AMOUNT</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php   
                            if($tableData) {
                            $i = 1;
                            $total = 0;
                            $totalNETAmount = 0;
                            $totalTds = 0;
                            foreach ($tableData_district_name as $ptableDatasidt) {
                            $total += $ptableDatasidt->net_amt;
                    ?>
                    <tr>
                        <td style="border: 1px solid black !important"><?php if(!empty($ptableDatasidt->fo_nm)){echo $ptableDatasidt->fo_nm;}else{ echo $ptableDatasidt->district_name;}?></td>
                        <td style="border: 1px solid black !important"><?=$cifsc?></td>
                        <td style="border: 1px solid black !important"><?php if(!empty($ptableDatasidt->fo_num)){echo $ptableDatasidt->fo_num;}else{ echo "";} ?></td>
                        <td style="border: 1px solid black !important">IFFCO</td>
                        <td style="border: 1px solid black !important"><?php echo $ptableDatasidt->net_amt; $totalNETAmount+=$ptableDatasidt->net_amt;?></td>
                    </tr>

                    <?php    }  }?>
                    <tr>
                        <td colspan="4" style="text-align:center">TOTAL</td>
                        <td><?=$totalNETAmount?></td>
                    </tr>
                </tbody>
               
            <table> 
            <?php }else { ?>
            <table style="width:100%;border:none !important;font-weight:bold" >
            <tr>
                    <td style="width:30%">Name of the bank:</td><td><?=$cbank_name?></td>
                <tr>
                <tr>
                    <td style="width:30%">Branch Name:</td><td><?=$cbranch_name?></td>
                <tr>
                <tr>
                    <td style="width:30%">Name of A/C Holder:</td><td><?=$companyName?></td>
                <tr>
                <tr>
                    <td style="width:30%">Account no :</td><td><?=$cacc_num?> </td>
                <tr>
                <tr>
                    <td style="width:30%">IFS CODE :</td><td><?=$cifsc?></td>
                <tr>
                <tr>
                    <td style="width:30%">Amount :</td><td>Rs.  <?=$totalNETAmount?> (<?=getIndianCurrency($totalNETAmount)?>)</td>
                <tr>
             <table>   
            <?php } ?>  
             
           </div>

            
            <table style="margin-top: 100px; border:none;font-weight:bold" id="example" width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody style="border:none;">
                    <tr style="border:none;">
                    <?php    if($sig == 1){    ?>
                        <td style="border:none;"></td>
                        <td style="border:none;">Manager (Audit & Accounts)</td>
                        <td style="border:none;"></td>
                        <td style="border:none;">Chief Audit & Accounts Officer</td>
                    <?php }elseif($sig == 2){ ?> 
                        <td style="border:none;"></td>
                        <td style="border:none;">Manager (Audit & Accounts)</td>
                        <td style="border:none;"></td>
                        <td style="border:none;">General Manager(Administration)</td>   
                        <?php }elseif($sig == 3){ ?> 
                            <td style="border:none;"></td>
                        <td style="border:none;">Chief Audit & Accounts Officer</td>
                        <td style="border:none;"></td>
                        <td style="border:none;">General Manager(Administration)</td>
                        <?php } ?>
                    </tr>
                    
                </tbody>
            </table>
            <table style="margin-top:0px; border:none;font-weight:bold" id="example" width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody style="border:none;">
                    <tr style="border:none;">
                        <td style="border:none;">Encl:Cheque bearing No:</td>
                        <td style="border:none;"></td>
                        <td style="border:none;">Dated:<?=date('d/m/Y')?></td>
                        <td style="border:none;"></td>
                    </tr>
                </tbody>
            </table>

        </div>
        
    <script type="text/javascript">
        /*$(function () {
            $("#btnExport").click(function () {
                $("#example").table2excel({
                    filename: "Cheque status for <?php echo get_district_name($this->input->post("branch_id")) ?> branch for paddy procurement between Block Societywise Paddy Procurement Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
                });
            });
        });*/
    </script>

<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
 
        <script>
    $('#example').dataTable({
        destroy: true,
        searching: false,
        ordering: false,
        paging: false,

        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            title: ' Company Payment Statement',
            text: 'Export to excel'

        }]
    });
</script>