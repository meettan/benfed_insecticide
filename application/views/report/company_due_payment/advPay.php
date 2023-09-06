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
</script>

        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div style="text-align:center;">

                        <h2>THE WEST BENGAL STATE CO.OP.MARKETING FEDERATION LTD.</h2>
                        <h4>HEAD OFFICE: SOUTHEND CONCLAVE, 3RD FLOOR, 1582 RAJDANGA MAIN ROAD, KOLKATA-700107.</h4>
                        <h4>Districtwise Company Due Statement Between:<?php echo  date("d/m/Y", strtotime($fDate)).' To '.date("d/m/Y", strtotime($tDate)) ?></h4>
                        <h5 style="text-align:left"><label><?php echo $companyName; ?></label>  &ensp;&ensp;</h5>
                        <h5 style="text-align:left"><label><?php echo $distname->district_name; ?></label>  &ensp;&ensp;</h5> 
                  


                    </div>
                    <br>  


                    <table style="width: 100%;  background-color: #D5D5D5;"" id="example">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>
                                <!-- <th>District/Fo Number</th> -->
                                <th>Product</th>
                                <th>Ro Number</th>
                                <th>Ro date</th>
                                <th>Pur invoice No.</th>
                                <th>Purchase amt.</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                            
                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            

                                if($tableData){ 

                                    $i = 1;
                                    $pur_tot_amt = 0;
                                  $totalRate=0;
                                  $totalAmount=0;
                                  $totalTDS=0;
                                  $totalNETAmount=0;$totdue = 0;
                                    foreach($tableData_district_name as $ptableDatasidt){
                                       
                            ?>
                                <tr>
                                     <td><?php echo $i++; ?></td>
                                     <td><?php echo $ptableDatasidt->prod_desc; ?></td>
                                     <!-- <td><?php  //if(!empty($ptableDatasidt->fo_nm)){echo $ptableDatasidt->fo_nm;}else{ echo $ptableDatasidt->district_name;} ?></td> -->
                                     <td><?php echo $ptableDatasidt->ro_no ; ?></td>
                                     <td><?php echo date('d/m/Y',strtotime($ptableDatasidt->ro_dt)) ; ?></td>
                                     <td><?php echo $ptableDatasidt->invoice_no ;?></td>
                                     <td><?php echo $ptableDatasidt->tot_amt ;$pur_tot_amt+=$ptableDatasidt->tot_amt ;?></td>
                                     <td><?php echo $ptableDatasidt->Comp_pay ;$totalAmount+=$ptableDatasidt->Comp_pay; ?></td>
                                     <td><?php echo round((($ptableDatasidt->tot_amt)-($ptableDatasidt->Comp_pay)),2) ;
                                     $totdue += ($ptableDatasidt->tot_amt)-($ptableDatasidt->Comp_pay); ?></td>
                                </tr>
                               
 
                                <?php    } ?>

                                <tr>
                                    <td colspan="5"><b>Total</b></td>
                                    
                                    <td><b><?=$pur_tot_amt?></b></td>
                                    <td><b><?php echo $totalAmount; ?></b></td>
                                    <td><b><?php echo $totdue; ?></b></td>
                                    
                                </tr>
                                <?php 
                                       }
                                else{

                                    echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                }   

                            ?>

                        </tbody>

                    </table><br>
                <!-- <h2>SUMMARY</h2>
					<table style="margin-top: 50px;" id="example" width="100%" cellspacing="0" cellpadding="0" border="0">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>District/Fo Number</th>
                            <th>Purchase amt.</th>
                            <th>Paid Amount</th>
                        </tr>
                    </thead>   
				    <tbody>
                        
                        <?php
                            

                            if($tableData){ 

                                $i = 1;
                                $dpur_tot_amt = 0;
                                
                                $dtotalAmount=0;
                                foreach($tableData_districtwise as $dkey){
                                   
                        ?>
                            <tr>
                                 <td><?php echo $i++; ?></td>
                                 <td><?php  if(!empty($dkey->fo_nm)){echo $dkey->fo_nm;}else{ echo $dkey->district_name;} ?></td>
                                 <td><?php echo $dkey->pur_amt ;$dpur_tot_amt+=$dkey->pur_amt ;?></td>
                                 <td><?php echo $dkey->taxable_amt ;$dtotalAmount+=$dkey->taxable_amt; ?></td>
                            </tr>
                           
                            <?php    } ?>

                            <tr>
                                <td colspan="2"><b>Total</b></td>
                                <td><b><?=$dpur_tot_amt?></b></td>
                                <td><b><?php echo $dtotalAmount; ?></b></td>
                                
                            </tr>
                            <?php 
                                   }
                            else{

                                echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                            }   

                        ?>
				    </tbody>
						
					</table> -->
                    <br>

                </div>   
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
                   <!-- <button class="btn btn-primary" type="button" id="btnExport" >Excel</button>-->

                </div>

            </div>
            
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