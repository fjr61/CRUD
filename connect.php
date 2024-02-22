<?php

$con = new mysqli('localhost', 'root', '', 'crud');

// Check if there was a connection error
if ($con->connect_errno) {
    // If there was an error, terminate the script and display the error message
    die("Connection failed: " . $con->connect_error);
}

// Connection successful, proceed with your code

?>