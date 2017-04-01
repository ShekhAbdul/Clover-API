<?php
/*---- In this page we are fetching details of order's line item with its discount, tax and modifier to calculate order total*/
include('discount_total.php');
function order_total($merchant_id, $access_token, $order_id){

	$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/orders/'.$order_id.'?expand=discounts');

	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	  
		   "Authorization:Bearer ".$access_token,
		   'Content-Type: application/json',
		)
	);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$auth = curl_exec($curl);
	$info = curl_getinfo($curl);
	$order_result=json_decode($auth);


	$discount_ele=$order_result->discounts->elements;
	if($discount_ele){

		foreach($discount_ele as $discval){

		 $dis_amt+=$discval->amount;
		}	
	}

		
		
	$curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/orders/'.$order_id.'/line_items?expand=taxRates&expand=modifications&expand=discounts');

	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	  
		   "Authorization:Bearer ".$access_token,
		   'Content-Type: application/json',
		)
	);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$auth = curl_exec($curl);
	$info = curl_getinfo($curl);
	$line_result=json_decode($auth);

	$line_elements=$line_result->elements;
	foreach($line_elements as $line_value){
		
		$i=1;
		$line_price=$line_value->price;
		$modifier_elements=$line_value->modifications->elements;
		$count=count($modifier_elements);
		
		/* retrieving modifiers of order's lineitem */
		if($modifier_elements){

			foreach($modifier_elements as $modifier_value){

				if($i==$count){
					$modifier_amt=$modifier_value->amount;
				}elseif($i<$count){

					$modifier_amt+=$modifier_value->amount;
				}elseif($i>$count){
					break;
				}
				
			}
			$i++;
		}else{

			$modifier_amt=0;
		}
		
		/*adding modifiers with lineitem price*/
		$total_price=$line_price+$modifier_amt;
		
		/* retrieving discount of order's lineitem */
		$discounts_elements=$line_value->discounts->elements;
		if($discounts_elements){
			foreach($discounts_elements as $discounts_value){

				 $discount_percent=$discounts_value->percentage;
				$discount_price+=($discount_percent/100)*$total_price;
				 
			}
		}else{
			$discount_price=0;
		}
		
		/*subtracting discount from total price of lineitem */
		$pre_total=$total_price-$discount_price;
		$sub_total+=$pre_total;
		$pre_sub_total[]=$pre_total; 

		if($discount_ele){
			/*calling function of discount_total.php page */
			$price_res=dis_total($merchant_id, $access_token, $order_id);
			$first=round((($pre_total/$price_res['order_total'])*100),2);
			$pre_total=(($price_res['discount_total']*$first)/10000);
			
			
		}


		/* retrieving tax rates of lineitem*/
		$tax_elements=$line_value->taxRates->elements;
		if($tax_elements){

			foreach($tax_elements as $tax_value){

				 $tax_amt=$tax_value->rate;
				
				 
				$per= substr($tax_amt, 0, -5);
				$percent+=round(($per/100)*$pre_total,2);
				
			
				
			}	
		}

	}

	if($discount_ele){

		$sub= substr($price_res['discount_total'], 0, -2);
		$order_total_result=$sub+$percent;
	}else{
		
		$order_total=$sub_total+$percent;
		$order_total_result=substr($order_total, 0, -2);
	}
	/*returing order total calculated above*/
	return number_format($order_total_result,2);	
}

?>