<?php
$host = "127.0.0.1";
$port = 25003;
$message = "Hello Server";
echo "Message To Server :".$message;

//STEP-1: create socket
$socket = socket_create(AF_INET, SOCK_STREAM,0)or die("Could not create socket\n");

//STEP-2: connect to server
$result = socket_connect($socket,$host,$port) or die("could not connect to server \n");

//STEP-3: send string to server
socket_write($socket,$message,strlen($message)) or die("Could not data to server \n");

//STEP-4 get server response
$result = socket_read($socket,1024) or die("Could not read server response\n");
echo "Reply From Server :".$result;

//STEP-5 close socket
socket_close($socket);
