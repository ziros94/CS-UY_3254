<?php
/**
 * Created by PhpStorm.
 * User: Alvi
 * Date: 3/1/2015
 * Time: 10:39 PM
 */
session_start();
if (!isset($_SESSION['logged_in']))
{
    header("Location:index.php");
}
$username = $_SESSION['username'];
if (isset($_POST['submit_tweet'])){
    date_default_timezone_set("America/New_York");
    $tweet=$_POST['tweet'];
    $tweet_string = $username."|".$tweet."|".date('l, d-M-y H:i:s T');
//    echo $tweet_string;
    $fp = stream_socket_client("tcp://localhost:13002", $errno, $errstr, 5);
    if (!$fp) {
        echo $errstr;
        exit(1);
    }
    fwrite($fp,"add-tweet"."~".$tweet_string) or die("Could not send data to server\n");

    $result=fgets($fp);
    fclose($fp);
    echo $result;

    header("Location:home.php");
}
