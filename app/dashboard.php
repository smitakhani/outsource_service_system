<?php
  session_start();
  if(!isset($_SESSION['isLogged']))
  {
    header("location: inneed.php");
  }
	require "header1.php";
?>
<title>Inneed - Get it done</title>
<body>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  		<ol class="carousel-indicators">
    		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  		</ol>
  		<div class="carousel-inner">
    			<div class="carousel-caption" id="caption">
      				<h3 id="on" style="color:white;" class="text-uppercase">Get it done by a freelancer</h3>
              <a href="post-job.php"><button class="btn btn-outline-light btn-lg">Want to Hire</button></a>
              &nbsp&nbsp
              <a href="search-job.php"><button class="btn btn-outline-light btn-lg">Want to Work</button></a>
      			</div>
    		<div class="carousel-item active">
      			<img class="img-fluid w-100" src="img/office.jpg" alt="First slide">
      		
    		</div>
    		<div class="carousel-item">
    			<img class="img-fluid w-100" src="img/freelancer.jpg" alt="Second slide">
    		</div>

    		<div class="carousel-item">
    			<img class="img-fluid w-100" src="img/telephone.jpg" alt="Third slide">
    		</div>
  		</div>
</div>
<?php
  require "footer.php";
?>