<?php

/*--------

We making authorization of clover account in sandbox environment.
For sandbox account the urls are-
1)https://sandbox.dev.clover.com/oauth/authorize - This is use to authorize.
2)https://sandbox.dev.clover.com/oauth/token - This is used to get token.

For Production account -
1)https://www.clover.com/oauth/authorize - This is use to authorize.
2)https://www.clover.com/oauth/token - This is used to get token.

To make authorization in production environment you have to change url as given above. 
*/


include("config.php");
if (isset($_GET['code']))
{
    $code        = $_GET['code'];
    $merchant_id = $_GET['merchant_id'];
    $client_id   = $_GET['client_id'];
    $employee_id = $_GET['employee_id'];
    
    /* We are using url of sandbox account with client id and client secret which we get from clover developer site.*/
    $curl = curl_init('https://sandbox.dev.clover.com/oauth/token?client_id=4MCB083YEENNR&client_secret=0c140864-ace6-66f3-46b0-7ad995030b08&code=' . $code);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $auth   = curl_exec($curl);
    $info   = curl_getinfo($curl);
    $secret = json_decode($auth);
    //echo "<pre>";
   // print_r($secret);
    //echo "</pre>";
    $access_token = $secret->access_token;
	
	/* storing data in database*/
    mysqli_query($con, "insert into token(merchant_id,employee_id,access_token) values('$merchant_id','$employee_id','$access_token') on duplicate key update merchant_id='$merchant_id',employee_id='$employee_id',access_token='$access_token'");
	
	/*redirecting page*/
    //echo "<script>location.replace('token.php');</script>";
}
?>



<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   </head>
   <body>
   
   
      <br><br><br>
      <div class="container">
		<?php
			if (isset($_GET['code'])){
			
		?>
		<div class="row">
	        <div class="col-md-4 col-md-offset-4">
			<!-- 
			For authorization here we are using url of sandbox with client id and redirect url. We will client id from developer site of clover. Redirect url is used to redirect the page where you get access token.
			-->
	           <a href="#" class="btn btn-block btn-success" style="text-align: center;">Authenticated<i class="fa fa-fw fa-plus-circle"></i></a>
	        </div>
	     </div>
		<br>
		<div class="row">
			<div class="col-md-offset-3 col-md-6 ">
				<div class="panel panel-info">
					 <div class="panel-heading"><b><center style="font-size: 18px;">Your Clover Detail</center></b></div>
					 <table class="table table-striped">
						<tr><td>Merchant id:</td>
							<td>
							<?php
							echo $merchant_id;
							?>
							</td>
						</tr>
						<tr><td>Access Token:</td>
							<td>
							<?php 
							echo $access_token;
							?>
							</td>
						</tr>
					</table>
				</div>
				<center><a href="token.php"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Do Another Authorization</a></center>
			</div>
		</div>
		<?php
			}
			else{
		?>
			<div class="row">
	            <div class="col-md-4 col-md-offset-4">
				<!-- 
				For authorization here we are using url of sandbox with client id and redirect url. We will client id from developer site of clover. Redirect url is used to redirect the page where you get access token.
				-->
	               <a href="https://sandbox.dev.clover.com/oauth/authorize?client_id=4MCB083YEENNR&redirect_uri=http://demo.constacloud.co.in/CC110011/clover/token.php" class="btn btn-block btn-primary" style="text-align: center;">Make Clover Authorization<i class="fa fa-fw fa-plus-circle"></i></a>
	            </div>
	         </div>
		<?php
			}
		?>
	    </div>
	  
	  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
   </body>
</html>