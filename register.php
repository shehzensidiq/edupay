




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Regsiter</title>
	  <meta http-equiv="x-ua-compatible" content="ie=edge">
<!--	   <meta http-equiv="refresh" content="3">-->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
             <link rel="shortcut icon" type="image/png" href="../admin/images/logo.png">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="scss/style.css">
    <script src="https://use.fontawesome.com/c98eab8b1b.js"></script>






</head>
<body id="register">
	<!-- header inclusing -->
	<?php
		include("header.php");

	?>
	<div class="container" id="regForm">
        <div class="card w-75 mx-auto">
            <div class="card-header text-center">
                <h4 class="text-white">Welcome to Registration page </h4>
            </div>
            <div class="card-body">
                <form  method="post" name="register" id="register" action="register_process.php">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Enter Name</label>
                                <input type="text" class="form-control" name="name" id="name"  placeholder="Enter your name" required minlength="5" maxlength="20" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Enter Email</label>
                                <input type="email" class="form-control"  id="email" name="email" placeholder="Enter your email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">Enter Password</label>
                                <input type="password" name="password"  id="password"  class="form-control password "  placeholder="***********" required minlength="5" maxlength="10">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input type="password" name="confirm_password" placeholder="***********" class="form-control password" id="confirm_password"  required minlength="5" maxlength="10">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-0 p-0 justify-content-center" id="errorMessage" style="font-size: 10px;"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-number">Registration Number</label>
                                <input type="text"  name="reg_num" class="form-control" placeholder="Registration Number" id="reg_num" required minlength="5" maxlength="10">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-number">Registration Number</label>
                                <input type="number"  name="enroll" class="form-control" placeholder="Enrollment Number" id="enroll_id" required minlength="5" maxlength="10" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Gender</label><br>
                                <label for="male">Male</label>
                                <input type="radio" value="male" name="gender" class="form-control-check" required>
                                <label for="female">Female</label>
                                <input type="radio" name="gender" value="female" class="form-control-check" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="batch">Batch</label>
                                <select name="batch"  class="form-control" required>
                                    <option value="select">select</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="course">Select Your Course</label>
                                <select name="course" class="form-control" required>
                                    <option value="select">Select</option>
                                    <option value="B.Tech">B.Tech</option>
                                    <option value="MCA">MCA</option>
                                    <option value="IMBA">IMBA</option>
                                    <option value="MA">MCA</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="semester">Enter Semester</label>
                                <select name="semester"  class="form-control" required>
                                    <option value="none">Select</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="submit" name="add_user" id="registerButton" value="Add The Entered User" class="btn btn-outline-warning btn-block ">

                    <div id="warning"></div>
                </form>
            </div>
        </div>


	</div>

	<!-- including Footer -->
	<?php


	include("include/footer.php")




	?>



    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        var check = "false";
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
        $("#name").blur(function(){
             var name = $(this).val();
             if(name.length < 8) {
                 $(this).css("border", "1px solid red");
                 check = "false";
             } else {
                 $(this).css("border", "1px solid green");
                 check = "true";

             }
        });
        $("#email").blur(function(){
            if(isEmail($("#email").val()) == false){
                        $("#email").css("border","1px solid red");
                        check = "false";

            } else {
                        $("#email").css("border","1px solid green");
                check = "true";



            }
        });

        $("#password").blur(function(){
            var errorMessage = "";
            $("#confirm_password").blur(function(){
                if($("#password").val() == $("#confirm_password").val()){
                    // $("#password").css("border","1px solid green");
                    // $("#confirm_password").css("border","1px solid green");
                    check = "true";

                    errorMessage = "<span style='color: green;'>&check;Password Matched</span>"
                } else {
                    // $("#password").css("border","1px solid red");
                    // $("#confirm_password").css("border","1px solid red");
                    check = "false";

                    errorMessage = "<span style='color: red;'> &times;Password doesnt match</span>";
                }
                if(check == "true") {
                    $("#password").css("border", "1px solid green");
                    $("#confirm_password").css("border", "1px solid green");

                }else{
                    $("#password").css("border","1px solid red");
                    $("#confirm_password").css("border","1px solid red");
                }
                $("#errorMessage").html(errorMessage);


            });

        });

        $("#registerButton").click(function() {
           if(check == "false"){
               alert("Invalid Form Fill Up");


            }
        });

    </script>
</body>
</html>
