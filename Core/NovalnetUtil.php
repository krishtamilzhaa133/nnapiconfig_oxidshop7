<?php

namespace Nnapiconfigure\Core;


class NovalnetUtil
{

    public function endpoint($action) {
        $url =[

              'Merchant_Details'=>"https://payport.novalnet.de/v2/merchant/details",
        ];
        if (isset($url[$action])) {
         return $url[$action];
        }
    }
    public static function build_api_params($request) {
      $signature=  $request['signature'];
      $lang=  $request['lang'];
      $data = [];
      $data['merchant'] = [
          'signature' => $signature,
      ];
      $data['custom'] = [
          'lang' =>$lang,
      ];
      return $data;
  }

    public function get_headers($data) {
      $payment_access_key=$data;
      $encoded_data = base64_encode($payment_access_key);

       $headers=[
         'Content-Type:application/json',
         'Charset:utf-8', 
         'Accept:application/json', 
         'X-NN-Access-Key:' . $encoded_data
       ];
       return $headers;
    }
     
    
    public function send_payment_request($data,$url,$payment_access_key) {
	    $json_data = json_encode($data);
        file_put_contents('request.txt', print_r($json_data, true), FILE_APPEND);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER,$this->get_headers($payment_access_key)); 

        $result = curl_exec($curl);
        file_put_contents('result.txt', print_r($result, true), FILE_APPEND);   
        if (curl_errno($curl)) {
          echo 'Request Error:' . curl_error($curl);
          return $result;
        }
        curl_close($curl);
        $result = json_decode($result);
        return $result;
    }
}
