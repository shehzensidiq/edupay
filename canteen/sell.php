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

        .dropdown-menu :hover> button {
            background-color: #4496C2;
            color: white;
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
		

		<?php
			include "../include/db_config.php";
			$reg=$_GET["regno"];
			$query="select * from table_user_edupay where reg_num='$reg'";
			$resultset=mysqli_query($link,$query);

			
		?>

		<br/>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
						<div class="card-header">
								<h5>Student Details</h5>
						</div>

						<div class="card-body" style="text-transform: capitalize;">
							<table class="table table-stripped table-hover table-md">
								<tr class="thead-dark">
									<th>Registration Number</th>
									<th>Student Name</th>
									<th>Course</th>
									<th>Semester</th>
									<th>Gender</th>
									
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
												
											</tr>

									<?php	}
								?>
							</table>
						</div>
					</div>
			</div>
		</div>

		<script>
			function addNewItem()
			{
					form=document.getElementById('solditems');
					elem=document.createElement("select");
					elem.innerHTML=document.getElementById("item").innerHTML;
					elem.setAttribute("name" , "items[]");
					elem.setAttribute("class" , "form-control");
					form.appendChild(elem);


					elem=document.createElement("select");
					elem.innerHTML=document.getElementById("wclass").innerHTML;
					elem.setAttribute("name" , "wclass[]");
					elem.setAttribute("class" , "form-control");
					form.appendChild(elem);

					elem=document.createElement("input");
					elem.setAttribute("name" , "quantity[]");
					elem.setAttribute("class" , "form-control");
					elem.setAttribute("type" , "number");
					elem.setAttribute("placeholder" , "Quantity");
					form.appendChild(elem);
     
					elem=document.createElement("input");
                    elem.setAttribute("name" , "price[]");
                    elem.setAttribute("class" , "form-control");
                    elem.setAttribute("type" , "number");
                    elem.setAttribute("placeholder" , "Price");
                    form.appendChild(elem);

					elem= document.createElement("hr");
					form.appendChild(elem);
			}
		</script>

		<div class="row mt-3">
			<div class="col-md-12">
					<div class="statcard">
                        <div class="p-3">
                            <span class="statcard-desc">Select Items</span>
                            <hr class="statcard-hr mb-0">
                            <?php
								$dataset=mysqli_query($link,"select * from table_stock");

							?>
							<input class="btn btn-primary mt-3" type="button" value="Add New Item" onclick="addNewItem()" />
							<form style="width:100%;padding: 20px;" method="post">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <select class="textbox form-control" id="item" name="items[]">
                                            <?php
                                            while($row=mysqli_fetch_assoc($dataset))
                                            {
//									    $quantityPresent = $row["quantity"];
                                                echo "<option value=".$row["stock_id"].">".$row["item_name"]."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="textbox form-control" name="wclass[]" id="wclass">
                                            <option>No.</option>
                                            <option>KG</option>
                                            <option>Grams</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="textbox form-control" placeholder="Quantity" type="number" name="quantity[]" id="quantity" />

                                    </div>
                                    <div class="col-sm-3">
                                        <input class="textbox form-control" placeholder="Price" type="number" name="price[]" id="price" />

                                    </div>
                                </div>





								<hr/>

								<div id="solditems">
								</div>

								<input type="submit" class="btn btn-success float-right"  name="checkOut" value="Check Out" onclick=" return confirm('Sure To Check Out')">
							</form>

							<?php
								if(isset($_POST["checkOut"]))
								{
								    $regNum = $_GET["regno"];
								    $_SESSION["reg_num"] = $regNum;
									$arritems= $_POST["items"];
									$arrwclass= $_POST["wclass"];
									$arrquantity= $_POST["quantity"];
									$arrprice= $_POST["price"];
									$items="";
									$wclass="";
									$quantity="";
									$price="";
									$check = "false";
									$bal = 0;
									   
									    for($i=0;$i<count($arritems);$i++) {
                                            $res = mysqli_query($link,"select quantity from table_stock where stock_id = $arritems[$i]");
                                            $row = mysqli_fetch_assoc($res);
									        
									        if($arrquantity[$i] < $row["quantity"]) {
									            $check = "true";
									            $bal = $row["quantity"] - $arrquantity[$i];
									            mysqli_query($link, "update table_stock set quantity = $bal where stock_id = $arritems[$i]");
								           $items .= $arritems[$i] . ",";
								           $wclass .= $arrwclass[$i] . ",";
								           $quantity .= $arrquantity[$i] . ",";
								           $price .= $arrprice[$i] . ",";
										}
									    
									    }
                                        if($check == "true") {
									        
//
                                            mysqli_query($link, "insert into table_orders (reg_num,stock_id,weight_class,quantity,price,order_date)
                                            values('$regNum','$items','$wclass','$quantity','$price',NOW())");
        									$result = mysqli_query($link,"select order_num from table_orders where reg_num = '$regNum' and stock_id = '$items' and weight_class = '$wclass' and quantity = '$quantity' and price = '$price' and order_date = NOW()");
        									$rowFetched = mysqli_fetch_assoc($result);
        									$_SESSION["order_num"] = $rowFetched["order_num"];
        									echo "<script>window.location='bill.php'</script>";
        									
                                        }
                                        else {
                                            echo "<script>alert('Not Sufficient Quantity');</script>";
//
                                        }
									
									
									
								}
							?>
						</div>
                    </div>
			</div>
		</div>
	</div>
    </div>
</div>

<hr class="mt-5">

<!-- </div> -->

<style>
    .form-control{
        width: 240px;
        height: 35px;margin-left: 20px;
        border-radius:5px;
        border:1px solid grey;
        display:inline-block;

    }
</style>
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
