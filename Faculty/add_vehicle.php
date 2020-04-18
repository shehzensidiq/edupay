<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 01/07/18
 * Time: 2:20 PM
 */
session_start();
include ("../include/db_config.php");

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

        TRANSPORT :: Dashboard

    </title>

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

    <link href="../admin/admin/docs/assets/css/toolkit-inverse.css" rel="stylesheet">


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
        }
        li:hover {
            background-color: #4496C2;
            border-radius:5px;
        }
        li {
            margin-top: 15px;
        }
        textarea{
            resize: none;
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

        include("header_faculty.php");
        ?>

        <hr class="mt-1">
<div class="row">
    <div class="col" id="add-vehicle-form">
        <div class="statcard w-75 mx-auto">
            <div class="p-3">
                <span class="statcard-desc">Add Vehicle</span>
                <span class="statcard-desc float-right">Add Vehicle</span>

                <hr class="statcard-hr mb-0">
            </div>
        </div>

        <div class="card mx-auto w-75" style="background: #25282f;border: 1px solid grey;">
            <div class="card-body p-3">

                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Enter The Route Number </label>
                                <div class="input-group">
                                    <input type="number" min="0" class="form-control" name="route_number" required placeholder="Route Number">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-road" aria-hidden="true"></i>
                                        </span>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Enter The Registration Number </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="reg_number" required placeholder="Registration Number">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-id-card" aria-hidden="true"></i>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Vehicle Type</label>
                                <div class="input-group">
                                    <select name="vehicle_type" id="" class="form-control">
                                        <option value="bus">Bus</option>
                                        <option value="mini_bus">Mini Bus</option>
                                        <option value="van">Van</option>
                                        <option value="traveller">Traveller</option>
                                    </select>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-bus" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Number of Seats </label>
                                <div class="input-group">
                                    <input type="number" min="0" class="form-control" name="seats" required placeholder="Number of seats">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <h5 class="text-center">Route</h5>
                                <textarea name="route" id="" cols="30" rows="3" class="form-control" placeholder="Enter The route"></textarea>
                                <span style="color: red;font-size: 10px"><sup>*</sup>The individual stops should be seperated by comma</span>

                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" value="submit" name="add_vehicle" class="btn btn-block btn-success">
                                Add Entered Vehicle
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <?php
        if (isset($_POST["add_vehicle"])){
        $route_num = $_POST["route_number"];
        $reg_num = $_POST["reg_number"];
        $type = $_POST["vehicle_type"];
        $seats = $_POST["seats"];
        $route= $_POST["route"];
         mysqli_query($link,"insert into table_vehicle(route_num,seats,reg_num,vehicle_type,route) value ($route_num,$seats,'$reg_num','$type','$route')");
         echo "<script>alert('Vehicle Has Been Added Successfully');</script>";
        }
    ?>



</div>

    </div>




        <hr class="mt-5">



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
