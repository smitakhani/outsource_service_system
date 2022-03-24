<?php
	session_start();
	if(!isset($_SESSION['isLogged']))
	{
		header("location: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inneed - Post Job</title>
	<link rel="shortcut icon" href="img/favicon.ico">
  	<link rel="icon" href="img/favicon.ico">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/post-job-style.css">
	<link rel="stylesheet" href="css/bootstrap-select.min.css">
	<link href="css/tail.select-bootstrap4.css" rel="stylesheet">
	<link href="css/success-green.css" rel="stylesheet">
	<link rel="stylesheet" href="css/preloader.css">

	<div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
</head>
<body>
	<div class="container-fluid bg">
		<div class="row">
		<div class="my-head col-sm-10 col-md-9 col-lg-6 mx-auto">
			<a href="inneed.php"><img src="img/logo.png" height="70"></a>
			<h3 class="text-white" style="font-weight: normal;padding:15px;">Tell us what you need</h3>
		</div>
		</div>
	</div>
	<div class="container-fluid overlay">
		<div class="row">
			<div class="col-sm-10 col-md-9 col-lg-6 mx-auto">
				<div class="card">
					<div class="card-body">
						<form action="uploaddata.php" method="POST" enctype="multipart/form-data">
							<h5 class="label">Job Title</h5>
							<input type="text" class="form-control" placeholder="Give a title" required autofocus autocomplete="off" name="j_title">
							
							<h5 class="label">Job Description</h5>
							<textarea class="form-control" rows="3" style="resize: none;" placeholder="Describe your job..." required autocomplete="off" name="j_des"></textarea>

							<h5 class="label">Preferred Skills</h5>
							<select id="select2" class="form-control" required multiple name="j_skills[]">
								<?php
								$con=mysqli_connect("localhost","root","root","db_inneed");
								if(mysqli_connect_errno())
						   		{
						   			echo "Failed to connect";
						   		}
						   		$qry="SELECT skill_name from skills";
						   		$result=mysqli_query($con,$qry);
						   		while($row=mysqli_fetch_assoc($result))
						   		{
						   			echo "<option value='".$row['skill_name']."'>".$row['skill_name']."</option>";
						   		}
						   		$con=mysqli_close();
								?>
							</select>

							<input type="file" name="Filename" class="form-control" style="margin-top: 12px;" accept=".doc,.docx,.pdf">

							
							<h5 class="label">Location</h5>
							<div class="d-inline-block w-75">
							<input type="text" class="form-control"  required placeholder="Enter detailed location" name="j_loc">
							</div>
							<div class="d-inline-block w-20">
							<select required class="form-control" name="j_city">
								<option selected disabled>Select city</option>
								<?php
								$con=mysqli_connect("localhost","root","root","db_inneed");
								if(mysqli_connect_errno())
						   		{
						   			echo "Failed to connect";
						   		}
						   		$qry="SELECT cname from city_master";
						   		$result=mysqli_query($con,$qry);
						   		while($row=mysqli_fetch_assoc($result))
						   		{
						   			echo "<option value='".$row['cname']."'>".$row['cname']."</option>";
						   		}
						   		$con=mysqli_close();
								?>
							</select>
							</div>
							<h5 class="label">Job Deadline</h5>
							<input class="form-control" type="date" name="j_deadline" required>

							<center>
							<button class="btn btn-md btn-secondary text-uppercase" style="margin-top: 10px;" type="submit" name="submit">Submit</button>
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/tail.select-full.min.js"></script>
	 <script>
       tail.select('#select2',{
       	search: true,
       	multiLimit:5,
       	hideSelected:true,
       	hideDisabled:true,
       	multiShowCount:false,
       	multiContainer:true,
       	placeholder: 'Select upto 5 skills',
       	width: 100 + '%'
       });
 
    </script>	
</body>
</html>