<?php
/*---- In this page we are calculating total discount of order with total value*/

function dis_total($merchant_id, $access_token, $order_id)
{
	/* here we are finding discount amount of order */
	
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
		
		/* Here we are finding line item detail with modifier and discount of order*/
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

	}

	$distotal=$sub_total+$dis_amt;
	$arr=array("order_total"=>$sub_total,"discount_total"=>$distotal);

	/*returing discount value and total price of order*/
	return $arr;	

}

?>