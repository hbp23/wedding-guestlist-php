<?php
session_start(); # to use Session variables
require '../includes/database.php'; # to access $conn database variable
/** @var mysqli $conn */ # to let IntelliJ IDE know that $conn is set as mysqli database obj

if ($_SERVER["REQUEST_METHOD"] === "POST") { #checks if the html form was submitted via POST method
    $username = $_POST['username']; # saves username
    $password = $_POST['password']; # saves password

    # sql query to find user from username
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result(); # stores result of query

    if ($stmt->num_rows === 1) { # checks to see if exactly one user was found
        # fetches id and password from user table and binds them to variables
        $stmt->bind_result($id, $hashed_pw);
        $stmt->fetch();

        # checks if submitted password matches database
        if (password_verify($password, $hashed_pw)) {
            $_SESSION['user_id'] = $id; # stores user id to the session, logged in status
            $_SESSION['username'] = $username; # stores username to the session
            header("Location: home.php");  # redirects user to home page
            exit();
        } else {
            $error = "Invalid password. Try again.";
        }
    } else {
        $error = "Invalid username. Try again or create an account.";
    }

    $stmt->close();
    $conn->close();
}
?>
<head>
    <title>Log in Gust List</title>
    <link rel="stylesheet" href="../css/wedding.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<!-- form to request a required username and password to log in for an existing account. -->
<form method="POST">
    <h2 class="page-heading">Login</h2>
    <div class="page-box">
        <?php if (isset($error)) { # if error is set, displays error message ?>
            <p class="error"> <?= $error; ?> </p>
        <?php } ?>
        <label for="username" class="form-label">Username:</label>
        <input type="text" class="form-input" id="username" name="username" maxlength="50" required autofocus>
        <br>
        <label for="password" class="form-label">Password:</label>
        <input type="password" class="form-input" id="password" name="password" maxlength="255" required>
        <br>
        <div class="button-container">
            <a href="register.php" class="button left-button">Register</a>
            <button type="submit" class="button right-button ">Log in</button>
        </div>
    </div>
</form>