<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 17/09/18
 * Time: 2:03 PM
 */
?>


<?php
session_start();
$session = $_SESSION["auth_user"];
include '../../include/db_config.php';
error_reporting(0);


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

        All issued Books

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
            margin: 0;
            padding: 0;
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

    <div class="col-sm-9">
        <?php

        include("library_header.php");
        ?>

        <hr class="mt-1">
        <div style="width: 220px; float: right">
            <form action="">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <select name="filterBooks" id="" class="form-control">
                                <option value="Select">Select</option>
                                <option value="alloted">Outstanding</option>
                                <option value="returned">Returned</option>
                                <option value="all">All History</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-grouo">
                            <input type="submit" value="Apply" class="btn btn-primary" name="filterBtn">

                        </div>

                    </div>
                </div>

            </form>
        </div>
        <div style="width: 10px; height: 50px;"></div>
        <hr class="mt-1">



    <div class="card" style="background-color: #25282F;">
        <div class="mb-4">
            <span class="statcard-desc float-left" style="display: inline-block">Library Books History</span>
            <span class="statcard-desc float-right" style="display: inline-block;">Library Books History</span>
        </div>
        <table class="table table-bordered table-hover text-capitalize text-white">
            <tr>
                <th>S.No</th>
                <th>Issued To</th>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Author</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Status</th>
            </tr>
            <?php
            $sNo = 1;
            $query = "";
            if(isset($_GET["filterBtn"])){
                $filter = $_GET["filterBooks"];
                if($filter == 'returned'){
                    $query = "select * from table_book tb join table_alloted_books ta on tb.book_id = ta.book_id where ta.status = 'returned' order by tb.book_name ASC";
                    echo "<h6 class='text-capitalize text-success'>$filter</h6>";

                } else if($filter == 'alloted'){
                    $query = "select * from table_book tb join table_alloted_books ta on tb.book_id = ta.book_id where ta.status = 'alloted' order by tb.book_name ASC";
                    echo "<h6 class='text-capitalize text-danger'>$filter Not Returned</h6>";


                } else if($filter == 'all'){
                    $query = "select * from table_book tb join table_alloted_books ta on tb.book_id = ta.book_id order by ta.status ASC";
                    echo "<h6 class='text-capitalize text-info'>$filter History</h6>";


                }

            } else {
                $query = "select * from table_book tb join table_alloted_books ta on tb.book_id = ta.book_id  order by ta.status ASC";
                echo "<h6 class='text-capitalize text-info'>All  History</h6>";


            }
            $result = mysqli_query($link,$query);

            if (mysqli_num_rows($result) != 0) {

                while($rowFetched = mysqli_fetch_assoc($result))

                {
                    $userId = $rowFetched["reg_num"];
                    $details = mysqli_query($link,"select name from table_user_edupay where reg_num = '$userId'");
                    $detailsFetched = mysqli_fetch_assoc($details);

                    ?>
                    <tr>
                        <td><?php echo $sNo; ?></td>
                        <td><?php echo $detailsFetched["name"] ?></td>
                        <td><?php echo $rowFetched["book_id"] ?></td>
                        <td><?php echo $rowFetched["book_name"] ?></td>
                        <td><?php echo $rowFetched["author"] ?></td>
                        <td><?php echo $rowFetched["alloted_date"] ?></td>
                        <td><?php echo $rowFetched["return_date"] ?></td>
                        <td><?php if($rowFetched["status"] == 'alloted'){
                                echo $rowFetched["status"]."/"."Not returned Yet";
                            } else {
                                echo $rowFetched["status"];
                            } ?></td>

                    </tr>
                    <?php
                    $sNo++;
                }
            } else {
                echo "<h1>No book Issued Yet</h1>";
            }
            ?>


        </table>
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
