<?php
include 'config.php';

session_start();
$username = $email = "";
$school = "csuf";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty(trim($_POST["post"]))) {
        $message = trim($_POST["post"]);
    }

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        $userID = $_SESSION["id"];
    } else {
        header("location: login.php");
    }
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="stylesheets/stylesheet.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Profile</title>
</head>

<body class="background">
    <div>
        <div id="page-wrapper">
            <header>
                <nav style="vertical-align:middle">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <img src="img/logo31.png" height="85" width="300" style="align-self:center;" />
                        </div>
                        <a id="btnSignOut" href="logout.php" class="btn btn-danger navbar-btn" style="float: right; margin-top: 30px; margin-right: 10px;">Sign
                            Out</a>
                        <a href="home_feed.php" class="btn btn-active navbar-btn " style="float: right; margin-top: 30px; margin-right: 10px; border-radius:50%">Posts</a>
                    </div>
                </nav>
            </header>
        </div>
    </div>
</div>
    <div class="propanel">
        <form method="get">
            
                <h1 style=text-align:center>User Profile</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    $sql = "SELECT username, email, school, avatar, created_at, avatar FROM users";
                    $result = mysqli_query($link, $sql);
                    while ($row1 = mysqli_fetch_array($result)) {
                ?>

                        <div><label style="font-weight:bold; ">&emsp; Username: &nbsp
                            </label><?php echo $row1['username'] ?><br />
                    </div>

                        <div><label style="font-weight:bold; ">&emsp; Email: &nbsp
                            </label><?php echo $row1['email'] ?><br />
                    </div>

                        <div><label style="font-weight:bold; ">&emsp; School: &nbsp
                            </label><?php echo $row1['school'] ?><br />
                    </div>

                        <div><label style="font-weight:bold; ">&emsp; Created At: &nbsp
                            </label><?php echo $row1['created_at'] ?><br />
                    </div>
                <?php
                    }
                }
                ?>
            </ul>
        </form>
    </div>


</html>