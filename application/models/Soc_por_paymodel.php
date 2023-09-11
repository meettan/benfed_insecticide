<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Soc_por_paymodel extends CI_Model{
											
		public function f_insert($table_name, $data_array) {

		$this->db->insert($table_name, $data_array);

			return;

		}
																				/*Update table data*/
		public function f_edit($table_name, $data_array, $where) {

			$this->db->where($where);

			$this->db->update($table_name, $data_array);

			return;

		}
																				/*Select Data from a table*/				
		public function f_select($table,$select=NULL,$where=NULL,$type =NULL){

			if(isset($select)){
				$this->db->select($select);
			}

			if(isset($where)){
				$this->db->where($where);
			}

			$value = $this->db->get($table);

			if($type==1){
				return $value->row();
			}else{
				return $value->result();
			}
		}

		public function f_select_distinct($table,$select=NULL,$where=NULL,$type =NULL){	/**Select distinct data */

			$this->db->distinct();

			if(isset($select)){
				$this->db->select($select);
			}

			if(isset($where)){
				$this->db->where($where);
			}

			$value = $this->db->get($table);

			if($type==1){
				return $value->row();
			}else{
				return $value->result();
			}
		}

		public function f_pselect($table,$select=NULL,$where=NULL,$type =NULL){
			$db2 = $this->load->database('socpaydb', TRUE);
			if(isset($select)){
				$db2->select($select);
			}
			if(isset($where)){
				$db2->where($where);
			}

			$value = $db2->get($table);
			
			if($type==1){
				return $value->row();
			}else{
				return $value->result();
			}
		}


		public function f_pedit($table_name, $data_array, $where) {
			$db2 = $this->load->database('socpaydb', TRUE);
			$db2->where($where);
			$result = $db2->update($table_name, $data_array);
			return $result;
		}
		
	}
?>