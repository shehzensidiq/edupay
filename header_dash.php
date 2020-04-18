<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 15/06/18
 * Time: 7:12 PM
 */

?>


<?php
//session_start();
if(isset($_COOKIE["auth_user"]))
{
    $_SESSION["auth_user"] = $_COOKIE["auth_user"];
}
if(!isset($_SESSION["auth_user"]))
{
    header("location:index.php");

}

 else { 
    $reg = $_SESSION["reg_num"];
    $name = $_SESSION["name"];
    $lastLogin = $_SESSION["last_login"];
    ?>
	<div class="dashhead">
		<div class="dashhead-titles">
			<h5 class="dashhead-subtitle">Dashboard</h5>
			<a href="student_dashboard.php"><h2 class="dashhead-title">EduPay</h2></a>
		</div>

		<div class="btn-toolbar dashhead-toolbar">
			<div class="btn-toolbar-item input-with-icon">
				<span class="float-right"
					  style="font-size: 11px">Last login:<?php echo $lastLogin ?></span><br>
				<span class="float-right text-capitalize"> User: <?php echo $name?> </span><br>
				<span><a href="logout.php" class="float-right text-danger"
						 style="color: #303C52;">Logout &#x27B2;</a></span>
			</div>
		</div>
	</div>
    <?php
}
	?>


