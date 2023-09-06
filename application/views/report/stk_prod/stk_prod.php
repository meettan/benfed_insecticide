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




    

        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div style="text-align:center;">

                        <h2>THE WEST BENGAL STATE CO.OP.MARKETING FEDERATION LTD.</h2>
                        <h4>HEAD OFFICE: SOUTHEND CONCLAVE, 3RD FLOOR, 1582 RAJDANGA MAIN ROAD, KOLKATA-700107.</h4>
                        <h4>Stock Statement Between: <?php echo $_SESSION['date']; ?></h4>
                        <h5>
                        </div>
                        <span ><label>District: </label> <?php echo $branch->district_name; ?></span>
                        </h5>
                        <h5>
                        <span ><label>Product: </label> <?php  if($product){ foreach($product as $prodtls);echo $prodtls->prod_desc;}?></span>
                    
                    </h5>
                    <h5>
                    <span ><label>Company: </label> <?php  if($product){ foreach($product as $prodtls);echo $prodtls->short_name;}?></span>
                    </h5>
                        <h5>
                    <span >
                        <label>Unit: </label> <?php  if($product){ foreach($product as $prodtls);echo $prodtls->unit_name;}?></span>
                    
                    </h5>
                        
                    
                  

                    <table style="width: 100%;" id="example">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>


                                <th>Ro No.</th>

                                <th>Opening</th>

                                <th>Purchase</th>
                                <th>Sale</th>
                                <th>Closing</th>
                            </tr>

                        </thead>
<?php if(!empty($productwise_stock)){ ?>
                        <tbody>

                            <?php 
                                $i=0;
                                $purchase=0.0;
                                $sale=0.0;
                                 foreach ($productwise_stock as $key) {  $i++?>
                            <tr>
                                <td class="report"><?php echo $i; ?></td>
                                

                                <td class="report"><?php echo $key->ro_no; ?></td>
                                <td class="report"><?php if($key->ro_no=="0"){echo "<b>".$key->opening."</b>";}else{echo $key->opening;} ?></td>
                                <td class="report"><?php echo $key->purchase;  $purchase+=$key->purchase;?></td>
                                <td class="report"><?php echo $key->sale; $sale+=$key->sale;?></td>
                                <td class="report"><?php if($key->ro_no=="0"){echo "<b>".$key->closing."</b>";}else{echo $key->closing;} ?></td>

                              
                                    
                            </tr>
                               <?php  } ?>

                        </tbody>
                        <tfooter>
                            <tr>
                           <td class="report" colspan="2" style="text-align:right"><b>Total</b></td>
                               <td class="report"></td>
                               <td class="report"><b><?=  round($purchase,3);?></b></td>
                               <td class="report"><b><?=  round($sale,3);?></b></td>
                               <td class="report"></td>
                           
                            </tr>
                        </tfooter>
                        <?php }else{ echo "<tr><td colspan='12' style='text-align:center;'>No Data Found</td></tr>"; }  ?>
                    </table>

                </div>   
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
                   <!-- <button class="btn btn-primary" type="button" id="btnExport" >Excel</button>-->

                </div>

            </div>
            
        </div>



        <div id="overlay" style="display:none;">
    <div class="spinner"></div>
</div>
        <script>
         $('#overlay').fadeIn().delay(2000).fadeOut();
</script>