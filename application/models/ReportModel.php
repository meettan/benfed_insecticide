<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportModel extends CI_Model
{

    public function f_select($table, $select = NULL, $where = NULL, $type=NULL)
    {
        if (isset($select)) {
            $this->db->select($select);
        }

        if (isset($where)) {
            $this->db->where($where);
        }

        $value = $this->db->get($table);

        if ($type == 1) {
            return $value->row();
        } else {
            return $value->result();
        }
    }

    /**********Procedure for Consolidated Stock at branch*******************/

     public function p_consolidated_stock($all_data)
     {
 
         try {
             $this->db->reconnect();
 
             $sql = "CALL `p_consolidated_stock`(?,?,?)";
 
             $data_w = $this->db->query($sql, $all_data);
              
             $this->db->close();
         } catch (Exception $e) {
             echo $e->getMessage();
         }
 
         return $data_w->result();

     }

      /**********Procedure for Consolidated Stock at head office*******************/

      public function p_consolidated_stock_all($all_data)
      {
  
          try {
              $this->db->reconnect();
  
              $sql = "CALL `p_consolidated_stock_all`(?,?)";
  
              $data_w = $this->db->query($sql, $all_data);
               
              $this->db->close();
          } catch (Exception $e) {
              echo $e->getMessage();
          }
  
          return $data_w->result();
 
      }

  /************Procedure for Companywise Consolidated Stock at branch*************/  
   public function p_companywise_stock($all_data)
   {
            $fr_dt = $all_data[0];
            $to_dt = $all_data[1];
       try {
           $this->db->reconnect();

           $sql = "CALL `p_companywise_stock`(?,?,?,?)";

           $data_w = $this->db->query($sql, $all_data);
            
           $this->db->close();
       } catch (Exception $e) {
           echo $e->getMessage();
       }

       //return $data_w->result();

       $sql = $this->db->query("select a.comp_name,a.prod_desc,a.unit,a.opening,a.purchase,a.sale,a.closing,a.container,a.unit_id,a.hsn_code,
       (select round(sum(b.rate)/count(b.rate),3)   from td_purchase b  where a.prod_id=b.prod_id )as avg_rate
             from   tt_consolidated_stock a");
       return $data = $sql->result();

   }

   /************Procedure for Companywise Consolidated Stock at Head Office*************/  
   public function p_companywise_stock_all($all_data)
   {
   
            $fr_dt = $all_data[0];
            $to_dt = $all_data[1];

       try {
           $this->db->reconnect();

           $sql = "CALL `p_companywise_stock_all`(?,?,?)";

           $data_w = $this->db->query($sql, $all_data);
           
           $this->db->close();
       } catch (Exception $e) {
           echo $e->getMessage();
       }

      // return $data_w->result();
      $sql = $this->db->query("select a.comp_name,a.prod_desc,a.unit,a.opening,a.purchase,a.sale,a.closing,a.container,a.unit_id,a.hsn_code,
      (select round(sum(b.rate)/count(b.rate),3)   from td_purchase b  where a.prod_id=b.prod_id )as avg_rate
            from   tt_consolidated_stock a");
      return $data = $sql->result();

   }

/******************Procedure for Productwise stock at Branch******************************** */  
public function f_get_purchase_Productwise($frmDt, $toDt, $branch,$prod_id)
{
    $date=array($frmDt,$toDt,$branch,$prod_id);
    try {
        $this->db->reconnect();

        $sql = "CALL `p_productwise_stock`(?,?,?,?)";

        $data_w = $this->db->query($sql, $date);
        $this->db->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }


    return $data_w->result();

}

/******************Procedure for Due Register at Branch******************************** */  
public function f_get_soc_pay($frmDt, $toDt, $branch)
{
    $date=array($frmDt,$toDt,$branch);
    try {
        $this->db->reconnect();

        $sql = "CALL `p_due_register`(?,?,?)";

        $data_w = $this->db->query($sql, $date);
        
        $this->db->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }


    return $data_w->result();

}


/******************Monthly stock report at HO******************************** */  
public function stock_report_Popu_pro($frmDt, $toDt)
{
    $date=array($frmDt,$toDt);
    try {
        $this->db->reconnect();

        $sql = "CALL `p_populate_product`(?,?)";

        $data_w = $this->db->query($sql, $date);
        
        $this->db->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }


    $dataarray['data']= $data_w->result();
    return $this->load->view('report/monthlyReport/stock_report/table.php',$dataarray);

}
public function papulate_blance($frmDt, $toDt,$dist)
{
    $date=array($frmDt,$toDt,$dist);
    try {
        $this->db->reconnect();

        $sql = "CALL `p_monthly_stock`(?,?,?)";

        $data_w = $this->db->query($sql, $date);
        
        $this->db->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }


    $dataarray['data']= $data_w->result();
    return $this->load->view('report/monthlyReport/stock_report/table.php',$dataarray);

}

// ================================ end stock report =======================================

// ================================ Monthly sale stock report at HO =======================================
public function stock_report_Popu_sale($frmDt, $toDt)
{
    $date=array($frmDt,$toDt);
    try {
        $this->db->reconnect();

        $sql = "CALL `p_populate_product`(?,?)";

        $data_w = $this->db->query($sql, $date);
        
        $this->db->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }


    $dataarray['data']= $data_w->result();
    return $this->load->view('report/monthlyReport/sale/table.php',$dataarray);

}
function papulate_blance_sale($fDate, $tDate,$dist){
    $date=array($fDate,$tDate,$dist);
    try {
        $this->db->reconnect();

        $sql = "CALL `p_monthly_sale`(?,?,?)";

        $data_w = $this->db->query($sql, $date);
        
        $this->db->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $dataarray['data']= $data_w->result();
    return $this->load->view('report/monthlyReport/sale/table.php',$dataarray);
}
// ================================ End sale stock report =======================================

// ================================ Monthly Purchase stock report at HO =======================================
public function stock_report_Popu_purchase($frmDt, $toDt)
{
    $date=array($frmDt,$toDt);
    try {
        $this->db->reconnect();

        $sql = "CALL `p_populate_product`(?,?)";

        $data_w = $this->db->query($sql, $date);
        
        $this->db->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }


    $dataarray['data']= $data_w->result();
    return $this->load->view('report/monthlyReport/purchase/table.php',$dataarray);

}
function papulate_blance_purchase($fDate, $tDate,$dist){
    $date=array($fDate,$tDate,$dist);
    try {
        $this->db->reconnect();

        $sql = "CALL `p_monthly_purchase`(?,?,?)";

        $data_w = $this->db->query($sql, $date);
        
        $this->db->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $dataarray['data']= $data_w->result();
    return $this->load->view('report/monthlyReport/purchase/table.php',$dataarray);
}
// ================================ End purchase stock report =======================================

    // git add check  add some

    public function f_get_product_list($branch, $frmDt)
    {
        /*$query  = $this->db->query("select a.PROD_ID,a.PROD_DESC,a.COMPANY,a.unit,b.COMP_ID,
                                     b.COMP_NAME,b.short_name
                              from   mm_product a,mm_company_dtls b
                              where  a.COMPANY = b.COMP_ID
                              order by a.COMPANY,a.PROD_ID");*/

        $query  = $this->db->query("select Distinct a.prod_id,b.PROD_DESC,a.comp_id,b.unit,
                                        c.COMP_NAME,c.short_name,b.qty_per_bag
                                from   td_purchase a,mm_product b,mm_company_dtls c
                                where  a.prod_id = b.PROD_ID
                                and    a.comp_id = c.COMP_ID
                               
                                and     a.br       = $branch
                                order by a.comp_id,a.prod_id");

        return $query->result();
    }

    public function f_get_product_list_nw($frmDt)
    {
        /*$query  = $this->db->query("select a.PROD_ID,a.PROD_DESC,a.COMPANY,a.unit,b.COMP_ID,
                                     b.COMP_NAME,b.short_name
                              from   mm_product a,mm_company_dtls b
                              where  a.COMPANY = b.COMP_ID
                              order by a.COMPANY,a.PROD_ID");*/

        $query  = $this->db->query("select Distinct a.prod_id,b.PROD_DESC,a.comp_id,b.unit,
                                        c.COMP_NAME,c.short_name,b.qty_per_bag
                                from   td_purchase a,mm_product b,mm_company_dtls c
                                where  a.prod_id = b.PROD_ID
                                and    a.comp_id = c.COMP_ID
                               
                              
                                order by a.comp_id,a.prod_id");

        return $query->result();
    }

    public function f_get_product_list_rep($branch, $prod_id)
    {


        $query  = $this->db->query("select Distinct a.prod_id,a.ro_no,b.PROD_DESC,a.comp_id,b.unit,b.prod_desc,d.unit_name,
                                        c.COMP_NAME,c.short_name,b.qty_per_bag
                                from   td_purchase a,mm_product b,mm_company_dtls c,mm_unit d
                                where  a.prod_id = b.PROD_ID
                                and    a.comp_id = c.COMP_ID
                                and    b.unit=d.id
                                and    a.prod_id = '$prod_id'
                                and     a.br       = $branch
                                order by a.comp_id,a.prod_id");

        return $query->result();
    }
    public function f_get_product_list_companywise($branch, $frmDt, $comp_id)
    {

        $query  = $this->db->query("select Distinct a.prod_id,b.PROD_DESC,a.comp_id,b.unit,
                                        c.COMP_NAME,c.short_name,b.qty_per_bag
                                    from   td_purchase a,mm_product b,mm_company_dtls c
                                    where  a.prod_id = b.PROD_ID
                                    and    a.comp_id = c.COMP_ID
                                 
                                    and     a.br       = $branch
                                    and a.comp_id=$comp_id
                                    order by a.comp_id,a.prod_id");

        return $query->result();
    }


    public function f_get_allproduct_companywise($branch, $frmDt, $comp_id)
    {


        $query  = $this->db->query("select Distinct b.prod_id,b.PROD_DESC,c.comp_id,b.unit,b.qty_per_bag,
                                        c.COMP_NAME,c.short_name
                                from   mm_product b,mm_company_dtls c
                                where  b.company=c.comp_id
                                and    c.comp_id = '$comp_id'
                             
                                order by c.comp_id,b.prod_id");

        return $query->result();
    }


    public function f_get_district_asc()
    {

        $query  = $this->db->query("SELECT * FROM `md_branch` order by branch_name asc");

        return $query->result();
    }
// =================================End Sale Rate Slab at HO=========================
    public function f_get_salerateho($comp_id, $district, $frm_date, $to_date, $fin_id)
    {

        $sql = "SELECT a.sale_rtgst,`a`.`frm_dt`, `a`.`to_dt`, `a`.`catg_id`, `a`.`sp_mt`, `a`.`sp_bag`, `a`.`sp_govt`, `b`.`cate_desc`, `c`.`PROD_DESC` 
            FROM `mm_sale_rate` `a`, `mm_category` `b`, `mm_product` `c` 
            WHERE `a`.`catg_id` = `b`.`sl_no` 
            AND `a`.`prod_id` = `c`.`PROD_ID` 
            AND `a`.`comp_id` = '$comp_id' 
            AND `a`.`district` = '$district' 
            AND `a`.`frm_dt` >= '$frm_date' 
            AND `a`.`frm_dt` <= '$to_date' 
            AND `a`.`fin_id` = '$fin_id' 
            order by c.PROD_DESC,b.cate_desc,a.frm_dt";

        $query  = $this->db->query($sql);

        return $query->result();
    }
// =================================End Sale Rate Slab at HO=========================
    public function  f_get_scendry_stk_point($branch)
    {
        $query = $this->db->query("select  distinct a.stock_point as soc_id,b.soc_name as soc_name
                                        from td_purchase a,mm_ferti_soc b
                                        where a.stock_point=b.soc_id
                                        and  a.br=$branch");
        // echo $this->db->last_query();
        // die();
        return $query->result();
    }



    public function f_get_product_dtls_stkp_wse($branch, $frmDt, $to_dt, $comp_id, $prod_id, $soc_id)
    {

        $query = $this->db->query("select b.PROD_DESC,c.COMP_NAME,d.soc_name,b.unit,b.qty_per_bag
            from td_sale a ,mm_product b ,mm_company_dtls c,mm_ferti_soc d
            where a.prod_id=b.prod_id
            and a.comp_id=c.comp_id
            and a.soc_id=d.soc_id
            and a.prod_id=$prod_id
            and a.br_cd=$branch
            and d.soc_id=$soc_id 
            and do_dt between '$frmDt' and   '$to_dt' ");
        return $query->result();
    }
    public function f_get_product_comp_prod_ro($branch, $frmDt, $to_dt, $comp_id, $prod_id, $ro)
    {

        $query = $this->db->query("select a.prod_id,a.ro_no, (select GROUP_CONCAT(trans_do) 
                                                                from td_sale a,mm_company_dtls b,mm_product c
                                                                where a.comp_id =b.comp_id
                                                                and   a.prod_id = c.prod_id
                                                                and a.br_cd     = $branch
                                                                and   a.do_dt between '$frmDt' and '$to_dt'
                                                                and   a.sale_ro    ='$ro')sale_trans_ro,
                                        a.comp_id,a.unit,b.COMP_NAME,c.PROD_DESC,b.short_name,c.qty_per_bag
                                                                        from td_purchase a,mm_company_dtls b,mm_product c
                                                                        where a.comp_id =b.comp_id
                                                                        and   a.prod_id = c.prod_id
                                                                        and a.br  = $branch
                                                                        and   a.trans_dt between '$frmDt' and '$to_dt'
                                                                        and   a.trans_flag = 1
                                                                        and   a.ro_no      = '$ro'
                                            UNION
                                            select a.prod_id,a.sale_ro,GROUP_CONCAT(trans_do) sale_trans_ro,a.comp_id,a.unit,b.COMP_NAME,c.PROD_DESC,b.short_name,c.qty_per_bag
                                            from td_sale a,mm_company_dtls b,mm_product c
                                            where a.comp_id =b.comp_id
                                            and   a.prod_id = c.prod_id
                                            and a.br_cd     = $branch
                                            and   a.do_dt between '$frmDt' and '$to_dt'
                                            and   a.sale_ro    ='$ro'");

        return $query->result();
    }

    /******************************************************************* */

    public function f_get_balance_all($frmDt, $toDt)
    {
        if ($frmDt >= '2021-04-01') {

            $data = $this->db->query("Select district_name,tot_sale,sum(tot_sale)tot_sale,ifnull(Sum(qty ),0) + sum(tot_pur)  - sum(tot_sale) as opn_qty, 
                ifnull(Sum(lqd_qty ),0) + ifnull(sum(lqd_tot_pur),0)  - ifnull(sum(lqd_tot_sale),0) as lqd_opn_qty,tot_pur, lqd_tot_pur,tot_sale,sum(tot_sale)tot_sale,lqd_tot_sale,0 cls_qty
            from (
                select  district_name,sum(qty)+sum(tot_pur)-sum(tot_sale) qty,sum(lqd_qty)+sum(lqd_tot_pur)-sum(lqd_tot_sale)lqd_qty ,0 tot_pur,0 lqd_tot_pur,0 tot_sale,0 lqd_tot_sale
                from(
                select b.district_name as district_name,round(sum(if(c.unit=2,a.qty/1000,if(c.unit=1,a.qty,if(c.unit=4,a.qty/10,
                if(c.unit=6,a.qty/10000, 0))))),3)qty,round(sum(if(c.unit=5,a.qty/1000,if(c.unit=3,a.qty,0))),3)lqd_qty,0 tot_pur,0 lqd_tot_pur,0 tot_sale, 0 lqd_tot_sale
                                from tdf_opening_stock a,md_district b,mm_product c
                                where    balance_dt ='2020-04-01'
                                and a.branch_id=b.district_code 
                                and  a.prod_id=c.prod_id
                                group by b.district_name
                                union
                select b.district_name ,0 qty,0 ldq_qty,0 tot_pur,0 lqd_tot_pur,round(sum(if(c.unit=2,a.qty/1000,if(c.unit=1,a.qty,if(c.unit=4,a.qty/10,
                if(c.unit=6,a.qty/10000, 0))))),3) tot_sale,round(sum(if(c.unit=5,a.qty/1000,if(c.unit=3,a.qty,0))),3)lqd_tot_sale
                                  from td_sale a,md_district b,mm_product c
                                  where   do_dt <'$frmDt'
                                  and a.br_cd=b.district_code 
                                  and a.prod_id=c.prod_id
                                  group by   b.district_name
                UNION
                select b.district_name ,0 qty,0 lqd_qty,round(sum(if(c.unit=2,a.qty/1000,if(c.unit=1,a.qty,if(c.unit=4,a.qty/10,
                if(c.unit=6,a.qty/10000, 0))))),3) tot_pur, round(sum(if(c.unit=5,a.qty/1000,if(c.unit=3,a.qty,0))),3)lqd_tot_pur,
                0 tot_sale,0 lqd_tot_sale
                                  from td_purchase a ,md_district b,mm_product c
                                  where  trans_dt <'$frmDt'
                                  and   trans_flag = 1
                                  and a.prod_id=c.prod_id
                                  and a.br=b.district_code 
                                  group by b.district_name)a
                                  group by district_name
                  UNION
                  select b.district_name as district_name, 0 qty,0 lqd_qty,round(sum(if(c.unit=2,a.qty/1000,if(c.unit=1,a.qty,if(c.unit=4,a.qty/10,
                  if(c.unit=6,a.qty/10000, 0))))),3), round(sum(if(c.unit=5,a.qty/1000,if(c.unit=3,a.qty,0))),3)lqd_tot_pur,0 tot_sale, 0 lqd_tot_sale
                  from td_purchase a,md_district b,mm_product c
                  where   trans_dt between '$frmDt' and  '$toDt'
                  and a.br=b.district_code 
                  and   trans_flag = 1
                  and a.prod_id=c.prod_id
                  group by b.district_name
                  UNION
                  select  b.district_name ,0 qty,0 lqd_qty,0 tot_pur,0 lqd_tot_pur,round(sum(if(c.unit=2,a.qty/1000,if(c.unit=1,a.qty,if(c.unit=4,a.qty/10,
                  if(c.unit=6,a.qty/10000, 0))))),3) tot_sale,round(sum(if(c.unit=5,a.qty/1000,if(c.unit=3,a.qty,0))),3)lqd_tot_sale
                  from td_sale a,md_district b,mm_product c
                  where    do_dt between '$frmDt' and '$toDt'
                  and a.br_cd=b.district_code 
                  and a.prod_id=c.prod_id
                  group by  b.district_name)a
              group by district_name
              order by district_name");
            //   echo $this->db->last_query();
            //   exit;
        } else {

            $data = $this->db->query("Select prod_id,tot_sale,sum(tot_sale)tot_sale,ifnull(Sum(qty ),0) + sum(tot_pur)  - sum(tot_sale) as opn_qty, tot_pur, tot_sale,sum(tot_sale)tot_sale,ifnull(Sum(qty ),0) + sum(tot_pur)  - sum(tot_sale) as cls_qty
            from (
                select prod_id,sum(qty)+sum(tot_pur)-sum(tot_sale)qty,0 tot_pur,0 tot_sale
                from(
                select prod_id,sum(ifnull(qty,0))qty,0 tot_pur,0 tot_sale
                                from tdf_opening_stock
                                where    balance_dt ='2020-04-01'
                                group by prod_id
                                union
                select prod_id,0 qty,0 tot_pur,ifnull(sum(qty),0) tot_sale
                                  from td_sale
                                  where  do_dt <'$frmDt'
                                  group by prod_id
                UNION
                select prod_id,ifnull(sum(qty),0) tot_pur,0 qty,0 tot_sale
                                  from td_purchase
                                  where trans_dt <'$frmDt'
                                  and   trans_flag = 1
                                  group by prod_id)a
                                  group by prod_id
                  UNION
                  select prod_id, 0 qty,ifnull(sum(qty),0)tot_pur,0 tot_sale
                  from td_purchase
                  where trans_dt between '$frmDt' and  '$toDt'
                  and   trans_flag = 1
                  group by prod_id
                  UNION
                  select prod_id,0 qty,0 tot_pur,ifnull(sum(qty),0) tot_sale
                  from td_sale
                  where  do_dt between '$frmDt' and '$toDt'
                  group by prod_id)a
              group by prod_id
              order by prod_id");
        }

        if ($data->num_rows() > 0) {
            $row = $data->result();
        } else {
            $row = 0;
        }
        return $row;
    }

    /******************************************************************** */

    public function f_get_balance($branch, $frmDt, $toDt)
    {
        /*if ($frmDt>='2021-04-01') {

                $data = $this->db->query("Select prod_id,tot_sale,ifnull(sum(tot_sale),0)tot_sale,ifnull(Sum(qty ),0) + ifnull(sum(tot_pur),0) - ifnull(sum(tot_sale),0) as opn_qty, tot_pur, tot_sale,sum(tot_sale)tot_sale,0 cls_qty
            from (
                select prod_id,sum(qty)+sum(tot_pur)-sum(tot_sale)qty,0 tot_pur,0 tot_sale
                from(
                select prod_id,sum(ifnull(qty,0))qty,0 tot_pur,0 tot_sale
                                from tdf_opening_stock
                                where branch_id	    = $branch
                                and   balance_dt ='2020-04-01'
                                group by prod_id
                                union
                select prod_id,0 qty,0 tot_pur,ifnull(sum(qty),0) tot_sale
                                  from td_sale
                                  where br_cd	    = $branch
                                  and   do_dt <'$frmDt'
                                  group by prod_id
                UNION
                select prod_id,ifnull(sum(qty),0) tot_pur,0 qty,0 tot_sale
                                  from td_purchase
                                  where br	    =$branch
                                  and   trans_dt <'$frmDt'
                                  and   trans_flag = 1
                                  group by prod_id)a
                                  group by prod_id
                  UNION
                  select prod_id, 0 qty,ifnull(sum(qty),0)tot_pur,0 tot_sale
                  from td_purchase
                  where br	    = $branch
                  and   trans_dt between '$frmDt' and  '$toDt'
                  and   trans_flag = 1
                  group by prod_id
                  UNION
                  select prod_id,0 qty,0 tot_pur,ifnull(sum(qty),0) tot_sale
                  from td_sale
                  where br_cd	    = $branch
                  and   do_dt between '$frmDt' and '$toDt'
                  group by prod_id)a
              group by prod_id
              order by prod_id");*/
        if ($frmDt >= '2022-04-01') {
            $data = $this->db->query("Select prod_id,tot_sale,ifnull(sum(tot_sale),0)tot_sale,ifnull(Sum(qty ),0) + ifnull(sum(tot_pur),0) - ifnull(sum(tot_sale),0) as opn_qty, tot_pur, tot_sale,sum(tot_sale)tot_sale,0 cls_qty
            from (
                select prod_id,sum(qty)+sum(tot_pur)-sum(tot_sale)qty,0 tot_pur,0 tot_sale
                from(
                select prod_id,sum(ifnull(qty,0))qty,0 tot_pur,0 tot_sale
                                from tdf_opening_stock
                                where branch_id	    = $branch
                                and   balance_dt ='2020-04-01'
                                group by prod_id)a
                                  group by prod_id
                  UNION
                  select prod_id, 0 qty,ifnull(sum(qty),0)tot_pur,0 tot_sale
                  from td_purchase
                  where br	    = $branch
                  and   trans_dt between '$frmDt' and  '$toDt'
                  and   trans_flag = 1
                  group by prod_id
                  UNION
                  select prod_id,0 qty,0 tot_pur,ifnull(sum(qty),0) tot_sale
                  from td_sale
                  where br_cd	    = $branch
                  and   do_dt between '$frmDt' and '$toDt'
                  group by prod_id)a
              group by prod_id
              order by prod_id");
        } else {

            $data = $this->db->query("Select prod_id,tot_sale,sum(tot_sale)tot_sale,ifnull(Sum(qty ),0) + sum(tot_pur)  - sum(tot_sale) as opn_qty, tot_pur, tot_sale,sum(tot_sale)tot_sale,ifnull(Sum(qty ),0) + sum(tot_pur)  - sum(tot_sale) as cls_qty
            from (
                select prod_id,sum(qty)+sum(tot_pur)-sum(tot_sale)qty,0 tot_pur,0 tot_sale
                from(
                select prod_id,sum(ifnull(qty,0))qty,0 tot_pur,0 tot_sale
                                from tdf_opening_stock
                                where branch_id	    = $branch
                                and   balance_dt ='2020-04-01'
                                group by prod_id
                                union
                select prod_id,0 qty,0 tot_pur,ifnull(sum(qty),0) tot_sale
                                  from td_sale
                                  where br_cd	    = $branch
                                  and   do_dt <'$frmDt'
                                  group by prod_id
                UNION
                select prod_id,ifnull(sum(qty),0) tot_pur,0 qty,0 tot_sale
                                  from td_purchase
                                  where br	    =$branch
                                  and   trans_dt <'$frmDt'
                                  and   trans_flag = 1
                                  group by prod_id)a
                                  group by prod_id
                  UNION
                  select prod_id, 0 qty,ifnull(sum(qty),0)tot_pur,0 tot_sale
                  from td_purchase
                  where br	    = $branch
                  and   trans_dt between '$frmDt' and  '$toDt'
                  and   trans_flag = 1
                  group by prod_id
                  UNION
                  select prod_id,0 qty,0 tot_pur,ifnull(sum(qty),0) tot_sale
                  from td_sale
                  where br_cd	    = $branch
                  and   do_dt between '$frmDt' and '$toDt'
                  group by prod_id)a
              group by prod_id
              order by prod_id");
        }

        if ($data->num_rows() > 0) {
            $row = $data->result();
        } else {
            $row = 0;
        }
        return $row;
    }
    ////////////////////////////////////////
    public function f_get_crdemand($branch, $frmDt, $toDt)
    {

        $data = $this->db->query("select  sum(dep_amt)dep_amt,sum(adj_amt)adj_amt,sum(dep_amt)- sum(adj_amt)demand,soc_name
                         from(
                        select  0 dep_amt,ifnull(sum(a.paid_amt),0)adj_amt ,a.soc_id,b.soc_name
                                FROM tdf_payment_recv a,mm_ferti_soc b
                                WHERE a.branch_id=b.district
                                and   a.branch_id='$branch'
                                and a.pay_type='6'
								and a.soc_id=b.soc_id
                                and   a.paid_dt between '$frmDt' and '$toDt'
                        group by a.soc_id ,b.soc_name
                        
                        union
                        
                        select  ifnull(sum(a.tot_amt),0),0,a.soc_id,b.soc_name  from  tdf_dr_cr_note a,mm_ferti_soc b
                        where a.trans_flag='R'
                        and a.note_type='D'
                        and a.branch_id='$branch'
                        and a.branch_id=b.district
						and a.soc_id=b.soc_id
                        group by a.soc_id,b.soc_name )a
                        group by  soc_name");

        if ($data->num_rows() > 0) {
            $row = $data->result();
        } else {
            $row = 0;
        }
        return $row;
    }
    /********************************************************* */
    public function f_get_balance_rowiseall($branch, $from_dt, $to_dt, $opndt)
    {

        $data = $this->db->query("Select prod_id,tot_sale,sum(tot_sale)tot_sale,ifnull(Sum(qty ),0) + sum(tot_pur)  - sum(tot_sale) as opn_qty, 
    ifnull(Sum(lqd_qty ),0) + ifnull(sum(lqd_tot_pur),0)  - ifnull(sum(lqd_tot_sale),0) as lqd_opn_qty,tot_pur, lqd_tot_pur,tot_sale,sum(tot_sale)tot_sale,lqd_tot_sale,0 cls_qty
from (
    select  a.prod_id,sum(qty)+sum(tot_pur)-sum(tot_sale)qty,sum(lqd_qty)+sum(lqd_tot_pur)-sum(lqd_tot_sale)lqd_qty ,0 tot_pur,0 lqd_tot_pur,0 tot_sale,0 lqd_tot_sale
    from(
    select a.prod_id,round(sum(if(c.unit=2,a.qty/1000,if(c.unit=1,a.qty,if(c.unit=4,a.qty/10,
    if(c.unit=6,a.qty/10000, 0))))),3)qty,round(sum(if(c.unit=5,a.qty/1000,if(c.unit=3,a.qty,0))),3)lqd_qty,0 tot_pur,0 lqd_tot_pur,0 tot_sale, 0 lqd_tot_sale
                    from tdf_opening_stock a,md_district b,mm_product c
                    where a.balance_dt ='2020-04-01'
                    and   a.branch_id	  = $branch
                    and a.prod_id=c.prod_id
                    and   a.branch_id=b.district_code 
                    group by a.prod_id
                    union
    select a.prod_id ,0 qty,0 lqd_qty,0 tot_pur,0 lqd_tot_pur,round(sum(if(c.unit=2,a.qty/1000,if(c.unit=1,a.qty,if(c.unit=4,a.qty/10,
    if(c.unit=6,a.qty/10000, 0))))),3) tot_sale,round(sum(if(c.unit=5,a.qty/1000,if(c.unit=3,a.qty,0))),3)lqd_tot_sale
                      from td_sale a,md_district b,mm_product c
                      where  a.do_dt <'$from_dt'
                      and  a.br_cd	= $branch
                      and a.prod_id=c.prod_id
                      and a.br_cd=b.district_code 
                      group by   a.prod_id
    UNION
    select a.prod_id ,0 qty,0 lqd_qty,round(sum(if(c.unit=2,a.qty/1000,if(c.unit=1,a.qty,if(c.unit=4,a.qty/10,
    if(c.unit=6,a.qty/10000, 0))))),3) tot_pur, round(sum(if(c.unit=5,a.qty/1000,if(c.unit=3,a.qty,0))),3)lqd_tot_pur,
    0 tot_sale,0 lqd_tot_sale
                      from td_purchase a ,md_district b,mm_product c
                      where  trans_dt <'$from_dt'
                      and  a.br	    = $branch
                      and   trans_flag = 1
                      and a.prod_id=c.prod_id
                      and a.br=b.district_code 
                      group by a.prod_id)a
                      group by prod_id
      UNION
      select a.prod_id, 0 qty,0 lqd_qty,round(sum(if(c.unit=2,a.qty/1000,if(c.unit=1,a.qty,if(c.unit=4,a.qty/10,
      if(c.unit=6,a.qty/10000, 0))))),3), round(sum(if(c.unit=5,a.qty/1000,if(c.unit=3,a.qty,0))),3)lqd_tot_pur,0 tot_sale, 0 lqd_tot_sale
      from td_purchase a,md_district b,mm_product c
      where   trans_dt between '$from_dt' and  '$to_dt'
      and  a.br	    = $branch
      and a.br=b.district_code 
      and a.prod_id=c.prod_id
      and   trans_flag = 1
      group by a.prod_id
      UNION
      select  a.prod_id ,0 qty,0 lqd_qty,0 tot_pur,0 lqd_tot_pur,round(sum(if(c.unit=2,a.qty/1000,if(c.unit=1,a.qty,if(c.unit=4,a.qty/10,
      if(c.unit=6,a.qty/10000, 0))))),3) tot_sale,round(sum(if(c.unit=5,a.qty/1000,if(c.unit=3,a.qty,0))),3)lqd_tot_sale
      from td_sale a,md_district b,mm_product c
      where    do_dt between '$from_dt' and '$to_dt'
      and br_cd	    = $branch
      and a.prod_id=c.prod_id
      and a.br_cd=b.district_code 
      group by  a.prod_id)a
  group by prod_id
  order by prod_id");

        //     $data = $this->db->query("Select prod_id,ifnull(Sum(qty ),0)  as opn_qty, tot_pur, tot_sale,sum(tot_sale)tot_sale,ifnull(Sum(qty ),0) + sum(tot_pur)  - sum(tot_sale) as cls_qty,ro_no
        //     from (
        //     select prod_id,sum(qty)+sum(tot_pur)-sum(tot_sale)qty,0 tot_pur,0 tot_sale,ro_no
        //     from(
        //     select prod_id,sum(ifnull(qty,0))qty,0 tot_pur,0 tot_sale,ro_no
        //                     from tdf_opening_stock
        //                     where branch_id	    = $branch
        //                     and   balance_dt ='2020-04-01'
        //                     group by prod_id,ro_no
        //                     union
        //     select prod_id,0 qty,0 tot_pur,ifnull(sum(qty),0) tot_sale,sale_ro
        //                       from td_sale
        //                       where br_cd	    = $branch
        //                       and   do_dt <'$from_dt'
        //                       group by prod_id,sale_ro
        //     UNION
        //     select prod_id,ifnull(sum(qty),0) qty,0 tot_pur,0 tot_sale,ro_no
        //                       from td_purchase
        //                       where br	    =$branch
        //                       and   trans_dt < '$from_dt' 
        //                       and   trans_flag = 1
        //                       group by prod_id,ro_no)a
        //                       group by prod_id,ro_no
        //       UNION
        //       select prod_id, 0 qty,ifnull(sum(qty),0)tot_pur,0 tot_sale,ro_no
        //       from td_purchase
        //       where br	    = $branch
        //       and   trans_dt between '$from_dt' and  '$to_dt'
        //       and   trans_flag = 1
        //       group by prod_id,ro_no
        //       UNION
        //       select prod_id,0 qty,0 tot_pur,ifnull(sum(qty),0) tot_sale,sale_ro
        //       from td_sale
        //       where br_cd	    = $branch
        //       and   do_dt between '$from_dt' and '$to_dt'
        //       group by prod_id,sale_ro)a
        //   group by prod_id,ro_no
        //   order by prod_id");


        if ($data->num_rows() > 0) {
            $row = $data->result();
        } else {
            $row = 0;
        }
        return $row;
    }

    ////////////////////////////////////////////////
    public function f_get_balance_rowise($branch, $from_dt, $to_dt, $opndt)
    {



        $data = $this->db->query("Select prod_id,ifnull(Sum(qty ),0)  as opn_qty, tot_pur, tot_sale,sum(tot_sale)tot_sale,ifnull(Sum(qty ),0) + sum(tot_pur)  - sum(tot_sale) as cls_qty,ro_no
            from (
                select prod_id,sum(qty)+sum(tot_pur)-sum(tot_sale)qty,0 tot_pur,0 tot_sale,ro_no
                from(
                select prod_id,sum(ifnull(qty,0))qty,0 tot_pur,0 tot_sale,ro_no
                                from tdf_opening_stock
                                where branch_id	    = $branch
                                and   balance_dt ='2020-04-01'
                                group by prod_id,ro_no
                                union
                select prod_id,0 qty,0 tot_pur,ifnull(sum(qty),0) tot_sale,sale_ro
                                  from td_sale
                                  where br_cd	    = $branch
                                  and   do_dt <'$from_dt'
                                  group by prod_id,sale_ro
                UNION
                select prod_id,ifnull(sum(qty),0) qty,0 tot_pur,0 tot_sale,ro_no
                                  from td_purchase
                                  where br	    =$branch
                                  and   trans_dt < '$from_dt' 
                                  and   trans_flag = 1
                                  group by prod_id,ro_no)a
                                  group by prod_id,ro_no
                  UNION
                  select prod_id, 0 qty,ifnull(sum(qty),0)tot_pur,0 tot_sale,ro_no
                  from td_purchase
                  where br	    = $branch
                  and   trans_dt between '$from_dt' and  '$to_dt'
                  and   trans_flag = 1
                  group by prod_id,ro_no
                  UNION
                  select prod_id,0 qty,0 tot_pur,ifnull(sum(qty),0) tot_sale,sale_ro
                  from td_sale
                  where br_cd	    = $branch
                  and   do_dt between '$from_dt' and '$to_dt'
                  group by prod_id,sale_ro)a
              group by prod_id,ro_no
              order by prod_id");


        if ($data->num_rows() > 0) {
            $row = $data->result();
        } else {
            $row = 0;
        }
        return $row;
    }

    public function f_get_purchase($branch, $frmDt, $toDt)
    {
        $query  = $this->db->query("select b.prod_id, ifnull(sum(a.qty),0)tot_pur
                                        from td_purchase a,mm_product b
                                        where a.br	    = $branch
                                        and a.prod_id=b.prod_id
                                        and   a.trans_dt between '$frmDt' and '$toDt'
                                        and   a.trans_flag = 1
                                        group by b.prod_id");

        return $query->result();
    }




    public function f_get_purchase_all($frmDt, $toDt)
    {
       
        $query  = $this->db->query(" select c.district_name, sum(qty)purqty,round(sum(if(b.unit=2,a.qty/1000,if(b.unit=1,a.qty,if(b.unit=4,a.qty/10,
                                        if(b.unit=6,a.qty/10000, 0))))),3)sld_tot_pur,
                                        round(sum(if(b.unit=5,a.qty/1000,if(b.unit=3,a.qty,0))),3)lqd_tot_pur
                                        from td_purchase a,mm_product b,md_district c
                                        where a.prod_id=b.prod_id
                                        and  a.trans_dt between '$frmDt' and '$toDt'
                                        and a.br=c.district_code
                                        and a.unit=b.unit
                                        group by c.district_name");

        return $query->result();
    }

    // public function f_get_purchase_rowise($branch, $frmDt, $toDt)
    // {
    //     $query  = $this->db->query("select b.prod_id, ifnull(sum(a.qty),0)tot_pur,a.ro_no,b.unit
    //                                     from td_purchase a,mm_product b
    //                                     where a.br        = $branch
    //                                     and a.prod_id=b.prod_id
                                        
    //                                     and   a.trans_dt between '$frmDt' and '$toDt'
    //                                     and   a.trans_flag = 1
    //                                     group by b.prod_id,a.ro_no,b.unit");

    //     return $query->result();
    // }
    /**************************************************** */
    public function f_get_purchase_rowiseall($branch, $frmDt, $toDt)
    {
        $query  = $this->db->query("select a.prod_id,sum(a.qty)qty,b.unit,b.qty_per_bag,
    round(sum(if(b.unit=2,a.qty/1000,if(b.unit=1,a.qty,if(b.unit=4,a.qty/10,
                if(b.unit=6,a.qty/10000, 0))))),3) tot_pur, round(sum(if(b.unit=5,a.qty/1000,if(b.unit=3,a.qty,0))),3)lqd_tot_pur
                                from td_purchase a ,mm_product b
                                where br        = $branch
                                and a.prod_id=b.prod_id
                                and   a.trans_dt between '$frmDt' and '$toDt'
                                and   a.trans_flag = 1
                                group by a.prod_id,b.unit");

        return $query->result();
    }
    /******************************************* */

    public function f_get_yrwisecompwisesale($frmyr, $to_yr)
    {
        $query  = $this->db->query("select  fin_yr,
        sum(IFFCO_QTY)IFFCO_QTY,sum(IFFCO_LQQTY)IFFCO_LQQTY,sum(IFFCO_VALUE)IFFCO_VALUE,
        sum(KRIBCO_QTY)KRIBCO_QTY,sum(KRIBCO_LQQTY)KRIBCO_LQQTY,sum(KRIBCO_VALUE)KRIBCO_VALUE,
        sum(IPL_QTY)IPL_QTY, sum(IPL_LQQTY)IPL_LQQTY,sum(IPL_VALUE)IPL_VALUE,
        sum(CIL_QTY)CIL_QTY,sum(CIL_LQQTY)CIL_LQQTY,sum(CIL_VALUE)CIL_VALUE,
        sum(KCFL_QTY)KCFL_QTY, sum(KCFL_LQQTY)KCFL_LQQTY,sum(KCFL_VALUE)KCFL_VALUE,
        sum(JCF_QTY)JCF_QTY,sum(JCF_LQQTY)JCF_LQQTY,sum(JCF_VALUE)JCF_VALUE,
        sum(MIPL_QTY)MIPL_QTY,sum(MIPL_LQQTY)MIPL_LQQTY,sum(MIPL_VALUE)MIPL_VALUE,
        sum(CCFL_QTY)CCFL_QTY,sum(CCFL_LQQTY)CCFL_LQQTY,sum(CCFL_VALUE)CCFL_VALUE,
        sum(HURL_QTY)HURL_QTY,sum(HURL_LQQTY)HURL_LQQTY,sum(HURL_VALUE)HURL_VALUE,
        sum(KFL_QTY)KFL_QTY,sum(KFL_LQQTY)KFL_LQQTY,sum(KFL_VALUE)KFL_VALUE,
        sum(MFCL_QTY)MFCL_QTY,sum(MFCL_LQQTY)MFCL_LQQTY,sum(MFCL_VALUE)MFCL_VALUE
                                    from(
                                    SELECT b.fin_yr, if(c.comp_id=1,round(sum(CASE
                                    WHEN a.unit = 1 THEN a.qty
                                    WHEN a.unit = 2 THEN a.qty/1000
                                    WHEN a.unit = 4 THEN a.qty/10
                                    WHEN a.unit = 6 THEN a.qty/10000
                                    ELSE 0
                                    END ),3),0)IFFCO_QTY,
                                    if(c.comp_id=1,round(sum(CASE
                                    WHEN a.unit = 3 THEN a.qty
                                    WHEN a.unit = 5 THEN a.qty/1000
                                    ELSE 0
                                    END ),3),0)IFFCO_LQQTY,
                                if(c.comp_id=1,sum(a.tot_amt) ,0)IFFCO_VALUE,
                                    if(c.comp_id=2,round(sum(CASE
                                    WHEN a.unit = 1 THEN a.qty
                                    WHEN a.unit = 2 THEN a.qty/1000
                                    WHEN a.unit = 4 THEN a.qty/10
                                    WHEN a.unit = 6 THEN a.qty/10000
                                    ELSE 0
                                END ),3),0)KRIBCO_QTY,
                                
                                    if(c.comp_id=2,round(sum(CASE
                                    WHEN a.unit = 3 THEN a.qty
                                    WHEN a.unit = 5 THEN a.qty/1000
                                    ELSE 0
                                    END ),3),0)KRIBCO_LQQTY,if(c.comp_id=2,sum(a.tot_amt) ,0)KRIBCO_VALUE,
                                    if(c.comp_id=3,round(sum(CASE
                                    WHEN a.unit = 1 THEN a.qty
                                    WHEN a.unit = 2 THEN a.qty/1000
                                    WHEN a.unit = 4 THEN a.qty/10
                                    WHEN a.unit = 6 THEN a.qty/10000
                                    ELSE 0
                                END ),3),0)IPL_QTY, 
                                    if(c.comp_id=3,round(sum(CASE
                                    WHEN a.unit = 3 THEN a.qty
                                    WHEN a.unit = 5 THEN a.qty/1000
                                    ELSE 0
                                    END ),3),0)IPL_LQQTY,if(c.comp_id=3,sum(a.tot_amt) ,0)IPL_VALUE,
                                    if(c.comp_id=6,round(sum(CASE
                                    WHEN a.unit = 1 THEN a.qty
                                    WHEN a.unit = 2 THEN a.qty/1000
                                    WHEN a.unit = 4 THEN a.qty/10
                                    WHEN a.unit = 6 THEN a.qty/10000
                                    ELSE 0
                                END ),3),0)JCF_QTY,
                                    if(c.comp_id=6,round(sum(CASE
                                    WHEN a.unit = 3 THEN a.qty
                                    WHEN a.unit = 5 THEN a.qty/1000
                                    ELSE 0
                                    END ),3),0)JCF_LQQTY, if(c.comp_id=6,sum(a.tot_amt) ,0)JCF_VALUE,
                                    if(c.comp_id=7,round(sum(CASE
                                    WHEN a.unit = 1 THEN a.qty
                                    WHEN a.unit = 2 THEN a.qty/1000
                                    WHEN a.unit = 4 THEN a.qty/10
                                    WHEN a.unit = 6 THEN a.qty/10000
                                    ELSE 0
                                END ),3),0)MIPL_QTY,
                                if(c.comp_id=7,round(sum(CASE
                                WHEN a.unit = 3 THEN a.qty
                                WHEN a.unit = 5 THEN a.qty/1000
                                ELSE 0
                                END ),3),0)MIPL_LQQTY,if(c.comp_id=7,sum(a.tot_amt) ,0)MIPL_VALUE,
                                    if(c.comp_id=5,round(sum(CASE
                                    WHEN a.unit = 1 THEN a.qty
                                    WHEN a.unit = 2 THEN a.qty/1000
                                    WHEN a.unit = 4 THEN a.qty/10
                                    WHEN a.unit = 6 THEN a.qty/10000
                                    ELSE 0
                                END ),3),0)KCFL_QTY,
                                if(c.comp_id=5,round(sum(CASE
                                WHEN a.unit = 3 THEN a.qty
                                WHEN a.unit = 5 THEN a.qty/1000
                                ELSE 0
                                END ),3),0)KCFL_LQQTY,if(c.comp_id=5,sum(a.tot_amt) ,0)KCFL_VALUE,
                                    if(c.comp_id=4,round(sum(CASE
                                    WHEN a.unit = 1 THEN a.qty
                                    WHEN a.unit = 2 THEN a.qty/1000
                                    WHEN a.unit = 4 THEN a.qty/10
                                    WHEN a.unit = 6 THEN a.qty/10000
                                    ELSE 0
                                END ),3),0)CIL_QTY,
                                if(c.comp_id=4,round(sum(CASE
                                WHEN a.unit = 3 THEN a.qty
                                WHEN a.unit = 5 THEN a.qty/1000
                                ELSE 0
                                END ),3),0)CIL_LQQTY,if(c.comp_id=4,sum(a.tot_amt) ,0)CIL_VALUE,
                                if(c.comp_id=10,round(sum(CASE
                                WHEN a.unit = 1 THEN a.qty
                                WHEN a.unit = 2 THEN a.qty/1000
                                WHEN a.unit = 4 THEN a.qty/10
                                WHEN a.unit = 6 THEN a.qty/10000
                                ELSE 0
                            END ),3),0)CCFL_QTY,
                            if(c.comp_id=10,round(sum(CASE
                            WHEN a.unit = 3 THEN a.qty
                            WHEN a.unit = 5 THEN a.qty/1000
                            ELSE 0
                            END ),3),0)CCFL_LQQTY,if(c.comp_id=10,sum(a.tot_amt) ,0)CCFL_VALUE,
                                    if(c.comp_id=11,round(sum(CASE
                                WHEN a.unit = 1 THEN a.qty
                                WHEN a.unit = 2 THEN a.qty/1000
                                WHEN a.unit = 4 THEN a.qty/10
                                WHEN a.unit = 6 THEN a.qty/10000
                                ELSE 0
                            END ),3),0)HURL_QTY,
                            if(c.comp_id=11,round(sum(CASE
                            WHEN a.unit = 3 THEN a.qty
                            WHEN a.unit = 5 THEN a.qty/1000
                            ELSE 0
                            END ),3),0)HURL_LQQTY,if(c.comp_id=11,sum(a.tot_amt) ,0)HURL_VALUE,
                            if(c.comp_id=8,round(sum(CASE
                                    WHEN a.unit = 1 THEN a.qty
                                    WHEN a.unit = 2 THEN a.qty/1000
                                    WHEN a.unit = 4 THEN a.qty/10
                                    WHEN a.unit = 6 THEN a.qty/10000
                                    ELSE 0
                                END ),3),0)KFL_QTY,
                                if(c.comp_id=8,round(sum(CASE
                                WHEN a.unit = 3 THEN a.qty
                                WHEN a.unit = 5 THEN a.qty/1000
                                ELSE 0
                                END ),3),0)KFL_LQQTY,if(c.comp_id=8,sum(a.tot_amt) ,0)KFL_VALUE,
                                        if(c.comp_id=9,round(sum(CASE
                                    WHEN a.unit = 1 THEN a.qty
                                    WHEN a.unit = 2 THEN a.qty/1000
                                    WHEN a.unit = 4 THEN a.qty/10
                                    WHEN a.unit = 6 THEN a.qty/10000
                                    ELSE 0
                                END ),3),0)MFCL_QTY,
                                if(c.comp_id=9,round(sum(CASE
                                WHEN a.unit = 3 THEN a.qty
                                WHEN a.unit = 5 THEN a.qty/1000
                                ELSE 0
                                END ),3),0)MFCL_LQQTY,if(c.comp_id=9,sum(a.tot_amt) ,0)MFCL_VALUE
                                    FROM td_sale  a ,md_fin_year b ,mm_company_dtls c
                                    WHERE a.fin_yr=b.sl_no

                                    and b.sl_no between $frmyr and $to_yr
                                    AND c.comp_id=a.comp_id
                                    GROUP by a.fin_yr,c.comp_id)a
                                    group by fin_yr");


        return $query->result();
    }

    public function f_get_yrwisesale($frmyr, $to_yr)
    {

        $query  = $this->db->query("SELECT b.fin_yr,c.district_name, 
    round(sum(CASE
            WHEN a.unit = 1 THEN a.qty
            WHEN a.unit = 2 THEN a.qty/1000
            WHEN a.unit = 4 THEN a.qty/10
            WHEN a.unit = 6 THEN a.qty/10000
            ELSE 0
        END ),3)sldqty,
round(sum(CASE
    WHEN a.unit = 3 THEN a.qty
    WHEN a.unit = 5 THEN a.qty/1000
    ELSE 0
END ),3)lqdqty,
    sum(a.tot_amt) tot_amt
    FROM td_sale  a ,md_fin_year b ,md_district c
    where a.fin_yr=b.sl_no
    and c.district_code=a.br_cd
    and b.sl_no between $frmyr and $to_yr
    group by a.fin_yr,c.district_name
    order by c.district_name, b.fin_yr");


        return $query->result();
    }
    /**************************************************** */


    public function f_get_sale($branch, $frmDt, $toDt)
    {
        $query  = $this->db->query("select b.prod_id, ifnull(sum(a.qty),0)qty,b.unit
                                        from td_sale a,mm_product b
                                        where a.br_cd	    = $branch
                                        and a.prod_id=b.prod_id
                                        and   a.do_dt between '$frmDt' and '$toDt'
                                        group by b.prod_id,b.unit");

        return $query->result();
    }

    public function f_get_sale_all($frmDt, $toDt)
    {
        // $query  = $this->db->query("select prod_id, ifnull(sum(qty),0)tot_sale
        //                             from td_sale
        //                             where br_cd	    = $branch
        //                             and   do_dt between '$frmDt' and '$toDt'
        //                             group by prod_id");



        $query  = $this->db->query("select c.district_name, sum(a.qty)qty,round(sum(if(b.unit=2,a.qty/1000,if(b.unit=1,a.qty,if(b.unit=4,a.qty/10,
                                        if(b.unit=6,a.qty/10000, 0))))),3)sld_tot_sale,
                                        round(sum(if(b.unit=5,a.qty/1000,if(b.unit=3,a.qty,0))),3)lqd_tot_sale
                                        from td_sale a,mm_product b,md_district c
                                        where a.prod_id=b.prod_id
                                        and a.unit=b.unit
                                        and  a.do_dt between '$frmDt' and '$toDt'
                                        and a.br_cd=c.district_code
                                        group by c.district_name
                                        ");

        return $query->result();
    }


   
    public function f_get_sale_rowiseall($branch, $frmDt, $toDt)
    {
        $query  = $this->db->query("select a.prod_id,ifnull(sum(a.qty),0)qty,b.unit,b.qty_per_bag,
            round(sum(if(b.unit=2,a.qty/1000,if(b.unit=1,a.qty,if(b.unit=4,a.qty/10,
                if(b.unit=6,a.qty/10000, 0))))),3) tot_sale,round(sum(if(b.unit=5,a.qty/1000,if(b.unit=3,a.qty,0))),3)lqd_tot_sale
                                        from td_sale a,mm_product b
                                        where a.br_cd     = $branch
                                        and a.prod_id=b.prod_id
                                        and   a.do_dt between '$frmDt' and '$toDt'
                                        group by a.prod_id,b.unit");

        return $query->result();
    }


//==============================Branchwise Purchase Report at HO (individual and all branch)===========================
    public function pc($from_dt,$to_dt,$branch,$company)
    {

        $data=$this->db->query('select f.district_name,a.ro_no ro_no,a.ro_dt ro_dt,a.invoice_no,b.prod_id,a.invoice_dt invoice_dt,a.net_amt,
                                       a.qty qty,a.retlr_margin retlr_margin,d.soc_name,a.spl_rebt spl_rebt,a.rbt_add rbt_add,a.rbt_less rbt_less,a.rnd_of_add,a.rnd_of_less rnd_of_less,a.add_adj_amt,a.less_adj_amt,
                                       a.unit,a.stock_qty,a.rate,a.base_price,a.no_of_bags,a.cgst,a.sgst,a.tot_amt,
                                       c.short_name,b.PROD_DESC,a.trad_margin,a.oth_dis,a.frt_subsidy,b.unit,b.HSN_CODE
                                from td_purchase a,mm_product b,mm_company_dtls c,mm_ferti_soc d,md_district f
                                where  a.prod_id = b.PROD_ID
                                and    a.comp_id = c.COMP_ID
                                and    a.stock_point=d.soc_id
                                and    d.district=f.district_code
                                and    a.br      = '.$branch.'
                                and    a.comp_id = '.$company.'
                                and    a.trans_dt between "'.$from_dt.'" and "'.$to_dt.'"
                                and    a.trans_flag = 1');
       
        return $data->result();
        
    }

    public function pcn($from_dt,$to_dt,$company)
    {

        /*try {
            $this->db->reconnect();

            $sql = "CALL `p_purchase_all_n`(?,?,?)";

            $data_w = $this->db->query($sql, $all_data);


            $this->db->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }*/

        $data=$this->db->query('select f.district_name,a.ro_no ro_no,a.ro_dt ro_dt,a.invoice_no,b.prod_id,a.invoice_dt invoice_dt,a.net_amt,
                a.qty qty,a.retlr_margin retlr_margin,d.soc_name,a.spl_rebt spl_rebt,a.rbt_add rbt_add,a.rbt_less rbt_less,a.rnd_of_add,a.rnd_of_less rnd_of_less,a.add_adj_amt,a.less_adj_amt,
                a.unit,a.stock_qty,a.rate,a.base_price,a.no_of_bags,a.cgst,a.sgst,a.tot_amt,
                c.short_name,b.PROD_DESC,a.trad_margin,a.oth_dis,a.frt_subsidy,b.unit,b.HSN_CODE
                from td_purchase a,mm_product b,mm_company_dtls c,mm_ferti_soc d,md_district f
                where  a.prod_id = b.PROD_ID
                and    a.comp_id = c.COMP_ID
                and    a.stock_point=d.soc_id
                and    d.district=f.district_code
                and    a.comp_id = '.$company.'
                and    a.trans_dt between "'.$from_dt.'" and "'.$to_dt.'"
                and    a.trans_flag = 1');
                        
        return $data->result();
    }

// ============================End Branchwise Purchase Report at HO (individual and all branch)====================== 

    public function f_get_hsn_gst($frmDt, $toDt)
    {
        $query  = $this->db->query("select  c.prod_desc,c.hsn_code,c.qty_per_bag,c.GST_RT, d.unit_name,sum(a.qty) as qty,sum(a.round_tot_amt)as  sale_tot_amt,a.unit,
                                    sum(a.cgst) sale_cgst,sum(a.sgst) sale_sgst,sum(a.taxable_amt) taxable_amt
                                    from td_sale a,mm_product c,mm_unit d
                                    where   a.prod_id=c.prod_id
                                    and a.unit=d.id
                                    and  a.do_dt between '$frmDt' and '$toDt'
                                    group by c.prod_desc,c.hsn_code ,d.unit_name,a.unit");

        return $query->result();
    }
    public function f_pur_hsn_gst($frmDt, $toDt)
    {
        $query  = $this->db->query("select  c.prod_desc,c.hsn_code, d.unit_name,c.qty_per_bag,c.GST_RT,c.unit,c.prod_id,sum(a.qty) as qty,sum(a.tot_amt)as  pur_tot_amt,
        sum(a.cgst) pur_cgst,sum(a.sgst) pur_sgst,sum(a.net_amt) taxable_amt
        from td_purchase a,mm_product c,mm_unit d
        where   a.prod_id=c.prod_id
        and c.unit=d.id
        and  a.trans_dt between '$frmDt' and '$toDt'
        group by c.prod_desc,c.hsn_code ,d.unit_name,c.qty_per_bag,c.unit,c.prod_id");

        return $query->result();
    }
    public function f_get_gst($frmDt, $toDt)
    {
        $query  = $this->db->query("select  c.soc_name,a.trans_do,a.gst_type_flag,a.ack_dt as do_dt,a.round_tot_amt sale_tot_amt,c.gstin,
                                       a.cgst sale_cgst,a.sgst sale_sgst,b.cgst pur_cgst,b.sgst pur_sgst,a.taxable_amt   taxable_amt,
                                        a.cgst -b.cgst diff_cgst,a.sgst-b.sgst diff_sgst,
                                        (select  gst_rt from mm_product where prod_id=b.prod_id) as gst_rt
                                        from td_sale a,td_purchase b,mm_ferti_soc c
                                        where  a.sale_ro=b.ro_no
                                        and  a.soc_id=c.soc_id
                                        and  CAST(a.ack_dt AS DATE) between '$frmDt' and '$toDt'
                                       order by a.ack_dt ");

        return $query->result();
    }

    public function f_get_gst_b_to_c($frmDt, $toDt)
    {
        $query  = $this->db->query("select  c.soc_name,a.trans_do,a.gst_type_flag,a.do_dt,a.round_tot_amt sale_tot_amt,c.gstin,
                                       a.cgst sale_cgst,a.sgst sale_sgst,b.cgst pur_cgst,b.sgst pur_sgst,a.taxable_amt   taxable_amt,
                                        a.cgst -b.cgst diff_cgst,a.sgst-b.sgst diff_sgst,
                                        (select  gst_rt from mm_product where prod_id=b.prod_id) as gst_rt
                                        from td_sale a,td_purchase b,mm_ferti_soc c
                                        where  a.sale_ro=b.ro_no
                                        and  a.soc_id=c.soc_id
                                        and a.gst_type_flag='N'
                                        and  a.do_dt between '$frmDt' and '$toDt'
                                       order by a.do_dt ");

        return $query->result();
    }
    public function f_get_purchaserep($branch, $frmDt, $toDt)
    {
        $query  = $this->db->query("select a.ro_no,a.ro_dt,a.invoice_no,a.invoice_dt,a.qty,a.retlr_margin,a.less_adj_amt,
                                        a.spl_rebt,a.rbt_add,a.rbt_less,a.rnd_of_add,a.rnd_of_less,b.qty_per_bag,
                                        b.unit,a.stock_qty,a.rate,a.base_price,a.no_of_bags,a.cgst,a.sgst,a.tot_amt,
                                        c.short_name,b.PROD_DESC,a.trad_margin,a.oth_dis,a.frt_subsidy,d.soc_name
                                        from td_purchase a,mm_product b,mm_company_dtls c,mm_ferti_soc d
                                        where  a.prod_id = b.PROD_ID
                                        and    a.comp_id = c.COMP_ID
                                        and    a.stock_point=d.soc_id
                                        and    a.br        = '$branch'
                                        and    a.trans_dt between '$frmDt' and '$toDt'
                                        and    a.trans_flag = 1
                                        order by  c.short_name, a.ro_dt ");
        return $query->result();
    }

    public function f_get_sales($branch, $frmDt, $toDt)
    {
        $query  = $this->db->query("select a.trans_do,a.do_dt,a.trans_type,a.sale_ro,a.qty,a.soc_id,b.unit,b.qty_per_bag,
                                               a.sale_rt,a.taxable_amt,a.cgst,a.sgst,a.dis,a.tot_amt,c.short_name,b.PROD_DESC

                                        from td_sale a,mm_product b,mm_company_dtls c
                                        where  a.prod_id = b.PROD_ID
                                        and    a.comp_id = c.COMP_ID
                                       
                                        and    a.br_cd   = '$branch'
                                        and    a.do_dt between '$frmDt' and '$toDt'
                                        order by c.short_name, a.do_dt");

        return $query->result();
    }

    public function f_get_crngstreg($branch, $frmDt, $toDt)
    {
        $query  = $this->db->query("SELECT a.do_dt,b.soc_name,b.gstin,a.trans_do,a.taxable_amt,a.cgst,a.sgst,a.tot_amt,c.gst_rt rate 
                                        FROM   td_sale_cancel a ,mm_ferti_soc b,mm_product c
                                        WHERE  a.cnl_flag='CRN'
                                        and    a.soc_id=b.soc_id
                                        and a.prod_id=c.prod_id
                                        and    a.do_dt between '$frmDt' and '$toDt'
                                        order by  a.do_dt");

        return $query->result();
    }

    public function f_get_crngstunreg($branch, $frmDt, $toDt)
    {
        $query  = $this->db->query("SELECT a.do_dt,b.soc_name,b.gstin,a.trans_do,a.taxable_amt,a.cgst,a.sgst,a.tot_amt,c.gst_rt rate 
                                        FROM   td_sale_cancel a ,mm_ferti_soc b,mm_product c
                                        WHERE  a.cnl_flag='INV'
                                        and    a.soc_id=b.soc_id
                                        and    a.prod_id=c.prod_id
                                        and    a.do_dt between '$frmDt' and '$toDt'
                                        order by  a.do_dt");

        return $query->result();
    }



    public function p_soc_wise_sale($all_data)
    {

        try {
            $this->db->reconnect();

            $sql = "CALL `p_soc_wise_sale`(?,?,?,?)";

            $data_w = $this->db->query($sql, $all_data);
            // echo $this->db->last_query();
            // die();
            //              
            $this->db->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $data_w->result();
    }
    /***************************************** */

    public function p_psoc_wise_sale($all_data)
    {

        try {
            $this->db->reconnect();

            $sql = "CALL `p_psoc_wise_sale`(?,?,?,?)";

            $data_w = $this->db->query($sql, $all_data);
            // echo $this->db->last_query();
            // die();
            //              
            $this->db->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $data_w->result();
    }

    /************************Delivery register Society Wise*********** */
    public function p_delivery_reg($frm_dt, $to_dt, $br_cd, $soc_id)
    {

        $query  = $this->db->query("SELECT a.do_dt,a.trans_do,a.prod_id,b.prod_desc,a.sale_ro,a.qty,a.soc_id,c.soc_name,b.unit,b.qty_per_bag,
    (select distinct  paid_id from tdf_payment_recv where sale_invoice_no=a.trans_do and branch_id=$br_cd and soc_id=$soc_id) as paid_id,(select distinct  paid_dt from tdf_payment_recv where sale_invoice_no=a.trans_do and branch_id=$br_cd and soc_id=$soc_id) as paid_dt,
    (select ro_dt from td_purchase where ro_no=a.sale_ro and br=$br_cd) ro_dt,
    (select   ifnull(sum(paid_amt),0) from tdf_payment_recv where sale_invoice_no=a.trans_do and branch_id=$br_cd and soc_id=$soc_id) as paid_amt
    FROM  td_sale a,mm_product b ,mm_ferti_soc c
    WHERE a.prod_id=b.prod_id
    and a.soc_id=c.soc_id
    and a.br_cd=$br_cd and a.soc_id=$soc_id
    and a.do_dt between '$frm_dt' and '$to_dt'");
        return $query->result();
    }
    /*********************************** */

    public function f_br_crnote($frm_dt, $to_dt, $br_cd, $comp_id, $catg)
    {


        $query  = $this->db->query(" Select a.trans_dt,e.ro_dt,a.ro,a.tot_amt,f.comp_name,g.cat_desc,h.district_name,b.soc_name,a.comp_adjflag
FROM tdf_dr_cr_note a ,td_purchase e,mm_company_dtls f,mm_cr_note_category g,md_district h,mm_ferti_soc b
 WHERE  a.ro=e.ro_no
 and a.soc_id=b.soc_id
and a.catg=$catg
and a.branch_id=$br_cd
and a.branch_id=h.district_code
and a.comp_id=f.comp_id
and a.catg=g.sl_no
and a.note_type='D'
 and a.fwd_flag='Y' 
and a.trans_flag='R'
and a.comp_adjflag='N'
and a.comp_id=$comp_id
and e.ro_dt between '$frm_dt' and '$to_dt'");

        return $query->result();
    }



    /*********************************** */
    /*************************************************************************** */
    public function f_adj_crnote_rep($frm_dt, $to_dt, $br_cd, $comp_id, $catg)
    {


        $query  = $this->db->query(" Select a.trans_dt,e.ro_dt,a.ro,a.tot_amt,f.comp_name,g.cat_desc,h.district_name,b.soc_name,a.comp_adjflag
FROM tdf_dr_cr_note a ,td_purchase e,mm_company_dtls f,mm_cr_note_category g,md_district h,mm_ferti_soc b
 WHERE  a.ro=e.ro_no
 and a.soc_id=b.soc_id
and a.catg=$catg
and a.branch_id=$br_cd
and a.branch_id=h.district_code
and a.comp_id=f.comp_id
and a.catg=g.sl_no
and a.note_type='D'
 and a.fwd_flag='Y' 
and a.trans_flag='R'
and a.comp_adjflag='Y'
and a.comp_id=$comp_id
and e.ro_dt between '$frm_dt' and '$to_dt'");

        return $query->result();
    }
    /****************************/
    public function f_cr_rep_ho($comp_id, $frm_dt, $to_dt)
    {


        $query  = $this->db->query(" Select a.trans_dt,a.ro,a.tot_amt,f.comp_name,g.cat_desc,h.district_name,a.comp_adjflag,a.catg
FROM tdf_dr_cr_note a ,mm_company_dtls f,mm_cr_note_category g,md_district h
 WHERE   a.branch_id=h.district_code
and a.comp_id=f.comp_id
and a.catg=g.sl_no
and a.note_type='C'
 and a.fwd_flag='N' 
and a.trans_flag='R'
and a.comp_adjflag='N'
and a.comp_id=$comp_id
and a.trans_dt between '$frm_dt' and '$to_dt'");

        return $query->result();
    }


    /*********************************** */
    public function f_crsumm_rep_ho($frm_dt, $to_dt)
    {

        $query  = $this->db->query(" Select sum(a.tot_amt)tot_amt,f.comp_name,h.district_name
FROM tdf_dr_cr_note a ,mm_company_dtls f,mm_cr_note_category g,md_district h
WHERE   a.branch_id=h.district_code
and a.comp_id=f.comp_id
and a.catg=g.sl_no
and a.note_type='D'
and a.fwd_flag='Y' 
and a.trans_flag='R'
and a.comp_adjflag='N'
and a.trans_dt between '$frm_dt' and '$to_dt'
group by f.comp_name,h.district_name
order by h.district_name,f.comp_name,a.trans_dt");

        return $query->result();
    }

    /*************Delivery Register Comapny Wise*********************/
    public function p_delivery_reg_compwse($frm_dt, $to_dt, $br_cd, $comp_id)
    {

        /* $query  = $this->db->query("SELECT a.do_dt,a.trans_do,a.prod_id,b.prod_desc,a.sale_ro,a.qty,a.soc_id,c.soc_name,d.short_name,b.unit,b.qty_per_bag,
    (select distinct  paid_id from tdf_payment_recv where sale_invoice_no=a.trans_do and branch_id=$br_cd and comp_id=$comp_id and soc_id=a.soc_id ) as paid_id,
    (select distinct  paid_dt from tdf_payment_recv where sale_invoice_no=a.trans_do and branch_id=$br_cd and comp_id=$comp_id and soc_id=a.soc_id ) as paid_dt,
    (select distinct ro_dt from td_purchase where ro_no=a.sale_ro and br=$br_cd and comp_id=$comp_id) ro_dt,
    (select   sum(paid_amt) from tdf_payment_recv where sale_invoice_no=a.trans_do and branch_id=$br_cd and comp_id=$comp_id and soc_id=a.soc_id) as paid_amt
    FROM  td_sale a,mm_product b ,mm_ferti_soc c,mm_company_dtls d
    WHERE a.prod_id=b.prod_id
    and a.soc_id=c.soc_id
    and a.comp_id=d.comp_id
    and a.br_cd=$br_cd and a.comp_id=$comp_id
    and a.do_dt between '$frm_dt' and '$to_dt'");*/
        $query  = $this->db->query("SELECT a.do_dt,a.trans_do,a.prod_id,b.prod_desc,a.sale_ro,a.qty,a.soc_id,c.soc_name,d.short_name,b.unit,b.qty_per_bag,
   (select distinct  paid_dt from tdf_payment_recv where sale_invoice_no=a.trans_do and branch_id=$br_cd and comp_id=$comp_id and soc_id=a.soc_id limit 1) as paid_dt,
   (select distinct ro_dt from td_purchase where ro_no=a.sale_ro and br=$br_cd and comp_id=$comp_id) ro_dt,
    (select   sum(paid_amt) from tdf_payment_recv where sale_invoice_no=a.trans_do and branch_id=$br_cd and comp_id=$comp_id and soc_id=a.soc_id) as paid_amt
    FROM  td_sale a,mm_product b ,mm_ferti_soc c,mm_company_dtls d
    WHERE a.prod_id=b.prod_id
    and a.soc_id=c.soc_id
    and a.comp_id=d.comp_id
    and a.br_cd=$br_cd and a.comp_id=$comp_id
    and a.do_dt between '$frm_dt' and '$to_dt'");
        return $query->result();
    }

    /*********************************** */

    public function p_ro_wise_soc_stk($all_data)
    {

        try {
            $this->db->reconnect();

            $sql = "CALL `p_ro_wise_soc_stk`(?,?,?)";

            $data_w = $this->db->query($sql, $all_data);
            // echo $this->db->last_query();
            // die();
            //              
            $this->db->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $data_w->result();
    }

    /********************************** */


    public function p_ro_wise_prof_calc($fdate, $tdate, $comp, $branchId)
    {

        //     try {
        //         $this->db->reconnect();

        //         $sql = "CALL `p_ro_wise_prof_calc`(?,?,?)";

        //         $data_w = $this->db->query($sql,$all_data); 
        // // echo $this->db->last_query();
        // // die();
        // //              
        //         $this->db->close();


        //     } catch (Exception $e) {
        //         echo $e->getMessage();
        //     }

        $q = $this->db->query('SELECT c.short_name comp_name,
d.prod_desc,
a.ro_no,
a.ro_dt,
round(a.tot_amt /a.qty,3) as rate,
a.tot_amt as pur_net_amt,
a.qty qty,
sum(b.qty)as sale_qty,
d.unit,
d.qty_per_bag qty_per_bag,
b.sale_rt,
sum(b.round_tot_amt)sale_amt,
sum(b.round_tot_amt) - a.tot_amt as profit,
round((round(sum(b.round_tot_amt)/sum(b.qty),2)- round(a.tot_amt /a.qty,3))*sum(b.qty),2) pro,
round(sum(b.round_tot_amt)/sum(b.qty),2)rt_gst,
(a.qty- sum(b.qty))*round(a.tot_amt /a.qty,3) as unsold
FROM td_purchase a ,td_sale b,mm_company_dtls c,mm_product d
WHERE a.ro_no=b.sale_ro
and a.comp_id=b.comp_id
and a.prod_id=b.prod_id
and a.comp_id=c.comp_id
and a.prod_id=d.prod_id
and a.ro_dt between "' . $fdate . '" and "' . $tdate . '"
and a.comp_id = ' . $comp . '
and a.br=' . $branchId . '
group by c.comp_name,d.prod_desc,a.ro_no,a.ro_dt,round(a.tot_amt /a.qty,3),a.tot_amt,a.qty,d.unit,d.qty_per_bag,b.sale_rt
UNION
SELECT c.short_name comp_name,
d.prod_desc,
a.ro_no,
a.ro_dt,
round(a.tot_amt /a.qty,3)  as rate,
a.tot_amt as pur_net_amt,
a.qty qty,
0 sale_qty,
d.unit,
d.qty_per_bag qty_per_bag,
0 sale_rt,
0 sale_amt,
0 as profit,
0 pro,
0 rt_gst,
a.tot_amt as unsold
FROM td_purchase a, mm_company_dtls c,mm_product d
WHERE a.comp_id=c.COMP_ID
and a.prod_id=d.PROD_ID
and a.ro_dt between "' . $fdate . '" and "' . $tdate . '"
and a.comp_id = ' . $comp . '
and a.br=' . $branchId . '
and a.ro_no not in (select sale_ro from td_sale 
             where do_dt between "' . $fdate . '" and "' . $tdate . '"
             and   comp_id = ' . $comp . ')');

        return $q->result();


        //;


    }
    /************************************************ */
    public function p_ro_wise_prof_calc_all($fdate, $tdate, $comp)
    {

        //     try {
        //         $this->db->reconnect();

        //         $sql = "CALL `p_ro_wise_prof_calc_all`(?,?)";

        //         $data_w = $this->db->query($sql,$all_data); 
        // // echo $this->db->last_query();
        // // die();
        // //              
        //         $this->db->close();


        //     } catch (Exception $e) {
        //         echo $e->getMessage();
        //     }


        $q = $this->db->query('SELECT c.short_name comp_name,
    d.prod_desc,
    a.ro_no,
    a.ro_dt,
    round(a.tot_amt /a.qty,3) as rate,
    a.tot_amt as pur_net_amt,
    a.qty qty,
    sum(b.qty)as sale_qty,
    d.unit,
    d.qty_per_bag qty_per_bag,
    b.sale_rt,
    sum(b.round_tot_amt)sale_amt,
    sum(b.round_tot_amt) - a.tot_amt as profit,
    round((round(sum(b.round_tot_amt)/sum(b.qty),2)- round(a.tot_amt /a.qty,3))*sum(b.qty),2) pro,
    round(sum(b.round_tot_amt)/sum(b.qty),2)rt_gst,
    (a.qty- sum(b.qty))*round(a.tot_amt /a.qty,3) as unsold
FROM td_purchase a ,td_sale b,mm_company_dtls c,mm_product d
WHERE a.ro_no=b.sale_ro
and a.comp_id=b.comp_id
and a.prod_id=b.prod_id
and a.comp_id=c.comp_id
and a.prod_id=d.prod_id
and a.ro_dt between "' . $fdate . '" and "' . $tdate . '"
and a.comp_id = ' . $comp . '
group by c.comp_name,d.prod_desc,a.ro_no,a.ro_dt,round(a.tot_amt /a.qty,3),a.tot_amt,a.qty,d.unit,d.qty_per_bag,b.sale_rt
UNION
SELECT c.short_name comp_name,
    d.prod_desc,
    a.ro_no,
    a.ro_dt,
    round(a.tot_amt /a.qty,3)  as rate,
    a.tot_amt as pur_net_amt,
    a.qty qty,
    0 sale_qty,
    d.unit,
    d.qty_per_bag qty_per_bag,
    0 sale_rt,
    0 sale_amt,
    0 as profit,
    0 pro,
    0 rt_gst,
    a.tot_amt as unsold
FROM td_purchase a, mm_company_dtls c,mm_product d
WHERE a.comp_id=c.COMP_ID
and a.prod_id=d.PROD_ID
and a.ro_dt between "' . $fdate . '" and "' . $tdate . '"
and a.comp_id = ' . $comp . '
and a.ro_no not in (select sale_ro from td_sale 
                 where do_dt between "' . $fdate . '" and "' . $tdate . '"
                 and   comp_id = ' . $comp . ')');

        return $q->result();
    }

    public function p_ro_wise_prof_calc_all_comp_pro_dist($fdate, $tdate, $comp, $product_id, $district_id)
    {
        if($district_id != 0 ){
            $q = $this->db->query('SELECT c.short_name comp_name,
            d.prod_desc,
            a.ro_no,
            a.ro_dt,
            round(a.tot_amt /a.qty,3) as rate,
            a.tot_amt as pur_net_amt,
            a.qty qty,
            sum(b.qty)as sale_qty,
            d.unit,
            d.qty_per_bag qty_per_bag,
            b.sale_rt,
            sum(b.round_tot_amt)sale_amt,
            sum(b.round_tot_amt) - a.tot_amt as profit,
            round((round(sum(b.round_tot_amt)/sum(b.qty),2)- round(a.tot_amt /a.qty,3))*sum(b.qty),2) pro,
            round(sum(b.round_tot_amt)/sum(b.qty),2)rt_gst,
            (a.qty- sum(b.qty))*round(a.tot_amt /a.qty,3) as unsold,e.branch_name
        FROM td_purchase a ,td_sale b,mm_company_dtls c,mm_product d,md_branch e
        WHERE a.ro_no=b.sale_ro
        and a.comp_id=b.comp_id
        and a.prod_id=b.prod_id
        and a.comp_id=c.comp_id
        and a.prod_id=d.prod_id

        and a.br=b.br_cd
        and b.br_cd=e.id

        and a.ro_dt between "' . $fdate . '" and "' . $tdate . '"
        and a.comp_id = ' . $comp . '
        and a.prod_id = ' . $product_id . '
        and a.br = ' . $district_id . '
        group by c.comp_name,d.prod_desc,a.ro_no,a.ro_dt,round(a.tot_amt /a.qty,3),a.tot_amt,a.qty,d.unit,d.qty_per_bag,b.sale_rt,e.branch_name
        UNION
        SELECT c.short_name comp_name,
            d.prod_desc,
            a.ro_no,
            a.ro_dt,
            round(a.tot_amt /a.qty,3)  as rate,
            a.tot_amt as pur_net_amt,
            a.qty qty,
            0 sale_qty,
            d.unit,
            d.qty_per_bag qty_per_bag,
            0 sale_rt,
            0 sale_amt,
            0 as profit,
            0 pro,
            0 rt_gst,
            a.tot_amt as unsold,e.branch_name
        FROM td_purchase a, mm_company_dtls c,mm_product d,md_branch e
        WHERE a.comp_id=c.COMP_ID
        and a.prod_id=d.PROD_ID
        and a.br=e.id
        and a.ro_dt between "' . $fdate . '" and "' . $tdate . '"
        and a.comp_id = ' . $comp . '
        and a.prod_id = ' . $product_id . '
        and a.br = ' . $district_id . '
        and a.ro_no not in (select sale_ro from td_sale 
                         where do_dt between "' . $fdate . '" and "' . $tdate . '"
                         and   comp_id = ' . $comp . ')');
        }else{
            $q = $this->db->query('SELECT c.short_name comp_name,
        d.prod_desc,
        a.ro_no,
        a.ro_dt,
        round(a.tot_amt /a.qty,3) as rate,
        a.tot_amt as pur_net_amt,
        a.qty qty,
        sum(b.qty)as sale_qty,
        d.unit,
        d.qty_per_bag qty_per_bag,
        b.sale_rt,
        sum(b.round_tot_amt)sale_amt,
        sum(b.round_tot_amt) - a.tot_amt as profit,
        round((round(sum(b.round_tot_amt)/sum(b.qty),2)- round(a.tot_amt /a.qty,3))*sum(b.qty),2) pro,
        round(sum(b.round_tot_amt)/sum(b.qty),2)rt_gst,
        (a.qty- sum(b.qty))*round(a.tot_amt /a.qty,3) as unsold,e.branch_name
    FROM td_purchase a ,td_sale b,mm_company_dtls c,mm_product d,md_branch e
    WHERE a.ro_no=b.sale_ro
    and a.comp_id=b.comp_id
    and a.prod_id=b.prod_id
    and a.comp_id=c.comp_id
    and a.prod_id=d.prod_id
    and a.br=b.br_cd
    and b.br_cd=e.id
    and a.ro_dt between "' . $fdate . '" and "' . $tdate . '"
    and a.comp_id = ' . $comp . '
    and a.prod_id = ' . $product_id . '
    group by c.comp_name,d.prod_desc,a.ro_no,a.ro_dt,round(a.tot_amt /a.qty,3),a.tot_amt,a.qty,d.unit,d.qty_per_bag,b.sale_rt,e.branch_name
    UNION
    SELECT c.short_name comp_name,
        d.prod_desc,
        a.ro_no,
        a.ro_dt,
        round(a.tot_amt /a.qty,3)  as rate,
        a.tot_amt as pur_net_amt,
        a.qty qty,
        0 sale_qty,
        d.unit,
        d.qty_per_bag qty_per_bag,
        0 sale_rt,
        0 sale_amt,
        0 as profit,
        0 pro,
        0 rt_gst,
        a.tot_amt as unsold,e.branch_name
    FROM td_purchase a, mm_company_dtls c,mm_product d,md_branch e
    WHERE a.comp_id=c.COMP_ID
    and a.prod_id=d.PROD_ID
    and a.br=e.id
    and a.ro_dt between "' . $fdate . '" and "' . $tdate . '"
    and a.comp_id = ' . $comp . '
    and a.prod_id = ' . $product_id . '
    and a.ro_no not in (select sale_ro from td_sale 
                     where do_dt between "' . $fdate . '" and "' . $tdate . '"
                     and   comp_id = ' . $comp . ')');
        }
        

        return $q->result();
    }



    /************************************************ */
    public function p_sale_purchase($all_data)
    {

        try {
            $this->db->reconnect();

            $sql = "CALL `p_sale_purchase`(?,?,?,?)";

            $data_w = $this->db->query($sql, $all_data);
            // echo $this->db->last_query();
            // die();        
            $this->db->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $data_w->result();
    }




    public function p_soc_wse_sale_purchase($all_data)
    {

        try {
            $this->db->reconnect();

            $sql = "CALL `p_soc_wse_sale_purchase`(?,?,?,?,?,?)";

            $data_x = $this->db->query($sql, $all_data);
            // echo $this->db->last_query();
            // die();
            $this->db->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $data_x->result();
    }

    public function p_ro_wise_soc_ro($from_dt, $to_dt, $branch)
    {
        $sql = "select a.ro_no,a.ro_dt,b.comp_name,c.prod_desc ,c.unit,sum(c.qty_per_bag)qty_per_bag,sum(a.net_amt)tot_net ,sum(a.qty)tot_qty
            from td_purchase a,mm_company_dtls b,mm_product c,mm_unit d
            where a.comp_id=b.comp_id
            and a.prod_id=c.prod_id
            and c.unit=d.id
            and a.trans_dt >= '$from_dt' AND a.trans_dt <= '$to_dt' AND a.br ='$branch'
            group by a.ro_no,a.ro_dt,b.comp_name,c.prod_desc order by a.ro_no,c.unit";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function s_ro_wise_soc_ro($from_dt, $to_dt, $branch)
    {
        $sql = "select a.sale_ro,b.soc_name,sum(a.qty)tot_qty,ifnull(sum(a.round_tot_amt),0)tot_amt 
            from td_sale a,mm_ferti_soc b
            where a.soc_id=b.soc_id
            and a.do_dt >= '$from_dt' AND a.do_dt <= '$to_dt' AND a.br_cd ='$branch'  group by a.sale_ro,b.soc_name ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function f_get_soc_ledger($frmDt, $toDt, $branch, $soc_id)
    {
        $sql = "select  trans_dt,prod,inv_no, soc_id,soc_name,sum(paid_amt) as tot_paid,sum(paybl) as tot_payble,sum(cgst)cgst,sum(sgst)sgst,ro_no,ro_dt,sum(qty) qty ,sum(tot_recv) tot_recv,remarks
        from( 
          SELECT c.op_dt as trans_dt,'' prod,'' as inv_no, c.soc_id soc_id,b.soc_name,if(sum(c.balance)<0,
          sum(c.balance),0) as paid_amt,
          0 paybl,0 cgst,0 sgst,''ro_no,'' as ro_dt,0 as qty,
            if(sum(c.balance)>0,sum(c.balance),0) tot_recv ,'Opening' remarks
            FROM td_soc_opening c,mm_ferti_soc b 
            where c.soc_id=b.soc_id 
            and c.soc_id = '$soc_id'
            and c.br_cd='$branch' 
            and c.op_dt='$frmDt'
            union
            SELECT paid_dt,'' prod,c.paid_id  as inv_no, c.soc_id soc_id,soc_name,0 as paid_amt,0 paybl,0 cgst,0 sgst,''ro_no,d.ro_dt as ro_dt,0 as qty,
            sum(c.paid_amt) tot_recv ,'Cheque Adj' remarks
            FROM tdf_payment_recv c,mm_ferti_soc b,td_purchase d where c.soc_id=b.soc_id and c.soc_id = '$soc_id'
            and c.branch_id='$branch' and c.ro_no = d.ro_no
            and c.pay_type=3 
            and c.paid_dt between '$frmDt' and '$toDt' group by soc_name,c.soc_id,c.paid_id,d.ro_dt,paid_dt
            union
             SELECT paid_dt,'' prod,c.paid_id  as inv_no, c.soc_id soc_id,soc_name,0 as paid_amt,0 paybl,0,0,'' ro_no,d.ro_dt as ro_dt,0 as qty ,sum(c.paid_amt) tot_recv , 'Draft Adj' remarks
             FROM tdf_payment_recv c,mm_ferti_soc b,td_purchase d where c.soc_id=b.soc_id and c.soc_id = '$soc_id'and c.branch_id='$branch' and c.ro_no = d.ro_no 
             and c.pay_type=4 
             and c.paid_dt between '$frmDt' and '$toDt' group by soc_name,c.soc_id,c.paid_id,d.ro_dt,paid_dt
             union
             SELECT paid_dt,'' prod,c.paid_id  as inv_no, c.soc_id soc_id,soc_name,0 as paid_amt,0 paybl,0,0,'' as ro_no,d.ro_dt as ro_dt,0 as qty,sum(c.paid_amt) tot_recv ,'Pay Order Adj' remarks
             FROM tdf_payment_recv c,mm_ferti_soc b,td_purchase d where c.soc_id=b.soc_id and c.soc_id = '$soc_id'and c.branch_id='$branch' and c.ro_no = d.ro_no and c.pay_type=5 and c.paid_dt between '$frmDt' and '$toDt' group by soc_name,c.soc_id,c.paid_id,d.ro_dt,paid_dt
             union
             SELECT paid_dt,'' prod,c.paid_id as inv_no, c.soc_id soc_id,soc_name,0 as paid_amt,0 paybl,0,0,'' ro_no,d.ro_dt as ro_dt,0 as qty ,sum(c.paid_amt) tot_recv ,'NEFT Adj' remarks
             FROM tdf_payment_recv c,mm_ferti_soc b,td_purchase d where c.soc_id=b.soc_id and c.soc_id = '$soc_id'and c.branch_id='$branch' and c.ro_no = d.ro_no and c.pay_type=7 and c.paid_dt between '$frmDt' and '$toDt' group by soc_name,c.soc_id,c.paid_id,d.ro_dt,paid_dt
             union
             SELECT paid_dt,'' prod,c.paid_id as inv_no, c.soc_id soc_id,soc_name,0 as paid_amt,0 paybl,0,0,'' ro_no,d.ro_dt as ro_dt,0 as qty ,sum(c.paid_amt) tot_recv ,'Net Banking' remarks
             FROM tdf_payment_recv c,mm_ferti_soc b,td_purchase d where c.soc_id=b.soc_id and c.soc_id = '$soc_id'and c.branch_id='$branch' and c.ro_no = d.ro_no and c.pay_type=8 and c.paid_dt between '$frmDt' and '$toDt' group by soc_name,c.soc_id,c.paid_id,d.ro_dt,paid_dt
             union
         SELECT trans_dt,'' prod,recpt_no as inv_no, c.soc_id soc_id,soc_name,sum(c.tot_amt) as paid_amt,0 paybl,0,0,c.ro as ro_no,trans_dt as ro_dt,0 as qty ,0,'Cr note' remarks
            FROM tdf_dr_cr_note c,mm_ferti_soc b,td_sale d where c.soc_id=b.soc_id and c.soc_id = '$soc_id'and c.branch_id='$branch' and c.invoice_no = d.trans_do and c.trans_flag='R' and c.trans_dt between '$frmDt' and '$toDt' 
            group by trans_dt, recpt_no,c.soc_id ,soc_id,soc_name,c.ro
            union
         SELECT trans_dt,'' prod,receipt_no as inv_no, c.soc_id soc_id,soc_name,c.adv_amt as paid_amt,0 paybl,0,0,''as ro_no,trans_dt as ro_dt,0 as qty ,0,'Advance' remarks
            FROM tdf_advance c,mm_ferti_soc b where c.soc_id=b.soc_id 
            and c.soc_id = '$soc_id'
            and c.branch_id='$branch' 
            and c.trans_type='I' 
            and c.trans_dt between '$frmDt' and '$toDt'
         union
         SELECT c.do_dt,e.prod_desc prod,c.trans_do as inv_no, c.soc_id,b.soc_name,0 tot_paid ,c.taxable_amt as tot_payble,c.cgst ,c.sgst,c.sale_ro,d.ro_dt,c.qty ,0,'Sale' remarks
            FROM mm_ferti_soc b ,td_sale c,td_purchase d ,mm_product e
            where c.br_cd=b.district and c.br_cd='$branch' 
            and c.soc_id=b.soc_id and b.soc_id = '$soc_id'
            and c.sale_ro = d.ro_no and c.do_dt between '$frmDt' and '$toDt' 
            and c.prod_id=e.prod_id
            Union
            SELECT trans_dt,'' prod,recpt_no as inv_no, c.soc_id soc_id,soc_name,sum(a.tot_amt) as paid_amt,0 paybl,0,0,ro as ro_no,trans_dt as ro_dt,0 as qty ,0,'Cr note' remarks
     FROM tdf_dr_cr_note a ,mm_ferti_soc  c
     WHERE a.branch_id = $branch and a.remarks like '%MIGATED%' and recpt_no like '%YRLY%' 
     and a.soc_id=c.soc_id
     and a.soc_id = '$soc_id'
     and trans_dt between '$frmDt' and '$toDt'
            Union
            SELECT MAX(trans_dt),'' prod,'' as inv_no, c.soc_id soc_id,soc_name,0 as paid_amt,sum(c.tot_amt),0,0,''as ro_no,trans_dt as ro_dt,0 as qty ,0,'TCS' remarks
         FROM drnote_tcs c,mm_ferti_soc b
         where c.soc_id=b.soc_id
         and c.soc_id = '$soc_id'
         and c.branch_id='$branch'
         and c.trans_dt between '$frmDt' and '$toDt'
         and c.trans_dt and c.tot_amt>0
           )a
            group by soc_id,soc_name,ro_no,ro_dt,inv_no 
            ORDER BY a.trans_dt,a.inv_no";
        $query  = $this->db->query($sql);
        //ORDER BY `a`.`trans_dt`");
        return $query->result();
    }

    public function f_get_allsoc_pay($frmDt, $toDt, $comp_id)
    {

        $query  = $this->db->query("select e.short_name,a.ro_no,c.district_name,a.paid_dt,b.soc_name,
								sum(a.paid_amt)tot_paid,sum(a.net_recvble_amt)tot_payble
								from tdf_payment_recv a,mm_ferti_soc b,md_district c,mm_company_dtls e
								where a.soc_id=b.soc_id
								and b.district=c.district_code
								and a.comp_id=$comp_id
								and a.comp_id=e.comp_id
								and a.paid_dt between '$frmDt' and '$toDt'
								and a.approval_status='A'
								and a.net_recvble_amt>0
								group by c.district_name,a.paid_dt,b.soc_name,a.ro_no
								order by c.district_name,a.paid_dt");
        return $query->result();
    }

    public function f_get_stockpoint($ro)
    {

        $query  = $this->db->query("select   b.soc_name as soc_name,a.ro_no,d.unit_name,c.unit,c.QTY_PER_BAG
                                        from  td_purchase a ,mm_ferti_soc b,mm_product c,mm_unit d
                                        where  a.stock_point=b.soc_id 
                                        and a.prod_id=c.prod_id
                                        and c.unit=d.id
                                        and  a.ro_no='$ro'");
        return $query->row();
    }

    public function f_get_soc_paid($frmDt, $toDt, $branch)
    {
        $query  = $this->db->query("
                                        SELECT a.soc_id,b.soc_name,sum(a.paid_amt)tot_paid 
                                        FROM `tdf_payment_recv`a ,mm_ferti_soc b 
                                        where a.branch_id=b.district 
                                        and a.branch_id=$branch
                                        and a.soc_id=b.soc_id 
                                        and a.paid_dt between '$frmDt' and '$toDt'
                                        group by b.soc_name,a.soc_id ");

        return $query->result();
    }



    public function f_get_allsoc_paid($frmDt, $toDt)
    {
        $query  = $this->db->query("
                                        SELECT a.soc_id,b.soc_name,sum(a.paid_amt)tot_paid 
                                        FROM `tdf_payment_recv`a ,mm_ferti_soc b 
                                        where a.branch_id=b.district 
                                       
                                        and a.soc_id=b.soc_id 
                                        and a.paid_dt between '$frmDt' and '$toDt'
                                        group by b.soc_name,a.soc_id ");

        return $query->result();
    }

    public function f_get_sales_society($branch, $frmDt, $toDt, $soc_id)
    {
        $query  = $this->db->query("select a.trans_do,a.do_dt,a.trans_type,a.sale_ro,a.qty,a.soc_id,d.soc_name,
                                               a.sale_rt,a.taxable_amt taxable_amt,a.cgst,a.sgst,a.dis,a.tot_amt,c.short_name,b.PROD_DESC

                                        from td_sale a,mm_product b,mm_company_dtls c,mm_ferti_soc d
                                        where  a.prod_id = b.PROD_ID
                                        and    a.comp_id = c.COMP_ID
                                        and    a.stock_point  = '$soc_id'
                                        and    a.br_cd   = '$branch'
                                        and    a.stock_point  = d.soc_id
                                        and    a.do_dt between '$frmDt' and '$toDt'
                                        ");

        return $query->result();
    }

    public function get_fersociety_name($soc_id)
    {

        $sql = "select soc_name
			     from mm_ferti_soc where soc_id = '$soc_id' order by  soc_name";

        $result = $this->db->query($sql);

        return $result->row();
    }
    public function get_comp_name($comp_id)
    {

        $sql = "select comp_name
         from mm_company_dtls where comp_id = '$comp_id' order by  comp_name";

        $result = $this->db->query($sql);

        return $result->row();
    }
    public function f_get_sales_branch($frmDt, $toDt, $br,$comp_id)
    {
        if($br > 0){
            $branch = 'and a.br_cd = '.$br;
        }else{
            $branch = ''; 
        }
        if($comp_id > 0){
            $company = 'and a.comp_id = '.$comp_id;
        }else{
            $company = ''; 
        }

        // $query  = $this->db->query("select a.trans_do,a.do_dt,a.trans_type,a.sale_ro,a.qty,a.soc_id,d.soc_name,b.unit,b.qty_per_bag,
        //                                 a.sale_rt,a.taxable_amt,a.cgst,a.sgst,a.dis,a.tot_amt,c.short_name,b.PROD_DESC
        //                                 from td_sale a,mm_product b,mm_company_dtls c,mm_ferti_soc d
        //                                 where  a.prod_id = b.PROD_ID
        //                                 and    a.comp_id = c.COMP_ID
        //                                 and a.soc_id=d.soc_id
        //                                 $branch  $company 
        //                                 and    a.do_dt between '$frmDt' and '$toDt'
        //                                 order by a.do_dt");
        $query  = $this->db->query("select a.trans_do,a.do_dt,a.trans_type,a.sale_ro,a.qty,a.soc_id,d.soc_name,b.unit,b.qty_per_bag, a.sale_rt,a.taxable_amt,a.cgst,a.sgst,a.dis,a.tot_amt,c.short_name,b.PROD_DESC, 
        sum((select sum(x.tot_amt) from tdf_dr_cr_note x where a.trans_do=x.invoice_no and catg=1 and remarks!='CRN' ))cash_dis,
        sum((select sum(x.tot_amt) from tdf_dr_cr_note x where a.trans_do=x.invoice_no and catg=2 and remarks!='CRN' ))dis,
        sum((select sum(x.tot_amt) from tdf_dr_cr_note x where a.trans_do=x.invoice_no and catg=3 and remarks!='CRN'))trans_sub,
        sum((select sum(x.tot_amt) from tdf_dr_cr_note x where a.trans_do=x.invoice_no and catg=4 and remarks!='CRN'))spl_rbt,
        sum((select sum(x.tot_amt) from tdf_dr_cr_note x where a.trans_do=x.invoice_no and catg=5 and remarks!='CRN'))prce_prot,
        sum((select sum(x.tot_amt) from tdf_dr_cr_note x where a.trans_do=x.invoice_no and catg=6 and remarks!='CRN'))qty_rbt,
        sum((select sum(x.tot_amt) from tdf_dr_cr_note x where a.trans_do=x.invoice_no and catg=8 and remarks!='CRN'))rail_dis,
        sum((select sum(x.tot_amt) from tdf_dr_cr_note x where a.trans_do=x.invoice_no and catg=9 and remarks!='CRN'))matrix,
        sum((select sum(x.tot_amt) from tdf_dr_cr_note x where a.trans_do=x.invoice_no and catg=10 and remarks!='CRN'))gst_tds,
        sum((select sum(x.tot_amt) from tdf_dr_cr_note x where a.trans_do=x.invoice_no and catg=11 and remarks!='CRN'))trans_hanl,
        sum((select sum(x.tot_amt) from tdf_dr_cr_note x where a.trans_do=x.invoice_no and catg=12 and remarks!='CRN'))rbt_sbs
        from td_sale a,mm_product b,mm_company_dtls c,mm_ferti_soc d 
        where a.prod_id = b.PROD_ID and a.comp_id = c.COMP_ID and a.soc_id=d.soc_id 
        $branch  $company
        and a.do_dt between '$frmDt' and '$toDt' 
        group by a.trans_do,a.do_dt,a.trans_type,a.sale_ro,a.qty,a.soc_id,d.soc_name,b.unit,b.qty_per_bag, a.sale_rt,a.taxable_amt,a.cgst,a.sgst,a.dis,a.tot_amt,c.short_name,b.PROD_DESC") ;                               

        return $query->result();
    }

    public function f_get_stock_stockwise($branch, $toDt)
    {

        $data = $this->db->query("select a.prod_id,a.stock_point,sum(a.qty) as qty,a.soc_name,b.COMP_NAME,c.unit
                                       from(select a.prod_id as prod_id,a.comp_id as comp_id,a.stock_point as stock_point,ifnull(sum(a.qty),0) as qty, b.soc_name as soc_name 
                                           from td_purchase a,mm_ferti_soc b where a.stock_point = b.soc_id and a.trans_dt <='$toDt' and a.br = '$branch' 
                                           group by a.stock_point,b.soc_name,a.prod_id,a.comp_id 
                                           UNION 
                                           select a.prod_id as prod_id,a.comp_id as comp_id,a.stock_point as stock_point,ifnull(sum(a.qty),0)*-1 as qty , b.soc_name as soc_name 
                                           from td_sale a,mm_ferti_soc b 
                                           where a.stock_point = b.soc_id 
                                           and a.br_cd = '$branch' and a.do_dt<='$toDt' 
                                           group by a.stock_point,b.soc_name,a.prod_id,a.comp_id)a,mm_company_dtls b,mm_product c
                                           where a.comp_id = b.COMP_ID
                                           and a.prod_id=c.prod_id
                                           and a.qty>0
                                           group by a.prod_id,a.stock_point,a.soc_name,b.COMP_NAME
                                           order by a.soc_name");

        if ($data->num_rows() > 0) {
            $row = $data->result();
        } else {
            $row = 0;
        }
        return $row;
    }


    public function totalAdvVoucher($comp_id, $frm_date, $to_date, $memoNumber)
    {
        if ($memoNumber == null) {


            $q = $this->db->query("SELECT SUM( adv_amt)adv_amt ,SUM(tds)tds ,SUM(net_amt)net_amt FROM 
            (select IfNULL(sum(a.adv_amt),0)adv_amt,IfNULL((sum(a.adv_amt)*.001),0) as tds,IfNULL(sum(a.adv_amt)-(sum(a.adv_amt)*.001),0) as net_amt
                        from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d
                        where c.branch_id = b.id
                        and   a.adv_dtl_id = c.receipt_no
                        and   a.adv_receive_no = c.detail_receipt_no
                        and   c.prod_id = d.PROD_ID
                        and   a.trans_dt between '$frm_date' and '$to_date'
                        and   a.comp_id = '$comp_id'
                        and   c.comp_pay_flag = 'Y'
                        
                        UNION
                  select IfNULL(sum(a.adv_amt),0)adv_amt,IfNULL((sum(a.adv_amt)*.001),0) as tds,IfNULL(sum(a.adv_amt)-(sum(a.adv_amt)*.001),0) as net_amt
                 
                                    from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d,tdf_adv_fwd e
                                    where c.branch_id = b.id
                                    and   a.adv_receive_no = c.detail_receipt_no
                                    and   c.prod_id = d.PROD_ID
                                    and   a.adv_dtl_id = e.fwd_receipt_no
                                    and   c.detail_receipt_no = e.detail_receipt_no
                                    and   a.trans_dt between '$frm_date' and '$to_date'
                                    and   a.comp_id = '$comp_id'
                                    and   e.comp_pay_flag = 'Y')A");
        } else {
            $q = $this->db->query("SELECT SUM( adv_amt)adv_amt ,SUM(tds)tds ,SUM(net_amt)net_amt FROM 
        (select IfNULL(sum(a.adv_amt),0)adv_amt,IfNULL((sum(a.adv_amt)*.001),0) as tds,IfNULL(sum(a.adv_amt)-(sum(a.adv_amt)*.001),0) as net_amt
                    from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d
                    where c.branch_id = b.id
                    and   a.memo_no='$memoNumber'
                    and   a.adv_dtl_id = c.receipt_no
                    and   a.adv_receive_no = c.detail_receipt_no
                    and   c.prod_id = d.PROD_ID
                    and   a.trans_dt between '$frm_date' and '$to_date'
                    and   a.comp_id = '$comp_id'
                    and   c.comp_pay_flag = 'Y'
                    
                    UNION
              select IfNULL(sum(a.adv_amt),0)adv_amt,IfNULL((sum(a.adv_amt)*.001),0) as tds,IfNULL(sum(a.adv_amt)-(sum(a.adv_amt)*.001),0) as net_amt
             
                                from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d,tdf_adv_fwd e
                                where c.branch_id = b.id
                                and   a.memo_no='$memoNumber'
                                and   a.adv_receive_no = c.detail_receipt_no
                                and   c.prod_id = d.PROD_ID
                                and   a.adv_dtl_id = e.fwd_receipt_no
                                and   c.detail_receipt_no = e.detail_receipt_no
                                and   a.trans_dt between '$frm_date' and '$to_date'
                                and   a.comp_id = '$comp_id'
                                and   e.comp_pay_flag = 'Y')A");
        }

        return $q->row();
    }



    public function getallAdvData($comp_id, $frm_date, $to_date, $memoNumber)
    {

        if ($memoNumber == null) {


            $sql = "select e.COMP_NAME as comp_name,c.qty, a.trans_dt,a.receipt_no,a.adv_receive_no,c.branch_id,b.branch_name,c.prod_id,d.PROD_DESC,c.ro_no,c.fo_no,a.adv_amt,
            (select DISTINCT f.fo_number from mm_fo_master f where  c.fo_no=f.fi_id) fo_number ,(select f.fo_name  from mm_fo_master f where  c.fo_no=f.fi_id)fo_name,
			(select DISTINCT j.bank_name from mm_feri_bank j where j.sl_no=a.bank)bnk,
            (select DISTINCT j.branch_name from mm_feri_bank j where j.sl_no=a.bank)bnk_branch_name,
            (select DISTINCT j.ac_no from mm_feri_bank j where j.sl_no=a.bank)ac_no,
            e.bank_name as cbank,e.bnk_branch_name as cbnk_branch_name,e.ac_no as cac_no,
            e.ifsc as cifsc
            from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d,mm_company_dtls e
            where c.branch_id = b.id
            and   a.adv_dtl_id = c.receipt_no
            and   a.adv_receive_no = c.detail_receipt_no
            and   c.prod_id = d.PROD_ID
            and   a.comp_id = e.comp_id
            and   a.trans_dt between '$frm_date' and '$to_date'
            and   a.comp_id = '$comp_id'
            and   c.comp_pay_flag = 'Y'
            
            UNION
            select f.COMP_NAME,c.qty, a.trans_dt,a.receipt_no,a.adv_receive_no,c.branch_id,b.branch_name,c.prod_id,d.PROD_DESC,c.ro_no,c.fo_no,a.adv_amt,
            (select DISTINCT f.fo_number from mm_fo_master f where  c.fo_no=f.fi_id) fo_number ,(select DISTINCT f.fo_name  from mm_fo_master f where  c.fo_no=f.fi_id)fo_name ,
			(select DISTINCT j.bank_name from mm_feri_bank j where j.sl_no=a.bank)bnk,
            (select DISTINCT j.branch_name from mm_feri_bank j where j.sl_no=a.bank)bnk_branch_name,
            (select DISTINCT j.ac_no from mm_feri_bank j where j.sl_no=a.bank)ac_no,
            f.bank_name as cbank,f.bnk_branch_name as cbnk_branch_name,f.ac_no as cac_no,
            f.ifsc as cifsc
                        from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d,tdf_adv_fwd e,mm_company_dtls f
                        where c.branch_id = b.id
                        and   a.adv_receive_no = c.detail_receipt_no
                        and   c.prod_id = d.PROD_ID
                        and   c.comp_id = f.comp_id
                        and   a.adv_dtl_id = e.fwd_receipt_no
                        and   c.detail_receipt_no = e.detail_receipt_no
                        and   a.trans_dt between '$frm_date' and '$to_date'
                        and   a.comp_id = '$comp_id'
                        and   e.comp_pay_flag = 'Y'
                        ";
        } else {


            $sql = "select e.COMP_NAME as comp_name,c.qty, a.trans_dt,a.receipt_no,a.adv_receive_no,c.branch_id,b.branch_name,c.prod_id,d.PROD_DESC,c.ro_no,c.fo_no,a.adv_amt,
            (select DISTINCT f.fo_number from mm_fo_master f where  c.fo_no=f.fi_id) fo_number ,(select DISTINCT f.fo_name  from mm_fo_master f where  c.fo_no=f.fi_id)fo_name,
			(select DISTINCT j.bank_name from mm_feri_bank j where j.sl_no=a.bank)bnk,
            (select DISTINCT j.branch_name from mm_feri_bank j where j.sl_no=a.bank)bnk_branch_name,
            (select DISTINCT j.ac_no from mm_feri_bank j where j.sl_no=a.bank)ac_no,
            e.bank_name as cbank,e.bnk_branch_name as cbnk_branch_name,e.ac_no as cac_no,
            e.ifsc as cifsc
            from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d,mm_company_dtls e
            where c.branch_id = b.id
            and   a.memo_no='$memoNumber'
            and   a.adv_dtl_id = c.receipt_no
            and   a.adv_receive_no = c.detail_receipt_no
            and   c.prod_id = d.PROD_ID
            and   a.comp_id = e.comp_id
            and   a.trans_dt between '$frm_date' and '$to_date'
            and   a.comp_id = '$comp_id'
            and   c.comp_pay_flag = 'Y'
            
            UNION
            select f.COMP_NAME,c.qty, a.trans_dt,a.receipt_no,a.adv_receive_no,c.branch_id,b.branch_name,c.prod_id,d.PROD_DESC,c.ro_no,c.fo_no,a.adv_amt,
            (select DISTINCT f.fo_number from mm_fo_master f where  c.fo_no=f.fi_id) fo_number ,(select DISTINCT f.fo_name  from mm_fo_master f where  c.fo_no=f.fi_id)fo_name ,
			(select DISTINCT j.bank_name from mm_feri_bank j where j.sl_no=a.bank)bnk,
            (select DISTINCT j.branch_name from mm_feri_bank j where j.sl_no=a.bank)bnk_branch_name,
            (select DISTINCT j.ac_no from mm_feri_bank j where j.sl_no=a.bank)ac_no,
            f.bank_name as cbank,f.bnk_branch_name as cbnk_branch_name,f.ac_no as cac_no,
            f.ifsc as cifsc
                        from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d,tdf_adv_fwd e,mm_company_dtls f
                        where c.branch_id = b.id
                        and   a.memo_no='$memoNumber'
                        and   a.adv_receive_no = c.detail_receipt_no
                        and   c.prod_id = d.PROD_ID
                        and   c.comp_id = f.comp_id
                        and   a.adv_dtl_id = e.fwd_receipt_no
                        and   c.detail_receipt_no = e.detail_receipt_no
                        and   a.trans_dt between '$frm_date' and '$to_date'
                        and   a.comp_id = '$comp_id'
                        and   e.comp_pay_flag = 'Y'
                        ";
        }
        $q = $this->db->query($sql);
        return $q->result();
    }



    public function getallAdvData_summary($comp_id, $frm_date, $to_date, $memoNumber)
    {

        if ($memoNumber == null) {

            if($comp_id==1||$comp_id==10||$comp_id==11){


                $sql = "select sum(a.adv_amt)adv_amt,f.COMP_NAME,
                (select DISTINCT f.fo_name  from mm_fo_master f where  c.fo_no=f.fi_id)fo_name,
                (select DISTINCT f.fo_number  from mm_fo_master f where  c.fo_no=f.fi_id)fo_number
                from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d,mm_company_dtls f
                where c.branch_id = b.id
                and   a.adv_dtl_id = c.receipt_no
                and   a.comp_id =f.comp_id
                and   a.adv_receive_no = c.detail_receipt_no
                and   c.prod_id = d.PROD_ID
                and   a.trans_dt between '$frm_date' and '$to_date'
                and   a.comp_id = '$comp_id'
                and   c.comp_pay_flag = 'Y'
                group by fo_name
                UNION
                select sum(a.adv_amt)adv_amt,f.short_name,
                (select DISTINCT f.fo_name  from mm_fo_master f where  c.fo_no=f.fi_id)fo_name,
                (select DISTINCT f.fo_number  from mm_fo_master f where  c.fo_no=f.fi_id)fo_number
                            from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d,tdf_adv_fwd e,mm_company_dtls f
                            where c.branch_id = b.id
                            and   a.adv_receive_no = c.detail_receipt_no
                            and   c.prod_id = d.PROD_ID
                            and   a.adv_dtl_id = e.fwd_receipt_no
                            and   c.detail_receipt_no = e.detail_receipt_no
                            and   a.trans_dt between '$frm_date' and '$to_date'
                            and   a.comp_id = '$comp_id'
                            and   a.comp_id =f.comp_id
                            and   e.comp_pay_flag = 'Y'
                            group by fo_name";

            }else{
                        $sql = "select c.branch_id, b.branch_name,sum(a.adv_amt)adv_amt
                    
                        from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d
                        where c.branch_id = b.id
                        and   a.adv_dtl_id = c.receipt_no
                        and   a.adv_receive_no = c.detail_receipt_no
                        and   c.prod_id = d.PROD_ID
                        and   a.trans_dt between '$frm_date' and '$to_date'
                        and   a.comp_id = '$comp_id'
                        and   c.comp_pay_flag = 'Y'
                        group by b.branch_name,c.branch_id
                        UNION
                        select c.branch_id,b.branch_name,sum(a.adv_amt)adv_amt
                    
                                    from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d,tdf_adv_fwd e
                                    where c.branch_id = b.id
                                    and   a.adv_receive_no = c.detail_receipt_no
                                    and   c.prod_id = d.PROD_ID
                                    and   a.adv_dtl_id = e.fwd_receipt_no
                                    and   c.detail_receipt_no = e.detail_receipt_no
                                    and   a.trans_dt between '$frm_date' and '$to_date'
                                    and   a.comp_id = '$comp_id'
                                    and   e.comp_pay_flag = 'Y'
                                    group by b.branch_name,c.branch_id";

            }
        } else {


            if($comp_id==1||$comp_id==10||$comp_id==11){

                $sql = "select sum(a.adv_amt)adv_amt,f.COMP_NAME,
                (select DISTINCT f.fo_name  from mm_fo_master f where  c.fo_no=f.fi_id)fo_name,
                (select DISTINCT f.fo_number  from mm_fo_master f where  c.fo_no=f.fi_id)fo_number
            from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d,mm_company_dtls f
            where c.branch_id = b.id
            and   a.memo_no='$memoNumber'
            and   a.adv_dtl_id = c.receipt_no
            and   a.adv_receive_no = c.detail_receipt_no
            and   c.prod_id = d.PROD_ID
            and   a.trans_dt between '$frm_date' and '$to_date'
            and   a.comp_id = '$comp_id'
            and   a.comp_id =f.comp_id
            and   c.comp_pay_flag = 'Y'
            group by fo_name
            UNION
            select sum(a.adv_amt)adv_amt,f.short_name,
            (select f.fo_name  from mm_fo_master f where  c.fo_no=f.fi_id)fo_name,
            (select DISTINCT f.fo_number  from mm_fo_master f where  c.fo_no=f.fi_id)fo_number
                        from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d,tdf_adv_fwd e,mm_company_dtls f
                        where c.branch_id = b.id
                        and   a.memo_no='$memoNumber'
                        and   a.adv_receive_no = c.detail_receipt_no
                        and   c.prod_id = d.PROD_ID
                        and   a.adv_dtl_id = e.fwd_receipt_no
                        and   c.detail_receipt_no = e.detail_receipt_no
                        and   a.trans_dt between '$frm_date' and '$to_date'
                        and   a.comp_id = '$comp_id'
                        and   a.comp_id =f.comp_id
                        and   e.comp_pay_flag = 'Y'
                         group by fo_name";

            }else{


            $sql = "select c.branch_id, b.branch_name,sum(a.adv_amt)adv_amt
            from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d
            where c.branch_id = b.id
            and   a.memo_no='$memoNumber'
            and   a.adv_dtl_id = c.receipt_no
            and   a.adv_receive_no = c.detail_receipt_no
            and   c.prod_id = d.PROD_ID
            and   a.trans_dt between '$frm_date' and '$to_date'
            and   a.comp_id = '$comp_id'
            and   c.comp_pay_flag = 'Y'
            group by b.branch_name,c.branch_id
            UNION
            select c.branch_id,b.branch_name,sum(a.adv_amt)adv_amt
          
                        from tdf_company_advance a, md_branch b,td_adv_details c,mm_product d,tdf_adv_fwd e
                        where c.branch_id = b.id
                        and   a.memo_no='$memoNumber'
                        and   a.adv_receive_no = c.detail_receipt_no
                        and   c.prod_id = d.PROD_ID
                        and   a.adv_dtl_id = e.fwd_receipt_no
                        and   c.detail_receipt_no = e.detail_receipt_no
                        and   a.trans_dt between '$frm_date' and '$to_date'
                        and   a.comp_id = '$comp_id'
                        and   e.comp_pay_flag = 'Y'
                         group by b.branch_name,c.branch_id";
        }

    }
        $q = $this->db->query($sql);
        return $q->result();
    }

    public function getCompanyPayment($comp_id, $frm_date, $to_date, $refereceNo=null)
    {
        /* $q= $this->db->query("
                        select a.pay_dt,c.district_name,a.pur_inv_no,b.PROD_DESC,a.pur_ro, SUM(a.qty) as qty, SUM(a.rate_amt) as rate_amt, SUM(a.taxable_amt) as taxable_amt, SUM(a.tds_amt) as tds_amt, SUM(a.net_amt) as net_amt,
                        (select c.district_name from td_purchase d where d.ro_no=a.pur_ro and c.district_code=d.br )br_dist,
                        (select h.fo_name from tdf_payment_forward g , mm_fo_master h where g.ro_no=a.pur_ro and g.paid_id=a.paid_id and g.fo_id=h.fi_id)fo_nm,
                        (select j.bank_name from mm_feri_bank j where j.sl_no=a.bnk_ac_cd)bnk
                        from tdf_company_payment a, mm_product b,md_district c
                        where a.comp_id=$comp_id
                        and b.PROD_ID=a.prod_id
                        and a.district=c.district_code
                        and a.net_amt > 0
                        and a.pay_dt >= '$frm_date' and a.pay_dt <= '$to_date'
                        group by  a.pur_ro,a.pur_inv_no
                    ");  */
    if($refereceNo==""||$refereceNo==null){


        $q = $this->db->query("
                        select d.COMP_NAME as comp_name,a.pay_dt,c.district_name,a.pur_inv_no,a.paid_id,b.PROD_DESC,a.pur_ro, SUM(a.qty) as qty,
                        (select DISTINCT round(d.tot_amt/d.qty,3) from td_purchase d where d.ro_no=a.pur_ro and c.district_code=d.br ) as rate_amt, 
                        SUM(a.taxable_amt) as taxable_amt, SUM(a.tds_amt) as tds_amt, SUM(a.net_amt) as net_amt,
                        (select DISTINCT c.district_name from td_purchase d where d.ro_no=a.pur_ro and c.district_code=d.br )br_dist,
                        (select DISTINCT h.fo_name from tdf_payment_forward g , mm_fo_master h where g.ro_no=a.pur_ro and g.paid_id=a.paid_id and g.fo_id=h.fi_id)fo_nm,
                        (select DISTINCT j.bank_name from mm_feri_bank j where j.sl_no=a.bnk_id)bnk,
                        (select DISTINCT j.branch_name from mm_feri_bank j where j.sl_no=a.bnk_id)bnk_branch_name,
                        (select DISTINCT j.ac_no from mm_feri_bank j where j.sl_no=a.bnk_id)acc_num,
                        d.bank_name as cbank,d.bnk_branch_name as cbnk_branch_name,d.ac_no as cac_no,
                        d.ifsc as cifsc
                        from tdf_company_payment a, mm_product b,md_district c,mm_company_dtls d
                        where a.comp_id=$comp_id
                        and b.PROD_ID=a.prod_id
                        and a.district=c.district_code
                        and a.comp_id=d.comp_id
                        and a.net_amt > 0
                        and a.pay_dt >= '$frm_date' and a.pay_dt <= '$to_date'
                        group by  a.pur_ro,a.pur_inv_no,a.paid_id
                        order by  c.district_name,a.pay_dt
                    ");


    }else{
        $q = $this->db->query("
                            select d.COMP_NAME as comp_name,a.pay_dt,c.district_name,a.pur_inv_no,a.paid_id,b.PROD_DESC,a.pur_ro, SUM(a.qty) as qty,
                            (select DISTINCT round(d.tot_amt/d.qty,3) from td_purchase d where d.ro_no=a.pur_ro and c.district_code=d.br ) as rate_amt, 
                            SUM(a.taxable_amt) as taxable_amt, SUM(a.tds_amt) as tds_amt, SUM(a.net_amt) as net_amt,
                            (select DISTINCT c.district_name from td_purchase d where d.ro_no=a.pur_ro and c.district_code=d.br )br_dist,
                            (select DISTINCT h.fo_name from tdf_payment_forward g , mm_fo_master h where g.ro_no=a.pur_ro and g.paid_id=a.paid_id and g.fo_id=h.fi_id)fo_nm,
                            (select DISTINCT j.bank_name from mm_feri_bank j where j.sl_no=a.bnk_id)bnk,
                            (select DISTINCT j.branch_name from mm_feri_bank j where j.sl_no=a.bnk_id)bnk_branch_name,
                            (select DISTINCT j.ac_no from mm_feri_bank j where j.sl_no=a.bnk_id)acc_num,
                            d.bank_name as cbank,d.bnk_branch_name as cbnk_branch_name,d.ac_no as cac_no,
                            d.ifsc as cifsc
                            from tdf_company_payment a, mm_product b,md_district c,mm_company_dtls d
                            where a.comp_id=$comp_id
                            and a.ref_no='".$refereceNo."'
                            and b.PROD_ID=a.prod_id
                            and a.district=c.district_code
                            and a.comp_id=d.comp_id
                            and a.net_amt > 0
                            and a.pay_dt >= '$frm_date' and a.pay_dt <= '$to_date'
                            group by  a.pur_ro,a.pur_inv_no,a.paid_id
                            order by  c.district_name,a.pay_dt
                        ");
    }
        return $q->result();
    }

    public function getCompanyPayment_district_name($comp_id, $frm_date, $to_date,$refereceNo=null)
    {
        
        if($comp_id==1 ||$comp_id==10||$comp_id==11 ){
            if($refereceNo==null||$refereceNo==""){

            
            $q = $this->db->query("
            select SUM(a.qty) as qty,f.short_name,
            (select DISTINCT round(d.tot_amt/d.qty,3) from td_purchase d where d.ro_no=a.pur_ro and c.district_code=d.br ) as rate_amt, 
            SUM(a.taxable_amt) as taxable_amt, SUM(a.tds_amt) as tds_amt,
            SUM(a.net_amt) as net_amt,
            (select DISTINCT h.fo_name from tdf_payment_forward g , mm_fo_master h where g.ro_no=a.pur_ro and g.paid_id=a.paid_id and g.fo_id=h.fi_id)fo_nm,
            (select DISTINCT h.fo_number from tdf_payment_forward g , mm_fo_master h where g.ro_no=a.pur_ro and g.paid_id=a.paid_id and g.fo_id=h.fi_id)fo_num
            from tdf_company_payment a, mm_product b,md_district c,mm_company_dtls f
            where a.comp_id=$comp_id
            and   a.comp_id =f.comp_id
            and b.PROD_ID=a.prod_id
            and a.district=c.district_code
            and a.net_amt > 0
            and a.pay_dt >= '$frm_date' and a.pay_dt <= '$to_date'
            group by fo_nm
            order by fo_nm
        ");

            }else{
                $q = $this->db->query("
                select SUM(a.qty) as qty,
                (select DISTINCT round(d.tot_amt/d.qty,3) from td_purchase d where d.ro_no=a.pur_ro and c.district_code=d.br ) as rate_amt, 
                SUM(a.taxable_amt) as taxable_amt, SUM(a.tds_amt) as tds_amt,
                SUM(a.net_amt) as net_amt,
                (select DISTINCT h.fo_name from tdf_payment_forward g , mm_fo_master h where g.ro_no=a.pur_ro and g.paid_id=a.paid_id and g.fo_id=h.fi_id)fo_nm
                from tdf_company_payment a, mm_product b,md_district c
                where a.comp_id=$comp_id
                and a.ref_no='".$refereceNo."'
                and b.PROD_ID=a.prod_id
                and a.district=c.district_code
                and a.net_amt > 0
                and a.pay_dt >= '$frm_date' and a.pay_dt <= '$to_date'
                group by fo_nm
                order by fo_nm
            ");
            }

        }else{

        
            if($refereceNo==null||$refereceNo==""){
        $q = $this->db->query("
                        select c.district_name, SUM(a.qty) as qty,
                        (select DISTINCT round(d.tot_amt/d.qty,3) from td_purchase d where d.ro_no=a.pur_ro and c.district_code=d.br ) as rate_amt, 
                        SUM(a.taxable_amt) as taxable_amt, SUM(a.tds_amt) as tds_amt,
                        SUM(a.net_amt) as net_amt
                        from tdf_company_payment a, mm_product b,md_district c
                        where a.comp_id=$comp_id
                        and b.PROD_ID=a.prod_id
                        and a.district=c.district_code
                        and a.net_amt > 0
                        and a.pay_dt >= '$frm_date' and a.pay_dt <= '$to_date'
                        group by  c.district_name
                        order by  c.district_name
                    ");
            }else{
                $q = $this->db->query("
                select c.district_name, SUM(a.qty) as qty,
                (select DISTINCT round(d.tot_amt/d.qty,3) from td_purchase d where d.ro_no=a.pur_ro and c.district_code=d.br ) as rate_amt, 
                SUM(a.taxable_amt) as taxable_amt, SUM(a.tds_amt) as tds_amt,
                SUM(a.net_amt) as net_amt
                from tdf_company_payment a, mm_product b,md_district c
                where a.comp_id=$comp_id
                and a.ref_no='".$refereceNo."'
                and b.PROD_ID=a.prod_id
                and a.district=c.district_code
                and a.net_amt > 0
                and a.pay_dt >= '$frm_date' and a.pay_dt <= '$to_date'
                group by  c.district_name
                order by  c.district_name
            "); 
            }

        }
        return $q->result();
    }


    public function totalCompanyPaymentVoucher($comp_id, $frm_date, $to_date, $refereceNo = null)
    {
       
        if($refereceNo==""||$refereceNo==null){
        $q = $this->db->query("
                        select SUM(a.taxable_amt) as taxable_amt,
                        SUM(a.tds_amt) as tds_amt, 
                        SUM(a.net_amt) as net_amt
                        from tdf_company_payment a, mm_product b,md_district c
                        where a.comp_id=$comp_id
                        and b.PROD_ID=a.prod_id
                        and a.district=c.district_code
                        and a.net_amt > 0
                        and a.pay_dt >= '$frm_date' and a.pay_dt <= '$to_date'
                        
                    ");

        }else{
          
            $q = $this->db->query("
            select SUM(a.taxable_amt) as taxable_amt,
            SUM(a.tds_amt) as tds_amt, 
            SUM(a.net_amt) as net_amt
            from tdf_company_payment a, mm_product b,md_district c
            where a.comp_id=$comp_id
            and a.ref_no='".$refereceNo."'
            
            and b.PROD_ID=a.prod_id
            and a.district=c.district_code
            and a.net_amt > 0
            and a.pay_dt >= '$frm_date' and a.pay_dt <= '$to_date'
            
        ");
        }
        return $q->row();
    }

    //Function for overdue list report 1st part for HO ,2nd part for branch
    function overdue_list_model($date)        
    {

        $branciId=$this->session->userdata('loggedin')['branch_id'];
        if($branciId == 342){
        $query = $this->db->query("SELECT a.br_cd,b.branch_name,a.soc_id,c.soc_name,a.sale_ro,a.prod_id,d.prod_desc,a.trans_do,a.do_dt,a.no_of_days,a.sale_due_dt, a.qty,a.unit,e.unit_name,a.round_tot_amt,a.paid_amt,(a.round_tot_amt - a.paid_amt)due_amt
                FROM td_sale a,md_branch b,mm_ferti_soc c,mm_product d,mm_unit e
                where a.br_cd = b.id
                and   a.soc_id = c.soc_id
                and   a.prod_id = d.prod_id
                and   a.unit    = e.id
                and   a.do_dt >= '2022-04-01'
                and   a.sale_due_dt < '".$date."'
                and   a.round_tot_amt > paid_amt
                order by a.br_cd,a.do_dt");

        }else{
            $query = $this->db->query("SELECT a.br_cd,b.branch_name,a.soc_id,c.soc_name,a.sale_ro,a.prod_id,d.prod_desc,a.trans_do,a.do_dt,a.no_of_days,a.sale_due_dt, a.qty,a.unit,e.unit_name,a.round_tot_amt,a.paid_amt,(a.round_tot_amt - a.paid_amt)due_amt
                FROM td_sale a,md_branch b,mm_ferti_soc c,mm_product d,mm_unit e
                where a.br_cd = b.id
                and   a.soc_id = c.soc_id
                and   a.prod_id = d.prod_id
                and   a.unit    = e.id
                and   a.br_cd=".$branciId."
                and   a.do_dt >= '2022-04-01'
                and   a.sale_due_dt < '".$date."'
                and   a.round_tot_amt > paid_amt
                order by a.br_cd,a.do_dt");
        }
        return $query->result();
    }


    public function test($date){
        try {
            $this->db->reconnect();

            $sql = "CALL `p_due_register`(?,?,?)";

            $data_w = $this->db->query($sql, $date);
             
            $this->db->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

   // ====================================active society===============================
    function active_society($fDate, $tDate,$dist=null){
        if($dist==''||$dist==null){
        $q=$this->db->query("SELECT distinct b.soc_id,d.district_name,b.soc_name,b.soc_add,b.gstin,b.email,b.ph_no,count(a.trans_do) as tot_invoice
        FROM td_sale a ,mm_ferti_soc b,md_district d
        WHERE a.soc_id=b.soc_id
        and a.br_cd=d.district_code
        and a.do_dt between '".$fDate."' and '".$tDate."'
        group by b.soc_id,d.district_name,b.soc_name,b.soc_add,b.gstin,b.email,b.ph_no
        order by d.district_name,b.soc_name");
        }else{
            $q=$this->db->query("SELECT distinct b.soc_id,d.district_name,b.soc_name,b.soc_add,b.gstin,b.email,b.ph_no,count(a.trans_do) as tot_invoice
            FROM td_sale a ,mm_ferti_soc b,md_district d
            WHERE a.soc_id=b.soc_id
            and a.br_cd=$dist
            and a.br_cd=d.district_code
            and a.do_dt between '".$fDate."' and '".$tDate."'
            group by b.soc_id,d.district_name,b.soc_name,b.soc_add,b.gstin,b.email,b.ph_no
            order by d.district_name,b.soc_name");  
        }
        return $q->result();
    }

    public function getCompanyPayment_due($dist,$comp_id, $frm_date, $to_date)
    {
        
        if($comp_id==1||$comp_id==10||$comp_id==11){
            
           
            $q = $this->db->query("select b.prod_desc,a.invoice_no,a.ro_no,a.ro_dt,a.tot_amt ,IFNULL((SELECT sum(c.paid_amt) FROM tdf_company_payment c
            WHERE c.pay_dt between '2022-08-01' and '2023-03-03'
            and c.district=335 and pur_ro =a.ro_no
            and c.comp_id=1 ),0)as Comp_pay
                    from td_purchase a,mm_product b
                    where a.br=$dist
                    and a.prod_id=b.prod_id
                    and a.comp_id=$comp_id
                    and a.trans_dt BETWEEN '$frm_date' and '$to_date' ");
        

        }else{

            $q = $this->db->query("select b.prod_desc,a.invoice_no,a.ro_no,a.ro_dt,a.tot_amt ,IFNULL((SELECT sum(c.paid_amt) FROM tdf_company_payment c
            WHERE c.pay_dt between '2022-08-01' and '2023-03-03'
            and c.district=335 and pur_ro =a.ro_no
            and c.comp_id=1 ),0)as Comp_pay
                    from td_purchase a,mm_product b
                    where a.br=$dist
                    and a.prod_id=b.prod_id
                    and a.comp_id=$comp_id
                    and a.trans_dt BETWEEN '$frm_date' and '$to_date' ");
      
           

        }
        return $q->result();
    }

    public function ComPaydistrictwise_due($comp_id, $frm_date, $to_date)
    {
        
        if($comp_id==1||$comp_id==10||$comp_id==11){
            $q  = $this->db->query("select district_name,sum(pur_amt) pur_amt,sum(taxable_amt) taxable_amt
            from( select c.district_name, SUM(a.qty) as qty,a.pur_inv_no,a.pur_ro,e.tot_amt as pur_amt,
            (select DISTINCT round(d.tot_amt/d.qty,3) from td_purchase d where d.ro_no=a.pur_ro and c.district_code=d.br ) as rate_amt,
                SUM(a.taxable_amt) as taxable_amt, SUM(a.tds_amt) as tds_amt, SUM(a.net_amt) as net_amt,
                (select DISTINCT h.fo_name from tdf_payment_forward g , mm_fo_master h where g.ro_no=a.pur_ro and g.paid_id=a.paid_id and g.fo_id=h.fi_id)fo_nm 
                from tdf_company_payment a, mm_product b,md_district c,td_purchase e 
                where a.comp_id=$comp_id and b.PROD_ID=a.prod_id 
                and a.pur_ro=e.ro_no and a.district=c.district_code 
                and a.net_amt > 0 and a.pay_dt >= '$frm_date' 
                and a.pay_dt <= '$to_date' 
                group by a.pur_inv_no,a.pur_ro 
                order by c.district_name)a group by district_name order by fo_nm"); 

        }else{
            $q  = $this->db->query("select district_name,sum(pur_amt) pur_amt,sum(taxable_amt) taxable_amt
            from( select c.district_name, SUM(a.qty) as qty,a.pur_inv_no,a.pur_ro,e.tot_amt as pur_amt,
            (select DISTINCT round(d.tot_amt/d.qty,3) from td_purchase d where d.ro_no=a.pur_ro and c.district_code=d.br ) as rate_amt,
                SUM(a.taxable_amt) as taxable_amt, SUM(a.tds_amt) as tds_amt, SUM(a.net_amt) as net_amt 
                from tdf_company_payment a, mm_product b,md_district c,td_purchase e 
                where a.comp_id=$comp_id and b.PROD_ID=a.prod_id 
                and a.pur_ro=e.ro_no and a.district=c.district_code 
                and a.net_amt > 0 and a.pay_dt >= '$frm_date' 
                and a.pay_dt <= '$to_date' 
                group by a.pur_inv_no,a.pur_ro 
                order by c.district_name)a group by district_name"); 

        }
        return $q->result();
    }
    public function tcs_payable($frm_date,$to_date){
        $fin_id = $this->session->userdata['loggedin']['fin_id'];
        $br     = $this->session->userdata['loggedin']['branch_id'];
        $q  = $this->db->query("select  x.soc_name,sum(April)April,sum(May)May,sum(June)June,sum(July)July,sum(August)August,sum(September)September,sum(October)October,sum(November)November,sum(December)December,sum(January)January,sum(February)February,sum(March)March
        from(
        select b.soc_name,c.month_name,c.id,a.yr,
        if(c.month_name='April',sum(a.tot_amt),0)April,
        if(c.month_name='May',sum(a.tot_amt),0)May,
        if(c.month_name='June',sum(a.tot_amt),0)June,
        if(c.month_name='July',sum(a.tot_amt),0)July,
        if(c.month_name='August',sum(a.tot_amt),0)August,
        if(c.month_name='September',sum(a.tot_amt),0)September,
        if(c.month_name='October',sum(a.tot_amt),0)October,
        if(c.month_name='November',sum(a.tot_amt),0)November,
        if(c.month_name='December',sum(a.tot_amt),0)December,
        if(c.month_name='January',sum(a.tot_amt),0)January,
        if(c.month_name='February',sum(a.tot_amt),0)February,
        if(c.month_name='March',sum(a.tot_amt),0)March
        
        from(
        SELECT soc_id,sum(`paid_amt`)tot_amt,CAST(substr( paid_dt,6,2) AS UNSIGNED)month,substr( paid_dt,1,4)yr  FROM `tdf_payment_recv`
        WHERE `paid_dt` BETWEEN '$frm_date' AND '$to_date'
        AND `branch_id` = $br
        AND `fin_yr` = $fin_id
        and pay_type<>6
        group by soc_id,substr( paid_dt,6,7),substr( paid_dt,1,4))a,mm_ferti_soc b,md_month c
        where a.soc_id=b.soc_id
        and a.month=c.id
        group by b.soc_name,c.month_name,a.yr
        order by b.soc_name,a.yr,c.month_name)x
        group by x.soc_name;"); 
        return $q->result();
    }




}