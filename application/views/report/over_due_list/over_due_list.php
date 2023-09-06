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
        WindowObject.document.writeln('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title></title><style type="text/css">');


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
                        <h4>Overdue List As On: <?php echo date("d/m/Y", strtotime($date))?></h4>
                        <?php $branciId=$this->session->userdata('loggedin')['branch_id'];
        if($branciId != 342){ ?>
                        <h5 style="text-align:left"><label>District: </label> <?php  foreach($allData as $data){ echo $data->branch_name; break; } ?></h5>
                        <!-- <h5 style="text-align:left"><label>Company: </label> <?php  //if($product){ foreach($product as $prodtls);echo $prodtls->short_name;}?></h5> --> 
                        <?php } ?>

                    </div>
                  

                    <table style="width: 100%;" id="example">

                        <thead>
                        <!-- <tr>
                                <th></th>
                                <th></th>
                                <th colspan =4><b>Solid(MTS)</b></th>
                                <th colspan =5><b>Liquid(LTR)</b></th>
                            </tr> -->

                            <tr>
                            
                                <th>Sl No.</th>

                                <!-- <th>Branch Code</th> -->
<?php   if($branciId == 342){ ?>
                                <th>Branch Name</th>
<?php } ?>
                                <!-- <th>Society id </th> -->

                                <th>Society Name</th>

                                <th>Ro No</th>

                                <!-- <th>Product Id</th> -->

                                <th>Product</th>
                                    
                               <th>Invoice No.</th>

                                <th>Invoice Date</th>
                                <th>No. Of Days</th>
                                <th>Due Date</th>
                                <th>Quantity</th>
                                <!-- <th>unit</th> -->
                                <th>Unit</th>
                                <th>Invoice Amount</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                           
                                if(!empty($allData)){ 
                                        $i=0;
                                        $round_tot_amt=0.0;
                                        $paid_amt=0.0;
                                        $due_amt=0.0;
                                        foreach($allData as $data){ $i++; ?>

                                <tr class="rep">
                                     <td class="report"><?php echo $i; ?></td>
                                
                                     <!-- <td class="report"><?php echo $data->br_cd ?></td> -->
                                     <?php if($branciId == 342){ ?>
                                     <td class="report"><?php echo $data->branch_name ?></td>
                                     <?php } ?>
                                     <!-- <td class="report"><?php echo $data->soc_id ?></td> -->
                                     <td class="report"><?php echo $data->soc_name ?></td>
                                     <td class="report"><?php echo $data->sale_ro ?></td>
                                     <!-- <td class="report"><?php //echo $data->prod_id ?></td> -->
                                     <td class="report"><?php echo $data->prod_desc ?></td>
                                     <td class="report"><?php echo $data->trans_do ?></td>
                                     <td class="report"><?php echo date("d/m/Y", strtotime($data->do_dt)) ?></td>
                                     <td class="report"><?php echo $data->no_of_days ?></td>
                                     <td class="report"><?php echo date("d/m/Y", strtotime($data->sale_due_dt)) ?></td>
                                     <td class="report"><?php echo $data->qty ?></td>
                                     <td class="report"><?php echo $data->unit_name ?></td>
                                     <td class="report"><?php echo $data->round_tot_amt;$round_tot_amt=$round_tot_amt+$data->round_tot_amt ?></td>
                                     <td class="report"><?php echo $data->paid_amt; $paid_amt=$paid_amt+$data->paid_amt; ?></td>
                                     <td class="report"><?php echo $data->due_amt; $due_amt=$due_amt+$data->due_amt; ?></td>
                                    
                          
                                </tr>
 
                                <?php  
                                                        
                                    }
                                ?>
                                    <tr>
                                        <td class="report"><b>Total</b></td>
                                        <td class="report"></td>
                                        <?php   if($branciId == 342){ ?>
                                        <td class="report"></td>
                                        <?php } ?>
                                        <td class="report"></td>
                                        <td class="report"></td>
                                        <td class="report"></td>
                                        <td class="report"></td>
                                        <td class="report"></td>
                                        <td class="report"></td>
                                        <td class="report"></td>
                                        <td class="report"></td>
                                        <td class="report"><b><?=round($round_tot_amt,3)?></b></td>
                                        <td class="report"><b><?=round($paid_amt,3)?></b></td>
                                        <td class="report"><b><?=round($due_amt,3)?></b></td>
                                    </tr>
 
                                <?php 
                                       }
                                else{

                                    echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                }   

                            ?>

                        </tbody>
                    </table>

                </div>   
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
               <!-- <button class="btn btn-primary" type="button" id="btnExport" >Excel</button>-->

                </div>

            </div>
            
        </div>

<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>

<script>
   $('#example').dataTable({
    destroy: true,
   searching: false,ordering: false,paging: false,

    dom: 'Bfrtip',
    buttons: [
    {
    extend: 'excelHtml5',
    title: 'Over Due List',
    text: 'Export to excel'

   }
]
   });
</script>