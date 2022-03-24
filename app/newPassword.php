<!DOCTYPE html>
<html>
<head>
	<title>Setup New Password</title>
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
            <h5 class="text-center pb-4"><img src="img/logo.png" height="70"></h5>

            <form class="form-signin" action="" method="post">
              <label class="text-secondary pb-2 pl-2"><strong>Setup your new password...</strong></label>
              <div class="form-label-group">
                <input type="password" name="Pass" id="inputPassword" class="form-control" placeholder="Password" required autofocus autocomplete="off">
                <label for="inputPassword">Password</label>
              </div>
              <div class="form-label-group">
                <input type="password" name="ConPass" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" required autocomplete="off">
                <label for="inputPasswordConfirm">Confirm Password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit">Finish</button>
              <?php
              session_start();
              if(isset($_SESSION['email']))
              {
              if(isset($_POST['submit']))
              {
        	if(isset($_POST['Pass']) && isset($_POST['ConPass']))
        	{
        		if($_POST['Pass']==$_POST['ConPass'])
        		{
        		  $con=mysqli_connect("localhost","root","root","db_inneed");
                if(mysqli_connect_errno())
                {
                  echo "Failed to connect";
                }
                $em=$_SESSION['email'];
                $pass=md5(mysqli_real_escape_string($con,$_POST['Pass']));
                $qry="UPDATE user SET password='$pass' WHERE email='$em'";
                if($result=mysqli_query($con,$qry))
                {
                  $row=mysqli_affected_rows($con);
                  if($row==1)
                  {
                    $_SESSION=array();
                    header("location: login.php");
                    die(); 
                  }
                  else
                  {
        		          echo '<label class="pt-3 mb-0 text-danger w-100 text-center"><strong>'.'Something went wrong'.'</strong></label>'; 	
        		      }            	
                }
               }
        		else
        		{
        			echo '<label class="pt-3 mb-0 text-danger w-100 text-center"><strong>'.'Passwords does not match'.'</strong></label>'; 
        		}
        	}
        }
      }
      else
      {
        header("location: forgetPassword.php");
        die();
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