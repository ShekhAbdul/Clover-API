<?php
/*---- 
Here we are listing modifiers groups from sanbox account.

To switch account from sandbox account to production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
*----*/

function get_modifiersGrp($merchant_id,$access_token)
{
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/modifier_groups');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer ".$access_token,
   'Content-Type: application/json',
)
); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$order_lineItem=json_decode($auth);
return $order_lineItem;
}

/*parameters for listing modifiers groups*/
$merchant_id="RN2XHHV9PA0BC";
$access_token="0c635734-cccb-58ce-90b3-eb3a1932d01e";
$result= get_modifiersGrp($merchant_id,$access_token);
echo "<pre>";
print_r($result);
?>