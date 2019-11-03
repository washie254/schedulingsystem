<?php 
include('server.php');
//session_start(); 

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
				<li><a href="bookings.php"  id="current">Bookings</a></li>
				<li><a href="sessions.php">Sessions</a></li>
				<li><a href="profile.php">Profile</a></li>
				
				<!-- <li><a href="blog.html">Blog</a></li> -->
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
<section class="section intro">

    <div class="container">
        <div  style="padding: 6px 12px; border: 1px solid #ccc;">

            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'Request')" id="defaultOpen">Request A booking</button>
                <button class="tablinks" onclick="openCity(event, 'Requested')">Requested Bookings</button>
                <button class="tablinks" onclick="openCity(event, 'Completed')">Completed Bookings</button>
            </div>

            <div id="Request" class="tabcontent">
                <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
                <h3>Request a booking</h3>
                <p>Fill in the following details to request a booking</p>

		<?php 
			// userid	usernames	
			// catid	catname	
			// bookdate	booktime

			// title	
			// description	
			
			// status


		?>

				<form class="form" action="bookings.php" method="post">
				<?php include('errors.php');?>
				<?php
					  $user = $_SESSION['username'];
					  $query2 = "SELECT * FROM users WHERE username='$user'";
					  $result2 = mysqli_query($db, $query2);
					  while($row = mysqli_fetch_array($result2, MYSQLI_NUM)){
						  $uid = $row[0]; // E ID 
						  $uname = $row[1];
						  $names = $row[2] ." ".$row[3]; 

					  }
					?>
                    <div class="form-group">
                        <input type="text" id="uid" name="userid" style="opacity: 0;" value="<?=$uid?>"/>
						<input type="text" id="uid" name="usernames" style="opacity: 0;" value="<?=$names?>"/>
                    </div>
                 
                    <div class="form-group">	
                        <div class="col-xs-6">
                            <label for="Title"><h4>Title</h4></label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="A brief title">
                        </div>
                    </div>
					<div class="form-group">	
                        <div class="col-xs-6">
                            <label for="phone"><h4>Category</h4></label>
							<?php
                                               
                            $result = $db->query("select id, catname FROM category");
                            echo "<select  class='form-control' name='category'>";
                              while ($row = $result->fetch_assoc()) {
                                unset($id, $name);
                                $id = $row['id'];
                                $name = $row['catname']; 
                                echo '<option value="'.$name.'">'.$name.'</option>';      
                              }
                            echo "</select>";
							?>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="description"><h4>Description</h4></label>
                            <textarea type="text" class="form-control" name="description" placeholder="Add a brief description"></textarea>
						</div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <br>
                            <button class="btn btn-lg btn-success" style="width:98%;" type="submit" name="book"><i class="glyphicon glyphicon-ok-sign"></i> Make Request</button>
                        </div>
                    </div>
                </form>
               
            </div>

            <div id="Requested" class="tabcontent">
                <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
                <h3>Requested Bookings and their status</h3>
                <p>the following are the bookings you have made and their status</p> 
                <style>
                    .error {
                        width: 100%; 
                        margin: 0px auto; 
                        padding: 10px; 
                        border: 1px solid #a94442; 
                        color: #a94442; 
                        background: #f2dede; 
                        border-radius: 5px; 
                        text-align: left;
                    }
				</style>
            </div>


            <div id="Completed" class="tabcontent">
                <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
                <h3>Your Sessions</h3>
                <p>The following are your sessions and their remarks from the doctor .</p>
            </div>

            <script>
                function openCity(evt, cityName) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablinks");

                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                    }
                    document.getElementById(cityName).style.display = "block";
                    evt.currentTarget.className += " active";
                }

                // Get the element with id="defaultOpen" and click on it
                document.getElementById("defaultOpen").click();
            </script>
        </div><!--/col-9-->
    </div><!--/row-->
</div>
</div>
</section>



<!-- Testimonials -->
<div id="testimonials">
	<!-- Slider -->
	<div class="container">
		<div class="sixteen columns">
			<div class="testimonials-slider">
				  <ul class="slides">
				    <li>
				      <p> Scheduling reporting systemhas lota of funvtions 
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