<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>404 -_-</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<?php include "boostraplink.php" ?>
	<link rel="stylesheet" href="centered.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="banner2.jpg" alt="First slide">
				<div class="centered">
					<h1 style="color: white; font-size: 150%;">Somthings wrong</h1>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="banner1.jpg" alt="Second slide">
				<div class="centered">
					<h1 style="color: white; font-size: 150%;">i can feel it</h1>
				</div>
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
		<!-- Brand -->
		<a class="navbar-brand" href="home.php">Meme Website</a>

		<!-- Toggler/collapsibe Button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- Navbar links -->
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="nav nav-pills">
				<li class="nav-item">
					<a class="nav-link" href="index.php" style="color: #007bff;">Login</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="signup.php" style="color: #007bff;">Signup</a>
				</li>
			</ul>
			</form>
		</div>
	</nav>
    <img src="404.png" style="width: 50%; margin-left:25%;"><br>
    <?php include "footer.php"?>
</body>
</html>