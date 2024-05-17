<?php
   
 function get_paddy_price($kms_yr){

     $ci =& get_instance();
     $ci->load->database();
     $sql="SELECT * FROM md_paddy_rate WHERE kms_yr='".$kms_yr."' ORDER BY effective_dt DESC LIMIT 1";
     $price  =   $ci->db->query($sql)->row();

    return  $price->per_qui_rate;
   // return  $kms_yr;
}

//  function getIndianCurrency(float $number){
//         $number = number_format((float)$number, 2, '.', '');
//         $decimal = round($number - ($no = floor($number)), 2) * 100;
//         $decimal1 = round($number - ($no = floor($number)), 2) * 100;
//         $hundred = null;
//         $digits_length = strlen($no);
//         $i = 0;
//         $str = array();
//         $words = array(0 => 'Zero', 1 => 'One', 2 => 'Two',
//             3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
//             7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
//             10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
//             13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
//             16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
//             19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
//             40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
//             70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
//         $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
//         while( $i < $digits_length ) {
//             $divider = ($i == 2) ? 10 : 100;
//             $number = floor($no % $divider);
//             $no = floor($no / $divider);
//             $i += $divider == 10 ? 1 : 2;
//             if ($number) {
//                 $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
//                 $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
//                 $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
//             } else $str[] = null;
//     }
//     $Rupees = implode('', array_reverse($str));
//     //$paise = ($decimal > 0) ? "And " . ($words[$decimal / 10] . " " . $words[$decimal1 % 10]) . ' Paise ' : '';
//     $paise = ($decimal > 0) ? "And " . ($words[$decimal / 10] . " " . $words[number_format($decimal)% 10]) . ' Paise ' : '';
//     return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise.'Only';
//     }


    function getIndianCurrency(float $number)
    {
     $no = floor($number);
     $decimal = round($number - $no, 2) * 100;
     if($decimal>0){
     $decimal_part = $decimal;
     }else{
      $decimal_part=0;
     }
     $hundred = null;
     $hundreds = null;
     $digits_length = strlen($no);
     $decimal_length = strlen($decimal);
     $i = 0;
     $str = array();
     $str2 = array();
     $words = array(0 => '', 1 => 'one', 2 => 'two',
    3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
    7 => 'seven', 8 => 'eight', 9 => 'nine',
    10 => 'ten', 11 => 'eleven', 12 => 'twelve',
    13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
    16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
    19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
    40 => 'forty', 50 => 'fifty', 60 => 'sixty',
    70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    $digitsp = array('', '','','', '');
    
     while( $i < $digits_length ) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += $divider == 10 ? 1 : 2;
     if ($number) {
     $plural = (($counter = count($str)) && $number > 9) ? '' : null;
     $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
     $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
    } else $str[] = null;
    }
    
     $d = 0;
    while( $d < $decimal_length ) {
     $divider = ($d == 2) ? 10 : 100;
     $decimal_number = floor($decimal % $divider);
     $decimal = floor($decimal / $divider);
     $d += $divider == 10 ? 1 : 2;
     if ($decimal_number) {
     $plurals = (($counter = count($str2)) && $decimal_number > 9) ? '' : null;
     $hundreds = ($counter == 1 && $str2[0]) ? ' and ' : null;
     @$str2 [] = ($decimal_number < 21) ? $words[$decimal_number].' '. $digitsp[$decimal_number]. $plural.' '.$hundred:$words[floor($decimal_number / 10) * 10].' '.$words[$decimal_number % 10]. ' '.$digitsp[$counter].$plural.' '.$hundred;
      } else $str2[] = null;
    }
   
     $Rupees = implode('', array_reverse($str));
     $paise = implode('', array_reverse($str2));
     //$paise = ($decimal_part > 0) ? $paise . ' Paise' : '';
     $first_p =0 ;
     $second_p =0 ;
     $new_paisa = '';
     if($decimal_part > 0 ){
      $first_p =  intdiv($decimal_part, 10); 
      $second_p = fmod($decimal_part, 10) ;
     }
     $wordsp = array(0 => 'zero', 1 => 'one', 2 => 'two',
     3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
     7 => 'seven', 8 => 'eight', 9 => 'nine');
     if($decimal_part > 0 ){
     $paise_n = $wordsp[round($first_p)].' '.$wordsp[round($second_p)].' Paise';
     }else{
      $paise_n = '';
     }
     return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise_n;
    }
    

    function get_already_procured($kms_yr,$reg_no){

        $ci =& get_instance();
        $ci->load->database();
        $sql="SELECT ifnull(SUM(quantity), 0) procured_paddy
        FROM td_collections WHERE kms_id='".$kms_yr."' AND reg_no ='".$reg_no."' ";
       
          
         $paddy  =   $ci->db->query($sql)->row();
   
        return  $paddy->procured_paddy;
      // return  $kms_yr;
   }
   
   function get_farmer_name($kms_yr,$reg_no){

    $ci =& get_instance();
    $ci->load->database();
    $sql="SELECT farm_name
           FROM td_farmer_reg WHERE kms_id='".$kms_yr."' AND reg_no ='".$reg_no."' ";
   
     $paddy  =   $ci->db->query($sql)->row();
     
       if($paddy){
         $farmer = $paddy->farm_name;
      }else{
       
        $farmer = "Not Found";
      }
      return $farmer;

    }
  

  function get_bank_id($bank_sl_no){

    $ci =& get_instance();
    $ci->load->database();
    $sql="SELECT bank_id FROM md_paddy_bank WHERE sl_no='".$bank_sl_no."'";
    $result  =   $ci->db->query($sql)->row();

    return  $result->bank_id;
  
  }

  function get_district_name($id){

    $ci =& get_instance();
    $ci->load->database();
    $sql="SELECT district_name FROM md_district WHERE district_code ='".$id."' ";
      
    $paddy  =   $ci->db->query($sql)->row();

    return  $paddy->district_name;
 
  }

  function get_mill_name($id){

    if($id == ""){

       return  "Not Available";

    }else{

    $ci =& get_instance();
    $ci->load->database();
    $sql="SELECT mill_name FROM md_mill WHERE mill_code ='".$id."' ";
      
    $paddy  =   $ci->db->query($sql)->row();

    return  $paddy->mill_name;
    }
 
  }
  function get_society_name($id){

    if($id == ""){

       return  "Not Available";

    }else{

    $ci =& get_instance();
    $ci->load->database();
    $sql="SELECT soc_name FROM md_society WHERE society_code ='".$id."' ";
      
    $paddy  =   $ci->db->query($sql)->row();

    return  $paddy->soc_name;
    }
 
  }
  
  function get_fertisoc_name($id){

    if($id == ""){

       return  "Not Available";

    }else{

    $ci =& get_instance();
    $ci->load->database();
    $sql="SELECT soc_name FROM mm_ferti_soc WHERE soc_id ='".$id."' ";
    $paddy  =   $ci->db->query($sql)->row();

    return  $paddy->soc_name;
    }
 
  }
  function get_fersociety_name($id){

    if($id == ""){

       return  "Not Available";

    }else{

    $ci =& get_instance();
    $ci->load->database();
    $sql="SELECT soc_name FROM mm_ferti_soc WHERE soc_id ='".$id."' ";
      
    $paddy  =   $ci->db->query($sql)->row();

    return  $paddy->soc_name;
    }
 
  }
  
  function get_totcmr_delivery($kms_yr,$branch_id,$do_number){

        $ci =& get_instance();
        $ci->load->database();
        $sql="SELECT ifnull(SUM(tot_delivery), 0) tot_delivery
        FROM td_cmr_delivery WHERE kms_year='".$kms_yr."' AND branch_id ='".$branch_id."' AND do_number ='".$do_number."' ";
       
          
         $paddy  =   $ci->db->query($sql)->row();
   
        return  $paddy->tot_delivery;
   }
   function get_maxpady_limit($work_order_date){

        $ci =& get_instance();
        $ci->load->database();
        $sql="select max_qty from td_paddy_qty_dates where paddy_dt = (Select max(paddy_dt) from   td_paddy_qty_dates where paddy_dt <= '".$work_order_date."')";
       
         $paddy  =   $ci->db->query($sql)->row();
        return  $paddy->max_qty;
   }
   function get_receipt_no_fwd_status($receipt_detail_no){
        $ci =& get_instance();
        $ci->load->database();
        $sql="select count(*) cnt from tdf_adv_fwd where detail_receipt_no = '".$receipt_detail_no."' ";
        $advfwd  =  $ci->db->query($sql)->row();
        return $advfwd->cnt;
   }
   function pstot($branch_id){
       $ci =& get_instance();
       $db2 = $ci->load->database('socpaydb', TRUE);
       $sql="SELECT count(*) as cnt FROM `td_payment` WHERE `brn_id` = '$branch_id' AND `approve_status` = 'U' AND  bank_status = 'Captured' ";
       $advfwd  =  $db2->query($sql)->row();
       return $advfwd->cnt;
   }

?>