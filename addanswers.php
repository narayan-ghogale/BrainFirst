<?php 
session_start();
require('connection.php');

$con = mysqli_connect($servername, $username, $password, $dbname);
if(!isset($_SESSION["email"]) or $_SESSION['usertype']!='student')
header('location:index.php');

$checked_count = count($_POST['option']);
$selected = $_POST['option'];
    
$i=0;
while($i<$checked_count)
{
	$i++;
	$ans = $selected[$i];
	$student_id = $_SESSION['student_id'];
	$quiz_id = $_SESSION['quiz_id'];
	$q = "insert into quiz_ans values('$student_id','$quiz_id','$i','$ans')";
	$result = mysqli_query($con, $q);
}
require("check.php");
echo '<script>alert("Your answers are noted. Thank You!");
		window.location.href="studentquiz.php";
		</script>';
?>