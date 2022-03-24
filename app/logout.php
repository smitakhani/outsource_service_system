<!DOCTYPE html>
<html>
<head>
	<title>Inneed - Logout</title>
</head>
<body>
	<?php
		session_start();
		$_SESSION=array();
		header("location: inneed.php");
	?>
</body>
</html>