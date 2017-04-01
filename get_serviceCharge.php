<?php
/*---- 
Here we are fetching service charge detail from clover account.
Note- To use service charge you have first enable service charge from your clover account. Go to "Setup->Service Charge".

To switch account from sandbox account to production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
-----*/ 
function get_serviceCharge($merchant_id,$access_token)
{
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/default_service_charge');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer ".$access_token,
   'Content-Type: application/json',
)
); 

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$get_service=json_decode($auth);
return $get_service;
}

/*parameter */
$merchant_id="RN2XHHV9PA0BC";
$access_token="87de8e12-5b1a-6a8c-eee8-9d17b3a7ba14";


/*calling function */
$result= get_serviceCharge($merchant_id,$access_token);
echo "<pre>";
print_r($result);
?>
