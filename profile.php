<?php
    session_start();
require('connection.php');
if(!isset($_SESSION["email"]))
header('location:index.php');

$usertype = $_SESSION['usertype'];
$email = $_SESSION['email'];
if(isset($_POST['fname']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $about_yourself = $_POST['about_yourself'];
    $university = $_POST['university'];
    if($usertype == "student")
        $q = "update student set student_fname='$fname', student_lname='$lname', about_yourself='$about_yourself', university='$university' where email = '$email'";
    else
        $q = "update faculty set faculty_fname='$fname', faculty_lname='$lname', about_yourself='$about_yourself', university='$university' where email = '$email'";
    $result = mysqli_query($con, $q);

    $q = "update login_info set password='$password' where email = '$email'";
    $result = mysqli_query($con, $q);
}
else
{
    if($usertype == "student")
    {
        $q = "select * from student where email = '$email'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_array($result);
        $fname = $row['student_fname'];
        $lname = $row['student_lname'];
    }
    else
    {
        $q = "select * from faculty where email = '$email'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_array($result);
        $fname = $row['faculty_fname'];
        $lname = $row['faculty_lname'];
    }

    $q1 = "select password from login_info where email = '$email'";
    $result1 = mysqli_query($con, $q1);
    $row1 = mysqli_fetch_array($result1);
    $password = $row1['password'];
    $about_yourself = $row['about_yourself'];
    $university = $row['university'];
}

?>

<!DOCTYPE html>
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
    <title>Profile - BrainFirst</title>
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
                <ul class="nav navbar-top-links navbar-right pull-right" >
                    <li>
                        <a href="logout.php"><b class="hidden-xs">Log Out</b></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li style="padding: 10px 0 0;">
                        <a href="<?php echo $usertype;?>home.php" class="waves-effect"><i class="fa fa-clipboard fa-fw" aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                    </li>
                    <?php 
                    	if($_SESSION['usertype']=='faculty')
                    	{
                    		echo '<li>
                        		<a href="coursecreate.php" class="waves-effect"><i class="fa fa-plus fa-fw" aria-hidden="true"></i><span class="hide-menu">Add Course</span></a>
                    			</li>';
                    	}
                    ?>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Profile page</h4> </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box" style="width: 270px">
                            <div class="user-bg" style="height: 240px"> <img width="100%" alt="user" src="img/profile.png">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box" style="margin-left: -40px; padding: 35px">
                            <form class="form-horizontal form-material">
                                <div class="form-group">
                                    <label class="col-md-12" style="font-size: 16px">First Name</label>
                                    <div class="col-md-12">
                                        <input type="text" id="fname" value="<?php echo $fname;?>" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" style="font-size: 16px">Last Name</label>
                                    <div class="col-md-12">
                                        <input type="text" id="lname" value="<?php echo $lname;?>" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12"  style="font-size: 16px">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" id="email" value="<?php echo $email;?>" class="form-control form-control-line" readonly> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" style="font-size: 16px">Password</label>
                                    <div class="col-md-12">
                                        <input type="password" id="password" value="<?php echo $password;?>" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" style="font-size: 16px">About Yourself</label>
                                    <div class="col-md-12">
                                        <textarea rows="4" placeholder="Something about yourself" id="about_yourself" class="form-control form-control-line"><?php echo $about_yourself;?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12" style="font-size: 16px">University</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Enter the name of the university you study/teach in" id="university" value="<?php echo $university;?>" class="form-control form-control-line"> </div>
                                </div><br>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button id="5" class="myButton" onclick="editprofile()"><span>Save Changes</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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
        function editprofile() {
            var fname = document.getElementById("fname").value;
            var lname = document.getElementById("lname").value;
            var password = document.getElementById("password").value;
            var about_yourself = document.getElementById("about_yourself").value;
            var university = document.getElementById("university").value;
            var usertype = "<?php Print $usertype;?>";

            $.ajax({
                    type: "POST",
                    url: "profile.php" ,
                    data: {fname: fname, lname: lname, password: password, about_yourself: about_yourself, university: university},
                    success : function() { 
                    location.reload();
                    alert("Your profile details are updated successfully.");
                }
            });
        }  
    </script>
</body>

</html>
