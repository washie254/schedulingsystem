<?php 
	include('server.php');
// session_start(); 

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
				<li><a href="clients.php" id="current">Clients</a></li>
				<li><a href="schedule.php">Schedule</a></li>
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
	<div class="sixteen columns">
		<h3 class="margin-bottom-25">Patients | Clients</h3>
	    <p>this area wil entail Clients or rather patients in the system</p>
	</div>
</div>
<style>
    .error {
        width: 92%; 
        margin: 0px auto; 
        padding: 10px; 
        border: 1px solid #a94442; 
        color: #a94442; 
        background: #f2dede; 
        border-radius: 5px; 
        text-align: left;
    }
</style>

<section class="section intro">
    <div class="container" id="register">
        <div  style="padding: 6px 12px; border: 1px solid #ccc;">
         You can register a patient and allocate them later to the specialists.
         <br>
         <b>Quick Links:</b>
            <a href="#register"><button type="button" class="btn btn-primary">Register</button></a>
            <a href="#Registered"><button type="button" class="btn btn-primary">View Registered</button></a>
        </div>
    </div>

    <br>
    <div class="container" id="register">
        <div  style="padding: 6px 12px; border: 1px solid #ccc;">

            <h3>Register A patient</h3>
            <p>Fill in the following details to as a doctor or specialist </p>

            <form class="form" action="clients.php" method="post">
                <?php include('errors.php');?>

                <div class="form-group">	
                    <div class="col-xs-6">
                        <label for="username"><h4>Username</h4></label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="clients Username">
                    </div>
                </div>
                
                <div class="form-group">	
                    <div class="col-xs-6">
                        <label for="username"><h4>Firstname</h4></label>
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="Client's Firsname">
                    </div>
                </div>  

                <div class="form-group">	
                    <div class="col-xs-6">
                        <label for="username"><h4>Last Name</h4></label>
                        <input type="text" class="form-control" name="lname" id="lname" placeholder="Client's second name">
                    </div>
                </div>
                
                <div class="form-group">	
                    <div class="col-xs-6">
                        <label for="username"><h4>ID Number</h4></label>
                        <input type="number" class="form-control" name="idnumber" id="idnumber" placeholder="clients id number">
                    </div>
                </div>                

                <div class="form-group">	
                    <div class="col-xs-6">
                        <label for="email"><h4>Email</h4></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Add email address">
                    </div>
                </div>

                <div class="form-group">	
                    <div class="col-xs-6">
                        <label for="password"><h4>Password</h4></label>
                        <input type="password" class="form-control" name="password_1" id="password" placeholder="Enter Password">
                    </div>
                </div>
                <div class="form-group">	
                    <div class="col-xs-6">
                        <label for="Title"><h4>Confirm Password</h4></label>
                        <input type="password" class="form-control" name="password_2" id="confirmpassword" placeholder="Confirm Passord">
                    </div>
                </div>

               
                <div class="form-group">
                    <div class="col-xs-12">
                        <br>
                        <button class="btn btn-lg btn-success" style="width:98%;" type="submit" name="add_patient"><i class="glyphicon glyphicon-ok-sign"></i> Add Client</button>
                    </div>
                </div>
            </form>
        
        </div>
    </div>

    <br>
    <div class="container" id="Registered">
        <div  style="padding: 6px 12px; border: 1px solid #ccc;">

            <h3> Registered Clients</h3>
            <p> the following are the registered users in the system </p>
            <table class="table table-bordered table-striped">
				<thead>
					<tr>
					<th scope="col"><b>ID#</b></th>
					<th scope="col"><b>Username</b></th>
					<th scope="col"><b>Other Names</b></th>
					<th scope="col"><b>Email</b></th>
					<th scope="col"><b>Tel No</b></th>
					<th scope="col"><b>Id Number</b></th>
                    <th scope="col"><b>Date Registered</b></th>
					</tr>
				</thead>
				<tbody>
					<!-- [ LOOP THE REGISTERED AGENTS ] -->
					<?php


					$sql = "SELECT * FROM users  ORDER BY id ";
					$result = mysqli_query($db, $sql);
					while($row = mysqli_fetch_array($result, MYSQLI_NUM))
					{	
					
						echo '<tr>';
							echo '<td>'.$row[0].'</td> '; //  ID 
							echo '<td>'.$row[1].'</td> '; //  ID 
							echo '<td>'.$row[2]." ".$row[3].'</td> '; //Title
							echo '<td>'.$row[9].'</td> '; //Category
							echo '<td>'.$row[5].'</td> '; //Description
                            echo '<td>'.$row[4].'</td> '; //Date
                            echo '<td>'.$row[11].'</td> '; //Date
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
        </div>
    </div>





</section>




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