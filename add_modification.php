<?php
/*---- Here we are adding modifiers in order's line item. 
Modifiers can be add only with its modifier id not with its modifier group id to particular lineitem id which we will get after order creation. To add multiple modifiers to lineitem you have to call separate request for each modifier. 

To add modifier in production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
------*/

function add_modification($merchant_id,$access_token,$order_id,$lineItem_id,$modifier_id)
{
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/orders/'.$order_id.'/line_items/'.$lineItem_id.'/modifications');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer ".$access_token,
   'Content-Type: application/json',
)
); 
$data='{
  "modifier": {
    "id": "'.$modifier_id.'"
  }
}';

curl_setopt( $curl, CURLOPT_POST, true );
curl_setopt( $curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$modification_result=json_decode($auth);
return $modification_result;
}

/* parameters for adding modifier in order's lineitem*/
$merchant_id="RN2XHHV9PA0BC";
$access_token="0c635734-cccb-58ce-90b3-eb3a1932d01e";
$order_id="DPX05JS4J9NAG";
$lineItem_id="ZP4AAAH469DGP";
$modifier_id="XEN7E4CYZ7W84";
/* calling function */
$result= add_modification($merchant_id,$access_token,$order_id,$lineItem_id,$modifier_id);
echo "<pre>";
print_r($result);
?>