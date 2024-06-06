<?php
    session_start();
    //error_reporting(0);

    include 'dbconnect.php';
    $ID= $_SESSION["id"];
    $username = $_SESSION["username"];
    $sql=mysqli_query($conn,"SELECT * FROM users where ID='$ID' and username='$username'");
    $row  = mysqli_fetch_array($sql);
    $usernamenew = isset($_POST["usernamenew"]) ? $_POST["usernamenew"] : '';
    $emailnew = isset($_POST["emailnew"]) ? $_POST["emailnew"] : '';

    if (!empty($usernamenew)) {
        $checkUsernameQuery = "SELECT * FROM users WHERE username='$usernamenew' AND ID <> '$ID'";
        $resultUsername = mysqli_query($conn, $checkUsernameQuery);
    
        if (mysqli_num_rows($resultUsername) > 0) {
            echo "Error: Username '$usernamenew' is already taken.";
        }
    }
    
    // Check if the new email is already taken
    if (!empty($emailnew)) {
        $checkEmailQuery = "SELECT * FROM users WHERE email='$emailnew' AND ID <> '$ID'";
        $resultEmail = mysqli_query($conn, $checkEmailQuery);
    
        if (mysqli_num_rows($resultEmail) > 0) {
            echo "Error: Email '$emailnew' is already taken.";
        }
    }
    
    // Construct the update query based on provided values
    $updateQuery = "UPDATE users SET";

    if (!empty($usernamenew)) {
        $updateQuery .= " username='$usernamenew'";
    }

    if (!empty($emailnew)) {
        // Add a comma if updating both fields
        $updateQuery .= (!empty($usernamenew) ? ", " : "") . " email='$emailnew'";
    }

    // Add the WHERE clause only if there are fields to update
    if (!empty($usernamenew) || !empty($emailnew)) {
        $updateQuery .= " WHERE ID='$ID'";
    }

    // Perform the update query only if there are fields to update
    if (!empty($usernamenew) || !empty($emailnew)) {
        if (mysqli_query($conn, $updateQuery)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);

    /*
    //For Debugging
    echo "Session ID: " . $_SESSION["id"] . "<br>";
    echo "Session Email: " . $_SESSION["email"] . "<br>";
    echo "Session Email: " . $_SESSION["username"] . "<br>";
    echo $usernamenew;
    echo $emailnew;
    */
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
                <h1><i class="fa-solid fa-gear"></i> Update User Info:</h1>
                <form action="updateinfo.php" method="post" class="update__form">
                <ul>
                    <li class="toggle__dark">
                        Change Email: <input type="email" name="emailnew" placeholder="New Email" id="email">
                    </li>
                    <li class="toggle__dark">
                        Change Username: <input type="text" name="usernamenew" placeholder="New Username" id="username">
                    </li>
                    <li class="toggle__dark">
                        Change Password: <button class="settings__btn"><a href="changepass.php">Change</a></button>
                    </li>
                    <li class="toggle__dark">
                        Delete account: <button class="settings__btn"><a href="logout.php">Delete</a></button>
                    </li>
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