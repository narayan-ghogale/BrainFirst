<?php
#echo '<script>alert('.$about.');</script>';
session_start();
require('connection.php');
	$about = $_POST['about'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	#$syllabus = $_POST['syllabus'];
	$course_id = $_POST['course_id'];
	$q = "update course set about='$about',start_date='$start_date',end_date='$end_date' where course_id='$course_id'";
	$result = mysqli_query($con, $q);
?>