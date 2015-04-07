<?php
/**
 * Created by PhpStorm.
 * User: Alvi
 * Date: 4/3/2015
 * Time: 10:58 AM
 */

$host    = "127.0.0.1";
$port    = 13002;
$fp = stream_socket_client("tcp://localhost:13002", $errno, $errstr, 5);
if (!$fp) {
    echo $errstr;
    exit(1);
}
//$teststring="alan\tharry";
//echo $teststring;
//fwrite($fp,"add-follower"."|".$teststring) or die("Could not send data to server\n");
//$result = fgets($fp);
//$users= explode(" ",$result);
//foreach($users as $user){
//    echo $user."\r\n";
//}
//fwrite($fp,"get-tweets") or die("Could not send data to server\n");
//$test_user= "amy,1234,amy@amy.com";
//fwrite($fp,"add-user"." ".$test_user) or die("Could not send data to server\n");
fwrite($fp,"get-tweets") or die("Could not send data to server\n");
$result = fgets($fp);
fclose($fp);
echo $result;