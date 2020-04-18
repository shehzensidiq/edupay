<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="../scss/style.css">
	<script src="../https://use.fontawesome.com/c98eab8b1b.js"></script>
	<title>Withdraw Request</title>
</head>

<body>
<?php
session_start();
include "../include/db_config.php";


?>

	<div class="container" style="margin-top: 200px;">
		<div class="row">
			<div class="col-sm-6">
				<div class="card mt-4">
					<div class="card-body">
						<?php
//                        session_start();
						$balance = $_SESSION["balance"];
						$type = $_SESSION["type"];
							?>
						<sup style="color:green;float: left;">Balance:- <?php echo "Rs " . $balance . "/-"; ?></sup>
						<sup style="color:red;float: right;">Min allowed withdrawal = Rs 10000/- Max:- Rs 30000/-</sup>
						<hr>
						<form action="">
							<div class="row">
								<div class="col-sm-3 mt-4">
									<div class="form-group">
										<sup>Amount</sup>
										<input type="number" class="form-control" min="0" name="withdrawAmount" placeholder="Rs ">
									</div>
								</div>


								<div class="col-sm-7 mt-4">
									<div class="form-group">
										<sup>Select Account Number</sup>
                                        <?php
                                            $res = mysqli_query($link,"select account_number from table_bank where user_id = '$type'");
                                        ?>
                                        <select name="accNum" id="" class="form-control">
                                            <option value="none">Select</option>
                                            <?php
                                            while($row = mysqli_fetch_assoc($res)){
                                                ?>
                                                <option value="<?php echo $row["account_number"]  ?>"><?php echo $row["account_number"]  ?></option>
                                            <?php }
                                            ?>

                                        </select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<input type="submit" value="Request" name="withdraw_btn" class="btn btn-block btn-success">
								</div>
							</div>
						</form>
						<?php
							if (isset($_GET["withdraw_btn"])) {
								$amount = $_GET["withdrawAmount"];
								$name = $_SESSION["type"];
								$accNum = $_GET["accNum"];
                               if($amount > $balance) {
                                       echo "<script>alert('insufficient Balance');</script>";


                               } else if($amount < 1000){
                                   echo "<script>alert('The Entered Amount is less than the limit');</script>";

                               } else if($amount > 30000){
                                   echo "<script>alert('The Entered Amount is exceeding the limit of Rs 30000');</script>";

                               } else if($balance >= $amount) {
								mysqli_query($link, "insert into withdraw_request_table(request_from,amount,accNum,txn_id,status,time,date) values('$name',$amount,$accNum,'N/A','pending',NOW(),NOW())");
								echo "<script>alert('Requested');</script>";
								}
							}
							?>
					</div>

				</div>
			</div>

			<div class="col-sm-6">
				<div class="card mt-4 p-1">
					<h5 class="text-center">Add Bank Account</h5>
					<hr>
					<form action="" method="post">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<sup>Name Of Account Holder</sup>
									<input type="text" class="form-control" placeholder="John Doe / jane Doe" name="name">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<sup>Name Of The Bank</sup>
									<input type="text" class="form-control" placeholder="Bank Name" name="bankName">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<sup>IFSC code Of Bank</sup>
									<input type="text" class="form-control" placeholder="IFSC code " name="ifsc">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<sup>Branch</sup>
									<input type="text" class="form-control" placeholder="Branch Name" name="branchName">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<sup>Account Number</sup>
									<input type="number" class="form-control" placeholder="1234567890" min="0" name="accNum">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input type="submit" class="btn btn-block btn-primary mt-4" placeholder="Bank Name" value="Add Bank Account" 											name="buttonAddBank"> 
									
								</div>
							</div>
						</div>
					</form>

					<?php
						if (isset($_POST["buttonAddBank"])) {
							$name = $_POST["name"];
							$bankName = $_POST["bankName"];
							$ifsc = $_POST["ifsc"];
							$branchName = $_POST["branchName"];
							$accountNumber = $_POST["accNum"];
							mysqli_query($link, "insert into table_bank(user_id,name,ifsc,bank_name,bank_branch,account_number,date)											values('canteen','$name','$ifsc','$bankName','$branchName',$accountNumber,NOW())");
							echo "<script>alert('The Account Has Been Added Successfulluy')</script>";
						
						}
						
						?>

				</div>

			</div>
		</div>
	</div>

<?php
//include "../include/footer.php";
?>

	<script src="../bootstrap/js/jquery.min.js"></script>
	<script src="../bootstrap/js/popper.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
