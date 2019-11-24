<?php 
    include('server.php');
    //include('connect-db.php');
    if (isset($_GET['id'])){
        $bid = $_GET['id'];
    }
?>

<?php 
//include('server.php');
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

				<li><a href="bookings.php"><- Back</a> </li>
				<!-- <li><a href="bookings.php"  id="current">Bookings</a></li>
				<li><a href="sessions.php">Sessions</a></li>
				<li><a href="profile.php">Profile</a></li> -->
				
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
    <h1 style="text-align:center;">[[  :: ALLOCATE PATIENT TO A SPECIALIST :: ]]</h1>
    
    <div class="container">
        <div  style="padding: 6px 12px; border: 1px solid #ccc;">
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
        <form class="form" action="schedulepat.php" method="post">
				<?php include('errors.php');?>
				<?php
					  $query2 = "SELECT * FROM users WHERE id='$bid'";
					  $result2 = mysqli_query($db, $query2);
					  while($row = mysqli_fetch_array($result2, MYSQLI_NUM)){
						  $uid = $row[0]; // E ID 
						  $patnames = $row[2]." ".$row[3];
                          $patemail = $row[9]; 
                          $patidnumber = $row[4];

					  }
					?>
                 
                    <div class="form-group">	
                        <div class="col-xs-6">
                            <label for="id"><b>userdeails: </b></label>
                            <input type="text" class="form-control" name="patid" id="uid" value="<?=$uid?>" readonly/>
                            <input type="text" class="form-control" name="patnames" id="patnames" value="<?=$patnames?>" readonly/>
                            <input type="text" class="form-control" name="patemail" id="patemail" placeholder="<?=$patemail?>" readonly/>
                            <input type="text" class="form-control" name="patidnumber" id="patidnumber" placeholder="<?=$patidnumber?>" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="description"><h4>Select specialist</h4></label>
                            
                            <?php                 
					$result = $db->query("SELECT id, username , categoryname FROM doctors ");
					echo "<select class='form-control' name='specialistid'>";
						while ($row = $result->fetch_assoc()) {
						unset($id, $name);
						$id = $row['id'];
                        $username = $row['username'];
                        $area = $row['categoryname'];
                        echo '<option value="'.$id.'">'.$username." <b>#</b>".$area.'</option>'; 
                    }
					echo "</select>";
				?>
						</div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="description"><h4>Describe condition of patient</h4></label>
                            <textarea type="text" class="form-control" name="description" placeholder="Add a brief description of the patients condition" required></textarea>
						</div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="description"><h4>Allocate Date</h4></label>
                            <input type="date" class="form-control" name="allocateddate" required>
						</div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <br>
                            <button class="btn btn-lg btn-success" style="width:98%;" type="submit" name="allocatedoc"><i class="glyphicon glyphicon-ok-sign"></i> Allocate to specialist</button>
                        </div>
                    </div>
                </form>
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