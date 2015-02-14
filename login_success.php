<?php
/**
 * Created by PhpStorm.
 * User: Alvi
 * Date: 2/10/15
 * Time: 8:54 PM
 */
session_start();

if (!isset($_SESSION['logged_in']))
{
    header("Location:index.php");
}

header("Location:home.php");