<?php
	session_start();
	if(isset($_SESSION['isLogged']))
	{
		header("location: dashboard.php");
	}
	require "header.php";
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
      				<h3 id="on" class="text-uppercase">Get it done by a freelancer</h3>
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
	<div class="container-fluid content ">
	<div class="row jumbotron mb-0">
	<div class="col-md-10">
		<h3 class="text-justify" style="font-weight: normal;">Reimagine the way of living life. Be a part of transforming world.</h3>
	</div>
	<div class="col-md-2">
		<a href="signup.php"><button class="btn btn-outline-dark btn-lg">Join Us</button></a>
	</div>
	</div>
	</div>
	<!--<div class="container-fluid content" id="jobs">
		<div class="row padding">
			<div class="col-sm-12 text-center">
				<h2 style="font-weight: normal;">Latest jobs</h2>
			</div>
			<div class="col-sm-12">
			<hr class="w-50"/>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="card">
					<img class="card-img-top" src="img/html5.jpg">
					<div class="card-body">
						<h4 class="card-head">Need logo designer</h4>
						<p class="card-text">Urgent requirement for designing logo of my website</p>
						<button class="btn btn-primary w-100">Apply</button>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="card">
					<img class="card-img-top" src="img/html5.jpg">
					<div class="card-body">
						<h4 class="card-head">Need logo designer</h4>
						<p class="card-text">Urgent requirement for designing logo of my website</p>
						<button class="btn btn-primary w-100">Apply</button>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="card">
					<img class="card-img-top" src="img/html5.jpg">
					<div class="card-body">
						<h4 class="card-head">Need logo designer</h4>
						<p class="card-text">Urgent requirement for designing logo of my website</p>
						<button class="btn btn-primary w-100">Apply</button>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="card">
					<img class="card-img-top" src="img/html5.jpg">
					<div class="card-body">
						<h4 class="card-head">Need logo designer</h4>
						<p class="card-text">Urgent requirement for designing logo of my website</p>
						<button class="btn btn-primary w-100">Apply</button>
					</div>
				</div>
			</div>
		</div>
	</div>-->
<?php
	require "footer.php";
?>