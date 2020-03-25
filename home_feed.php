<?php
session_start();
require_once "config.php";

$message = $userID = $school = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty(trim($_POST["post"]))) {
        $message = trim($_POST["post"]);
    }

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $userID = $_SESSION["id"];
       
    } else {
        header("location: login.php");
    }

    if(isset($_SESSION["school"])) {
        $school = $_SESSION["school"];
    } else {
        header("location: login.php");
    }

    if (!empty($message)) {
        $sql = "INSERT INTO posts (message, school, userID) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_message, $param_school, $param_userID);
            
            // Set parameters
            $param_message = $message;
            $param_school = $school;
            $param_userID = $userID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Refresh current page
                mysqli_stmt_store_result($stmt);
                header("Refresh:0");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }else{
            echo "Database Connection failed. Please try again later.";
        }
        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    include 'includes/script.php';
    include 'includes/style.php'?>
    <title>Home Feed!</title>


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
                        <a id="btnSignOut" href="logout.php" class="btn btn-danger navbar-btn"
                            style="float: right; margin-top: 30px; margin-right: 10px;">Sign
                            Out</a>
                            <a href="profile.php" class="btn btn-primary navbar-btn "
                            style="float: right; margin-top: 30px; margin-right: 10px; border-radius:50%">Profile</a>
                    </div>
                </nav>
            </header>
        </div>
        
        <div class="col-md-7" style="float:left;">
            <div>
                    <h2 class="textalign">  &nbsp Recent Posts</h2>
                        <ul class="list-group">
                            <?php 
                                if ($_SERVER["REQUEST_METHOD"] == "GET"){
                                    $sql = "SELECT message , date_created FROM posts ORDER BY date_created DESC LIMIT 5";
                                    $result = mysqli_query($link, $sql);
                                    while ($row1 = mysqli_fetch_array($result)){
                                        echo "<li class='list-group-item' style='background-color:#F7F4EA;float:left;margin-botton:0.1em;font-size:medium;border-radius:4px;'>";
                                        echo "<label style='font-weight:bold;font-size:large;'> Message: &nbsp</label>";
                                        echo $row1['message'];
                                        echo"<br/><hr class='hrclass'>";
                                        echo $row1['date_created'];
                                        echo"</li><br/>";
                                    }
                                }
                            ?>
                           
                        </ul> 
                </div> 
            </div>
                        <div class="col-md-5" style="float:right;">
                        <form data-my-form="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group" style="padding:60px 0;">
                                <div style="color:#C0B9DD;" style="float: right;flex-flow:row;height:90px;width: 500px;border: 3px;">
                                <label for="studentForm" style="color:white;font-size:x-large;font-weight:bold;" class="allegreyafont">Post Here: </label><div>
                                <textarea name="post" id="pp" class="textarea"required></textarea>
                            </div><br/>
                            <input id="btnSignin" type="submit" class="btn btn-primary btn-lg" style="float:right;" value="Post"></input>
                        </form>
</div>
                    </div>
                </div>
            </div>
            <!-- Bootstrap Badges 
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Why am I in quarantine?
                    <span class="badge badge-primary badge-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    I'm going nuts.
                    <span class="badge badge-primary badge-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    This is a testing post. Hopefully we can get some data here or something.
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
            </ul>
             Display posted data -->
        </div>

</body>
</html>