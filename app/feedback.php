<?php
	session_start();
	if(!isset($_SESSION['isLogged']))
	{
		header("location: login.php");
	}
	require "header1.php";	
?>
<title>Inneed - Provide Feedback</title>
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
	font-weight: normal;
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
					<form action="" method="post">
					<h4 class="card-title">Provide Feedback</h4>
					
					<h6 class="pt-2">Title</h6>
					<input type="text" name="sub" class="form-control">

					<h6 class="pt-3">Description</h6>
					<textarea cols="3" rows="3" name="des" class="form-control" style="resize: none;"></textarea>

					<div class="text-center" style="padding-top: 30px;">
					<button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
					</div>

					</form>
					<?php
						if(isset($_POST['submit']))
						{
						$con=mysqli_connect("localhost","root","root","db_inneed");
						if(mysqli_connect_errno())
						{
							echo "Failed to connect";
				   		}
				   		$sub=$_POST['sub'];
				   		$des=nl2br($_POST['des']);
				   		$id=$_SESSION['uid'];
				   		$date=date('Y-m-d');
				   		$qry="INSERT INTO feedback(uid,sub,des,f_date) VALUES($id,'$sub','$des','$date')";
					   		if($result=mysqli_query($con,$qry))
					   		{	
					   			echo '<label class="text-success pt-3"><strong>Feedback submitted successfully</strong></label>';
					   		}
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