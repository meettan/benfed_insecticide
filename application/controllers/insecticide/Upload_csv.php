<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_csv extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('upload_csv_model');
        $this->load->model('Soc_por_paymodel');
	}

    function index(){
        $demand_data['dmd_data'] = $this->upload_csv_model->get_dmd_data();
        // echo $this->db->last_query();
        // exit();
        // $data = array(
        //     'dmd_data' => array($demand_data),
		// 	'title' => 'Upload CSV'
        // );
        $this->load->view('post_login/fertilizer_main');
		$this->load->view('upload_csv/view', $demand_data);
        $this->load->view('post_login/footer');
    }

    function entry(){
        $data = array('title' => 'Upload CSV');
        $this->load->view('post_login/fertilizer_main',$data);
		$this->load->view('upload_csv/entry', $data);
        $this->load->view('post_login/footer');
    }

    function save(){
        $file = $_FILES['userfile']['tmp_name'];
        $handel = fopen($file, 'r');
        $c = 0;
        $header = '';
        $data = $this->input->post();
        while(($filepos = fgetcsv($handel, 1000, ',')) != false){
             //echo '<pre>';
             //var_dump($filepos);
            // if($c == 0){
            //     $header = $filepos;
            // }
            if($c > 0){
                $this->upload_csv_model->save($filepos, $data);
            }
            $c++;
        }
        // exit;
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Insert Successfully</div>');
        return true;
        
        
    }

    public function upload_pdf(){
        $config['upload_path']          = './assets/pdf/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
               
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());
                $input = array(
                    'file_name' => $data['upload_data']['file_name']
                );
                $where = array('ro_no' => $this->input->post('ro_no'));
                $this->upload_csv_model->f_edit('td_iffco_upload', $input, $where);
                // echo $this->db->last_query();exit;
                redirect('fertilizer/upload_csv');
                
        }
}
/*********************************************** */



public function viewupload(){

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $inv_no    =   $_POST['inv_no'];
            
            $data['dmd_data']    =   $this->upload_csv_model->f_get_uploadinv($inv_no);

       // echo $this->db->last_query();
        // exit();

            $this->load->view('post_login/fertilizer_main');
            $this->load->view('upload_csv/view_stmt',$data);
            $this->load->view('post_login/footer');

        }else{

            $this->load->view('post_login/fertilizer_main');
            $this->load->view('upload_csv/view_stmt_ip');
            $this->load->view('post_login/footer');
        }

    }
/************************************************ */
   public function hdfcresponse(Type $var = null)
   {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
                $csvMimes = array('text/x-comma-separated-values',
                'text/comma-separated-values',
                'application/octet-stream',
                'application/vnd.ms-excel',
                'application/x-csv',
                'text/x-csv',
                'text/csv',
                'application/csv',
                'application/excel',
                'application/vnd.msexcel',
                'text/plain');

            if(!empty($_FILES['hdfcresponse_detail']['name']) && in_array($_FILES['hdfcresponse_detail']['type'],$csvMimes)){
                
                    $csvFile  = fopen($_FILES['hdfcresponse_detail']['tmp_name'], 'r');
                    $totqty = 0;
                    
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                       
                        if($line[2] !='') {
                            $data[] = array(
                            "order_id"            =>  trim($line[0]),
                            'dates'               =>  $line[1],
                            "payment_id"          =>  trim($line[2]),
                            "amount"              =>  $line[3],
                            "status"              =>  trim($line[4]),
                            "Customer Name"       =>  $line[5],
                            "bank"                =>  $line[6],
                            "method"              =>  $line[7],
                            "created_dt"          =>  date('Y-m-d h:i:s')
                            );
                        }
                    }
                    
                    unset($data[0]);
                    
                    $data = array_values($data);
                    $cnt  = count($data);  
                    for($i= 0; $i < $cnt; $i++ ){
                       if($data[$i]['status'] == 'Captured'){
                        $data_array = array('method' =>$data[$i]['method'],
                                            'PayU_ID' => $data[$i]['payment_id'],
                                            'bank' => $data[$i]['bank'],
                                            'bank_status'=>$data[$i]['status'],
                                            'settlement_date'=>date('Y-m-d h:i:s',strtotime($data[$i]['dates']))
                                           );

                        $data_where = array('order_id' => $data[$i]['order_id']);
                        $this->Soc_por_paymodel->f_pedit('td_payment',$data_array,$data_where);
                        }
                    }
                    //print_r($data);die();
                    fclose($csvFile);
                    $this->session->set_flashdata('msg','Successfully uploaded');
                    redirect('/fert/sppay/paylist','refresh'); 
            }
        }else{

            $this->load->view('post_login/fertilizer_main');
            $this->load->view('upload_csv/view_hdfc_response');
            $this->load->view('post_login/footer');
        }    
   }
}
?>