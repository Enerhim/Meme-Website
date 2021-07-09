<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
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
  <link rel="stylesheet" href="column-limit.css">
  <title>Meme Website</title>

  <?php include "boostraplink.php" ?>

</head>

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
        <a class="nav-link active" href="saved.php">Saved</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="post.php">Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="settings.php?option=profile">Settings</a>
      </li>
    </ul>
  </div>
</nav>

<!-- My Posts -->

<h1 class="p-3 text-center">My Posts</h1>

<div class="container">
  <div class="row" data-masonry='{"percentPosition": true }'>
    <?php
    include "dblink.php";
    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT filelink, title, meme_id FROM memes WHERE author = '" . $_SESSION["name"] . "'";
    $result = mysqli_query($conn, $sql);
    for ($i = 0; $i < $result->num_rows; $i++) {
      $row = $result->fetch_assoc();
      $link = $row["filelink"];
      $title = $row["title"];
      $id = $row["meme_id"];
      include "cards/mycard.php";
    }
    $link = $title = $id = null;
    ?>

  </div>
</div>

</div>

<h1 class="p-3 text-center">Liked Posts</h1>
<!-- Saved -->

<div class="container">
  <div class="row" data-masonry='{"percentPosition": true }'>
    <?php
    $meme_ids = array();

    $sql = "SELECT meme_id FROM saved_memes WHERE username = '" . $_SESSION["name"] . "'";
    $result = mysqli_query($conn, $sql);
    for ($i = 0; $i < $result->num_rows; $i++) {
      $row = $result->fetch_assoc();
      $meme_id = $row["meme_id"];
      array_push($meme_ids, $meme_id);
    }
    for ($i = 0; $i < count($meme_ids); $i++) {
      $sql = "SELECT filelink, title, author FROM memes WHERE meme_id = " . $meme_ids[$i];
      $result = mysqli_query($conn, $sql);
      $row = $result->fetch_assoc();
      if (isset($row["filelink"])) {
        $link = $row["filelink"];
        $title = $row["title"];
        $author = $row["author"];
        $id = $meme_id;
        include "cards/mysavecard.php";
      } else {
        continue;
      }
    }

    mysqli_close($conn);
    ?>
  </div>
</div>

<?php include "footer.php"?>
</body>

</html>