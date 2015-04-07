<?php
/**
 * Created by PhpStorm.
 * User: Alvi
 * Date: 3/2/2015
 * Time: 2:14 AM
 */
session_start();
if (!isset($_SESSION['logged_in']))
{
    header("Location:index.php");
}
$followed=$_GET["followed"];
if(filesize("txt/followers.txt") ===0){
    header("Location:profile.php?username=$followed");
    return;
}
$fp = stream_socket_client("tcp://localhost:13002", $errno, $errstr, 5);
if (!$fp) {
    echo $errstr;
    exit(1);
}
fwrite($fp,"get-followers") or die("Could not send data to server\n");
$result = fgets($fp);
fclose($fp);
$lines= explode("`",$result);
foreach($lines as $line){
    $line = rtrim($line,"\n");
    $pieces=explode("|",$line);
    if (strcasecmp($_SESSION['username'],$followed) === 0) {
        header("Location:profile.php?username=$followed");
        return;
    }
    if (strcasecmp($_SESSION['username'],$pieces[0]) === 0 && strcasecmp($followed,$pieces[1]) === 0){
        header("Location:profile.php?username=$followed");
        return;
    }
}
$fp = stream_socket_client("tcp://localhost:13002", $errno, $errstr, 5);
if (!$fp) {
    echo $errstr;
    exit(1);
}
$follow_string=$_SESSION['username']."|".$followed;
fwrite($fp,"add-follower"."~".$follow_string) or die("Could not send data to server\n");
fclose($fp);
header("Refresh:3;url=profile.php?username=$followed");
echo "FOLLOWED $followed SUCCESSFULLY";
//
