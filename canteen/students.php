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

        .card-header{
            background: #5895BE;
            height: 38px;
            color: white;
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
		<div class="row" style="padding: 20px;">

			<div class="col-md-6">
                <div class="statcard" style="border: 1px solid grey; border-radius:5px ;">
                    <div class="p-3">
                        <span class="statcard-desc">Search By Registration Number</span>
                        <hr class="statcard-hr mb-0">
                        <form method="post" class="sidebar-form">
                            <input type="text" name="txtreg" placeholder="University Registered Number" class="form-control">
                            <button type="submit" class="btn-link bg-success rounded" name="btnregno">
                                <span class="icon icon-magnifying-glass text-white"></span>
                            </button>
                        </form>
                    </div>
                </div>
			</div>

			<div class="col-md-6">
                <div class="statcard" style="border: 1px solid grey; border-radius:5px ;">
                    <div class="p-3">
                        <span class="statcard-desc">Search By Student's Name</span>
                        <hr class="statcard-hr mb-0">
                        <form method="post" class="sidebar-form">
                            <input type="text" name="txtname" placeholder="Enter any part of the name" class="form-control">
                            <button type="submit" class="btn-link bg-success rounded" name="btnname">
                                <span class="icon icon-magnifying-glass text-white"></span>
                            </button>
                        </form>
                    </div>
                </div>
			</div>


		</div>

		<?php
			include "../include/db_config.php";

			$resultset="";
			error_reporting(0);
			if(isset($_POST["btnregno"]))
			{
					$reg=$_POST["txtreg"];
					$query="select * from table_user_edupay where reg_num='$reg'";
					$resultset=mysqli_query($link,$query);

			}
			else if(isset($_POST["btnname"]))
			{
				$name=$_POST["txtname"];
				$query="select * from table_user_edupay where name like '%$name%'";
					$resultset=mysqli_query($link,$query);

			}

		?>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
						<div class="card-header">
								<h5>Student Details</h5>
						</div>

						<div class="card-body" style="text-transform: capitalize;">
							<table class="table table-stripped table-hover table-bordered">
								<tr class="thead-dark">
									<th>Registration Number</th>
									<th>Student Name</th>
									<th>Course</th>
									<th>Semester</th>
									<th>Gender</th>
									<th>Action</th>
								</tr>
								<?php

									while($row= mysqli_fetch_assoc($resultset))
									{ ?>

											<tr>
												<td><?php echo $row["reg_num"] ?></td>
												<td><?php echo $row["name"] ?></td>
												<td><?php echo $row["course"] ?></td>
												<td><?php echo $row["semester"] ?></td>
												<td><?php echo $row["gender"] ?></td>
												<td>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <a href="sell.php?regno=<?php echo $row["reg_num"] ?>" class="btn btn-primary btn-block">Sell </a>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <a href="orders.php?regno=<?php echo $row["reg_num"] ?>" class="btn btn-success btn-block">View Orders</a>
                                                        </div>
                                                    </div>

												</td>
											</tr>

									<?php	}
								?>
							</table>
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