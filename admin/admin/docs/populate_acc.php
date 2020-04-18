<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 20/09/18
 * Time: 9:32 AM
 */
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

        ADMIN :: Populate

    </title>

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

    <link href="assets/css/toolkit-inverse.css" rel="stylesheet">


    <link href="assets/css/application.css" rel="stylesheet">

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
    </style>
</head>


<body>
<div class="row p-3">
    <?php
    include"header.php"
    ?>

    <div class="col-sm-9 content">
        <?php

        include("head.php");
        ?>

        <hr class="mt-1">
        <div class="statcard rounded w-50 mx-auto" style="border: 1px solid grey;">
            <div class="p-3">
                <div>
                    <span class="statcard-desc">Populate Account</span>
                    <span class="statcard-desc float-right">Populate Account</span>

                </div>

                <hr class="statcard-hr mb-0">
                
                <div class="form-group">
                    <span>Email of the user</span>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <span>Amount</span>
                    <input type="number" class="form-control" min="0">
                </div>
                <div class="form-group">
                    <input type="submit" value="Populate" class="btn btn-success btn-block mt-5" name="populateBtn">
                </div>
            </div>
        </div>



    </div>
</div>

<hr class="mt-5">



<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/tether.min.js"></script>
<script src="assets/js/chart.js"></script>
<script src="assets/js/tablesorter.min.js"></script>
<script src="assets/js/toolkit.js"></script>
<script src="assets/js/application.js"></script>
<script>
    // execute/clear BS loaders for docs
    $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
</script>
</body>
</html>
