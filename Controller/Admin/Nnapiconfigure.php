<?php

namespace Nnapiconfigure\Controller\Admin;

use OxidEsales\Eshop\Application\Controller\Admin\ShopConfiguration;
use Nnapiconfigure\Core\NovalnetUtil;
use OxidEsales\Eshop\Core\Registry;


class Nnapiconfigure extends ShopConfiguration
{

  public function getmerchatdetails(){
    $request = $_REQUEST;
    $novalnetutil=new NovalnetUtil();
    $url=$novalnetutil->endpoint('Merchant_Details');
    $merchat_details= $novalnetutil->build_api_params($request);
    $response =  $novalnetutil->send_payment_request($merchat_details, $url,$request['access_key']);
    echo json_encode($response);
  }


}
