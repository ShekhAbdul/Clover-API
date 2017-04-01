<?php
/*-----
Here we retrieving all inventory data for particular clover merchant of sandbox environment. 
To fetch inventory from production environment you have to change this url to -"https://api.clover.com/" from "https://apisandbox.dev.clover.com/". 

You have to pass merchant id from which merchant you want fetch data and access token of that merchant which will be passed in curl header.
1) merchant id- e.g "RN2XHHV9PA0BC" ,I passed it in URL. 
2) access token-e.g "a5ca8577-d126-7689-6965-9104b5b7668c" , I passed it in authorization header.
------*/


function get_inventory($merchant_id,$access_token)
{
  $curl=curl_init('https://apisandbox.dev.clover.com/v3/merchants/'.$merchant_id.'/items');

  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    
     "Authorization:Bearer ".$access_token
  )
  );

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $auth = curl_exec($curl);
  $info = curl_getinfo($curl);
  return json_decode($auth);	
}


/*After submiting form this code will execute*/

if(isset($_POST['submit']))
{

  $merchant_id=$_POST['merchant_id'];
  $access_token=$_POST['access_token'];
  /*calling funtion here */
  $result=get_inventory($merchant_id,$access_token);

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
        <br><br>
        <div class="container">
            <div class="row">
            		<div class="col-md-offset-2 col-md-8 ">
              		<div class="panel panel-info">
                		<div class="panel-heading"><b><center style="font-size: 18px;">Inventory Detail</center></b></div>
                		<br>
                    <form class="form-horizontal" method="POST" action="">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Merchant Id</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" placeholder="Merchant Id" name="merchant_id">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Access Token</label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" placeholder="Access Token" name="access_token">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-10">
                          <button type="submit" class="btn btn-default" name="submit">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>  
                </div> 
            </div> 

            <?php
              if(isset($_POST['submit'])){

                echo"<pre>";
                print_r($result);
              }
            ?>  
        </div> 
           
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
   </body>
</html>	