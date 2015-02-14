<?php
/**
 * Created by PhpStorm.
 * User: Alvi
 * Date: 2/10/15
 * Time: 9:02 PM
 */

session_start();
session_destroy();
header("Location:index.php");