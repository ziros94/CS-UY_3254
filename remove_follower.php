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

$DELETE = $_SESSION['username']."\t".$followed;

$data = file("txt/followers.txt");

$out = array();

foreach($data as $line) {
    if(trim($line) != $DELETE) {
        $out[] = $line;
    }
}

$fp = fopen("txt/followers.txt", "w+");
flock($fp, LOCK_EX);
foreach($out as $line) {
    fwrite($fp, $line);
}
flock($fp, LOCK_UN);
fclose($fp);
header("Location:profile.php?username=$followed");