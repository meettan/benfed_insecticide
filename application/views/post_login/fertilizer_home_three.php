<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/slick/slick.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/slick/slick-theme.css">

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

<!-- User Types : Admin ->A User->U Manager->M -->
<!-- Side Menus -->

<!-- //Admin & Manager loging in Branch Office -->

<?php if ($this->session->userdata['loggedin']['ho_flag']  == 'N' && ($this->session->userdata['loggedin']['user_type'] == 'M' || $this->session->userdata['loggedin']['user_type'] == 'C' || $this->session->userdata['loggedin']['user_type'] == 'A')) {  ?>
  <div class="container-fluid" style="padding-top:25px;">
    <div class="daseboard_home_new">
      <div class="col-sm-3 float-left">
        <div class="left_bar_new">
          <h2>Quick Links <i class="fa fa-link" aria-hidden="true"></i></h2>
          <ul>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/adv/advancefilter">Advance</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/adv/advancefwd">Advance Forward</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/stock/stock_entry">Purchase</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/trade/sale">Sale</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/drcrnote/dr_note">Credit Note</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/socpay/society_payment">Receive Payment</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/socpay/soc_payment_fwd">Forward Payment</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/stkStmt">Consolidated Stock</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/stkSprod">Productwise Stock</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/purrep">Purchase Ledger</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/salerep">Sale Ledger</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/cust_payblepaid">Due Register</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/soc_ledger">Society Ledger</a></li>
            <li><a href="https://benfed.in/benfed_fertilizer/index.php/fert/rep/overdue_list">Overdue List</a></li>
            <li><a href="<?=base_url()?>index.php/fert/sppay/bpaymentlist">Payment List</a></li>
          </ul>
        </div>
      </div>
      <div class="col-sm-9 float-left rightSideSec">
        <div class="row">
          <div class="threeBoxNewmain">
            <div class="col-sm-4 float-left">
              <div class="threeBoxNewSmall">
                <div class="threeBoxImg redCol"><img src="<?= base_url() ?>assets/images/boxIcon_d.png" alt=""></div>
                <div class="threeBoxTxt">
                  <h2>Opening</h2>
                  <p class="price"><span class="mt"><?= $openingS ?><strong> MT</strong></span>
                    <span class="lit"><strong> </strong><?= $openingL ?><strong> LTR</strong></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 float-left">
              <div class="threeBoxNewSmall">
                <div class="threeBoxImg darkBlue"><img src="<?= base_url() ?>assets/images/boxIcon_a.png" alt=""></div>
                <div class="threeBoxTxt">
                  <h2>Purchase For The Day</h2>
                  <p class="price"><span class="mt"><?= round($totsolidpur, 3); ?><strong> mt</strong></span>
                    <span class="lit"><strong> </strong><?= round($totliquidpur, 3); ?><strong> LTR</strong></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 float-left">
              <div class="threeBoxNewSmall">
                <div class="threeBoxImg yellowCol"><img src="<?= base_url() ?>assets/images/boxIcon_b.png" alt=""></div>
                <div class="threeBoxTxt">
                  <h2>Sale For The Day</h2>
                  <p class="price"><span class="mt"><?= round($brsalesolidtoday, 3); ?><strong> MT</strong></span>
                    <span class="lit"><strong> </strong><?= round($brsaleliquidtoday, 3); ?><strong>
                        LTR</strong></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="threeBoxNewmain">
            <div class="col-sm-4 float-left">
              <div class="threeBoxNewSmall">
                <div class="threeBoxImg lightBlue"><img src="<?= base_url() ?>assets/images/boxIcon_e.png" alt=""></div>
                <div class="threeBoxTxt">
                  <h2>Closing</h2>
                  <p class="price"><span class="mt"><?= $closingS ?><strong>
                        MT</strong></span>
                    <span class="lit"><strong>
                      </strong><?= $closingL ?><strong> LTR</strong></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-sm-4 float-left">
              <div class="threeBoxNewSmall">
                <div class="threeBoxImg yellowCol"><img src="<?= base_url() ?>assets/images/boxIcon_collec.png" alt="">
                </div>
                <div class="threeBoxTxt">
                  <h2>Today's Collection</h2>
                  <p class="price">
                    <span class="lit"><strong> </strong><i class="fa fa-inr" aria-hidden="true"></i><?= round($todaycollection->tot_recvamt, 3) ?></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 float-left">
              <div class="threeBoxNewSmall">
                <div class="threeBoxImg redCol"><img src="<?= base_url() ?>assets/images/boxIcon_inv.png" alt=""></div>
                <div class="threeBoxTxt">
                  <h2>No.of Invoices </h2>
                  <p class="price"><span class="mt"><?= $b2b->cnt ?><strong> B2B</strong></span>
                    <span class="lit"><strong> </strong><?= $b2c->cnt ?><strong> B2C</strong></span>
                  </p>
                </div>
              </div>
            </div>

          </div>

          <div class="sectionNew">
            <div class="stockPointSecTitle">
              <div class="col-sm-12">
                <h2>Societywise Status</h2>
                <div class="selectBox">
                  <select name="select_district" id="select_district" class="sch_cd">
                    <option value="select_district">Select Society</option>
                    <?php foreach ($soc as $socname) { ?>
                      <option value="<?= $socname->soc_id ?>"><?= $socname->soc_name ?></option>
                    <?php } ?>

                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="sectionNew" id="sectionNew"> -->
          <div class="sectionNew" id="">




            <div class="col-sm-6 float-left">
              <div class="bloxkSec">
                <img src="<?= base_url() ?>assets/images/icon_aa.png" alt="" class="bloxkSecImg">
                <h3>Quantity Sold during the year</h3>
                <p class="price">
                  <span class="mt"><span id="quantitySold">0.0</span><strong> mt</strong></span>
                  <!-- <span class="mt" id="qty"><strong>mt</strong></span></p> -->
                  <span class="lit"><span id="quantityltr">0.0</span><strong> LTR</strong></span>
              </div>
            </div>

            <div class="col-sm-6 float-left">
              <div class="bloxkSec">
                <img src="<?= base_url() ?>assets/images/icon_bb.png" alt="" class="bloxkSecImg">
                <h3>No.of Invoices</h3>
                <p class="price">
                  <span class="mt"><span id="quantityPurchaseMt">0.0</span><strong> B2B</strong></span>
                  <span class="lit"><span id="quantityPurchaseLtr">0.0<span> <strong>B2C</strong></span>
                </p>
              </div>
            </div>

            <div class="col-sm-6 float-left">
              <div class="bloxkSec bloxkSecMarginBotNone">
                <img src="<?= base_url() ?>assets/images/icon_cc.png" alt="" class="bloxkSecImg">
                <h3>Amount recevied during the Year</h3>
                <p class="price">
                  <span class="lit"><strong><i class="fa fa-inr" aria-hidden="true"></i></strong><span id="amountPaidfortheYear"></span></span>
                </p>
              </div>
            </div>

            <div class="col-sm-6 float-left">
              <div class="bloxkSec bloxkSecMarginBotNone">
                <img src="<?= base_url() ?>assets/images/icon_dd.png" alt="" class="bloxkSecImg">
                <h3>Blance Amount</h3>
                <p class="price">
                  <span class="lit"><strong><i class="fa fa-inr" aria-hidden="true"></i> </strong><span id="blanceAmount"></span></span>
                </p>
              </div>
            </div>

          </div>




          <!-- =========================================================================================== -->




          <div class="sectionNew">
            <!-- <div class="col-sm-12">
              <h2>District Wise Status</h2>
            </div> -->


            <div class="sectionNew">
              <div class="stockPointSecTitle">
                <div class="col-sm-12">
                  <h2>Company Wise Status</h2>
                  <div class="selectBox">
                    <select name="company_dtls" class="form-control district" id="company_dtls">
                      <option value="">Select Company</option>
                      <?php
                      foreach ($compdtls as $compdtls) {
                      ?>
                        <option value="<?php echo $compdtls->COMP_ID; ?>"><?php echo $compdtls->short_name; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>



                <div class="districWisSecRight districWisSecRight_FullWidth">

                  <div style="text-align:center;">

                    <h2 id="distNamec"></h2>

                  </div>

                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Day Purchase</h3>
                      <div class="valueSec">
                        <span class="mt"><span id="dpc">0.00</span> <strong>MT</strong></span>
                        <span class="lit"><span id="dplc">0.00</span> <strong>L</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Day Sale </h3>
                      <div class="valueSec">
                        <span class="mt"><span id="dsc">0.00</span> <strong>MT</strong></span>
                        <span class="lit"><span id="dslc">0.00</span> <strong>L</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Day Collection </h3>
                      <!-- <div class="valueSec"> -->
                      <!-- <span class="mt" id="recvdy">250 </span> -->
                      <!-- <span class="lit">250 <strong>L</strong></span> -->
                      <p class="price">
                        <span class="lit" id="recvdyc" STYLE="font-size:18.0pt ;"><strong><i class="fa fa-inr" aria-hidden="true"></i> </strong>
                        </span>
                      </p>
                      <!-- </div> -->
                    </div>
                  </div>

                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Monthly Purchase </h3>
                      <div class="valueSec">
                        <span class="mt" id=""><span id="dpmc">0.00</span> <strong>MT</strong></span>
                        <span class="lit" id=""><span id="dpmlqdc">0.00</span> <strong>L</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Monthly Sale </h3>
                      <div class="valueSec">
                        <span class="mt" id=""><span id="smc">0.00</span> <strong>MT</strong></span>
                        <span class="lit" id=""><span id="smlqdc">0.00</span><strong>L</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Monthly Collection </h3>
                      <!-- <div class="valueSec"> -->
                      <!-- <span class="mt" id="recvmnth">250 </span> -->
                      <!-- <span class="lit">250 <strong>L</strong></span> -->
                      <p class="price">
                        <span class="lit" id="recvmnthc" STYLE="font-size:18.0pt ;"><strong><i class="fa fa-inr" aria-hidden="true"></i> </strong>
                        </span>
                      </p>
                      <!-- </div> -->
                    </div>
                  </div>

                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Yearly Purchase </h3>
                      <div class="valueSec">
                        <span class="mt" id=""><span id="pyrc">0.00</span> <strong>MT</strong></span>
                        <span class="lit" id=""><span id="pyrlqc">0.00</span> <strong>L</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Yearly Sale </h3>
                      <div class="valueSec">
                        <span class="mt" id=""><span id="syrc">0.00</span> <strong>MT</strong></span>
                        <span class="lit" id=""><span id="syrlqc">0.00</span> <strong>L</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Yearly Collection </h3>
                      <p class="price">
                        <span class="lit" id="recvyrc" STYLE="font-size:18.0pt ;"><strong><i class="fa fa-inr" aria-hidden="true"></i> </strong>
                        </span>
                      </p>
                      <!-- <div class="valueSec"> -->
                      <!-- <span class="mt" id="recvyr">250 </span> -->
                      <!-- <span class="lit">250 <strong>L</strong></span> -->
                      <!-- </div> -->
                    </div>
                  </div>
                </div>

          </div>




          <!-- ========================================================================================= -->









          <!-- ===================================================================================== -->

          <!-- <div class="sectionNew" id="sectionNew2"> 
            <div class="col-sm-12">
              <h2 class="onClickOpen">Overdue List <span>(Click to Expand)</span> <i class="fa fa-arrow-circle-down" aria-hidden="true"></i></h2>
            </div>

            <div class="col-sm-12 accordianConten accoNotShow">
              <div class="companyWisSec">
                <div class="table-responsive">
                  <table class="table table-striped tableCompany">
                    <thead>
                      <tr>
                        <th scope="col">#SL No.</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Payment Done</th>
                        <th scope="col">Payment Pending</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> -->



          <!-- 
          <div class="barPaiChartMain">
            <div class="col-sm-12 float-left">
              <div class="barChart">
                <h2>Last 5 Years Sale</h2>
                <canvas id="barChartBottombranch"></canvas>
              </div>
            </div>
          </div> -->





        </div>
      </div>

    </div>
  </div>

<?php } ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script> -->

<script>
  $('#sectionNew').hide();
  $('#sectionNew2').hide();
  $('.barPaiChartMain').hide();
  $('#select_district').change(function() {
    var soc_id = $(this).val();
    // $('#overlay').fadeIn().delay(2200).fadeOut();
    $('#overlay').fadeIn();

    $.ajax({
      url: "<?= site_url('Fertilizer_Login/societyWiseStatus') ?>",
      type: "POST",
      dataType: "json",
      data: {
        soc_id: soc_id
      },
      success: function(result) {

        $('#quantitySold').html(result.quantitySold);
        $('#quantityltr').html(result.quantityltr);
        $('#quantityPurchaseMt').html(result.quantityPurchaseMt);
        $('#quantityPurchaseLtr').html(result.quantityPurchaseLtr);
        $('#amountPaidfortheYear').html(result.amountPaidfortheYear);
        $('#blanceAmount').html(result.blanceAmount);

        $('#overlay').fadeOut();

        // $('#sectionNew').show();
        // $('#sectionNew2').show();
        // $('.barPaiChartMain').show();
      }
    });
  });


// ==================================================



$("#company_dtls").click(function(){

  var br_id = '<?= $this->session->userdata['loggedin']['branch_id'] ?>';
    //   alert(br_id);

   

    var comp_id = $('#company_dtls').val();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url("Fertilizer_Login/f_br_purchasec") ?>",
      data: {
        br_id: br_id,
        comp_id: comp_id,
      },

      success: function(data) {
        // alert(JSON.parse(data).tot_pur);
        console.log(data);
        var data = JSON.parse(data);

        $('#dpc').html(data.tot_pur);
        $('#dplc').html(data.tot_purlqd);
        $('#dsc').html(data.tot_sale);
        $('#dslc').html(data.tot_salelqd);
        $('#dpmc').html(data.tot_mth_pur);
        $('#dpmlqdc').html(data.tot_mth_purlqd);
        $('#smc').html(data.tot_mth_sal);
        $('#smlqdc').html(data.tot_mth_salq);
        $('#pyrc').html(data.tot_puryr);
        $('#pyrlqc').html(data.tot_puryrlq);
        $('#syrlqc').html(data.tot_salyrlq);
        $('#syrc').html(data.tot_salyr);
        $('#recvdyc').html(data.tot_recvday);
        $('#recvmnthc').html(data.tot_recvmnth);
        $('#recvyrc').html(data.tot_recvyr);
      }
      // error: function() { alert("Error posting feed."); }
    });
  })
</script>



</script>


<script>
  var openBtn = document.querySelector('.onClickOpen');
  var accordianConten = document.querySelector('.accordianConten');
  // var accoNotShow = document.querySelector('.accoNotShow');
  // var accoShow = document.querySelector('.accoShow');

  openBtn.onclick = function() {

    if (accordianConten.style.transform === "scaleY(0)") {
      accordianConten.style.transform = "scaleY(1)";
      document.querySelector('.onClickOpen').style.margin = "0 0 18px 0";
      accordianConten.style.height = "auto";
    } else {
      accordianConten.style.transform = "scaleY(0)";

      setTimeout(close, 600);

      function close() {
        accordianConten.style.height = "0px";
        document.querySelector('.onClickOpen').style.margin = "0";
      }
    }

  }



  function brdaypurchase(br_id) {
    //   alert(br_id);
    $.ajax({
      type: "POST",
      url: "<?php echo site_url("Fertilizer_Login/f_br_purchase") ?>",
      data: {
        br_id: br_id
      },

      success: function(data) {
        // alert(JSON.parse(data).tot_pur);
        console.log(data);
        var data = JSON.parse(data);

        $('#dp').html(data.tot_pur);
        $('#dpl').html(data.tot_purlqd);
        $('#ds').html(data.tot_sale);
        $('#dsl').html(data.tot_salelqd);
        $('#dpm').html(data.tot_mth_pur);
        $('#dpmlqd').html(data.tot_mth_purlqd);
        $('#sm').html(data.tot_mth_sal);
        $('#smlqd').html(data.tot_mth_salq);
        $('#pyr').html(data.tot_puryr);
        $('#pyrlq').html(data.tot_puryrlq);
        $('#syrlq').html(data.tot_salyrlq);
        $('#syr').html(data.tot_salyr);
        $('#recvdy').html(data.tot_recvday);
        $('#recvmnth').html(data.tot_recvmnth);
        $('#recvyr').html(data.tot_recvyr);
      }
      // error: function() { alert("Error posting feed."); }
    });
  }
</script>

<script>
  $(document).ready(function() {

    var i = 0;

    $('#district').change(function() {

      $.get(

        '<?php echo site_url("Fertilizer_Login/f_get_stkpnt"); ?>',

        {

          district: $(this).val()

        }

      ).done(function(data) {

        var string = '';
        var tot_sld = 0.00;
        var tot_lqd = 0.00;
        $.each(JSON.parse(data), function(index, value) {

          string += '<tr><td scope="row" name="soc">' + value.soc_name + '</td><td name="soc">' + value.qty_sld + '<strong>mt</strong></td><td name="soc">' + value.qty_lqd + ' <strong>L</strong></td></tr>';
          tot_sld += parseFloat(value.qty_sld);
          tot_lqd += parseFloat(value.qty_lqd);
        });
        tot_sld = parseFloat(tot_sld).toFixed(3)
        tot_lqd = parseFloat(tot_lqd).toFixed(3)
        $('#soc').html(string);
        $('#f_totsld').html(tot_sld);
        $('#f_totlqd').html(tot_lqd);

      });


    });

  });
</script>
<script>
  <?php
  $label = '';
  $qty   = '';
  foreach ($distwisesale as $key) {
    $label .=  '"' . $key->district_name . '",';
    $qty   .=   ($key->qty) . ',';
  }

  ?>
  window.onload = function() {

    var data = {
      labels: [<?php echo rtrim($label, ","); ?>],
      datasets: [{
        label: '# of Votes',
        data: [<?php echo rtrim($qty, ","); ?>],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(245, 86, 82, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(245, 86, 82, 1)',
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    }

    // var barChartId = document.getElementById("barChart");
    // if (barChartId) {
    //   var ctxB = document.getElementById("barChart").getContext('2d');
    //   var myBarChart = new Chart(ctxB, {
    //     type: 'bar',
    //     data: data,
    //     options: {
    //       "hover": {
    //         "animationDuration": 0
    //       },
    //       "animation": {
    //         "duration": 1,
    //         "onComplete": function() {
    //           var chartInstance = this.chart,
    //             ctx = chartInstance.ctx;
    //           ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
    //           ctx.textAlign = 'center';
    //           ctx.textBaseline = 'bottom';

    //           this.data.datasets.forEach(function(dataset, i) {
    //             var meta = chartInstance.controller.getDatasetMeta(i);
    //             meta.data.forEach(function(bar, index) {
    //               var data = dataset.data[index];
    //               ctx.fillText(data, bar._model.x, bar._model.y - 5);
    //             });
    //           });
    //         }
    //       },
    //       legend: {
    //         "display": false
    //       },
    //       tooltips: {
    //         "enabled": false
    //       },
    //       scales: {
    //         yAxes: [{
    //           scaleLabel: {
    //             display: true,
    //             labelString: 'Unit in MT'
    //           }
    //           // ,
    //           // ticks: {
    //           // min: 0, // minimum value
    //           // max: 1600, // maximum value
    //           // stepSize: 200
    //           // }
    //         }]
    //       }
    //     }


    //   });
    // }

    <?php
    $label = '';
    $qty   = '';
    foreach ($distwisesaleltr as $key) {
      $label .=  '"' . $key->district_name . '",';
      $qty   .=   ($key->qty) . ',';
    }

    ?>
    var data = {
      labels: [<?php echo rtrim($label, ","); ?>],
      datasets: [{
        label: '# of Votes',
        data: [<?php echo rtrim($qty, ","); ?>],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(245, 86, 82, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(245, 86, 82, 1)',
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    }

    // var barChartId = document.getElementById("barChartl");
    // if (barChartId) {
    //   var ctxB = document.getElementById("barChartl").getContext('2d');
    //   var myBarChart = new Chart(ctxB, {
    //     type: 'bar',
    //     data: data,
    //     options: {
    //       "hover": {
    //         "animationDuration": 0
    //       },
    //       "animation": {
    //         "duration": 1,
    //         "onComplete": function() {
    //           var chartInstance = this.chart,
    //             ctx = chartInstance.ctx;
    //           ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
    //           ctx.textAlign = 'center';
    //           ctx.textBaseline = 'bottom';

    //           this.data.datasets.forEach(function(dataset, i) {
    //             var meta = chartInstance.controller.getDatasetMeta(i);
    //             meta.data.forEach(function(bar, index) {
    //               var data = dataset.data[index];
    //               ctx.fillText(data, bar._model.x, bar._model.y - 5);
    //             });
    //           });
    //         }
    //       },
    //       legend: {
    //         "display": false
    //       },
    //       tooltips: {
    //         "enabled": false
    //       },
    //       scales: {
    //         yAxes: [{
    //           scaleLabel: {
    //             display: true,
    //             labelString: 'Unit in LTR'
    //           }
    //           // ,
    //           // ticks: {
    //           // min: 0, // minimum value
    //           // max: 1600, // maximum value
    //           // stepSize: 200
    //           // }
    //         }]
    //       }
    //     }

    //   });
    // }

  }
  <?php
  $label = '';
  $qty   = '';
  foreach ($distamt as $key) {
    $label .=  '"' . $key->district_name . '",';
    $qty   .=   ($key->paid_amt) . ',';
  }

  ?>
  var data = {
    labels: [<?php echo rtrim($label, ","); ?>],
    datasets: [{
      label: '# of Votes',
      data: [<?php echo rtrim($qty, ","); ?>],
      backgroundColor: [
        'rgba(255, 99, 132, 0.8)',
        'rgba(54, 162, 235, 0.8)',
        'rgba(255, 206, 86, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(255, 159, 64, 0.8)',
        'rgba(245, 86, 82, 0.8)',
        'rgba(255, 99, 132, 0.8)',
        'rgba(54, 162, 235, 0.8)',
        'rgba(255, 206, 86, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(153, 102, 255, 0.8)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(245, 86, 82, 1)',
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  }

  // var barChartBottomId = document.getElementById("barChartBottom");
  // if (barChartBottomId) {
  //   var ctxC = document.getElementById("barChartBottom").getContext('2d');

  //   var myBarChartBot = new Chart(ctxC, {
  //     type: 'bar',
  //     data: data,
  //     options: {
  //       "hover": {
  //         "animationDuration": 0
  //       },
  //       "animation": {
  //         "duration": 1,
  //         "onComplete": function() {
  //           var chartInstance = this.chart,
  //             ctx = chartInstance.ctx;
  //           ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
  //           ctx.textAlign = 'center';
  //           ctx.textBaseline = 'bottom';

  //           this.data.datasets.forEach(function(dataset, i) {
  //             var meta = chartInstance.controller.getDatasetMeta(i);
  //             meta.data.forEach(function(bar, index) {
  //               var data = dataset.data[index];
  //               ctx.fillText(data, bar._model.x, bar._model.y - 5);
  //             });
  //           });
  //         }
  //       },
  //       legend: {
  //         "display": false
  //       },
  //       tooltips: {
  //         "enabled": false
  //       },
  //       scales: {
  //         yAxes: [{
  //           scaleLabel: {
  //             display: true,
  //             labelString: 'Amount in crores'
  //           }
  //         }]
  //       }
  //     }

  //   });
  // }
  $('#toggleDiv').hide();

  function expandDiv() {
    if ($('#toggleDiv').is(':visible')) {
      $('#toggleDiv').slideUp("slow");
    } else {
      $('#toggleDiv').slideDown("slow");
    }
  }
</script>
<script src="<?php //echo base_url("/assets/js/custom.js")
              ?>"></script>
<?php /*?><script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/slick/slick.js" type="text/javascript" charset="utf-8"></script><?php */ ?>

<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/slick/slick.js" type="text/javascript" charset="utf-8"></script>

<script>
  $(".sliderBotSlickSlider").slick({
    dots: false,
    vertical: false,
    centerMode: false,
    autoplay: true,
    slidesToShow: 1,
    speed: 500,
    arrows: true,
    slidesToScroll: 1
  });
</script>