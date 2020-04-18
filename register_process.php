<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 18/06/18
 * Time: 11:14 PM
 */

?>

<?php

# getting the values'
require "include/db_config.php";
$key = "sheh_wase-nyla_yasm-";
//error_reporting(0);

if (isset($_POST["add_user"])) {
    $name = $_POST["name"];
    $password = openssl_encrypt($_POST["password"], 'AES-256-ECB', $key, '0', '');
    $email = openssl_encrypt($_POST["email"], 'AES-256-ECB', $key, '0', '');
    $reg_num = $_POST["reg_num"];
    $enroll = $_POST["enroll"];
    $gender = $_POST["gender"];
    $course = $_POST["course"];
    $semester = $_POST["semester"];
    $batch = $_POST["batch"];

        $result = mysqli_query($link, "select name,email,reg_num,enroll_id,course,semester from table_user_edupay where email = '$email' and enroll_id = $enroll or reg_num = '$reg_num'");
//         while($rowFetched = mysqli_fetch_assoc($result)) {
             if (mysqli_num_rows($result)==0) {
                 mysqli_query($link, "insert into table_user_edupay(name,email,password,gender,reg_num,enroll_id,course,semester,batch,profile_pic,status,date_of_joining) values ('$name','$email','$password','$gender','$reg_num',$enroll,'$course','$semester','$batch','default.png','pending',NOW())");
                 echo "<script>alert('Registration successful'); window.location='index.php'</script>";
             } else if(mysqli_num_rows($result) > 0) {
                 echo "<script>alert('User Already registered');window.location='register.php'</script>";
        
             }
            // sending mail for completing the registration

        $to = $_POST["email"];
             $password = $_POST["password"];
             $subject = "Registation Complate";
             $body = "Thank you For Registering with Us. Your Email Id id : ".$to." and Password is : ". $password;
             mail($to,$subject,$body);

//         }

}
?>



