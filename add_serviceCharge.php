<?php
/*---- 
Here we are adding service charge to particular order.

To switch account from sandbox account to production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
-----*/ 
function add_serviceCharge($merchant_id,$access_token,$order_id,$name,$charge_id,$percentage,$percentageDecimal,$enable)
{
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/orders/'.$order_id.'/service_charge');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer ".$access_token,
   'Content-Type: application/json',
)
); 
$data='{
  "percentage": "'.$percentage.'",
  "name": "'.$name.'",
  "id": "'.$charge_id.'",
  "enabled": "'.$enable.'",
  "percentageDecimal": "'.$percentageDecimal.'"
}';


curl_setopt( $curl, CURLOPT_POST, true );
curl_setopt( $curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$add_service=json_decode($auth);
return $add_service;
}

/*parameter for adding service charge in particular order */
$merchant_id="RN2XHHV9PA0BC";
$access_token="87de8e12-5b1a-6a8c-eee8-9d17b3a7ba14";
$order_id="6S70BG6P8F836";
$name="Service cost";
$charge_id="1345";
$percentage="10";
$percentageDecimal="100000";
$enable="true";

/*calling function */
$result= add_serviceCharge($merchant_id,$access_token,$order_id,$name,$charge_id,$percentage,$percentageDecimal,$enable);
echo "<pre>";
print_r($result);
?>
