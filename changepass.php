<?php
session_start();
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';

    // Get user input from the form
    $username = isset($_POST["email"]) ? $_POST["email"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    $passwordnew = isset($_POST["passwordnew"]) ? $_POST["passwordnew"] : '';

    // Validate input
    if (empty($username) || empty($password) || empty($passwordnew)) {
        echo "Please fill in all fields";
        exit();
    }

    // Fetch user data from the database based on the provided email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "User not found";
        exit();
    }

    // Verify if the provided password matches the stored password
    if (password_verify($password, $row['password'])) {
        // Hash the new password
        $hashedPassword = password_hash($passwordnew, PASSWORD_DEFAULT);
        // Update the user's password in the database
        $updateQuery = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ss", $hashedPassword, $username);
        if ($stmt->execute()) {
            echo '';
        } else {
            echo "Error updating password: " . $stmt->error;
        }
    } else {
        echo "Incorrect password";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Non-Profit</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="dark__mode">
    
<nav class="navbar">
        <div class="navbar__container">
            <a href="index.html" id="navbar__logo"><i class="fa-solid fa-otter"></i>Pawsitive Rescue</a>
            <div class="navbar__toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="navbar__menu">
                <li class="navbar__item">
                    <a href="index.html" class="navbar__links">
                        Home
                    </a>
                </li>
                <li class="navbar__item">
                    <a href="purpose.html" class="navbar__links">
                        Purpose
                    </a>
                </li>
                <li class="navbar__item">
                    <a href="gala.html" class="navbar__links">
                        Gala
                    </a>
                </li>
                <li class="navbar__btn">
                    <a href="settings.php" class="navbar__links">
                        Settings
                    </a>
                </li>
                <li class="navbar__btn">
                    <a href="register.html" class="button">
                        Gala Register
                    </a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="settings__container">
        <div class="settings__content">
            <div class="settings__item">
            <form action="changepass.php" method="post" class="update__form">
                <h1><i class="fa-solid fa-gear"></i> Update Password:</h1>
                <ul>
                <li class="toggle__dark">
                    Email: <input type="email" name="email" placeholder="Email" id="email">
                </li>
                <li class="toggle__dark">
                    Current Passowrd: <input type="password" name="password" placeholder="Current Password" id="email" minlength="8">
                </li>
                <li class="toggle__dark">
                    New Password: <input type="password" name="passwordnew" placeholder="New Password" id="username" minlength="8">
                </li>
                <input type="submit" value="Submit" class="settings__submit">
                </ul>
            </form>
            </div>
        </div>
    </div>


    <div class="footer__container">
        <div class="footer__links">
            <div class="footer__link--wrapper">
                <div class="footer__link--items">
                    <h2>About Us</h2>
                    <a href="purpose.html#about__us">How We Operate</a>
                    <a href="purpose.html#about__us">Founders</a>
                    <a href="purpose.html#about__us">Programs</a>
                    <a href="purpose.html#about__us">History</a>
                </div>
                <div class="footer__link--items">
                    <h2>Contact Us</h2>
                    <a href="contact.html#num">Give Us A Call</a>
                    <a href="contact.html#num">Text Us</a>
                    <a href="contact.html#insta">DM Us On Instagram</a>
                    <a href="contact.html#twit">Tag Us On Twitter</a>
                </div>
            </div>
            <div class="footer__link--wrapper">
                <div class="footer__link--items">
                    <h2>Ways To Give</h2>
                    <a href="donate.php">Donate Here</a>
                    <a href="signup.html">Volunteer Here</a>
                </div>
                <div class="footer__link--items">
                    <h2>Abuse Facts</h2>
                    <a href="https://www.humanesociety.org/resources/animal-cruelty-facts-and-stats">Humane Society</a>
                    <a href="https://www.dosomething.org/us/facts/11-facts-about-animal-cruelty">DoSomething.org</a>
                    <a href="https://worldanimalfoundation.org/advocate/animal-cruelty-statistics/">World Animal Foundation</a>
                </div>
            </div>
        </div>
        <div class="social__media">
            <div class="social__media--wrap">
                <div class="footer__logo">
                    <a href="/" id="footer__logo"><i class="fas fa-otter"></i>Pawsitive Rescue</a>
                </div>
                <p class="website__right">Pawsitive Rescue 2024. All rights reserved.</p>
                <div class="social__icons">
                    <a href="/" class="social__icon--link" target="_blank">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/pawsitive._rescue?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="social__icon--link" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="/" class="social__icon--link" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.youtube.com/channel/UCQ_3FWuEtcehk8sl94VjCLQ" class="social__icon--link" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <script src="app.js"></script>
    <script src="https://kit.fontawesome.com/0974947d58.js" crossorigin="anonymous"></script>
    <script>
        window.embeddedChatbotConfig = {
        chatbotId: "1mBTOT3OgKa_-oiNoJkTq",
        domain: "www.chatbase.co"
        }
        </script>
        <script
        src="https://www.chatbase.co/embed.min.js"
        chatbotId="1mBTOT3OgKa_-oiNoJkTq"
        domain="www.chatbase.co"
        defer>
        </script>
</body>
</html>