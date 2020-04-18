<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 20/07/18
 * Time: 2:20 PM
 */?>
<?php
//session_start();
include ("../../include/db_config.php");
?>
<?php
// checking for sessions creation
if(!(isset($_SESSION['auth_user'])))
{
   header("location:../index.php");
}
else
{
   $session = $_SESSION["auth_user"];

   $result = mysqli_query($link,"select last_login,ad_name from table_admin_faculty where ad_id = $session");
   $rowFetched = mysqli_fetch_assoc($result);
//   echo $rowFetched["last_login"];

?>
    <div class="dashhead">
        <div class="dashhead-titles">
            <h6 class="dashhead-subtitle text-white">Dashboard</h6>
            <a href="library_dashboard.php"><h2 class="dashhead-title">EduPay</h2></a>
        </div>

        <div class="btn-toolbar dashhead-toolbar">
            <div class="btn-toolbar-item input-with-icon">
                <span class="float-right" style="font-size: 11px">Last login:<?php echo $rowFetched["last_login"]; ?></span><br>
                <span class="float-right"> Admin: <?php echo $rowFetched["ad_name"] ?> </span><br>
                <span>
                    <form action="">
                        <button class="btn text-danger ml-5"  style="background-color: #25282F;" type="submit" name="logout">
                            Logout &#x27B2;
                        </button>
                    </form>
                </span>
                <?php
                if (isset($_GET["logout"])){
                    mysqli_query($link,"update table_admin_faculty set last_login = NOW() where ad_id = $session");

                    session_destroy();
                    echo "<script>window.location='../index.php'</script>";
                }
                ?>
<!--                    <input type="submit" name="logout" value="logout" style="color: #303C52;" >-->
<!--<a hreff class="float-right text-danger" style="color: #303C52;" name="logout">Logout &#x27B2;</a></span>-->
<!--                --><?php
//                if (isset($_GET[""]))
//                ?>
            </div>
        </div>
    </div>
<?php
	}
	?>
