<?php
session_start();
include "dblink.php";
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT save_id FROM saved_memes WHERE meme_id = ? AND username = ?";

if ($stmt = $conn->prepare($sql)) {
	$stmt->bind_param('ss', $_POST['meme_id'], $_SESSION["name"]);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
        header("Location: index.php");
	} else {
        $sql = "INSERT INTO saved_memes (username, meme_id) VALUES ('" . $_SESSION["name"] . "'," . $_POST["meme_id"] . ")";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

}
if ($conn)
mysqli_close($conn);
header("Location: index.php");
