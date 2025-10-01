<?php
include '../includes/auth.php';
include '../includes/database.php';
/** @var mysqli $conn */

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $family_group = $_POST['family_group'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $rsvp = isset($_POST['rsvp']) ? 1 : 0;
    $mehendi = isset($_POST['mehendi']) ? 1 : 0;
    $grah_shanti = isset($_POST['grah_shanti']) ? 1 : 0;
    $welcome_party = isset($_POST['welcome_party']) ? 1 : 0;
    $wedding = isset($_POST['wedding']) ? 1 : 0;
    $kankotri = isset($_POST['kankotri']) ? 1 : 0;
    $save_the_date = isset($_POST['save_the_date']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO guests 
        (user_id, first_name, last_name, family_group, address, phone, email, rsvp, mehendi, grah_shanti, welcome_party, wedding, kankotri, save_the_date)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("issssssiiiiiii", $user_id, $first_name, $last_name, $family_group, $address, $phone, $email, $rsvp, $mehendi, $grah_shanti, $welcome_party, $wedding, $kankotri, $save_the_date);

    if ($stmt->execute()) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Guest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/wedding.css">
</head>
<body>
<form method="POST">
    <h2 class="page-heading">Add New Guest</h2>
    <div class="page-box">
        <label for="first-name" class="form-label">First Name:</label>
        <input type="text" class="form-input" id="first-name" name="first_name" required>
        <br>
        <label for="last-name" class="form-label">Last Name:</label>
        <input type="text" class="form-input" id="last-name" name="last_name" required>
        <br>
        <label for="family" class="form-label">Family Group:</label>
        <input type="text" class="form-input" id="family" name="family_group">
        <br>
        <label for="address" class="form-label">Address:</label>
        <input type="text" class="form-input" id="address" name="address">
        <br>
        <label for="phone" class="form-label">Phone:</label>
        <input type="text" class="form-input" id="phone" name="phone">
        <br>
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-input" id="email" name="email">
        <br>
        <div class="checkbox-container">
            <div class="checkbox-item">
                <label for="rsvp">RSVP</label>
                <input type="checkbox" id="rsvp" name="rsvp">
            </div>
            <div class="checkbox-item">
                <label for="mehendi">Mehendi</label>
                <input type="checkbox" id="mehendi" name="mehendi">
            </div>
            <div class="checkbox-item">
                <label for="grah-shanti">Grah Shanti</label>
                <input type="checkbox" id="grah-shanti" name="grah_shanti">
            </div>
            <div class="checkbox-item">
                <label for="welcome-party">Welcome Party</label>
                <input type="checkbox" id="welcome-party" name="welcome_party">
            </div>
        </div>
        <div class="checkbox-container">
            <div class="checkbox-item">
                <label for="wedding">Wedding</label>
                <input type="checkbox" id="wedding" name="wedding">
            </div>
            <div class="checkbox-item">
                <label for="kankotri">Kankotri</label>
                <input type="checkbox" id="kankotri" name="kankotri">
            </div>
            <div class="checkbox-item">
                <label for="save-the-date">Save the Date</label>
                <input type="checkbox" id="save-the-date" name="save_the_date">
            </div>
        </div>
        <div class="button-container">
            <a href="home.php" class="button left-button">Back</a>
            <button type="submit" class="button right-button">Add</button>
        </div>
    </div>
</form>
</body>
</html>
