<?php
include "dblink.php";
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql2 = "SELECT filelink FROM memes WHERE meme_id = ".$_POST["meme_id"];
$result = mysqli_query($conn, $sql2);
$row = $result->fetch_assoc();
$filelink = $row["filelink"];
echo $filelink;

$sql = "DELETE FROM memes WHERE meme_id = ".$_POST["meme_id"]; 

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
  $conn->close();

  unlink($filelink);
  header("Location: saved.php");
