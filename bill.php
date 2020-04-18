
<?php
session_start();
$session = $_SESSION["auth_user"];
include "include/db_config.php";

?>


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

        .dropdown-menu :hover> button  {
            background-color: #4496C2;
            color: white;
        }
    </style>
</head>


<body>
<!--   <div class="container"> -->
<div class="row p-3">
<div class="row" style="height: 680px;">

    <div class="col">
        <button class="btn btn-primary mt-2 ml-3 mb-0" onclick="print()" id="print">Print Bill</button>


        <div class="container-fluid mt-5">
            <div class="card rounded" id="bill-form">
                <?php
if (isset($_GET["bill_btn"])) {
	$orderNumber = $_GET["hidden_btn"];
	$count = 1;
	$result = mysqli_query($link, "select * from table_orders where order_num = $orderNumber");
	$rowFetched = mysqli_fetch_assoc($result);
	$regNum = $rowFetched["reg_num"];
	$userDetails = mysqli_query($link, "select name,course,semester from table_user_edupay where reg_num = '$regNum'");
	$userFetched = mysqli_fetch_assoc($userDetails);
}

//
?>
                <div class="card-header bg-primary" style="height: 35px;">
                    <h6 class="text-white">Order Number :  <?php echo $rowFetched["order_num"]; ?> #</h6>

                </div>
                <div>
                    <span class="text-capitalize p-1 float-left" style="display: block;width: 300px;">Name:- <?php echo $userFetched["name"]; ?></span>
                    <span class="text-capitalize p-1 float-left" style="display: block;width: 300px;">Course:- <?php echo $userFetched["course"]; ?></span>
                    <span class="text-capitalize p-1 float-left" style="display: block;width: 300px;">Semester:- <?php echo $userFetched["semester"]; ?></span>
                    <span class="text-capitalize p-1 float-left" style="display: block;width: 300px;">Order date:- <?php echo $rowFetched["order_date"]; ?></span>
                </div>
                <div class="card-body">
                    <div class="columns w-25" style="display:inline-block;">
                        <hr>
                        <div class="heading ">
                            <span class="ml-4">Particulars</span>
                        </div>
                        <hr>

                        <div style="padding: 30px;">
                            <?php
$item = $rowFetched["stock_id"];
//   echo $item;
$singleItems = explode(",", $item);
//  echo sizeof($singleItems);
for ($i = 0; $i < sizeof($singleItems) - 1; $i++) {
	//                                echo "<br>".$singleItems[$i]."<br>";
	$singleItems[$i] = (int) $singleItems[$i];
	$res = mysqli_query($link, "select item_name from table_stock where stock_id = $singleItems[$i]");
	$row = mysqli_fetch_assoc($res);
	echo $count . " " . $row["item_name"] . "<hr>";
	$count++;

	//      echo $singleItems[$i] +7;
	//      echo gettype($singleItems[$i]);
}
?>
                        </div>
                    </div>
                    <div class="columns w-25" style="display:inline-block;">
                        <hr>
                        <div class="heading ">
                            <span class="ml-4">Price in Rs</span>
                        </div>
                        <hr>
                        <div style="padding: 30px;">
                            <?php
$price = $rowFetched["price"];
$total = 0;
$priceExploded = explode(",", $price);
for ($i = 0; $i < sizeof($priceExploded) - 1; $i++) {
	$priceExploded[$i] = (int) $priceExploded[$i];
	echo $priceExploded[$i], "<hr>";
}

?>
                        </div>

                    </div>
                    <div class="quantity w-25" style="display:inline-block;">
                        <hr>
                        <div>
                            <div class="heading">
                                <h6 class="ml-4 " >Quantity</h6>
                            </div>
                            <hr>
                        </div>
                        <div style="padding: 30px;">
                            <?php
$quantity = $rowFetched["quantity"];
$wclass = $rowFetched["weight_class"];
$wclassExploded = explode(",", $wclass);
$quantityExploded = explode(",", $quantity);
for ($i = 0; $i < sizeof($quantityExploded) - 1; $i++) {
	$quantityExploded[$i] = (int) $quantityExploded[$i];
	echo $quantityExploded[$i] . " - ", $wclassExploded[$i], "<hr>";
}
?>
                        </div>
                    </div>
                    <div class="quantity" style="display:inline-block;width: 20%;">
                        <hr>
                        <div>
                            <div class="heading">
                                <h6 class=" ml-4">Total in Rs</h6>
                            </div>
                            <hr>
                        </div>
                        <div style="padding: 30px;">
                           <?php
include "grand_total.php";

?>
                        </div>

                    </div>
                    <div>

                    </div>
                </div>
                <div class="card-footer" style='background-color: #069;height: 40px;'>
                    <?php
echo "<h6 class='ml-1 text-white'>Grand Total  :  Rs ", $grandTotal, "/-<h6>";
?>

                </div>
            </div>
        </div>
    </div>
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
