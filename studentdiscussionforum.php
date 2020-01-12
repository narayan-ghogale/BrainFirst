<?php
session_start();
require("connection.php");
if(!isset($_SESSION["email"]) or $_SESSION['usertype']!='student')
header('location:index.php');
$email = $_SESSION["email"];
$course_id = $_SESSION['course_id'];
$student_id = $_SESSION['student_id'];
$q = "select course_name from course where course_id='$course_id'";
$result = mysqli_query($con, $q);
$row = mysqli_fetch_array($result);
$course_name = $row['course_name'];

if(isset($_POST['question']))
{
    $question = $_POST['question'];
    $q = "insert into discussion_forum_ques(course_id,student_id,question,post_time) values('$course_id','$student_id','$question',CURRENT_TIMESTAMP)";
    $result = mysqli_query($con, $q);
    echo '<script>
            document.getElementById("posted").style.display = "block";
        document.getElementById("have").innerText = "Still have a doubt ?";
            </script>';
}

if(isset($_POST['sort_option']))
{
    $sort = $_POST['sort_option'];
}
else
{
    $sort = "recent";
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
    <title>Discussion Fourm - BrainFirst</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="css/sidebar-nav.min.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
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
		padding:8px 12px 0px;
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
	  font-size: 16px;
	  width: 80px;
	  height: 35px;
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
        margin-top: 10px;
        margin-left: 20px;
        width: 75%;
        height: 100px;
    }

    .linkButton { 
     background: none;
     border: none;
     color: #0066ff;
     text-decoration: none;
     cursor: pointer; 
     display: inline-block;
    }

    select{
        height: 25px;
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
                        <a href="studentassignment.php" class="waves-effect"><i class="fa fa-edit fa-fw" aria-hidden="true"></i><span class="hide-menu">Assignments</span></a>
                    </li>
                    <li>
                        <a href="" class="waves-effect"><i class="fa fa-question fa-fw" aria-hidden="true"></i><span class="hide-menu">Discussion Forum</span></a>
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
                    <h4 class="course-name">Discussion Forum for <?php echo $course_name;?>&nbsp &nbsp</h4>
                </div>	
	
                <div class="row bg-title" style="margin-left: 10px; margin-right: 10px; margin-top:10px">
                    <h4 id="posted" style="text-align: center; color: green; display: none;">Your question was posted.</h4>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 id="have" class="course-name">Have a doubt ?</h4> 
                    </div><br><br>
                    <textarea id="question" placeholder="Ask your question..."></textarea><br><br>
                    <button class="myButton" style="margin-left: 25px" name="submit" onclick="postquestion()">Post</button><br>
                </div>

                <div class="row" style="padding:10px">
			         <div class="col-md-12">
                        <div class="white-box" style="padding:50px">
                            <h3 class="title" style="font-size: 22px; display: inline-block;">Questions Asked</h3>
                            <form method="POST" action="studentdiscussionforum.php" style="display: inline-block; float: right; margin-right: 40px">
                                <label style="font-size: 16px">Sort by</label> &nbsp &nbsp 
                                <select name="sort_option" onchange="this.form.submit();">
                                    <option id="recent" value="recent">Most Recent</option>
                                    <option id="answered" value="answered">Most Answered</option>
                                </select>
                            </form><br>
                            
                            <?php
                                if($sort == "recent")
                                {
                                    $q = "select * from discussion_forum_ques where course_id = '$course_id' ORDER BY post_time DESC";
                                }
                                else
                                {
                                    $q = "select * from discussion_forum_ques dq where course_id = '$course_id' ORDER BY (select count(answer) from discussion_forum_ans da where dq.course_id=da.course_id AND dq.thread_id=da.thread_id) DESC";
                                }
                                $result = mysqli_query($con, $q);
                                $ques_no=0;
                                while($row = mysqli_fetch_array($result))
                                {
                                    $ques_no++;
                                    $question = $row['question'];
                                    $thread_id = $row['thread_id'];
                                    $post_time = $row['post_time'];
                                    $q2 = "select count(answer) as no_of_ans from discussion_forum_ans where thread_id = '$thread_id' AND course_id = '$course_id'";
                                    $result2 = mysqli_query($con, $q2);
                                    $row2 = mysqli_fetch_array($result2);
                                    $no_of_ans = $row2['no_of_ans'];

                                    echo '<div class="field">';
                                        echo '<p style="font-size:17px">'.$ques_no.'. '.$question.'</p>';
                                        echo '<form action="thread.php" method="post" style="margin-bottom:0px"><input type = "hidden" name = "thread_id" value = '.$thread_id.'><p style="display:inline-block; font-size:15px">Answered by '.$no_of_ans.'</p>&nbsp &nbsp &nbsp &nbsp &nbsp';
                                        echo '<p style="display: inline-block; font-size: 15px">Posted on '.$post_time.'</p>&nbsp &nbsp &nbsp &nbsp &nbsp';
                                        echo '<button class="linkButton" type="submit">View thread</button></form>';
                                    echo '</div><br>'; 
                                }

                            ?>
                                                               
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
    <script type="text/javascript">
        function postquestion() {
            var question = document.getElementById("question").value;
            if(question == "")
                alert("Question cannot be empty");
            else
            {
                $.ajax({
                    type: "POST",
                    url: "studentdiscussionforum.php" ,
                    data: {question: question},
                    success : function() { 
                        alert("Your question was posted");
                        location.reload();

                }
                });
            }               
        }

        //document.getElementById("posted").style.display = "block";
        //document.getElementById("have").innerText = "Still have a doubt ?";

        var sort = "<?php echo $sort?>";
        if(sort == "recent")
        {
            document.getElementById("recent").selected = true;
        }
        else
        {
            document.getElementById("answered").selected = true;
        }
    </script>
</body>

</html>
