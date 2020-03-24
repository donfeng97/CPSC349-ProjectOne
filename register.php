<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        //The following checks if the username has been used already
        // Prepare a select statement
        $sql = "SELECT user_id FROM UserAccount WHERE user_name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate email address
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email address.";
    } else {
        if(filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL))
        {
            //Check if email ends in "edu"
            $emailDomain = explode(".", trim($_POST["email"]));
            if ($emailDomain[count($emailDomain)-1] == "edu") {
                //The following checks if the email has been used already.
                //Prepare sql statement
                $sql = "SELECT user_id FROM UserAccount WHERE email = ?";
                
                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_email);
                    
                    // Set parameters
                    $param_email = trim($_POST["email"]);
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                        mysqli_stmt_store_result($stmt);
                        
                        if(mysqli_stmt_num_rows($stmt) == 1){
                            $email_err = "This email address has been used already.";
                        } else{
                            $email = trim($_POST["email"]);
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            } else {
                $email_err = "Please enter a valid university student email address.";
            }
        } else {
            $email_err = "Please enter a valid university student email address.";
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must contain at least eight characters.";
    } elseif(!preg_match('~[0-9]~', trim($_POST["password"]))){
        $password_err = "Password must contain at least one number.";
    } elseif(!preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', trim($_POST["password"]))){
        $password_err = "Password must contain at least one special character.";
    } elseif(!preg_match('/[A-Z]/', trim($_POST["password"]))){
        $password_err = "Password must contain at least one uppercase letter.";
    } elseif(!preg_match('/[a-z]/', trim($_POST["password"]))){
        $password_err = "Password must contain at least one lowercase letter.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO UserAccount (user_name, password, email) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_email);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/style.php'?>
    <?php include 'includes/script.php'?>
    <title>Sign Up</title>

    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<div>
    <div id="page-wrapper">
        <header>
            <nav style="vertical-align:middle">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <img src="img/logo31.png" height="85" width="300" style="align-self:center;" />
                    </div>
                    <a id="btnSignin" href="sign_in.html" class="btn btn-danger navbar-btn" style="float: right; margin-top: 30px; margin-right: 30px;">Sign
                        In</a>
                </div>
            </nav>
        </header>
    </div>

<div>
        <div class="col-md-7">
<?php include 'img_slide.php'?>
        </div>
        <div class="col-md-4">
            <h2 style="color:white;">Sign Up</h2>
            <p style="color:white;">Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label style="color:white;">Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <!--Ask for email here -->
                    <label style="color:white;">Email Address</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label style="color:white;">Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label style="color:white;">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    <label for="specification" style="font-size:small; font-weight:lighter;color:white;">For passwords, please include the following: <br>
                    * At least 8 characters.<br>
                    * At least one number.<br>
                    * At least one special character.<br>
                    * At least one uppercase and one lowercase letter.</label>
                </div>
                <div> 
                    <label style="color:white;" for="campus">Select Your Campus:</label><br />
                        <select name="campus" id="campus" >
                            <option value="select"> -----------------Select One-----------------</option>
                            <option value="csuf">
                                California State University of Fullerton
                            </option>
                            <option value="csula">
                                California State University of Los Angeles
                            </option>
                            <option value="csulb">
                                California State University of Long Beach
                            </option>
                            <option value="cpp"> Cal Poly Pomona </option>
                            <option value="fullcoll"> Fullerton College </option>
                            <option value="occ"> Orange County College </option>
                            <option value="uci"> University of California Irvine </option>
                            <option value="ucr"> University of California Riverside </option>
                        </select> 
                </div><br>
                <div> 
                    <h4 style="color:white;">Select your icon:</h4>
                    <label class="avatar">
                    <input type="radio" name="avatar">
                    <img src="img/avatar1.png" alt="avatar1">
                </label>
                <label class="avatar">
                    <input type="radio" name="avatar">
                    <img src="img/avatar2.png" alt="avatar2">
                </label>
                <label class="avatar">
                    <input type="radio" name="avatar">
                    <img src="img/avatar3.png" alt="avatar3">
                </label>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
                <p style="color:white;">Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div>  
    </div>  
</body>
</html>