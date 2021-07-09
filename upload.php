<?php session_start(); ?>
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
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="saved.php">Saved</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="post.php">Post</a>
        </li>
      </ul>
    </div>
  </nav>

  <h1 class="text-center p-5">

    <?php
    $target_dir = "memes/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($_FILES["fileToUpload"]["tmp_name"] == "") {
      header("Location: post.php");
    }

    if (isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    if (file_exists($target_file)) {
      exit("Sorry, that file already is there!");
      $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
      exit("Sorry, your file is too large."); 
      $uploadOk = 0;
    }
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $d = date_create();
        rename($target_file,  $target_dir . date_timestamp_get($d) . ".jpg");
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      } 
    }

    include "dblink.php";
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {
      exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    if (!isset($_POST["titleToSubmit"])) {
      exit('A title is required');
    }
    if (strlen($_POST["titleToSubmit"]) > 32) {
      exit("Title cannot be greater than 32 characters");
    }

    if (isset($_POST["nsfw"])) {
      if ($_POST["nsfw"] == "on") {
        $nsfw  = 1;
      } else {
        $nsfw = 0;
      }
    } else {
      $nsfw = 0;
    }

    if ($stmt = $con->prepare("INSERT INTO memes (filelink, author, title, nsfw) VALUES (?, ?, ?, ?)")) {
      echo $_SESSION["name"];
      $t = $target_dir . date_timestamp_get($d) . ".jpg";
      $_POST["titleToSubmit"] = htmlspecialchars($_POST["titleToSubmit"]);
      $stmt->bind_param("ssss", $t, $_SESSION["name"], $_POST["titleToSubmit"], $nsfw);
      $stmt->execute();
      $stmt->close();
    }   
    
    $con->close();
    ?>
  </h1>

  <button type="button" class="btn btn-primary" onclick="location.href = 'saved.php' ">Ok</button>
</body>

</html>