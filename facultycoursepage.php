<?php
session_start();
require('connection.php');

if(!isset($_SESSION["email"]) or $_SESSION['usertype']!='faculty')
header('location:index.php');

$email = $_SESSION["email"];
if (isset ($_POST["course_id"]))
{
    $_SESSION['course_id'] = $_POST["course_id"];
}

$course_id = $_SESSION['course_id'];
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
    <title>Course - BrainFirst</title>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

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
		border:1px solid #e4e7ea;
		border-radius:0;
		box-shadow:none;
		color:#565656;
		font-size: 16px;
    	font-family: Rubik,sans-serif;
		height:auto;
        width: 80%;
		max-width:80%;
		padding:7px 12px;
		line-height: 1.5;
		text-transform: none;
		font-weight: 400;
		transition:all 300ms linear 0s;
        display: inline-block;
	}

	.course-name
	{
		color: rgba(0,0,0,.5);
		font-weight: 0;
		margin-top: 6px;
		line-height: 22px;
    	font-size: 24px;
    	font-family: Rubik,sans-serif;
    	text-align: center;
    	margin-right: 0px;
	    margin-bottom: 10px;
	    margin-left: 0px;
        display: inline-block;
	    /*text-transform: uppercase;*/
	}

    .myButton {
      border-radius: 40px;
      background-color: white; 
      color: black; 
      border: 2px solid #3399FF;
      font-family: Rubik,sans-serif;
      font-size: 16px;
      width: 140px;
      height: 40px;
      padding: 7px;
      cursor: pointer;
      margin-right: : 25px;
      vertical-align:middle; 
      float: right;
    }

    .myButton:hover {
        background-color: #3399FF;
        box-shadow: 0 6px 12px 0 rgba(0,0,0,0.2), 0 4px 16px 0 rgba(0,0,0,0.19);
        color: white;
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
                        <form role="search" class="app-search hidden-xs" method="post" action="faculty_searchcourses.php">
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
                        <a href="facultyhome.php" class="waves-effect"><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i><span class="hide-menu">Back to Dashboard</span></a>
                    </li>
                    <li>
                        <a href="" class="waves-effect"><i class="fa fa-home fa-fw" aria-hidden="true"></i><span class="hide-menu">Course Home</span></a>
                    </li>
                    <li>
                        <a href="faculty_content.php" class="waves-effect"><i class="fa fa-file fa-fw" aria-hidden="true"></i><span class="hide-menu">Content</span></a>
                    </li>
                    <li>
                        <a href="facultyquiz.php" class="waves-effect"><i class="fa fa-check fa-fw" aria-hidden="true"></i><span class="hide-menu">Quiz</span></a>
                    </li>
                    <li>
                        <a href="facultyassignment.php" class="waves-effect"><i class="fa fa-edit fa-fw" aria-hidden="true"></i><span class="hide-menu">Assignments</span></a>
                    </li>
                    <li>
                        <a href="facultydiscussionforum.php" class="waves-effect"><i class="fa fa-question fa-fw" aria-hidden="true"></i><span class="hide-menu">Discussion Forum</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->

	<!-- PHP Logic -->
	<?php 
		  $q = "select faculty_fname,faculty_lname from faculty,course where (course.course_id='$course_id' AND faculty.faculty_id=course.faculty_id)";
        	$result = mysqli_query($con, $q);
        	$rows = mysqli_fetch_array($result);
        	$faculty_fname = $rows["faculty_fname"];
        	$faculty_lname = $rows["faculty_lname"];
        	$q = "select * from course where course_id='$course_id'";
        	$result = mysqli_query($con, $q);
        	$rows = mysqli_fetch_array($result);
		$course_name = $rows["course_name"];
        	$start_date = $rows["start_date"];
        	$end_date = $rows["end_date"];
        	$about = $rows["about"];
        	$syllabus_path = $rows["syllabus_path"];
	?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title" style="text-align: center;">
                    <h4 class="course-name"><?php echo $course_name;?></h4> 
                    <!-- /.col-lg-12 -->
                </div>	
	
                <div class="row">
			         <div class="col-md-12">
                        <div class="white-box" style="padding:50px">
                            <h3 class="title" style="display: inline-block;">Course Details</h3>
                            <button id="5" class="myButton" onclick="edit()"><span>Edit Details</span></button><br>
                            <h4 >Faculty</h4>
                            <p class="field"><?php echo $faculty_fname." ".$faculty_lname;?></p><br>
                            <h4 >About</h4>
                            <textarea id="about_text" cols=100 rows=8 readonly="" class="field" style="overflow: auto;"><?php echo $about;?></textarea>
                                <button id="1" style="visibility: hidden;" onclick="about()" class="myButton"><span>Edit </span></button><br><br>
                            <h4 >Start Date</h4>
                            <p contenteditable="false" id="start_date" class="field"><?php echo $start_date;?></p>
                                <button id="2" style="visibility: hidden;" onclick="start_date()" class="myButton"><span>Edit Start Date</span></button><br><br>
                            <h4 >End Date</h4>
                            <p contenteditable="false" id="end_date" class="field"><?php echo $end_date;?></p>
                                <button id="3" style="visibility: hidden;" onclick="end_date()" class="myButton"><span>Edit End Date</span></button><br><br>
                            <h4 >Syllabus</h4>
                            <p id="syllabus" class="field"><a href=<?php echo $syllabus_path;?> target="_blank">Syllabus</a></p>
                                <button id="4" onclick="syllabus()" class="myButton" style="visibility: hidden;"><span>Change syllabus </span></button><br><br>
                            <div style="text-align: center;">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- /.container-fluid -->
            <!--footer class="footer text-center"> Footer </footer-->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script type="text/javascript">
        function edit() {
            //alert();
            var x = document.getElementById("1");
            if(x.style.visibility === "hidden")
            {
                document.getElementById("1").style.visibility = "visible";
                document.getElementById("2").style.visibility = "visible";
                document.getElementById("3").style.visibility = "visible";
                document.getElementById("4").style.visibility = "visible";
            }
            else
            {
                document.getElementById("1").style.visibility = "hidden";
                document.getElementById("2").style.visibility = "hidden";
                document.getElementById("3").style.visibility = "hidden";
                document.getElementById("4").style.visibility = "hidden";  
            }
            var b = document.getElementById("5");
            if(b.innerText == "Edit Details")
            {
                b.innerText = "Done";
            }
            else
            {
                b.innerText = "Edit Details";
                var about = document.getElementById("about_text").value;
                var start_date = document.getElementById("start_date").innerHTML;
                var end_date = document.getElementById("end_date").innerHTML;
                //alert(start_date);
                var syllabus = document.getElementById("syllabus").value;
                var course_id = <?php echo $course_id?>;
                $.ajax({
                    type: "POST",
                    url: "updatecoursedetails.php" ,
                    data: { about: about, course_id: course_id, start_date: start_date, end_date: end_date, syllabus: syllabus},
                    success : function() { 
                    location.reload();

                }
            });
            }
        }

        function about() {
            //alert();
            var text = document.getElementById("about_text");
            text.readOnly = false;
            text.focus();
        }

        function start_date() {
            document.getElementById("start_date").contentEditable = "true";
            document.getElementById("start_date").focus();
        }

        function end_date() {
            document.getElementById("end_date").contentEditable = "true";
            document.getElementById("end_date").focus();
        }

        function syllabus() {

        }
    </script>
</body>

</html>
