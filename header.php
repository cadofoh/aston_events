<!-- Header Information Including Navigation  -->

<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <title>Aston Events</title>
    <link rel="shortcut icon" href="images/titlebarlogo.png">
</head>

<!-- Logo Image -->
<div class="aston-logo" cursor:pointer; onclick="window.location.href='index.php'">
    <h1><img src="images/astonlogo.png" alt=""> Aston Events</h1>
</div>


<!-- If user is logged in display the username -->
<div>
    <?php

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        $username = $_SESSION["username"];
        $user_id = $_SESSION["user_id"];
        $email = $_SESSION["email"]; ?>
        <div class="welcome-message">
            <h3> Welcome, <?php echo htmlspecialchars($username) . "   " . "(" . $email . ")"; ?> <a href="logout.php">Logout?</a></h3>
        </div>
    <?php } else { ?>
        <p> </p>
    <?php } ?>
</div>



<div class="toggle "> </div>
<div class="navigation">
    <ul>
        <li><a href="index.php">Home</a> </li>
        <li> <a href="events.php">Events</a> </li>
        <li> <a href="sign-up.php">Sign up</a> </li>

        <li>
            <!-- Change nav bar link to say logout if user is logged in -->
            <?php
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="login.php">Login</a>
            <?php } ?>
        </li>
        <li> <a href="bookedevents.php">Booked Events</a> </li>
    </ul>


    <!-- Social Media Links -->
    <div class="social-bar">
        <ul>
            <li> <a href="https://www.facebook.com/astonuniversity/"> <img src="images/facebook.png" target="_blank" alt=""></a> </li>
            <li> <a href=https://twitter.com/AstonUniversity> <img src="images/twitter.png" target="_blank" alt=""></a> </li>
            <li><a href="https://www.instagram.com/AstonUniversity/"> <img src="images/instagram.png" target="_blank" alt=""></a> </li>
            <li><a href="https://www.youtube.com/user/AstonUniversity"> <img src="images/youtube.png" target="_blank" alt=""></a> </li>
            <li> <a href="https://www.linkedin.com/school/aston-university"> <img src="images/linkedin.png" target="_blank" alt=""></a> </li>
            <li> <a href="https://www2.aston.ac.uk/news/social-media/snapchat"> <img src="images/snapchat.png" target="_blank" alt=""></a> </li>


        </ul>

        <a href="mailto:astonevents@aston.ac.uk" class="email-icon"> <img src="images/email.png" alt="" /></a>
    </div>
</div>