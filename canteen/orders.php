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
        .card-header{
            background: #5895BE;
            color: white;
        }
        .card-body {
            /*background-color:#effdfd ;*/
        }
    </style>
</head>


<body>
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

	<div class="container-fluid">


        <input type="button" id="btn" class="btn btn-primary float-right" onclick="myfunc()" value="Print" />

		<div class="row">
			<div class="col-md-12">

				<br/>
                <div class="statcard " style="height: 600px;overflow-x: scroll;>
                    <div class="p-3">
                        <span class="statcard-desc">Orders</span>
                        <span class="statcard-desc" style="margin-left: 40%;">Orders</span>
                        <span class="statcard-desc float-right">Orders</span>
                        <hr class="statcard-hr mb-0">
                        <?php
                        $regnum=$_GET["regno"];
                        include "../include/db_config.php";
                        $resultset=mysqli_query($link,"select * from table_orders where reg_num='$regnum'");
                        if(mysqli_num_rows($resultset) > 0)
                        {
                            $total=0;
                            while($row= mysqli_fetch_assoc($resultset))
                            {
                                $grand_total=0;
                                echo "<br/><div class='card'>";
                                echo "<div class='card-header'>Order Number : ".$row["order_num"]."#   <span style='float:right'>Order Date : ".$row["order_date"]."</span></div>";
                                echo "<div class='card-body'>";
                                $stockid= explode(",",$row["stock_id"]);
                                $wclass= explode(",",$row["weight_class"]);
                                $price= explode(",",$row["price"]);
                                $quantity= explode(",",$row["quantity"]);
                                echo '<table class="table table-hover table-sm">';
                                echo "<tr style='font-weight:bold'>
										<td>Items</td>
										<td>Weight Class</td>
										<td>Quantity</td>
										<td>Price</td>
										<td>Total</td>
										</tr>";
                                for($i=0;$i<count($stockid)-1;$i++)
                                {
                                    $Proddata=mysqli_query($link,"select item_name from table_stock where stock_id='$stockid[$i]'");
                                    $prodrow=mysqli_fetch_assoc($Proddata);
                                    $grand_total+=(int)$price[$i]*(int)$quantity[$i];
                                    ?>

                                    <tr>
                                        <td><?php echo $prodrow["item_name"] ?></td>
                                        <td><?php echo $wclass[$i] ?></td>
                                        <td><?php echo (int)$quantity[$i] ?></td>
                                        <td><?php echo $price[$i] ?></td>
                                        <td><?php echo (int)$price[$i]*(int)$quantity[$i] ?></td>

                                    </tr>


                                    <?php

                                }
                                echo '</table>';
                                echo "<h4>Grand Total : ".$grand_total."/-</h4>";
                                $total+=$grand_total;
                                $debit = 0;
                                $result = mysqli_query($link,"select u_id from table_user_edupay where reg_num = '$regnum'");
                                $rowFetched = mysqli_fetch_assoc($result);
                                $userId = $rowFetched["u_id"];
                                $result = mysqli_query($link,"select debit from table_transaction where payee = 'canteen' and u_id = '$userId'");
                                while($rowFetched = mysqli_fetch_assoc($result)){
                                    $debit += $rowFetched["debit"];
                                }
//                                    $total = $total - $debit;
                                echo "</div>";

                                echo "</div>";
                            }

                            echo "<h4 style='padding:10px; display: block;width: 170px;' class=' text-danger'>Total : ".($total - $debit)."/-</h4>";
                            echo "<h4 style='padding:10px;display: block;width: 170px;float:right;margin-top: -50px;' class=' text-success'>Paid : ".($debit)."/-</h4>";



                        }
                        else
                        {
                            echo "<h1>No Records Found..!!</h1>";
                        }
                        ?>


            </div>
                </div>
		</div>
	</div>
</div>

    <hr class="mt-5">

    <script>

        function myfunc(){
            document.getElementById('btn').remove();
            print();
        }
    </script>



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
<script>
    $(".card-body").slideUp(0);
    $(".card-body").first().slideDown(0);
    $(".card-header").click(function(){
        $(this).siblings(".card-body").slideToggle();
    });
</script>
</body>
</html>
</html>
