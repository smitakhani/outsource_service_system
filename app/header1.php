<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/favicon.ico">
  	<link rel="icon" href="img/favicon.ico">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/footerstyle.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/for-sidemenu.css">
	<link rel="stylesheet" href="css/preloader.css">
	
	<div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

	<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top no-space" style="box-shadow: 0 2px 2px -2px rgba(0,0,0,.2);padding-top: 3px;padding-bottom: 3px;">
	<div class="container-fluid" >
		<a class="navbar-brand ml-5" href="inneed.php"><img src="img/logo.png" class="img-responsive"></a>
		<button class="navbar-toggler mr-4" type="button" data-toggle="collapse" data-target="#navbarResponsive"> 
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<div class="navbar-nav ml-auto" id="myStyle">
			<a class="nav-link mr-4 active cust" href="post-job.php">Post Job</a>
			<a class="nav-link mr-4 active cust" href="search-job.php">Search Job</a>
			<!-- Use any element to open the sidenav -->
			<span onclick="openNav()">
				
					<?php
					$con=mysqli_connect("localhost","root","root","db_inneed");
					if(mysqli_connect_errno())
					{
						echo "Failed to connect";
			   		}
			   		$id=$_SESSION['uid'];
			   		$qry="SELECT profile_img from user where id=$id";
			   		$result=mysqli_query($con,$qry);
			   		while($row=mysqli_fetch_assoc($result))
			   		{
			   			$loc=$row['profile_img'];
			   		}
			   		if($loc!="")
			   		{
			   			echo '<a class="mr-5 active"><img src="'.$loc.'" width="40px" height="40px" style="border-radius: 50%;border:1px solid;" class="mt-1"></a>';
			   		}
			   		else
			   		{
			   			echo '<a class="mr-5 active"><i class="fa fa-user-circle-o mt-1" style="font-size: 40px;" aria-hidden="true"></i></a>';
			   		}
			   		mysqli_close($con);
			   		?>
			</span>
			</div>
		</div>
		<div id="mySidenav" class="sidenav">
				  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
				  <a href="manage-profile.php">Manage Profile</a>
				  <a href="posted-jobs.php">View Posted Jobs</a>
				  <a href="applied-jobs.php">View Applied Jobs</a>
				  <a href="logout.php">Logout</a>
		</div>
	</div>
	</nav>
</head>