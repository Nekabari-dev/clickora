<?php

	session_start();

	// connecting sql to php
	$username = 'u485260906_clickora';
	$password = '@Clickora1';
	$server = 'localhost';
	$db = 'u485260906_clickora';

	$conn =  mysqli_connect($server,$username,$password,$db);


	if(!$conn) {
		die("connection failed --".mysqli_connect_error());
	}else{
		
	}


?>