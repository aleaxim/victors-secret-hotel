<?php


   $username = "";
   $password = "";
   $confirm_password = "";
   $username_err = "";
   $password_err = "";
   $confirm_password_err = "";

      
   if($_SERVER["REQUEST_METHOD"] == "POST"){

     
    // USERNAME VALIDATION
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        $sql = "SELECT guest_id FROM guests WHERE g_uname = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // PASSWORD VALIDATION
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    

    if(empty($username_err) && 
        empty($password_err) && 
        empty($confirm_password_err) &&
        !empty($_POST['fname']) && 
        !empty($_POST['lname']) && 
        !empty($_POST['email']))
        {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $g_name = $fname . ' ' . $lname;
        $email = $_POST['email'];
   

        $sql = "INSERT INTO guests (name, email, g_uname, g_pass) VALUES (?,?,?,?)";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ssss", 
            $param_name, $param_email, $param_username, $param_password);
           
            $param_name = $g_name; 
            $param_username = $username;
            $param_password = $password; 
            $param_email = $email;

            if(mysqli_stmt_execute($stmt)){
                echo '<script>alert("Registered Succesfully!")</script>';
                // header("location: index.php?page=login");
                echo '<script type="text/javascript">
                    window.location = "index.php?page=login"
                </script>';

                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($conn);
}


?>

<!DOCTYPE html>
<html lang="en">

    
<body>

<!--updated ver for bg --> 
<div class="reg-image">
  <div class="hero-text">
  <hr class="my-10">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
           <h1 class="text-uppercase text-white font-weight-bold">Sign Up</h1>
                        <hr class="divider my-4" />
                    </div></div></div>
                    
                </div>
            </div>
        </header>



 <!-- Masthead-->
 <header class="masthead">
            <!-- <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                    	 <h1 class="text-uppercase text-white font-weight-bold">Sign Up</h1>
                        <hr class="divider my-4" />
                    </div>
                    
                </div>
            </div>
        </header> -->

    <section class="page-section">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-8">
        <h2><b>Registration</b></h2>
        <p>Please fill this form to create an account.</p>
        <form action="index.php?page=register" method="post"> 
       


        
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" name="fname" class="form-control" required placeholder="Juan">
        </div> 
        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" class="form-control" required placeholder="Dela Cruz">
        </div>  
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="juancruz01">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>    
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required placeholder="example@email.com">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="phone" name="phone" class="form-control" placeholder="+63 9XX XXX XXXX">
        </div>
        <div class="form-group">
            <label for="email">Date of Birth</label>
            <input type="email" name="email" class="form-control" placeholder="MM/DD/YYYY">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Create password">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" placeholder="Re-enter password">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div> 
        <br>
        <div class="form-group d-grid gap-2">
            <input type="submit" class="btn btn-block" name="submit" value="Sign Up" style="background-color: #f4623a!important; color:#fff">
        </div><br>
        <p align="center">Already have an account? <a href="index.php?page=login">Login</a></p>
      </form>
                </div>
                </div>
        </div>
        </section>