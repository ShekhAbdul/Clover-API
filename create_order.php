<?php
/*---- Here we are creating order with its line item from sandbox account. 
To fetch inventory from production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/".
There are two steps for creating order-
1) First we have to create order. And we get order id.
2) Then we have to pass that order id to create order line item.

Note- For adding multiple line item you have to make separate call for each item in "create_order_lineItem" function.

Note-if “isVat=true”  while creating order. This means the tax amount is already included in the lineItem total – no additional amount should be added for tax.
------*/


/* function for creating order */
function create_order($merchant_id, $access_token, $employee_id, $title, $currency, $state, $groupLineItems, $manualTransaction, $testMode, $taxRemoved,$isVat)
  {
    $curl = curl_init('https://apisandbox.dev.clover.com/v3/merchants/' . $merchant_id . '/orders');
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        
        "Authorization:Bearer " . $access_token,
        'Content-Type: application/json'
    ));
    $data = '{
  
  "employee": {
    "id": "' . $employee_id . '"
  },
  "title": "' . $title . '",
  "currency": "' . $currency . '",
  "state": "' . $state . '",
  "groupLineItems": "' . $groupLineItems . '",
  "manualTransaction": "' . $manualTransaction . '",
  "testMode": "' . $testMode . '",
  "taxRemoved": "' . $taxRemoved . '",
  "isVat":"'.$isVat.'"
}';
    
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $auth = curl_exec($curl);
    $info = curl_getinfo($curl);
    echo "<pre>";
    $order_detail = json_decode($auth);
    
    return $order_detail;
    
    
  }


/* function for creating line item in that particular id */
function create_order_lineItem($merchant_id, $access_token, $order_id, $item_id)
  {
    $curl = curl_init('https://apisandbox.dev.clover.com/v3/merchants/' . $merchant_id . '/orders/' . $order_id . '/line_items');
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        
        "Authorization:Bearer " . $access_token,
        'Content-Type: application/json'
    ));
    $data = '{
	"item": {
		"id": "' . $item_id . '"
	}
}';
    
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $auth           = curl_exec($curl);
    $info           = curl_getinfo($curl);
    $order_lineItem = json_decode($auth);
    return $order_lineItem;
  }

  
/* passing parameters to functions (all parameters are optional)*/
$merchant_id       = "RN2XHHV9PA0BC";
$access_token      = "af832c6b-b450-a2b5-3fa7-7d820c0cdce7";
$employee_id       = "19NH2EY4Q9RSY";
$title             = "Sample order";
$currency          = "USD";
$state             = "Open";
$groupLineItems    = "false";
$manualTransaction = "false";
$testMode          = "false";
$taxRemoved        = "false";
$isVat        	   = "true";

$result   = create_order($merchant_id, $access_token, $employee_id, $title, $currency, $state, $groupLineItems, $manualTransaction, $testMode, $taxRemoved,$isVat);
/* getting order id from create_order function */
$order_id = $result->id;

$item_id = "MNMMCNNZCCDSW";

/* passing this order_id to create_order_lineItem function with item_id.*/
$line_result = create_order_lineItem($merchant_id, $access_token, $order_id, $item_id);
$orderId     = $line_result->orderRef->id;

echo "order successfully created. Order Id is- " . $orderId;
?>