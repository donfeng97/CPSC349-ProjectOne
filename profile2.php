<?php
include 'config.php';

session_start();
$username = $email = $school = "";
$date_created = "";

//REPLACE THESE NAMES WITH YOUR DATABASE INFO/SETUP

$sql = "SELECT username, email, school, created_at FROM users WHERE id = ?";
if($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $param_userID);

    $param_userID = $_SESSION["id"];

    if(mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        mysqli_stmt_bind_result($stmt, $resultUsername, $resultEmail, $resultSchool, $resultDate);
        if(mysqli_stmt_fetch($stmt)) {
            //Use the values on the left
            //The values on the right are only available within this if statement.
            $username = $resultUsername;
            $email = $resultEmail;
            $school = $resultSchool;
            $date_created = $resultDate;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'includes/style.php';
    include 'includes/script.php';
    ?>

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
                        <a href="home_feed.php" class="btn btn-primary navbar-btn " style="float: right; margin-top: 30px; margin-right: 10px; border-radius:50%">Posts</a>
                    </div>
                </nav>
            </header>
        </div>
    </div>
</div>
    <div class="propanel">
        <form method="get">
            <br>
                <h1 style="text-align:center" class="allegreyafont">User Profile</h2>
                <br/>
                <div>
                    <label style='font-weight:bold; '>&emsp; Username: <?php echo htmlspecialchars($username);?></label>
                    <br/>
                </div><hr>
                <div>
                    <label style='font-weight:bold; '>&emsp; Email Address: <?php echo htmlspecialchars($email);?></label>
                    <br/>
                </div><hr>
                <div>
                    <label style='font-weight:bold; '>&emsp; School: <?php echo htmlspecialchars($school);?></label>
                    <br/>
                </div><hr>
                <div>
                    <label style='font-weight:bold; '>&emsp; Data Created: <?php echo htmlspecialchars($date_created);?></label>
                    <br/>
                </div><hr>
            </ul>
        </form>
        <a id="btnreset" href="home_feed.php" class="btn btn-info navbar-btn btn-lg"
                            style="float: left; margin-top: 70px; margin-right: 10px; margin-left:30px">&lt; Back to Home Page</a>
        <a id="btnreset" href="reset.php" class="btn btn-danger navbar-btn btn-lg"
                            style="float: right; margin-top: 70px; margin-right: 30px;">Reset Password</a>
    </div>


</html>