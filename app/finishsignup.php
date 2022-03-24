<?php
	session_start();
	if(isset($_SESSION['verified'])!=true)
	{
		header("location: signup.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Finish SignUp</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/signupstyle.css">
  <link rel="stylesheet" href="css/preloader.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <form class="form-signin" action="" method="post">
              <div class="form-label-group">
                <input type="text" name="User" id="inputUser" class="form-control" placeholder="Username" required autofocus autocomplete="off">
                <label for="inputUser">Username</label>
              </div>

              <div class="form-label-group">
                <input type="password" minlength="8" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Please include at least 1 uppercase character, 1 lowercase character, and 1 number." name="Pass" id="inputPassword" class="form-control" placeholder="Password" required autocomplete="off">
                <label for="inputPassword">Password</label>
              </div>
              <div class="form-label-group">
                <input type="password" name="ConPass" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" required autocomplete="off">
                <label for="inputPasswordConfirm">Confirm Password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit">Finish</button>
              <?php
  	if(isset($_POST['User']) && isset($_POST['Pass']) && isset($_POST['ConPass']))
  	{
  		if($_POST['Pass']==$_POST['ConPass'])
  		{
  		  $con=mysqli_connect("localhost","root","root","db_inneed");
          if(mysqli_connect_errno())
          {
            echo "Failed to connect";
          }
          $uname=mysqli_real_escape_string($con,$_POST['User']);
          $qry="SELECT * FROM user WHERE uname='$uname'";
          if($result=mysqli_query($con,$qry))
          {
            $row=mysqli_num_rows($result);
            if($row==1)
            {
              echo '<label class="pt-3 mb-0 text-danger w-100 text-center"><strong>'.'Username already exist'.'</strong></label>'; 
            }
            else
            {
				$pass=md5(mysqli_real_escape_string($con,$_POST['Pass']));
				$email=mysqli_real_escape_string($con,$_SESSION['email']);
				$qry="INSERT into user(uname,password,email) values('$uname','$pass','$email')";
				if($result=mysqli_query($con,$qry))
				{
          $qry="SELECT * from user where email='$email'";
          $result=mysqli_query($con,$qry);
          while ($row=mysqli_fetch_assoc($result))
          {
            $_SESSION=array();
            session_start();
            $_SESSION['isLogged']=true;
            $_SESSION['uid']= $row['id'];
            $_SESSION['email']=$row['email'];
          }
					header("location: manage-profile.php");
				}
				else
				{
					echo '<label class="pt-3 mb-0 text-danger w-100 text-center"><strong>'.'operation unsuccessful. Try again'.'</strong></label>'; 
            	}	
			}            	
          }
         }
  		else
  		{
  			echo '<label class="pt-3 mb-0 text-danger w-100 text-center"><strong>'.'Passwords does not match'.'</strong></label>'; 
  		}
  	}
  ?>
            </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>