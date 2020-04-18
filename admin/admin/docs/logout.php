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
$session = $_SESSION["auth_admin"];
// updating the last_login....

    require("../../../include/db_config.php");
    mysqli_query($link,"update table_admin_edupay SET last_login = NOW() where admin_id = $session ");

?>

<?php

    session_destroy();
    header("location:../../index.php");

?>

