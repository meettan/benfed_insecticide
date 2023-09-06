<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_csv_model extends CI_Model{

    function get_dmd_data(){
        $this->db->select('a.*');
         $this->db->where("a.file_name=''");
         $query = $this->db->get('td_iffco_upload a');
        //    echo $this->db->last_query();
        //    exit;
        return $query->result();
    }

    public function f_edit($table_name, $data_array, $where) {

        $this->db->where($where);
        $this->db->update($table_name, $data_array);

        return;

    }

    public function f_get_uploadinv($inv_no){
        $query  = $this->db->query("select  a.dist,a.soc,a.ro_no,a.inv_no,a.inv_dt,a.prod,a.qty,a.amt,a.file_name
                                    from td_iffco_upload a
                                    where    a.inv_no='$inv_no'");

        return $query->result();
    }

    function save($csv_data, $data){
        // echo '<pre>';
        // var_dump($data);exit;
        $input = array(
            'soc' => $csv_data[1],
            'dist' => $csv_data[0],
            'ro_no' => $csv_data[2],
            'inv_no' => $csv_data[3],
            'inv_dt' => date('Y-m-d', strtotime($csv_data[4])),
            'prod' => $csv_data[5],
            'qty' => $csv_data[6],
            'amt' => $csv_data[7],
            "created_by"    	=> $this->session->userdata['loggedin']['user_name'],    

            "created_dt"    	=>  date('Y-m-d h:i:s')
        );
        
        // if($this->check_data($input)){
            // $sql = '("emp_code", "member_id", "member_name", "dob", "month", "year", "tf_clr_bal", "gl_outstanding", "cl_outstanding", "gl_id", "cl_id", "tf_prn", "gl_tot", "gl_run", "gl_principal", "gl_interest", "cl_tot", "cl_run", "cl_principal", "cl_interest", "total_demand", "password")';
            $this->db->insert('td_iffco_upload', $input);
        // }
    }
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
                    redirect('fertilizer/Upload_csv/hdfcresponse','refresh'); 
            }
        }else{

            $this->load->view('post_login/fertilizer_main');
            $this->load->view('upload_csv/view_hdfc_response');
            $this->load->view('post_login/footer');
        }    
   }

}
?>