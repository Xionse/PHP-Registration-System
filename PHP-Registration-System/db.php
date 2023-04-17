<?php

// database credentials
$dbHost = 'localhost';
$dbUsername = 'username';
$dbPassword = 'password';
$dbName = 'database_name';

// connect to database
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
