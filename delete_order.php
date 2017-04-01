<?php
/*---- 
Here we are deleting order by passing order id of that order.

To switch account from sandbox account to production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
-----*/ 
function delete_order($merchant_id,$access_token,$order_id)
{
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/orders/'.$order_id);

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer ".$access_token,
   'Content-Type: application/json',
)
); 

curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$order_detail=json_decode($auth);
return $order_detail;
}

/*parameter for deleting order */
$merchant_id="RN2XHHV9PA0BC";
$access_token="0c635734-cccb-58ce-90b3-eb3a1932d01e";
$order_id="M1D76J5RK2A38";
$result= delete_order($merchant_id,$access_token,$order_id);
echo "<pre>";
print_r($result);
?>
