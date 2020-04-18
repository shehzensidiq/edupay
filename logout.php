<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 15/06/18
 * Time: 7:39 PM
 */
?>

<?php

session_start();
$session = $_SESSION["auth_user"];
include ("include/db_config.php");
mysqli_query($link,"update  table_user_edupay set last_login = NOW() where u_id = $session");
session_destroy();
header("location:index.php");

?>
