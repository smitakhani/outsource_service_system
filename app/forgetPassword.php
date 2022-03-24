<!DOCTYPE html>
<html>
<head>
	<title>Inneed - Forget Password</title>
	<link rel="shortcut icon" href="img/favicon.ico">
  	<link rel="icon" href="img/favicon.ico">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/loginstyle.css">
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
    <div class="row vertical-align">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
          	<h5 class="text-center pb-4"><img src="img/logo.png" height="70"></h5>

            <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
              <label class="p-2 text-secondary"><strong>Forgot Password?<br/>Enter your email to continue...</strong></label>
              <div class="form-label-group">
                <input type="mail" name="e" id="inputUser" class="form-control" placeholder="Username" required autofocus autocomplete>
                <label for="inputUser">Enter your email</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit">Continue</button>
              <?php
        if(isset($_POST['submit']))
        {
          $con=mysqli_connect("localhost","root","root","db_inneed");
          if(mysqli_connect_errno())
          {
            echo "Failed to connect";
          }
          $mail=mysqli_real_escape_string($con,$_POST['e']);
          $qry="SELECT * FROM user WHERE email='$mail'";
          if($result=mysqli_query($con,$qry))
          {
          	if(($row=mysqli_num_rows($result))==1)
          	{
          		session_start();
          		$_SESSION['email']=$mail;
         		header("location: forgetPassOTP.php");
				die();
          	} 
          	else
          	{
            	echo '<label class="pt-3 mb-0 text-danger w-100 text-center">'.'<strong>Email is not registered</strong>'.'</label>';		
          	}
          }
          else
          {

          		echo '<label class="pt-2 mb-0 text-danger w-100 text-center">'.'<strong>Something went wrong</strong>'.'</label>';
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