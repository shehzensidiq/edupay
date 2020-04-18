<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 20/07/18
 * Time: 2:20 PM
 */?>
<?php
//session_start();
include ("../include/db_config.php");

?>
<?php
//checking for sessions creation
if(!(isset($_SESSION['auth_user'])))
{
    header("location:index.php");

}
else {
    $name = $rowFetched["contractor"];
    $lastLogin = $rowFetched["last_login"];


    ?>
    <div class="dashhead">
        <div class="dashhead-titles">
            <h5 class="dashhead-subtitle">Dashboard</h5>
            <a href="canteen_dashboard.php"><h2 class="dashhead-title">EduPay</h2></a>
        </div>

        <div class="btn-toolbar dashhead-toolbar">
            <div class="btn-toolbar-item input-with-icon">
				<span class="float-right"
                      style="font-size: 11px">Last login:<?php echo $lastLogin ?></span><br>
                <span class="float-right text-capitalize"> Contractor: <?php echo $name ?> </span><br>
                <span><a href="logout.php" class="float-right text-danger"
                         style="color: #303C52;">Logout &#x27B2;</a></span>
            </div>
        </div>
    </div>
    <?php
} ?>
