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

    .form-wraper {
        margin-bottom: 20px !important;
    }
</style>


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


<div id="overlay" style="display:none;">
    <div class="spinner"></div>
</div>





<div class="wraper">
    <?php //print_r($this->session->userdata('loggedin')); 
    ?>
    <div class="col-md-12 container form-wraper">

        <form method="POST" id="form" action="<?php echo site_url("fert/rep/cust_payblepaid"); ?>">

            <div class="form-header">

                <h4>Date Range</h4>

            </div>

            <div class="form-group row">

                <label for="from_dt" class="col-sm-2 col-form-label from_dt">From Date:</label>

                <div class="col-sm-6">

                    <input type="date" name="from_date" class="form-control required" min='<?php echo explode('-', $this->session->userdata('loggedin')['fin_yr'])[0] . '-04-01' ?>' max='<?php echo ((explode('-', $this->session->userdata('loggedin')['fin_yr'])[0]) + 1) . '-03-31' ?>' value="<?= explode('-', $this->session->userdata('loggedin')['fin_yr'])[0] . '-04-01'; //$frm_dt;
                                                                                                                                                                                                                                                                                            ?>" readonly />

                </div>

            </div>

            <div class="form-group row">

                <label for="to_date" class="col-sm-2 col-form-label">To Date:</label>

                <div class="col-sm-6">

                    <input type="date" name="to_date" class="form-control required to_date" min='<?php echo explode('-', $this->session->userdata('loggedin')['fin_yr'])[0] . '-04-01' ?>' max='<?php echo ((explode('-', $this->session->userdata('loggedin')['fin_yr'])[0]) + 1) . '-03-31' ?>' value="<?= $to_dt; ?>" />

                </div>

            </div>


            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />

                </div>

            </div>

        </form>

    </div>

    <!-- </div> -->
    <?php if (isset($_POST["submit"])) { ?>
        <?php //echo '<pre>'; print_r($all_data); echo '</pre>';
        ?>
        <!-- <div class="wraper">  -->

        <div class="col-lg-12 contant-wraper">

            <div id="divToPrint">

                <div style="text-align:center;">

                    <h2>THE WEST BENGAL STATE CO.OP.MARKETING FEDERATION LTD.</h2>
                    <h4>HEAD OFFICE: SOUTHEND CONCLAVE, 3RD FLOOR, 1582 RAJDANGA MAIN ROAD, KOLKATA-700107.</h4>
                    <h4>Due Register Between: <?php echo $_SESSION['date']; ?></h4>
                    <h5 style="text-align:left"><label>District: </label> <?php echo $br_name->district_name; ?></h5>

                </div>
                <br>

                <table style="width: 100%;" id="example">

                    <thead>
                        <tr>

                            <th>Sl No.</th>
                            <th>Society</th>
                            <th>Opening</th>
                            <th></th>
                            <th>Advance Deposited</th>
                            <th>Sale Amount</th>
                            <th>Advance Adjustment</th>
                            <th>Credit Note</th>
                            <th>Credit Note Adjustment</th>
                            <th>Other Adjustment</th>
                            <th>Due Amount</th>
                            <th></th>
                            <th>Advance Adjustment Due</th>
                            <th>Credit Note Adjustment Due</th>
                        </tr>
                        <!-- <tr>
                                <th>Sl No.</th>
                                <th>Society</th>
                                <th>Opening</th>
								<th>Sale Amount</th>
                                <th>Received Amount( Including <br>Advance 
								& Credit Note Adjustment )</th>
                                <th>Advance Deposit</th>
                                <th>Credit Note</th>
                                <th>Due Amount</th>
                            </tr> -->

                    </thead>

                    <tbody>

                        <?php

                        if ($all_data) {

                            $i = 1;
                          $total_opn_amt=0.0;
                          $total_adv_amt=0.0;
                          $total_sale_amt=0.0;
                          $total_adv_adj=0.0;
                          $total_cr_amt=0.0;
                          $total_cr_adj=0.0;
                          $total_oth_adj=0.0;
                          $total_cls_amt=0.0;
                          $total_adv_due=0.0;
                          $total_cr_due=0.0;

                            // print_r($all_data);
                            foreach ($all_data as $prodtls) {
                        ?>

                                <tr class="rep">
                                    <td class="report"><?php echo $i++; ?></td>
                                    <td class="report"><?php echo $prodtls->soc_name; ?>

                                    <td class="report opening" id="opening">
                                        <?php echo abs($prodtls->opn_amt); $total_opn_amt+=$prodtls->opn_amt?></span>
                                    </td>
                                    <td class="report opening" id="">
                                        <?php if($prodtls->opn_amt<0){echo "Cr.";}else{echo "Dr.";} ?>
                                    </td>
                                    <td class="report purchase" id="purchase">
                                        <?php echo $prodtls->adv_amt;$total_adv_amt+=$prodtls->adv_amt; ?>
                                    </td>
                                    <td class="report sale" id="sale">
                                        <?php echo $prodtls->sale_amt; $total_sale_amt+=$prodtls->sale_amt;?>

                                    </td>
                                    <td class="report advance" id="advance">
                                        <?php echo $prodtls->adv_adj; $total_adv_adj += $prodtls->adv_adj; ?>

                                    </td>
                                    <td class="report cramt" id="cramt">
                                        <?php echo $prodtls->cr_amt; $total_cr_amt+=$prodtls->cr_amt;?>

                                    </td>
                                    <td class="report closing" id="closing">
                                        <?php echo $prodtls->cr_adj; $total_cr_adj+=$prodtls->cr_adj; ?>
                                    </td>
                                    <td><?php echo $prodtls->oth_adj; $total_oth_adj+=$prodtls->oth_adj;?></td>
                                    <td><?php echo abs($prodtls->cls_amt); $total_cls_amt+=$prodtls->cls_amt; ?></td>
                                    <td><?php if($prodtls->cls_amt<0){echo "Cr.";}else{echo "Dr.";} ?></td>
                                    <td><?php echo $prodtls->adv_due;$total_adv_due+=$prodtls->adv_due ?></td>
                                    <td><?php echo $prodtls->cr_due; $total_cr_due+=$prodtls->cr_due; ?></td>

                                </tr>

                            <?php



                            }
                            ?>


                        <?php
                        } else {

                            echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";
                        }

                        ?>

                    </tbody>
                    <tfooter>
                        <tr>
                            <td class="report" colspan="2" style="text-align:right"><b>Total</b></td>

                            <td  class="report"><b><?php echo abs($total_opn_amt); ?></span></b></td>
                            <td  class="report"> <b><?php if($total_opn_amt<0){echo "Cr.";}else{echo "Dr.";}?></b></td>
                            <td  class="report"><b><?php echo $total_adv_amt;?></b></td>
                            <td  class="report"><b><?php echo $total_sale_amt;?></b></td>
                            <td  class="report"><b><?php echo $total_adv_adj;?></b></td>
                            <td  class="report"><b><?php echo $total_cr_amt;?></b></td>
                            <td  class="report"><b><?php echo $total_cr_adj;?></b></td>
                            <td  class="report"><b><?php echo $total_oth_adj;?></b></td>
                            <td  class="report"><b><?php echo abs($total_cls_amt);?></span></b></td>
                            <td  class="report"><b><?php if($total_cls_amt<0){echo "Cr.";}else{echo "Dr.";} ?></b></td>
                            <td  class="report"><b><?php echo $total_adv_due;?></b></td>
                            <td  class="report"><b><?php echo $total_cr_due;?></b></td>
                            

                        </tr>
                    </tfooter>
                </table>

            </div>

            <div style="text-align: center;">

                <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
                <!-- <button class="btn btn-primary" type="button" id="btnExport" >Excel</button>-->

            </div>

        </div>

        <script>
              $('#overlay').fadeIn().delay(2500).fadeOut();
              </script>
    <?php } ?>

</div>

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

<script>
    $("#submit").click(function() {
        // $('#overlay').fadeIn().delay(55000).fadeOut();
        if($('.to_date').val()==''||$('.from_dt').val()==""){
           
                $('#overlay').fadeOut();
        }else{
            $('#overlay').fadeIn();
        }
    })
</script>