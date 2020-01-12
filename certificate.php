<?php 
session_start();

require('connection.php');

if(!isset($_SESSION["email"]) or $_SESSION['usertype']!='student')
	header('location:index.php');

$email = $_SESSION['email'];
$q = "SELECT student_id,student_fname,student_lname FROM student WHERE email='$email'";
$result=mysqli_query($con,$q);
$row=mysqli_fetch_array($result);
$student_id=$row['student_id'];
$fname=$row['student_fname'];
$lname=$row['student_lname'];
$student_name=$fname.' '.$lname;

if(isset ($_POST['generate_certificate'])){
	$_SESSION['course_id']=$_POST['course_id'];
}
$course_id = $_SESSION['course_id'];

$q = "SELECT course_name,end_date FROM course WHERE course_id = '$course_id' ";
$result = mysqli_query($con,$q);
$row = mysqli_fetch_array($result);
$course_name = $row['course_name'];
$end_date = $row['end_date'];

function convert($grade){
	if($grade == 'A'){
		return 5;
	}
	else if($grade == 'B'){
		return 3;
	}
	else if($grade == 'C'){
		return 1;
	}
	else{
		return 0;
	}
}

$sum=0;
$q = "SELECT grade FROM quiz_grade WHERE student_id = '$student_id' AND course_id = '$course_id' ";
$result = mysqli_query($con,$q);
while($row = mysqli_fetch_array($result)){
	$sum = $sum + convert($row['grade']);
}

$q = "SELECT grade FROM assignment_ans,assignment_ques WHERE student_id = '$student_id' AND course_id = '$course_id' AND assignment_ans.assignment_id=assignment_ques.assignment_id ";
$result = mysqli_query($con,$q);
while($row = mysqli_fetch_array($result)){
	$sum = $sum + convert($row['grade']);
}

$q = "SELECT COUNT(*) FROM assignment_ques WHERE course_id = '$course_id' ";
$result = mysqli_query($con,$q);
$row = mysqli_fetch_array($result);
$num1 = $row['COUNT(*)'];

$q = "SELECT COUNT(*) FROM quiz_info WHERE course_id = '$course_id' ";
$result = mysqli_query($con,$q);
$row = mysqli_fetch_array($result);
$num2 = $row['COUNT(*)'];

$num = $num1+$num2;

$final_grade = 'F';

if($num==0)
{
	$final_grade='A';
}
else
{
	$final_rating = $sum/$num;
	if($final_rating>=4.0)
	{
		$final_grade='A';
	}
	else if($final_rating>=2.5)
	{
		$final_grade='B';
	}
	else if($final_rating>=1.0)
	{
		$final_grade='C';
	}

}

require_once('tcpdf/tcpdf.php');
		$pdf = new TCPDF('L',PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle("Certificate");
		$pdf->SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont('helvetica');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT,'10',PDF_MARGIN_RIGHT);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetAutoPageBreak(true,10);
		$pdf->SetFont('helvetica','',11);
		$pdf->AddPage();
		$statement = strtoupper($student_name).' has secured '.$final_grade.' in course '.strtoupper($course_name);
		$content = "";
		$content .= '
						<p style="font-size:50px" align="center"><strong>BrainFirst</strong></p>
						<p style="font-size:40px" align="center">Certificate of Completion</p>
						<br><br><br><br><br>
						<p align="center" style="font-size:20px">This is to certify that</p>
						<hr>
						<p align="center" style="font-size:30px">
	      			'; 

	      $content .= strtoupper($student_name);
	      $content .= '</p>
	      				<hr>
	      				<p align="center" style="font-size:20px">Has secured 
	      ';  
	      $content .= $final_grade;
	      $content .= ' grade in the course of ';
	      $content .= strtoupper($course_name);
	      $content .= ' .</p>';
	      $content .= '<p style="font-size:40px"></p><p style="font-size:20px">Date: ';
	      $content .= date("F d, Y", strtotime($end_date));
	      $content .= '</p>';
	      $pdf->writeHTML($content);
	      $pdf->Output('file.pdf', 'I');