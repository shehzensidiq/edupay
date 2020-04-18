<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 19/08/18
 * Time: 11:54 AM
 */
session_start();
include "db_config.php";
$key="sheh_wase-nyla_yasm-";
//update for students
if(isset($_POST["update_btn_std"])){
    $name = $_POST["name"];
    $email = openssl_encrypt($_POST["email"],'AES-256-ECB',$key,'0','');
    $password = openssl_encrypt($_POST["password"],'AES-256-ECB',$key,'0','');
    $course = $_POST["course"];
    $regNum = $_POST["reg_num"];
    $sem = $_POST["semester"];
    $eroll = $_POST["enroll_id"];
    $gender = $_POST["gender"];
    $id= $_POST["id"];
    mysqli_query($link,"update table_user_edupay set name = '$name',email='$email',password='$password',gender='$gender',reg_num='$regNum',enroll_id='$eroll',course = '$course',
    semester=$sem where u_id = $id");
    header("location:../admin/admin/docs/editStudent.php?returnId=$id");
}
?>

<?php
// add admin
if (isset($_POST["update_admin_btn"])){
    $name=$_POST["name"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $dob=$_POST["dob"];
    $adminFor=$_POST["admin_type"];
    $id = $_POST["hidden_edit_btn"];
    mysqli_query($link,"update table_admin_faculty set ad_name = '$name',ad_email='$email',ad_password='$password',admin_for = '$adminFor',dob = '$dob' where ad_id = $id");
    header("location:../admin/admin/docs/add_admin.php");


}

?>
