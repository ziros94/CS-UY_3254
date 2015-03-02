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
date_default_timezone_set("America/New_York");
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
        <a style="font-size: 18px;" class="profile" href="profile.php?username=<?echo $_SESSION['username'];;?>">Profile</a>
    </div>
    <div class="login">
        <form action="logout.php">
            <button type="submit" class="btn">Log Out</button>
        </form>
    </div>
</div>
<div style="padding-left: 20px;padding-right: 20px;">
    <h1>Welcome <?php echo $_SESSION['username'] ?>!</h1>
    <div style="text-align: center;">
        <form action="create_tweet.php" method="post">
            <p>Write a message:</p>
            <textarea rows="10" cols="30" style="resize: none;" name="tweet"></textarea>
            <br>
            <input type="submit" value="Send" name="submit_tweet" class="btn">
        </form>
    </div>
<div style="text-align: center;">
<div style="display:inline-block;">
    <?echo "<h1>".$_SESSION['username']."'s Community Messages</h1>"; ?>
<?php
$data=file("txt/followers.txt");
$followed=array($_SESSION['username']);
foreach($data as $line) {
    $line=trim($line);
    $pieces=explode("\t",$line);
    if($pieces[0] === $_SESSION['username']) {
        $followed[] = $pieces[1];
    }
}
$fp=fopen("txt/tweets.txt","r") or die("Cannot find file");
while($line=fgets($fp)){
    $pieces=explode("\t",$line);
    if (in_array($pieces[0],$followed)){
        echo "<div><h3 style='display:inline-block;width: 400px;margin-left:0 '><a href='profile.php?username=$pieces[0]'> $pieces[0]</a>: $pieces[1]&nbsp;</h3><h4 style='display: inline;'>". date('d/m/Y g:i a', strtotime($pieces[2]))."</h4></div>";
    }
}
fclose($fp);
?>
</div>
</div>
</div>
</body>
</html>