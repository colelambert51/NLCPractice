<?php

    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["username"]);
    unset($_SESSION["email"]);

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
    <div class="logout">
        <h1>You are logged out!</h1>
        <p>Return Home</p>
        <a href="index.html">Here</a>
    </div>
</body>
</html>