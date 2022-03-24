<?php
	session_start();
	if(isset($_SESSION['otp'])!=true)
	{
		header("location: signup.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Verify OTP</title>
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
<script>
function startTimer(duration, display) {
    var first=1;
    var start = Date.now(),
        diff,
        minutes,
        seconds;
    function timer() {
        diff = duration - (((Date.now() - start) / 1000) | 0);
        minutes = (diff / 60) | 0;
        seconds = (diff % 60) | 0;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = "OTP expires in " + minutes + ":" + seconds; 

        if (diff <= 0) {
        	if(minutes==0)
        	{
        		window.location="signup.php";
        	}
        	else
        	{
            	start = Date.now() + 1000;
            }
        }
    }
    timer();
    setInterval(timer, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 * 10,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};	
</script>
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">We'll send an OTP to <?php echo $_SESSION['email']; ?></h5>
            <strong><label id="time" class="pl-2 pb-2 text-danger"></label></strong>
            <form class="form-signin" action="" method="post">
              <div class="form-label-group">
                <input type="text" name="inputOTP" id="inputOTP" class="form-control" placeholder="Enter OTP" required autofocus autocomplete="off">
                <label for="inputOTP">Enter OTP</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit" id="bt">Verify</button>
              <label class="pl-2 pt-2"><a href="sendotp.php" style="text-decoration: none" >Resend OTP</a></label>
              <?php
			    	if(isset($_POST['inputOTP']))
			    	{
					  if($_SESSION['otp']==$_POST['inputOTP'])
					  {
					  	$_SESSION['verified']=true;
					  	header("location: finishsignup.php");
					  	die();
					  }
					  else
					  {
					  	echo '<label class="pt-3 mb-0 text-danger w-100 text-center"><strong>'.'Wrong OTP'.'</strong></label>';
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