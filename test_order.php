<?php
include("tax_calculate.php");

/* funtion to create order */
function create_order($merchant_id, $access_token, $employee_id, $title, $currency, $state, $groupLineItems, $manualTransaction, $testMode, $taxRemoved, $isVat) {
    
	$curl = curl_init('https://apisandbox.dev.clover.com/v3/merchants/' . $merchant_id . '/orders');
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Authorization:Bearer " . $access_token,
            'Content-Type: application/json' ));
        $data = '{
          "employee": {
          "id": "' . $employee_id . '" },
          "title": "' . $title . '",
          "currency": "' . $currency . '",
          "state": "' . $state . '",
          "groupLineItems": "' . $groupLineItems . '",
          "manualTransaction": "' . $manualTransaction . '",
          "testMode": "' . $testMode . '",
          "taxRemoved": "' . $taxRemoved . '",
          "isVat":"' . $isVat . '"
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
/* END of create order*/

/* function for creating line item in order*/
function create_order_lineItem($merchant_id, $access_token, $order_id, $item_id) {
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

/* funtion to add modifier in order */
function add_modification($merchant_id, $access_token, $order_id, $lineItem_id, $modifier_id) {
    $curl = curl_init('https://apisandbox.dev.clover.com/v3/merchants/' . $merchant_id . '/orders/' . $order_id . '/line_items/' . $lineItem_id . '/modifications');
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        
        "Authorization:Bearer " . $access_token,
        'Content-Type: application/json'
    ));
    $data = '{
      "modifier": {
        "id": "' . $modifier_id . '"
      }
    }';
    
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $auth                = curl_exec($curl);
    $info                = curl_getinfo($curl);
    $modification_result = json_decode($auth);
    return $modification_result;
}

/* funtion to add discount in order */
function order_discount($merchant_id, $access_token, $order_id, $discount_amount, $discount_name) {
    $curl = curl_init('https://apisandbox.dev.clover.com/v3/merchants/' . $merchant_id . '/orders/' . $order_id . '/discounts');
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        
        "Authorization:Bearer " . $access_token,
        'Content-Type: application/json'
    ));
    $data = '{
      "name": "' . $discount_name . '",
      "amount": "' . $discount_amount . '"
      
    }';
    
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $auth            = curl_exec($curl);
    $info            = curl_getinfo($curl);
    $discount_result = json_decode($auth);
    return $discount_result;
}

/* funtion to add discount in order's lineitem */
function orderLine_discount($merchant_id, $access_token, $order_id, $lineItem_id, $discount_amount, $discount_name) {
    $curl = curl_init('https://apisandbox.dev.clover.com/v3/merchants/' . $merchant_id . '/orders/' . $order_id . '/line_items/' . $lineItem_id . '/discounts');
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        
        "Authorization:Bearer " . $access_token,
        'Content-Type: application/json'
    ));
    $data = '{
    	"name": "' . $discount_name . '",
        "amount": "' . $discount_amount . '"
      
    }';
    
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $auth           = curl_exec($curl);
    $info           = curl_getinfo($curl);
    $order_lineItem = json_decode($auth);
    return $order_lineItem;
}

/* funtion to add discount by percent in order's lineitem*/
function orderLine_discount_percentage($merchant_id, $access_token, $order_id, $lineItem_id, $discount_percent, $discount_name2) {
    $curl = curl_init('https://apisandbox.dev.clover.com/v3/merchants/' . $merchant_id . '/orders/' . $order_id . '/line_items/' . $lineItem_id . '/discounts');
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        
        "Authorization:Bearer " . $access_token,
        'Content-Type: application/json'
    ));
    $data = '{
    	"name": "' . $discount_name2 . '",
        "percentage": "' . $discount_percent . '"
      
    }';
    
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $auth           = curl_exec($curl);
    $info           = curl_getinfo($curl);
    $order_lineItem = json_decode($auth);
    return $order_lineItem;
}

/* funtion to update order */

function update_order($merchant_id,$access_token,$order_id,$status){

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

/* function to delete order */
function delete_order($merchant_id,$access_token,$order_id){
    
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
/* funtions end----------------------------------------------------------------------*/


/* Required parameters*/
$merchant_id  = "RN2XHHV9PA0BC";
$access_token = "af832c6b-b450-a2b5-3fa7-7d820c0cdce7";

/*Step1- creating order -------*/
$employee_id       = "19NH2EY4Q9RSY";
$title             = "Sample order";
$currency          = "USD";
$state             = "Open";
$groupLineItems    = "false";
$manualTransaction = "false";
$testMode          = "false";
$taxRemoved        = "false";
$isVat             = "true";

$result = create_order($merchant_id, $access_token, $employee_id, $title, $currency, $state, $groupLineItems, $manualTransaction, $testMode, $taxRemoved, $isVat);


/* getting order id */
$order_id = $result->id;

/*Step2- passing order id to create line item with item id of item available in inventory ------------*/

//,"FW0G146Q4HCD2"
$item_array = array(
    "A5NWRHG56ZCC2",
	"FW0G146Q4HCD2"
);

foreach ($item_array as $item_id) {
    $line_result = create_order_lineItem($merchant_id, $access_token, $order_id, $item_id);
    $orderId     = $line_result->orderRef->id;
	
    echo "<pre>";
    $line_id[] = $line_result->id;
	$line_price[] = $line_result->price;
	$total_price+=$line_result->price;
}

/*Step3- adding modifier to lineitem id------------*/

/* 1. adding single modifier of single group*/

$modifier_id = "EVYGGGJWX3YGW";

$result_modifier = add_modification($merchant_id, $access_token, $order_id, $line_id[0], $modifier_id);
$modifier_amount=$result_modifier->amount;

/* 2. adding multiple modifier of multiple group*/
$modifier_array = array(
    "EVYGGGJWX3YGW",
    "633CC547G9CRC",
    "XQBCN9JC5MRMJ"
);
foreach ($modifier_array as $modifier_id2) {
   $result_modifiera = add_modification($merchant_id, $access_token, $order_id, $line_id[1], $modifier_id2);
	$modifier_amount2+=$result_modifiera->amount;
}


/*Step4- adding discount by percent to order's line item------------*/
$discount_percent = "10";
$discount_name2   = "line discount";

$resultdo = orderLine_discount_percentage($merchant_id, $access_token, $order_id, $line_id[0], $discount_percent, $discount_name2);
$discount_amount2=$resultdo->percentage;
$total_line2Price=$modifier_amount2+$line_price[0];
$dis_percent=($discount_amount2 / 100) * $total_line2Price;

/*Step4- adding discount to order------------*/
$discount_amount = "-1000";
$discount_name   = "new discount";
$resultd         = order_discount($merchant_id, $access_token, $order_id, $discount_amount, $discount_name);
$discount_amount=$resultd->amount;

/*Step5- calculate order total----*/
$order_total= order_total($merchant_id, $access_token, $order_id);
echo"<br>Your order total is: $". $Total.".00 for this order id: ".$order_id;

/*Step6- To change status of this order run this function */
$status="locked";/*"locked" means order is completed.*/
/* $status="cancelled"; If you want to change status to cancel than pass this parameter.*/
$update_result= update_order($merchant_id,$access_token,$order_id,$status);


/*Step7- To delete order run this function */
$deleted_result= delete_order($merchant_id,$access_token,$order_id);