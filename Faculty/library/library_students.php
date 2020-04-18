<?php
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
        .card-body{
            background-color: #25282f;
            padding: 10px;
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

			<div class="col-md-6">

					<div class="card search">


						<div class="card-body">
							<form method="post">
									<span>Enter Registration Number</span>
									<input type="text" name="txtreg" placeholder="University Registered Number" class="form-control">
								 <br/><input type="submit" name="btnregno" value="Search Filter" class="btn btn-info form-control"  />
							</form>
						</div>
					</div>
			</div>

			<div class="col-md-6">

					<div class="card search">

						<div class="card-body">
							<form method="post">
									<span>Enter Name</span>
									<input type="text" name="txtname" placeholder="Enter any part of the name" class="form-control">
								 <br/><input type="submit" name="btnname" value="Search Filter" class="btn btn-info form-control"  />
							</form>
						</div>
					</div>
			</div>


		</div>
        <hr>

		<?php
	include "../../include/db_config.php";

	$resultset = "";
	error_reporting(0);
	if (isset($_POST["btnregno"])) {
		$reg = $_POST["txtreg"];
		$query = "select * from table_user_edupay where reg_num='$reg'";
		$resultset = mysqli_query($link, $query);

	} else if (isset($_POST["btnname"])) {
		$name = $_POST["txtname"];
		$query = "select * from table_user_edupay where name like '%$name%'";
		$resultset = mysqli_query($link, $query);

	} else if(isset($_GET["regNum"])){
        echo "<script>alert('Book Id Not Found')</script>";

	    $reg = $_GET["regNum"];
        $query = "select * from table_user_edupay where reg_num='$reg'";
        $resultset = mysqli_query($link, $query);

    } else if(isset($_GET["regNum2"])){
        echo "<script>alert('Book Already Issued')</script>";

	    $reg = $_GET["regNum2"];
        $query = "select * from table_user_edupay where reg_num='$reg'";
        $resultset = mysqli_query($link, $query);

    }

	?>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
						<div class="card-header bg-primary">
								<h6>Student Details</h6>
						</div>

						<div class="card-body" style="text-transform: capitalize;">
							<table class="table table-stripped table-hover table-bordered">
								<tr>
									<th>Registration Number</th>
									<th>Student Name</th>
									<th>Course</th>
									<th>Semester</th>
									<th>Gender</th>
									<th class="text-center">Action</th>
								</tr>
								<?php

							while ($row = mysqli_fetch_assoc($resultset)) { ?>

											<tr>
												<td><?php echo $row["reg_num"] ?></td>
												<td><?php echo $row["name"] ?></td>
												<td><?php echo $row["course"] ?></td>
												<td><?php echo $row["semester"] ?></td>
												<td><?php echo $row["gender"] ?></td>
												<td class="text-center">
													<a onclick="issuebook('<?php echo $row["reg_num"] ?>')"  class="btn btn-primary">Issue Book</a>&nbsp;&nbsp;&nbsp;
													<a href="viewissuebooks.php?regno=<?php echo $row["reg_num"] ?>" class="btn btn-success">View issued</a>
												</td>
											</tr>

									<?php
							}
							?>
							</table>
						</div>
					</div>
			</div>
		</div>
	</div>

    </div>
</div>
<form id="frm" action="issuebook.php">
    <input type="hidden" name="regno" id="hidregno"/>
    <input type="hidden" name="bookid" id="hidbookid"/>
<!--    <input type="hidden" name="">-->

</form>


<script>
    function issuebook(r)
    {
            document.getElementById("hidregno").value=r;
           bid= prompt("Please Enter Book Id");
           document.getElementById("hidbookid").value=bid;
           document.getElementById("frm").submit();
    }
</script>




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
