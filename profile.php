<?php
/**
 * Created by PhpStorm.
 * User: Alvi
 * Date: 3/1/2015
 * Time: 10:30 PM
 */
session_start();
if (!isset($_SESSION['logged_in']))
{
    header("Location:index.php");
}
date_default_timezone_set("America/New_York");
$username=$_GET["username"];
$fp=fopen("txt/tweets.txt","r") or die("Cannot find file");
$message_list=array();
while($line=fgets($fp)){
    $pieces=explode("\t",$line);
    if (strcasecmp($username,$pieces[0]) === 0 ){
        $message=$pieces[1];
        $message_datetime=$pieces[2];
        $message_list[$message_datetime]=$message;
    }
}
fclose($fp);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link href="css/index.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Dosis&effect=outline' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="header" >
        <div class="logo">
            <h1 class="font-effect-outline"><a href="index.php">CommunityBlock</a></h1>
        </div>
        <div style="display:inline-block;vertical-align: baseline;">
            <a style="font-size: 18px;" class="profile" href="profile.php?username=<?echo $_SESSION['username'];?>">Profile</a>
        </div>
        <div class="login">
            <form action="logout.php">
                <button type="submit" class="btn">Log Out</button>
            </form>
        </div>
    </div>
    <div style="margin-left: 20px;margin-top: 20px;">
        <button class="btn"><a href="add_follower.php?followed=<?echo $username;?>">Follow <?echo $username;?>!</a></button>
    </div><div style="margin-left: 20px;margin-top: 20px;">
        <button class="btn"><a href="remove_follower.php?followed=<?echo $username;?>">Unfollow <?echo $username;?>!</a></button>
    </div>
    <div style="text-align: center"><?echo "<h1>$username's Messages</h1>"; ?>
        <?
        foreach($message_list as $key=>$value){
            echo "<div><h3 style='display:inline'>$value</h3><h3 style='display:inline;padding-left: 20px;'>".date('d/m/Y g:i a', strtotime($key))."</h3></div>";
        }
        ?>
    </div>
</body>
</html>