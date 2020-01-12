<?php
session_start();
require('connection.php');
if(!isset($_SESSION["email"]) or $_SESSION['usertype']!='student')
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
    <title>Course Content - BrainFirst</title>
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

    .linkButton { 
     background: none;
     border: none;
     text-decoration: none;
     color: #0066ff;
     cursor: pointer; 
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
        <!-- PHP Logic -->
        <?php 
            $q = "select * from course where course_id='$course_id'";
            $result = mysqli_query($con, $q);
            $rows = mysqli_fetch_array($result);
            $course_name = $rows["course_name"];
        ?>
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
                        <a href="" class="waves-effect"><i class="fa fa-file fa-fw" aria-hidden="true"></i><span class="hide-menu">Content</span></a>
                    </li>
                    <li>
                        <a href="studentquiz.php" class="waves-effect"><i class="fa fa-check fa-fw" aria-hidden="true"></i><span class="hide-menu">Quiz</span></a>
                    </li>
                    <li>
                        <a href="studentassignment.php" class="waves-effect"><i class="fa fa-edit fa-fw" aria-hidden="true"></i><span class="hide-menu">Assignments</span></a>
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
                    <h4 class="course-name"><?php echo $course_name;?></h4> 
                    <!-- /.col-lg-12 -->
                </div>	
	           <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="course-name">Videos</h4> </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box" style="padding:20px">
                            <p style="padding: 10px;font-size: 18px;">Videos Uploaded </p>
                            <?php
                                $q = "select file_path from course_content where (course_id='$course_id' AND file_type='Video') ORDER BY time DESC";
                                $result = mysqli_query($con, $q);
                                $i=0;
                                while($rows = mysqli_fetch_array($result))
                                {
                                    $video_path = $rows["file_path"];
                                    $video_name = substr($video_path, strpos($video_path, "_") + 1);
                                    echo "<div style='padding-left:30px;'>";
                                    echo '<button class="linkButton" data-toggle="modal" data-target="#video'.$i.'" >'.$video_name.'</button>';
                                    echo "</div>";
                                    echo '<div id="video'.$i.'" class="modal fade" role="dialog">
                                              <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">'.$video_name.'</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <video width="868" height="490" controls>
                                                        <source src="'.$video_path.'" type="video/mp4">
                                                    </video>
                                                  </div>
                                                  <!--div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div-->
                                                </div>
                                              </div>';
                                    echo'</div>';
                                    $i++;
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="course-name">Documents</h4> </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box" style="padding:20px">
                            <p style="padding: 10px;font-size: 18px;">Documents Uploaded </p>
                            <?php
                                $q = "select file_path from course_content where (course_id='$course_id' AND file_type='Document') ORDER BY time DESC";
                                $result = mysqli_query($con, $q);
                                while($rows = mysqli_fetch_array($result))
                                {
                                    $doc_path = $rows["file_path"];
                                    $doc_name = substr($doc_path, strpos($doc_path, "_") + 1);
                                    echo "<div style='padding-left:30px;'>";
                                    echo "<a href=".$doc_path." target='_blank'>".$doc_name."</a>";
                                    echo "</div>";
                                }
                            ?>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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