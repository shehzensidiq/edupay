<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 20/07/18
 * Time: 2:19 PM
 */
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
            margin: 0;
            padding: 0;

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
        <?php
        $result = mysqli_query($link,"select debit from table_transaction where payee = 'canteen'");
        $credit= 0;
        while($rowFetched = mysqli_fetch_assoc($result)) {
            $credit += $rowFetched["debit"];
        }

        ?>
        <div class="row statcards">
            <div class="col-md-6 col-xl-3 mb-3 mb-md-4 mb-xl-0">
                <div class="statcard statcard-success">
                    <div class="p-3">
                        <span class="statcard-desc">Total Credited</span>
                        <h2 class="statcard-number">&#8377;
                            <?php
                            echo $credit;
                            $_SESSION["balance"] = $credit;
                            ?>

                        </h2>
                        <hr class="statcard-hr mb-0">
                    </div>
                    <canvas id="sparkline1" width="378" height="94"
                            class="sparkline"
                            data-chart="spark-line"
                            data-dataset="[[28,68,41,43,96,45,100]]"
                            data-labels="['a','b','c','d','e','f','g']"
                            style="width: 189px; height: 47px;"></canvas>
                </div>
            </div>
            <?php
            $result = mysqli_query($link, "select amount from withdraw_request_table where request_from = 'canteen' and status = 'paid'");
            $balance = 0;
            while ($rowFetched = mysqli_fetch_assoc($result)) {
                $balance += $rowFetched["amount"];
            }
            //$_SESSION["balance"] = $balance;


            $total = 0;
            $out = 0;
            $orders = mysqli_query($link,"select * from table_orders");
            while ($ordersFetched = mysqli_fetch_assoc($orders)) {
                $quatity = $ordersFetched["quantity"];
                $price = $ordersFetched["price"];
                $quantityExplode = explode(",",$quatity);
                $priceExplode = explode(",",$price);
                for ($i = 0; $i < sizeof($quantityExplode)-1; $i++) {
                    $total += (int)$priceExplode[$i]*(int)$quantityExplode[$i];

                }
                $out = $total - $balance;

            }
            ?>
            <div class="col-md-6 col-xl-3 mb-3 mb-md-4 mb-xl-0">
                <div class="statcard statcard-danger">
                    <div class="p-3">
                        <span class="statcard-desc">Total Outstanding</span>
                        <h2 class="statcard-number">&#8377;
                            <?php
                            echo $out;
                            ?>

                        </h2>
                        <hr class="statcard-hr mb-0">
                    </div>
                    <canvas id="sparkline1" width="378" height="94"
                            class="sparkline"
                            data-chart="spark-line"
                            data-dataset="[[4,34,64,27,96,50,80]]"
                            data-labels="['a','b','c','d','e','f','g']"
                            style="width: 189px; height: 47px;"></canvas>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-3 mb-md-4 mb-xl-0">
                <div class="statcard statcard-info">
                    <div class="p-3">
                        <span class="statcard-desc">Withdrawn</span>
                        <h2 class="statcard-number">&#8377;
                            <?php
                            echo $balance;
                            ?>

                        </h2>
                        <hr class="statcard-hr mb-0">
                    </div>
                    <canvas id="sparkline1" width="378" height="94"
                            class="sparkline"
                            data-chart="spark-line"
                            data-dataset="[[12,38,32,60,36,54,68]]"
                            data-labels="['a','b','c','d','e','f','g']"
                            style="width: 189px; height: 47px;"></canvas>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-3 mb-md-4 mb-xl-0">
                <div class="statcard statcard-warning">
                    <div class="p-3">
                        <span class="statcard-desc">Downloads</span>
                        <h2 class="statcard-number">
                            758
                            <small class="delta-indicator delta-negative">1.3%</small>
                        </h2>
                        <hr class="statcard-hr mb-0">
                    </div>
                    <canvas id="sparkline1" width="378" height="94" class="sparkline"
                            data-chart="spark-line"
                            data-dataset="[[43,48,52,58,50,95,100]]"
                            data-labels="['a','b','c','d','e','f','g']"
                            style="width: 189px; height: 47px;"></canvas>
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
