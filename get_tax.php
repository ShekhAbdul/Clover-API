<?php
/*---- 
Here we are listing tax details.
To switch account from sandbox account to production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
-----*/ 
function get_tax($merchant_id,$access_token)
{
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/tax_rates');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer ".$access_token,
   'Content-Type: application/json',
)
); 

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$tax_result=json_decode($auth);
return $tax_result;
}

/*parameter for adding tax in inventory item */
$merchant_id="RN2XHHV9PA0BC";
$access_token="0c635734-cccb-58ce-90b3-eb3a1932d01e";

$result= get_tax($merchant_id,$access_token);
echo "<pre>";
print_r($result);
?>
