<?php
/*---- 
Here we are listing modifiers from sanbox account.

To switch account from sandbox account to production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
*----*/
function get_modifiers($merchant_id,$access_token)
{
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/modifiers');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer ".$access_token,
   'Content-Type: application/json',
)
); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$modifier=json_decode($auth);
return $modifier;
}


/*parameters for listing modifiers */
$merchant_id="RN2XHHV9PA0BC";
$access_token="dec406cb-90cb-155c-8583-28c785c83500";
/*calling function */
$result= get_modifiers($merchant_id,$access_token);
echo "<pre>";
print_r($result);
?>