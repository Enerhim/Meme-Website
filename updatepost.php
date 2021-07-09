<?php
include "dblink.php";
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE memes SET title = '".htmlspecialchars($_POST["titleToUpdate"]). "' WHERE meme_id = " . $_POST["meme_id"];
if ($conn->query($sql) === TRUE) {
  echo "Record changed successfully";
} else {
  echo "Error changing record: " . $conn->error;
}

if (isset($_POST["nsfw"])) {
  if ($_POST["nsfw"] == "on") {
    $nsfw = 1;
  } else {
    $nsfw = 0;
  }
} else {
  $nsfw = 0;
}

$sql = "UPDATE memes SET nsfw = " . $nsfw . " WHERE meme_id = " . $_POST["meme_id"];
if ($conn->query($sql) === TRUE) {
  echo "Record changed successfully";
} else {
  echo "Error changing record: " . $conn->error;
}

$conn->close();
header("Location: saved.php");