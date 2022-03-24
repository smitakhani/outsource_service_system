<?php
	session_start();
	if(!isset($_SESSION['isLogged']))
	{
		header("location: login.php");
	}
	require "header1.php";	
?>
<title>Inneed - View Posted Jobs</title>
<style type="text/css">
.bg
{
	background: -webkit-linear-gradient(to right, #bf00ff, #cc99ff, #9CECFB);
	background: linear-gradient(to right, #bf00ff, #cc99ff, #9CECFB);
}
.my-head
{
	padding-top: 50px;
	padding-bottom: 50px;
}
.card
{
  border-radius: 1rem;
  box-shadow: 0 0.25rem 0.5rem 0 rgba(0, 0, 0, 0.1);
}
.card-title
{
	border-bottom: 1px solid lightgrey;
	padding-bottom: 15px;
}
.card h6
{
	font-size: 16px;
	text-transform: uppercase;
}
#job
{
	transition: 0.3s ease-in-out;
}
#job:hover
{
	box-shadow: 0 0.25rem 0.5rem 0 #999;
	border-color: silver;
}
.cs
{
	width: 100%;
}
.mySection
{
	border-bottom: 1px solid lightgrey;
	padding-bottom: 10px;
	width: 100%;
	font-size: 18px;
	padding-top: 20px;
}
</style>
<body>
	<div class="container-fluid bg">
		<div class="row">
		<div class="my-head col-sm-12 col-md-11 col-lg-9 mx-auto">
			<div class="card p-3">
				<div class="card-body">
					<h4 class="card-title">Posted Jobs</h4>
					<?php
				   		if(isset($_POST['complete']))
				   		{
				   			$con=mysqli_connect("localhost","root","root","db_inneed");
							if(mysqli_connect_errno())
					   		{
					   			echo "Failed to connect";
					   		}
					   		$jid=$_POST['jid'];
					   		$date=date('Y-m-d');
					   		$qry="UPDATE job SET status=false,com_date='$date' WHERE job_id=$jid";
					   		if($result=mysqli_query($con,$qry))
					   		{
					   			if(mysqli_affected_rows($con)==1)
					   			{
					   				header("location: posted-jobs.php");
					   			}
					   		}
				   		}
				   	?>
					<?php
						$con=mysqli_connect("localhost","root","root","db_inneed");
						if(mysqli_connect_errno())
				   		{
				   			echo "Failed to connect";
				   		}
				   		$uid=$_SESSION['uid'];
				   		$qry="SELECT * FROM job WHERE uid=$uid";
				   		$result=mysqli_query($con,$qry);
				   		if(mysqli_num_rows($result)>0)
				   		{
				   			$qry="SELECT * FROM job WHERE uid=$uid AND status=true AND approved=true";
				   			$result=mysqli_query($con,$qry);
				   			//open job section
				   			if(mysqli_num_rows($result)>0)
				   			{
				   			while($row=mysqli_fetch_assoc($result))
							    {
							    	$id=$row['job_id'];
							    	$date=date_create($row['pos_date']);
							        echo"<div class='card cs mx-auto mt-4' style='border-radius:0;' id='job'>
											<a style='text-decoration:none;' href='view-job.php?id=".$id."'><div class='card-body text-dark'>
												<h4 class='card-head'>".$row['job_title']."</h4>
												<p class='card-text custom mb-2'>".$row['des']."</p>";
												foreach ( explode(",",$row["required_skills"]) as $key )
												{
													$result3=mysqli_query($con,"SELECT skill_name from skills where id=$key");
													while ($row=mysqli_fetch_assoc($result3)) {
														echo "<span class='badge badge-success p-1'>".$row['skill_name']."</span>\t";	
													}
												}
										echo "<p class='card-text mt-2 text-primary'>You posted this job on ".date_format($date,"d/m/Y")."</p>";

										echo "<form action='' method='post'>";

										echo "<input type='hidden' name='jid' value='".$id."'>";
										echo "<button class='btn btn-primary' type='submit' name='complete'>Mark as Completed</button>";

										echo "</form>";

										echo "</div></a></div>";
							    }
							}

							//yet to be approved section
							$qry="SELECT * FROM job WHERE uid=$uid AND status=true AND approved=false";
				   			$result=mysqli_query($con,$qry);
				   			if(mysqli_num_rows($result)>0)
				   			{
				   			while($row=mysqli_fetch_assoc($result))
							    {
							    	$id=$row['job_id'];
							    	$date=date_create($row['pos_date']);
							        echo"<div class='card cs mx-auto mt-4' style='border-radius:0;' id='job'>
											<a style='text-decoration:none;' href='view-job.php?id=".$id."'><div class='card-body text-dark'>
												<h4 class='card-head'>".$row['job_title']."</h4>
												<p class='card-text custom mb-2'>".$row['des']."</p>";
												foreach ( explode(",",$row["required_skills"]) as $key )
												{
													$result3=mysqli_query($con,"SELECT skill_name from skills where id=$key");
													while ($row=mysqli_fetch_assoc($result3)) {
														echo "<span class='badge badge-success p-1'>".$row['skill_name']."</span>\t";	
													}
												}
										echo "<p class='card-text mt-2'>Status: <span class='badge badge-danger p-1'>PENDING</span> Yet to be approved by admin</p>";
										echo "</div></a></div>";
							    }
							}

							//completed job section
							$qry="SELECT * FROM job WHERE uid=$uid AND status=false AND approved=true";
				   			$result=mysqli_query($con,$qry);
				   			if(mysqli_num_rows($result)>0)
				   			{
				   				echo "<div class='mySection mx-auto'>Completed Jobs</div>";
				   			while($row=mysqli_fetch_assoc($result))
							    {
							    	$id=$row['job_id'];
							    	$date=date_create($row['pos_date']);
									$date1=date_create($row['com_date']);
							        echo"<div class='card cs mx-auto mt-4' style='border-radius:0;' id='job'>
											<a style='text-decoration:none;' href='view-job.php?id=".$id."'><div class='card-body text-dark'><h4 class='card-head'>".$row['job_title']."</h4><p class='card-text custom mb-2'>".$row['des']."</p>";
												foreach ( explode(",",$row["required_skills"]) as $key )
												{
													$result3=mysqli_query($con,"SELECT skill_name from skills where id=$key");
													while ($row=mysqli_fetch_assoc($result3)) {
														echo "<span class='badge badge-success p-1'>".$row['skill_name']."</span>\t";	
													}
												}
										echo "<p class='card-text mt-2 text-primary'>Job posted on ".date_format($date,"d/m/Y")."<br>";
										echo "Job completed on ".date_format($date1,"d/m/Y")."</p>";
										echo "</div></a></div>";
							    }
							}

				   		}
				   		else
				   		{
				   			echo "<div class='card-text text-danger text-center pt-5 pb-5'><strong>No jobs found</strong></div>";
				   		}
				   		mysqli_close($con);
				   	?>
				</div>
			</div>
		</div>
		</div>
	</div>
<?php
  require "footer.php";
?>