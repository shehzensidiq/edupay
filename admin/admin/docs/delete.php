<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 14/06/18
 * Time: 3:18 PM
 */

?>



<?php

//echo "welcome";

if(isset($_GET["delete"]))
{
    $id = $_GET["hidden_btn"];
//    echo $id;
    include ("../../../include/db_config.php");
    mysqli_query($link,"delete from table_user_edupay where u_id = $id");
    header("location:student-details.php");
}

?>

<?php
if (isset($_GET["delete_admin"]))
{
    $id = $_GET["hidden_btn"];
    include ("../../../include/db_config.php");
    mysqli_query($link,"delete from table_admin_faculty where ad_id = $id");
    header("location:add_admin.php");

}
?>
