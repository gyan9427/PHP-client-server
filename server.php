<?php

//STEP-1 set variables 
$host = "127.0.0.1";
$port = 25003;

//STEP-2 don't timeout!
set_time_limit(0);

//STEP-3 create socket
$socket = socket_create(AF_INET,SOCK_STREAM,0) or die("Could not create socket\n");

//AF_INET IPv4 Internet based protocols. TCP and UDP are common protocols of this protocol family.

//SOCK_STREAM Provides sequenced, reliable, full-duplex, connection-based byte streams. An out-of-band data transmission mechanism may be supported. The TCP protocol is based on this socket type.

//STEP-4 bind socket to port
$result = socket_bind($socket,$host,$port) or die("could not bind to socket\n");

//STEP-5 start listening for connections
$result = socket_listen($socket,3) or die("could not setup socket listener");

//3 is the max number of backlog.

//STEP-6 accept incoming connections
//spawn another socket to handle communication
$spawn = socket_accept($socket) or die("could not accept incoming connection \n");
//STEP-7 read client input
$input = socket_read($spawn,1024) or die("could not read input \n");
//STEP-8 clean up input string
$input = trim($input);
echo "Client Message :". "\n";
//STEP-9 reverse client input and send back
$output = strrev($input)."\n";
socket_write($spawn,$output,strlen($output)) or die("Could not write output \n");
//STEP-10 close sockets
socket_close($spawn);
socket_close($socket);
