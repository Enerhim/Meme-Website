<?php session_start();
if (isset($_SESSION['loggedin'])) {
  header('Location: home.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <?php include "boostraplink.php" ?>
  <link rel="stylesheet" href="centered.css">
</head>

<body>
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="banner2.jpg" alt="First slide">
        <div class="centered">
          <h1 style="color: white">Login! OwO</h1>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="banner1.jpg" alt="Second slide">
        <div class="centered">
          <h1 style="color: white">Login! OwO </h1>
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

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link" href="signup.php" style="color: #007bff;">Signup</a>
        </li>
      </ul>
      </form>
    </div>
  </nav>

  <div class="container pt-3">
    <h2>Login</h2>
    <form action="authenticate.php" class="needs-validation" novalidate method="post">
      <div class="form-group">
        <label for="username"> <strong>Username:</strong> </label>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
        <div class="valid-feedback"></div>
        <div class="invalid-feedback">Please fill out this field.</div>
      </div>
      <br />
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
        <div class="valid-feedback"></div>
        <div class="invalid-feedback">Please fill out this field.</div>
      </div>
      <br />
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <form action="authenticate.php" method="post">
      <button type="submit" class="btn" style="color:#0B5ED7">Or continue as annonymous</label>
        <input type="hidden" name="annon" value="true">
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
  </script>


  <?php
  if (isset($_GET["msg"])) {
    echo $_GET["msg"];
  }
  ?>

  <div class="m-5"></div>
  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
  <br /><br /><br /><br /><br />
  <?= include "footer.php" ?>
</body>

</html>