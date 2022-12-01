<?php

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php?page=userpanel"); 
    exit;
}

 
$username = $password = $username_err = $password_err = $login_err = "";

 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT * FROM guests WHERE g_uname = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
           
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $name, $email, $username, $pass);
                    if(mysqli_stmt_fetch($stmt)){
                        if($pass === $password){
                            
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["guest_id"] = $id;
                            $_SESSION["g_uname"] = $username;
                            $_SESSION["name"] = $name;
                            $_SESSION["email"] = $email;         

                    
                            header("location: index.php?page=userpanel");

                         
                        } else{
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }  
    mysqli_close($conn);
}


?>

<!-- updated ver for bg -->
<div class="b-image">
  <div class="hero-text">
  <hr class="my-10">
        <div class="container h-100"><br><br>
            <div class="row h-100 align-items-center justify-content-center text-center">
                <h1 class="text-uppercase text-white font-weight-bold">Login</h1>
				<hr class="divider my-4" />                 
            </div>
        </div>
    </div>
</div>

 <!-- Masthead-->
 <!-- <header class="masthead"> -->
    <!-- </div>  -->
            <!-- <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                    	 <h1 class="text-uppercase text-white font-weight-bold">Login</h1>
                        <hr class="divider my-4" />
                    </div>
                    
                </div>
            </div>
        </header> -->

    <section class="page-section" style="margin-top: 8rem; margin-bottom: 8rem;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-5">
                <h2><b>Login</b></h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

                <form action="index.php?page=login" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>    
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group d-grid my-2">
                        <input type="submit" class="btn btn-block" value="Login" style="background-color: #f4623a!important; color:#fff">
                    </div>
                    <p align="center">Don't have an account? <a href="index.php?page=register">Sign up</a></p>
                </form>
                </div>
            </div>
        </div>
    </section>