<?php
/**
 * Created by PhpStorm.
 * User: Alvi
 * Date: 2/10/15
 * Time: 7:58 PM
 */
ob_start();
session_start();
$username=$_POST["username"];
$password=$_POST["password"];
$lines = file("users.txt",FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$user_count=0;
foreach($lines as $line){
    $pieces = explode(",",$line);
    if(strcasecmp($username,$pieces[0]) === 0 && $password === $pieces[1]){
        $user_count++;
        echo $pieces[0].$pieces[1];
    }
}
if ($user_count === 1){
    $_SESSION['username'] = $username;
    $_SESSION['logged_in'] = true;
    header("Location:login_success.php");
}
else{
    echo "Wrong username or password";
}
ob_end_flush();