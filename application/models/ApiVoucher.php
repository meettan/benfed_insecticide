<?php 
/*********************************************************************************************** *
/* Model for API connection bentween FErtilizer and Finance modulev                              *
 * Transactions is fertilizer module and corresponding accounting voucher in Finance Module      *
 *************************************************************************************************/

class ApiVoucher extends CI_Model{

    /**Function for Company Advance Payment in HO */

   /* function f_compadvjnl($data){  
        $curl = curl_init();
        curl_setopt_array($curl, array(
         CURLOPT_URL => 'http://localhost/benfed/Benfed_finance/index.php/api_voucher/compadv_voucher',
       
                        
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
          "data": '.json_encode($data).'
        }',
        
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;
        
    }*/

    /**Function for Branch Advance from Party */

    function f_advjnl($data){
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/benfed/Benfed_finance/index.php/api_voucher/adv_voucher',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "data": '.json_encode($data).'
        }',
        
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
         return $response;
        
    }





    /********************************************** */
    /* function for purchase */

function f_purchasejnl($data){
	$curl = curl_init();
  // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt_array($curl, array(
	
	CURLOPT_URL => 'http://localhost/benfed/Benfed_finance/index.php/api_voucher/purchase_voucher_ins',

	 CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'{
		"data": '.json_encode($data).'
	}',
	
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json',
		'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
	  ),
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);
  
	// print_r($response);
	return $response;
	// exit;
}


    /********************************************** */
    /* function for recive payment */


function f_recvjnl_soc($data){
    //echo '<pre>';var_dump($data);
   $curl = curl_init();

   curl_setopt_array($curl, array(
   CURLOPT_URL => 'http://localhost/benfed/Benfed_finance/index.php/api_voucher/recv_voucher_soc',
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'POST',
     CURLOPT_POSTFIELDS =>'{
       "data": '.json_encode($data).'
   }',
   
     CURLOPT_HTTPHEADER => array(
       'Content-Type: application/json',
       'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
     ),
   ));
   
   $response = curl_exec($curl);
   
   curl_close($curl);
   echo $response;
   // exit;
   
}

function f_recvjnl($data){
    //  echo '<pre>';var_dump($data);
    //  exit();
    $curl = curl_init();

    curl_setopt_array($curl, array(
      
      CURLOPT_URL => 'http://localhost/benfed/Benfed_finance/index.php/api_voucher/recv_voucher',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "data": '.json_encode($data).'
    }',
    
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    // exit;
    
}

function f_recvjnl_dr($data){
    //  echo '<pre>';var_dump($data);
    //  exit();
    $curl = curl_init();

    curl_setopt_array($curl, array(
    
    CURLOPT_URL => 'http://localhost/benfed/Benfed_finance/index.php/api_voucher/recv_voucher_dr',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "data": '.json_encode($data).'
    }',
    
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    // exit;
    
}

public function delete_recvjnl($paid_id){

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/benfed/Benfed_finance/index.php/api_voucher/delete_voucher_dr',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "data": '.json_encode($paid_id).'
    }',
    
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;

}



public function delete_advancefilter_recvjnl($paid_id){

  $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost/benfed/Benfed_finance/index.php/api_voucher/delete_voucher_advvance_jrnal',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
      "data": '.json_encode($paid_id).'
  }',
  
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Cookie: ci_session=eieqmu6gupm05pkg5o78jqbq97jqb22g'
    ),
  ));
  
  $response = curl_exec($curl);
  
  curl_close($curl);
  return $response;

}


}
