<?php
include "dblink.php";
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	header("Location: signup.php?msg=Please complete the form");
	exit("e"); 
}
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	header("Location: signup.php?msg=Please complete the form");
	exit("e");
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	header("Location: signup.php?msg=Invalid Email");
	exit("e");
}
if (preg_match('/^[a-zA-Z\s\d_]{4,25}$/i',  $_POST['username']) == 0) {
	header("Location: signup.php?msg=Invalid Username");
	exit("e");
}
if (strlen($_POST['password']) > 25 || strlen($_POST['password']) < 4) {
	header("Location: signup.php?msg=Password must be between 25 and 4 characters long");
	exit("e");
}
if ((intval($_POST["captcha_a"]) + intval($_POST["captcha_b"])) != intval($_POST["captcha"])) {
	header("Location: signup.php?msg=Incorrect captcha");
	exit("e");
}
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$suser = htmlspecialchars($_POST["username"]); 			
	$stmt->bind_param('s', $suser);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		echo 'Username exists, please choose another!';
	} else {
		if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
			$suser = htmlspecialchars($_POST["username"]); 			
			$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
			$stmt->bind_param('sss', $suser, $password, $_POST['email']);
			$stmt->execute();
		} else {
			echo 'Could not prepare statement!';
		}
	}
	$stmt->close();
	// header("Location: index.php");
} else {
	echo 'Could not prepare statement!';
}
$con->close();
