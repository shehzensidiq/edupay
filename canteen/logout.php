<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 20/07/18
 * Time: 9:31 PM
 */?>
<?php
session_start();
$session = $_SESSION["auth_user"];
// updating the last_login....

require("../include/db_config.php");
mysqli_query($link,"update table_canteen_admin SET last_login = NOW() where canteen_id = $session ");

?>

<?php

session_destroy();
header("location:index.php");

?>