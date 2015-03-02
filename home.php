<?php
/**
 * Created by PhpStorm.
 * User: Alvi
 * Date: 2/10/15
 * Time: 9:15 PM
 */
session_start();
if (!isset($_SESSION['logged_in']))
{
    header("Location:index.php");
}
$username = $_SESSION['username']
?>
<!DOCTYPE html>
<html>
<head>
<Title>News Feed</Title>
</head>
<body>
<h1 style="display: inline;">Welcome <?php echo $username ?></h1>
<div style="display: inline-block;">
    <form action="logout.php">
        <button type="submit">Log Out</button>
    </form>
</div>
<div style="text-align: center;">
    <form>
        <p>Write a message:</p>
        <textarea rows="10" cols="30" style="resize: none;"></textarea>
        <br>
        <input type="submit" value="Send">
    </form>

</div>
</body>
</html>