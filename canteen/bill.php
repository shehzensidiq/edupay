<?php
session_start();
include "../include/db_config.php";
$id = $_SESSION["auth_user"];
$result = mysqli_query($link,"select * from table_canteen_admin where canteen_id = $id");
$rowFetched = mysqli_fetch_assoc($result);
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

        Canteen :: Dashboard

    </title>

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

    <link href="../admin/admin/docs/assets/css/toolkit-light.css" rel="stylesheet">


    <link href="../admin/admin/docs/assets/css/application.css" rel="stylesheet">

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

        #bill #bill-form .cardbody .sr-no {
            width: 5%;
            float: left; }
        #bill #bill-form .cardbody .columns {
            width: 30%;
            float: left;
            /*border-right: 1px solid grey;*/
        }
        #bill #bill-form .cardbody .heading {
            width: 100%;
            height: 40px;
            /*background-color: #5895be;*/
            padding: 10px;
        }
        #bill #bill-form .cardbody .quantity {
            width: 19%;
            float: left;
            /*border-right: 1px solid grey; */
        }
        #bill #bill-form .cardbody .quantity .heading {
            width: 100%; }
    </style>
</head>


<body id="bill">
<!--   <div class="container"> -->
<div class="row p-3">
    <?php
    include "side.php";
    ?>
    <div class="col-md-10 content">
        <?php
        include "header.php"
        ?>

        <hr class="mt-3">
<div class="row" style="height: 680px;overflow-x:scroll;">
    <div class="col">
        <button class="btn btn-primary float-right" onclick="print()">Print The Bill</button>

        <div class="container-fluid mt-5">
            <?php
            $regNum = $_SESSION["reg_num"];
            $orderNumber = $_SESSION["order_num"];
            //                    echo $orderNumber;
            $count = 1;
            $result = mysqli_query($link, "select * from table_orders where order_num = $orderNumber");
            $rowFetched = mysqli_fetch_assoc($result);
            $regNum = $rowFetched["reg_num"];
            $userDetails = mysqli_query($link, "select name,course,semester from table_user_edupay where reg_num = '$regNum'");
            $userFetched = mysqli_fetch_assoc($userDetails);

            ?>
            <br>
            <div class="statcard" id="bill-form" style="border:1px solid grey;border-radius: 5px">
                <div class="p-3">
                    <h5>
                        <span class="statcard-desc text-gray-dark">Bill For The Purchase Of Order Number <?php echo $rowFetched["order_num"]; ?></span>

                    </h5>
                    <hr class="statcard-hr mb-0">
                    <span class="text-capitalize p-2  float-left" style="display: block;width: 250px; border-right:1px solid black">Name:- <?php echo $userFetched["name"]; ?></span>
                    <span class="text-capitalize p-2  float-left" style="display: block;width: 250px; border-right:1px solid black">Course:- <?php echo $userFetched["course"]; ?></span>
                    <span class="text-capitalize p-2 float-left" style="display: block;width: 250px; border-right:1px solid black">Semester:- <?php echo $userFetched["semester"]; ?></span>
                    <span class="text-capitalize p-2 float-left" style="display: block;width: 250px;">Order date:- <?php echo $rowFetched["order_date"]; ?></span>

                    <hr class="statcard-hr mb-3 mt-5">
                    <div class="cardbody">
                        <div class="columns">
                            <div class="heading ">
                                Particulars
                            </div>
                            <div style="padding: 30px;">
                                <?php
                                $item = $rowFetched["stock_id"];
                                $singleItems = explode(",", $item);
                                for ($i = 0; $i < sizeof($singleItems)-1; $i++) {
                                    $singleItems[$i]=(int)$singleItems[$i];
                                    $res = mysqli_query($link, "select item_name from table_stock where stock_id = $singleItems[$i]");
                                    $row = mysqli_fetch_assoc($res);
                                    echo $count." ".$row["item_name"]."<hr>";
                                    $count++;

                                }
                                ?>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="heading ">
                                Price in Rs
                            </div>
                            <div style="padding: 30px;">
                                <?php
                                $price = $rowFetched["price"];
                                $total = 0;
                                $priceExploded = explode(",",$price);
                                for ($i = 0; $i < sizeof($priceExploded)-1; $i++) {
                                    $priceExploded[$i]=(int)$priceExploded[$i];
                                    echo $priceExploded[$i],"<hr>";
                                }

                                ?>
                            </div>

                        </div>
                        <div class="quantity">
                            <div>
                                <div class="heading">
                                    <h6 class="" >Quantity</h6>
                                </div>

                            </div>
                            <div style="padding: 30px;">
                                <?php
                                $quantity = $rowFetched["quantity"];
                                $wclass = $rowFetched["weight_class"];
                                $wclassExploded = explode(",", $wclass);
                                $quantityExploded = explode(",",$quantity);
                                for ($i = 0; $i < sizeof($quantityExploded)-1; $i++) {
                                    $quantityExploded[$i]=(int)$quantityExploded[$i];
                                    echo $quantityExploded[$i]." - ",$wclassExploded[$i],"<hr>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="quantity">
                            <div>
                                <div class="heading">
                                    <h6 class="text-centers">Total in Rs</h6>
                                </div>
                            </div>
                            <div style="padding: 30px;">
                                <?php
                                $quantity = $rowFetched["quantity"];
                                $grandTotal = 0;
                                $quantityExploded = explode(",",$quantity);
                                $price = $rowFetched["price"];
                                $total = 0;
                                $priceExploded = explode(",",$price);
                                for ($i = 0; $i < sizeof($quantityExploded)-1; $i++) {
                                    $quantityExploded[$i]=(int)$quantityExploded[$i];
                                    $priceExploded[$i]=(int)$priceExploded[$i];
                                    $total = $priceExploded[$i]*$quantityExploded[$i];
                                    echo $total,"<hr>";
                                    $grandTotal += $total;

                                }

                                ?>
                            </div>

                        </div>
                    </div>



                </div>
                <div class="statcard p-4">
                    <?php
                    echo "<h5 class='text-danger'>The Grand Total Is :  Rs ",$grandTotal,"<h5>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

<hr class="mt-5">

<!-- </div> -->


<script src="../admin/admin/docs/assets/js/jquery.min.js"></script>
<script src="../admin/admin/docs/assets/js/tether.min.js"></script>
<script src="../admin/admin/docs/assets/js/chart.js"></script>
<script src="../admin/admin/docs/assets/js/tablesorter.min.js"></script>
<script src="../admin/admin/docs/assets/js/toolkit.js"></script>
<script src="../admin/admin/docs/assets/js/application.js"></script>
<script>
    // execute/clear BS loaders for docs
    $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
</script>
</body>
</html>
</html>
