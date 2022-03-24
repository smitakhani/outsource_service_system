<?php
	if(isset($_POST['submit']))
	{
	session_start();
	$con=mysqli_connect("localhost","root","root","db_inneed");
	if(mysqli_connect_errno())
	{
	echo "Failed to connect";
	}
	$n=$_POST['phone'];
	$fn=$_POST['fname'];
	$a=$_POST['about'];
	$uid=$_SESSION['uid'];

   		$target="";
   		if($_FILES['Filename']['name']!="")
   		{
	   		$target = "files/";
			$target = $target . basename( $_FILES['Filename']['name']);
			$Filename="C:/xampp/htdocs/Inneed/".($target);
			move_uploaded_file(($_FILES['Filename']['tmp_name']), $target);
		}

		$target2="";
   		if($_FILES['Filename2']['name']!="")
   		{
	   		$target2 = "files/";
			$target2 = $target2 . basename( $_FILES['Filename2']['name']);
			$Filename2="C:/xampp/htdocs/Inneed/".($target);
			move_uploaded_file(($_FILES['Filename2']['tmp_name']), $target2);
		}

	if($target!="")
	{
	$qry="UPDATE user SET phone='$n',fname='$fn',profile_img='$target',about='$a' WHERE id=$uid";
	}
	else
	{
		$qry="UPDATE user SET phone='$n',fname='$fn',about='$a' WHERE id=$uid";	
	}
	$result=mysqli_query($con,$qry);

	if($target2!="")
	{
		$qry="UPDATE user SET attach='$target2' WHERE id=$uid";	
		$result=mysqli_query($con,$qry);
	}
	if($result)
	{
		header("location: manage-profile.php");
	}
	mysqli_close($con);
	}
?>