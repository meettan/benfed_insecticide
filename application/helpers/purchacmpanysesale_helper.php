<?php

/**Function get_purchasec getting total purchase quantity within a period of time*/
if (!function_exists('get_purchasec')) {
  function get_purchasec($frfDate, $toDate, $branch, $hoFlag, $state,$company_id)
  {
    $ci = &get_instance();
    $ci->load->database();

    if ($state == 'S') {                                  //if the material is solid
      if ($hoFlag == 'Y') {                               //if user in Head office              
        $data = " select sum(a.qty) qty,b.unit
                  from   td_purchase a,mm_product b
                  where  a.prod_id = b.prod_id
                  and  a.comp_id = ".$company_id."
                  and    a.trans_dt between '" . $frfDate . "' and '" . $toDate . "'
                  and    a.unit in(1,2,4,6)
                  group by a.unit";

        $resultData = $ci->db->query($data)->result();
      } else {                                            //if user in branch
        $data = "select sum(qty) qty,unit
                   from   td_purchase
                   
                   where  trans_dt between '" . $frfDate . "' and '" . $toDate . "'
                   and    br = " . $branch . "
                   and  comp_id = ".$company_id."
                   and    unit in(1,2,4,6)
                   group by unit";

        $resultData = $ci->db->query($data)->result();
      }



      $total_qty = 0.00;
      if (!empty($resultData)) {                                     //Solid stock converting all units in MT
        foreach ($resultData as $ho_purchase_daysldkey) {
          if ($ho_purchase_daysldkey->unit == 1) {
            $total_qty = $total_qty + $ho_purchase_daysldkey->qty;
          } elseif ($ho_purchase_daysldkey->unit == 2) {
            $Qty2 = $ho_purchase_daysldkey->qty / 1000;
            $total_qty = $total_qty + $Qty2;
          } elseif ($ho_purchase_daysldkey->unit == 4) {
            $Qty4 = $ho_purchase_daysldkey->qty / 10;
            $total_qty = $total_qty + $Qty4;
          } elseif ($ho_purchase_daysldkey->unit == 6) {
            $Qty6 = $ho_purchase_daysldkey->qty / 1000000;
            $total_qty = $total_qty + $Qty6;
          }
        }                                                         //end of unit conversion
      }

      return round($total_qty,3);                                        /*end Solid material*/
    } else if ($state == 'L') {                                   //if the material is liquid
      if ($hoFlag == 'Y') {

        $data = $ci->db->query("select sum(a.qty)qty,b.unit,b.qty_per_bag
                  from   td_purchase a,mm_product b
                  where  a.prod_id = b.prod_id
                  and    a.trans_dt between '" . $frfDate . "' and '" . $toDate . "'
                  and  a.comp_id = ".$company_id."
                  and    a.unit in(3,5)
                  group by a.unit,b.qty_per_bag");
      } else {
        $data = $ci->db->query("select sum(a.qty)qty,b.unit,b.qty_per_bag
                  from   td_purchase a,mm_product b
                  where  a.prod_id = b.prod_id
                  and  a.comp_id = ".$company_id."
                  and    a.trans_dt between '" . $frfDate . "' and '" . $toDate . "'
                  and    a.br = " . $branch . "
                  and    a.unit in(3,5)
                  group by a.unit,b.qty_per_bag");
      }

      $resultData =  $data->result();


      $total_liq_qty = 0.00;
      if (!empty($resultData)) {                                   //Solid stock converting all units in LTR
        foreach ($resultData as $ho_purchase_daylqdkey) {

          if ($ho_purchase_daylqdkey->unit == 3) {
            $Qty3 = ($ho_purchase_daylqdkey->qty * $ho_purchase_daylqdkey->qty_per_bag);
            $total_liq_qty = $total_liq_qty + $Qty3;
          } elseif ($ho_purchase_daylqdkey->unit == 5) {

            $Qty5 = ($ho_purchase_daylqdkey->qty * $ho_purchase_daylqdkey->qty_per_bag) / 1000;
            $total_liq_qty = $total_liq_qty + $Qty5;
          }
        }                                                       //end of conversion in ltr
      }
      return round($total_liq_qty,3);
    }                                                           //end of liquid material


  }                                                               //end of function
}

/**Function get_salec getting total sale quantity within a period of time for a branch*/
if (!function_exists('get_salec')) {
  function get_salec($frfDate, $toDate, $branch, $hoFlag, $state,$company_id)
  {
    $ci = &get_instance();
    $ci->load->database();


    if ($state == 'S') {                                         //if the material is solid

      if ($hoFlag == 'Y') {                                          //if user in Head office
        $data = $ci->db->query("select ifnull(SUM(a.qty), 0) tot_sale_ho,b.unit
                                      from   td_sale a ,mm_product b
                                      where  a.prod_id=b.prod_id
                                      and  a.comp_id = ".$company_id."
                                      and    a.do_dt between '" . $frfDate . "' and '" . $toDate . "'
                                      and    b.unit in (1,2,4,6)	
                                      group by b.unit");
      } else {
        $data = $ci->db->query("select ifnull(SUM(a.qty), 0) tot_sale_ho,b.unit
                                      from   td_sale a ,mm_product b
                                      where  a.prod_id=b.prod_id
                                      and  a.comp_id = ".$company_id."
                                      and    a.do_dt between '" . $frfDate . "' and '" . $toDate . "'
                                      and    a.br_cd =" . $branch . "
                                      and    b.unit in (1,2,4,6)	
                                      group by b.unit");
      }

      $resultData =  $data->result();

      $total_qty_sale = 0.00;

      if (!empty($resultData)) {                                   //Solid stock converting all units in MT
        foreach ($resultData as $ho_sale_daysldkey) {
          if ($ho_sale_daysldkey->unit == 1) {
            $total_qty_sale = $total_qty_sale + $ho_sale_daysldkey->tot_sale_ho;
          } elseif ($ho_sale_daysldkey->unit == 2) {
            $Qty2 = $ho_sale_daysldkey->tot_sale_ho / 1000;
            $total_qty_sale = $total_qty_sale + $Qty2;
          } elseif ($ho_sale_daysldkey->unit == 4) {
            $Qty4 = $ho_sale_daysldkey->tot_sale_ho / 10;
            $total_qty_sale = $total_qty_sale + $Qty4;
          } elseif ($ho_sale_daysldkey->unit == 6) {
            $Qty6 = $ho_sale_daysldkey->tot_sale_ho / 1000000;

            $total_qty_sale = $total_qty_sale + $Qty6;
          }
        }                                                           //end of unit conversion
      }

      return round($total_qty_sale,3);                                     //end solid material
    } else if ($state == 'L') {                                   //if material liquid

      if ($hoFlag == 'Y') {                                          //if user in Head office

        $data = $ci->db->query("select ifnull(SUM(a.qty), 0) tot_sale_ho,b.unit,b.qty_per_bag
                                      from   td_sale a ,mm_product b
                                      where  a.prod_id=b.prod_id
                                      and  a.comp_id = ".$company_id."
                                      and    a.do_dt between '" . $frfDate . "' and '" . $toDate . "'
                                      and    b.unit in (3,5)	
                                      group by b.unit,b.qty_per_bag");
      } else {
        $data = $ci->db->query("select ifnull(SUM(a.qty), 0) tot_sale_ho,b.unit,b.qty_per_bag
        from   td_sale a ,mm_product b
        where  a.prod_id=b.prod_id
        and  a.comp_id = ".$company_id."
        and    a.br_cd =" . $branch . "
        and    a.do_dt between '" . $frfDate . "' and '" . $toDate . "'
        and    b.unit in (3,5)	
        group by b.unit,b.qty_per_bag");
      }

      $resultData =  $data->result();


      $total_liq_qty = 0.00;
      if (!empty($resultData)) {                                   //Solid stock converting all units in LTR
        foreach ($resultData as $ho_purchase_daylqdkey) {

          if ($ho_purchase_daylqdkey->unit == 3) {
            $Qty3 = ($ho_purchase_daylqdkey->tot_sale_ho * $ho_purchase_daylqdkey->qty_per_bag);
            $total_liq_qty = $total_liq_qty + $Qty3;
          } elseif ($ho_purchase_daylqdkey->unit == 5) {

            $Qty5 = ($ho_purchase_daylqdkey->tot_sale_ho * $ho_purchase_daylqdkey->qty_per_bag) / 1000;
            $total_liq_qty = $total_liq_qty + $Qty5;
          }
        }
        return round($total_liq_qty,3);
      }
    }                                                                   //end conversion


  }                                                                       //sale function endsc
}

/**Function collectionForTheDayc getting total collection amount within a period of time*/
if (!function_exists('collectionForTheDayc')) {
  function collectionForTheDayc($frfDate, $toDate, $branch, $hoFlag,$company_id)
  {
    $ci = &get_instance();
    $ci->load->database();
    if ($hoFlag == 'Y') {                                                 //if user in HO
      $data = $ci->db->query("select (sum(received)+sum(advance)) tot_recvamt
				from (
						SELECT sum(paid_amt)received,0 advance
						FROM tdf_payment_recv
						where  paid_dt BETWEEN '$frfDate' and '$toDate'
            and  comp_id = ".$company_id."
						and    pay_type not in ('2','6')
						UNION
						select 0 received,sum(adv_amt)advance
						from   tdf_advance
						where  trans_dt BETWEEN '$frfDate' and '$toDate'
						and    trans_type = 'I') a");
    } else {
      $data = $ci->db->query("select (sum(received)+sum(advance)) tot_recvamt
				from (
						SELECT sum(paid_amt)received,0 advance
						FROM tdf_payment_recv
						where  paid_dt BETWEEN '$frfDate' and '$toDate'
            and  comp_id = ".$company_id."
            and    branch_id=" . $branch . "
						and    pay_type not in ('2','6')
						UNION
						select 0 received,sum(adv_amt)advance
						from   tdf_advance
						where  trans_dt BETWEEN '$frfDate' and '$toDate'
            and    branch_id=" . $branch . "
						and    trans_type = 'I') a");
    }
    return $data->row();
    //end HO
  }                                                                 //end function
}

////================================================================================================

/**Function get_purchase_socc getting total purchase quantity within a period of time*/
if (!function_exists('get_purchase_socc')) {
  function get_purchase_socc($frfDate, $toDate, $soc, $state,$company_id)
  {
    $ci = &get_instance();
    $ci->load->database();

    if ($state == 'S') {                                  //if the material is solid
                                           //if user in branch
        $data = "select sum(qty) qty,unit
                   from   td_purchase
                   where  trans_dt between '" . $frfDate . "' and '" . $toDate . "'
                   and    a.comp_id = ".$company_id."
                   and    soc_id = " . $soc . "
                   and    unit in(1,2,4,6)
                   group by unit";

        $resultData = $ci->db->query($data)->result();
      



      $total_qty = 0.00;
      if (!empty($resultData)) {                                     //Solid stock converting all units in MT
        foreach ($resultData as $ho_purchase_daysldkey) {
          if ($ho_purchase_daysldkey->unit == 1) {
            $total_qty = $total_qty + $ho_purchase_daysldkey->qty;
          } elseif ($ho_purchase_daysldkey->unit == 2) {
            $Qty2 = $ho_purchase_daysldkey->qty / 1000;
            $total_qty = $total_qty + $Qty2;
          } elseif ($ho_purchase_daysldkey->unit == 4) {
            $Qty4 = $ho_purchase_daysldkey->qty / 10;
            $total_qty = $total_qty + $Qty4;
          } elseif ($ho_purchase_daysldkey->unit == 6) {
            $Qty6 = $ho_purchase_daysldkey->qty / 1000000;
            $total_qty = $total_qty + $Qty6;
          }
        }                                                         //end of unit conversion
      }

      return round($total_qty,3);                                        /*end Solid material*/
    } else if ($state == 'L') {                                   //if the material is liquid
 
        $data = $ci->db->query("select sum(a.qty)qty,b.unit,b.qty_per_bag
                  from   td_purchase a,mm_product b
                  where  a.prod_id = b.prod_id
                  and    a.comp_id = ".$company_id."
                  and    a.trans_dt between '" . $frfDate . "' and '" . $toDate . "'
                  and    a.soc_id = " . $soc . "
                  and    a.unit in(3,5)
                  group by a.unit,b.qty_per_bag");
  

      $resultData =  $data->result();


      $total_liq_qty = 0.00;
      if (!empty($resultData)) {                                   //Solid stock converting all units in LTR
        foreach ($resultData as $ho_purchase_daylqdkey) {

          if ($ho_purchase_daylqdkey->unit == 3) {
            $Qty3 = ($ho_purchase_daylqdkey->qty * $ho_purchase_daylqdkey->qty_per_bag);
            $total_liq_qty = $total_liq_qty + $Qty3;
          } elseif ($ho_purchase_daylqdkey->unit == 5) {

            $Qty5 = ($ho_purchase_daylqdkey->qty * $ho_purchase_daylqdkey->qty_per_bag) / 1000;
            $total_liq_qty = $total_liq_qty + $Qty5;
          }
        }                                                       //end of conversion in ltr
      }
      return round($total_liq_qty,3);
    }                                                           //end of liquid material


  }                                                               //end of function
}

/////=====================================================================================================

/**Function get_sale_socc getting total sale quantity within a period of time*/
if (!function_exists('get_sale_socc')) {
  function get_sale_socc($frfDate, $toDate, $soc, $state,$company_id)
  {
    $ci = &get_instance();
    $ci->load->database();


    if ($state == 'S') {                                         //if the material is solid

        $data = $ci->db->query("select ifnull(SUM(a.qty), 0) tot_sale_ho,b.unit
                                      from   td_sale a ,mm_product b
                                      where  a.prod_id=b.prod_id
                                      and    a.comp_id = ".$company_id."
                                      and    a.do_dt between '" . $frfDate . "' and '" . $toDate . "'
                                      and    a.soc_id =" . $soc . "
                                      and    b.unit in (1,2,4,6)	
                                      group by b.unit");

      $resultData =  $data->result();

      $total_qty_sale = 0.00;

      if (!empty($resultData)) {                                   //Solid stock converting all units in MT
        foreach ($resultData as $ho_sale_daysldkey) {
          if ($ho_sale_daysldkey->unit == 1) {
            $total_qty_sale = $total_qty_sale + $ho_sale_daysldkey->tot_sale_ho;
          } elseif ($ho_sale_daysldkey->unit == 2) {
            $Qty2 = $ho_sale_daysldkey->tot_sale_ho / 1000;
            $total_qty_sale = $total_qty_sale + $Qty2;
          } elseif ($ho_sale_daysldkey->unit == 4) {
            $Qty4 = $ho_sale_daysldkey->tot_sale_ho / 10;
            $total_qty_sale = $total_qty_sale + $Qty4;
          } elseif ($ho_sale_daysldkey->unit == 6) {
            $Qty6 = $ho_sale_daysldkey->tot_sale_ho / 1000000;

            $total_qty_sale = $total_qty_sale + $Qty6;
          }
        }                                                           //end of unit conversion
      }

      return round($total_qty_sale,3);                                     //end solid material
    } else if ($state == 'L') {                                   //if material liquid

        $data = $ci->db->query("select ifnull(SUM(a.qty), 0) tot_sale_ho,b.unit,b.qty_per_bag
        from   td_sale a ,mm_product b
        where  a.prod_id=b.prod_id
        and    a.comp_id = ".$company_id."
        and    a.soc_id =" . $soc . "
        and    a.do_dt between '" . $frfDate . "' and '" . $toDate . "'
        and    b.unit in (3,5)	
        group by b.unit,b.qty_per_bag");

      $resultData =  $data->result();


      $total_liq_qty = 0.00;
      if (!empty($resultData)) {                                   //Solid stock converting all units in LTR
        foreach ($resultData as $ho_purchase_daylqdkey) {

          if ($ho_purchase_daylqdkey->unit == 3) {
            $Qty3 = ($ho_purchase_daylqdkey->tot_sale_ho * $ho_purchase_daylqdkey->qty_per_bag);
            $total_liq_qty = $total_liq_qty + $Qty3;
          } elseif ($ho_purchase_daylqdkey->unit == 5) {

            $Qty5 = ($ho_purchase_daylqdkey->tot_sale_ho * $ho_purchase_daylqdkey->qty_per_bag) / 1000;
            $total_liq_qty = $total_liq_qty + $Qty5;
          }
        }
        return round($total_liq_qty,3);
      }
    }                                                                   //end conversion


  }                                                                       //sale function endsc
}

/**Function collectionForTheDaysocc Society getting total collection amount within a period of time*/
if (!function_exists('collectionForTheDay_socc')) {
  function collectionForTheDay_socc($frfDate, $toDate, $soc,$company_id)
  {
    $ci = &get_instance();
    $ci->load->database();
  
      $data = $ci->db->query("select (sum(received)+sum(advance)) tot_recvamt
				from (
						SELECT sum(paid_amt)received,0 advance
						FROM tdf_payment_recv
						where  paid_dt BETWEEN '$frfDate' and '$toDate'
            and    comp_id = ".$company_id."
            and    soc_id=" . $soc . "
						and    pay_type not in ('2','6')
						UNION
						select 0 received,sum(adv_amt)advance
						from   tdf_advance
						where  trans_dt BETWEEN '$frfDate' and '$toDate'
            and    soc_id=" . $soc . "
						and    trans_type = 'I') a");
    
    return $data->row()->tot_recvamt;
    //end HO
  }                                                                 //end function
}


