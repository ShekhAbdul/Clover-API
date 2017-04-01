# README #

### What is this repository for? ###

In Clover Backend we are integrating Clover API methods and webhooks with the website.
So, for integration we have to make OAuth 2.0 authorization in clover account for using its API methods and Webhook.
https://docs.clover.com/build/working-with-orders/

### Note- ###
This doc is based on sandbox account of clover.
Money amounts in Clover are always passed as ‘cent’ values. So an amount or total of 2099 would be equivalent to $20.99 for a merchant using the US dollar.


### How do I get set up? ###

#. OAuth 2.0 authorization process-
   First of all you have create developer account in clover
   For sandbox account-https://sandbox.dev.clover.com/developers 
   For production account- https://www.clover.com/developers 

After that you have to create an app in developer account.
Then you will get client id and client secret after click on “setting” option on that app.
In setting tag, there are many other options available :- e.g android APKs, web configuration, webhook etc.

In that you have to select web configuration option to set site url and default auth response. In default auth response you will select code option.
After above process you have to pass client id, client secret and auth URL for authorization in below php file
Php file name- token.php

#. Fetching inventory details from clover
To fetch all inventory detail we used two methods-
 a.Get all inventory API method .
 b.Via Webhook

API Method-
We are fetching inventory from sandbox account. So we are using https://apisandbox.dev.clover.com/ url to get data.  But for production account you have to change this sandbox url to production url i.e https://api.clover.com/ 
PHP file for inventory : - get_inventory.php
Required details available in php page.


Webhook-
For webhook, you have to set webhook url in “webhook” option, which is available in app setting of developer site. And you have to tick mark the option from which you want to get webhook response.


3. Creating Order with its Line items-
We are creating order in sandbox account. 
Note- In order creation the parameters which we are passing all are optional as per clover API document.
For more detail please refer to PHP file- create_order.php

4. Listing Modifiers- 
We are fetching list of modifiers from clover account.
For function please refer to this PHP page- get_modifier.php

5. Listing Modifier Groups- 
We are fetching list of groups of modifiers from clover account.
For function please refer to this PHP page- get_modifierGroup.php

6. Adding discount to particular order-
Adding discount to particular order. For adding discount we have to pass either “amount” or “percentage” fields with discount name.
For more detail refer to this PHP file- add_discount.php

7. Adding discount to particular order’s lineitem-
Adding discount to particular order’s lineitem. For adding discount we have to pass either “amount” or “percentage” fields with discount name.
For more detail refer to this PHP file- add_lineItem_discount.php

8. Adding modifier to particular order’s lineitem-
Adding modifiers to particular order’s lineitem. 
Note- We can only send modifiers id not modifiers group id to particular lineitem.
For more detail refer to this PHP file- add_modification.php

9. Adding tax amount to particular inventory item-
Adding tax amount to particular inventory item. 
Note-if “isVat=true”  while creating order. This means the tax amount is already included in the lineItem total – no additional amount should be added for tax.
For more detail refer to this PHP file- add_tax.php

10. Listing tax rates-
Listing tax rates from clover account. 
For more detail refer to this PHP file- get_tax.php

11. Listing orders-
Listing orders from clover account. 
For more detail refer to this PHP file- get_orders.php

12. Adding Bulk Line Items-
Adding bulk line items in particular order.
Note- In this method we are adding those item which are not available in our inventory. We can say that these are custom items. 
For more detail refer to this PHP file- bulk_lineItem.php


14. Fetching service charge-
Fetching service charge details from clover account.
Note- To use service charge you have first enable service charge from your clover account. Go to "Setup->Service Charge". 
For more detail refer to this PHP file- get_serviceCharge.php

15. Adding service charge to particular order-
Adding service charge to particular order.
For more detail refer to this PHP file- add_serviceCharge.php

16. Updating order status-
Updating order status in particular order.
For more detail refer to this PHP file- update_order.php

17. Deleting  order-
Deleting particular order.
For more detail refer to this PHP file- delete_order.php

18. Fetching order’s lineitem detail-
Fetching details of order line item.
For more detail refer to this PHP file- get_lineitem.php

19. Creating sample order with calculation of order total-
Two pages included- 1. test_order.php
	            2. tax_calculate.php
		    3. discount_total.php

 Note : In “test_order.php” page we are creating sample order including modifiers and discount.    And in “tax_calculate.php” calculating order total of that order. This page (tax_calculate.php) is called by a function in test_order.php. And “discount_total.php” page calculate price of total line item after addind modifier and subtracting discount.