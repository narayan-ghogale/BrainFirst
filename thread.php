<?php
session_start();
require("connection.php");
if(!isset($_SESSION["email"]))
header('location:index.php');
$email = $_SESSION["email"];
$course_id = $_SESSION['course_id'];
if(isset($_SESSION['student_id']))
{
    $user_id = $_SESSION['student_id'];
}
else
$user_id = $_SESSION['faculty_id'];
$q = "select course_name from course where course_id='$course_id'";
$result = mysqli_query($con, $q);
$row = mysqli_fetch_array($result);
$course_name = $row['course_name'];

$q = "select usertype from login_info where email = '$email'";
$result = mysqli_query($con, $q);
$row = mysqli_fetch_array($result);
$usertype = $row['usertype'];

if(isset($_POST['thread_id']))
{
    $thread_id = $_POST['thread_id'];
}

if(isset($_POST['answer']))
{
    $answer = $_POST['answer'];
    $q = "insert into discussion_forum_ans(course_id,thread_id,user_type,id,answer,post_time) values('$course_id','$thread_id','$usertype','$user_id','$answer',CURRENT_TIMESTAMP)";
    $result = mysqli_query($con, $q);
}
elseif(isset($_POST['edited_answer'])) 
{
    $answer = $_POST['edited_answer'];
    $q = "update discussion_forum_ans set answer = '$answer',post_time = CURRENT_TIMESTAMP where thread_id = '$thread_id' AND course_id = '$course_id' AND id = '$user_id'";
    $result = mysqli_query($con, $q);
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
    <title>Forum thread - BrainFirst</title>
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
		border:1px solid #e4e7ea;
		border-radius:0;
		box-shadow:none;
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
    	font-size: 22px;
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

    textarea{
        padding: 12px 20px;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        font-size: 16px;
        overflow: auto;
        margin-left: 30px;
        width: 85%;
        max-height: 150px;
        height: auto;
        margin-top: 5px;
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
                        <?php if($_SESSION['usertype']=='faculty'){
                            echo'<form role="search" class="app-search hidden-xs" method="post" action="faculty_searchcourses.php">
                            <input type="text" placeholder="Search..." class="form-control" name="search_term"> <a><i class="fa fa-search"></i></a>
                            </form>';
                        }
                        else{
                        echo'<form role="search" class="app-search hidden-xs" method="post" action="student_searchcourses.php">
                            <input type="text" placeholder="Search..." class="form-control" name="search_term"> <a><i class="fa fa-search"></i></a>
                            </form>';
                        }
                        ?>
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
                        <a href="<?php echo $usertype?>coursepage.php" class="waves-effect"><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i><span class="hide-menu">Back to Course Home</span></a>
                    </li>
                    <li>
                        <a href="<?php echo $usertype?>discussionforum.php" class="waves-effect"><i class="fa fa-question fa-fw" aria-hidden="true"></i><span class="hide-menu">Back to Forum</span></a>
                    </li>
                    <li>
                        <a href="" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Thread Page</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title" style="text-align: center;">
                    <h4 class="course-name">Forum thread on <?php echo $course_name;?>&nbsp &nbsp</h4>
                </div>	
	           
                <div class="row bg-title" style="margin-left: 10px; margin-right: 10px; padding: 30px">
                    <h3 class="title" style="font-size: 22px">Question</h3>
                        <div class="field" style="margin-left: 15px; margin-right: 15px">
                            <?php
                                $q = "select student_id,question,post_time from discussion_forum_ques where thread_id='$thread_id'";
                                $result = mysqli_query($con, $q);
                                $row = mysqli_fetch_array($result);
                                $question = $row['question'];
                                $student_id = $row['student_id'];
                                $post_time = $row['post_time'];

                                $q2 = "select student_fname,student_lname from student where student_id='$student_id'";
                                $result2 = mysqli_query($con, $q2);
                                $row2 = mysqli_fetch_array($result2);
                                $student_fname = $row2['student_fname'];
                                $student_lname = $row2['student_lname'];
                                echo '<p style="font-size:17px">'.$question.'</p>';
                            ?>
                        </div><br>
                        <p style="font-size: 15px; display: inline-block;">Posted by <?php echo $student_fname.' '.$student_lname?></p>&nbsp &nbsp &nbsp &nbsp
                        <p style="font-size: 15px; display: inline-block;">On <?php echo $post_time?></p>
                </div>

                <div class="row">
            	   <div class="col-md-12">
                        <div class="white-box" style="padding:40px; margin-left: 10px; margin-right: 10px">
                            <?php 
                                $q2 = "select count(answer) as no_of_ans from discussion_forum_ans where thread_id = '$thread_id' AND course_id = '$course_id'";
                                $result2 = mysqli_query($con, $q2);
                                $row2 = mysqli_fetch_array($result2);
                                $no_of_ans = $row2['no_of_ans'];
                            ?>
                            <h3 class="title" style="font-size: 22px"><?php echo $no_of_ans;?> Answers</h3>
                            <hr>
                            <?php
                                if($usertype == "student")
                                {
                                    $q = "select answer,post_time from discussion_forum_ans where thread_id='$thread_id' AND user_type='faculty' AND course_id = '$course_id'";
                                    $result = mysqli_query($con, $q);
                                    $num = mysqli_num_rows($result);
                                    echo '<h3 class="title" style="font-size: 18px">Faculty answer</h3>';
                                    if($num == 1)
                                    {
                                        $row = mysqli_fetch_array($result);
                                        $answer = $row['answer'];
                                        echo '<textarea readonly>'.$answer.'</textarea><br><br>';
                                        echo '<p style="font-size: 15px; display: inline-block;">Posted on '.$post_time.'</p><hr>';
                                    }
                                    else
                                    {
                                        echo "<h3 style='font-size:16px'>Faculty didn't post any answer yet. Try your luck!</h3><hr>";
                                    }
                                }
                                echo "<h3 class='title' style='font-size: 18px'>Other students' answers</h3>";
                                if($usertype == "student")
                                    $q = "select id,answer,post_time from discussion_forum_ans where thread_id='$thread_id' AND user_type='student' AND course_id = '$course_id' AND id<>'$user_id' ORDER BY post_time DESC";
                                else
                                    $q = "select id,answer,post_time from discussion_forum_ans where thread_id='$thread_id' AND user_type='student' AND course_id = '$course_id' ORDER BY post_time DESC";
                                $result = mysqli_query($con, $q);
                                while($row = mysqli_fetch_array($result))
                                {
                                    $ans = $row['answer'];
                                    $id = $row['id'];
                                    $time = $row['post_time'];
                                    $q2 = "select student_fname,student_lname from student where student_id='$id'";
                                    $result2 = mysqli_query($con, $q2);
                                    $num = mysqli_num_rows($result2);
                                    if($num == 1)
                                    {
                                        $row2 = mysqli_fetch_array($result2);
                                        $fname = $row2['student_fname'];
                                        $lname = $row2['student_lname'];
                                        echo '<p style="font-size: 15px; display: inline-block;">Posted by '.$fname.' '.$lname.'</p><br>';
                                        echo '<textarea readonly>'.$ans.'</textarea><br><br>';
                                        echo '<p style="font-size: 15px; display: inline-block;">Posted on '.$time.'</p><hr>';
                                    }
                                    
                                }
                                $num = mysqli_num_rows($result);
                                if($num == 0)
                                {
                                    echo "<h3 style='font-size:16px'>Other students didn't post any answer to this question yet.</h3><hr>";
                                }
                                ?>
                            </div>
                   </div> 
                </div>
                            <?php
                                $q3 = "select answer,post_time from discussion_forum_ans where thread_id='$thread_id' AND id = '$user_id' AND course_id = '$course_id' AND user_type = '$usertype'";
                                $result3 = mysqli_query($con, $q3);
                                $num = mysqli_num_rows($result3);
                                if($num == 1)
                                {
                                    $row3 = mysqli_fetch_array($result3);
                                    $your_ans = $row3['answer'];
                                    $post_time = $row3['post_time'];
                                    echo '<div class="row bg-title" style="margin-left: 10px; margin-right: 10px; padding: 30px">';
                                    echo '<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12" style="margin-left:0px">
                                            <h4 id="have" class="course-name">Your Answer</h4> 
                                        </div><br><br>
                                        <textarea id="answer" name="editanswer">'.$your_ans.'</textarea><br><br>
                                        <p style="font-size: 15px;">Posted on '.$post_time.'</p>
                                        <button class="myButton" style="margin-left: 25px" name="edit" onclick="postanswer(this)">Edit</button>
                                    </div>';
                                }
                                else
                                {
                                    echo '<div class="row bg-title" style="margin-left: 10px; margin-right: 10px; margin-top:10px">';
                                    echo '<h4 style="text-align: center; color: green; display: none;">Your question was posted.</h4>
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12" style="margin-left:0px">
                                            <h4 class="course-name" style="width:170%">Know answer to this question ?</h4> 
                                        </div><br><br>
                                        <textarea id="answer" name="postanswer" placeholder="Your Answer..." style="height:150px"></textarea><br><br>
                                        <button class="myButton" style="margin-left: 25px" name="submit" onclick="postanswer(this)">Post</button><br>
                                    </div>';
                                }
                            ?>
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
        function postanswer(element) {
            var name = element.name;
            var answer = document.getElementById("answer").value;
            var thread_id = "<?php Print($thread_id)?>";
            if(name == "submit")
            {
                $.ajax({
                    type: "POST",
                    url: "thread.php" ,
                    data: {answer: answer, thread_id: thread_id},
                    success : function() { 
                        alert("Your answer was posted");
                    location.reload();
                    }
                });
            }
            else
            {
                $.ajax({
                    type: "POST",
                    url: "thread.php" ,
                    data: {edited_answer: answer, thread_id: thread_id},
                    success : function() { 
                        alert("Your answer was edited");
                    location.reload();

                }
                });
            }
        }

        //document.getElementById("posted").style.display = "block";
        //document.getElementById("have").innerText = "Still have a doubt ?";
        
                
    </script>
</body>

</html>
