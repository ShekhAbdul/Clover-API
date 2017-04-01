<?php
/*-- Here we are listing orders from clover account

To switch account from sandbox account to production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
---*/

function get_orders($merchant_id,$access_token)
{
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/orders');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer ".$access_token
)
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$order_detail=json_decode($auth);	
return $order_detail;
} 


$merchant_id="RN2XHHV9PA0BC";
$access_token="87de8e12-5b1a-6a8c-eee8-9d17b3a7ba14";
$result=get_orders($merchant_id,$access_token);
echo"<pre>";
print_r($result);
?>