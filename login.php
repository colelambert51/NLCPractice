<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Pawsitive Rescue Login</title>
</head>
<body>
    <form method="post" action="loginprocess.php" enctype="multipart/form-data">
        <h1>Login</h1>
        <div class="text__box">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
		<div class="text__box">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
		<div class="login__btn">
            <button type="submit" name="save" class="login__btn">Login</button>
        </div>
        <div class="signup">Don't have an account? <a href="accsignup.php">Register Here</a></div>
    </form>
</body>
</html>
