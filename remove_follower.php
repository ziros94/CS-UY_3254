<?php
/**
 * Created by PhpStorm.
 * User: Alvi
 * Date: 3/2/2015
 * Time: 10:50 AM
 */
session_start();
if (!isset($_SESSION['logged_in']))
{
    header("Location:index.php");
}
$followed=$_GET["followed"];

$DELETE = $_SESSION['username']."|".$followed;
$fp = stream_socket_client("tcp://localhost:13002", $errno, $errstr, 5);
if (!$fp) {
    echo $errstr;
    exit(1);
}
fwrite($fp,"remove-follower"."~".$DELETE) or die("Could not send data to server\n");
$result = fgets($fp);
fclose($fp);
echo $result;

header("Location:profile.php?username=$followed");