<?php

//Function to claculate the stock balance for a particular branch on a particular date
if (!function_exists('stock_balance')) {     
  function stock_balance($date, $branch, $state)
  {

    $ci = &get_instance();
    $ci->load->database();

    if ($state == 'S') {                    //For Solid State Fertilizer

      $rtndate = $ci->db->query("select max(balance_dt) date from   tdf_opening_stock where  balance_dt <= '" . $date . "' and branch_id =" . $branch)->row();  //getting maximum opening date less than current date

      $maxdate = $rtndate->date;

       //Retrieving the opening stock at year opening

      $rtndata = $ci->db->query("select sum(a.qty)qty,b.unit unit 
                                from   tdf_opening_stock a,mm_product b
                                where  a.prod_id = b.prod_id
                                and    a.balance_dt  = '" . $maxdate . "'
                                and    a.branch_id   =  " . $branch . "
                                and    a.unit_id in(1,2,4,6)
                                group by b.unit;")->result();


      $total_qty = 0.00;

      if (!empty($rtndata)) {                         //Solid opening stock converting all units in MT
        foreach ($rtndata as $stockbalance) {
          if ($stockbalance->unit == 1) {
            $qty = $stockbalance->qty;
            $total_qty = $total_qty + $qty;
          } elseif ($stockbalance->unit == 2) {
            $qty = $stockbalance->qty / 1000;
            $total_qty = $total_qty +  $qty;
          } elseif ($stockbalance->unit == 4) {
            $Qty4 = $stockbalance->qty / 10;
            $total_qty = $total_qty + $Qty4;
          } elseif ($stockbalance->unit == 6) {
            $Qty6 = $stockbalance->qty / 1000000;
            $total_qty = $total_qty + $Qty6;
          }
        }                                                         //end of unit conversion
      }

      //purchase

      $get_purchase = $ci->db->query(" select sum(qty) qty,unit
                   from   td_purchase
                   where  trans_dt between '" . $maxdate . "' and '" . $date . "'
                   and    br = " . $branch . "
                   and    unit in(1,2,4,6)
                   group by unit")->result();


      $total_purchase_qty = 0.00;
      if (!empty($get_purchase)) {                                     //Solid purchase stock converting all units in MT
        foreach ($get_purchase as $purchase_data) {
          if ($purchase_data->unit == 1) {
            $total_purchase_qty = $total_purchase_qty + $purchase_data->qty;
          } elseif ($purchase_data->unit == 2) {
            $Qty2 = $purchase_data->qty / 1000;
            $total_purchase_qty = $total_purchase_qty + $Qty2;
          } elseif ($purchase_data->unit == 4) {
            $Qty4 = $purchase_data->qty / 10;
            $total_purchase_qty = $total_purchase_qty + $Qty4;
          } elseif ($purchase_data->unit == 6) {
            $Qty6 = $purchase_data->qty / 1000000;
            $total_purchase_qty = $total_purchase_qty + $Qty6;
          }
        }                                                         //end of unit conversion
      }

      //  $total_purchase_qty;

      //Sale
      $get_sale = $ci->db->query("select ifnull(SUM(a.qty),0) qty,b.unit
                                  from   td_sale a ,mm_product b
                                  where  a.prod_id=b.prod_id
                                  and    a.do_dt between '" . $maxdate . "' and '" . $date . "'
                                  and    a.br_cd =" . $branch . "
                                  and    b.unit in (1,2,4,6)	
                                  group by b.unit")->result();

      $total_sale_qty = 0.00;

      if (!empty($get_sale)) {                                     //Solid sale stock converting all units in MT
        foreach ($get_sale as $sale_data) {
          if ($sale_data->unit == 1) {
            $total_sale_qty = $total_sale_qty + $sale_data->qty;
          } elseif ($sale_data->unit == 2) {
            $Qty2 = $sale_data->qty / 1000;
            $total_sale_qty = $total_sale_qty + $Qty2;
          } elseif ($sale_data->unit == 4) {
            $Qty4 = $sale_data->qty / 10;
            $total_sale_qty = $total_sale_qty + $Qty4;
          } elseif ($sale_data->unit == 6) {
            $Qty6 = $sale_data->qty / 1000000;
            $total_sale_qty = $total_sale_qty + $Qty6;
          }
        }                                                         //end of unit conversion
      }
      $closing_stk = ($total_qty + $total_purchase_qty) - $total_sale_qty;
      
      return  round($closing_stk,3);



    } else if ($state == 'L') {              //For Liquid State Fertilizer

      $total_sale_qty=0.0;
      $total_purchase_qty = 0.0; 



      $rtndate = $ci->db->query("select max(balance_dt) date from   tdf_opening_stock where  balance_dt <= '" . $date . "' and branch_id =" . $branch)->row();

      $maxdate = $rtndate->date;

      //Retrieving the opening stock at year opening
      $rtndata = $ci->db->query("select sum(a.qty)qty,b.unit unit,b.qty_per_bag
                            from   tdf_opening_stock a,mm_product b
                            where  a.prod_id = b.prod_id
                            and    a.balance_dt  = '" . $maxdate . "'
                            and    a.branch_id   =  " . $branch . "
                            and    a.unit_id in(3,5)
                            group by b.unit,b.qty_per_bag")->result();



      $total_qty = 0.00;

      if (!empty($rtndata)) {                                   //Liquid stock converting all units in LTR
        foreach ($rtndata as $stockbalance) {

          if ($stockbalance->unit == 3) {
            $Qty3 = ($stockbalance->qty * $stockbalance->qty_per_bag);
            $total_qty = $total_qty + $Qty3;
          } elseif ($stockbalance->unit == 5) {

            $Qty5 = ($stockbalance->qty * $stockbalance->qty_per_bag) / 1000;
            $total_qty = $total_qty + $Qty5;
          }
        }                                                       //end of conversion in ltr
      }





      $get_purchase = $ci->db->query("select sum(a.qty)qty,b.unit,b.qty_per_bag
                                      from   td_purchase a,mm_product b
                                      where  a.prod_id = b.prod_id
                                      and  a.trans_dt between '".$maxdate."' and '".$date."'
                                      and    a.br = " . $branch . "
                                      and    a.unit in(3,5)
                                      group by a.unit,b.qty_per_bag")->result();

      if (!empty($get_purchase)) {
                                    //Liquid stock converting all units in LTR

        foreach ($get_purchase as $purchase_data) {

          if ($purchase_data->unit == 3) {
            
            $Qty3 = ($purchase_data->qty * $purchase_data->qty_per_bag);
            $total_purchase_qty = $total_purchase_qty + $Qty3;
          } elseif ($purchase_data->unit == 5) {
            $Qty5 = ($purchase_data->qty * $purchase_data->qty_per_bag) / 1000;
            $total_purchase_qty = $total_purchase_qty + $Qty5;
          }
        }                                                       //end of conversion in ltr
      }


      $get_sale = $ci->db->query("select ifnull(SUM(a.qty),0) qty,b.unit,b.qty_per_bag
                                  from   td_sale a ,mm_product b
                                  where  a.prod_id=b.prod_id
                                  and    a.do_dt between '" . $maxdate . "' and '" . $date . "'
                                  and    a.br_cd =" . $branch . "
                                  and    b.unit in (3,5)	
                                  group by b.unit,b.qty_per_bag")->result();

    if (!empty($get_sale)) {
        $total_sale_qty = 0.0;                             //Liquid stock converting all units in LTR
        foreach ($get_sale as $sale_data) {

          if ($sale_data->unit == 3) {
            $Qty3 = ($sale_data->qty * $sale_data->qty_per_bag);
            $total_sale_qty = $total_sale_qty + $Qty3;
          } elseif ($sale_data->unit == 5) {
            $Qty5 = ($sale_data->qty * $sale_data->qty_per_bag) / 1000;
            $total_sale_qty = $total_sale_qty + $Qty5;
          }
        }                                                       //end of conversion in ltr
      }


      $closing_stk = ($total_qty + $total_purchase_qty)-$total_sale_qty;

      return round($closing_stk,3);

     //return round($total_qty,3);
    }
  }
}


//Function to claculate the Society balance for a particular Society on a particular date
if (!function_exists('soc_balance_amt')) {     
  function soc_balance_amt($date, $soc)
  {

    $ci = &get_instance();
    $ci->load->database();

    $count = 0;
    $opn_amt =0;

    //Getting From date from opening balance table
    
    $rtndate = $ci->db->query("select max(op_dt) date from   td_soc_opening where  op_dt <= '" . $date . "' and soc_id =" . $soc)->row();  

    $maxdate = $rtndate->date;

    //Opening Balance Retrieval

    $rtncount = $ci->db->query("select count(*) row_count from   td_soc_opening where  op_dt = '" . $maxdate . "' and soc_id =" . $soc)->row();  

    $count = $rtncount->row_count;

    if ($count > 0 ){
      $rtndata = $ci->db->query("select (-1) * sum(balance) opn_amt
                                 from   td_soc_opening
                                 where  soc_id 	= $soc
                                 and    op_dt    = '".$maxdate."'")->row();

      $opn_amt=$rtndata->opn_amt;
    }else{
      $opn_amt = 0;
    
    }

   
    
    //Advance Amount Retrieval
    $count = 0;
    $rtncount = 0;
    $rtndata  = 0;
    $adv_amt  = 0;

    $rtncount = $ci->db->query("select count(*) row_count from   tdf_advance  where  soc_id 	= '".$soc."'
    and    trans_type = 'I'
    and    trans_dt between '".$maxdate."' and '".$date."'")->row();  

    $count = $rtncount->row_count;

    if ($count > 0 ){
      $rtndata = $ci->db->query("select sum(adv_amt)adv_amt
                                 from   tdf_advance
                                 where  soc_id 	= '".$soc."'
                                 and    trans_type = 'I'
                                 and    trans_dt between '".$maxdate."' and '".$date."'")->row();
                                 
      $adv_amt=$rtndata->adv_amt;
    }else{
      $adv_amt = 0;
    
    }

    //Sale Amount Retrieval
    $count    = 0;
    $rtncount = 0;
    $rtndata  = 0;
    $sale_amt  = 0;

    $rtncount = $ci->db->query("select count(*) row_count from   td_sale  where  soc_id 	= '".$soc."'
    and    do_dt  between '".$maxdate."' and '".$date."'")->row();  

    $count = $rtncount->row_count;

    if ($count > 0 ){
      $rtndata = $ci->db->query("select sum((tot_amt))sale_amt
                                 from   td_sale
                                 where  soc_id 	= '".$soc."'
                                 and    do_dt between '".$maxdate."' and '".$date."'")->row();
                                 
      $sale_amt=$rtndata->sale_amt;
    }else{
      $sale_amt = 0;
    
    }
    
    //Credit Note Amount Retrieval
    $count    = 0;
    $rtncount = 0;
    $rtndata  = 0;
    $cr_amt   = 0;

    $rtncount = $ci->db->query("select count(*) row_count from   tdf_dr_cr_note  where  soc_id 	= '".$soc."'
    and    trans_flag = 'R' and  recpt_no like '%Crnote%'
    and    trans_dt   between '".$maxdate."' and '".$date."'")->row();  

    $count = $rtncount->row_count;

    if ($count > 0 ){
      $rtndata = $ci->db->query("select sum((tot_amt))cr_amt
                                  from   tdf_dr_cr_note
                                  where  soc_id 	= '".$soc."'
                                  and    trans_flag = 'R'
                                  and    recpt_no like '%Crnote%'
                                  and    trans_dt  between '".$maxdate."' and '".$date."'")->row();
                                  
      $cr_amt=$rtndata->cr_amt;
    }else{
      $cr_amt = 0;
    
    }

    //Other Adjustment Amount Retrieval
    $count    = 0;
    $rtncount = 0;
    $rtndata  = 0;
    $oth_amt   = 0;

    $rtncount = $ci->db->query("select count(*) row_count from   tdf_payment_recv  where  soc_id 	= '".$soc."'
    and    pay_type not in (2,6)
    and    paid_dt    between '".$maxdate."' and '".$date."'")->row();  

    $count = $rtncount->row_count;

    if ($count > 0 ){
      $rtndata = $ci->db->query("select sum(((paid_amt)))oth_amt
                                  from   tdf_payment_recv
                                  where  soc_id 	= '".$soc."'
                                  and    pay_type not in (2,6)
                                  and    paid_dt   between '".$maxdate."' and '".$date."'")->row();
                                  
      $oth_amt=$rtndata->oth_amt;
    }else{
      $oth_amt = 0;
    
    }

    $cls_amt = 0;

    $cls_amt = ($opn_amt + $adv_amt + $cr_amt + $oth_amt) - $sale_amt;

    return $cls_amt;
   
  }
}