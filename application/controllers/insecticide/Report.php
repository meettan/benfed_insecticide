<?php
    class Report extends MX_Controller{

        public function __construct(){

            parent::__construct();

            $this->load->model('ReportModel');

            $this->load->helper('paddyrate');

            $this->session->userdata('fin_yr');

            if(!isset($this->session->userdata['loggedin']['user_id'])){
            redirect('User_Login/login');

       }
}

        public function rateslab(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

               $company     = $_POST['company'];

               $product     = $_POST['product'];

               $select      = array(

                'a.frm_dt',"a.to_dt","a.catg_id","a.sp_mt","a.sp_bag","a.sp_govt","b.cate_desc","c.comp_name");

               $where       = array(

                "a.catg_id  =  b.sl_no" => NULL,

                "a.comp_id"     =>  $company,

                "a.prod_id"     =>  $_POST['product'],

                "a.district"    =>  $this->session->userdata['loggedin']['branch_id'],

                "a.fin_id"      =>  $this->session->userdata['loggedin']['fin_id'],
                "a.comp_id   = c.comp_id" =>NULL
               );

               $data['rate']       =   $this->ReportModel->f_select("mm_sale_rate a,mm_category b,mm_company_dtls c", $select, $where, 0);

               $wher_comp      = array(

               "comp_id"    => $_POST['company']

               );
               $data['company_nm']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, $wher_comp, 1);

               $wheres      = array(

                "prod_id"     =>  $_POST['product']

               );

               $data['product']    =   $this->ReportModel->f_select("mm_product", NULL,$wheres, 1);

               $where1             =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

               $data['branch']     =   $this->ReportModel->f_select("md_district", NULL, $where1, 1);
               $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, $wher_comp, 1);

               $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/rate_slab/rate_slab.php',$data);
            // $this->load->view('report/rate_slab/rate_slab_ip.php',$data);
               $this->load->view('post_login/footer');

            }else{

                $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, NULL, 0);

              
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/rate_slab/rate_slab_ip.php',$data);
                $this->load->view('post_login/footer');
            }

        }

// =================================Sale Rate Slab at HO=========================
         public function rateslabho(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $comp_id  = $_POST['company'];

                $district = $this->input->post('district');

                $frm_date = $this->input->post('fr_date');

                $to_date  = $this->input->post('to_date');

                $fin_id   = $this->session->userdata['loggedin']['fin_id'];

               $data['rate']     = $this->ReportModel->f_get_salerateho($comp_id,$district,$frm_date,$to_date,$fin_id);

               $wher_comp      = array(

                "comp_id"    => $_POST['company']
 
                );
               $data['company']  =  $this->ReportModel->f_select("mm_company_dtls", NULL,  $wher_comp, 1);

               $where1           =  array("district_code"  =>  $this->input->post('district'));

               $data['branch']   =  $this->ReportModel->f_select("md_district", NULL, $where1, 1);
               $data['frm_date']= $this->input->post('fr_date');
               $data['to_date']= $this->input->post('to_date');
              
               $this->load->view('post_login/fertilizer_main');
               $this->load->view('report/rate_slabho/rate_slab.php',$data);
               $this->load->view('post_login/footer');

            }else{

                $data['branch']     =   $this->ReportModel->f_get_district_asc();

                $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, array('1 order by COMP_NAME'=>NULL), 0);

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/rate_slabho/rate_slab_ip.php',$data);
                $this->load->view('post_login/footer');
            }

        }
// =================================End Sale Rate Slab at HO=========================
        public function popProd(){

            $where  = array('company' => $this->input->get('company'));

            $data     = $this->ReportModel->f_select("mm_product", NULL, $where, 0);
   
            echo json_encode($data);
        }


/************************Ho Cr note Summery Report all district */

public function crsummrep_ho(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];

        // $branch     =   $this->session->userdata['loggedin']['branch_id'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));

        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

        // $where1              =   array("COMP_ID"  => $comp_id);
        
        // $data['compdtls']      =   $this->ReportModel->f_select("mm_company_dtls", NULL, $where1,1);
        $data['crdtls']     =   $this->ReportModel->f_crsumm_rep_ho($from_dt,$to_dt);
        
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/cr_rep_all_dist/stk_stmt',$data);
        $this->load->view('post_login/footer');

    }else{
        
        $data['compdtls']      =   $this->ReportModel->f_select("mm_company_dtls", NULL, NULL,0);
    
        $this->load->view('post_login/fertilizer_main');
        
        $this->load->view('report/cr_rep_all_dist/stk_stmt_ip',$data);
        $this->load->view('post_login/footer');
    }

}

		/***************************************Ho Cr Note Report************************** */
public function crnoterep_ho(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];

        // $branch     =   $this->session->userdata['loggedin']['branch_id'];
        $comp_id  = $_POST['comp'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));

        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

        
        $where1              =   array("COMP_ID"  => $comp_id);
        
        $data['compdtls']      =   $this->ReportModel->f_select("mm_company_dtls", NULL, $where1,1);
        $data['crdtls']     =   $this->ReportModel->f_cr_rep_ho($comp_id,$from_dt,$to_dt);
        
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/cr_note_rep_ho/stk_stmt',$data);
        $this->load->view('post_login/footer');

    }else{
        
        $data['compdtls']      =   $this->ReportModel->f_select("mm_company_dtls", NULL,array('1 order by COMP_NAME'=>NULL),0);
    
        $this->load->view('post_login/fertilizer_main');
        
        $this->load->view('report/cr_note_rep_ho/stk_stmt_ip',$data);
        $this->load->view('post_login/footer');
    }

}

/*******************Brach Wise new stock report********************************** */
public function brwse_constk(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];

        // $branch     =   $this->session->userdata['loggedin']['branch_id'];
        // $branch  = $_POST['br'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));

        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

        // $data['product']     =   $this->ReportModel->f_get_product_list($branch,$opndt);

        $data['opening']     =   $this->ReportModel->f_get_balance_all($opndt,$prevdt);

        $data['purchase']    =   $this->ReportModel->f_get_purchase_all($from_dt,$to_dt);

        $data['sale']        =   $this->ReportModel->f_get_sale_all($from_dt,$to_dt);

        // $data['closing']     =   $this->ReportModel->f_get_balance($branch,$opndt,$to_dt);

        // $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
        // $where1              =   array("district_code"  => $branch);
        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, NULL,0);

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/br_wse_con_stk/stk_stmt',$data);
        $this->load->view('post_login/footer');

    }else{
        $select1      = array("district_code","district_name");
        $data['all_branch']      =   $this->ReportModel->f_select("md_district", $select1, NULL,0);
        $this->load->view('post_login/fertilizer_main');
        
        $this->load->view('report/br_wse_con_stk/stk_stmt_ip',$data);
        $this->load->view('post_login/footer');
    }

}

/***********************cr note demand report*********************/
public function soc_wse_cr_dmd(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];

        // $branch     =   $this->session->userdata['loggedin']['branch_id'];
        $branch  = $_POST['br'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));

        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));


        $data['product']     =   $this->ReportModel->f_get_product_list($branch,$opndt);

        // $data['opening']     =   $this->ReportModel->f_get_balance($branch,$opndt,$prevdt);

        // $data['purchase']    =   $this->ReportModel->f_get_purchase($branch,$from_dt,$to_dt);

        // $data['sale']        =   $this->ReportModel->f_get_sale($branch,$from_dt,$to_dt);

        // $data['closing']     =   $this->ReportModel->f_get_balance($branch,$opndt,$to_dt);

       $data['crdmnd']     =   $this->ReportModel->f_get_crdemand($branch,$opndt,$to_dt);

        // $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
        $where1              =   array("district_code"  => $branch);
        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
        $where2             =   array("district"  => $branch);

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/soc_wse_cr_dmd/stk_stmt',$data);
        $this->load->view('post_login/footer');

    }else{
        $select1      = array("district_code","district_name");
        $data['all_branch']      =   $this->ReportModel->f_select("md_district", $select1, array('1 order by district_name'=>NULL),0);
     
        $this->load->view('post_login/fertilizer_main');
        
        $this->load->view('report/soc_wse_cr_dmd/stk_stmt_ip',$data);
        $this->load->view('post_login/footer');
    }

}
/************************************************************** */

/*******************************************Consolidated Stock Report at Branch***************************************************/
        public function stkStmt(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $from_dt    =   $_POST['from_date'];

                $to_dt      =   $_POST['to_date'];

                $branch     =   $this->session->userdata['loggedin']['branch_id'];

                $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

                $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

                $data['date']        =   array($from_dt,$to_dt);
               
                $data['stock']      =    $this->ReportModel->p_consolidated_stock(array($from_dt,$to_dt,$branch));
                
                
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/stk_stmt/stk_stmt',$data);
                $this->load->view('post_login/footer');

            }else{

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/stk_stmt/stk_stmt_ip');
                $this->load->view('post_login/footer');
            }

        }

/*******************************************Consolidated Stock Report at Head Office************************************/

public function stkStmt_ho(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];

        $branch    =    $_POST['br'];

        $where1              =   array("district_code"  => $branch);

        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

        if ($branch == 0){

            $data['product']      =    $this->ReportModel->p_consolidated_stock_all(array($from_dt,$to_dt));

        }else{

            $data['product']      =    $this->ReportModel->p_consolidated_stock(array($from_dt,$to_dt,$branch));

        }
        
        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/stk_stmt_ho/stk_stmt',$data);
        $this->load->view('post_login/footer');

    }else{
        $select1      = array("district_code","district_name");
        $where =array('1 order by district_name'=>null);
        $data['all_branch']      =   $this->ReportModel->f_select("md_district", $select1, $where,0);
      
        $this->load->view('post_login/fertilizer_main');
        
        $this->load->view('report/stk_stmt_ho/stk_stmt_ip',$data);
        $this->load->view('post_login/footer');
    }

}

   public function stock_valuation(){

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $from_dt    =   $this->input->post('from_date');
            $to_dt      =   $this->input->post('to_date');
            $branch     =   $this->input->post('br');

            $where1              =   array("district_code"  => $branch);
            $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
            if ($branch == 0){
                $data['product']      =    $this->ReportModel->p_consolidated_stock_all(array($from_dt,$to_dt));
            }else{
                $data['product']      =    $this->ReportModel->p_consolidated_stock(array($from_dt,$to_dt,$branch));

            }
            
            $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/stk_valuation/stk_stmt',$data);
            $this->load->view('post_login/footer');

        }else{

            $select1      = array("district_code","district_name");
            $where =array('1 order by district_name'=>null);
            $data['all_branch']      =   $this->ReportModel->f_select("md_district", $select1, $where,0);
            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/stk_valuation/stk_stmt_ip',$data);
            $this->load->view('post_login/footer');
        }

    }

        /****************************** */

        public function ps_soc(){
            $select1      = array("district_code","district_name");
            $data['all_branch']      =   $this->ReportModel->f_select("md_district", $select1, array('1 order by district_name'=>NULL),0);
           
            if($_SERVER['REQUEST_METHOD'] == "POST") {
        
                $from_dt    =   $_POST['from_date'];
                $to_dt      =   $_POST['to_date'];
                $branch      =   $_POST['br'];
        
                $mth        =  date('n',strtotime($from_dt));
        
                $yr         =  date('Y',strtotime($from_dt));
                $all_data   =   array($from_dt,$to_dt,$branch );
                if($mth > 3){
        
                    $year = $yr;
        
                }else{
        
                    $year = $yr - 1;
                }
                $select1      = array("district_code","district_name");
                $data['all_branch']      =   $this->ReportModel->f_select("md_district", $select1, NULL,0);
              
                $opndt      =  date($year.'-04-01');
        
                $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));
        
                $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
        
                $data['product']     =   $this->ReportModel->f_get_product_list($branch,$opndt);
                       
                // $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
                $where1              =   array("district_code"  =>  $branch);
                $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
               
                //$data['all_data']    =   $this->ReportModel->p_ro_wise_soc_stk($all_data);
                $data['rogr']    =   $this->ReportModel->p_ro_wise_soc_ro($from_dt,$to_dt,$branch);  // Ro No Purchase wise
				$data['salero']    =   $this->ReportModel->s_ro_wise_soc_ro($from_dt,$to_dt,$branch);  // Ro No Purchase wise
            
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/sp_soc/stk_stmt',$data);
                $this->load->view('post_login/footer');
        
            }else{
        
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/sp_soc/stk_stmt_ip',$data);
                $this->load->view('post_login/footer');
            }
        
        }
        
/************************************************************ */
public function ps_pl(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];
        $compditels      =   $_POST['comp_id'];
        $comp=explode(',',$compditels );
        $data['compName']=$comp[1];

        // $br      =   $_POST['br'];

        $branch     =   $this->session->userdata['loggedin']['branch_id'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));
        $all_data            =   array($from_dt,$to_dt,$branch );
        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

        $data['product']     =   $this->ReportModel->f_get_product_list($branch,$opndt);

        // $data['opening']  =   $this->ReportModel->f_get_balance($branch,$opndt,$prevdt);

        // $data['purchase'] =   $this->ReportModel->f_get_purchase($branch,$from_dt,$to_dt);

        // $data['sale']     =   $this->ReportModel->f_get_sale($branch,$from_dt,$to_dt);

        // $data['closing']  =   $this->ReportModel->f_get_balance($branch,$opndt,$to_dt);

        $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

        // $data['br']      = $br;
       
        $data['all_data']    =   $this->ReportModel->p_ro_wise_prof_calc($from_dt,$to_dt,$comp[0],$branch);
   
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/sp_pl/stk_stmt',$data);
        $this->load->view('post_login/footer');

    }else{
        $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, NULL, 0);
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/sp_pl/stk_stmt_ip',$data);
        $this->load->view('post_login/footer');
    }

}
/************************************************************ */
public function ps_pl_all(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];

        $compname=$_POST['comp_id'];
        $arid=explode(',',$compname);
        $comp=$arid[0];
        $data['compName']=$arid[1];

        // $branch     =   $this->session->userdata['loggedin']['branch_id'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));
        $all_data            =   array($from_dt,$to_dt );
        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

        $data['product']     =   $this->ReportModel->f_get_product_list_nw($opndt);

        // $data['opening']  =   $this->ReportModel->f_get_balance($branch,$opndt,$prevdt);

        // $data['purchase'] =   $this->ReportModel->f_get_purchase($branch,$from_dt,$to_dt);

        // $data['sale']     =   $this->ReportModel->f_get_sale($branch,$from_dt,$to_dt);

        // $data['closing']  =   $this->ReportModel->f_get_balance($branch,$opndt,$to_dt);

        // $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

        // $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
       
        $data['all_data']    =   $this->ReportModel->p_ro_wise_prof_calc_all($from_dt,$to_dt,$comp);
   
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/sp_pl_all/stk_stmt',$data);
        $this->load->view('post_login/footer');

    }else{
        $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, NULL, 0);
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/sp_pl_all/stk_stmt_ip',$data);
        $this->load->view('post_login/footer');
    }

}





public function ps_pl_all_comp_dist(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];
        $proarra=$this->input->post('product');
        $dist=$this->input->post('dist');
        $ex=explode(',',$proarra);
        $exdis=explode(',',$dist);
        $product_id=$ex[0];
        $district_id=$exdis[0];
        $data['product_name']=$ex[1];
        $data['district_id']=$exdis[1];

        $compname=$_POST['comp_id'];
        $arid=explode(',',$compname);
        $comp=$arid[0];
        $data['compName']=$arid[1];

        // $branch     =   $this->session->userdata['loggedin']['branch_id'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));
        $all_data            =   array($from_dt,$to_dt );
        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

        $data['product']     =   $this->ReportModel->f_get_product_list_nw($opndt);
        $data['all_data']    =   $this->ReportModel->p_ro_wise_prof_calc_all_comp_pro_dist($from_dt,$to_dt,$comp, $product_id, $district_id);
   
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/sp_pl_all_dist_pro/stk_stmt',$data);
        $this->load->view('post_login/footer');

    }else{
        $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, array('1 order by COMP_NAME'=>NULL), 0);

        $data['dist']=$this->ReportModel->f_select("md_district", NULL,array('1 order by district_name'=>NULL),0);
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/sp_pl_all_dist_pro/stk_stmt_ip',$data);
        $this->load->view('post_login/footer');
    }

}
    public function getcompany(){
        $comp=$this->input->post('comp_id');
        $ex=explode(',',$comp);
        $comp_id=$ex[0];
        $where1 = array("COMPANY"  =>  $comp_id,'1 order by PROD_DESC'=>NULL);
        $select=array('PROD_DESC','PROD_ID');

        $data=$this->ReportModel->f_select("mm_product", $select, $where1,0);
        $output='<option value="">Select Product</option>';
        foreach ($data as $key) {
            $output.='<option value="'.$key->PROD_ID.','.$key->PROD_DESC.'">'.$key->PROD_DESC.'</option>';
        }
        echo json_encode($output);
    }

     
/*******************************************Companywise Consolidated Stock Report at Branch**********************************************/
        public function stkScomp(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $from_dt    =   $_POST['from_date'];

                $to_dt      =   $_POST['to_date'];

                $comp_id    =   $this->input->post('company');

                $branch     =   $this->session->userdata['loggedin']['branch_id'];


                $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

                $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);


                $data['date']        =   array($from_dt,$to_dt);
                $data['stock']       =   $this->ReportModel->p_companywise_stock(array($from_dt,$to_dt,$branch,$comp_id));

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/stk_comp/stk_comp',$data);
                $this->load->view('post_login/footer');

            }else{

                $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, NULL, 0);

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/stk_comp/stk_comp_ip',$data);
                $this->load->view('post_login/footer');
            }

        }

/*******************************************Companywise Consolidated Stock Report at Head Office**********************************************/
public function stkScomp_ho(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];

        $comp_id    =   (int)$this->input->post('company');

        $branch     =   $_POST['br'];


        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

        $where1              =   array("district_code"  => $branch);

        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

        if ($branch == 0){

            $data['product']      =    $this->ReportModel->p_companywise_stock_all(array($from_dt,$to_dt,$comp_id));

        }else{

            $data['product']      =    $this->ReportModel->p_companywise_stock(array($from_dt,$to_dt,$branch,$comp_id));

        }

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/stk_comp_ho/stk_comp',$data);
        $this->load->view('post_login/footer');

    }else{
        $select1      = array("district_code","district_name");
        $data['all_branch']      =   $this->ReportModel->f_select("md_district", $select1, array('1 order by district_name'=>NULL),0);
        $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, array('1 order by COMP_NAME'=>NULL), 0);

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/stk_comp_ho/stk_comp_ip',$data);
        $this->load->view('post_login/footer');
    }

}

/********************************product wise stock Report At Branch*****************************************************************************/

        public function stkSprod(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $from_dt    =   $_POST['from_date'];

                $to_dt      =   $_POST['to_date'];

                $comp_id    =   $this->input->post('company');

                $prod_id    =   $this->input->post('product');
                
                $branch     =   $this->session->userdata['loggedin']['branch_id'];

                /*$mth        =  date('n',strtotime($from_dt));

                $yr         =  date('Y',strtotime($from_dt));

                if($mth > 3){

                    $year = $yr;

                }else{

                    $year = $yr - 1;
                }

                $opndt      =  date($year.'-04-01');

                $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));*/

                $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

                
               $data['product']     =   $this->ReportModel->f_get_product_list_rep($branch,$prod_id);


                $data['productwise_stock']=$this->ReportModel->f_get_purchase_Productwise($from_dt, $to_dt, $branch,$prod_id);
               
                
                // $data['opening']     =   $this->ReportModel->f_get_balance_rowise($branch,$from_dt,$to_dt,$opndt);
                // $data['purchase']    =   $this->ReportModel->f_get_purchase_rowise($branch,$from_dt,$to_dt);
                // $data['sale']        =   $this->ReportModel->f_get_sale_rowise($branch,$from_dt,$to_dt);
                // $data['closing']     =   $this->ReportModel->f_get_balance_rowise($branch,$from_dt,$to_dt,$opndt);

                // $where1              =   array("district_code"=>$this->session->userdata['loggedin']['branch_id']);
                $data['branch']      = $this->db->query("SELECT *  FROM `md_district` WHERE `district_code` = ".$this->session->userdata['loggedin']['branch_id'])->row();

                
            //    $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);


                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/stk_prod/stk_prod',$data);
                $this->load->view('post_login/footer');
               
            }else{

                $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, NULL, 0);

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/stk_prod/stk_prod_ip',$data);
                $this->load->view('post_login/footer');
            }

        }
/******************************************************* */

/******************************************************* */

public function stkScomp_all(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];

        $comp_id    =   $this->input->post('company');

    // $branch     =   $this->session->userdata['loggedin']['branch_id'];
        $branch  = $_POST['br'];


        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));

       
        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

        $data['branch']      =   $this->ReportModel->f_select("md_district", null, array("district_code"  => $branch),1);

        if ($branch == 0){

            $data['product']      =    $this->ReportModel->p_companywise_stock_all(array($from_dt,$to_dt,$comp_id));

        }else{

        $data['product']      =    $this->ReportModel->p_companywise_stock(array($from_dt,$to_dt,$branch,$comp_id));

        }

        // ====================================================

        // $data['product']     =   $this->ReportModel->f_get_allproduct_companywise($branch,$opndt,$comp_id);

        // $data['opening']     =   $this->ReportModel->f_get_balance_rowiseall($branch,$from_dt,$to_dt,$opndt);

        // $data['purchase']    =   $this->ReportModel->f_get_purchase_rowiseall($branch,$from_dt,$to_dt);

        // $data['sale']        =   $this->ReportModel->f_get_sale_rowiseall($branch,$from_dt,$to_dt);

        // // $data['closing']  =   $this->ReportModel->f_get_balance_rowise($branch,$from_dt,$to_dt,$opndt);
    
        // $where1              =   array("district_code"  => $branch);
        // $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,0);

        // ===============================================

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/stk_comp_all/stk_comp',$data);
        $this->load->view('post_login/footer');

    }else{
        $select1      = array("district_code","district_name");
        $data['all_branch']      =   $this->ReportModel->f_select("md_district", $select1, array('1 order by district_name'=>NULL),0);
        $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, array('1 order by COMP_NAME'=>NULL), 0);

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/stk_comp_all/stk_comp_ip',$data);
        $this->load->view('post_login/footer');
    }

}


/******************************************************** */
         // Ro Wise Product Ledger 12/10/2020 //

        public function stkSprodro(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $from_dt    =   $_POST['from_date'];
                $to_dt      =   $_POST['to_date'];

                $comp_id    =   $this->input->post('company');
                $prod_id    =   $this->input->post('product');
               
                $ro         =   $this->input->post('ro');

                $branch     =   $this->session->userdata['loggedin']['branch_id'];

                $mth        =  date('n',strtotime($from_dt));

                $yr         =  date('Y',strtotime($from_dt));
                $all_data            =   array($from_dt,$to_dt,$branch,$ro );
                if($mth > 3){

                    $year = $yr;

                }else{

                    $year = $yr - 1;
                }

                $opndt      =  date($year.'-04-01');

                $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

                $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

                $data['product']     =   $this->ReportModel->f_get_product_comp_prod_ro($branch,$from_dt,$to_dt,$comp_id,$prod_id,$ro);

                $data['all_data']=$this->ReportModel->p_sale_purchase($all_data);

                $data['stkpoint']     =   $this->ReportModel->f_get_stockpoint($ro);
               
                $data['closing']     =   $this->ReportModel->f_get_balance_rowise($branch,$from_dt,$to_dt,$opndt);
                $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
                $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
                $data['compname']    =   $this->ReportModel->f_select("mm_company_dtls",array('COMP_NAME'),array('COMP_ID'=>$comp_id),1);
                $data['prodname']    =   $this->ReportModel->f_select("mm_product",array('PROD_DESC'), array('PROD_ID'=>$prod_id),1);
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/stk_ro/stk_ro',$data);
                $this->load->view('post_login/footer');

            }else{

                $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, NULL, 0);

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/stk_ro/stk_ro_ip',$data);
                $this->load->view('post_login/footer');
            }

        }

/********************************************************************************************* */

public function stkwsestprep(){
    $branch     =   $this->session->userdata['loggedin']['branch_id'];

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];

        $comp_id    =   $this->input->post('company');

        $prod_id    =   $this->input->post('product');

        // $ro         =   $this->input->post('ro');
        $soc_id     =   $this->input->post('soc_id');

        // $branch     =   $this->session->userdata['loggedin']['branch_id'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));
        $all_data            =   array($from_dt,$to_dt,$comp_id  ,$branch,$soc_id, $prod_id );
        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

        $data['product']     =   $this->ReportModel->f_get_product_dtls_stkp_wse($branch,$from_dt,$to_dt,$comp_id,$prod_id,$soc_id );
        // $data['product']     =   $this->ReportModel->f_get_product_comp_prod_ro($branch,$from_dt,$to_dt,$comp_id,$prod_id,$ro);

        // $data['opening']     =   $this->ReportModel->f_get_balance_rowise($branch,$opndt,$prevdt);

        // $data['purchase']    =   $this->ReportModel->f_get_purchase_rowise($branch,$from_dt,$to_dt);

        // $data['sale']        =   $this->ReportModel->f_get_sale_rowise($branch,$from_dt,$to_dt);
      
        // $data['all_data']=$this->ReportModel->p_soc_wse_sale_purchase($all_data);
        // $data['closing']     =   $this->ReportModel->f_get_balance_rowise($branch,$opndt,$to_dt);

        $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
        $data['all_data']=$this->ReportModel->p_soc_wse_sale_purchase($all_data);
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/stk_wse_p_s/stk_ro',$data);
        $this->load->view('post_login/footer');

    }else{
        $data['stockpoint']    =   $this->ReportModel->f_get_scendry_stk_point($branch); 
        $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, NULL, 0);

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/stk_wse_p_s/stk_ro_ip',$data);
        $this->load->view('post_login/footer');
    }

}

/********************************************************************************************* */
        public function f_get_prodsale_ro(){
            $dist_id = $this->session->userdata['loggedin']['branch_id'];
                $select = array("a.ro_no ","b.short_name" );
                       
                $where      =   array(
        
                "a.comp_id = b.comp_id"  => NULL,
                "a.comp_id"              =>  $this->input->get('company'),
                "a.prod_id"              =>  $this->input->get('prod_id'),
                "a.br"                  => $dist_id
                );
                   
             $ro   = $this->ReportModel->f_select('td_purchase a,mm_company_dtls b',$select,$where,0);
                
            echo json_encode($ro);
        }

        public function f_get_purchase_dt(){
            $dist_id = $this->session->userdata['loggedin']['branch_id'];
                $select = array("a.trans_dt" );
                       
                $where      =   array(
                "a.ro_no"              =>  $this->input->get('ro'),
                "a.br"                  => $dist_id
                );
                   
             $trans_dt   = $this->ReportModel->f_select('td_purchase a',$select,$where,1);
                
                // echo json_encode($trans_dt);
                echo $trans_dt->trans_dt;
        
        }
        
//*********************************************************************** */
public function yrcompwisesale(){
      
        $data['sale']    =   $this->ReportModel->f_get_yrwisecompwisesale();

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/yrcompwisesale',$data);
        $this->load->view('post_login/footer');

     }

     public function yrwisesale(){
      
        $data['sale']    =   $this->ReportModel->f_get_yrwisesale();

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/yrwisesale',$data);
        $this->load->view('post_login/footer');

     }

//*********************************************************************** */
        public function gstrep(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $from_dt    =   $_POST['from_date'];

                $to_dt      =   $_POST['to_date'];

                $branch     =   $this->session->userdata['loggedin']['branch_id'];

                $mth        =  date('n',strtotime($from_dt));

                $yr         =  date('Y',strtotime($from_dt));

                if($mth > 3){

                    $year = $yr;

                }else{

                    $year = $yr - 1;
                }

                $opndt      =  date($year.'-04-01');

                $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

                $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

                // $data['stkpoint']     =   $this->ReportModel->f_get_stockpoint($ro);
                
                $data['purchase']    =   $this->ReportModel->f_get_gst($from_dt,$to_dt);

                $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

                $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/gstinout/gst_stmt',$data);
                $this->load->view('post_login/footer');

            }else{

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/gstinout/gst_stmt_ip');
                $this->load->view('post_login/footer');
            }

        }
 public function gstrepb2c(){
            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $from_dt    =   $_POST['from_date'];

                $to_dt      =   $_POST['to_date'];

                $branch     =   $this->session->userdata['loggedin']['branch_id'];

                $mth        =  date('n',strtotime($from_dt));

                $yr         =  date('Y',strtotime($from_dt));

                if($mth > 3){

                    $year = $yr;

                }else{

                    $year = $yr - 1;
                }

                $opndt      =  date($year.'-04-01');

                $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

                $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

                // $data['stkpoint']     =   $this->ReportModel->f_get_stockpoint($ro);
                
                $data['purchase']    =   $this->ReportModel->f_get_gst_b_to_c($from_dt,$to_dt);

                $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

                $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/gstinout_b_to_c/gst_stmt',$data);
                $this->load->view('post_login/footer');

            }else{

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/gstinout_b_to_c/gst_stmt_ip');
                $this->load->view('post_login/footer');
            }
        }

/****************hsns summery for gst return ******************** */

public function hsnsumryrep(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];

        $branch     =   $this->session->userdata['loggedin']['branch_id'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));

        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

        // $data['stkpoint']     =   $this->ReportModel->f_get_stockpoint($ro);
        
        $data['purchase']    =   $this->ReportModel->f_get_hsn_gst($from_dt,$to_dt);

        $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/hsnsumry/gst_stmt',$data);
        $this->load->view('post_login/footer');

    }else{

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/hsnsumry/gst_stmt_ip');
        $this->load->view('post_login/footer');
    }

}
public function hsnsumrypurrep(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];

        $branch     =   $this->session->userdata['loggedin']['branch_id'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));

        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

        // $data['stkpoint']     =   $this->ReportModel->f_get_stockpoint($ro);
        
        $data['purchase']    =   $this->ReportModel->f_pur_hsn_gst($from_dt,$to_dt);

        $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/hsnsumry/pur_gst_stmt',$data);
        $this->load->view('post_login/footer');

    }else{

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/hsnsumry/pur_gst_stmt_ip');
        $this->load->view('post_login/footer');
    }

}

/********************************************* */
       
       
       
        public function purrep(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $from_dt    =   $_POST['from_date'];

                $to_dt      =   $_POST['to_date'];

                $branch     =   $this->session->userdata['loggedin']['branch_id'];

                $mth        =  date('n',strtotime($from_dt));

                $yr         =  date('Y',strtotime($from_dt));

                if($mth > 3){

                    $year = $yr;

                }else{

                    $year = $yr - 1;
                }

                $opndt      =  date($year.'-04-01');

                $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

                $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));

                // $data['stkpoint']     =   $this->ReportModel->f_get_stockpoint($ro);
                $data['purchase']    =   $this->ReportModel->f_get_purchaserep($branch,$from_dt,$to_dt);

                $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

                $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/purchase/pur_stmt',$data);
                $this->load->view('post_login/footer');

            }else{

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/purchase/pur_stmt_ip');
                $this->load->view('post_login/footer');
            }

        }

/******************************Branchwise Purchase Report at HO (individual and all branch)***************************** */        

        public function purrepbr(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $from_dt    =   $_POST['from_date'];

                $to_dt      =   $_POST['to_date'];

                $company    =    $this->input->post('comid');

                $branch     =  $_POST['br'];


                if($branch!='0'){

                    $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
                    
                    
                    $where1              =   array("district_code"  => $branch);

                    $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

                    $select1             = array("district_code","district_name");

                    $data['all_branch']  =   $this->ReportModel->f_select("md_district", $select1, NULL,0);

                    $data['purchase']=$this->ReportModel->pc($from_dt,$to_dt,$branch,$company);

                    $this->load->view('post_login/fertilizer_main');
                    $this->load->view('report/purchase_br/pur_stmt',$data);
                    $this->load->view('post_login/footer');

            }else{
                
                    $all_data_n           =   array($from_dt,$to_dt,$company);
                    
                    $_SESSION['date']     =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
                    
                    $data['branch']       =   "0";
                    
                    $data['purchase']     =   $this->ReportModel->pcn($from_dt,$to_dt,$company);

                    $this->load->view('post_login/fertilizer_main');
                    $this->load->view('report/purchase_br/pur_stmt',$data);
                    $this->load->view('post_login/footer');
            }

            }else{
                $select1      = array("district_code","district_name");
				$select2      = array("COMP_ID","COMP_NAME");
                $data['all_company']      =   $this->ReportModel->f_select("mm_company_dtls", $select2, array('1 order by COMP_NAME'=>NULL),0);
                $data['all_branch']      =   $this->ReportModel->f_select("md_district", $select1, array('1 order by district_name'=>NULL),0);
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/purchase_br/pur_stmt_ip',$data);
                $this->load->view('post_login/footer');
            }

        }


////************************************************* */
public function crngstunreg(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];

        $branch     =   $this->session->userdata['loggedin']['branch_id'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));

        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
        
        $data['sales']       =   $this->ReportModel->f_get_crngstunreg($branch,$from_dt,$to_dt);

        $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/cancle_invgst/output',$data);
        $this->load->view('post_login/footer');

    }else{

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/cancle_invgst/input');
        $this->load->view('post_login/footer');
    }

}

        public function crngstreg(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $from_dt    =   $_POST['from_date'];

                $to_dt      =   $_POST['to_date'];

                $branch     =   $this->session->userdata['loggedin']['branch_id'];

                $mth        =  date('n',strtotime($from_dt));

                $yr         =  date('Y',strtotime($from_dt));

                if($mth > 3){

                    $year = $yr;

                }else{

                    $year = $yr - 1;
                }

                $opndt      =  date($year.'-04-01');

                $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

                $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
                
                $data['sales']       =   $this->ReportModel->f_get_crngstreg($branch,$from_dt,$to_dt);

                $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

                $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/crn_gst/output',$data);
                $this->load->view('post_login/footer');

            }else{

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/crn_gst/input');
                $this->load->view('post_login/footer');
            }

        }



////************************************************** */


        public function salerep(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $from_dt    =   $_POST['from_date'];

                $to_dt      =   $_POST['to_date'];

                $branch     =   $this->session->userdata['loggedin']['branch_id'];

                $mth        =  date('n',strtotime($from_dt));

                $yr         =  date('Y',strtotime($from_dt));

                if($mth > 3){

                    $year = $yr;

                }else{

                    $year = $yr - 1;
                }

                $opndt      =  date($year.'-04-01');

                $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

                $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
                
                $data['sales']       =   $this->ReportModel->f_get_sales($branch,$from_dt,$to_dt);

                $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);

                $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/sale/output',$data);
                $this->load->view('post_login/footer');

            }else{

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/sale/input');
                $this->load->view('post_login/footer');
            }

        }


        public function salerepbr(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $from_dt    =   $_POST['from_date'];

                $to_dt      =   $_POST['to_date'];

                $soc_id     =   $this->input->post('soc_id');

                $comp_id     =   $this->input->post('comp_id');

                $br         =   $this->input->post('br');

                $branch     =   $this->session->userdata['loggedin']['branch_id'];

                $mth        =  date('n',strtotime($from_dt));

                $yr         =  date('Y',strtotime($from_dt));

                if($mth > 3){

                    $year = $yr;

                }else{

                    $year = $yr - 1;
                }

                $opndt      =  date($year.'-04-01');

                $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

                $_SESSION['date']   =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
                
                $data['sales']      =   $this->ReportModel->f_get_sales_society($branch,$from_dt,$to_dt,$soc_id);
                $data['br_sales']   =   $this->ReportModel->f_get_sales_branch($from_dt,$to_dt,$br,$comp_id);
              
                $where1             =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
                $where2             =   array("district_code"  => $br);
                $select1            =   array("district_code","district_name");
                $data['branch']     =   $this->ReportModel->f_select("md_district", NULL, $where2,1);
                $data['all_branch'] =   $this->ReportModel->f_select("md_district", $select1, NULL,0);
             
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/sale_br/output',$data);
                $this->load->view('post_login/footer');

            }else{

                $select      = array("soc_id","soc_name");
                $select1     = array("district_code","district_name");
                $where       = array("district"  =>  $this->session->userdata['loggedin']['branch_id']);

                $society['societyDtls']   = $this->ReportModel->f_select('mm_ferti_soc',$select,$where,0);
              
                $data['all_company']      =   $this->ReportModel->f_select("mm_company_dtls",array("COMP_ID","COMP_NAME"), array('1 order by COMP_NAME'=>NULL),0);
                $data['all_branch']       = $this->ReportModel->f_select("md_district", $select1,array('1 order by district_name'=>NULL),0);
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/sale_br/input',$data);
                $this->load->view('post_login/footer');
                
            }

        }
        public function salerepsoc(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $from_dt    =   $_POST['from_date'];

                $to_dt      =   $_POST['to_date'];
                // $branch  =  $_POST['br'];
                $soc_id     =   $this->input->post('soc_id');
                $soc_name = $this->ReportModel->get_fersociety_name($soc_id );
          
                $branch     =   $this->session->userdata['loggedin']['branch_id'];

                $mth        =  date('n',strtotime($from_dt));

                $yr         =  date('Y',strtotime($from_dt));
                $all_data   =  array($from_dt,$to_dt,$branch,$soc_id );
                if($mth > 3){

                    $year = $yr;

                }else{

                    $year = $yr - 1;
                }

                $opndt      =  date($year.'-04-01');

                $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

                $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
                
              // $data['sales']    =   $this->ReportModel->f_get_sales_society($branch,$from_dt,$to_dt,$soc_id);  
               
                $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
                $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
                $data['sales']=$this->ReportModel->p_soc_wise_sale($all_data);
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/sale_society/salesocrep',$data);
                $this->load->view('post_login/footer');

            }else{

                $select      = array("soc_id","soc_name");
                
                $where       = array("district"  =>  $this->session->userdata['loggedin']['branch_id']);

                $society['societyDtls']   = $this->ReportModel->f_select('mm_ferti_soc',$select,$where,0);
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/sale_society/input',$society);
                $this->load->view('post_login/footer');
            }

        }
/******************************************************* */
public function salerep_psoc(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];
        // $branch  =  $_POST['br'];
        $soc_id     =   $this->input->post('soc_id');
        $soc_name = $this->ReportModel->get_fersociety_name($soc_id );
   
        $branch     =   $this->session->userdata['loggedin']['branch_id'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));
        $all_data   =  array($from_dt,$to_dt,$branch,$soc_id );
        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
        
      // $data['sales']    =   $this->ReportModel->f_get_sales_society($branch,$from_dt,$to_dt,$soc_id);  
       
        $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
        $data['sales']=$this->ReportModel->p_psoc_wise_sale($all_data);
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/sale_psociety/salerep_p_soc',$data);
        $this->load->view('post_login/footer');

    }else{

        $select      = array("soc_id","soc_name");
        
        $where       = array("district"  =>  $this->session->userdata['loggedin']['branch_id']);

        $society['societyDtls']   = $this->ReportModel->f_select('mm_ferti_soc',$select,$where,0);
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/sale_psociety/input',$society);
        $this->load->view('post_login/footer');
    }

}
		/************************************Crnote Realization Report********************/
public function crnote_reliz_rep(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];
        
        $catg       = $this->input->post('category');

        $comp_id = $this->input->post('company');
        
        $comp_name =$this->ReportModel->get_comp_name($comp_id);
    
        // $branch     =   $this->session->userdata['loggedin']['branch_id'];
        $branch     = $this->input->post('branch');

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));
        
        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
        
        // $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
        
        $data['sales']=$this->ReportModel->f_br_crnote($from_dt,$to_dt,$branch ,$comp_id ,$catg  );
        $data['crnote']=$this->ReportModel->f_adj_crnote_rep($from_dt,$to_dt,$branch ,$comp_id ,$catg  );
        
        $data['compdtls']   = $this->ReportModel->f_select('mm_company_dtls',NULL,NUll,0);
        $data['category']   = $this->ReportModel->f_select("mm_cr_note_category", NULL, NULL,0);
        $data['branch']      = $this->ReportModel->f_select("md_district", NULL, NULL,0);
        $this->load->view('post_login/fertilizer_main');
       // $this->load->view('report/sale_duesocietycm/salerep_p_soc',$data);
        $this->load->view('report/cr_adjrep/input',$data);
        $this->load->view('post_login/footer');

    }else{

        $select      = array("COMP_ID","COMP_NAME");
        
        // $where       = array("district"  =>  $this->session->userdata['loggedin']['branch_id']);
        $company['compdtls']   = $this->ReportModel->f_select('mm_company_dtls',NULL,array('1 order by COMP_NAME'=>NULL),0);
        $company['category']   = $this->ReportModel->f_select("mm_cr_note_category", NULL, array('1 order by cat_desc'=>NULL),0);
        $company['branch']      = $this->ReportModel->f_select("md_district", NULL, array('1 order by district_name'=>NULL),0);

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/cr_adjrep/input',$company);
        $this->load->view('post_login/footer');
    }

}

/***************************Society Wise Delivery Register************************************ */
// public function saledelivery_reg(){

//     if($_SERVER['REQUEST_METHOD'] == "POST") {

//         $from_dt    =   $_POST['from_date'];

//         $to_dt      =   $_POST['to_date'];
//         // $branch  =  $_POST['br'];
//         $soc_id     =   $this->input->post('soc_id');
//         $soc_name = $this->ReportModel->get_fersociety_name($soc_id );
//     //    echo $soc_id;
//     //    die();
//         $branch     =   $this->session->userdata['loggedin']['branch_id'];

//         $mth        =  date('n',strtotime($from_dt));

//         $yr         =  date('Y',strtotime($from_dt));
//         $all_data   =  array($from_dt,$to_dt,$branch,$soc_id );
//         if($mth > 3){

//             $year = $yr;

//         }else{

//             $year = $yr - 1;
//         }

//         $opndt      =  date($year.'-04-01');

//         $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

//         $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
        
//       // $data['sales']    =   $this->ReportModel->f_get_sales_society($branch,$from_dt,$to_dt,$soc_id);  

//     //   die();
       
//         $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
//         $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
//         $data['sales']=$this->ReportModel->p_delivery_reg($from_dt,$to_dt,$branch ,$soc_id   );
//         $this->load->view('post_login/fertilizer_main');
//         $this->load->view('report/sale_duesociety/salerep_p_soc',$data);
//         $this->load->view('post_login/footer');

//     }else{

//         $select      = array("soc_id","soc_name");
        
//         $where       = array("district"  =>  $this->session->userdata['loggedin']['branch_id']);

//         $society['societyDtls']   = $this->ReportModel->f_select('mm_ferti_soc',$select,$where,0);
//         $this->load->view('post_login/fertilizer_main');
//         $this->load->view('report/sale_duesociety/input',$society);
//         $this->load->view('post_login/footer');
//     }

// }
public function saledelivery_reg(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        // $from_dt    =   $_POST['from_date'];

        // $to_dt      =   $_POST['to_date'];

        $from_dt = isset($_POST['from_date']) ? $_POST['from_date'] : date('Y-m-d');
        $to_dt   = isset($_POST['to_date']) ? $_POST['to_date'] : date('Y-m-d');
        
        $soc_id     =   $this->input->post('soc_id');
        $soc_name   = $this->ReportModel->get_fersociety_name($soc_id );
        
        $branch     =   $this->session->userdata['loggedin']['branch_id'];
        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));
        $all_data   =  array($from_dt,$to_dt,$branch,$soc_id );
        
        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
    
       
        $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
        $data['sales']=$this->ReportModel->p_delivery_reg($from_dt,$to_dt,$branch ,$soc_id   );
        $select_soc      = array("soc_id","soc_name");
        
        $where_soc      = array("district"  =>  $this->session->userdata['loggedin']['branch_id']);

        $data['societyDtls']   = $this->ReportModel->f_select('mm_ferti_soc',$select_soc,$where_soc,0);
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/sale_duesociety/input',$data);
        $this->load->view('post_login/footer');

    }
    else{

        $select      = array("soc_id","soc_name");
        
        $where       = array("district"  =>  $this->session->userdata['loggedin']['branch_id']);

        $society['societyDtls']   = $this->ReportModel->f_select('mm_ferti_soc',$select,$where,0);
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/sale_duesociety/input',$society);
        $this->load->view('post_login/footer');
    }

}

/**********************Company Wise Delivery Register************************* */
public function salecompdelivery_reg(){

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $from_dt    =   $_POST['from_date'];

        $to_dt      =   $_POST['to_date'];
        
        // $branch  =  $_POST['br'];
        $soc_id     =   $this->input->post('soc_id');
        $comp_id = $this->input->post('company');
        $soc_name = $this->ReportModel->get_fersociety_name($soc_id );
        $comp_name =$this->ReportModel->get_comp_name($comp_id);
    
        $branch     =   $this->session->userdata['loggedin']['branch_id'];

        $mth        =  date('n',strtotime($from_dt));

        $yr         =  date('Y',strtotime($from_dt));
        $all_data   =  array($from_dt,$to_dt,$branch,$soc_id );
        if($mth > 3){

            $year = $yr;

        }else{

            $year = $yr - 1;
        }

        $opndt      =  date($year.'-04-01');

        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));

        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
        
      // $data['sales']    =   $this->ReportModel->f_get_sales_society($branch,$from_dt,$to_dt,$soc_id);  

        $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
        $data['sales']=$this->ReportModel->p_delivery_reg_compwse($from_dt,$to_dt,$branch ,$comp_id); 
    
        $select      = array("COMP_ID","COMP_NAME");
        
        $where_dist         = array("district"  =>  $this->session->userdata['loggedin']['branch_id']);
        $data['compdtls']   = $this->ReportModel->f_select('mm_company_dtls',$select,NUll,0);
        $this->load->view('post_login/fertilizer_main');
       // $this->load->view('report/sale_duesocietycm/salerep_p_soc',$data);
        $this->load->view('report/sale_duesocietycm/input',$data);
        $this->load->view('post_login/footer');

    }else{

        $select      = array("COMP_ID","COMP_NAME");
        $where       = array("district"  =>  $this->session->userdata['loggedin']['branch_id']);
        $company['compdtls']   = $this->ReportModel->f_select('mm_company_dtls',$select,NUll,0);
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/sale_duesocietycm/input',$company);
        $this->load->view('post_login/footer');
    }

}

/***********************Due Register Report************************************* */

public function cust_payblepaid(){
    $from_dt = isset($_POST['from_date']) ? $_POST['from_date'] : date('Y-m-d');

    $to_dt   = isset($_POST['to_date']) ? $_POST['to_date'] : date('Y-m-d');

    $branch="";
    $all_data="";
    $br_name="";

    if(isset($_POST['submit'])){

        $branch     =   $this->session->userdata['loggedin']['branch_id'];
    
       // $opndt      =  date($year.'-04-01');
    
       // $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));
    
        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
    
    
        $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
    
        $br_name             =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
       
        $all_data            =   $this->ReportModel->f_get_soc_pay($from_dt,$to_dt , $branch);
        
    }
    
    $data = array(
                'frm_dt'    => $from_dt,
                'to_dt'     => $to_dt,
                'branch'    => $branch,
                'all_data'  => $all_data,
                'br_name' => $br_name
    );
    
        $this->load->view('post_login/fertilizer_main');
    
        $this->load->view('report/cust_payblepaid/stk_stmt_ip',$data);
    
        $this->load->view('post_login/footer');
    }

public function soc_payblepaid(){
    if($_SERVER['REQUEST_METHOD'] == "POST") {
    
        $from_dt    =   $_POST['from_date'];
    
        $to_dt      =   $_POST['to_date'];
    
        $comp      = $_POST['company'];
       
        $branch     =   $this->session->userdata['loggedin']['branch_id'];
    
        $mth        =  date('n',strtotime($from_dt));
    
        $yr         =  date('Y',strtotime($from_dt));
        $all_data   =   array($from_dt,$to_dt,$comp );
        if($mth > 3){
    
            $year = $yr;
    
        }else{
    
            $year = $yr - 1;
        }
    
        $opndt      =  date($year.'-04-01');
    
        $prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));
    
        $_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
    
         $data['product']  =   $this->ReportModel->f_get_product_list_nw($opndt);
    
        $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
    
        $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, NULL,1);
        $data['all_data']    =   $this->ReportModel->f_get_allsoc_pay($from_dt,$to_dt,$comp );
    
        $data['paid']=$this->ReportModel->f_get_allsoc_paid($from_dt,$to_dt);
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/soc_payblepaid/stk_stmt',$data);
        $this->load->view('post_login/footer');
    
    }else{
        $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL,array('1 order by COMP_NAME'=>NULL), 0);
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/soc_payblepaid/stk_stmt_ip',$data);
        $this->load->view('post_login/footer');
    }
    
    }
    /************************************************************ */

    public function yrwssale(){
        if($_SERVER['REQUEST_METHOD'] == "POST") {
                 
             $frmyr      = $_POST['frmyr'];
             $toyr      = $_POST['toyr'];

             $select   = array("fin_yr" );
             $where_frmyr     = array("sl_no" =>$frmyr   );
         
             $where_tomyr     = array("sl_no" =>$frmyr   );
             $data['frmyrnm'] = $this->ReportModel->f_select('md_fin_year ',$select,$where_frmyr,1);
             $data['toyrnm'] = $this->ReportModel->f_select('md_fin_year ',$select,$where_tomyr,1);

            $branch     =   $this->session->userdata['loggedin']['branch_id'];
            $data['sale']      =   $this->ReportModel->f_get_yrwisesale($frmyr,$toyr);
            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/yrwsesale/yrwisesale',$data);
            $this->load->view('post_login/footer');
        
        }else{
            $data['yr']    =   $this->ReportModel->f_select("md_fin_year", NULL, NULL, 0);
            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/yrwsesale/stk_stmt_ip',$data);
            $this->load->view('post_login/footer');
        }
        
        }
        
        public function yrcompwssale(){
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                     
                 $frmyr      = $_POST['frmyr'];
                 $toyr      = $_POST['toyr'];

                 $select   = array("fin_yr" );
                 $where_frmyr     = array("sl_no" =>$frmyr);
             
                 $where_tomyr     = array("sl_no" =>$frmyr);
                 $data['frmyrnm'] = $this->ReportModel->f_select('md_fin_year ',$select,$where_frmyr,1);
                 $data['toyrnm'] = $this->ReportModel->f_select('md_fin_year ',$select,$where_tomyr,1);

                 $branch     =   $this->session->userdata['loggedin']['branch_id'];
                $data['sale']      =   $this->ReportModel->f_get_yrwisecompwisesale($frmyr,$toyr);
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/yrcompwsesale/yrcompwisesale',$data);
              
                $this->load->view('post_login/footer');
            
            }else{
                $data['yr']    =   $this->ReportModel->f_select("md_fin_year", NULL, NULL, 0);
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/yrcompwsesale/stk_stmt_ip',$data);
                $this->load->view('post_login/footer');
            }
            
            }


/********************************************************* */

        public function stkstkpnt(){

            if($_SERVER['REQUEST_METHOD'] == "POST") {
				
                $to_dt      =   $_POST['to_date'];
                $comp_id    =   $this->input->post('company');
                $branch     =   $this->session->userdata['loggedin']['branch_id'];
                $mth        =  date('n',strtotime($to_dt));
                $yr         =  date('Y',strtotime($to_dt));
                if($mth > 3){

                    $year = $yr;

                }else{

                    $year = $yr - 1;
                }

                $opndt      =  date($year.'-04-01');
                $_SESSION['date']    =   date('d/m/Y',strtotime($opndt)).'-'.date('d/m/Y',strtotime($to_dt));
                $data['product']     =   $this->ReportModel->f_get_product_list($branch,$opndt);
                $data['stocks']      =   $this->ReportModel->f_get_stock_stockwise($branch,$to_dt);
                $where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
                $data['branch']      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/stk_stkpnt/stk_stkpnt',$data);
                $this->load->view('post_login/footer');

            }else{

                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/stk_stkpnt/stk_stkpnt_ip');
                $this->load->view('post_login/footer');
            }

        }

/*************************************Society Ledger Report************************************************************** */        
		
	public function soc_ledger(){
		$from_dt = isset($_POST['from_date']) ? $_POST['from_date'] : date('Y-m-d');
		$to_dt = isset($_POST['to_date']) ? $_POST['to_date'] : date('Y-m-d');
		$soc_id = explode('-',$this->input->post('soc_id'))[0];

		$product = array();
		$branch = array();
		$all_data = array();
		$paid = array();
		$br_name = array();

		if(isset($_POST['submit'])){
			
				$branch     =   $this->session->userdata['loggedin']['branch_id'];
				$mth        =  date('n',strtotime($from_dt));
				$yr         =  date('Y',strtotime($from_dt));
				if($mth > 3){
					$year = $yr;
				}else{
					$year = $yr - 1;
				}
				$opndt      =  date($year.'-04-01');
				$prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($from_dt)));
				$_SESSION['date']    =   date('d/m/Y',strtotime($from_dt)).'-'.date('d/m/Y',strtotime($to_dt));
				$product    =   $this->ReportModel->f_get_product_list($branch,$opndt);
			
				$where1              =   array("district_code"  =>  $this->session->userdata['loggedin']['branch_id']);
				$br_name      =   $this->ReportModel->f_select("md_district", NULL, $where1,1);
				$all_data =$this->ReportModel->f_get_soc_ledger($from_dt,$to_dt , $branch,$soc_id);
				$paid     =$this->ReportModel->f_get_soc_paid($from_dt,$to_dt , $branch);
                $gstno=explode('-',$this->input->post('soc_id'))[1];
		}else{
            $gstno="";
        }
        
        
        $data = array(
            'frm_dt' => $from_dt,
            'to_dt' => $to_dt,
            'product' => $product,
            'branch' => $branch,
            'all_data' => $all_data,
            'paid' => $paid,
            'br_name' => $br_name,
            'gstno'=>$gstno
        );
		$sselect          =   array('soc_id','soc_name','gstin');
		$swhere           =   array('district' => $this->session->userdata['loggedin']['branch_id'] );
        $data['soc']      =   $this->ReportModel->f_select("mm_ferti_soc",$sselect, $swhere,0);
      
        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/society_ledger/sl_ip',$data);
        $this->load->view('post_login/footer');
    }

     public function advance_report(){
       
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $comp_idd  = $_POST['company'];

            $com=explode(',', $comp_idd);
            $comp_id=$com[0];
            $data['companyName']=$com[1];
            $frm_date = $this->input->post('fr_date');
            $to_date  = $this->input->post('to_date');

            $memoNumber=$this->input->post('memoNumber');
            if($memoNumber==''||$memoNumber==null){
            
                $data['tableData']=$this->ReportModel->getallAdvData($comp_id,$frm_date,$to_date,null);
                $data['tableDatasummary']=$this->ReportModel->getallAdvData_summary($comp_id,$frm_date,$to_date,null);
                $data['total_Voucher']=$this->ReportModel->totalAdvVoucher($comp_id,$frm_date,$to_date,null);

                $data['fDate']= $frm_date;
                $data['tDate']=$to_date;

            }else{

              $data['tableData']=$this->ReportModel->getallAdvData($comp_id,$frm_date,$to_date,$memoNumber);
              $data['tableDatasummary']=$this->ReportModel->getallAdvData_summary($comp_id,$frm_date,$to_date,$memoNumber);
              $data['total_Voucher']=$this->ReportModel->totalAdvVoucher($comp_id,$frm_date,$to_date,$memoNumber);
              $data['fDate']= $frm_date;
              $data['tDate']=$to_date;

            }
           $data['sig'] = $this->input->post('sig_comb');
           $data['company_id'] = $com[0];
           $this->load->view('post_login/fertilizer_main');
           $this->load->view('report/advance_payment/advPay.php',$data);
           $this->load->view('post_login/footer');
        }else{

            $data['branch']     =   $this->ReportModel->f_get_district_asc();
            $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, array('1 order by COMP_NAME'=>NULL), 0);

            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/advance_payment/advPay_ip.php',$data);
            $this->load->view('post_login/footer');
        }
    }
		
    public function advance_payment(){
       
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $comp_idd  = $_POST['company'];

            $com=explode(',', $comp_idd);
            $comp_id=$com[0];
            $data['companyName']=$com[1];
            $frm_date = $this->input->post('fr_date');
            
            $to_date  = $this->input->post('to_date');
            $refereceNo  = $this->input->post('refereceNo');
            if($refereceNo==""||$refereceNo==null){
                $data['tableData']=$this->ReportModel->getCompanyPayment($comp_id,$frm_date,$to_date);
               
                $data['tableData_district_name']=$this->ReportModel->getCompanyPayment_district_name($comp_id,$frm_date,$to_date);

                $data['total_Voucher']=$this->ReportModel->totalCompanyPaymentVoucher($comp_id,$frm_date,$to_date);
            }else{
                $data['tableData']=$this->ReportModel->getCompanyPayment($comp_id,$frm_date,$to_date,$refereceNo);

                $data['tableData_district_name']=$this->ReportModel->getCompanyPayment_district_name($comp_id,$frm_date,$to_date,$refereceNo);

                $data['total_Voucher']=$this->ReportModel->totalCompanyPaymentVoucher($comp_id,$frm_date,$to_date,$refereceNo);
                }
         
          $data['sig'] = $this->input->post('sig_comb');
          $data['company_id'] = $com[0];
          $data['fDate']= $frm_date;
          $data['tDate']=$to_date;
          
           $this->load->view('post_login/fertilizer_main');
           $this->load->view('report/advance_payment_company/advPay.php',$data);
           $this->load->view('post_login/footer');
        }else{

            $data['branch']     =   $this->ReportModel->f_get_district_asc();
            $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, array('1 order by COMP_NAME'=>NULL), 0);

            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/advance_payment_company/advPay_ip.php',$data);
            $this->load->view('post_login/footer');
        }
    }


    public function overdue_list(){
        if($this->input->post()){
            
                $date=$this->input->post('from_date');
                $data['allData']=$this->ReportModel->overdue_list_model($date);
                $data['date']= $date;
                $this->load->view('post_login/fertilizer_main');
                $this->load->view('report/over_due_list/over_due_list.php', $data);
                $this->load->view('post_login/footer');
        
        }else{
            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/over_due_list/over_due_list_ip.php');
            $this->load->view('post_login/footer');
        }
    }

// ================================ Monthly stock report at HO =======================================
    public function stock_report(){
        if($this->input->post()){

        }else{
            $select=array('dist_sort_code','district_code');
            $data=array(
                'distData'=>$this->ReportModel->f_select("md_district", $select, NULL, 0)
            );
            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/monthlyReport/stock_report/input.php', $data);
            $this->load->view('post_login/footer');
        }
    }

    public function stock_report_Popu_pro(){
        $fDate=$this->input->post('fDate');
        $tDate=$this->input->post('tDate');
       echo $this->ReportModel->stock_report_Popu_pro($fDate, $tDate);
    }

    public function papulate_blance(){
        $fDate=$this->input->post('fDate');
        $tDate=$this->input->post('tDate');
        $dist=$this->input->post('dist');
       echo $this->ReportModel->papulate_blance($fDate, $tDate,$dist);
    }
// ================================ end stock report =======================================

// ================================Monthly Sale report at Ho=======================================
    public function sale_report(){
        if($this->input->post()){

        }else{
            $select=array('dist_sort_code','district_code');
            $data=array(
                'distData'=>$this->ReportModel->f_select("md_district", $select, NULL, 0)
            );
            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/monthlyReport/sale/input.php', $data);
            $this->load->view('post_login/footer');
        }
    }

    public function sale_report_Popu_pro(){
        $fDate=$this->input->post('fDate');
        $tDate=$this->input->post('tDate');
       echo $this->ReportModel->stock_report_Popu_sale($fDate, $tDate);
    }

    public function papulate_blance_sale(){
        $fDate=$this->input->post('fDate');
        $tDate=$this->input->post('tDate');
        $dist=$this->input->post('dist');
       echo $this->ReportModel->papulate_blance_sale($fDate, $tDate,$dist);
    }
// ================================ END Sale report =======================================

// ================================ Monthly Purchase report at HO =======================================
    public function purchase_report(){
        if($this->input->post()){

        }else{
            $select=array('dist_sort_code','district_code');
            $data=array(
                'distData'=>$this->ReportModel->f_select("md_district", $select, NULL, 0)
            );
            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/monthlyReport/purchase/input.php', $data);
            $this->load->view('post_login/footer');
        }
    }

    public function purchase_report_Popu_pro(){
        $fDate=$this->input->post('fDate');
        $tDate=$this->input->post('tDate');
        echo $this->ReportModel->stock_report_Popu_purchase($fDate, $tDate);
    }

    public function papulate_blance_purchase(){
        $fDate=$this->input->post('fDate');
        $tDate=$this->input->post('tDate');
        $dist=$this->input->post('dist');
       echo $this->ReportModel->papulate_blance_purchase($fDate, $tDate,$dist);
    }
// ================================ End Purchase report =======================================


// ====================================active society===============================
    public function active_society(){
        if($this->input->post()){
        $fDate=$this->input->post("fr_date");
        $tDate=$this->input->post("to_date");
        $dist=$this->input->post("district");

        $data=array(
            'fdate'=>$fDate,
            'tDate'=>$tDate,
            'reportdata'=>$this->ReportModel->active_society($fDate, $tDate,$dist)
        );

        $this->load->view('post_login/fertilizer_main');
        $this->load->view('report/active_society/active_society_view.php',$data);
        $this->load->view('post_login/footer');  

        }else{

            $data['branch']     =   $this->ReportModel->f_get_district_asc();
            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/active_society/active_society_ip.php',$data);
            $this->load->view('post_login/footer');  
        }
    }

    //   ******** Code start for companywise districtwise due    ///
    public function company_due(){
       
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $comp_idd  = $_POST['company'];
            $com=explode(',', $comp_idd);
            $comp_id=$com[0];
            $data['companyName']=$com[1];
            $dist = $this->input->post('district');
            $frm_date = $this->input->post('fr_date');

            $to_date  = $this->input->post('to_date');
            $data['tableData']=$this->ReportModel->getCompanyPayment($comp_id,$frm_date,$to_date);
            $data['tableData_district_name']=$this->ReportModel->getCompanyPayment_due($dist,$comp_id,$frm_date,$to_date);
            $data['tableData_districtwise']=$this->ReportModel->ComPaydistrictwise_due($comp_id,$frm_date,$to_date);
            $data['distname']    =   $this->ReportModel->f_select("md_district", NULL, array('district_code'=>$dist), 1);
            $data['total_Voucher']=$this->ReportModel->totalCompanyPaymentVoucher($comp_id,$frm_date,$to_date);
        
            $data['fDate']= $frm_date;
            $data['tDate']=$to_date;
          
           $this->load->view('post_login/fertilizer_main');
           $this->load->view('report/company_due_payment/advPay.php',$data);
           $this->load->view('post_login/footer');
        }else{

            $data['branch']     =   $this->ReportModel->f_get_district_asc();
            $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, array('1 order by COMP_NAME'=>NULL), 0);

            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/company_due_payment/advPay_ip.php',$data);
            $this->load->view('post_login/footer');
        }
    }
    public function tcs_payable(){
        if($_SERVER['REQUEST_METHOD'] == "POST") {

           
            $frm_date = $this->input->post('fr_date');
            $to_date  = $this->input->post('to_date');
            $data['tableData']=$this->ReportModel->tcs_payable($frm_date,$to_date);
            $data['distname']    =   $this->ReportModel->f_select("md_district", NULL, array('district_code'=>$this->session->userdata['loggedin']['branch_id']), 1);
            $data['fDate']= $frm_date;
            $data['tDate']=$to_date;
          
           $this->load->view('post_login/fertilizer_main');
           $this->load->view('report/tcs_payable/advPay.php',$data);
           $this->load->view('post_login/footer');
        }else{

            $data['branch']     =   $this->ReportModel->f_get_district_asc();
            $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, array('1 order by COMP_NAME'=>NULL), 0);
            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/tcs_payable/advPay_ip.php',$data);
            $this->load->view('post_login/footer');
        }
    }
    public function cancel_invoice_list(){
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $frm_date = $this->input->post('fr_date');
            $to_date  = $this->input->post('to_date');
            $bt  = $this->input->post('bt');
            
            $select   = array('a.*','b.branch_name');
            
            if($bt == 1){
                $where = array('a.br_cd=b.id'=> NULL,'a.do_dt >='=>$frm_date,'a.do_dt <='=>$to_date ,'a.ack !='=>'');
            }else{
                $where = array('a.br_cd=b.id'=> NULL,'a.do_dt >='=>$frm_date,'a.do_dt <='=>$to_date ,'a.ack ='=>'');
            }
            $data['tableData']=$this->ReportModel->f_select("td_sale_cancel a,md_branch b", NULL, $where, 0);
            $data['distname']    =   $this->ReportModel->f_select("md_district", NULL, array('district_code'=>$this->session->userdata['loggedin']['branch_id']), 1);
            $data['fDate']= $frm_date;
            $data['tDate']=$to_date;
            $data['bt']   = $bt;
          
           $this->load->view('post_login/fertilizer_main');
           $this->load->view('report/cancel_invoice/data_list.php',$data);
           $this->load->view('post_login/footer');
        }else{

            $data['branch']     =   $this->ReportModel->f_get_district_asc();
            $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, array('1 order by COMP_NAME'=>NULL), 0);
            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/cancel_invoice/data_ip.php',$data);
            $this->load->view('post_login/footer');
        }
    }
    public function tcs_report(){
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $frm_date = $this->input->post('fr_date');
            $to_date  = $this->input->post('to_date');
            $select   = array('a.*','b.branch_name','c.COMP_NAME');

            $whered = array();$wherec = array();
            if($this->input->post('branch_id') != 0){
                $whered = array('a.br '=>$this->input->post('branch_id'));
            }
            if($this->input->post('comp_id') != 0){
                $wherec = array('a.comp_id '=>$this->input->post('comp_id'));
            }
            $where = array('a.br=b.id'=> NULL,'a.comp_id=c.COMP_ID'=> NULL,'a.invoice_dt >='=>$frm_date,'a.invoice_dt <='=>$to_date);
            
            $data['tableData'] = $this->ReportModel->f_select("td_purchase a,md_branch b,mm_company_dtls c", NULL,array_merge($where,$whered,$wherec), 0);
            $data['fDate']= $frm_date;
            $data['tDate']=$to_date;
          
           $this->load->view('post_login/fertilizer_main');
           $this->load->view('report/tcs/data_list.php',$data);
           $this->load->view('post_login/footer');
        }else{

            $data['branch']     =   $this->ReportModel->f_get_district_asc();
            $data['company']    =   $this->ReportModel->f_select("mm_company_dtls", NULL, array('1 order by COMP_NAME'=>NULL), 0);
            $this->load->view('post_login/fertilizer_main');
            $this->load->view('report/tcs/data_ip.php',$data);
            $this->load->view('post_login/footer');
        }
    }
    
        
  }
