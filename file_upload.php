<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 15/06/18
 * Time: 8:49 PM
 */

?>
<?php
session_start();
include ("include/db_config.php");
$session = $_SESSION["auth_user"];
if (isset($_FILES["file_upload"]))
{
    $source = $_FILES["file_upload"]["tmp_name"];
    $destination = "profiles/".$_FILES["file_upload"]["name"];
    $type = $_FILES["file_upload"]["type"];
    if(!(empty($source)))
    {
        if($type == "image/jpg" || $type == "image/png" || $type == "image/jpeg" ){
            move_uploaded_file($source,$destination);
            mysqli_query($link,"update table_user_edupay set profile_pic = '$destination' where u_id = $session" );
            echo "<script>alert('File Uploaded successfully');window.location='student_dashboard.php';</script>";

        }
        else{
            echo "<script>alert('File Type Not supported');window.location='student_dashboard.php';</script>";
        }
    }
    else{
        echo "<script>alert('File Feild Empty');window.location='student_dashboard.php';</script>";
    }
}
?>
