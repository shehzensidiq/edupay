<?php
//my Allah
session_start();
$session = $_SESSION["auth_user"];

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

        LIBRARY :: Dashboard

    </title>

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

    <link href="../../admin/admin/docs/assets/css/toolkit-inverse.css" rel="stylesheet">


    <link href="../../admin/admin/docs/assets/css/application.css" rel="stylesheet">

    <style>
        /* note: this is a hack for ios iframe for bootstrap themes shopify page */
        /* this chunk of css is not part of the toolkit :) */
        body {
            width: 1px;
            min-width: 100%;
            *width: 100%;
            padding: 0;
            margin: 0;
        }
        li:hover {
            background-color: #4496C2;
            border-radius:5px;
        }
        li{
            margin-top: 20px;
        }
    </style>
</head>


<body>
<div class="row p-3">
    <?php
    include"side_panel.php"
    ?>

    <div class="col-sm-9 content">
        <?php

        include("library_header.php");
        ?>

        <hr class="mt-1">
        <?php


        $result = mysqli_query($link,"select b_id from table_book");
        $total_books = 0;
        $alloted = 0;
        $available_books= 0;
        while($rowFetched = mysqli_fetch_assoc($result))
        {
            $total_books ++;
        }
        $result = mysqli_query($link,"select * from table_alloted_books where status = 'alloted'");

        $alloted=0;
        while($rowFetched = mysqli_fetch_assoc($result))
        {
            $alloted ++;
        }
        $available_books = $total_books - $alloted;
        ?>
        <div class="row statcards">
            <div class="col-md-6 col-xl-3 mb-3 mb-md-4 mb-xl-0">
                <div class="statcard statcard-success">
                    <div class="p-3">
                        <span class="statcard-desc">Total no.of Books</span>
                        <h2 class="statcard-number">
                            <?php echo $total_books; ?>
                        </h2>
                        <hr class="statcard-hr mb-0">
                    </div>
                    <canvas id="sparkline1" width="378" height="94" class="sparkline"
                            data-chart="spark-line"
                            data-dataset="[[28,68,41,43,96,45,100]]"
                            data-labels="['a','b','c','d','e','f','g']"
                            style="width: 189px; height: 47px;">
                    </canvas>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-3 mb-md-4 mb-xl-0">
                <div class="statcard statcard-danger">
                    <div class="p-3">
                        <span class="statcard-desc">Total no.Alloted</span>
                        <h2 class="statcard-number">
                            <?php echo $alloted; ?>
                        </h2>
                        <hr class="statcard-hr mb-0">
                    </div>
                    <canvas id="sparkline1" width="378" height="94" class="sparkline"
                            data-chart="spark-line"
                            data-dataset="[[4,34,64,27,96,50,80]]"
                            data-labels="['a', 'b','c','d','e','f','g']"
                            style="width: 189px; height: 47px;"></canvas>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-3 mb-md-4 mb-xl-0">
                <div class="statcard statcard-info">
                    <div class="p-3">
                        <span class="statcard-desc">available books</span>
                        <h2 class="statcard-number">
                            <?php echo $available_books ?>
                        </h2>
                        <hr class="statcard-hr mb-0">
                    </div>
                    <canvas id="sparkline1" width="378" height="94" class="sparkline"
                            data-chart="spark-line"
                            data-dataset="[[12,38,32,60,36,54,68]]"
                            data-labels="['a', 'b','c','d','e','f','g']"
                            style="width: 189px; height: 47px;"></canvas>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-3 mb-md-4 mb-xl-0">
                <div class="statcard statcard-warning">
                    <div class="p-3">
                        <span class="statcard-desc">fine</span>
                        <h2 class="statcard-number">
                            xxxxx
                        </h2>
                        <hr class="statcard-hr mb-0">
                    </div>
                    <canvas id="sparkline1" width="378" height="94" class="sparkline"
                            data-chart="spark-line"
                            data-dataset="[[43,48,52,58,50,95,100]]"
                            data-labels="['a', 'b','c','d','e','f','g']"
                            style="width: 189px; height: 47px;"></canvas>
                </div>
            </div>
        </div>

            <hr class="mt-5">

    </div>




    <hr class="mt-5">



    <script src="../../admin/admin/docs/assets/js/jquery.min.js"></script>
    <script src="../../admin/admin/docs/assets/js/tether.min.js"></script>
    <script src="../../admin/admin/docs/assets/js/chart.js"></script>
    <script src="../../admin/admin/docs/assets/js/tablesorter.min.js"></script>
    <script src="../../admin/admin/docs/assets/js/toolkit.js"></script>
    <script src="../../admin/admin/docs/assets/js/application.js"></script>
    <script>
        // execute/clear BS loaders for docs
        $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
    </script>

</body>
</html>
