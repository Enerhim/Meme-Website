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
          <a class="nav-link active" href="saved.php">Saved</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="post.php">Post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="settings.php?option=profile">Settings</a>
        </li>
      </ul>
      </form>
    </div>
  </nav>

  <div class="container pt-3">
    <h2>Edit</h2>
    <form action="updatepost.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="titleToUpdate" placeholder="Enter title" name="titleToUpdate" value=<?php echo $_POST["meme_name"] ?> required>
        <div class="valid-feedback"></div>
        <div class="invalid-feedback">Please fill out this field.</div>
        <input type="hidden" name="meme_id" value=<?php echo $_POST["meme_id"] ?>>
      </div>
      <div class="form-group form-check">
        <label class="form-check-label">
          <?php include 'boostraplink.php' ?>
          <input class="form-check-input" type="checkbox" name="nsfw" id="nsfw">NSFW Post
          <div class="valid-feedback">Valid.</div>
          <div class="invalid-feedback">Check this checkbox to continue.</div>
        </label>
      </div>
      <input type="submit" value="Make edit" name="submit" class="btn btn-primary">
      <br />
    </form>
  </div>

</body>

</html>