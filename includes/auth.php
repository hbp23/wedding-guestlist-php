<?php
session_start(); # to access session variables user_id
# if there is no user_id set, redirect user to log in page
# authenticates user and secures webpage and user data
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}