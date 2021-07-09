<?php
include "dblink.php";
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM saved_memes WHERE meme_id = ".$_GET["meme_id"]; 

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header("Location: home.php");
  } else {
    echo "Error deleting record: " . $conn->error;
    header("Location: home.php");
  }

header("Location: home.php");
$conn->close();
