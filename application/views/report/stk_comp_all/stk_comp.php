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


<div id="overlay" style="display:none;">
            <div class="spinner"></div>
        </div>
  

        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div style="text-align:center;">

                        <h2>THE WEST BENGAL STATE CO.OP.MARKETING FEDERATION LTD.</h2>
                        <h4>HEAD OFFICE: SOUTHEND CONCLAVE, 3RD FLOOR, 1582 RAJDANGA MAIN ROAD, KOLKATA-700107.</h4>
                        <h4>Monthly Summary Report Between: <?php echo $_SESSION['date']; ?></h4>
                        <h5 style="text-align:left"><label>District: </label> <?php if(!empty($branch->district_name)){ echo $branch->district_name;}else{echo "All District"; } ?></h5>
                        <h5 style="text-align:left"><label>Company: </label> <?php  if($product){ foreach($product as $prodtls);echo $prodtls->comp_name;}?></h5>

                    </div>
                  

                    <table style="width: 100%;" id="example">

                        <thead>
                        <tr>
                                <th></th>
                                <th></th>
                                <th colspan =4><b>Solid(MTS)</b></th>
                                <th colspan =5><b>Liquid(LTR)</b></th>
                            </tr>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th>Product</th>

                                <th>Opening</th>

                                <th>Purchase </th>

                                <th>Sale</th>

                                <th>Closing</th>

                                <th>Opening</th>

                                <th>Purchase</th>
                                    
                               <th>Sale</th>

                                <th>Closing</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($product){ 

                                    $i = 1;
                                   $Openingmts=0.0;
                                   $Purchasemts=0.0;
                                   $Salemts=0.0;
                                   $Closinggmts=0.0;
                                   $Openingltr=0.0;
                                   $Purchaseltr=0.0;
                                   $Saleltr=0.0;
                                   $Closinggltr=0.0;

                                        foreach($product as $prodtls){
                            ?>

                                <tr class="rep">
                                     <td class="report"><?php echo $i++; ?></td>
                                
                                     <td class="report"><?php echo $prodtls->prod_desc; ?></td>


                                   <?php  if($prodtls->unit == 'MTS'){ ?>
                                     <td class="report"><?php echo $prodtls->opening; $Openingmts+=$prodtls->opening; ?></td>
                                     <td class="report"><?php echo $prodtls->purchase; $Purchasemts+=$prodtls->purchase; ?></td>
                                     <td class="report"><?php echo $prodtls->sale; $Salemts+=$prodtls->sale; ?></td>
                                     <td class="report"><?php echo $prodtls->closing; $Closinggmts+=$prodtls->closing;?></td>
                                   <?php }else{ ?>
                                        <td class="report"></td>
                                     <td class="report"></td>
                                     <td class="report"></td>
                                     <td class="report"></td>
                                     <?php }


                                     if($prodtls->unit == 'LTR'){ ?>
                                        <td class="report"><?php echo $prodtls->opening; $Openingltr+=$prodtls->opening; ?></td>
                                     <td class="report"><?php echo $prodtls->purchase; $Purchaseltr+=$prodtls->purchase; ?></td>
                                     <td class="report"><?php echo $prodtls->sale; $Saleltr+=$prodtls->sale; ?></td>
                                     <td class="report"><?php echo $prodtls->closing; $Closinggltr+=$prodtls->closing;?></td>
                                    <?php }else{ ?>
                                        <td class="report"></td>
                                     <td class="report"></td>
                                     <td class="report"></td>
                                     <td class="report"></td>
                                   <?php } ?>


                                    
                                    
                                    
                          
                                </tr>
 
                                <?php }} ?>
                                    <tr style="background-color: #a3a3a3;">
                                     <td class="report"><b>Total</b></td>
                                     <td class="report"><b></b></td>
                                     <td class="report"><b><?=$Openingmts?></b></td>
                                     <td class="report"><b><?=$Purchasemts?></b></td>
                                     <td class="report"><b><?=$Salemts?></b></td>
                                     <td class="report"><b><?=$Closinggmts?></b></td>
                                     <td class="report"><b><?=$Openingltr?></b></td>
                                     <td class="report"><b><?=$Purchaseltr?></b></td>
                                     <td class="report"><b><?=$Saleltr?></b></td>
                                     <td class="report"><b><?=$Closinggltr?></b></td>
                                    </tr>
                        </tbody>
                        <tfooter>
                            <tr>
                               <!-- <td class="report" colspan="1" style="text-align:right">Total</td> 
                               <td class="report"></td>
                               <td class="report"><b><?=$tot_op?></td>
                               <td class="report"><b><?=$total_pur?></b></td>
                               <td class="report"><b><?=$total_sale?></b></td>
                               <td class="report"><b><?=$sldtotal?></b></td>
                               <td class="report"><b><?=$lqdtot_op?></b></td>
                               <td class="report"><b><?=$lqdtotal_pur?></b></td>
                               <td class="report"><b><?=$lqdtotal_sale?></b></td>
                               <td class="report"><b><?=$lqdtotal?></b></td> -->
                              
 
                            </tr>
                        </tfooter>
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
    title: 'Monthly Stock',
    text: 'Export to excel'

   }
]
   });
</script>


<script>
              $('#overlay').fadeIn().delay(2500).fadeOut();

            //   var ready = false;
            //     $(document).ready(function () {
            //         ready = true;
            //     });
            //     if(ready){
            //         $('#overlay').fadeOut();
            //     }else{
            //         $('#overlay').fadeIn();
            //     }
              
        </script>