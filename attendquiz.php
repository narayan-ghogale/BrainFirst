<?php
session_start();
require("connection.php");

if(!isset($_SESSION["email"]) or $_SESSION['usertype']!='student')
header('location:index.php');

$email = $_SESSION['email'];
$course_id = $_SESSION["course_id"];
$quiz_id = $_POST['quiz_id'];
$student_id = $_SESSION['student_id'];
$_SESSION['quiz_id'] = $quiz_id;

$q = "select * from quiz_ans where student_id='$student_id' AND quiz_id='$quiz_id'";
$result = mysqli_query($con, $q);
$rows = mysqli_fetch_array($result);
$num = mysqli_num_rows($result);
if($num>0)
{
	echo '<script>alert("You have already attended this quiz.");
        window.location.href="studentquiz.php";</script>';
}
else
{
	$q = "select * from quiz_info where quiz_id='$quiz_id'";
	$result = mysqli_query($con, $q);
	$rows = mysqli_fetch_array($result);
	$about_quiz = $rows['about_quiz'];
	$endtime = $rows['end_timestamp'];
}

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!--link rel="icon" type="image/png" sizes="16x16" href="img/icon.png"-->
    <title>Quiz - BrainFirst</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="css/sidebar-nav.min.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (blue.css) for this starter
          page. However, you can choose any other skin from folder css / colors .
-->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <style>
    .title
    {
        font-weight:350;
        text-transform:uppercase; 
        font-size:21px; 
        margin:0 0 12px;
    }

    .field
    {
        background-color:#fff;
        color:#565656;
        font-size: 16px;
        font-family: Rubik,sans-serif;
        height:auto;
        max-width:100%;
        padding:7px 12px;
        line-height: 1.5;
        text-transform: none;
        font-weight: 400;
        transition:all 300ms linear 0s
    }

    .course-name
    {
        color: rgba(0,0,0,.5);
        font-weight: 0;
        margin-top: 6px;
        line-height: 22px;
        font-size: 20px;
        font-family: Rubik,sans-serif;
        margin-right: 0px;
        margin-bottom: 10px;
        margin-left: 10px;
    }

    .myButton {
      border-radius: 40px;
      background-color: #3399FF;
      border: none;
      font-family: Rubik,sans-serif;
      color: #FFFFFF;
      box-shadow: 0 6px 12px 0 rgba(0,0,0,0.2), 0 4px 16px 0 rgba(0,0,0,0.19);
      font-size: 18px;
      width: 120px;
      height: 40px;
      padding-left: 5px;
      transition: all 0.5s;
      cursor: pointer;
    }

    .myButton span {
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
    }

    .myButton span:after {
      content: '\00bb';
      position: absolute;
      opacity: 0;
      top: 0;
      right: -20px;
      transition: 0.5s;
    }

    .myButton:hover span {
      padding-right: 25px;
    }

    .myButton:hover span:after {
      opacity: 1;
      right: 0;
    }

    a { color: inherit; } 

    .myBox {
    	padding:50px; 
    	background: white;
    	height: auto;
    	overflow: auto;
    }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                <div class="top-left-part"><a class="logo"><b><img src="img/25.png" alt="home" /></b><span class="hidden-xs"><!--img src="img/brainfirst-text.png" alt="home" /--></span></a></div>
                <ul class="nav navbar-top-links navbar-left m-l-20 hidden-xs">
                    <li>
                        <form role="search" class="app-search hidden-xs" method="post" action="student_searchcourses.php">
                            <input type="text" placeholder="Search..." class="form-control" name="search_term"> <a><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a href="logout.php"><b class="hidden-xs">Log Out</b></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li style="padding: 10px 0 0;">
                        <a href="studentquiz.php" class="waves-effect"><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i><span class="hide-menu">Back to Quizzes Page</span></a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title" style="text-align: center;">
                    <h4 class="course-name" style="font-size: 22px"><?php echo $about_quiz?></h4> 
                    <!-- /.col-lg-12 -->
                </div>
                <div class="col-md-12">
                    <div class="myBox" >
                    	<div style="text-align: center;">
                    		<h3 class="title" style="display: inline-block;">Quiz Questions</h3>
                    		<h3 style="float: right;" id="divCounter">Time remaining</h3>
                    		<script type="text/javascript">
								var countDownDate = new Date('<?php echo $endtime;?>').getTime();

								var x = setInterval(function() {

								    var now = new Date().getTime();
								    var distance = countDownDate - now;
								    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
								    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
								    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
								    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
								    
								    document.getElementById("divCounter").innerHTML = hours + "h "
								    + minutes + "m " + seconds + "s left";
								    
								    if (distance < 0) {
								        clearInterval(x);
								        document.getElementById("divCounter").innerHTML = "EXPIRED";
								        alert("Time is up!");
                                        document.getElementById("quiz").submit();
								    }
								}, 1000);	
						    </script>
						</div><br>
						<div style="padding-left: 70px; padding-right: 70px; float: left;">
							<form action="addanswers.php" method="POST" id="quiz">
								<?php 
									$q1 = "select * from quiz_ques where quiz_id='$quiz_id'";
									$result = mysqli_query($con, $q1);
									$i=0;
									while($row = mysqli_fetch_array($result))
									{
										$i++;
                                        //$_SESSION['no_of_questions'] = $i;
										echo '<h4>'.$row["ques_num"].'. '.$row["question"].'</h4>';
										echo '<input type="radio" name="option['.$i.']" value="a"> '.$row["option_a"].'</input><br>';
										echo '<input type="radio" name="option['.$i.']" value="b"> '.$row["option_b"].'</input><br>';
										echo '<input type="radio" name="option['.$i.']" value="c"> '.$row["option_c"].'</input><br>';
										echo '<input type="radio" name="option['.$i.']" value="d"> '.$row["option_d"].'</input><br><br>';
									}
								?>
								<input type="submit" class="myButton" name="submit_btn" value="Submit"></input> 
							</form>
						</div>
                    </div>
                </div>
            </div>
         
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="js/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>

</body>

</html>
