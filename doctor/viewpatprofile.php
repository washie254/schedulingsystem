<?php 
include('server.php');	
//session_start(); 
if (isset($_GET['id'])) {
    $patid =$_GET['id'];
}

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
<title>Scheduling aplication</title>

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
				<li><a href="index.php">Home</a> </li>
				<li><a href="Schedules.php">Schedules</a></li>
				<li><a href="sessions.php">Sessions</a></li>
				<li><a href="mypatients.php">My Patients</a></li>
				<li><a href="profile.php">Profile</a></li>
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

<!-- Content
================================================== -->

<!-- Categories -->
<div class="container">
	<div id="View" class="tabcontent">
                <h3>Patient Infromation</h3>
                <p>The following are the details for your patient.</p>
                <style>
                    .label{
                        color: #58BA2B;
                    }
                </style>
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th sope="col">Avatar</th>
                            <th scope="col" colspan="2">Personal</th>
                            <!-- <th scope="col">Personal</th> -->
                        </tr>
                    </thead>
                    <?php
                        $query2 = "SELECT * FROM users WHERE id='$patid'";
                        $result2 = mysqli_query($db, $query2);
                        while($row = mysqli_fetch_array($result2, MYSQLI_NUM)){
                            $uid = $row[0]; // E ID 
                            $uname = $row[1];
							$names = $row[2] ." ".$row[3]; //names
							$email = $row[9]; //email
							$telno = $row[5]; //telno
                            $idnumber = $row[4];
                            $dob = $row[8];

                        }
                    
                    ?>
                    <tr>
                        <td><img src="images/avatar.png" style="width:150px; height:150px;"> </td>
                        <td>
                            <label class="label">User Id:</label><?php echo $uid; ?><br>
                            <label class="label">Username :</label> <?php echo $uname; ?><br>
                            <label class="label">Other Names:</label> <?php echo $names; ?><br>
                            <label class="label">Email:</label><?php echo $email; ?><br>
                        </td>
                        <td>
                            <label class="label">Tel No:</label><?php echo $telno; ?><br>
                            <label class="label">ID #:</label><?php echo $idnumber; ?><br>
                            <label class="label">about:</label><?php echo $dob; ?><br>
                            
                        
                        </td>
                    </tr>
                </table>
            </div>
</div>
<br>

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