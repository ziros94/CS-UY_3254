<?php
/**
 * Created by PhpStorm.
 * User: Alvi
 * Date: 2/14/2015
 * Time: 3:15 AM
 */
session_start();
if (isset($_SESSION['logged_in']))
{
    header("Location:home.php");
}
if ($_POST['signup_btn']){
    $username = $_POST['signup_user'];
    $email = $_POST['signup_email'];
    $lines = file("users.txt",FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

}
