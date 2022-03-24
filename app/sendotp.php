<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/preloader.css">
	<script src="js/custom.js"></script>

	<div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
</head>
<body>
	<?php
		session_start();
		if(isset($_SESSION['email']))
		{	
			require("phpmailer\PHPMailer.php");
  			require("phpmailer\SMTP.php");
  			require("phpmailer\Exception.php");
			$mail=new PHPMailer\PHPMailer\PHPMailer();
			//Send mail using gmail
			 $mail->IsSMTP(); // telling the class to use SMTP
			 $mail-> SMTPAuth=true; // enable SMTP authentication
			 $mail-> SMTPSecure="ssl"; // sets the prefix to the servier
			 $mail->IsHTML('true');
			 $mail-> Host="smtp.gmail.com"; // sets GMAIL as the SMTP server
			 $mail-> Port=465; // set the SMTP port for the GMAIL server
			 $mail-> Username=""; // GMAIL username
			 $mail-> Password=""; // GMAIL password
			
			//Typical mail data
			$mail->AddAddress($_SESSION['email']);
			$mail->SetFrom("","Inneed");
			$mail-> Subject="Account Verification";
			$otp=rand(1000,9999);
			$mail-> Body="<h2><center>Your OTP is ".$otp."</center></h2>";
			if($mail->Send())
			{
			 	$_SESSION['otp']=$otp;
			 	header("location: verification.php");
			 	die();
			}
			else
			{
				echo '<script> function fail() {
				alert("OTP can not be generated. Check for network problem.\nRedirecting to sign up page");
			window.location="signup.php";
			}; fail(); </script>';
			}
		}
		else
		{
			header("location: signup.php");
			die();
		}
?>
</body>
</html>
