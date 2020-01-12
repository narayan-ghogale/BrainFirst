<?php
    session_start();
require('connection.php');
if(!isset($_SESSION["email"]) or $_SESSION['usertype']!='student')
header('location:index.php');

$course_id = $_POST['course_id'];

$email = $_SESSION['email'];

$q = "select student_id from student where email='$email'";
$result = mysqli_query($con, $q);
$rows = mysqli_fetch_array($result);
$student_id = $rows['student_id'];

$q = "INSERT INTO course_enrolled (student_id,course_id) VALUES ($student_id,$course_id)";
if(mysqli_query($con, $q)){
	echo "<script type='text/javascript'>alert('You have successfully enrolled for this course!!!');
	window.location.href='studenthome.php';
	</script>";
}
?>