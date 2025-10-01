<?php
include '../includes/auth.php';
include '../includes/database.php';
/** @var mysqli $conn */

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
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

    $stmt = $conn->prepare("UPDATE guests SET 
        first_name=?, last_name=?, family_group=?, address=?, phone=?, email=?, rsvp=?, mehendi=?, grah_shanti=?, welcome_party=?, wedding=?, kankotri=?, save_the_date=?
        WHERE id=? AND user_id=?");

    $stmt->bind_param("ssssssiiiiiiiii", $first_name, $last_name, $family_group, $address, $phone, $email, $rsvp, $mehendi, $grah_shanti, $welcome_party, $wedding, $kankotri, $save_the_date, $id, $user_id);

    if ($stmt->execute()) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

// Load existing data
$stmt = $conn->prepare("SELECT * FROM guests WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$guest = $result->fetch_assoc();

if (!$guest) {
    echo "Guest not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Guest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/wedding.css">
</head>
<body>
<form method="POST">
    <h2 class="page-heading">Edit Guest</h2>
    <div class="page-box">
        <label for="first-name" class="form-label">First Name:</label>
        <input type="text" class="form-input" id="first-name" name="first_name" value="<?= htmlspecialchars($guest['first_name']) ?>" required>
        <br>
        <label for="last-name" class="form-label">Last Name:</label>
        <input type="text" class="form-input" id="last-name" name="last_name" value="<?= htmlspecialchars($guest['last_name']) ?>" required>
        <br>
        <label for="family" class="form-label">Family Group:</label>
        <input type="text" class="form-input" id="family" name="family_group" value="<?= htmlspecialchars($guest['family_group']) ?>">
        <br>
        <label for="address" class="form-label">Address:</label>
        <input type="text" class="form-input" id="address" name="address" value="<?= htmlspecialchars($guest['address']) ?>">
        <br>
        <label for="phone" class="form-label">Phone:</label>
        <input type="text" class="form-input" id="phone" name="phone" value="<?= htmlspecialchars($guest['phone']) ?>">
        <br>
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-input" id="email" name="email" value="<?= htmlspecialchars($guest['email']) ?>">
        <br>
        <div class="checkbox-container">
            <div class="checkbox-item">
                <label for="rsvp">RSVP</label>
                <input type="checkbox" id="rsvp" name="rsvp" <?= $guest['rsvp'] ? 'checked' : '' ?>>
            </div>
            <div class="checkbox-item">
                <label for="mehendi">Mehendi</label>
                <input type="checkbox" id="mehendi" name="mehendi" <?= $guest['mehendi'] ? 'checked' : '' ?>>
            </div>
            <div class="checkbox-item">
                <label for="grah-shanti">Grah Shanti</label>
                <input type="checkbox" id="grah-shanti" name="grah_shanti" <?= $guest['grah_shanti'] ? 'checked' : '' ?>>
            </div>
            <div class="checkbox-item">
                <label for="welcome-party">Welcome Party</label>
                <input type="checkbox" id="welcome-party" name="welcome_party" <?= $guest['welcome_party'] ? 'checked' : '' ?>>
            </div>
        </div>
        <div class="checkbox-container">
            <div class="checkbox-item">
                <label for="wedding">Wedding</label>
                <input type="checkbox" id="wedding" name="wedding" <?= $guest['wedding'] ? 'checked' : '' ?>>
            </div>
            <div class="checkbox-item">
                <label for="kankotri">Kankotri</label>
                <input type="checkbox" id="kankotri" name="kankotri" <?= $guest['kankotri'] ? 'checked' : '' ?>>
            </div>
            <div class="checkbox-item">
                <label for="save-the-date">Save the Date</label>
                <input type="checkbox" id="save-the-date" name="save_the_date" <?= $guest['save_the_date'] ? 'checked' : '' ?>>
            </div>
        </div>
        <div class="button-container">
            <a href="home.php" class="button left-button">Back</a>
            <button type="submit" class="button right-button">Update</button>
        </div>
    </div>
</form>
</body>
</html>
