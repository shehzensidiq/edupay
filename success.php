
    
    <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>

        Student :: Dashboard

    </title>

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

      <link href="admin/admin/docs/assets/css/toolkit-light.css" rel="stylesheet">


    <link href="admin/admin/docs/assets/css/application.css" rel="stylesheet">

    <style>
      /* note: this is a hack for ios iframe for bootstrap themes shopify page */
      /* this chunk of css is not part of the toolkit :) */
      body {
        width: 1px;
        min-width: 100%;
        *width: 100%;

        /*background-color: #effdfd;*/
      }
        li {
            border-radius: 5px;
            margin-top: 20px;
            font-size: 15px;
            padding-left: 10px;
            /*text-align: center;*/
            background-color:#4496C2;
        }
      li:hover{
          /*background-color: #4496C2;*/
          border-radius:5px;
          /*color: white;*/
      }

        .dropdown-menu :hover> button {
            background-color: #4496C2;
            color: white;
        }
        .card-body {
            background-color:#effdfd ;
        }
    </style>
  </head>


<body>
<?php
	session_start();
require "include/db_config.php";
?>
<!--   <div class="container"> -->
    <div class="row p-3">
        <?php
        include "side-panel.php";
        ?>
      <div class="col-md-10 content">
          <?php
          include "header_dash.php"
          ?>

<hr class="mt-3">
<?php

$key = "sheh_wase-nyla_yasm-";

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$mytxnid=$_COOKIE["txncook"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       
     
      
       	//include "header_dash.php";
           mysqli_query($link,"update table_transaction set payment_status = 'confirmed' where txn_id = '$mytxnid'");
          echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Administrator Will Approve Your Payment Soon.!!</h4>";
          $to = $_SESSION["email"];
          $sub = "Payment Successful";
          $body = "The Amount Of ".$amount." Has been Paid.Your Transaction id is ". $txnid." Thank You! It will Shortly be added to your account.";
          mail($to,$sub,$body);
          $result = mysqli_query($link,"select email from table_admin_edupay");
          $rowFetched = mysqli_fetch_assoc($result);
          $adminEmail = openssl_decrypt($rowFetched["email"],'AES-256-ECB', $key, '0', '');
          $adminBody = "The Amount Of ".$amount." Has been Paid by the user with email: ".$to." With Transaction id ". $txnid;
          mail($adminEmail,$sub,$adminBody);
          
?>


</div>
          </div>

<hr class="mt-5">

<!-- </div> -->


    <script src="admin/admin/docs/assets/js/jquery.min.js"></script>
    <script src="admin/admin/docs/assets/js/tether.min.js"></script>
    <script src="admin/admin/docs/assets/js/chart.js"></script>
    <script src="admin/admin/docs/assets/js/tablesorter.min.js"></script>
    <script src="admin/admin/docs/assets/js/toolkit.js"></script>
    <script src="admin/admin/docs/assets/js/application.js"></script>
    <script>
      // execute/clear BS loaders for docs
      $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
    </script>
  </body>
</html>
	