<?php
    session_start();

    if(!isset($_SESSION["email"])  or $_SESSION['usertype']!='faculty')
        header('location:index.php');
$email = $_SESSION['email'];
require('connection.php');
$q = "select faculty_id from faculty where email='$email'";
$result = mysqli_query($con, $q);
$rows = mysqli_fetch_array($result);
$faculty_id = $rows['faculty_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if(isset($_POST['create']))
    { 
        $name = $_POST['course_name'];
        $name = $con->real_escape_string($name);
        $about = $_POST['about'];
        $about = $con->real_escape_string($about);
        $date1 = $_POST['startdate'];
        $date2 = $_POST['enddate'];
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);
        if($timestamp1 == $timestamp2){
            echo "both dates cannot be same";
        }else{
            if($timestamp1>$timestamp2){
                echo "Start date cannot be greater than End date";}
        }
        if(isset($_FILES['syllabus'])){
        $fileName=$_FILES['syllabus']['name'];
        $fileTmp=$_FILES['syllabus']['tmp_name'];
        $fileExt=substr($fileName, strrpos($fileName, "."));
        $ModifiedCourseName = preg_replace('/\s+/', '_', $name);
        $targetName="syllabus/".$faculty_id."_".$ModifiedCourseName.$fileExt;
        if(empty($errors)==true) {
            if (file_exists($targetName)) {   
                unlink($targetName);
        }      
        $moved = move_uploaded_file($fileTmp,$targetName);
        if($moved == true){
        //successful
        $q= "insert  into course(faculty_id, course_name, start_date, end_date, about,syllabus_path) values ('$faculty_id','$name' , '$date1', '$date2', '$about',' ".$targetName."') ";
        mysqli_query($con, $q);
        echo "<script>
                        alert('Successfully created course.');
                        window.location.href='facultyhome.php';
         
                </script>";
        $SESSION['email'] =  $email;

        mysqli_close($con);
        }
        else{
        	echo "<script>
                        alert('Error.');
         
                </script>";
        }
    }
    }
}
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Course creation page</title>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!--link rel="icon" type="image/png" sizes="16x16" href="img/icon.png"-->
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="css/sidebar-nav.min.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
   
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
  
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/createstyle.css">

    <style type="text/css">
        .myButton {
      border-radius: 40px;
      background-color: #3399FF;
      border: none;
      font-family: Rubik,sans-serif;
      color: #FFFFFF;
      box-shadow: 0 6px 12px 0 rgba(0,0,0,0.2), 0 4px 16px 0 rgba(0,0,0,0.19);
      font-size: 16px;
      width: 140px;
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
    </style>
</head>


<body>
<!-- Navigation -->
<!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                <div class="top-left-part"><a class="logo"><b><img src="img/25.png" alt="home" /--></b><span class="hidden-xs"><!--img src="img/brainfirst-text.png" alt="home" /--></span></a></div>
                <ul class="nav navbar-top-links navbar-left m-l-20 hidden-xs">
                    <li>
                        <form role="search" class="app-search hidden-xs" method="post" action="faculty_searchcourses.php">
                            <input type="text" placeholder="Search..." class="form-control"> <a><i class="fa fa-search"></i></a>
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
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li style="padding: 10px 0 0;">
                        <a href="facultyhome.php" class="waves-effect"><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i><span class="hide-menu"> Back to Dashboard</span></a>
                    </li>
       
                </ul>
            </div>
        </div>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title" style="text-align: center;">
                    <h4 class="course-name" style="font-size: 22px">Create Course </h4> 
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row" style="padding:10px">
                    <div class="col-md-12">
                              <form class="form" method="POST" enctype="multipart/form-data" action="coursecreate.php">
							  <p type="Name:"><input placeholder="Enter course name" name="course_name" required></input></p>
							  <p type="About:"><input placeholder="Enter description of the course in brief" name='about' required></input></p>
							  <p type="Start date:"><input placeholder="When will the course start?" type="date" name="startdate" id ='sdate' required></input></p>
							    <p type="End date:"><input placeholder="When will course end?" type="date" name="enddate" id ='edate' required></input></p>
							  <p type="Syllabus"><input placeholder="Upload file of syllabus" name="syllabus" id="syllabus" type="file" required></input></p>
							<br><br>
							  <button id="submit" class="myButton" name="create"><span>Create</span></button>
							</form>
                       </div>
                    </div>
                </div>
            </div>
        <!-- Left navbar-header 
        -->
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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