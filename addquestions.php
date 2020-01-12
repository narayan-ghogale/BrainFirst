<?php
session_start();

require('connection.php');

$con = mysqli_connect($servername, $username, $password, $dbname);
if(!isset($_SESSION["email"]) or $_SESSION['usertype']!='faculty')
header('location:index.php');

$email = $_SESSION['email'];
$course_id = $_SESSION["course_id"];
$q = "select course_name from course where course_id='$course_id'";
$result = mysqli_query($con, $q);
$rows = mysqli_fetch_array($result);
$course_name = $rows['course_name'];

if(isset($_POST['addquiz']))
{
    $questionNumber = 0;
    $about_quiz = $_POST["about_quiz"];
    $starttime = $_POST["starttime"];
    $endtime = $_POST["endtime"];
    $no_of_questions = $_POST["no_of_questions"];
    $_SESSION['no_of_questions'] = $no_of_questions;

    $q = "insert into quiz_info(course_id,about_quiz,start_timestamp,end_timestamp) values('$course_id','$about_quiz','$starttime','$endtime');";
    $result = mysqli_query($con, $q);

    $q = "select quiz_id from quiz_info where course_id='$course_id' AND start_timestamp='$starttime' AND end_timestamp='$endtime' AND about_quiz='$about_quiz'";
    $result = mysqli_query($con, $q);
    $rows = mysqli_fetch_array($result);
    $quiz_id = $rows['quiz_id'];
    $_SESSION['quiz_id'] = $quiz_id;
}

if(isset($_POST['addquestions']))
{
    $quiz_id = $_SESSION['quiz_id'];
    $questionNumber = $_POST['questionNumber'];
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_ans = $_POST['correct_ans'];
    $q = "insert into quiz_ques(quiz_id,ques_num,question,option_a,option_b,option_c,option_d,correct_answer) values('$quiz_id','$questionNumber','$question','$option_a','$option_b','$option_c','$option_d','$correct_ans')";
    $result = mysqli_query($con, $q);
    if($questionNumber==$_SESSION['no_of_questions'])
    {
        echo '<script>alert("All Questions added!");</script>';
        header('location:facultycoursepage.php');
    }
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
        <link rel="stylesheet" href="css/addquesform.css">

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
                        <a href="facultyquiz.php" class="waves-effect"><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i><span class="hide-menu">Back to Quiz Page</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title" style="text-align: center;">
                            <h3 class="title" style="display: inline-block;">Add <?php echo $_SESSION['no_of_questions'];?> questions</h3>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row" style="padding:10px">
                    <div class="col-md-12">
                            <?php 
                            $i=$questionNumber+1;
                            if($i<=$_SESSION['no_of_questions']) {
                                echo '
                              <form class="form" method="POST" enctype="multipart/form-data" action="'.$_SERVER["PHP_SELF"].'">
                              <p type="Question No."><input type="text" name="questionNumber" value="'.$i.'" readonly></input></p>
                              <p type="Question"><input placeholder="Enter question" type="text" name="question" required></input></p>
                              <p type="A:"><input placeholder="Enter option a" type="text" name="option_a" required></input></p>
                              <p type="B:"><input placeholder="Enter option b" type="text" name="option_b" required></input></p>
                              <p type="C:"><input placeholder="Enter option c" type="text" name="option_c" required></input></p>
                              <p type="D:"><input placeholder="Enter option d" type="text" name="option_d" required></input></p>
                                <p type="Correct Ans:"><select placeholder="Correct answer" name="correct_ans" required>
                                    <option value="a">a</option>
                                    <option value="b">b</option>
                                    <option value="c">c</option>
                                    <option value="d">d</option>
                                  </select>
                                  <br><br>
                                    <button type="submit" name="addquestions">Add this Question</button>  
                            </form>';
                                $i = $i+1;
                            }  
                            ?>
                            
                        
                    </div>
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

    <script type="text/javascript">
        function form_submit() {
            document.getElementById("form_id").submit();// Form submission
        }
    </script>
</body>

</html>
