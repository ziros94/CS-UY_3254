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
    $fp=fopen('txt/tweets.txt', 'a') or die("Can't find file");
    fwrite($fp,$username."\t".$tweet."\t".date('l, d-M-y H:i:s T')."\n");
    fclose($fp);
    header("Location:home.php");
}
