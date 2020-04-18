<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 15/06/18
 * Time: 12:02 PM
 */?>

<?php
if(isset($_GET["deleteMultiple"]))
{
    $u_id = $_GET["id"];
    include ("../include/db_config.php");
    foreach ($u_id as $del)
    {
        mysqli_query($link,"delete from table_user_edupay where u_id = $del");
    }
    header("location:student-details.php");
}



?>
