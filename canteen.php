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
            padding: 0;
            margin: 0;

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
    <?php
    include "side-panel.php";
    ?>
    <div class="col-md-10 content">
        <?php
        include "header_dash.php"
        ?>

        <hr class="mt-3">
    <div>
        <div class="container-fluid mt-4">
            <div class="card" style="height: 600px;overflow-x: scroll">
                <div class="card-header bg-primary" style="height: 50px;">
                    <h5 class="text-white text-center">Orders</h5>
                </div>
                <div class="card-body p-3">
                    <table class="table table-sm table-hover">
                        <tr class="thead-dark">
                            <th>Date</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th> Bill</th>
                        </tr>
                        
                        <?php
                        $result = mysqli_query($link,"select reg_num from table_user_edupay where u_id = $session");
                        $rowFetched = mysqli_fetch_assoc($result);
                        $reg = $rowFetched["reg_num"];
                        $totalBalance=0;


                        $result = mysqli_query($link, "select * from table_orders where reg_num = '$reg'");
                            if(mysqli_num_rows($result) != 0){
                                while ($rowFetched = mysqli_fetch_assoc($result)) {
                                    
                                    ?>
                                    <tr style="border-bottom:1px solid black">
                                        <td><?php echo $rowFetched["order_date"] ?></td>
                                        <td><?php
//                                                echo $rowFetched["stock_id"];
                                                $item = explode(",", $rowFetched["stock_id"]);
                                                for($i = 0; $i < count($item)-1; $i++) {
                                                    $item[$i] = (int)$item[$i];
                                                    $query = "select item_name from table_stock where stock_id = $item[$i]";
                                                    $res = mysqli_query($link, $query);
                                                    $row = mysqli_fetch_assoc($res);
                                                    echo $row["item_name"]."<hr>";
                                                }
                
                
                                            ?></td>
                                        <td><?php
                                                $item = explode(",", $rowFetched["quantity"]);
                                                for($i = 0; $i < count($item)-1; $i++) {
                                                    echo (int)$item[$i]."<hr>";
                                                    
                                                    }
                
                                            ?></td>
                                        <td><?php
                                                $item = explode(",", $rowFetched["price"]);
                                                $sum = 0;
                                                for ($i = 0; $i < count($item)-1; $i++) {
                                                    echo (int)$item[$i]."<hr>";
                                                    $sum += (int)$item[$i];
                                                    
                                                }
                    
                                            ?>
                                            <?php
                                                include ("grand_total.php");
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $grandTotal,"/-<hr>";
                                                $totalBalance+=$grandTotal;
                                            ?>
                                        </td>
                                        
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <form action="bill.php">
                                                        <input type="hidden" name="hidden_btn" value="<?php echo $rowFetched["order_num"]; ?>">
<!--                                                        <a href="bill.php?orderNum=--><?php //echo $rowFetched["order_num"]; ?><!--">View Bill</a>-->
                                                        <input type="submit" value="Get Bill" class="btn btn-primary text-white" name="bill_btn">
<!--                                                        <hr>-->
                                                    </form>
                                                </div>
                                                <div class="col-sm-6">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                                } else {
                                echo "<div class='alert alert-info'><h4>No Orders Yet</h4></div>";
                            }
                            
                        ?>
                    </table>
                    
                </div>
                
            </div>
            <div class=""><?php

                    echo "<h3> Total Balance is "."Rs ".$totalBalance."/-"."</h3>";
                                                
                    ?></div>
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
