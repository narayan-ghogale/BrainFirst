<?php
    session_start();
require('connection.php');
if(!isset($_SESSION["email"]) or $_SESSION['usertype']!='student')
header('location:index.php');
if(isset($_POST['search_term'])){
    $_SESSION['search_term'] = $_POST['search_term'];
}
$search_term = $_SESSION['search_term'];

$email = $_SESSION['email'];
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
    <title>Search - BrainFirst</title>
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
                        <a href="studenthome.php" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="profile.php" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                    </li><!--
                    <li>
                        <a href="basic-table.html" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><span class="hide-menu">Basic Table</span></a>
                    </li>
                    <li>
                        <a href="fontawesome.html" class="waves-effect"><i class="fa fa-font fa-fw" aria-hidden="true"></i><span class="hide-menu">Icons</span></a>
                    </li>
                    <li>
                        <a href="map-google.html" class="waves-effect"><i class="fa fa-globe fa-fw" aria-hidden="true"></i><span class="hide-menu">Google Map</span></a>
                    </li>
                    <li>
                        <a href="blank.html" class="waves-effect"><i class="fa fa-columns fa-fw" aria-hidden="true"></i><span class="hide-menu">Blank Page</span></a>
                    </li>
                    <li>
                        <a href="404.html" class="waves-effect"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i><span class="hide-menu">Error 404</span></a>
                    </li>-->
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title" style="text-align: center;">
                    <h4 class="course-name" style="font-size: 22px">Search Results for <?php echo $search_term; ?></h4> 
                    <!-- /.col-lg-12 -->
                </div>  
    
                <div class="row" style="padding:10px">
                    <?php
                    $email = $_SESSION['email'];
                    $q = "select course_name,about,course.course_id from course,student,course_enrolled where (student.email='$email' AND student.student_id=course_enrolled.student_id AND course_enrolled.course_id=course.course_id AND course_name LIKE '%$search_term%')";
                    $result = mysqli_query($con, $q);
                    while($rows = mysqli_fetch_array($result))
                    {
                        $course_id = $rows["course_id"];
                        echo '<div class="col-md-12" >';
                        echo '<div class="white-box" style="padding:30px">
                            <h3 class="title"><a href="studentcoursepage.php?course_id='.$rows["course_id"].'">'.$rows["course_name"].'</a></h3>
                            <p class="field">'.$rows["about"].'</p> </div>
                            </div>';
                    }
                    $q = "select course_name,about,course_id,start_date,end_date,syllabus_path from course where (course_id NOT IN (SELECT course.course_id FROM course,course_enrolled,student WHERE student.email='$email' AND student.student_id=course_enrolled.student_id AND course_enrolled.course_id=course.course_id) AND course_name LIKE '%$search_term%')";
                    $result = mysqli_query($con, $q);
                    while($rows = mysqli_fetch_array($result))
                    {
                        $course_id = $rows["course_id"];
                        echo '<div class="col-md-12" >';
                        echo '<div class="white-box" style="padding:30px">
                            <h3 class="title"><a href="studentcoursepage.php?course_id='.$rows["course_id"].'">'.$rows["course_name"].'</a></h3>
                            <p class="field">'.$rows["about"].'</p>
                            <p class="field">Start Date: '.$rows["start_date"].'</p>
                            <p class="field">End Date: '.$rows["end_date"].'</p> 
                            <a type="button" href='.$rows["syllabus_path"].' target="_blank">View Syllabus</a>
                            <form action="enroll.php" method="POST">
                            <input type = "hidden" name = "course_id" value = '.$rows["course_id"].'> 
                            <button type="submit" class="btn btn-info" style="float:right" >Enroll</button>
                            </div>
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
</body>

</html>
