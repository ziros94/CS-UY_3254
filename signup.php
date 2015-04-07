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
$username = $_POST['signup_user'];
$email = $_POST['signup_email'];

$fp = stream_socket_client("tcp://localhost:13002", $errno, $errstr, 5);
if (!$fp) {
    echo $errstr;
    exit(1);
}
fwrite($fp,"get-users") or die("Could not send data to server\n");
$result = fgets($fp);
fclose($fp);
$lines= explode("`",$result);
$not_exists = true;
foreach($lines as $line){
    $pieces = explode("|",$line);

    if(strcasecmp($username,$pieces[0]) === 0 ){
        $not_exists=false;
        header("Refresh:3;url=index.php");
        echo "Username is already taken";
        break;
    }
    if(strcasecmp($email,$pieces[2]) === 0){
        $not_exists=false;
        header("Refresh:3;url=index.php");
        echo "Email is already taken";
        break;
    }
}
if($not_exists){
    $password = $_POST["signup_pw"];
    $user_string = $username.",".$password.",".$email;
    $fp = stream_socket_client("tcp://localhost:13002", $errno, $errstr, 5);
    if (!$fp) {
        echo $errstr;
        exit(1);
    }
    fwrite($fp,"add-user"."~".$user_string) or die("Could not send data to server\n");
    fclose($fp);
//    header("Refresh:3;url=index.php");
    echo "SUCCESSFULLY CREATED AN ACCOUNT";
}

