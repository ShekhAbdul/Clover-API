<?php
/*---- Here we are adding discount to particular order lineitem.
Discount can be add via two types-
1) By using amount.
2) By using percentage.

In below code we are using discount amount. To pass percentage field you have to simply change "name" field with "percentage". Name of discount is also required field. Always pass negative value in discount amount but while passing percentage you have to pass positive value.

Note- Money amounts in Clover are always passed as ‘cent’ values. So an amount or total of 2099 would be equivalent to $20.99 for a merchant using the US dollar.
For percentage 10 means 10%.

To switch account from sandbox account to production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
-----*/ 
function orderLine_discount($merchant_id,$access_token,$order_id,$lineItem_id,$discount_amount,$discount_name)
{
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/orders/'.$order_id.'/line_items/'.$lineItem_id.'/discounts');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer ".$access_token,
   'Content-Type: application/json',
)
); 
$data='{
	"name": "'.$discount_name.'",
  "amount": "'.$discount_amount.'"
  
}';

curl_setopt( $curl, CURLOPT_POST, true );
curl_setopt( $curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$order_lineItem=json_decode($auth);
return $order_lineItem;
}

/*parameter for adding discount in order's lineitem */
$merchant_id="RN2XHHV9PA0BC";
$access_token="0c635734-cccb-58ce-90b3-eb3a1932d01e";
$order_id="DPX05JS4J9NAG";
$lineItem_id="ZP4AAAH469DGP";
$discount_amount="-1000";/*note- discount amount should always be negative value*/
$discount_name="new discount";
$result= orderLine_discount($merchant_id,$access_token,$order_id,$lineItem_id,$discount_amount,$discount_name);
echo "<pre>";
print_r($result);
?>
