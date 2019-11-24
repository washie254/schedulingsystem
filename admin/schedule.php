<?php 
include('server.php');
if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
unset($_SESSION['username']);
unset($_SESSION['id']);
	header("location: login.php");
}
?>

<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Scheduling App</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/colors/green.css" id="colors">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>
<div id="wrapper">


<!-- Header
================================================== -->
<header>
<div class="container">
	<div class="sixteen columns">
	
		<!-- Logo -->
		<div id="logo">
			<h1><a href="index.html"><img src="images/logo.png" alt="Work Scout" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">
				<li><a href="index.php">Home</a></li>
				<li><a href="doctors.php">Specialist</a></li>
				<li><a href="clients.php">Clients</a></li>
				<li><a href="schedule.php" id="current">Schedule</a></li>
				<li><a href="categories.php">Categories</a></li>
				<li><a href="reports.php">Reports</a></li>
			</ul>

			<ul class="float-right">
				<li><a href="#"><?=$_SESSION["username"]?></a></li>
				<li><a href="index.php?logout='1'" style="color: red;">logout</a></li>
			</ul>

		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
		</div>

	</div>
</div>
</header>
<div class="clearfix"></div>


<!-- Banner
================================================== -->



<!-- Content
================================================== -->

<!-- Categories -->
<div class="container">
<section class="section intro">

<div class="container">
	<div style="padding: 6px 12px; border: 1px solid #ccc;">
	 The folowing showcases the reported Bookings made By the users in the system <br>
		QUICK LINKS:   
		<a href="#pending"><button type="button" class="btn btn-outline-success">Schedule A Patient </button></a>
		<a href="#approved"><button type="button" class="btn btn-outline-primary">Scheduled Patients</button></a>
	</div>
</div>
<br>

<div class="container" id="pending">
	<div style="padding: 6px 12px; border: 1px solid #ccc;">
		<h3>Schedule Patient</h3> 
		<p>the following are the deails of the registered patients that can be scheduled</p>  

		<table class="table table-bordered table-striped">
			<thead>
				<tr>
				<th scope="col"><b>pat ID</b></th>
				<th scope="col"><b>names</b></th>
				<th scope="col"><b>ID #</b></th>
				<th scope="col"><b>email</b></th>
				<th scope="col"><b>Schedule</b></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql = "SELECT * FROM users WHERE schstatus='NO'";
				$result = mysqli_query($db, $sql);
				while($row = mysqli_fetch_array($result, MYSQLI_NUM))
				{	
				
					echo '<tr>';
						echo '<td>'.$row[0].'</td> '; //  ID 
						echo '<td>'.$row[2].'</td> '; //  ID 
						echo '<td>'.$row[4].'</td> '; //Title
						echo '<td>'.$row[9].'</td> '; //Category
						echo '<td>
								<a href="schedulepat.php?id='.$row[0].'"><strong><button type="button" class="btn btn-success">Schedule</button>
							  </td>';
					echo '</tr>';
				}
				?>
			</tbody>
		</table>

	</div>
</div>

<br>
<div class="container" id="approved">
	<div style="padding: 6px 12px; border: 1px solid #ccc;">
		<h3>Scheduled Patients</h3> 
		<p> the following are the scheduled patients</p>  
	<table class="table table-bordered table-striped">
			<thead>
				<tr>
				<th scope="col"><b>Schid#</b></th>
				<th scope="col"><b>Pat. Id</b></th>
				<th scope="col"><b>Pat. Names</b></th>
				<th scope="col"><b>Doc. ID</b></th>
				<th scope="col"><b>Category</b></th>
				<th scope="col"><b>Allocated Day</b></th>
				<th scope="col"><b>description</b></th>
				<th scope="col"><b>status</b></th>

				</tr>
			</thead>
			<tbody>
				<?php
				$sql = "SELECT * FROM schedules ORDER BY date_scheduled";
				$result = mysqli_query($db, $sql);
				while($row = mysqli_fetch_array($result, MYSQLI_NUM))
				{	
					$day = $row[4]." at &nbsp;".$row[5];
					echo '<tr>';
						echo '<td>'.$row[0].'</td> '; //  ID 
						echo '<td>'.$row[1].'</td> '; //  ID 
						echo '<td>'.$row[2].'</td> '; //Title
						echo '<td>'.$row[3].'</td> '; //Category

						echo '<td>'.$row[8].'</td> '; //Description
						echo '<td>'.$day.'</td> '; //Status
						echo '<td>'.$row[7].'</td> '; //Status
						echo '<td>'.$row[6].'</td> '; //Status
					echo '</tr>';
				}
				?>
			</tbody>
		</table>
</div>

</section>
</div>




<!-- Testimonials -->
<div id="testimonials">
	<!-- Slider -->
	<div class="container">
		<div class="sixteen columns">
			<div class="testimonials-slider">
				  <ul class="slides">
				    <li>
				      <p> Scheduling system has lots of functions 
				      <span>No 1 , nose</span></p>
				    </li>

				    <li>
				      <p>Scheduling should not be taken lightly 
				      <span>Med 10,42 </span></p>
				    </li>
				    
				    <li>
				      <p> Medical attention should always be administered with or without funding from the patients/victims
				      <span>Tom Smith</span></p>
				    </li>

				  </ul>
			</div>
		</div>
	</div>
</div>


<!-- Infobox -->
<div class="infobox">
	<div class="container">
		<div class="sixteen columns">Scheduling Reporting System Dashboard <a href="#">ADMIN</a></div>
	</div>
</div>



<!-- Footer
================================================== -->
<!-- <div class="margin-top-15"></div> -->

<div id="footer">
	<!-- Main -->
	<div class="container">

		<div class="seven columns">
			<h4>About</h4>
			<p>Scheduling system is meant ot assist the inhabitants of the County to have access to medical 
				services offered at the falcility .</p>
			<a href="#" class="button">Get Started</a>
		</div>

		<div class="three columns">
			<h4>Company</h4>
			<ul class="footer-links">
				<li><a href="users.php">users</a></li>
				<li><a href="#">someother</a></li>
				<li><a href="index.php">Home</a></li>
			</ul>
		</div>
		
		<div class="three columns">
			<h4>Press</h4>
			<ul class="footer-links">
				<li><a href="#">In the News</a></li>
				<li><a href="#">Press Releases</a></li>
				<li><a href="#">Awards</a></li>
				<li><a href="#">Testimonials</a></li>
				<li><a href="#">Timeline</a></li>
			</ul>
		</div>		

		<div class="three columns">
			<h4>Some other Info</h4>
			<ul class="footer-links">
				<li><a href="#">Best Medical Facility in Nyeri County</a></li>
				<li><a href="#">More Systems by Me</a></li>

			</ul>
		</div>

	</div>

	<!-- Bottom -->
	<div class="container">
		<div class="footer-bottom">
			<div class="sixteen columns">
				<h4>Follow Us</h4>
				<ul class="social-icons">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
				</ul>
				<div class="copyrights">©  Copyright 2019 by <a href="#">SonnieMugo</a>. All Rights Reserved.</div>
			</div>
		</div>
	</div>

</div>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script src="scripts/jquery-2.1.3.min.js"></script>
<script src="scripts/custom.js"></script>
<script src="scripts/jquery.superfish.js"></script>
<script src="scripts/jquery.themepunch.tools.min.js"></script>
<script src="scripts/jquery.themepunch.revolution.min.js"></script>
<script src="scripts/jquery.themepunch.showbizpro.min.js"></script>
<script src="scripts/jquery.flexslider-min.js"></script>
<script src="scripts/chosen.jquery.min.js"></script>
<script src="scripts/jquery.magnific-popup.min.js"></script>
<script src="scripts/waypoints.min.js"></script>
<script src="scripts/jquery.counterup.min.js"></script>
<script src="scripts/jquery.jpanelmenu.js"></script>
<script src="scripts/stacktable.js"></script>



</body>
</html>