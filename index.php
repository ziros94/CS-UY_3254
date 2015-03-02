<?php
session_start();
if (isset($_SESSION['logged_in']))
{
header("Location:home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CommunityBlock</title>
    <link href="css/index.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Dosis&effect=outline' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="header" >
        <div class="logo">
            <h1 class="font-effect-outline"><a href="index.php">CommunityBlock</a></h1>
        </div>
        <div class="login">
            <form method="post" action="check_login.php">
                <label for="username">Username:</label>
                <input class="input" type="text" id="username" name="username">
                <label for="password">Password:</label>
                <input class="input" type="password" id="password" name="password">
                <button type="submit" class="btn" name="login">Log In</button>
            </form>
        </div>
    </div>

    <fieldset class="signup">
        <form method="post" action="signup.php">
            <div class="form-group">
                <label for="signup_user">Username</label>
                <input class="input" type="text" id="signup_user" name="signup_user">
            </div>
            <div class="form-group">
                <label for="signup_pw">Password</label>
                <input class="input" type="password" id="signup_pw" name="signup_pw">
            </div>
            <div class="form-group">
                <label for="signup_email">Email:</label>
                <input class="input" type="text" id="signup_email" name="signup_email">
            </div>
            <div style="padding-top: 20px;">
                <button class="btn" name="signup_btn" type="submit">Sign Up!</button>
            </div>
        </form>
    </fieldset>
    <div id="footer">
        <ul id="footer-ul">
            <li><a href="#">Contact</a></li>
            <li><a href="#">About Us</a></li>
        </ul>
    </div>
</body>
</html>