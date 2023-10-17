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
        setTimeout(function() {
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
            '                                          table { border-collapse: collapse; font-size: 12px;}' +
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

                <h4>THE WEST BENGAL STATE CO.OP.MARKETING FEDERATION LTD.</h4>
                <h4>HEAD OFFICE: SOUTHEND CONCLAVE, 3RD FLOOR, 1582 RAJDANGA MAIN ROAD, KOLKATA-700107.</h4>
                <h3>Advance Payment Voucher of Insecticide Between:<?php echo  date("d/m/Y", strtotime($fDate)) . ' To ' . date("d/m/Y", strtotime($tDate)) ?></h3>
                <?php


    if ($tableData) {

    $totalnetamth = 0;
    $totalTdsh = 0;
    foreach ($tableDatasummary as $ptableDatasummary) {
    
        $tdsh = round(0.001 * round($ptableDatasummary->adv_amt, 2));
        $totalTdsh = $totalTdsh + $tdsh; 
        $netamth = round(round($ptableDatasummary->adv_amt, 2) - $tdsh);
        $totalnetamth = $totalnetamth + $netamth;

        } 
    }
    ?>

                <h5 style="text-align:left"><label><?php echo $companyName; ?>:</label> &ensp;&ensp;<?php echo round($total_Voucher->adv_amt, 2); ?> DR</h5>
                <h5 style="text-align:left"><label><?php foreach ($tableData as $bnk) {
                                                        echo $bnk->bnk;
                                                        break;
                                                    }; ?>:</label> &ensp;&ensp;<?php echo round($totalnetamth); ?> CR</h5>
                <h5 style="text-align:left"><label>TDS U/S 194Q:</label> &ensp;&ensp;<?php echo round($totalTdsh); ?> CR </h5>

            </div>
            <br>

            <table style="width: 100%;" id="example">

                <thead>

                    <tr>

                        <th>Sl No.</th>
                        <th>Date</th>
                        <th>Branch Name.</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Ro No</th>
                        <th>Fo No</th>
                        <th>Amount</th>
                        <th>TDS</th>
                        <th>NET Amount</th>

                    </tr>

                </thead>

                <tbody>

                    <?php


                    if ($tableData) {

                        $i = 1;
                        $total = 0;
                        $totalnetamt = 0;
                        $totalTds = 0;
                        foreach ($tableData as $ptableData) {
                            // $total=($ptableData->adv_amt+$total);
                            $total += $ptableData->adv_amt;
                        ?>

                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($ptableData->trans_dt)); ?></td>
                                <td><?php echo $ptableData->branch_name; ?></td>
                                <td><?php echo $ptableData->PROD_DESC; ?></td>
                                <td><?= $ptableData->qty; ?></td>
                                <td><?php echo $ptableData->ro_no; ?></td>
                                <td><?php echo $ptableData->fo_number . '-' . $ptableData->fo_name; ?></td>
                                <td><?php echo $ptableData->adv_amt; ?></td>
                                <td><?php 
                                echo round((0.001 * $ptableData->adv_amt),2);
                                $tds = round((0.001 * $ptableData->adv_amt),2);
                                    $totalTds = $totalTds + $tds; ?></td>
                                <td><?php $netamt =round(($ptableData->adv_amt - $tds),2);
                                    echo $netamt;
                                    $totalnetamt = $totalnetamt + $netamt; ?></td>
                            </tr>

                        <?php    } ?>

                        <tr>
                            <td colspan="7"><b>Total</b></td>
                            <td><b><?php echo round($total, 2); ?></b></td>
                            <td><b><?php echo $totalTds; ?></b></td>
                            <td><b><?php echo $totalnetamt; ?></b></td>
                        </tr>
                    <?php
                    } else {

                        echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";
                    }

                    ?>

                </tbody>

            </table>

            <h4 style="text-align:left; margin-top: 30px;">Summary </h4>

            <table style="width: 100%; background-color: #D5D5D5;" id="example">

                <thead>

                    <tr>

                        <th>Sl No.</th>
                        <th>Branch Name </th>
                        <th>Fo Number</th>
                        <th>Amount</th>
                        <th>TDS</th>
                        <th>NET Amount</th>

                    </tr>

                </thead>

                <tbody>

                    <?php


                    if ($tableData) {
                        $i = 1;
                        $total = 0;
                        $totalnetamt = 0;
                        $totalTds = 0;
                        foreach ($tableDatasummary as $ptableDatasummary) {
                            // $total=($ptableData->adv_amt+$total);
                            $total += $ptableDatasummary->adv_amt;
                    ?>

                            <tr>
                                <td><?php echo $i++; ?></td>

                                <td><?php if(!empty($ptableDatasummary->fo_name)){echo $ptableDatasummary->fo_name;}else{if(!empty($ptableDatasummary->branch_name)){echo $ptableDatasummary->branch_name;}else{echo "";}} ?></td>
                                <td><?php if(!empty($ptableDatasummary->fo_number)){echo $ptableDatasummary->fo_number;}else{ echo "";} ?></td>

                                <td style="text-align: right;"><?php echo $ptableDatasummary->adv_amt; ?></td>
                                <td style="text-align: right;"><?php  echo round((0.001 * $ptableDatasummary->adv_amt),2);
                                $tds = round((0.001 * $ptableDatasummary->adv_amt),2);
                                    $totalTds = $totalTds + $tds; ?></td>
                                <td style="text-align: right;"><?php $netamt = round(($ptableDatasummary->adv_amt - $tds),2);
                                    echo $netamt;
                                    $totalnetamt = $totalnetamt + $netamt; ?></td>
                            </tr>


                        <?php    } ?>

                        <tr>
                            <td colspan="3"><b>Total</b></td>
                            <td style="text-align: right;"><b><?php echo round($total, 2); ?></b></td>
                            <td style="text-align: right;"><b><?php echo round($totalTds, 2); ?></b></td>
                            <td style="text-align: right;"><b><?php echo $totalnetamt; ?></b></td>
                        </tr>
                    <?php
                    } else {

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
                 $cbank_name ='';$cbranch_name = '';$cacc_num = '';$cifsc ='';$comp_name='';
                // if($company_id != 1){
                    foreach ($tableData as $bnk) {
                    $bank_name = $bnk->bnk;$branch_name = $bnk->bnk_branch_name; $acc_num = $bnk->ac_no;$comp_name= $bnk->comp_name;
                    $cbank_name = $bnk->cbank;$cbranch_name = $bnk->cbnk_branch_name; $cacc_num = $bnk->cac_no;$cifsc=$bnk->cifsc;
                                                        break;
                                                    }; 
                //   }                                
                                                    ?>
                <p style="text-align:left"> &ensp;SCMF/FIN/&ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp;&ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp;<b>Date:<?=date('d/m/Y')?></b></p>
                <h5 style="text-align:left;font-size:18px"><label>To</label> &ensp;&ensp;<br>The Manager</br><?=$bank_name?>,<br><?=$branch_name?>,
                <br>Kolkata - 700019</h5>

            </div>
            <br>
           <div style="line-height: 1.6;font-size:18px">
            Sir,<br>&ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp;We are authorizing you to remit by debiting our Savings Account No.  <?=$acc_num?> in favour of
            <?=$comp_name?> through NEFT/RTGS/Fund Transfer, details are being provided below:

           <br><br>
           <?php if($company_id == 1|| $company_id == 10 || $company_id == 11) { ?>
           <table style="width:100%;border: 1px solid black !important;border-collapse:collapse !important;" >
                <thead>
                    <tr  >
                        <th style="border: 1px solid black !important">DISTRICT</th>
                        <th style="border: 1px solid black !important">IFS CODE</th>
                        <th style="border: 1px solid black !important">BENEACCNO</th>
                        <!-- <th style="border: 1px solid black !important">BENENAME</th> -->
                        <th style="border: 1px solid black !important">AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   $totalnetamt = 0;
                            if($tableData) {
                            $i = 1;
                            $total = 0;
                            $totalnetamt = 0;
                            $totalTds = 0;
                            $tds = 0;
                            foreach ($tableDatasummary as $ptableDatasummary) {
                            $total += $ptableDatasummary->adv_amt;
                    ?>
                    <tr>
                        <td style="border: 1px solid black !important"><?php if(!empty($ptableDatasummary->fo_name)){echo $ptableDatasummary->fo_name;}?></td>
                        <td style="border: 1px solid black !important"><?=$cifsc?></td>
                        <td style="border: 1px solid black !important"><?php if(!empty($ptableDatasummary->fo_number)){echo $ptableDatasummary->fo_number;}else{ echo "";} ?></td>
                       
                        <?php  $tds = round((0.001 * $ptableDatasummary->adv_amt),2); ?>
                        <td style="border: 1px solid black !important"><?php $netamt = round(($ptableDatasummary->adv_amt - $tds),2);  ?>
                       
                            <?php        echo $netamt;
                                    $totalnetamt = $totalnetamt + $netamt; ?></td>
                    </tr>

                    <?php    }  }?>
                    <tr>
                        <td colspan="3" style="text-align:center">TOTAL</td>
                        <td><?php echo $totalnetamt; ?> </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center">Rupee : <?=getIndianCurrency($totalnetamt)?></td>
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
                <!-- <tr>
                    <td style="width:30%">Name of A/C Holder:</td><td><?=$companyName?></td>
                <tr> -->
                <tr>
                    <td style="width:30%">Account no :</td><td><?=$cacc_num?> </td>
                <tr>
                <tr>
                    <td style="width:30%">IFS CODE :</td><td><?=$cifsc?></td>
                <tr>
                <tr>
                    <td style="width:30%">Amount :</td><td>Rs.  <?php echo $totalnetamt; ?> (<?=getIndianCurrency($totalnetamt)?>)</td>
                <tr>
             <table>   
            <?php } ?> 
           </div>

            <table style="width: 100%; background-color: #D5D5D5;" id="example">

            </table>
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
                        <?php }elseif($sig == 4){ ?>
                        <td style="border:none;"></td>
                        <td style="border:none;">Manager Accounts</td>
                        <td style="border:none;"></td>
                        <td style="border:none;">Deputy Manager Accounts</td>

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
                    filename: "Cheque status for <?php echo get_district_name($this->input->post("branch_id")) ?> branch for paddy procurement between Block Societywise Paddy Procurement Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))) . ' To ' . date("d-m-Y", strtotime($this->input->post('to_date'))); ?>.xls"
                });
            });
        });*/
</script>