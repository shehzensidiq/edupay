<?php

include "../include/db_config.php";
if (isset($_POST["add_stock"])) {
    $date=$_POST["date"];
    $itemName=$_POST["item_name"];
    $quantity=$_POST["quantity"];
    $weightClass=$_POST["weight_class"];
    $category=$_POST["catagory"];
    $sellingPrice=$_POST["selling_price"];
    $costPrice=$_POST["cost_price"];
    $productNumber=$_POST["product_number"];
    mysqli_query($link, "insert into table_stock(product_num,item_name,quantity,weight_class,catagory,date,cost_price,selling_price) 
values ($productNumber,'$itemName',$quantity,'$weightClass','$category','$date',$costPrice,$sellingPrice)");
    echo "<script>alert('Stock has been Updated');</script>";
}
?>
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
		<div class="row">
            <div class="col-sm-4">
                    <div class="statcard" style="border: 1px solid grey;border-radius: 5px">
                        <div class="p-3">
                            <span class="statcard-desc">Add Stock</span>
                            <span class="statcard-desc float-right">Add Stock</span>
                            <hr class="statcard-hr mb-0">
                            <form action="" method="post">
                            <div class="row p-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="field" for="date">Date:</label>
                                        <input type="date" name="date" class="form-control" value="<?php echo date('y-m-d');?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="">Quantity:</label>
                                        <input type="number" name="quantity" class="form-control" placeholder="quantity" min="0">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Item Name:</label>
                                        <input type="text" name="item_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product Number:</label>
                                        <input type="number" name="product_number" class="form-control" min="0">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Selling Price:</label>
                                        <input type="number" name="selling_price" class="form-control" min="0">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Cost Price:</label>
                                        <input type="number" name="cost_price" class="form-control" min="0">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-control">
                                        <label for="">Catagory</label>
                                        <select name="catagory" class="form-control">
                                            <option>Fried Items</option>
                                            <option>Beverages</option>
                                            <option>Chips</option>
                                            <option>Fast Food</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-control">
                                        <label for="">weight class</label>
                                        <select name="weight_class" class="form-control">
                                            <option>No.</option>
                                            <option>Grams</option>
                                            <option>Pounds</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <input type="submit" value="Add Stock" name="add_stock" class="btn btn-block btn-primary mt-3">

                                </div>
                            </div>
                            </form>

                        </div>
                    </div>
            </div>
            <div class="col-sm-8">
                <div class="container">
                    <table class="table table-bordered table-striped table-hover mt-5">
                        <?php
                        $count=1;
                        $result=mysqli_query($link,"select * from table_stock order by item_name asc ")
                        ?>
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>S.No</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Selling Price</th>
                                <th>Cost Price</th>
                                <th>Catagory</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($rowFetched = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $rowFetched["item_name"] ?></td>
                                <td><?php echo $rowFetched["quantity"] ?></td>
                                <td><?php echo $rowFetched["selling_price"] ?></td>
                                <td><?php echo $rowFetched["cost_price"] ?></td>
                                <td><?php echo $rowFetched["catagory"] ?></td>
                            </tr>
                            <?php
                            $count+=1;

                        }
                        ?>
                        </tbody>
                    </table>
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