<?php
/*Here we are fetching lineitem details of an order.

To switch account from sandbox account to production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
*/


function get_line($merchant_id,$access_token,$order_id)
{
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/orders/'.$order_id.'/line_items?expand=taxRates&expand=modifications&expand=discounts');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer af832c6b-b450-a2b5-3fa7-7d820c0cdce7",
   'Content-Type: application/json',
)
);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$line_detail=json_decode($auth);

return $line_detail; 
}

/*parameter for deleting order */
$merchant_id="RN2XHHV9PA0BC";
$access_token="0c635734-cccb-58ce-90b3-eb3a1932d01e";
$order_id="NQD9BXE6S00P4";
$result= get_line($merchant_id,$access_token,$order_id);
echo "<pre>";
print_r($result);
?>