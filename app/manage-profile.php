<?php
	session_start();
	if(!isset($_SESSION['isLogged']))
	{
		header("location: login.php");
	}
	require "header1.php";	
?>
<title>Inneed - Manage Profile</title>
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
</style>
<body>
	<div class="container-fluid bg">
		<div class="row">
		<div class="my-head col-sm-10 col-md-7 col-lg-6 mx-auto">
			<div class="card p-3">
				<div class="card-body">
					<?php
						$con=mysqli_connect("localhost","root","root","db_inneed");
						if(mysqli_connect_errno())
						{
							echo "Failed to connect";
				   		}
				   		$uid=$_SESSION['uid'];
				   		$qry="SELECT * from user where id=$uid";
				   		$result=mysqli_query($con,$qry);
				   		while ($row=mysqli_fetch_assoc($result)) {
				   			echo "<form action='updateprofile.php' method='post' enctype='multipart/form-data'>";

				   			echo "<div class='mb-2'><h6 class='d-inline-block'>Username -</h6>&nbsp &nbsp &nbsp";
				   			echo "<input type='text' class='form-control w-75 d-inline-block' value='".$row['uname']."' readonly></div>";

				   			echo "<div class='card-title'><h6 class='d-inline-block'>Email -</h6>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
				   			echo "<input type='text' class='form-control w-75 d-inline-block' value='".$row['email']."' readonly></div>";

				   			echo "<p class='card-text'>Note: It is advisory that you fill out below information, so that employer can easily contact you.</p>";
				   			echo "<div class='w-100 text-center'><img width='100px' height='100px' alt='Profile Picture' src='".$row['profile_img']."'><br/><input type='file' id='Filename' name='Filename' accept='image/*' value='".$row['profile_img']."'style='padding-left:197px;'></div>";

				   			echo "<div class='pt-3'><h6 class='d-inline-block'>Full Name -</h6>&nbsp &nbsp";
				   			echo "<input type='text' class='form-control w-75 d-inline-block' style='margin-left:6px' name='fname' value='".$row['fname']."'></div>";

				   			echo "<div class='pt-3'><h6 class='d-inline-block'>Phone No -</h6> &nbsp &nbsp&nbsp";
				   			echo "<input type='tel' class='form-control w-75 d-inline-block' name='phone' value='".$row['phone']."'></div>";

				   			echo "<div class='pt-3' style='postion:relative;'><h6 class='d-inline-block' style='transform: translateY(-150%);'>About -</h6> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
				   			echo "<textarea rows='3' style='resize: none;'' placeholder='Tell something about yourself...' autocomplete='off' class='form-control w-75 d-inline-block' name='about'>".$row['about']."</textarea></div>";

				   			echo "<div><h6 class='d-inline-block'>Attachment -&nbsp</h6>";
				   			echo '<input type="file" id="fl2" class="d-inline-block" name="Filename2" class="form-control-file" style="margin-top: 12px;" accept=".doc,.docx,.pdf">';
				   			//echo "<label for='fl2' class='btn btn-info'>Choose New</label>";
				   			if($row['attach']!="")
				   			{
				   				echo $row['attach'];
				   			}
				   			echo "</div>";

				   			echo "<div class='w-100 text-center mt-4'><button type='submit' class='btn btn-secondary' style='font-size:18px;' name='submit'>Save</button></div>";

				   			echo "</form>";	
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