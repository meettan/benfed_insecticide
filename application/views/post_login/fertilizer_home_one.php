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

  .valueSec {
    font-size: 15px !important;
  }

  .valueSec span strong {
    font-size: 15px !important;
  }

  .lit {
    font-size: 15px !important;
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

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/slick/slick.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/slick/slick-theme.css">

<!-- User Types : Admin ->A User->U Manager->M -->
<!-- Side Menus -->

<!-- //Admin loging in Head Office -->

<?php if ($this->session->userdata['loggedin']['ho_flag'] == "Y" && $this->session->userdata['loggedin']['user_type'] == "A") { ?>
  <div class="container-fluid">
    <div class="daseboard_home_newAdmin">

      <div class="fullWidthBotomPading">
        <div class="col-sm-3 float-left">
          <div class="left_bar_new">
            <h2>Quick Links <i class="fa fa-link" aria-hidden="true"></i></h2>
            <?php if ($this->session->userdata['loggedin']['ho_flag'] == "N") { ?>
              <!-- //Admin loging in Branch Office -->
              <ul>

                <li><a href="<?php echo site_url('stock/stock_entry'); ?>">Purchase</a></li>
                <li><a href="<?php echo site_url('trade/sale'); ?>">Sale</a></li>
                <li><a href="<?php echo site_url('socpay/society_payment'); ?>">Customer Payment</a></li>
                <li> <a href="#">Stock Ledger</a></li>
                <li><a href="#">Day Book</a></li>
              </ul>
            <?php } else { ?>

              <ul>
                <li><a href="<?php echo site_url('category'); ?>">Add Category</a></li>
                <li><a href="<?php echo site_url('rateslab'); ?>">Sale Rate Entry</a></li>
                <li><a href="<?php echo site_url('material'); ?>">Add Product</a></li>
                <li><a href="<?php echo site_url('compay/company_payment'); ?>">Company Payment</a></li>
                <li><a href="<?php echo site_url('fert/rep/brwse_constk'); ?>">Stock Report</a></li>
           
                <!-- <li><a href="<?php echo site_url('report/chequestatus'); ?>">Cheque Status</a></li>
<li><a href="<?php echo site_url('report/returncheque'); ?>">Return Cheque</a></li> -->
              </ul>

            <?php } ?>
          </div>
        </div>

        <div class="col-sm-9 float-left rightSideSec">
          <div class="row">
            <div class="threeBoxNewmain">
              <div class="col-sm-4 float-left">
                <div class="threeBoxNewSmall">
                  <!-- <div class="value"><strong>&#2352;</strong>
              <?php
              /*if($this->session->userdata['loggedin']['ho_flag']=="Y"){
                      echo $ho_purchase_day->tot_purchase_ho; 
                  }else{
                      echo $purchase_day->tot_purchase; 
                  }*/
              ?>
</div> -->
                  <div class="threeBoxImg darkBlue"><img src="<?= base_url() ?>assets/images/boxIcon_a_new.png" alt=""></div>
                  <div class="threeBoxTxt">
                    <h2>Purchase For The Day</h2>
                    <p class="price"><span class="mt">
                        <?php                                                         //Solid

                        if ($this->session->userdata['loggedin']['ho_flag'] == "Y")   //When user in Headoffice
                        {
                          echo $ho_purchase_daysld;
                        } else {                                                  //When user in Branhoffice
                          echo $purchase_day->tot_purchase;
                        }
                        ?>
                        <strong>MT</strong></span>

                      <span class="lit">
                        <?php                                                             //Liquid
                        if ($this->session->userdata['loggedin']['ho_flag'] == "Y") {     //When user in Headoffice

                          echo $ho_purchase_daylqd;
                        } else {                                                        //When user in Branhoffice
                          echo $purchase_day->tot_purchase;
                        }
                        ?>
                        <strong>L</strong>
                      </span>
                    </p>
                  </div>
                </div>
              </div>



              <div class="col-sm-4 float-left">
                <div class="threeBoxNewSmall">
                  <div class="threeBoxImg yellowCol"><img src="<?= base_url() ?>assets/images/boxIcon_b_new.png" alt=""></div>
                  <div class="threeBoxTxt">
                    <h2>Sale For The Day</h2>
                    <p class="price"><span class="mt"><?php                               //Solid
                                                      if ($this->session->userdata['loggedin']['ho_flag'] == "Y")      //User in HO
                                                      {

                                                        echo $ho_sale_daysld;
                                                      } else {                                                        //In Branch
                                                        echo $sale_day->tot_sale;
                                                      }
                                                      ?><strong>MT</strong></span>
                      <span class="lit"><?php                                          //Liquid
                                        if ($this->session->userdata['loggedin']['ho_flag'] == "Y")       //User in Ho
                                        {
                                          echo $ho_sale_daylqd;
                                        } else {                                                         //user in branch
                                          echo $sale_day->tot_sale;
                                        }
                                        ?> <strong>L</strong></span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 float-left">
                <div class="threeBoxNewSmall">
                  <div class="threeBoxImg yellowCol"><img src="<?= base_url() ?>assets/images/boxIcon_c_new.png" alt="">
                  </div>
                  <div class="threeBoxTxt">
                    <h2>Collection For The Day</h2>
                    <p class="price">
                      <span class="lit"><strong><i class="fa fa-inr" aria-hidden="true"></i> </strong><?php
                                                                                                      if ($this->session->userdata['loggedin']['ho_flag'] == "Y")            //In Ho
                                                                                                      {
                                                                                                        echo $ho_recvamt_day->tot_recvamt;
                                                                                                      } else {                                                      //In branch
                                                                                                        echo '0';
                                                                                                      }
                                                                                                      ?></span>
                    </p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-12 rightSideSec">
        <div class="row">

          <div class="sectionNew">
            <div class="col-sm-12">
              <h2>District Wise Status</h2>
            </div>

            <div class="col-sm-12">
              <div class="districWisSec">
                <div class="districWisSecLeft districWisSecLeft_FullWidth">
                  <ul>

                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="339" onclick="brdaypurchase(339)">Bankura<i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="334" onclick="brdaypurchase(334)">Birbhum<i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="329" onclick="brdaypurchase(329)">Coochbihar<i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="331" onclick="brdaypurchase(331)">Dakshin Dinajpur<i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="338" onclick="brdaypurchase(338)">Hooghly <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="328" onclick="brdaypurchase(328)">Jalpaiguri <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="332" onclick="brdaypurchase(332)">Malda <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="333" onclick="brdaypurchase(333)">Murshidabad<i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="336" onclick="brdaypurchase(336)">Nadia <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="343" onclick="brdaypurchase(343)">North 24 Parganas <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="335" onclick="brdaypurchase(335)">Purba Burdwan (Bardhaman) <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="344" onclick="brdaypurchase(344)">Paschim Medinipur (West Medinipur) <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="345" onclick="brdaypurchase(345)">Purba Medinipur (East Medinipur) <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="343" onclick="brdaypurchase(343)">South 24 Parganas <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchase" dist_id="" distname="330" onclick="brdaypurchase(330)">Uttar Dinajpur<i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>


                  </ul>
                </div>
                <div class="districWisSecRight districWisSecRight_FullWidth">
                                      
                                    <div style="text-align:center; margin-top: 30px;">

                    <h2 id="distName"></h2>

                    </div>

                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Day Purchase</h3>
                      <div class="valueSec">
                        <span class="mt"><span id="dp">0.00</span> <strong>MT</strong></span>
                        <span class="lit"><span id="dpl">0.00</span> <strong>L</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Day Sale </h3>
                      <div class="valueSec">
                        <span class="mt"><span id="ds">0.00</span> <strong>MT</strong></span>
                        <span class="lit"><span id="dsl">0.00</span> <strong>L</strong></span>
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
                        <span class="lit" id="recvdy" STYLE="font-size:18.0pt ;"><strong><i class="fa fa-inr" aria-hidden="true"></i> </strong>
                        </span>
                      </p>
                      <!-- </div> -->
                    </div>
                  </div>

                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Monthly Purchase </h3>
                      <div class="valueSec">
                        <span class="mt" id=""><span id="dpm">0.00</span> <strong>MT</strong></span>
                        <span class="lit" id=""><span id="dpmlqd">0.00</span> <strong>L</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Monthly Sale </h3>
                      <div class="valueSec">
                        <span class="mt" id=""><span id="sm">0.00</span> <strong>MT</strong></span>
                        <span class="lit" id=""><span id="smlqd">0.00</span><strong>L</strong></span>
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
                        <span class="lit" id="recvmnth" STYLE="font-size:18.0pt ;"><strong><i class="fa fa-inr" aria-hidden="true"></i> </strong>
                        </span>
                      </p>
                      <!-- </div> -->
                    </div>
                  </div>

                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Yearly Purchase </h3>
                      <div class="valueSec">
                        <span class="mt" id=""><span id="pyr">0.00</span> <strong>MT</strong></span>
                        <span class="lit" id=""><span id="pyrlq">0.00</span> <strong>L</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Yearly Sale </h3>
                      <div class="valueSec">
                        <span class="mt" id=""><span id="syr">0.00</span> <strong>MT</strong></span>
                        <span class="lit" id=""><span id="syrlq">0.00</span> <strong>L</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 float-left">
                    <div class="districWisSecRightBox">
                      <h3>Yearly Collection </h3>
                      <p class="price">
                        <span class="lit" id="recvyr" STYLE="font-size:18.0pt ;"><strong><i class="fa fa-inr" aria-hidden="true"></i> </strong>
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
            </div>

          </div>

          <!-- <div class="sectionNew">
            <div class="col-sm-12">
              <h2 class="onClickOpen" data-toggle="collapse" data-target="#demo">
                Company Payment <span>(Click to Expand)</span>
                 <i class="fa fa-arrow-circle-down" aria-hidden="false"></i> 
              </h2>
            </div>


            <div class="col-sm-12 collapse" id="demo">
              <div class="companyWisSec">
                <div class="table-responsive tableFullWidth">
                  <table class="table table-striped tableCompany">
                    <thead>
                      <tr>
                        <th scope="col">#SL No.</th>
                        <th scope="col">Account Code</th>
                        <th scope="col">Account Name</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php //print_r($company_Wise_Status) 
                      ?>
                      <?php $i = 0;
                      $amt = 0.0;
                      foreach ($company_Wise_Status as $c_W_S) {
                        $i++ ?>
                        <tr>
                          <th scope="row"><?= $i ?></th>
                          <td><?php echo $c_W_S->benfed_ac_code; ?></td>
                          <td><?php echo $c_W_S->ac_name; ?></td>
                          <td><?php echo $c_W_S->amt;
                              $amt = $amt + $c_W_S->amt; ?></td>

                        </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td class="report" colspan="2" style="text-align:left"><b>Total</b></td>


                        <td class="report"><b></b></td>

                        <td class="report"><b><?= $amt ?></b></td>



                      </tr>
                    </tfoot>

                  </table>
                </div>
              </div>
            </div>

          </div>


           -->

          <div class="barPaiChartMain">

            <div class="col-sm-6 float-left">
              <div class="barChart">
                <!-- <h2><?php echo round($totsolidsale->qty, 3); ?> MT</h2> -->
                <!-- <h2>Sale quantity(solid) For financial year
                  <?php if ($this->session->userdata['loggedin']['fin_yr']) echo $this->session->userdata['loggedin']['fin_yr']; ?>
                </h2> -->
                <?php

                $dataPoints  = array();
                foreach ($distwisesale as $key) {
                  array_push($dataPoints, array("y" => "$key->qty", "label" => "$key->district_name"));
                }
                ?>
                <canvas id="barChart"></canvas>
              </div>
            </div>

            <div class="col-sm-6 float-left">
              <div class="barChart">
                <!-- <h2><?php echo round($totliquidsale->qty, 3); ?> LTR</h2> -->
                <!-- <h2>Sale quantity(liquid) For financial year
                  <?php if ($this->session->userdata['loggedin']['fin_yr']) echo $this->session->userdata['loggedin']['fin_yr']; ?>
                </h2> -->
                <?php

                $dataPoints  = array();
                foreach ($distwisesale as $key) {
                  array_push($dataPoints, array("y" => "$key->qty", "label" => "$key->district_name"));
                }
                ?>
                <canvas id="barChartl"></canvas>
              </div>
            </div>
          </div>



          <div id="divToPrint">

            <div style="text-align:center;">

              <h2>
                <form action="<?php echo site_url("fert/rep/overdue_list") ?>" method="post">
                  <input type="hidden" name="from_date" value="<?= date('Y-m-d') ?>">
                  Overdue List <button type="submit" class="btn btn-primary btn-lg">Generate</button>
                </form>
              </h2>

            </div>


          </div>








          <!-- =========================================================================== -->

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


            <div class="col-sm-12">
              <div class="districWisSec">
                <div class="districWisSecLeft districWisSecLeft_FullWidth">
                  <ul>

                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(339)">Bankura<i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(334)">Birbhum<i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(329)">Coochbihar<i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(331)">Dakshin Dinajpur<i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(338)">Hooghly <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(328)">Jalpaiguri <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(332)">Malda <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(333)">Murshidabad<i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(336)">Nadia <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(343)">North 24 Parganas <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(335)">Purba Burdwan (Bardhaman) <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(344)">Paschim Medinipur (West Medinipur) <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(345)">Purba Medinipur (East Medinipur) <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(343)">South 24 Parganas <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)" class="brdaypurchasec" onclick="brdaypurchasec(330)">Uttar Dinajpur<i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>


                  </ul>
                </div>
                <div class="districWisSecRight districWisSecRight_FullWidth">

                <div style="text-align:center; margin-top: 30px;">

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
            </div>

          </div>


          <!-- ============================================================================== -->
          <!-- <div class="stockPointSecTitle" >
                <div class="col-sm-12">
                  <div class="get-quote">
                    <div class="row">
                        <div class="col-sm-10 col-12">
                            <h2 id="quote">Overdue List</h2>
                        </div>
                        <div class="col-sm-2 col-12">
                          <form action="<?php echo site_url("fert/rep/overdue_list") ?>" method="post">
                            <input type="hidden" name="from_date" value="<?= date('Y-m-d') ?>">
                            <button type="submit" class="btn btn-primary pull-right" >Open</button>
                          </form>
                        </div>
                    </div>
                </div>                    

              </div>
            </div> -->


          <!-- ======================================== -->


          <!-- ================================= -->
          <div class="barPaiChartMain">
            <div class="col-sm-12 float-left">
              <div class="barChart">
                <h2 style="text-align:center"><b>Collection For financial year
                    <?php if ($this->session->userdata['loggedin']['fin_yr']) echo $this->session->userdata['loggedin']['fin_yr']; ?> - Total : <?php echo $tot_coloction[0]->tot_recvamt; ?></b>
                </h2>
                <canvas id="barChartBottom"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script> -->


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

    $('#overlay').fadeIn().delay(500).fadeOut();
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

$(".brdaypurchase").click(function(){
  var distname=$(this).text();
  $("#distName").text(distname);
});



$(".brdaypurchasec").click(function(){
  var distname=$(this).text();
  $("#distNamec").text(distname);
});

  function brdaypurchasec(br_id) {
    //   alert(br_id);

    $('#overlay').fadeIn().delay(500).fadeOut();

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
  /*******************************************Sale quantity(solid) For financial year************************************************/
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
        label: '',
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

    var barChartId = document.getElementById("barChart");
    if (barChartId) {
      var ctxB = document.getElementById("barChart").getContext('2d');
      var myBarChart = new Chart(ctxB, {
        type: 'bar',
        data: data,
        options: {
          legend: {
            display: false
          },
          title: {
            display: true,
            text: 'Sale quantity(solid) For financial year <?php if ($this->session->userdata["loggedin"]["fin_yr"]) echo $this->session->userdata["loggedin"]["fin_yr"]; ?> - Total : <?php echo round($totsolidsale->qty, 3); ?> MT'
          },


          scales: {
            yAxes: [{
              scaleLabel: {
                display: true,
                labelString: 'Unit in MT'
              }
              // ,
              // ticks: {
              // min: 0, // minimum value
              // max: 1600, // maximum value
              // stepSize: 200
              // }
            }]
          }
        }


      });
    }

    /*******************************************Sale quantity(liquid) For financial year************************************************/
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
        label: '',
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

    var barChartId = document.getElementById("barChartl");
    if (barChartId) {
      var ctxB = document.getElementById("barChartl").getContext('2d');
      var myBarChart = new Chart(ctxB, {
        type: 'bar',
        data: data,
        options: {
          legend: {
            display: false
          },
          title: {
            display: true,
            text: 'Sale quantity(liquid) For financial year <?php if ($this->session->userdata["loggedin"]["fin_yr"]) echo $this->session->userdata["loggedin"]["fin_yr"]; ?> - Total : <?php echo round($totliquidsale->qty, 3); ?> LTR'
          },
          scales: {
            yAxes: [{
              scaleLabel: {
                display: true,
                labelString: 'Unit in LTR'
              }
              // ,
              // ticks: {
              // min: 0, // minimum value
              // max: 1600, // maximum value
              // stepSize: 200
              // }
            }]
          }
        }

      });
    }

  }

  /***********************************************END*************************************************************************************** */

  //**********************************************Collection bar graph for a year  */
  <?php
  $label = '';
  $qty   = '';
  foreach ($coloction_distwise as $key) {
    $label .=  '"' . $key->district_name . '",';
    $qty   .=   ($key->tot_recvamt) . ',';
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

  var barChartBottomId = document.getElementById("barChartBottom");
  if (barChartBottomId) {
    var ctxC = document.getElementById("barChartBottom").getContext('2d');

    var myBarChartBot = new Chart(ctxC, {
      type: 'bar',
      data: data,
      options: {
        "hover": {
          "animationDuration": 0
        },
        "animation": {
          "duration": 1,
          "onComplete": function() {
            var chartInstance = this.chart,
              ctx = chartInstance.ctx;
            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
            ctx.textAlign = 'center';
            ctx.textBaseline = 'bottom';

            this.data.datasets.forEach(function(dataset, i) {
              var meta = chartInstance.controller.getDatasetMeta(i);
              meta.data.forEach(function(bar, index) {
                var data = dataset.data[index];
                ctx.fillText(data, bar._model.x, bar._model.y - 5);
              });
            });
          }
        },
        legend: {
          "display": false
        },
        tooltips: {
          "enabled": false
        },
        scales: {
          yAxes: [{
            scaleLabel: {
              display: true,
              labelString: 'Amount in crores'
            }
          }]
        }
      }

    });
  }
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

<script>
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('Fertilizer_Login/main/companyWiseStatus'); ?>",
    data: {
      data: "hello"
    },
    dataType: 'json',
    success: function(result) {
      alert(result);
      // $('#tabledata').html(result);
      // $('#f_date').html(strDAte(fDate));
      // $('#t_date').html(strDAte(tDate));
      // $('#overlay').fadeOut();
    }
  });



  function overdueList() {
    var daet = "<?= date('Y-m-d');  ?>"

  }
</script>