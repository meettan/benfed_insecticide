<div id="divToPrint">

    <div style="text-align:center;">

        <h2>THE WEST BENGAL STATE CO.OP.MARKETING FEDERATION LTD.</h2>
        <h4>HEAD OFFICE: SOUTHEND CONCLAVE, 3RD FLOOR, 1582 RAJDANGA MAIN ROAD, KOLKATA-700107.</h4>
        <h4>Sale Report Between: <span id="f_date"></span> To <span id="t_date"></span></h4>
                        <h5 style="text-align:left"></h5>
        <!--                         
                         <h4 style="text-align:left"><label>Company: </label></h4>  -->

    </div>
    <br>
    <button class="btn" onclick="exportTableToExcel('examplee','members-data')">Export to excel</button><br><br>
    <table style="width: 100%;" id="examplee">

        <thead>

            <tr>

                <th>Sl No.</th>
                <th class="report">Company</th>
                <th class="report">Product</th>
                <th class="report">Unit</th>
                <th class="report">DAR</th>
                <th class="report">JPG</th>
                <th class="report">COOCH</th>
                <th class="report">NDNJ</th>
                <th class="report">SDNJ</th>
                <th class="report">MLD</th>
                <th class="report">MUR</th>
                <th class="report">BRH</th>
                <th class="report">EBDN</th>
                <th class="report">NDA</th>
                <th class="report">N24</th>
                <th class="report">HOG</th>
                <th class="report">BNK</th>
                <th class="report">PUR</th>
                <th class="report">HWH</th>
                <th class="report">KOL</th>
                <th class="report">S24</th>
                <th class="report">WMDN</th>
                <th class="report">EMDN</th>
                <th class="report">ALPD</th>


            </tr>

        </thead>

        <tbody>



            <?php $i = 0;
            foreach ($data as $key) {
                $i++;  ?>
                <tr class="rep">
                    <td class="report"><?php echo $i; ?></td>
                    <td class="report"><?= $key->comp_name ?></td>
                    <td class="report"><?= $key->prod_desc ?></td>
                    <td class="report"><?= $key->unit_desc ?></td>
                    <td class="report"><?= $key->dar ?></td>
                    <td class="report"><?= $key->jpg ?></td>
                    <td class="report"><?= $key->cooch ?></td>
                    <td class="report"><?= $key->NDNJ ?></td>
                    <td class="report"><?= $key->SDNJ ?></td>
                    <td class="report"><?= $key->MLD ?></td>
                    <td class="report"><?= $key->MUR ?></td>
                    <td class="report"><?= $key->BRH ?></td>
                    <td class="report"><?= $key->EBDN ?></td>
                    <td class="report"><?= $key->NDA ?></td>
                    <td class="report"><?= $key->N24 ?></td>
                    <td class="report"><?= $key->HOG ?></td>
                    <td class="report"><?= $key->BNK ?></td>
                    <td class="report"><?= $key->PUR ?></td>
                    <td class="report"><?= $key->HWH ?></td>
                    <td class="report"><?= $key->KOL ?></td>
                    <td class="report"><?= $key->S24 ?></td>
                    <td class="report"><?= $key->WMDN ?></td>
                    <td class="report"><?= $key->EMDN ?></td>
                    <td class="report"><?= $key->ALPD ?></td>



                </tr>
            <?php } ?>


        </tbody>
        <tfooter>
            <tr>
                <!-- <td class="report" colspan="10" style="text-align:Left"><b>Total</b></td>
                               <td class="report"><b><?= $tot_amt ?></b></td> -->
                <!-- <td class="report"><?= $cgst ?></td>
                               <td class="report"><?= $sgst ?></td> 
                               
                                <td class="report"><?= $total ?></td>   -->

            </tr>
        </tfooter>

    </table>

</div>

<div style="text-align: center;">

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
    <!-- <button class="btn btn-primary" type="button" id="btnExport" >Excel</button>-->

</div>


<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>



<script>
    function exportTableToExcel(tableID, filename = '') {
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename ? filename + '.xls' : 'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }
</script>

<script>
    $('#examplee').dataTable({
        destroy: true,
        searching: false,
        ordering: false,
        paging: false,

        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            title: 'Stock_report',
            text: 'Export to excel'
            //Columns to export
            // exportOptions: {
            //    columns: [0, 1, 2, 3]
            // }
        }]
    });
</script>
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
</script>