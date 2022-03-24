<?php
	session_start();
	if(!isset($_SESSION['isLogged']))
	{
		header("location: login.php");
	}
	require "header1.php";	
?>
<title>Inneed - View Job</title>
<style type="text/css">
.bg
{
	background: -webkit-linear-gradient(to right, #bf00ff, #cc99ff, #9CECFB);
	background: linear-gradient(to right, #bf00ff, #cc99ff, #9CECFB);
}
.my-head
{
	padding-top: 70px;
	padding-bottom: 70px;
}
.card
{
  border-radius: 1rem;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}
.card-title,#last
{
	border-bottom: 1px solid lightgrey;
	padding-bottom: 15px;
}
.card h6
{
	font-size: 16px;
	text-transform: uppercase;
}
.mytext
{
	float: right;
	font-size: 17px;
	margin-top: 8px;
}
</style>
<body>
	<div class="container-fluid bg">
		<div class="row">
		<div class="my-head col-sm-10 col-md-8 col-lg-6 mx-auto">
			<div class="card p-3 pr-4 pl-4">
				<div class="card-body">
				<?php
				$con=mysqli_connect("localhost","root","root","db_inneed");
				if(mysqli_connect_errno())
				{
					echo "Failed to connect";
		   		}
		   		$id=$_GET['id'];
		   		$qry="SELECT * from job where job_id=$id";
		   		$result=mysqli_query($con,$qry);
		   		while($row=mysqli_fetch_assoc($result))
		   		{
		   			$status=true;
		   			echo "<h4 class='card-title'>".$row['job_title'];
		   			if(!$row['status'])
		   			{
		   				echo '<label class="text-danger mytext"><strong>- Closed Job</strong></label>';
		   				$status=false;
		   			}
		   			echo "</h4>";
		   			echo "<p class='card-text'>".$row['des']."</p>";
		   			echo "<h6 class='pt-1'>Skills and expertise</h6>";
		   			foreach ( explode(",",$row["required_skills"]) as $key )
					{
						$result=mysqli_query($con,"SELECT skill_name from skills where id=$key");
						while ($row1=mysqli_fetch_assoc($result)) {
							echo "<span class='badge badge-success p-1' style='font-size:14px;'>".$row1['skill_name']."</span>\t";
						}
					}
					echo "<h6 class='pt-3'>Location</h6>";
					echo "<p class='card-text'>".$row['addr']."<br/>City: ".$row['city']."</p>";
					if($row['doc']!="")
					{
						echo "<h6>Attachments</h6>";
						echo "<a href='".$row['doc']."' target='_blank'><button class='btn btn-info mb-3'>View Attachment</button></a>";
					}
					echo "<h6>Deadline</h6>";
					$date=date_create($row['deadline']);
					echo "<p class='card-text' id='last'>".date_format($date,"d/m/Y")."</p>";
					$uid=$row['uid'];
					$app=$row['approved'];
					if(($uid==$_SESSION['uid']) && $app)
					{
						echo "<h6>Interested Candidate</h6>";
						$qry="SELECT uid FROM apply_jobs WHERE job_id=$id";
						$result8=mysqli_query($con,$qry);
						if(mysqli_num_rows($result8)>0)
						{
							while ($row8=mysqli_fetch_assoc($result8)) {
								$temp=$row8['uid'];
								$qry="SELECT * from user where id=$temp";
								$result9=mysqli_query($con,$qry);
								while($row9=mysqli_fetch_assoc($result9))
								{
									$loc=$row9['profile_img'];
									echo "<p class='card-text text-primary'>";
									if($loc!="")
						   			{
						   			echo '<img src="files/Desert.jpg" width="40px" height="40px" style="border-radius: 50%;border:1px solid;" class="mt-1"></a>';
						   			}
						   			else
						   			{
						   			echo '<i class="fa fa-user-circle-o mt-1" style="font-size: 40px;" aria-hidden="true"></i>';
						   			}
									echo "<a style='text-decoration:none;' href='profile.php?id=".$temp."'> ".$row9['fname']."</a></p>";
								}
							}
						}	
						else
						{
							echo '<label class="text-danger pb-0 mb-0"><strong style="font-size:20px;">-</strong></label>';	
						}
					}
					else
					{
						echo "<h6>Posted by</h6>";
						$qry="SELECT * from user where id=$uid";
						$result=mysqli_query($con,$qry);
						while($row1=mysqli_fetch_assoc($result))
						{
							$loc=$row1['profile_img'];
							echo "<p class='card-text'>";
							if($loc!="")
				   			{
				   			echo '<img src="files/Desert.jpg" width="40px" height="40px" style="border-radius: 50%;border:1px solid;" class="mt-1"></a>';
				   			}
				   			else
				   			{
				   			echo '<i class="fa fa-user-circle-o mt-1" style="font-size: 40px;" aria-hidden="true"></i>';
				   			}
							echo " ".$row1['fname']."</p>";
							echo "<p class='card-text'>Email- &nbsp&nbsp".$row1['email']."<br/>Phone-&nbsp".$row1['phone']."</p>";

							$temp_id=$_SESSION['uid'];
							$qry="SELECT * FROM apply_jobs WHERE job_id=$id AND uid=$temp_id";
							$result4=mysqli_query($con,$qry);
							if(mysqli_num_rows($result4)==1)
							{
								echo '<label class="text-success"><strong>Applied Successfully...</strong></label>';
							}
							else
							{
								if($uid!=$_SESSION['uid'] && $status)
								{
									echo "<form action='' method='post'><div class='w-100 text-center'><button class='btn btn-primary' type='submit' name='submit'>Apply for Job</button></div></form>";
								}
								else if($uid!=$_SESSION['uid'] && !$status)
								{
									echo "<form action='' method='post'><div class='w-100 text-center'><button class='btn btn-primary' type='submit' name='submit' disabled>Apply for Job</button></div></form>";	
								}
							}
						}
					}
		   		}
		   		mysqli_close($con);
				?>
				<?php
					if(isset($_POST['submit']))
					{
						$con=mysqli_connect("localhost","root","root","db_inneed");
						if(mysqli_connect_errno())
						{
							echo "Failed to connect";
				   		}
				   		$uid=$_SESSION['uid'];
				   		$date=date('Y-m-d H:i:s');
				   		$qry="INSERT INTO apply_jobs(job_id,uid,apply_time) VALUES($id,$uid,'$date')";
				   		if($result=mysqli_query($con,$qry))
				   		{
				   			echo '<label class="text-success"><strong>Applied Successfully...</strong></label>';
				   		}
				   		else
				   		{
				   			echo "Fail";
				   		}
				   		mysqli_close($con);	
					}
				?>
				</div>
			</div>
		</div>
		</div>
	</div>
<?php
  require "footer.php";
?>