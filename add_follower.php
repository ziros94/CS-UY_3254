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
$fp=fopen("txt/followers.txt","a+") or die("Cannot find file");
while($line=fgets($fp)){
    $line = rtrim($line,"\n");
    $pieces=explode("\t",$line);
    if (strcasecmp($_SESSION['username'],$followed) === 0) {
        header("Location:profile.php?username=$followed");
        fclose($fp);
        return;
    }
    if (strcasecmp($_SESSION['username'],$pieces[0]) === 0 && strcasecmp($followed,$pieces[1]) === 0){
        header("Location:profile.php?username=$followed");
        fclose($fp);
        return;
    }
}
fwrite($fp,$_SESSION['username']."\t".$followed."\n");
fclose($fp);
header("Refresh:3;url=profile.php?username=$followed");
echo "FOLLOWED $followed SUCCESSFULLY";
//
