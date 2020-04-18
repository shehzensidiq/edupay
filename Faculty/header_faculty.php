<?php

/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 19/06/18
 * Time: 1:52 PM
 */
include "../include/db_config.php";
//session_start();
if (!(isset($_SESSION["auth_user"]))) {
    header("location:index.php");
}
$session = $_SESSION["auth_user"];
?>

<div class="dashhead">
    <div class="dashhead-titles">
        <h6 class="dashhead-subtitle text-white">Dashboard</h6>
        <a href="transport_dashboard.php"><h2 class="dashhead-title">EduPay</h2></a>
    </div>
    <?php
    $result = mysqli_query($link, "select last_login,ad_name from table_admin_faculty where ad_id = $session ");
    $rowFetched = mysqli_fetch_assoc($result);
    ?>

    <div class="btn-toolbar dashhead-toolbar">
        <div class="btn-toolbar-item input-with-icon">
            <span class="float-right" style="font-size: 11px">Last login:<?php echo $rowFetched["last_login"]; ?></span><br>
            <span class="float-right text-capitalize"> Admin: <?php echo $rowFetched["ad_name"] ?> </span><br>
                <form action="../include/logout.php">
                    <button class=" text-danger btn float-right " name="logout" style="border:none;background-color:#25282F;font-size:13px" type="submit" value="<?php echo $session; ?>">Logout
                        &#x27B2;
                    </button>
                </form>


        </div>
    </div>
</div>

