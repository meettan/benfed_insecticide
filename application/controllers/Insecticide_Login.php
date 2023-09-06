<?php
class Insecticide_Login extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Login_Process');

		//$this->load->helper('Purchase_sale');
		$this->load->helper('purchasesale_helper');
		$this->load->helper('blance_helper');

		$this->load->model('Fertilizer_Process');
		$this->load->model('Soc_por_paymodel');
	}

	public function index()
	{

		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			$user_id 	= $_POST['user_id'];
			$user_pw 	= $_POST['user_pwd'];
			$branch_id 	= $_POST['branch_id'];
			$fin_yr		= $_POST['fin_yr'];

			$result  		= $this->Login_Process->f_select_password($user_id);
			
			if ($result) {

				if ($result->user_status == 'A') {

					$match	   = password_verify($user_pw, $result->password);

					if ($match) {

						$user_data = $this->Login_Process->f_get_user_inf($user_id);

						$user_type = $user_data->user_type;

						if ($user_type == 'A') {

							if ($branch_id != '') {

								$loggedin['user_id']            = $user_data->user_id;
								$loggedin['password']           = $user_data->password;
								$loggedin['user_type']      	= $user_data->user_type;
								$loggedin['user_name']      	= $user_data->user_name;
								$loggedin['user_status']   		= $user_data->user_status;
								$loggedin['user_pwd']   		= $user_pw;
								

								$branch_data = $this->Login_Process->f_get_branch_inf($branch_id);
								$loggedin['branch_id']   		= $branch_data->id;
								$loggedin['branch_name']   		= $branch_data->branch_name;
								$loggedin['ho_flag']            = $branch_data->ho_flag;

								$dist_data 	 = $this->Login_Process->f_get_dist_inf($branch_data->districts_catered);
								$loggedin['dist_id']  			= $dist_data->district_code;
								$loggedin['dist_name']   		= $dist_data->district_name;
								$loggedin['dist_sort_code']   	= $dist_data->dist_sort_code;
								$loggedin['districts_catered']  = $user_data->districts_catered;


								$fin_data 	 = $this->Fertilizer_Process->f_get_fin_inf($fin_yr);
								$loggedin['fin_id']  			= $fin_data->sl_no;
								$loggedin['fin_yr']   			= $fin_data->fin_yr;
								$loggedin['active_flag']   			= $fin_data->active_flag;
							} else {
								$this->session->set_flashdata('login_error', 'Select Branch');
								redirect('Insecticide_Login/login');
							}
						} else {

							$loggedin['user_id']            = $user_data->user_id;
							$loggedin['password']           = $user_data->password;
							$loggedin['user_type']      	= $user_data->user_type;
							$loggedin['user_name']      	= $user_data->user_name;
							$loggedin['user_status']   		= $user_data->user_status;
							$loggedin['branch_id']   	    = $user_data->branch_id;
							$loggedin['branch_name']   	    = $user_data->branch_name;
							$loggedin['ho_flag']            = $user_data->ho_flag;
							$loggedin['user_pwd']   		= $user_pw;
							$dist_data 	 = $this->Login_Process->f_get_dist_inf($user_data->districts_catered);
							$loggedin['dist_id']  			= $dist_data->district_code;
							$loggedin['dist_name']   		= $dist_data->district_name;
							$loggedin['dist_sort_code']   	= $dist_data->dist_sort_code;
							$loggedin['districts_catered']  = $user_data->districts_catered;

							$fin_data 	 = $this->Fertilizer_Process->f_get_fin_inf($fin_yr);
							$loggedin['fin_id']  			= $fin_data->sl_no;
							$loggedin['fin_yr']   			= $fin_data->fin_yr;
							$loggedin['active_flag']   			= $fin_data->active_flag;
						}

						$this->session->set_userdata('loggedin', $loggedin);

						$id = $this->Login_Process->f_insert_audit_trail($user_id);

						$this->session->set_userdata('sl_no', $id);

					    redirect('Insecticide_Login/main');
					} else {
						$this->session->set_flashdata('login_error', 'Invalid Password');
						redirect('Insecticide_Login/login');
					}
				} else {
					$this->session->set_flashdata('login_error', 'User is inactive please contact Admin');
					redirect('Insecticide_Login/login');
				}
			} else {
				$this->session->set_flashdata('login_error', 'Invalid User ID');
				redirect('Insecticide_Login/login');
			}
		} else {
			redirect('Insecticide_Login/login');
		}
	}
//***  Code End for login to Fertilizer From Insecticides dashboard       ***///
	public function redilogin()
	{ 
        $q = $this->input->get('q');
		
		$udata = explode(",",$q);
		if ($q != "") {

			$user_id 	= base64_decode($udata[0]);
			$user_pw    = base64_decode($udata[1]);
			$fin_yr		= base64_decode($udata[2]);
			$branch_id 	= base64_decode($udata[3]);

			$result  		= $this->Login_Process->f_select_password($user_id);
			
			if ($result) {

				if ($result->user_status == 'A') {

					$match	   = password_verify($user_pw, $result->password);

					if ($match) {

						$user_data = $this->Login_Process->f_get_user_inf($user_id);

						$user_type = $user_data->user_type;

						if ($user_type == 'A') {

							if ($branch_id != '') {

								$loggedin['user_id']            = $user_data->user_id;
								$loggedin['password']           = $user_data->password;
								$loggedin['user_type']      	= $user_data->user_type;
								$loggedin['user_name']      	= $user_data->user_name;
								$loggedin['user_status']   		= $user_data->user_status;
								$loggedin['user_pwd']   		= $user_pw;
								$branch_data = $this->Login_Process->f_get_branch_inf($branch_id);
								$loggedin['branch_id']   		= $branch_data->id;
								$loggedin['branch_name']   		= $branch_data->branch_name;
								$loggedin['ho_flag']            = $branch_data->ho_flag;

								$dist_data 	 = $this->Login_Process->f_get_dist_inf($branch_data->districts_catered);
								$loggedin['dist_id']  			= $dist_data->district_code;
								$loggedin['dist_name']   		= $dist_data->district_name;
								$loggedin['dist_sort_code']   	= $dist_data->dist_sort_code;
								$loggedin['districts_catered']  = $user_data->districts_catered;


								$fin_data 	 = $this->Fertilizer_Process->f_get_fin_inf($fin_yr);
								$loggedin['fin_id']  			= $fin_data->sl_no;
								$loggedin['fin_yr']   			= $fin_data->fin_yr;
								$loggedin['active_flag']   			= $fin_data->active_flag;
							} else {
								$this->session->set_flashdata('login_error', 'Select Branch');
								redirect('Insecticide_Login/login');
							}
						} else {

							$loggedin['user_id']            = $user_data->user_id;
							$loggedin['password']           = $user_data->password;
							$loggedin['user_type']      	= $user_data->user_type;
							$loggedin['user_name']      	= $user_data->user_name;
							$loggedin['user_status']   		= $user_data->user_status;
							$loggedin['branch_id']   	    = $user_data->branch_id;
							$loggedin['branch_name']   	    = $user_data->branch_name;
							$loggedin['ho_flag']            = $user_data->ho_flag;
							$loggedin['user_pwd']   		= $user_pw;
							$dist_data 	 = $this->Login_Process->f_get_dist_inf($user_data->districts_catered);
							$loggedin['dist_id']  			= $dist_data->district_code;
							$loggedin['dist_name']   		= $dist_data->district_name;
							$loggedin['dist_sort_code']   	= $dist_data->dist_sort_code;
							$loggedin['districts_catered']  = $user_data->districts_catered;

							$fin_data 	 = $this->Fertilizer_Process->f_get_fin_inf($fin_yr);
							$loggedin['fin_id']  			= $fin_data->sl_no;
							$loggedin['fin_yr']   			= $fin_data->fin_yr;
							$loggedin['active_flag']   			= $fin_data->active_flag;
						}

						$this->session->set_userdata('loggedin', $loggedin);

						$id = $this->Login_Process->f_insert_audit_trail($user_id);

						$this->session->set_userdata('sl_no', $id);

					    redirect('Insecticide_Login/main');
					} else {
						$this->session->set_flashdata('login_error', 'Invalid Password');
						redirect('Insecticide_Login/login');
					}
				} else {
					$this->session->set_flashdata('login_error', 'User is inactive please contact Admin');
					redirect('Insecticide_Login/login');
				}
			} else {
				$this->session->set_flashdata('login_error', 'Invalid User ID');
				redirect('Insecticide_Login/login');
			}
		} else {
			redirect('Insecticide_Login/login');
		}
	}
//***  Code End for login to Fertilizer From Insecticides dashboard       ***///

	public function login()
	{

		if ($this->session->userdata('loggedin')) {

			redirect('Insecticide_Login/main');
		} else {

			$data["branch_data"] = $this->Login_Process->f_get_branch_list();

			$data["fin_yr"]		 = $this->Fertilizer_Process->f_get_fin_yr();

			$this->load->view('login/Fertilizer_Login', $data);
		}
	}
	/*****************************Function For Dashboard Data****************************************** */

	public function main()
	{
		if ($this->session->userdata('loggedin')) {

			$_SESSION['sys_date'] = date('Y-m-d');		//Setting system date
			$_SESSION['module']  = 'F';


			// yesterday date
			$yesterday = date('Y-m-d', strtotime("-1 days"));

			/*$this->session->set_userdata('cashcode', $this->Login_Process->f_get_parameters(13));
				$_SESSION['cash_code']=$this->session->userdata('cashcode')->param_value;*/

			$fin_id = $this->session->userdata['loggedin']['fin_id'];  		//Retrieving financial year,branch
			$fin_yr = $this->session->userdata['loggedin']['fin_yr'];
			$branch_id = $this->session->userdata['loggedin']['branch_id'];

			$first_month_day = date("Y-m-01", strtotime($_SESSION['sys_date'])); //Setting 1st & Last day of current month
			$last_month_day  = date("Y-m-t", strtotime($_SESSION['sys_date']));

			$from_fin_yr = substr($fin_yr, 0, 4);					//Calculating the 1st & last date of current financial year
			$to_fin_yr   = ($from_fin_yr + 1);

			$from_yr_day = date('Y-m-d', strtotime($from_fin_yr . '-04-01'));
			$to_yr_day 	 = date('Y-m-d', strtotime($to_fin_yr . '-03-31'));

			// $dash_data["ho_recvamt_day"]		= $this->Fertilizer_Process->f_get_tot_recvamt_ho($_SESSION['sys_date'],$_SESSION['sys_date']);
			$dash_data["br_recvamt_day"]		= $this->Fertilizer_Process->f_get_tot_recvamt($branch_id, $_SESSION['sys_date'], $_SESSION['sys_date']);
			$dash_data["br_recvamt_month"]		= $this->Fertilizer_Process->f_get_tot_recvamt($branch_id, $first_month_day, $last_month_day);
			$dash_data["br_recvamt_yr"]		    = $this->Fertilizer_Process->f_get_tot_recvamt($branch_id, $from_yr_day, $to_yr_day);

			// $dash_data["purchase_day"]			= $this->Fertilizer_Process->f_get_tot_purchase($branch_id,$_SESSION['sys_date'],$_SESSION['sys_date']);
			// $dash_data["ho_purchase_day"]		= $this->Fertilizer_Process->f_get_tot_purchase_ho($_SESSION['sys_date'],$_SESSION['sys_date']);
			// $dash_data["ho_purchase_daysld"]    = $this->Fertilizer_Process->f_get_tot_purchase_hosld($_SESSION['sys_date'],$_SESSION['sys_date']);
			// $dash_data["ho_purchase_daylqd"]    = $this->Fertilizer_Process->f_get_tot_purchase_holqd($_SESSION['sys_date'],$_SESSION['sys_date']);
			$dash_data["purchase_month"]		= $this->Fertilizer_Process->f_get_tot_purchase($branch_id, $first_month_day, $last_month_day);
			$dash_data["ho_purchase_month"]		= $this->Fertilizer_Process->f_get_tot_purchase_ho($first_month_day, $last_month_day);
			$dash_data["purchase_yr"]			= $this->Fertilizer_Process->f_get_tot_purchase($branch_id, $from_yr_day, $to_yr_day);
			$dash_data["ho_purchase_yr"]		= $this->Fertilizer_Process->f_get_tot_purchase_ho($from_yr_day, $to_yr_day);

			// $dash_data["sale_day"]				= $this->Fertilizer_Process->f_get_tot_sale($branch_id,$_SESSION['sys_date'],$_SESSION['sys_date']);
			$dash_data["ho_sale_day"]			= $this->Fertilizer_Process->f_get_tot_sale_ho($_SESSION['sys_date'], $_SESSION['sys_date']);
			// $dash_data["ho_sale_daysld"]        = $this->Fertilizer_Process->f_get_tot_sale_hosld($_SESSION['sys_date'],$_SESSION['sys_date']);
			// $dash_data["ho_sale_daylqd"]		= $this->Fertilizer_Process->f_get_tot_sale_holqd($_SESSION['sys_date'],$_SESSION['sys_date']);
			$dash_data["sale_month"]			= $this->Fertilizer_Process->f_get_tot_sale($branch_id, $first_month_day, $last_month_day);
			$dash_data["ho_sale_month"]			= $this->Fertilizer_Process->f_get_tot_sale_ho($first_month_day, $last_month_day);

			$dash_data["sale_yr"]				= $this->Fertilizer_Process->f_get_tot_sale($branch_id, $from_yr_day, $to_yr_day);
			$dash_data["ho_sale_yr"]			= $this->Fertilizer_Process->f_get_tot_sale_ho($from_yr_day, $to_yr_day);


			//  District wise money collection   ///
			$selectm                             = array("sum(a.paid_amt) paid_amt", "b.district_name");
			$wherem                              = array(
				"a.branch_id = b.district_code" => NULL,
				"a.fin_yr " =>  $fin_id,
				"1 group by a.branch_id" => NULL
			);

			$dash_data['distamt']           = $this->Fertilizer_Process->f_select('tdf_payment_recv a,md_district b', $selectm, $wherem, 0);




			$prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($_SESSION['sys_date'])));
			$dash_data['product']          =   $this->Fertilizer_Process->f_get_product_list($branch_id, '2020-04-01');
			$dash_data['opening']     =   $this->Fertilizer_Process->f_get_balance($branch_id, '2020-04-01', $prevdt);
           
			// //Total Solid & Liquid Sale in a year 
			// $dash_data['totsolidsale']    = $this->Fertilizer_Process->f_get_solid_sale_tot($_SESSION['sys_date'],$_SESSION['sys_date']);

			// $dash_data['totliquidsale']   = $this->Fertilizer_Process->f_get_liquid_sale_tot($_SESSION['sys_date'],$_SESSION['sys_date']);


			// If Login is in Head Office and Login user is Admin

			if ($this->session->userdata['loggedin']['ho_flag'] == "Y" && $this->session->userdata['loggedin']['user_type'] == "A") {

				//Total Received Amount in all branch (Advance + Other mode)
				$dash_data["ho_recvamt_day"]		= collectionForTheDay($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y');


				//Total Purchase in all branches solid & liquid

				$dash_data["ho_purchase_daysld"]    = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'S');
				$dash_data["ho_purchase_daylqd"]    = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'L'); 

				//Total Sale in all branches solid & liquid
				$dash_data["ho_sale_daysld"]        = get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'S');
				$dash_data["ho_sale_daylqd"]		= get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'L');


				$select1                             = array("district_code", "district_name");
				$dash_data['distdtls']               = $this->Fertilizer_Process->f_select('md_district', $select1, NULL, 0);



				$select11                             = array("short_name", "COMP_ID");
				$dash_data['compdtls']               = $this->Fertilizer_Process->f_select('mm_company_dtls', $select11, NULL, 0);


				//Districtwise Bar Graph for Solid & Liquid Sale for a financial year

				$dash_data['distwisesale']           = $this->Fertilizer_Process->f_get_solid_sale($from_yr_day, $to_yr_day);

				$dash_data['distwisesaleltr']        = $this->Fertilizer_Process->f_get_liquid_sale($from_yr_day, $to_yr_day);


				//Total Solid & Liquid Sale in a year 
				$dash_data['totsolidsale']    = $this->Fertilizer_Process->f_get_solid_sale_tot($from_yr_day, $to_yr_day);

				$dash_data['totliquidsale']   = $this->Fertilizer_Process->f_get_liquid_sale_tot($from_yr_day, $to_yr_day);

				/**Districtwise Collection in a year used in colection Bar Graph***/
				$dash_data['coloction_distwise'] = $this->Fertilizer_Process->get_coloction_distwise($from_yr_day, $to_yr_day);
				$dash_data['tot_coloction'] = $this->Fertilizer_Process->get_tot_coloction($from_yr_day, $to_yr_day);


				$dash_data['company_Wise_Status']=$this->Fertilizer_Process->company_Wise_Status($_SESSION['sys_date'],$from_yr_day);
				///   *****      Code start to get unapprove payment list   **  //
				// $pselect = array("count(*) as cnt");
				// $pwehere = array('approve_status' => 'U','status'=>'success','bank_status IS NULL or status IS NULL'=>NULL);
				// $dash_data['pay_count']=$this->Soc_por_paymodel->f_pselect('td_payment',$pselect,$pwehere,1);
				
				
				///   *****      Code End to get unapprove payment list   **  //
				$this->load->view('post_login/fertilizer_main');
				$this->load->view('post_login/fertilizer_home_one', $dash_data);
				$this->load->view('post_login/footer');
			} elseif ($this->session->userdata['loggedin']['branch_id']  == 342 && $this->session->userdata['loggedin']['user_type'] != "A") {

					//Total Sale in all branches solid & liquid
					$dash_data["ho_sale_daysld"]        = get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'S');
					$dash_data["ho_sale_daylqd"]		= get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'L');
	

				//Total Purchase Solid & Liquid for a period branchwise
				$dash_data['totsolidpur']     = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'S');
				$dash_data['totliquidpur']	  = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'L');


				
				$dash_data["ho_purchase_daysld"]    = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'S');
				$dash_data["ho_purchase_daylqd"]    = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'L');



				$this->load->view('post_login/fertilizer_main');
				$this->load->view('post_login/fertilizer_home_two', $dash_data);
				$this->load->view('post_login/footer');

				//When Admin or Manager logs into branch			

			} elseif ($this->session->userdata['loggedin']['ho_flag']  == 'N' && ($this->session->userdata['loggedin']['user_type'] == 'C'||$this->session->userdata['loggedin']['user_type'] == 'S' ||$this->session->userdata['loggedin']['user_type'] == 'M' || $this->session->userdata['loggedin']['user_type'] == 'A')) {



				//Stock Opening Balance Solid and Liquid
				$dash_data['openingS'] = stock_balance($yesterday, $branch_id, 'S');
				$dash_data['openingL'] = stock_balance($yesterday, $branch_id, 'L');


				//Total Purchase Solid & Liquid for a period branchwise
				$dash_data['totsolidpur']     = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'S');
				$dash_data['totliquidpur']	  = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'L');

				//Total Sale Solid & Liquid for a period branchwise
				$dash_data['brsalesolidtoday'] = get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'S');
				$dash_data['brsaleliquidtoday'] = get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'L');

				//Stock Closing Balance Solid and Liquid
				$dash_data['closingS'] = stock_balance($_SESSION['sys_date'], $branch_id, 'S');
				$dash_data['closingL'] = stock_balance($_SESSION['sys_date'], $branch_id, 'L');


				
				$select11                             = array("short_name", "COMP_ID");
				$dash_data['compdtls']               = $this->Fertilizer_Process->f_select('mm_company_dtls', $select11, NULL, 0);



				//Total Collection for a period branchwise
				$dash_data['todaycollection'] = collectionForTheDay($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N');


				//No.of B2B and B2C invoices
				$dash_data['b2c']   = $this->Fertilizer_Process->get_b2cfortoday($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id);
				$dash_data['b2b']   = $this->Fertilizer_Process->get_b2bfortoday($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id);

				//Populating all society list under the branch
				$dash_data['soc'] = $this->Fertilizer_Process->f_all_soc($branch_id);

				$this->load->view('post_login/fertilizer_main');
				$this->load->view('post_login/fertilizer_home_three', $dash_data);
				$this->load->view('post_login/footer');

				//When User logs into branch

			} elseif ($this->session->userdata['loggedin']['ho_flag']  == 'N' && $this->session->userdata['loggedin']['user_type'] == 'U') {


				//Stock Opening Balance Solid and Liquid
				$dash_data['openingS'] = stock_balance($yesterday, $branch_id, 'S');
				$dash_data['openingL'] = stock_balance($yesterday, $branch_id, 'L');


				//Total Purchase Solid & Liquid for a period branchwise
				$dash_data['totsolidpur']     = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'S');
				$dash_data['totliquidpur']	  = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'L');

				//Total Sale Solid & Liquid for a period branchwise
				$dash_data['brsalesolidtoday'] = get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'S');
				$dash_data['brsaleliquidtoday'] = get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'L');

				//Stock Closing Balance Solid and Liquid
				$dash_data['closingS'] = stock_balance($_SESSION['sys_date'], $branch_id, 'S');
				$dash_data['closingL'] = stock_balance($_SESSION['sys_date'], $branch_id, 'L');


				//Total Collection for a period branchwise
				$dash_data['todaycollection'] = collectionForTheDay($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N');


				//No.of B2B and B2C invoices
				$dash_data['b2c']   = $this->Fertilizer_Process->get_b2cfortoday($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id);
				$dash_data['b2b']   = $this->Fertilizer_Process->get_b2bfortoday($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id);



				$this->load->view('post_login/fertilizer_main');
				$this->load->view('post_login/fertilizer_home_four', $dash_data);
				$this->load->view('post_login/footer');
			}
		} else {

			redirect('Insecticide_Login/login');
		}
	}
	public function mainpesticide()
	{
		if ($this->session->userdata('loggedin')) {

				$_SESSION['sys_date'] = date('Y-m-d');		//Setting system date
				$_SESSION['module']  = 'F';

				// yesterday date
				$yesterday = date('Y-m-d', strtotime("-1 days"));
				$fin_id = $this->session->userdata['loggedin']['fin_id'];  		//Retrieving financial year,branch
				$fin_yr = $this->session->userdata['loggedin']['fin_yr'];
				$branch_id = $this->session->userdata['loggedin']['branch_id'];

				$first_month_day = date("Y-m-01", strtotime($_SESSION['sys_date'])); //Setting 1st & Last day of current month
				$last_month_day  = date("Y-m-t", strtotime($_SESSION['sys_date']));

				$from_fin_yr = substr($fin_yr, 0, 4);					//Calculating the 1st & last date of current financial year
				$to_fin_yr   = ($from_fin_yr + 1);

				$from_yr_day = date('Y-m-d', strtotime($from_fin_yr . '-04-01'));
				$to_yr_day 	 = date('Y-m-d', strtotime($to_fin_yr . '-03-31'));
				
				$dash_data["br_recvamt_day"]		= $this->Fertilizer_Process->f_get_tot_recvamt($branch_id, $_SESSION['sys_date'], $_SESSION['sys_date']);
				$dash_data["br_recvamt_month"]		= $this->Fertilizer_Process->f_get_tot_recvamt($branch_id, $first_month_day, $last_month_day);
				$dash_data["br_recvamt_yr"]		    = $this->Fertilizer_Process->f_get_tot_recvamt($branch_id, $from_yr_day, $to_yr_day);
				
				$dash_data["purchase_month"]		= $this->Fertilizer_Process->f_get_tot_purchase($branch_id, $first_month_day, $last_month_day);
				$dash_data["ho_purchase_month"]		= $this->Fertilizer_Process->f_get_tot_purchase_ho($first_month_day, $last_month_day);
				$dash_data["purchase_yr"]			= $this->Fertilizer_Process->f_get_tot_purchase($branch_id, $from_yr_day, $to_yr_day);
				$dash_data["ho_purchase_yr"]		= $this->Fertilizer_Process->f_get_tot_purchase_ho($from_yr_day, $to_yr_day);

				
				$dash_data["ho_sale_day"]			= $this->Fertilizer_Process->f_get_tot_sale_ho($_SESSION['sys_date'], $_SESSION['sys_date']);
				
				$dash_data["sale_month"]			= $this->Fertilizer_Process->f_get_tot_sale($branch_id, $first_month_day, $last_month_day);
				$dash_data["ho_sale_month"]			= $this->Fertilizer_Process->f_get_tot_sale_ho($first_month_day, $last_month_day);

				$dash_data["sale_yr"]				= $this->Fertilizer_Process->f_get_tot_sale($branch_id, $from_yr_day, $to_yr_day);
				$dash_data["ho_sale_yr"]			= $this->Fertilizer_Process->f_get_tot_sale_ho($from_yr_day, $to_yr_day);

				//  District wise money collection   ///
				$selectm                             = array("sum(a.paid_amt) paid_amt", "b.district_name");
				$wherem                              = array(
					"a.branch_id = b.district_code" => NULL,
					"a.fin_yr " =>  $fin_id,
					"1 group by a.branch_id" => NULL
				);

				$dash_data['distamt']           = $this->Fertilizer_Process->f_select('tdf_payment_recv a,md_district b', $selectm, $wherem, 0);


				$prevdt     =  date('Y-m-d', strtotime('-1 day', strtotime($_SESSION['sys_date'])));
				$dash_data['product']          =   $this->Fertilizer_Process->f_get_product_list($branch_id, '2020-04-01');
				$dash_data['opening']     =   $this->Fertilizer_Process->f_get_balance($branch_id, '2020-04-01', $prevdt);

				// If Login is in Head Office and Login user is Admin

				if ($this->session->userdata['loggedin']['ho_flag'] == "Y" && $this->session->userdata['loggedin']['user_type'] == "A") {

					//Total Received Amount in all branch (Advance + Other mode)
					$dash_data["ho_recvamt_day"]		= collectionForTheDay($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y');


					//Total Purchase in all branches solid & liquid

					$dash_data["ho_purchase_daysld"]    = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'S');
					$dash_data["ho_purchase_daylqd"]    = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'L'); 

					//Total Sale in all branches solid & liquid
					$dash_data["ho_sale_daysld"]        = get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'S');
					$dash_data["ho_sale_daylqd"]		= get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'L');

					$select1                             = array("district_code", "district_name");
					$dash_data['distdtls']               = $this->Fertilizer_Process->f_select('md_district', $select1, NULL, 0);

					$select11                             = array("short_name", "COMP_ID");
					$dash_data['compdtls']               = $this->Fertilizer_Process->f_select('mm_company_dtls', $select11, NULL, 0);


					//Districtwise Bar Graph for Solid & Liquid Sale for a financial year

					$dash_data['distwisesale']           = $this->Fertilizer_Process->f_get_solid_sale($from_yr_day, $to_yr_day);
					$dash_data['distwisesaleltr']        = $this->Fertilizer_Process->f_get_liquid_sale($from_yr_day, $to_yr_day);


					//Total Solid & Liquid Sale in a year 
					$dash_data['totsolidsale']    = $this->Fertilizer_Process->f_get_solid_sale_tot($from_yr_day, $to_yr_day);

					$dash_data['totliquidsale']   = $this->Fertilizer_Process->f_get_liquid_sale_tot($from_yr_day, $to_yr_day);

					/**Districtwise Collection in a year used in colection Bar Graph***/
					$dash_data['coloction_distwise'] = $this->Fertilizer_Process->get_coloction_distwise($from_yr_day, $to_yr_day);
					$dash_data['tot_coloction'] = $this->Fertilizer_Process->get_tot_coloction($from_yr_day, $to_yr_day);


					$dash_data['company_Wise_Status']=$this->Fertilizer_Process->company_Wise_Status($_SESSION['sys_date'],$from_yr_day);
					///   *****      Code start to get unapprove payment list   **  //
					$pselect = array("count(*) as cnt");
					$pwehere = array('approve_status' => 'U','status'=>'success','bank_status IS NULL or status IS NULL'=>NULL);
					$dash_data['pay_count']=$this->Soc_por_paymodel->f_pselect('td_payment',$pselect,$pwehere,1);
					
					///   *****      Code End to get unapprove payment list   **  //
					$this->load->view('post_login/fertilizer_main');
					$this->load->view('post_login/fertilizer_home_one', $dash_data);
					$this->load->view('post_login/footer');
				} elseif ($this->session->userdata['loggedin']['branch_id']  == 342 && $this->session->userdata['loggedin']['user_type'] != "A") {

						//Total Sale in all branches solid & liquid
						$dash_data["ho_sale_daysld"]        = get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'S');
						$dash_data["ho_sale_daylqd"]		= get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'L');
		

					//Total Purchase Solid & Liquid for a period branchwise
					$dash_data['totsolidpur']     = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'S');
					$dash_data['totliquidpur']	  = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'L');


					
					$dash_data["ho_purchase_daysld"]    = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'S');
					$dash_data["ho_purchase_daylqd"]    = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'Y', 'L');



					$this->load->view('post_login/fertilizer_main');
					$this->load->view('post_login/fertilizer_home_two', $dash_data);
					$this->load->view('post_login/footer');

					//When Admin or Manager logs into branch			

				} elseif ($this->session->userdata['loggedin']['ho_flag']  == 'N' && ($this->session->userdata['loggedin']['user_type'] == 'C'||$this->session->userdata['loggedin']['user_type'] == 'S' ||$this->session->userdata['loggedin']['user_type'] == 'M' || $this->session->userdata['loggedin']['user_type'] == 'A')) {


					//Stock Opening Balance Solid and Liquid
					$dash_data['openingS'] = stock_balance($yesterday, $branch_id, 'S');
					$dash_data['openingL'] = stock_balance($yesterday, $branch_id, 'L');


					//Total Purchase Solid & Liquid for a period branchwise
					$dash_data['totsolidpur']     = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'S');
					$dash_data['totliquidpur']	  = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'L');

					//Total Sale Solid & Liquid for a period branchwise
					$dash_data['brsalesolidtoday'] = get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'S');
					$dash_data['brsaleliquidtoday'] = get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'L');

					//Stock Closing Balance Solid and Liquid
					$dash_data['closingS'] = stock_balance($_SESSION['sys_date'], $branch_id, 'S');
					$dash_data['closingL'] = stock_balance($_SESSION['sys_date'], $branch_id, 'L');

					
					$select11                             = array("short_name", "COMP_ID");
					$dash_data['compdtls']               = $this->Fertilizer_Process->f_select('mm_company_dtls', $select11, NULL, 0);

					//Total Collection for a period branchwise
					$dash_data['todaycollection'] = collectionForTheDay($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N');

					//No.of B2B and B2C invoices
					$dash_data['b2c']   = $this->Fertilizer_Process->get_b2cfortoday($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id);
					$dash_data['b2b']   = $this->Fertilizer_Process->get_b2bfortoday($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id);

					//Populating all society list under the branch
					$dash_data['soc'] = $this->Fertilizer_Process->f_all_soc($branch_id);

					$this->load->view('post_login/fertilizer_main');
					$this->load->view('post_login/fertilizer_home_three', $dash_data);
					$this->load->view('post_login/footer');
					//When User logs into branch

				} elseif ($this->session->userdata['loggedin']['ho_flag']  == 'N' && $this->session->userdata['loggedin']['user_type'] == 'U') {

					//Stock Opening Balance Solid and Liquid
					$dash_data['openingS'] = stock_balance($yesterday, $branch_id, 'S');
					$dash_data['openingL'] = stock_balance($yesterday, $branch_id, 'L');

					//Total Purchase Solid & Liquid for a period branchwise
					$dash_data['totsolidpur']     = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'S');
					$dash_data['totliquidpur']	  = get_purchase($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'L');

					//Total Sale Solid & Liquid for a period branchwise
					$dash_data['brsalesolidtoday'] = get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'S');
					$dash_data['brsaleliquidtoday'] = get_sale($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N', 'L');

					//Stock Closing Balance Solid and Liquid
					$dash_data['closingS'] = stock_balance($_SESSION['sys_date'], $branch_id, 'S');
					$dash_data['closingL'] = stock_balance($_SESSION['sys_date'], $branch_id, 'L');

					//Total Collection for a period branchwise
					$dash_data['todaycollection'] = collectionForTheDay($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id, 'N');


					//No.of B2B and B2C invoices
					$dash_data['b2c']   = $this->Fertilizer_Process->get_b2cfortoday($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id);
					$dash_data['b2b']   = $this->Fertilizer_Process->get_b2bfortoday($_SESSION['sys_date'], $_SESSION['sys_date'], $branch_id);


					$this->load->view('post_login/fertilizer_main');
					$this->load->view('post_login/fertilizer_home_four', $dash_data);
					$this->load->view('post_login/footer');
				}
		} else 
		{
			redirect('Insecticide_Login/login');
		}
	}

	public function f_get_stkpnt()
	{

		$district = $this->input->get('district');
		// echo $district;
		// die();
		$data  = $this->Fertilizer_Process->f_get_stkpnt($district);

		echo json_encode($data);
		// die();


	}
	public function f_br_purchase()
	{				//branchwise purchase 
		$br_id = $_POST['br_id'];
		$fin_yr = $this->session->userdata['loggedin']['fin_yr'];
		$from_dt = $_SESSION['sys_date'];
		$to_dt = $_SESSION['sys_date'];
		$first_month_day = date("Y-m-01", strtotime($_SESSION['sys_date']));
		$last_month_day  = date("Y-m-t", strtotime($_SESSION['sys_date']));
		$from_fin_yr = substr($fin_yr, 0, 4);
		$to_fin_yr   = ($from_fin_yr + 1);
		$from_yr_day = date('Y-m-d', strtotime($from_fin_yr . '-04-01'));
		$to_yr_day 	 = date('Y-m-d', strtotime($to_fin_yr . '-03-31'));





// =============================================== Day ==========================================

		//day Purchase branches solid & liquid
		$tot_pur    = get_purchase($from_dt, $to_dt, $br_id, 'N', 'S');
		$tot_purlqd    = get_purchase($from_dt, $to_dt, $br_id, 'N', 'L'); 
		//day Sale in all branches solid & liquid
		$tot_sale        = get_sale($from_dt, $to_dt, $br_id, 'N', 'S');
		$tot_salelqd		= get_sale($from_dt, $to_dt, $br_id, 'N', 'L');
		//day Received Amount in branch (Advance + Other mode)
		$tot_recvday		= collectionForTheDay($from_dt, $to_dt, $br_id, 'N')->tot_recvamt;
		

// =============================================== Monthly ==========================================

		//Monthly Purchase branches solid & liquid
		$tot_mth_pur    = get_purchase($first_month_day, $to_dt, $br_id, 'N', 'S');
		$tot_mth_purlqd    = get_purchase($first_month_day, $to_dt, $br_id, 'N', 'L'); 
		//Monthly Sale in all branches solid & liquid
		$tot_mth_sal        = get_sale($first_month_day, $to_dt, $br_id, 'N', 'S');
		$tot_mth_salq		= get_sale($first_month_day, $to_dt, $br_id, 'N', 'L');
		//Monthly Received Amount in branch (Advance + Other mode)
		$tot_recvmnth		= collectionForTheDay($first_month_day, $to_dt, $br_id, 'N')->tot_recvamt;
		


// =============================================== Yearly ==========================================
		
		//Yearly Purchase branches solid & liquid
		$tot_puryr    = get_purchase($from_yr_day, $to_yr_day, $br_id, 'N', 'S');
		$tot_puryrlq  = get_purchase($from_yr_day, $to_yr_day, $br_id, 'N', 'L'); 
		//Yearly Sale in all branches solid & liquid
		$tot_salyr       = get_sale($from_yr_day, $to_yr_day, $br_id, 'N', 'S');
		$tot_salyrlq		= get_sale($from_yr_day, $to_yr_day, $br_id, 'N', 'L');

		//Yearly Received Amount in branch (Advance + Other mode)
		$tot_recvyr	= collectionForTheDay($from_yr_day, $to_yr_day, $br_id, 'N')->tot_recvamt;

		// $puryrlq	= $this->Fertilizer_Process->f_get_tot_purchaselqd($br_id, $from_yr_day, $to_yr_day);
		// $salyr		= $this->Fertilizer_Process->f_get_tot_salesld($br_id, $from_yr_day, $to_yr_day);
		// $salyrlq	= $this->Fertilizer_Process->f_get_tot_salelqd($br_id, $from_yr_day, $to_yr_day);
		// $tot_recvday = $this->Fertilizer_Process->f_get_tot_recvamt($br_id, $from_dt, $to_dt);
		// $tot_recvmnth = $this->Fertilizer_Process->f_get_tot_recvamt($br_id, $first_month_day, $last_month_day);
		// $tot_recvyr  = $this->Fertilizer_Process->f_get_tot_recvamt($br_id, $from_yr_day, $to_yr_day);

		$pur = array(
			'tot_pur' => $tot_pur,
			'tot_purlqd' => $tot_purlqd,
			'tot_sale' => $tot_sale,
			'tot_salelqd' => $tot_salelqd,
			'tot_mth_pur' => $tot_mth_pur,
			'tot_mth_purlqd' => $tot_mth_purlqd,
			'tot_mth_sal' => $tot_mth_sal,
			'tot_mth_salq' => $tot_mth_salq,
			'tot_puryr' => $tot_puryr,
			'tot_puryrlq' => $tot_puryrlq,
			'tot_salyr' => $tot_salyr,
			'tot_salyrlq' => $tot_salyrlq,
			'tot_recvday' => $tot_recvday,
			'tot_recvmnth' => $tot_recvmnth,
			'tot_recvyr' => $tot_recvyr
		);
		echo json_encode($pur);
	}


	public function f_br_purchasec()
	{				//branchwise purchase 
		$br_id = $_POST['br_id'];
		$fin_yr = $this->session->userdata['loggedin']['fin_yr'];
		$from_dt = $_SESSION['sys_date'];
		$to_dt = $_SESSION['sys_date'];
		$first_month_day = date("Y-m-01", strtotime($_SESSION['sys_date']));
		$last_month_day  = date("Y-m-t", strtotime($_SESSION['sys_date']));
		$from_fin_yr = substr($fin_yr, 0, 4);
		$to_fin_yr   = ($from_fin_yr + 1);
		$from_yr_day = date('Y-m-d', strtotime($from_fin_yr . '-04-01'));
		$to_yr_day 	 = date('Y-m-d', strtotime($to_fin_yr . '-03-31'));
		$company_id=$this->input->post('comp_id');

// =============================================== Day ==========================================
		$this->load->helper('purchacmpanysesale_helper');
		//day Purchase branches solid & liquid
		$tot_pur    = get_purchasec($from_dt, $to_dt, $br_id, 'N', 'S',$company_id);
		$tot_purlqd    = get_purchasec($from_dt, $to_dt, $br_id, 'N', 'L',$company_id); 
		//day Sale in all branches solid & liquid
		$tot_sale        = get_salec($from_dt, $to_dt, $br_id, 'N', 'S',$company_id);
		$tot_salelqd		= get_salec($from_dt, $to_dt, $br_id, 'N', 'L',$company_id);
		//day Received Amount in branch (Advance + Other mode)
		$tot_recvday		= collectionForTheDayc($from_dt, $to_dt, $br_id, 'N',$company_id)->tot_recvamt;
		

// =============================================== Monthly ==========================================

		//Monthly Purchase branches solid & liquid
		$tot_mth_pur    = get_purchasec($first_month_day, $to_dt, $br_id, 'N', 'S',$company_id);
		$tot_mth_purlqd    = get_purchasec($first_month_day, $to_dt, $br_id, 'N', 'L',$company_id); 
		//Monthly Sale in all branches solid & liquid
		$tot_mth_sal        = get_salec($first_month_day, $to_dt, $br_id, 'N', 'S',$company_id);
		$tot_mth_salq		= get_salec($first_month_day, $to_dt, $br_id, 'N', 'L',$company_id);
		//Monthly Received Amount in branch (Advance + Other mode)
		$tot_recvmnth		= collectionForTheDayc($first_month_day, $to_dt, $br_id, 'N',$company_id)->tot_recvamt;
		


// =============================================== Yearly ==========================================
		
		//Yearly Purchase branches solid & liquid
		$tot_puryr    = get_purchasec($from_yr_day, $to_yr_day, $br_id, 'N', 'S',$company_id);
		$tot_puryrlq  = get_purchasec($from_yr_day, $to_yr_day, $br_id, 'N', 'L',$company_id); 
		//Yearly Sale in all branches solid & liquid
		$tot_salyr       = get_salec($from_yr_day, $to_yr_day, $br_id, 'N', 'S',$company_id);
		$tot_salyrlq		= get_salec($from_yr_day, $to_yr_day, $br_id, 'N', 'L',$company_id);

		//Yearly Received Amount in branch (Advance + Other mode)
		$tot_recvyr	= collectionForTheDayc($from_yr_day, $to_yr_day, $br_id, 'N',$company_id)->tot_recvamt;


		$pur = array(
			'tot_pur' => $tot_pur,
			'tot_purlqd' => $tot_purlqd,
			'tot_sale' => $tot_sale,
			'tot_salelqd' => $tot_salelqd,
			'tot_mth_pur' => $tot_mth_pur,
			'tot_mth_purlqd' => $tot_mth_purlqd,
			'tot_mth_sal' => $tot_mth_sal,
			'tot_mth_salq' => $tot_mth_salq,
			'tot_puryr' => $tot_puryr,
			'tot_puryrlq' => $tot_puryrlq,
			'tot_salyr' => $tot_salyr,
			'tot_salyrlq' => $tot_salyrlq,
			'tot_recvday' => $tot_recvday,
			'tot_recvmnth' => $tot_recvmnth,
			'tot_recvyr' => $tot_recvyr
		);
		echo json_encode($pur);
	}

	public function check_user()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		$user_id = $this->input->post("user_id");
		$user_data = $this->Login_Process->f_get_user_inf($user_id);
		echo $user_data->user_type;
	}

	public function logout()
	{

		if ($this->session->userdata('loggedin')) {

			$user_id    =   $this->session->userdata['loggedin']['user_id'];

			$this->Login_Process->f_update_audit_trail($user_id);

			$this->session->unset_userdata('loggedin');

			redirect('Insecticide_Login/login');
		} else {

			redirect('Insecticide_Login/login');
		}
	}

	public function manager_soc_data()
	{
		$soc_id = $this->input->post('soc_id');
		$branch_id = $this->session->userdata['loggedin']['branch_id'];
		$data = array(
			'quantitySold' => $this->Fertilizer_Process->f_get_sales($branch_id, $soc_id),
		);
		echo json_encode($data);
	}

	//Societywise Status in Admin & Manager Branch Login
	public function societyWiseStatus()
	{
		$fin_yr			= $this->session->userdata['loggedin']['fin_yr'];
		$from_fin_yr 	= substr($fin_yr, 0, 4);
		$from_yr_day    = date('Y-m-d', strtotime($from_fin_yr . '-04-01'));
		$soc_id			= $this->input->post('soc_id');
		$soc_balance_amt = round(soc_balance_amt(date('Y-m-d'), $soc_id), 2);

		if ($soc_balance_amt < 0) {
			$soc_balance_amt_data = (-1) * $soc_balance_amt . " Dr.";
		} else {
			$soc_balance_amt_data = $soc_balance_amt . " Cr.";
		}
		$data_array = array(
			"quantitySold" => round(get_sale_soc($from_yr_day, date('Y-m-d'), $soc_id, 'S'), 2),   //solid qty sold for a yr

			"quantityltr" => round(get_sale_soc($from_yr_day, date('Y-m-d'), $soc_id, 'L'), 2),   //liquid qty sold for a yr

			"quantityPurchaseMt" => $this->Fertilizer_Process->get_b2bfortoday_soc($from_yr_day, date('Y-m-d'), $soc_id)->cnt,

			"quantityPurchaseLtr" => $this->Fertilizer_Process->get_b2cfortoday_soc($from_yr_day, date('Y-m-d'), $soc_id)->cnt,

			"amountPaidfortheYear" => round(collectionForTheDay_soc($from_yr_day, date('Y-m-d'), $soc_id), 2),  //Amt paid for a year

			"blanceAmount" => $soc_balance_amt_data //balance amt

		);
		echo json_encode($data_array);
	}


	public function companyWiseStatus()
	{
		echo $this->input->post('data');
	}
}
