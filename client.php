<?php
/**
 * Created by PhpStorm.
 * User: Alvi
 * Date: 4/3/2015
 * Time: 10:58 AM
 */

$host    = "127.0.0.1";
$port    = 51717;
$message = "Hello Server";
echo "Message To server :".$message;
$fp = stream_socket_client("tcp://localhost:51717", $errno, $errstr, 5);
if (!$fp) {
    echo $errstr;
    exit(1);
}

fwrite($fp,$message) or die("Could not send data to server\n");
// get server response
$result = fgets($fp);
echo "Reply From Server  :".$result;
// close socket
socket_close($fp);