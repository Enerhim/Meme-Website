<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: index.php');
  exit;
}
if ($_SESSION['name'] == 'Anonymous') {
  header('Location: index.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meme Website</title>
  <?php include "boostraplink.php" ?>
</head>

<body>

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
          <a class="nav-link " href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="saved.php">Saved</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="post.php">Post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="settings.php?option=profile">Settings</a>
        </li>
      </ul>
      </form>
    </div>
  </nav>

  <script>
       function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }  
  </script>
  <div class="container pt-3">
    <h2>Upload</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <img id="blah" src=""/>
      <div class="form-group">
          <label for="">Image:</label>
          <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" required onchange="readURL(this);"  >
          <div class="valid-feedback"></div>
          <div class="invalid-feedback">Please select an image.</div>
      </div>
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="titleToSubmit" placeholder="Enter title" name="titleToSubmit" required>
        <div class="valid-feedback"></div>
        <div class="invalid-feedback">Please fill out this field.</div>
      </div>
      <div class="form-group form-check">
        <label class="form-check-label">
          <?php include 'boostraplink.php' ?>
          <input class="form-check-input" type="checkbox" name="nsfw" id="nsfw">NSFW Post
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Check this checkbox to continue.</div>
        </label>
      </div>
      <input type="submit" value="Post Meme" name="submit" class="btn btn-primary">
      <br />
    </form>
  </div>

</body>

</html>