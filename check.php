<?php 
require("connection.php");
//session_start();

$course_id = $_SESSION["course_id"];
$student_id = $_SESSION["student_id"];
$quiz_id = $_SESSION["quiz_id"];

$total_ques = 0;
$marks = 0;
$q1 = "select * from quiz_info,quiz_ques where quiz_info.course_id='$course_id' AND quiz_info.quiz_id=quiz_ques.quiz_id";
$result1 = mysqli_query($con,$q1);
while($row1=mysqli_fetch_array($result1))
{
	$total_ques++;
	$ques_num = $row1['ques_num'];
	$correct_ans = $row1['correct_answer'];
	$q2 = "select * from quiz_ans where student_id='$student_id' AND quiz_id='$quiz_id' AND ques_num='$ques_num'";
	$result2 = mysqli_query($con,$q2);
	$row2 = mysqli_fetch_array($result2);
	$ans = $row2['answer'];
	if($ans==$correct_ans)
	{
		$marks=$marks+1;
	}
}

	$grade = 'F';
    $percentage = ($marks*100)/$total_ques;
    if($percentage > 80)
        $grade = 'A';
    elseif ($percentage > 60) 
         $grade = 'B';
    elseif($percentage > 40)
        $grade = 'C';
    else
         $grade = 'F';

$q = "insert into quiz_grade(course_id,student_id,quiz_id,grade) values('$course_id','$student_id','$quiz_id','$grade')";
$result = mysqli_query($con,$q);
?>