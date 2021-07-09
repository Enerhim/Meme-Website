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
  <link rel="stylesheet" href="centered.css">

  <?php include "boostraplink.php" ?>

</head>

<body>

  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="banner2.jpg" alt="First slide">
        <div class="centered">
          <h1 style="color: white">Welcome, <?php echo $_SESSION["name"] ?></h1>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="banner1.jpg" alt="Second slide">
        <div class="centered">
          <h1 style="color: white">Post some memes!</h1>
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
  <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
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
          <a class="nav-link active" href="home.php">Home</a>
        </li>
        <?php
        if ($_SESSION["name"] != "Anonymous") {
          include "cards/savedbutton.php";
        }
        ?>
        <?php
        if ($_SESSION["name"] != "Anonymous") {
          include "cards/postbutton.php";
        }
        ?>
        <?php
        if ($_SESSION["name"] != "Anonymous") {
          include "cards/settingsbutton.php";
        } else {
          include "cards/logoutbutton.php";
        }
        ?>
      </ul>
      </form>
    </div>
  </nav>

  <!-- CARD -->
  <!-- <h1 class="">Posts</h1> -->
  <div class="container">
    <div class="col-md">
      <div class="row" data-masonry='{"percentPosition": true }'>

        <?php
        include "dblink.php";
        $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT filelink, title, author, meme_id, nsfw FROM memes";
        $result = mysqli_query($conn, $sql);
        for ($i = 0; $i < $result->num_rows; $i++) {
          $row = $result->fetch_assoc();
          if (isset($row["filelink"])) {
            $nsfw_post = $row["nsfw"];
            if ($nsfw_post and !isset($_SESSION["nsfw_content"])) {
              continue;
            }
            if ($_SESSION["nsfw_content"] == 0 and $nsfw_post) {
              continue;
            }
            $link = $row["filelink"];
            $title = $row["title"];
            $author = $row["author"];
            $id = $row["meme_id"];
          } else {
            $link = "./deleted.bmp";
            $title = "Deleted Post";
            $author = "someone you will never know.";
          }
          include "cards/card.php";
        }
        ?>

      </div>
    </div>
  </div>

  <!-- CARD -->
  <?php include "footer.php" ?>
</body>
<?php include "boostraplink.php" ?>

</html>