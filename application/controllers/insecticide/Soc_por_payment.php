<?php
	class Soc_por_payment extends MX_Controller{

		protected $sysdate;

		protected $fin_year;

		public function __construct(){

			parent::__construct();	
			$this->load->model('Soc_por_paymodel');
			$this->load->model('AdvanceModel');
			$this->load->model('ApiVoucher');
			$this->load->helper('paddyrate_helper');
			$this->load->model('Society_paymentModel');
			$this->session->userdata('fin_yr');
			if(!isset($this->session->userdata['loggedin']['user_id'])){
            
            redirect('User_Login/login');

            }
		}


		public function paylist()
		{   $db2 = $this->load->database('socpaydb', TRUE);
			$pwehere = array('a.brn_id = b.district_code' => NULL,'a.approve_status'=>'U','(a.status = "success" or a.status IS NULL) '=>NULL,'a.bank_status IS NULL'=>NULL);
			$data['paylist']  = $this->Soc_por_paymodel->f_pselect('td_payment a,v_district b',NULL,$pwehere,0);
			$this->load->view("post_login/fertilizer_main");
			$this->load->view("soceity_pay_portal/dashboard",$data);
			$this->load->view('search/search');
			$this->load->view('post_login/footer');
			
		}
		public function paydetail(Type $var = null)
		{

			$pwehere = array('order_id'=>$this->input->get('order_id'));
			$data['payment']  = $this->Soc_por_paymodel->f_pselect('td_payment',NULL,$pwehere,1);
			$this->load->view("post_login/fertilizer_main");
			$this->load->view("soceity_pay_portal/detailpage",$data);
			$this->load->view('post_login/footer');

		}
		public function advpayapprove(Type $var = null)
		{
			$order_id    = $this->input->get('order_id');
			$pay_data    = $this->Soc_por_paymodel->f_pselect('td_payment',NULL,array('order_id'=>$order_id), 1);
			if($pay_data->payment_type == 'A'){
					
					$branch      = $pay_data->brn_id;
					$soc_id      = $pay_data->soc_id;
					$bank_id     = 43;
					$finYr       = $this->session->userdata['loggedin']['fin_id'];
					$fin_year    = $this->session->userdata['loggedin']['fin_yr'];
					$select         = array( "dist_sort_code" );
					$where          = array( "district_code"     =>  $branch );
					$brn            = $this->AdvanceModel->f_select("md_district",$select,$where,1);  
					$transCd 	    = $this->AdvanceModel->get_advance_code($branch,$finYr);
					$receipt        = 'Adv/'.$brn->dist_sort_code.'/'.$fin_year.'/'.$transCd->sl_no;
					
					//if(1 == 1){

						$select_bnkacc         = array("acc_code"
						);
						$where_bnkacc          = array(
							"sl_no"     => $bank_id
						);
					$bnk_acc = $this->AdvanceModel->f_select("mm_feri_bank",$select_bnkacc,$where_bnkacc,1);
					//}
					
					$select_adv         = array( "adv_acc");

					$where_adv  = array(
								"district" =>  $branch,
								"soc_id"   => $soc_id
							);

					$adv_acc= $this->AdvanceModel->f_select("mm_ferti_soc",$select_adv,$where_adv,1);
				
					$bbranch  =  $bank_id;
					if(empty($bbranch)){
					$branchid=0;
					}else{
						$branchid=$bbranch;
						
					}
						$data_array = array (

								"trans_dt" 			=> date('Y-m-d'),

								"sl_no" 			=> $transCd->sl_no,
								
								"receipt_no"        => $receipt,

								"fin_yr"            => $finYr,

								"branch_id"  		=> $branch,

								"soc_id"            => $soc_id,

								"cshbnk_flag"        => '1',

								"trans_type"   		=> 'I',

								"adv_amt"			=> $pay_data->amount,

								"bank"              => $branchid,

								"remarks" 			=> $pay_data->status,

								"referenceNo"		=> NULL,

								"created_by"    	=> $this->session->userdata['loggedin']['user_name'],    

								"created_dt"    	=>  date('Y-m-d h:i:s')
							);
							
							$data_array_fin=$data_array;
							$data_array_fin['acc_code'] = $bnk_acc->acc_code; 
							$data_array_fin['adv_acc'] = $adv_acc->adv_acc; 

							$select_soc         = array("soc_name");
							$where_soc           = array("soc_id"     => $soc_id);
							$soc_name = $this->AdvanceModel->f_select("mm_ferti_soc",$select_soc,$where_soc,1);
							
							$data_array_fin['rem'] ="Advance Received From ".$soc_name->soc_name.','.$this->input->post('remarks');
							$select_br    = array("dist_sort_code");
							$where_br     = array("district_code"=> $branch );
											
							$data_array_fin['fin_fulyr']=$fin_year;
							$data_array_fin['br_nm']= $brn->dist_sort_code;
							
					if($this->ApiVoucher->f_advjnl($data_array_fin) == 1){
						$this->AdvanceModel->f_insert('tdf_advance', $data_array);
						$order_id = $this->input->get('order_id');
						$data_array = array('approve_status'=>'A',
										'approved_by' => $this->session->userdata['loggedin']['user_id'],
										'approve_at' =>date("Y-m-d h:i:s"));
						$where      = array('order_id'=>$order_id);
						$data = $this->Soc_por_paymodel->f_pedit('td_payment',$data_array, $where);
						
						$this->session->set_flashdata('msg', 'Successfully Added');
					}else{
						$this->session->set_flashdata('msg', 'Error in accounting!!');
					}
		    } 
			redirect('fert/sppay/bpaymentlist');
		}
	public function invpay_approve(Type $var = null)
	{
			$order_id    = $this->input->get('order_id');
			$pay_data    = $this->Soc_por_paymodel->f_pselect('td_payment',NULL,array('order_id'=>$order_id), 1);
			$invoice_id  = $pay_data->invoice_id;
			$soc_id      = $pay_data->soc_id;
			$paid_dt     = $pay_data->trans_date;
			$note        = $pay_data->note;
			$cheque_no   = $pay_data->cheque_no;
			$cheque_dt   = $pay_data->cheque_dt;
			$bank_id     = 43;
			
            
			if($pay_data->payment_type == 'I'){

			$br_cd        = $this->session->userdata['loggedin']['branch_id'];
			$fin_id       = $this->session->userdata['loggedin']['fin_id'];
			$fin_year     = $this->session->userdata['loggedin']['fin_yr'];
			$transCd 	  = $this->Society_paymentModel->get_soc_pay_code($br_cd,$fin_id);
		
			$month        = date('m');
			
			$select_dist         = array("dist_sort_code" );
			$where_dist          = array("district_code"     =>  $br_cd );
            $brn                 = $this->AdvanceModel->f_select("md_district",$select_dist,$where_dist,1);  
            $adv_transCd 	     = $this->AdvanceModel->get_advance_code($br_cd,$fin_id);
            $adv_receipt         = 'Adv/'.$brn->dist_sort_code.'/'.$fin_year.'/'.$adv_transCd->sl_no;

			$sale_data           = $this->AdvanceModel->f_select("td_sale",NULL,array('trans_do' =>$invoice_id ),1);  
			$ro                  = $sale_data->sale_ro;
			$comp_id             = $sale_data->comp_id;
			$do_dt               = $sale_data->do_dt;
			$prod_id             = $sale_data->prod_id;

			$pur_data           = $this->AdvanceModel->f_select("td_purchase",NULL,array('ro_no' =>$ro ),1);  
			$rate               = $pur_data->rate;

			$select_comp         = array("short_name" );
			$where_comp          = array("b.sale_ro" => $ro,"a.comp_id=b.comp_id"=>NULL );

			$select_bnkacc       = array("acc_code");
			$select_socacc       = array("acc_cd");
			$where_socacc        = array("soc_id"     => $soc_id);
			$soc_acc             = $this->Society_paymentModel->f_select("mm_ferti_soc",$select_socacc,$where_socacc,1);
			$soc_id              = $soc_id;					 
			$select_soc          = array("soc_name");
		    $where_soc           = array("soc_id"     => $soc_id);
	        $soc_name            = $this->AdvanceModel->f_select("mm_ferti_soc",$select_soc,$where_soc,1);
		    $cnt                 = $this->Society_paymentModel->check_soc_paytype($ro ,$br_cd);
			$soc_id       = $soc_id;

            ///   Code Detail For Bank    //
			$bnk_idd=$bank_id;
			$bnk_id=$bnk_idd;
			$bnk_acc = $this->AdvanceModel->f_select("mm_feri_bank",$select_bnkacc,array("sl_no"=> $bank_id),1);
			$bnk_acc_id=$bnk_acc->acc_code;
            //   Code end for bank detail   //

			$total  = 0;
			$ro          = $ro;
			$select_comp = array("short_name" );
			$where_comp  = array("b.sale_ro" => $ro,
									"a.comp_id=b.comp_id"=>NULL );

			$comp_short_name  = $this->Society_paymentModel->f_get_distinct('mm_company_dtls a,td_sale b',$select_comp,$where_comp,1);
			$cust_pay_recipt  = 'RCPT/'.$brn->dist_sort_code.'/'.$comp_short_name->short_name.'/'.$month.'/'.$fin_year.'/'.$transCd->sl_no;

			$net_amount = $pay_data->amount;

			$soldqty = $sale_data->qty;

			$unit_rate = $net_amount/$soldqty;

			$tot_amt = $net_amount;

		    $tot_qty=	round(($tot_amt/$unit_rate),3);
            if($pay_data->payment_mode == 'I'){
				$pay_type = 8;
			}else if($pay_data->payment_mode == 'C'){
				$pay_type = 3;
			}else{
				$pay_type = 9;
			}
            
            
					$tot_paid_amt    = 0.00;
					$tot_soc         = 0.00;
					$tot_sundry      = 0.00;
					$tot_adv		 = 0.00;
					$tot_csh		 = 0.00;
					$tot_drft		 = 0.00;
					$tot_payord		 = 0.00;
					$tot_nft		 = 0.00;
					$tot_chq         = 0.00;
               
                    //    Code start for entering  data to  tdf_payment_received  
						$trans_type = $pay_type;

						$paid_amt=$net_amount;
						$tot_paid_amt =$net_amount;
						$pay_soc_id= $soc_id;
						$cust_pay_recipt     = 'RCPT/'.$brn->dist_sort_code.'/'.$comp_short_name->short_name.'/'.$month.'/'.$fin_year.'/'.$transCd->sl_no;
						
                        $data  = array(    'sl_no'              => $transCd->sl_no,
                                            'paid_id'           => $cust_pay_recipt,
                                            'paid_dt'           => $paid_dt,
                                            'soc_id'            => $soc_id,
                                            'sale_invoice_no'   => $invoice_id,
                                            'sale_invoice_dt'   =>  $do_dt,
											'ro_no'             => $ro,
											'comp_id'           => $comp_id,
											'prod_id'           => $prod_id,
											'ro_rt'             => $rate,
                                            'adj_dr_note_amt'   => 0,
                                            'adj_adv_amt'       => 0,
                                            'net_recvble_amt'    => $net_amount,
											'tot_recvble_amt'    => $net_amount,
											'remarks'           => $note,
											'bnk_id'            => $bnk_id,
											'cshbnk_flag'       => 1,
                                            'pay_type'           => $pay_type,
											'paid_amt'           => $net_amount,
											'paid_qty'           => $tot_qty,
											'ref_no'             => $cheque_no,
											'ref_dt'             => $cheque_dt,
                                            "created_by"         =>  $this->session->userdata['loggedin']['user_name'],
                                            "created_dt"         =>  date('Y-m-d H:i:s'),
                                            'branch_id'          => $br_cd,
											'fin_yr'             => $fin_id,
										    'approval_status'    =>'A');

					$this->Society_paymentModel->f_insert('tdf_payment_recv', $data);

                      
						
						$tot_soc = $net_amount;
						$tot_bnk = $net_amount;
				
					 //    End code for entering  data to  tdf_payment_received  

					$data2     = array(   
                                            
						'paid_id'        	=> $cust_pay_recipt,
	
						'paid_dt'           => $paid_dt,
	
						'soc_id'            => $soc_id,
	
						'sale_invoice_no'   => $invoice_id,
	
						'sale_invoice_dt'   =>  $do_dt,
	
						'ro_no'             => $ro,
	
						'comp_id'           => $comp_id,
	
						'prod_id'           => $prod_id,
	
						'ro_rt'             => $rate,
	
						'adj_dr_note_amt'    => 0,
	
						'adj_adv_amt'        => 0,
	
						'net_recvble_amt'    => $net_amount,
						
						'tot_recvble_amt'    => $net_amount,
						
						'remarks'           => $note,
	
						'bnk_id'            => $bnk_id,
						
						'paid_amt'           => $tot_bnk,
						
						"created_by"         =>  $this->session->userdata['loggedin']['user_name'],
	
						"created_dt"         =>  date('Y-m-d H:i:s'),
	
						'branch_id'          => $br_cd,
	
						'fin_yr'             => $fin_id,
						'cshbank'			 => 1,

						'abk_acc_code'		 => $bnk_acc_id,
						
						'approval_status'    =>'A');
	


						$data_array_fin=$data2;
				       
						$data_array_fin['acc_code'] = $soc_acc->acc_cd;
						$data_array_fin['rem'] ="Amount Received From ".$soc_name->soc_name." vide sale invoice no: " .$invoice_id;
						/***********For Cash or Bank head */
						if($tot_bnk > 0 ||$tot_bnk != '' || $tot_bnk !=null){
							
						$this->ApiVoucher->f_recvjnl($data_array_fin);
						}
						// }
				
						$data3     = array(   
                                            
							'paid_id'        	=> $cust_pay_recipt,
		
							'paid_dt'           =>  $paid_dt,
		
							'soc_id'            =>  $soc_id,
		
							'sale_invoice_no'   =>  $invoice_id,
		
							'sale_invoice_dt'   =>  $do_dt,
		
							'ro_no'             =>  $ro,
		
							'comp_id'           =>  $comp_id,
		
							'prod_id'           =>  $prod_id,
		
							'ro_rt'             =>  $rate,
		
							'adj_dr_note_amt'    => 0,
		
							'adj_adv_amt'        => 0,
		
							'net_recvble_amt'    => $net_amount,
							
							'tot_recvble_amt'    => $net_amount,
							
							'remarks'           => $note,
		
							'bnk_id'            => $bnk_id,
							
							'paid_amt'          => $tot_soc,
								
							"created_by"        =>  $this->session->userdata['loggedin']['user_name'],
		
							"created_dt"        =>  date('Y-m-d H:i:s'),
		
							'branch_id'         => $br_cd,
		
							'fin_yr'            => $fin_id,
							
							'approval_status'   =>'A');
							
						$data_array_fin=$data3;
						
						$data_array_fin['acc_cd'] = $soc_acc->acc_cd; 

						
						$data_array_fin['rem'] ="Amount Received From ".$soc_name->soc_name." vide sale invoice no: " .$ro;
						
						
					   $this->ApiVoucher->f_recvjnl_soc($data_array_fin);
					   $data_array = array('approve_status'=>'A',
										'approved_by' => $this->session->userdata['loggedin']['user_id'],
										'approve_at' =>date("Y-m-d h:i:s"));
						$where      = array('order_id'=>$order_id);
						$data = $this->Soc_por_paymodel->f_pedit('td_payment',$data_array, $where);
				
                    $this->session->set_flashdata('msg', 'Successfully Added');
		    }
					redirect('fert/sppay/bpaymentlist');
	}

    //  **************  Here code start for benfed payment list     //
	public function bpaymentlist(){
        // if($_SERVER['REQUEST_METHOD'] == "POST") {
		// 	$from_dt    =   $this->input->post('from_date');
		// 	$to_dt      =   $this->input->post('to_date');
		// 	$br_cd   = $this->session->userdata['loggedin']['branch_id'];
		// 	$cur_dt  = date('Y-m-d');
		// 	$pwehere = array('trans_date >='=>$from_dt,'trans_date <='=>$to_dt,'brn_id'=>$br_cd,'status'=>'success','approve_status'=>'A');
		// 	$data['from_date'] = $from_dt;$data['to_dt'] = $to_dt;
		// 	$data['paylist']  = $this->Soc_por_paymodel->f_pselect('td_payment',NULL,$pwehere,0);
		// 	$this->load->view("post_login/fertilizer_main");
		// 	$this->load->view("soceity_pay_portal/branch_paylist",$data);
		// 	$this->load->view('search/search');
		// 	$this->load->view('post_login/footer');

		// }else{
			$br_cd   = $this->session->userdata['loggedin']['branch_id'];
			//$cur_dt  = date('Y-m-d');
			//$pwehere = array('trans_date'=>$cur_dt,'brn_id'=>$br_cd,'status'=>'success','approve_status'=>'A');
			$pwehere = array('brn_id'=>$br_cd,'bank_status'=>'Captured','approve_status'=>'U');
			//$data['from_date'] = $cur_dt;$data['to_dt'] = $cur_dt;
			$data['paylist']  = $this->Soc_por_paymodel->f_pselect('td_payment',NULL,$pwehere,0);
			$this->load->view("post_login/fertilizer_main");
			$this->load->view("soceity_pay_portal/branch_paylist",$data);
			$this->load->view('search/search');
			$this->load->view('post_login/footer');
	    //	}

	}

	public function bpaydetail(Type $var = null)
	{
		$br_cd   = $this->session->userdata['loggedin']['branch_id'];
		$pwehere = array('brn_id'=>$br_cd,'order_id'=>base64_decode($this->input->get('order_id')));
		$data['payment']  = $this->Soc_por_paymodel->f_pselect('td_payment',NULL,$pwehere,1);
		$this->load->view("post_login/fertilizer_main");
		$this->load->view("soceity_pay_portal/branch_detailpage",$data);
		$this->load->view('post_login/footer');
	}
		


}
?>