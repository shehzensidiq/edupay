<?php
session_start();
include "../../include/db_config.php";
if (isset($_POST["add_book"])) {
    $book_name = $_POST["book_name"];
    $book_id = $_POST["book_id"];
    $book_no = $_POST["book_no"];
    $author = $_POST["book_author"];
    $book_type = $_POST["book_type"];
    mysqli_query($link, "insert into table_book(date,book_name,book_id,book_number,book_type,author) values(NOW(),'$book_name','$book_id',$book_no,'$book_type','$author')");
    echo "<script>alert('book has been added successfully');</script>";
}
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

    <div class="col-sm-9 content">
        <?php

        include("library_header.php");
        ?>

        <hr class="mt-1">
<div class="row">
    <div class="col-sm-5">
        <div class="statcard">
            <div class="p-3">
                <span class="statcard-desc">Add Book</span>
                <span class="statcard-desc float-right">Add Book</span>
                <hr class="statcard-hr mb-0">
            </div>
        </div>

        <form action="" method="post">
                <div class="card">
                    <div class="card-body p-3 " style="background:#25282f;">
                         <div class="row">
                            <div class="col">
                               <div class="form-group">
                                    <label class="">Book Number</label>
                                    <input type="number" name="book_no" class="form-control" placeholder="book number" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                               <div class="form-group">
                                   <label>Book Name</label>
                                   <input type="text" name="book_name" placeholder="book name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Book ID</label>
                                   <input type="number" name="book_id" placeholder="book id" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                   <label>Book Author</label>
                                    <input type="text" name="book_author" placeholder="book author" class="form-control" min="0">
                                </div>
                            </div>
                             <div class="col-sm-6">
                                 <label for="">Book Cadre</label>
                                 <div class="form-control">
                                  <select name="book_type" class="form-control">
	                                   	<option>science</option>
	                                     <option>literature</option>
	                                     <option>history</option>
	                                      <option>medicine</option>
                                   </select>
                            	</div>
                        	</div>
                  		</div>
                        <div class="row mt-3">
                           <div class="col">
                               <input type="submit" value="Add Book" name="add_book" class="btn btn-block btn-success">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
    <div class="col-sm-7">
	        <h4>Book Details</h4>
            <table class="table table-bordered  table-hover mt-3">
                        <?php
                        $count = 1;
                        $result = mysqli_query($link, "select * from table_book");
                        ?>
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Book Name</th>
                                <th>Book Id</th>
                                <th>Book Number</th>
                                <th>Author</th>
                                <th>Cadre</th>
                                <th>Available</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($rowFetched = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $rowFetched["book_name"] ?></td>
                                <td><?php echo $rowFetched["book_id"] ?></td>
                                <td><?php echo $rowFetched["book_number"] ?></td>
                                <td><?php echo $rowFetched["author"] ?></td>
                                <td><?php echo $rowFetched["book_type"] ?></td>
                                <td><?php echo $rowFetched["available"] ?></td>
                            </tr>
                            <?php
                            $count += 1;
                        }
                        ?>
                        </tbody>
                    </table>

    </div>
</div>
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
