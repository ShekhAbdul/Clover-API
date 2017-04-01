<?php
/*-----
Here we are using "BulkLineItems" method of clover API. In this method we can create custom line items in particular order which are not available in our inventory. All fields are optional.
You can use loop for multiple data. Here we are sending multiple data.

To switch account from sandbox account to production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
------*/

function add_bulkLineItems($merchant_id,$access_token,$order_id,$itemCode1,$itemCode2,$isRevenue1,$isRevenue2,$price1,$price2,$name1,$name2)
{
	
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/orders/'.$order_id.'/bulk_line_items');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer ".$access_token,
   'Content-Type: application/json',
)
);
$data='{
  "items": [
    {
      "itemCode": "'.$itemCode1.'",
      "isRevenue": "'.$isRevenue1.'",
      "price": "'.$price1.'",
      "name": "'.$name1.'"
    },
	{
      "itemCode": "'.$itemCode2.'",
      "isRevenue": "'.$isRevenue2.'",
      "price": "'.$price2.'",
      "name": "'.$name2.'"
    }
  
  ]
}';
print_r($data);
curl_setopt( $curl, CURLOPT_POST, true );
curl_setopt( $curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$bulk_detail=json_decode($auth);
return $bulk_detail;

}

/* parameters for creating bulk lineitems for particular order */
$merchant_id="RN2XHHV9PA0BC";
$access_token="87de8e12-5b1a-6a8c-eee8-9d17b3a7ba14";
$order_id="6S70BG6P8F836";
$itemCode1="1234";
$itemCode2="6789";
$isRevenue1="true";
$isRevenue2="true";
$price1="3000";
$price2="4000";
$name1="ice cream";
$name2="orange juice";

/* calling function */
$result=add_bulkLineItems($merchant_id,$access_token,$order_id,$itemCode1,$itemCode2,$isRevenue1,$isRevenue2,$price1,$price2,$name1,$name2);
echo"<pre>";
print_r($result);
?>
