<?php
session_start();
require('connection.php');

$con = mysqli_connect($servername, $username, $password, $dbname);
if(!isset($_SESSION["email"]))
header('location:index.php');

$email = $_SESSION['email'];
$course_id = $_SESSION["course_id"];
$q = "select course_name from course where course_id='$course_id'";
$result = mysqli_query($con, $q);
$rows = mysqli_fetch_array($result);
$course_name = $rows['course_name'];

$q = "SELECT student_id FROM student WHERE email='$email' ";
$result = mysqli_query($con, $q);
$rows = mysqli_fetch_array($result);
$student_id = $rows['student_id'];
$_SESSION['student_id'] = $student_id;
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
    <title>Assignment - BrainFirst</title>
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

    .linkButton { 
     background: none;
     border: none;
     color: #0066ff;
     text-decoration: none;
     cursor: pointer; 
    }

    .myBox {
        padding:50px; 
        background: white;
        height: auto;
        overflow: auto;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: center;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
        background-color: #85B4D2;
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
                        <a href="studenthome.php" class="waves-effect"><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i><span class="hide-menu">Back to Dashboard</span></a>
                    </li>
                    <li>
                        <a href="studentcoursepage.php" class="waves-effect"><i class="fa fa-home fa-fw" aria-hidden="true"></i><span class="hide-menu">Course Home</span></a>
                    </li>
                    <li>
                        <a href="student_content.php" class="waves-effect"><i class="fa fa-file fa-fw" aria-hidden="true"></i><span class="hide-menu">Content</span></a>
                    </li>
                    <li>
                        <a href="studentquiz.php" class="waves-effect"><i class="fa fa-check fa-fw" aria-hidden="true"></i><span class="hide-menu">Quiz</span></a>
                    </li>
                    <li>
                        <a href="" class="waves-effect"><i class="fa fa-edit fa-fw" aria-hidden="true"></i><span class="hide-menu">Assignments</span></a>
                    </li>
                    <li>
                        <a href="studentdiscussionforum.php" class="waves-effect"><i class="fa fa-question fa-fw" aria-hidden="true"></i><span class="hide-menu">Discussion Forum</span></a>
                    </li>
                    <li>
                        <a href="studentgrade.php" class="waves-effect"><i class="fa fa-line-chart fa-fw" aria-hidden="true"></i><span class="hide-menu">Grades</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title" style="text-align: center;">
                    <h4 class="course-name" style="font-size: 22px">Assignments for <?php echo $course_name;?></h4> 
                    <!-- /.col-lg-12 -->
                </div>

                <!--Pendng assignments -->
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="course-name">Pending Assignments </h4> </div>
                    <!-- /.col-lg-12 -->
                </div>

                <div class="row" style="padding:10px">
                    <?php
                        $q = "select * from assignment_ques where (course_id='$course_id' AND due_date>CURRENT_TIMESTAMP AND assignment_id NOT IN(SELECT assignment_id FROM assignment_ans WHERE student_id = '$student_id'))";
                        $result = mysqli_query($con, $q);
                        $num = mysqli_num_rows($result);
                        if($num == 0)
                        {
                            echo '<div class="white-box">
                                <p class="field">No Pending Assignments</p> </div>';
                        }
                        while($rows = mysqli_fetch_array($result))
                        {
                            $about_assignment = $rows['about_assignment'];
                            echo '<div class="col-md-12">';
                            echo '<div class="white-box" style="padding:30px">
                            <h3 class="title" style="display:inline-block;"><form action="answerassignment.php" method="post"><input type = "hidden" name = "assignment_id" value = '.$rows["assignment_id"].'><button class="linkButton" type="submit" >'.$about_assignment.'</button></form></h3>
                            <form action="answerassignment.php" method="post"><input type = "hidden" name = "assignment_id" value = '.$rows["assignment_id"].'><button class="myButton" style="vertical-align:middle; float:right;" type="submit" ><span>Answer </span></button></form>
                            <p class="field">Due Date : '.$rows["due_date"].'</p> </div>
                            </div>';
                        }                       
                    ?>
                </div>

                <!--Recent assignments -->
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="course-name" style="width: 300px">Submitted Assignments </h4> </div>
                    <!-- /.col-lg-12 -->
                </div>
                
                <div class="row" style="padding:10px">
                	<div class="myBox" >
                    <?php
                        $q = "select * from assignment_ans aa,assignment_ques aq where aa.student_id = '$student_id' AND aa.assignment_id=aq.assignment_id AND aq.course_id = '$course_id'";
                        $result = mysqli_query($con, $q);
                        $num = mysqli_num_rows($result);
                        if($num == 0)
                        {
                            echo '<div class="white-box">
                                <p class="field">No Recent Assignments submitted</p> </div>';
                        }
                        else
                        {
                        	echo '<table>';
                                echo '<caption style="text-align: center; font-size: 20px">Your Performances</caption>';
                                echo '<tr>
                                    <th>Assignment</th>
                                    <th>Your Grade</th>
                                </tr>';
                            while($row = mysqli_fetch_array($result))
                            {
                                $about_assignment = $row['about_assignment'];
                                echo '<tr>
                                    <td>'.$about_assignment.'</td>
                                    <td>'.$row["grade"].'</td>
                                </tr>';
                                                                              
                            }
                            echo '<tr>';
                            echo '</table><br><br><br>';
                        }                                          
                    ?>
                </div>
            </div>

            <!-- /.container-fluid -->
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

    <!--script type="text/javascript">
        function form_submit() {
            document.getElementById("form_id").submit();// Form submission
        }
    </script-->
</body>

</html>
