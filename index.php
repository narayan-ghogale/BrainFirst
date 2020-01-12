<?php

session_start();
require('connection.php');
if(isset($_SESSION['email']) && isset($_SESSION['usertype'])){
	header('location:'.$_SESSION["usertype"].'home.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if(isset($_POST['signin']))
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
		$password = $con->real_escape_string($password);
		$email = $con->real_escape_string($email);

		$q = "select * from login_info where email = '$email' && password = '$password'";

		$result = mysqli_query($con, $q);
		$num = mysqli_num_rows($result);

		echo "<script type='text/javascript'>alert('Successful!'); 
				</script>";
		if($num == 1) {
			$_SESSION["email"] = $email;
		    	$rows = mysqli_fetch_array($result);
			$_SESSION["usertype"] = $rows['usertype'];
		    if($_SESSION['usertype'] == 'student')
		    {
		        echo "<script type='text/javascript'>alert('Successful!'); 
				</script>";
		        header('location:studenthome.php');
		    }
		    else
		    {
		        header('location:facultyhome.php');
		    }
		}
		else {
			header('location:index.php');
		}
	}
}
?>


<html>
	<head>
		<!-- Site Title -->
		<title>BrainFirst</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.css">	
		<link rel="stylesheet" href="css/main.css">
		<style type="text/css">
		input[type=text] {
            width: 180px;
            height: 35px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            padding: 12px 20px 12px 30px;
            background-image: url('img/search-icon.png');
            background-position: 5px 0px; 
            background-repeat: no-repeat;
            transition: width 0.4s ease-in-out;
		}
        input[type=email]{
            height: 32px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 13px;
            padding: 2px;
            padding-left: 5px;
        }
        input[type=password]{
            height: 32px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 13px;
            padding: 2px;
            padding-left: 5px;
        }
	    input[type=text]:focus {
	       width: 60%;
		}
	    </style>
	</head>
	<body>	
          
		<header id="header" id="home">
		  	<div class="header-top">
		  		<div class="container">
			  		<div class="row">
			  			<div class="col-lg-6">
					      	<!--div>
								<input type="text" name="search" placeholder="Search Courses">&nbsp &nbsp
								<a class="btn btn-default squire" style="border-color:#D1AB7F; height:35px;" href="searchedcourses.php">Search</a>
							</div-->	    				  					
				  			</div>
				  			<div class="col-lg-6 col-sm-6 col-8 header-top-right no-padding">
							<form method="post" action="index.php">
								<input type="email" placeholder="Enter email-id" name="email" required>&nbsp &nbsp
								<input type="password" placeholder="Enter password" name="password" required>&nbsp
                                <button class="btn btn-default" type=submit" name="signin" >Sign In</button>
								<a class="btn btn-default" href="register.php">Register</a>
							</form>		
				  			</div>
				  		</div>			  					
		  			</div>
				</div>
			  </header><!-- #header -->

			<!-- start banner Area -->
			<section  class= "banner-area relative" id="home">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url(img/banner1dark.jpg)">
            <!--<div class="carousel-caption d-none d-md-block"
              <h1>BrainFirst</h1>
              <p>A revolution in learning, the evolution of you.</p>
            </div>--><br><br><br><br><br><br><br>
            <div class="banner-content col-lg-02 col-md-02 justify-content-center"><br>
							<h1>
								<img src='img/bn2.png'></img>			
							</h1>
							<h6 style="font-size: 17px" class="text-uppercase">A revolution in learning, the evolution of you.</h6><br>
							<a href="register.php" class="primary-btn squire text-uppercase mt-10"> &nbsp Get Started &nbsp </a>
						</div>											
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url(img/banner2.jpg)">
            <div class="carousel-caption d-none d-md-block justify-content-center">
              <h1 class="banner content h1">Quality Learning</h1>
              <p>professors across the globe to help you learn variety of subjects</p>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url(img/banner3.jpg)">
            <div class="carousel-caption d-none d-md-block">
              <h1 class="banner content h1" >Learning made simple</h1>
              <p>All university students welcomed </p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
			</section>
			<!-- End banner Area -->

			

			<!-- Start features Area -->
			<section class="item-category-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="col-md-12 pb-80 header-text text-center">
							<h1 class="pb-10">Features of BrainFirst</h1>
						</div>
					</div>								
					<div class="row">
						<div class="col-lg-3 col-md-6">
							<div class="single-cat-item">
								<div class="thumb">
									<img class="img-fluid" src="img/learning.jpg" alt="">
								</div>	
								<h4>Quality Learning</h4></a>
								<p>
									Digital curricula can be easily given to students, which is more fun for them. When interacting with digital activities, students often don't perceive it as 'work.' BrainFirst makes it possible to achieve higher student motivation through online tools and class activities. 
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="single-cat-item">
								<div class="thumb">
									<img class="img-fluid" src="img/evaluation.jpg" alt="">
								</div>	
								<h4>Easy Evaluation</h4></a>
								<p>
									Faculty can now create assignments and quizzes for students. They can set due dates for assignments and active time for quizzes. After submission of assignments and quizzes from students, faculty can easily grade them.
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="single-cat-item">
								<div class="thumb">
									<img class="img-fluid" src="img/discussion-forum.jpg" alt="">
								</div> 	
								<h4>Discussion Forum</h4></a>
								<p>
									BrainFirst provides an interactive forum for students to post their doubts and queries. Each course has its own discussion forum where students can post queries about that course which will be answered by other students or the faculty itself. 
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="single-cat-item">
								<div class="thumb">
									<img class="img-fluid" src="img/courses_logo.jpg" alt="">
								</div>	
								<h4>In-demand Courses</h4></a>
								<p>
									BrainFirst provides a large variety of most in-demand courses. On BrainFirst, students can enroll in any course which may not be in his/her curriculum. BrainFirst also provides a certificate of completion after successfully completing the course.
								</p>
							</div>
						</div>															
					</div>
				</div>	
			</section>
			<!-- End features Area -->

			
			<!-- start footer Area -->		
			<footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-5 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>About Us</h6>
								<p>
									BrainFirst is a platform that allows educators to create online classes whereby they can store the course materials online; manage assignments, quizzes and exams; monitor due dates; grade results and provide students with feedback all in one place.
								</p>							
							</div>
						</div>
						<div class="col-lg-5  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Contact Us</h6>
								<p>For any query</p>
								<div class="" id="mc_embed_signup">
										<input class="form-control" name="QUERY" placeholder="Your Query" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Query'" required="" type="text"><br>
			                            	<button class="click-btn" style="border-radius: 4px; color:white;"><i class="lnr lnr-arrow-right" aria-hidden="true"><a style="color: white;" href="mailto:contact@brainfirst.com">Submit</a></i></button>
										<div class="info"></div>
								</div>
							</div>
						</div>	
						<div class="col-lg-12">
							<p class="footer-text">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </p>								
						</div>						
					</div>
				</div>
			</footer>	
			<!-- End footer Area -->	

			<script src="js/jquery/jquery-3.2.1.min.js"></script>
			<script src="js/bootstrap/bootstrap.min.js"></script>			
			<script src="js/main.js"></script>	
		</body>
	</html>
