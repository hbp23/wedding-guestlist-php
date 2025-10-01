<?php
require '../includes/database.php'; # to access $conn database variable
/** @var mysqli $conn */ # to let IntelliJ IDE know that $conn is set as mysqli database obj


if ($_SERVER["REQUEST_METHOD"] === "POST") { #checks if the html form was submitted via POST method
    $username = $_POST['username']; # saves username
    $user_password = $_POST['password']; # saves password

    # validate if username and password are under database limits
    if (strlen($username) > 50 || strlen($username) < 3) {
        $error = "Username must be between 3 and 50 characters.";
    } else if (strlen($user_password) > 255 || strlen($user_password) < 1) {
        $error = "Password must be between 1 and 255 characters.";
    } else {
        # saves password encrypted if valid
        $password = password_hash($user_password, PASSWORD_DEFAULT);

        # checks database if user entered username already exists
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result(); # stores result of query

        # if username does exist, sets error
        if ($checkStmt->num_rows() > 0) {
            $error = "Username already taken. Please try again.";
        } else {
            # sql query to insert username and password into users table with placeholders
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            # binds the username and password that was grabbed by the form to the sql query to insert to users table
            $stmt->bind_param("ss", $username, $password);

            if ($stmt->execute()) { # executes sql query and checks if successful
                header("Location: login.php"); # redirects user to log in page
                exit();
            } else { # if not successful, sets error from query
                $error = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        $checkStmt->close();
    }
    $conn->close();
}
?>
<head>
    <title>Log in Gust List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/wedding.css">
</head>
<!-- form to request a required username and password to sign
up for an account. -->
<form method="POST">
    <h2 class="page-heading">Register</h2>
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
            <a href="login.php" class="left-button button">Back to Login</a>
            <button type="submit" class="right-button button">Register</button>
        </div>
    </div>
</form>