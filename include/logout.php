<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 10/06/18
 * Time: 8:12 PM
 */

?>

<?php
session_start();
require("db_config.php");

//$session = $_SESSION["auth_admin"];
// updating the last_login....

 if (isset($_GET["logout_admin"])){
     $id = $_GET["logout_admin"];
     mysqli_query($link,"update table_admin_edupay SET last_login = NOW() where admin_id = $id ");

     session_destroy();
     header("location:../admin/index.php");

 }
?>
<?php
//logout for transport

            if (isset($_GET["logout"])) {
                $id = $_GET["logout"];
                mysqli_query($link, "update table_admin_faculty set last_login = NOW() where ad_id = $id");
                session_destroy();

                header("location:../faculty/index.php");
            }

            ?>

