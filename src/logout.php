<?php

session_start();
session_unset();     // Clear all session variables
session_destroy();   // End the session

header("Location: login.php");
exit();

