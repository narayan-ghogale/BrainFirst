<?php
    session_start();
require('connection.php');

if(!isset($_SESSION["email"]) or $_SESSION['usertype']!='faculty')
header('location:index.php');

$email = $_SESSION['email'];
$q = "select faculty_id,faculty_fname,faculty_lname from faculty where email='$email'";
$result = mysqli_query($con, $q);
$rows = mysqli_fetch_array($result);
$faculty_id = $rows['faculty_id'];
$_SESSION['faculty_id'] = $faculty_id;
$faculty_fname = $rows['faculty_fname'];
$faculty_lname = $rows['faculty_lname'];
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
    <title>Home - BrainFirst</title>
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

    .linkButton { 
     background: none;
     border: none;
     color: #0066ff;
     text-decoration: none;
     cursor: pointer; 
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
                <div class="top-left-part"><a class="logo"><b><img src="img/25.png" alt="home"></a></div>
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
                        <a href="" class="waves-effect"><i class="fa fa-clipboard fa-fw" aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="profile.php" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                    </li>
                    <li>
                        <a href="coursecreate.php" class="waves-effect"><i class="fa fa-plus fa-fw" aria-hidden="true"></i><span class="hide-menu">Add Course</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title" style="text-align: center;">
                    <h4 class="course-name" style="font-size: 22px">Welcome <?php echo $faculty_fname.' '.$faculty_lname;?></h4> 
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="course-name">Active Courses </h4> </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row" style="padding:10px">
                    <?php
        			$email = $_SESSION['email'];
        			$date = date('Y-m-d');
        			$q = "select course_name,about,course.course_id from course where (course.faculty_id='$faculty_id' AND end_date>='$date')";
        			$result = mysqli_query($con, $q);
        			$num = mysqli_num_rows($result);
                    if($num == 0)
                    {
                        echo '<div class="white-box">
                            <p class="field">No Active courses</p> </div>';
                    }
            		while($rows = mysqli_fetch_array($result))
            		{
            			$course_id = $rows["course_id"];
            			echo '<div class="col-md-12">';
                        echo '<div class="white-box" style="padding:30px">
                        <h3 class="title"><form action="facultycoursepage.php" method="post"><input type = "hidden" name = "course_id" value = '.$rows["course_id"].'><button class="linkButton" type="submit">'.strtoupper($rows["course_name"]).'</button></form></h3>
                        <p class="field">'.$rows["about"].'</p> </div>
                        </div>';
            			} 
        		    ?>
                    
                </div>
            </div>
            <!-- /.container-fluid -->
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="course-name">Inactive Courses </h4> </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row" style="padding:10px">
                    <?php
                    $date = date('Y-m-d');
                    $q = "select course_name,about,course_id from course where (course.faculty_id='$faculty_id' AND end_date<'$date')";
                    $result = mysqli_query($con, $q);
                    $num = mysqli_num_rows($result);
                    if($num == 0)
                    {
                        echo '<div class="white-box">
                            <p class="field">No Inactive courses</p> </div>';
                    }
                    while($rows = mysqli_fetch_array($result))
                    {
                        $course_id = $rows["course_id"];
                        echo '<div class="col-md-12">';
                        echo '<div class="white-box" style="padding:30px">
                            <h3 class="title"><form action="facultycoursepage.php" method="post"><input type = "hidden" name = "course_id" value = '.$rows["course_id"].'><button class="linkButton" type="submit">'.strtoupper($rows["course_name"]).'</button></form></h3>
                        <p class="field">'.$rows["about"].'</p> </div>
                        </div>';
                    }
                    ?>
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

    <script type="text/javascript">
        function form_submit() {
            document.getElementById("form_id").submit();// Form submission
        }
    </script>
</body>

</html>
