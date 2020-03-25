<?php
include 'config.php';

session_start();
$username = $email = $school = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty(trim($_POST["post"]))) {
        $message = trim($_POST["post"]);
    }

    if(isset($_SESSION["school"])) {
        $school = $_SESSION["school"];
    } else {
        header("location: login.php");
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
            
                <h1 style=text-align:center>User Profile</h2>
                <hr>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    
                    $sql = "SELECT username, email, school, created_at FROM users LIMIT 1";
                    $result = mysqli_query($link, $sql);
                            while ($row1 = mysqli_fetch_array($result)){
                                     echo "<div><label style='font-weight:bold; '>&emsp; Username: &nbsp</label>";
                                     echo $row1['username'];
                                     echo "<br /><br><hr></div>";

                                     echo " <div><label style='font-weight:bold; '>&emsp; Email: &nbsp</label>";
                                     echo $row1['email'];
                                     echo "<br /><br><hr></div>";

                                     echo " <div><label style='font-weight:bold; '>&emsp; School: &nbsp</label>";
                                     echo $row1['school'];
                                     echo "<br /><br><hr></div>";

                                     echo " <div><label style='font-weight:bold; '>&emsp; Created at: &nbsp</label>";
                                     echo $row1['created_at'];
                                     echo "<br /><br><hr></div>";
                                 } 
                                }

                ?>

            </ul>
            
        </form>
        <a id="btnreset" href="reset.php" class="btn btn-danger navbar-btn"
                            style="float: right; margin-top: 30px; margin-right: 10px;">Reset Password</a>
    </div>


</html>