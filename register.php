<?php

session_start();
require('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if(isset($_POST['signup']))
	{

		
		$fname = $_POST['fname'];
		$fname = $con->real_escape_string($fname);
		$lname = $_POST['lname'];
		$lname = $con->real_escape_string($lname);
		$email = $_POST['email'];
		$email = $con->real_escape_string($email);
		$pass = $_POST['pass'];
		$pass = $con->real_escape_string($pass);
		$confpass = $_POST['confpass'];
		$confpass = $con->real_escape_string($confpass);
		$usertype = $_POST['usertype'];

		if($pass != $confpass) {
				echo "<script>
				alert('Password and confirm password does not match.');
				window.location.href='register.html';
				</script>";
		}else {

			$q = " select * from login_info where email = '$email' && password = '$pass' ";
			$result = mysqli_query($con, $q);
			$num = mysqli_num_rows($result);

			if($num == 1){
				echo "<script>
					alert('There is already an account with this email.');
					window.location.href='register.html';
					</script>";
			}else{

				if($usertype == "student") {
					$q1= "insert  into login_info(email, password, usertype) values ('$email' , '$pass', 'student') ";
					mysqli_query($con, $q1);
					$q2= "insert  into student(student_fname , student_lname, email) values ('$fname' , '$lname', '$email') ";
					mysqli_query($con, $q2);

					$_SESSION['email'] =  $email;
					$_SESSION['usertype'] = $usertype;
					echo "<script>
						alert('Successfully created account.');
						window.location.href='studenthome.php';
						</script>";
				}else {
					$q1= "insert  into login_info(email, password, usertype) values ('$email' , '$pass', 'faculty') ";
					mysqli_query($con, $q1);
					$q2= "insert  into faculty(faculty_fname , faculty_lname, email) values ('$fname' , '$lname', '$email') ";
					mysqli_query($con, $q2);

					$_SESSION['email'] =  $email;
					$_SESSION['usertype'] = $usertype;
					echo "<script>
						alert('Successfully created account.');
						window.location.href='facultyhome.php';
						</script>";	
				}
			}
		}
		mysqli_close($con);
	}
}


?>

<html lang="en">
<head>
	<title>Sign Up</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="fonts/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(img/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign Up
					</span>
				</div>

				<form method="post" action="register.php" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="First Name is required">
						<span class="label-input100">First Name</span>
						<input class="input100" type="text" name="fname" placeholder="Enter First Name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-26" data-validate="Last Name is required">
						<span class="label-input100">Last Name</span>
						<input class="input100" type="text" name="lname" placeholder="Enter Last Name">
						<span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-26" data-validate="Email ID is required">
						<span class="label-input100">Email ID</span>
						<input class="input100" type="email" name="email" placeholder="Enter Email ID">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter Password">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-18" data-validate = "password not matching">
						<span class="label-input100">Confirm Password</span>
						<input class="input100" type="password" name="confpass" placeholder="Confirm  Password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="validate-input m-b-26">
						<span class="label-input100">Usertype</span>
						<select name="usertype">
							<option value="student" ><p class="dropdown-format">Student</p></option>
							<option value="faculty"><p class="dropdown-format">Faculty</p></option>
						</select>
					<span class="focus-input100"></span>
					</div>
 

					

					<div class="flex-sb-m w-full p-b-30">
						

						<div>
							<a href="index.php" class="txt1">
								Already have an account? Sign in
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" name="signup" value="Sign Up">
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="js/jquery/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap/popper.js"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<script src="js/register.js"></script>

</body>
</html>
