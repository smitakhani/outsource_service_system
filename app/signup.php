<?php
  session_start();
  if(isset($_SESSION['isLogged']))
  {
    header("location: dashboard.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inneed - Signup</title>
  <link rel="shortcut icon" href="img/favicon.ico">
  <link rel="icon" href="img/favicon.ico">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/font-awesome.min.css">
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
            <h5 class="card-title text-center">Signup</h5>
            <form class="form-signin" action="" method="post">
              <div class="form-label-group">
                <input type="email" name="e" id="inputEmail" class="form-control" placeholder="Enter your email address" required autofocus autocomplete="off ">
                <label for="inputEmail">Enter your email address</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase mt-3 mb-2" type="submit" name="submit">Continue</button>
              <?php
    if(isset($_POST['submit']))
    {
      if(isset($_POST['e']))
      {
          $con=mysqli_connect("localhost","root","root","db_inneed");
          if(mysqli_connect_errno())
          {
            echo "Failed to connect";
          }
          $email=mysqli_real_escape_string($con,$_POST['e']);
          $qry="SELECT * FROM user WHERE email='$email'";
          if($result=mysqli_query($con,$qry))
          {
            $row=mysqli_num_rows($result);
            if($row==1)
            {
              echo '<label class="pt-3 mb-0 text-danger w-100 text-center"><strong>'.'Email already exist'.'</strong></label>'; 
            }
            else
            {
              $_SESSION['email']=$_POST['e'];
              header("location: sendotp.php");
              die();
            }
          }
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