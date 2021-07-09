<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Register</title>
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
					<h1 style="color: white; font-size: 150%;">Create an account! UWU</h1>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="banner1.jpg" alt="Second slide">
				<div class="centered">
					<h1 style="color: white; font-size: 150%;">Create an account! UWU</h1>
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
			</ul>
			</form>
		</div>
	</nav>

	<div class="container pt-3">
		<h2>Sign Up</h2>
		<form action="register.php" class="needs-validation" novalidate method="post" id="signup">
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<?php
				// Generate Captcha
				$a = random_int(1,100);
				$b = random_int(1,100);
				?>
				<label for="number">Captcha: <?php echo $a." + ".$b?></label>
				<input type="text" class="form-control" id="captcha" placeholder="Enter the answer" name="captcha" required>
				<input type="hidden" name="captcha_a" value=<?php echo $a?>>
				<input type="hidden" name="captcha_b" value=<?php echo $b?>>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group form-check">
				<label class="form-check-label">
					<input class="form-check-input" type="checkbox" name="remember" required> I definitely read and agree to these <a href="terms.html" target="_blank"> terms and conditions </a>
					<div class="valid-feedback">Valid.</div>
					<div class="invalid-feedback">Check this checkbox to continue.</div>
				</label>
			</div>

			<?php
			if (isset($_GET["msg"])) {
				echo $_GET["msg"];
			}
			?>


			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>

	<script>
		(function() {
			'use strict';
			window.addEventListener('load', function() {
				var forms = document.getElementsByClassName('needs-validation');
				var validation = Array.prototype.filter.call(forms, function(form) {
					form.addEventListener('submit', function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();

		function reload() {
			img = document.getElementById("capt");
			img.src = "captcha.php";
		}
	</script>
	<div class="m-5"></div>
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<?= include "footer.php" ?>
</body>

</html>