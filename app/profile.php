<?php
	session_start();
	if(!isset($_SESSION['isLogged']))
	{
		header("location: login.php");
	}
	require "header1.php";	
?>
<title>Inneed - View Profile</title>
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
	font-weight: bold;
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
		<div class="my-head col-sm-10 col-md-7 col-lg-5 mx-auto">
			<div class="card p-3 pr-4 pl-4">
				<div class="card-body">
				<?php
				$con=mysqli_connect("localhost","root","root","db_inneed");
				if(mysqli_connect_errno())
				{
					echo "Failed to connect";
		   		}
		   		$id=$_GET['id'];
		   		$qry="SELECT * from user where id=$id";
		   		if($result=mysqli_query($con,$qry))
		   		{
		   			while ($row=mysqli_fetch_assoc($result)) {

		   				$loc=$row['profile_img'];
						echo "<h4 class='card-title'>";
						if($loc!="")
			   			{
			   			echo '<img src="files/Desert.jpg" width="60px" height="60px" style="border-radius: 50%;border:1px solid;"></a>';
			   			}
			   			else
			   			{
			   			echo '<i class="fa fa-user-circle-o mt-1" style="font-size: 40px;" aria-hidden="true"></i>';
			   			}
						echo "<span class='pl-3'>".$row['fname']."</span></h4>";

						echo "<div class='pt-2'><h6 style='display:inline-block;'>E-mail -</h6><p class='card-text' style='display:inline-block;'>&nbsp".$row['email']."</p></div>";

						echo "<div class='pt-2'><h6 style='display:inline-block;'>Phone -</h6><p class='card-text' style='display:inline-block;'>&nbsp".$row['phone']."</p></div>";

						echo "<div class='pt-2'><h6 style='display:inline-block'>About -</h6><p style='display:inline-block' class='card-text'>&nbsp".$row['about']."</p></div>";

						if($row['attach']!="")
						{
							echo "<a href='".$row['attach']."' target='_blank'><button class='btn btn-info btn-sm mt-2'>View Attachment</button></a>";
						}

						echo '<div class="mt-4 text-center"><a href="mailto: '.$row['email'].'"><button class="btn btn-primary mr-2">Send a Mail</button></a>';

						echo '<a href="tel: '.$row['phone'].'"><button class="btn btn-primary ml-2">Make a Call</button></a>';						

						echo '</div>';
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