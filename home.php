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
    header("Location:index.html");
}
$username = $_SESSION['username']
?>

<html>
<head>
<Title>News Feed</Title>
</head>
<body>
<h1>Welcome <?php echo $username ?></h1>
<div style="float: right;">
    <form action="logout.php">
        <button type="submit">Log Out</button>
    </form>
</div>
</body>
</html>