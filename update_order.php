<?php
/*---- 
Here we are updating order's status.
There are three status given-
1. Null- It means order is empty and it is not displayed in user interfaces. 
2. Open- It means order is in open status and payment of orders not yet done.
3. Locked- It means order is completed and payment of order is done.

To switch account from sandbox account to production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
-----*/ 
function update_order($merchant_id,$access_token,$order_id,$status)
{
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/orders/'.$order_id);

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer ".$access_token,
   'Content-Type: application/json',
)
); 
$data='{
  "state": "'.$status.'"
  
}';

curl_setopt( $curl, CURLOPT_POST, true );
curl_setopt( $curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$tax_detail=json_decode($auth);
return $tax_detail;
}

/*parameter for updating order */
$merchant_id="RN2XHHV9PA0BC";
$access_token="0c635734-cccb-58ce-90b3-eb3a1932d01e";
$status="Locked";
$order_id="2CB6V6MTVRZG0";
$result= update_order($merchant_id,$access_token,$order_id,$status);
echo "<pre>";
print_r($result);
?>
