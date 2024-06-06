<?php
    
$showAlert = false;
$showError = false;
$exists=false;

$message = "Congratulations\r\nYou have registered for\r\nPawsitive Rescue";

    
if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    // Include file which makes the
    // Database Connection.
    include 'dbconnect.php';
    
    $username = $_POST["username"];
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
            
    
    $sql = "Select * from users where username='$username'";
    
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result);
    
    // This sql query is use to check if
    // the username is already present
    // or not in our Database
    if($num == 0) {
        if(($password == $cpassword) && $exists==false) {
    
            $hash = password_hash($password,
                                PASSWORD_DEFAULT);
                
            // Password Hashing is used here.
            $sql = "INSERT INTO `users` ( `username`, `email`,
                `password`, `date`) VALUES ('$username', '$email',
                '$hash', current_timestamp())";
    
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $showAlert = true;
            }
        }
        else {
            $showError = "Passwords do not match";
        }
    }// end if
    
   if($num>0)
   {
      $exists="Username not available";
   }
    
}//end if
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Pawsitive Rescue Sign Up</title>
</head>
<body>
    
<?php
    
    if($showAlert) {
    
        echo ' <div class="alert alert-success
            alert-dismissible fade show" role="alert">
    
            <strong>Success!</strong> Your account is
            now created and you can login.
            <button type="button" class="close"
                data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div> ';
    }
    
    if($showError) {
    
        echo ' <div class="alert alert-danger
            alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
    
       <button type="button" class="close"
            data-dismiss="alert aria-label="Close">
            <span aria-hidden="true">×</span>
       </button>
     </div> ';
   }
        
    if($exists) {
        echo ' <div class="alert alert-danger
            alert-dismissible fade show" role="alert">
    
        <strong>Error!</strong> '. $exists.'
        <button type="button" class="close"
            data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
       </div> ';
     }
   
?>
    <form method="post" action="accsignup.php">
        <h1>Sign Up</h1>
        <div class="text__box">
            <label for="username">Username</label>
        <input type="text" class="form-control" id="username"
            name="username" aria-describedby="emailHelp" minlength="6" required>
        </div>

        <div class="text__box">
            <label for="email">Email</label>
        <input type="email" class="form-control" id="email"
            name="email" required>
        </div>
    
        <div class="text__box">
            <label for="password">Password</label>
            <input type="password" class="form-control"
            id="password" name="password" minlength="8" required>
        </div>
    
        <div class="text__box">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control"
                id="cpassword" name="cpassword" minlength="8" required>
        </div>
        <input type="submit" value="Sign Up" class="login__btn" name="login__btn">
        <div class="signup">
            Already have an account?
            <br>
            <a href="login.php">Login</a>
        </div>
    </form>
</body>
</html>

