<?php

require_once __DIR__."/Credentials.php";

// Create connection
try
{
	$conn = new mysqli($servername, $username, $password, $database, $port);
}
	catch (\Throwable $th)
{
	die("Connection failed: " . $th);
}

// Check connection
if ($conn->connect_error)
{
	die("Connection failed: " . $conn->connect_error);
}
?>