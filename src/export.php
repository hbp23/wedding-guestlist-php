<?php

include '../includes/auth.php';
include '../includes/database.php';
/** @var mysqli $conn */

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="guestlist.csv"');

$output = fopen('php://output', 'w');

// CSV column headers
fputcsv($output, ['First Name', 'Last Name', 'Family Group', 'Address', 'Phone', 'Email', 'RSVP', 'Mehendi', 'Grah Shanti', 'Welcome Party', 'Wedding', 'Kankotri', 'Save the Date']);

// Fetch guest data for current user
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT first_name, last_name, family_group, address, phone, email, rsvp, mehendi, grah_shanti, welcome_party, wedding, kankotri, save_the_date FROM guests WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Output rows to CSV
while ($row = $result->fetch_assoc()) {
    // Convert boolean fields to Yes/No
    $row = array_map(function ($value) {
        return ($value === 1 || $value === '1') ? 'Yes' : (($value === 0 || $value === '0') ? 'No' : $value);
    }, $row);
    fputcsv($output, $row);
}

fclose($output);
exit();

