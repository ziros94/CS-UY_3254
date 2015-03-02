<?php
/**
 * Created by PhpStorm.
 * User: Alvi
 * Date: 2/10/15
 * Time: 9:15 PM
 */
session_start();
if (!isset($_SESSION['logged_in']))
{
    header("Location:index.php");
}
$username = $_SESSION['username']
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link href="css/index.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Dosis&effect=outline' rel='stylesheet' type='text/css'>
</head>
<body>
<div>
</div>
<div class="header" >
    <div class="logo">
        <h1 class="font-effect-outline"><a href="index.php">CommunityBlock</a></h1>
    </div>
    <div style="display:inline-block;vertical-align: baseline;">
        <a style="font-size: 18px;" href="profile.php?username=<?echo $username;?>">Profile</a>
    </div>
    <div class="login">
        <form action="logout.php">
            <button type="submit" class="btn">Log Out</button>
        </form>
    </div>
</div>
<div style="padding-left: 20px;padding-right: 20px;">
    <h1>Welcome <?php echo $username ?>!</h1>
    <div style="text-align: center;">
        <form action="create_tweet.php" method="post">
            <p>Write a message:</p>
            <textarea rows="10" cols="30" style="resize: none;" name="tweet"></textarea>
            <br>
            <input type="submit" value="Send" name="submit_tweet" class="btn">
        </form>
    </div>
</div>

</body>
</html>