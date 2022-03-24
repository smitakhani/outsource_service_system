<?php	
	if(isset($_POST['submit']))
	{	
		$con=mysqli_connect("localhost","root","root","db_inneed");
   		if(mysqli_connect_errno())
   		{
   			echo "Failed to connect";
   		}
   		$Filename="";
   		$target="";
   		if($_FILES['Filename']['name']!="")
   		{
	   		$target = "files/";
			$target = $target . basename( $_FILES['Filename']['name']);
			$Filename="C:/xampp/htdocs/Inneed/".($target);
			move_uploaded_file(($_FILES['Filename']['tmp_name']), $target);
		}
		session_start();
		$j_title=$_POST['j_title'];
		$j_des=nl2br($_POST['j_des']);
		$j_loc=$_POST['j_loc'];
		$j_uid=$_SESSION['uid'];
		$j_city=$_POST['j_city'];
		$j_deadline=$_POST['j_deadline'];
		$j_skills="";
		$date=date('Y-m-d');
		foreach ($_POST['j_skills'] as $key) {
			$qry="SELECT id from skills where skill_name='$key'";
			$result=mysqli_query($con,$qry);
			while($row=mysqli_fetch_assoc($result))
			{
				$j_skills=$j_skills.$row['id'].",";
			}
		}
		$j_skills=substr($j_skills, 0, -1);
		

		//Build query
		$qry="INSERT into job(job_title,uid,deadline,status,des,city,addr,required_skills,doc,pos_date) VALUES('$j_title',$j_uid,'$j_deadline',true,'$j_des','$j_city','$j_loc','$j_skills','$target','$date')";
		if($result=mysqli_query($con,$qry))
		{
			header("location: posted-jobs.php");
		}
	}
?>