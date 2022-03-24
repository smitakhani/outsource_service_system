<?php
	session_start();
	if(isset($_SESSION['isLogged']))
	{
		require "header1.php";	
	}
	else
	{
		require "header.php";
	}
?>
<style>
.bg
{
	background: -webkit-linear-gradient(to right, #bf00ff, #cc99ff, #9CECFB);
	background: linear-gradient(to right, #bf00ff, #cc99ff, #9CECFB);
}
.my-head
{
	padding-top: 60px;
	padding-bottom: 100px;
}
.card
{
  border-radius: 1rem;
  box-shadow: 0 0.25rem 0.5rem 0 rgba(0, 0, 0, 0.1);
}
select
{
	border-radius: 0;
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
@media screen and (max-width:768px)
{
	.div1
	{
		display: block !important;
		width: 80% !important;
		margin-bottom: 10px !important;
		margin-left: 10px !important;
	}
	.div1 select
	{
		width: 100% !important;
	}
}
</style>
<link href="css/tail.select-bootstrap4.css" rel="stylesheet">
<body>
	<div class="container-fluid bg">
		<div class="row">
		<div class="my-head col-sm-10 col-md-9 col-lg-9 mx-auto">
			<h3 class="text-white" style="font-weight: normal;padding: 10px;">Search a Job</h3>
			<div class="card">
					<div class="card-head pt-4 pb-4" style="border-bottom:1px solid grey;">
						<form method="POST" action="">	
							<div class="search-box text-center">
								<div class="d-inline-block div1" style="float: left;margin-left: 55px;width: 50%;">
								<select class="form-control" id="select3" required name="skill">
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
						   		mysqli_close($con);
								?>
								</select>
								</div>
								<div class="d-inline-block mr-5">
								<div style="display: inline-block;float: left;">
								<select class="form-control" id="select4" required name="city">
									<option value="any">Any location</option>
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
						   		mysqli_close($con);
								?>
								</select>
								</div>
								<div style="display: inline-block;">
								<button class="btn btn-md" type="submit" name="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
								</div>
							</div>
						</form>

					</div>
					<div class="card-body">
						<?php
	if(isset($_POST['submit']))
	{
		$con=mysqli_connect("localhost","root","root","db_inneed");
		$enter_skill=$_POST['skill'];
		$qry="SELECT id FROM skills WHERE skill_name='$enter_skill'";
		if($sk=mysqli_query($con,$qry))
		{
			while ($row=mysqli_fetch_assoc($sk))
			{
				$id=$row['id'];
			}
		}
		$c=$_POST['city'];
		if($c=="any")
		{
			$qry="SELECT * FROM job WHERE FIND_IN_SET('$id', required_skills) AND status=true AND approved=true";
		}
		else
		{
		$qry="SELECT * FROM job WHERE FIND_IN_SET('$id', required_skills) AND city='$c' AND status=true AND approved=true";
		}
		if($re=mysqli_query($con,$qry))
		{
			if (mysqli_num_rows($re) > 0)
			{
				echo '<label class="pb-0 mb-0 text-success">'.'<strong>'.mysqli_num_rows($re).' jobs found</strong>'.'</label>';
			    while($row=mysqli_fetch_assoc($re))
			    {
			    	$id=$row['job_id'];
			        echo"<div class='card mx-auto m-4' style='border-radius:0;width:85%;' id='job'>
							<a style='text-decoration:none;' href='view-job.php?id=".$id."'><div class='card-body text-dark'>
								<h4 class='card-head'>".$row['job_title']."</h4>
								<p class='card-text custom'>".$row['des']."</p>";
								foreach ( explode(",",$row["required_skills"]) as $key )
								{
									$result=mysqli_query($con,"SELECT skill_name from skills where id=$key");
									while ($row=mysqli_fetch_assoc($result)) {
										echo "<span class='badge badge-success p-1'>".$row['skill_name']."</span>\t";	
									}
								}
						echo "</div></a></div>";
			    }
			}
			else
			{
			    echo '<label class="pt-2 mb-0 text-danger w-100 text-center">'.'<strong>No jobs found</strong>'.'</label>';
			}
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