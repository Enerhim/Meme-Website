<?php
session_start();
include "dblink.php";
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (isset($_POST["annon"])) {
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['name'] = "Anonymous";
    $_SESSION['id'] = 0;
    $_SESSION['nsfw_content'] = 0;
    header("Location: home.php");
}

if (!isset($_POST['username'], $_POST['password'])) {
    header("Location: index.php?msg=Fill the username and password fields... please");
}
if ($stmt = $con->prepare('SELECT id, password, nsfw FROM accounts WHERE username = ?')) {
    $stmt->bind_param('s', htmlspecialchars($_POST['username']));
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $nsfw);
        $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = htmlspecialchars($_POST['username']);
            $_SESSION['id'] = $id;
            $_SESSION['nsfw_content'] = $nsfw;
            header("Location: home.php");
        } else {
            header("Location: index.php?msg=Incorrect username and/or password!");
        }
    } else {
        header("Location: index.php?msg=Incorrect username and/or password!");
    }
    $stmt->close();
}

mysqli_close($con);
