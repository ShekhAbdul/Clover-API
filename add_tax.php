<?php
/*---- 
Here we are adding tax amount to particular inventory item.
Note- "rate" value is percentage value of item price.

Note-if “isVat=true”  while creating order. This means the tax amount is already included in the lineItem total – no additional amount should be added for tax.

To switch account from sandbox account to production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
-----*/ 
function add_tax($merchant_id,$access_token,$item_id,$name,$rate,$isDefault)
{
$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/tax_rates');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  
   "Authorization:Bearer ".$access_token,
   'Content-Type: application/json',
)
); 
$data='{
  "isDefault": "'.$isDefault.'",
  "rate": "'.$rate.'",
  "name": "'.$name.'",
  "items": [
    {
      "id": "'.$item_id.'"
    }
  ]
}';

curl_setopt( $curl, CURLOPT_POST, true );
curl_setopt( $curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$auth = curl_exec($curl);
$info = curl_getinfo($curl);
$tax_detail=json_decode($auth);
return $tax_detail;
}

/*parameter for adding tax in inventory item */
$merchant_id="RN2XHHV9PA0BC";
$access_token="0c635734-cccb-58ce-90b3-eb3a1932d01e";
$isDefault="false";
$rate="10";
$name="service tax";
$item_id="2443DFGFH";
$result= add_tax($merchant_id,$access_token,$item_id,$name,$rate,$isDefault);
echo "<pre>";
print_r($result);
?>
