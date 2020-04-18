    <?php
//     session_start();
?>
<?php
//checking for sessions creation
if (!(isset($_SESSION['auth_admin']))) {
	header("location:index.php");
} else {
    $session = $_SESSION["auth_admin"];
	$result = mysqli_query($link, "SELECT last_login,admin_name FROM table_admin_edupay where admin_id = $session");
	$rowFetched = mysqli_fetch_assoc($result);
	?>
  <div class="dashhead">
  <div class="dashhead-titles">
    <h6 class="dashhead-subtitle text-white">Dashboard</h6>
      <a href="admin_dashboard.php"><h2 class="dashhead-title">EduPay</h2></a>
  </div>

  <div class="btn-toolbar dashhead-toolbar">
    <div class="btn-toolbar-item input-with-icon">
		<span class="float-right" style="font-size: 11px">Last login:<?php echo $rowFetched["last_login"]; ?></span><br>
      <span class="float-right"> Admin: <?php echo $rowFetched["admin_name"] ?> </span><br>
        <form action="../../../include/logout.php">
            <button class=" text-danger btn float-right " name="logout_admin" style="border:none;background-color:#25282F;font-size:13px" type="submit" value="<?php echo $session; ?>">Logout
                &#x27B2;
            </button>
        </form>
<!--      <span><a href="../../../include/logout.php?id= --><?php //echo $session ?><!--" class="float-right text-danger" name="logout_admin" style="color: #303C52;">Logout &#x27B2;</a></span>-->
    </div>
  </div>
</div>

    <?php
}
?>



