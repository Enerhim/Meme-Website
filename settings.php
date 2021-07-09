<!DOCTYPE html>
<html lang="en">
<?php
session_start();    
if ($_SESSION['loggedin'] != TRUE) {
    header('Location: index.php');
    exit;
}
if ($_SESSION['name'] == 'Anonymous') {
    header('Location: index.php');
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="centered.css">
    <link rel="stylesheet" href="column-limit.css">
    <link rel="stylesheet" href="sidebar.css">
    <?php include "boostraplink.php"; ?>
    <title>Settings</title>
    <script>
    </script>
    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #494949;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidebar a {
            padding: 8px 8px 8px 8px;
            text-decoration: none;
            font-size: 25px;
            color: #dddddd;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }

        .sidebar {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            /* margin-left: 50px; */
        }

        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #343A40;
            color: white;
            padding: 10px 15px;
            border: none;
        }

        .openbtn:hover {
            background-color: #444;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
            .sidebar {
                padding-top: 15px;
            }

            .sidebar a {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <?php
    include "dblink.php";
    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_POST["username"])) {
        if ($_POST["username"] != $_SESSION["name"]) {
            if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
                $user = htmlspecialchars($_POST['username']);
                $stmt->bind_param('s', $user);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    echo 'Username exists, please choose another!';
                } else {

                    $sql = "UPDATE accounts SET username = '" . htmlspecialchars($_POST["username"]) . "' WHERE username = '" . $_SESSION["name"] . "'";
                    if ($conn->query($sql) === TRUE) {
                        echo 'Saved successfully';
                    } else {
                        echo "E changing record: " . $conn->error;
                    }
                    $_SESSION["name"] = htmlspecialchars($_POST["username"]);
                    header("Location: home.php");
                }
            }
        }
    }

    if (isset($_POST["nsfw"])) {
        $sql = "UPDATE accounts SET nsfw = 1 WHERE username = '" . $_SESSION["name"] . "'";
        $_SESSION["nsfw_content"] = 1;
        if ($conn->query($sql) == TRUE) {
            // echo "Saved Successfully";
        } else {
            echo "E changing record: " . $conn->error;
        }
    } elseif (!isset($_POST["nsfw"]) and isset($_GET["nsfw"])) {
        $sql = "UPDATE accounts SET nsfw = 0 WHERE username = '" . $_SESSION["name"] . "'";
        $_SESSION["nsfw_content"] = 0;
        if ($conn->query($sql) == TRUE) {
            // echo "Saved Successfully";
        } else {
            echo "E changing record: " . $conn->error;
        }
    }




    mysqli_close($conn);

    ?>

    <script>
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";

        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            open = true;
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            open = false;
            console.log("EEE")
        }

        function toggleNav() {
            if (open) {
                closeNav();
            } else {
                openNav();
            }
        }
    </script>
    <nav class="navbar navbar-expand-md sticky-top navbar-dark bg-dark">
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
                    <a class="nav-link" href="post.php">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="settings.php?option=profile">Settings</a>
                </li>
            </ul>
            </form>
        </div>
    </nav>
    <div id="mySidebar" class="sidebar">
        <ul style="list-style-type: none;">
            <li>
                <a href="settings.php?option=profile">Profile</a>
            </li>
            <li>
                <a href="settings.php?option=preferences">Preferences</a>
            </li>
            <li>
                <a href="logout.php" style="color: #ff3333">Logout</a>
            </li>
        </ul>
    </div>

    <div id="main">
        <button class="openbtn" onclick="toggleNav()">☰</button> <br />
        <?php
        if (isset($_GET["option"])) {
            include $_GET["option"] . "setting.php";
        }
        ?>
    </div>


</body>

</html>