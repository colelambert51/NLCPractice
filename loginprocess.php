<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';

    $username = isset($_POST["email"]) ? $_POST["email"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    
    

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

/*
echo "Username provided: $username<br>";  // Debugging statement
*/
if ($row) {
    // Debugging output
    /*
    echo "User found: " . $row['username'] . "<br>";
    echo "id found: " . $row['id'] . "<br>";
    echo "email found: " . $row['email'] . "<br>";
    */

    // Verify the hashed password
    if (password_verify($password, $row['password'])) {
        // Password is correct, set session variables
        $_SESSION["id"] = $row['id'];
        $_SESSION["email"] = $row['email'];
        $_SESSION["username"] = $row['username'];
        
        /*
        echo "ID: " . $_SESSION["id"] . "<br>";
        echo "Email: " . $_SESSION["email"] . "<br>";
        echo "Username: " . $_SESSION["username"] . "<br>";*/
        header("Location: index.html");
        exit(); // Ensure script stops execution after redirection
    } else {
        // Invalid password
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="login.css">
            <title>Pawsitive Rescue Login</title>
        </head>
        <body>
            <div class="logout">
                <h1>Invalid</h1>
                <p>Password</p>
                <a href="login.php">Return to Login</a>
            </div>
        </body>
        </html>';
    }
} else {
    // User does not exist
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="login.css">
        <title>Pawsitive Rescue Login</title>
    </head>
    <body>
        <div class="logout">
            <h1>User not found for email:</h1>
            <p>'; echo $username; echo '</p>
            <a href="login.php">Return to Login</a>
        </div>
    </body>
    </html>';
}

$stmt->close();
$conn->close();
}
?>

