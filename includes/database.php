<?php
#variables for database information
$host = "localhost";
$dbname = "wedding_guestlist";
$username = "root";
$password = "";

#creates variable for database connection to use to run queries
$conn = new mysqli($host, $username, $password, $dbname);
#error handling if there is a connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}