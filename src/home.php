<?php
include '../includes/auth.php';
include '../includes/database.php';
/** @var mysqli $conn */

// Get guests for the logged-in user with search and sorting
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'last_name';

$allowedSorts = ['first_name', 'last_name', 'family_group'];
if (!in_array($sort, $allowedSorts)) {
    $sort = 'last_name';
}

$sql = "SELECT * FROM guests WHERE user_id = ? 
        AND (first_name LIKE CONCAT('%', ?, '%') OR last_name LIKE CONCAT('%', ?, '%')) 
        ORDER BY $sort";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id, $search, $search);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Guest List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/weddinghome.css">
</head>
<body>
<h2 class="page-heading">Wedding Guest List</h2>
<div class="page-box">
    <h2 class="box-heading">Welcome, <span class="username"><?= htmlspecialchars($username) ?></span>!</h2>
    <div class="search-box">
    <form method="GET" style="margin-bottom: 15px;">
        <label><input type="text" name="search" placeholder="Search name..."
                      value="<?= htmlspecialchars($search) ?>"></label>
        <label><select name="sort">
                <option value="first_name" <?= $sort == 'first_name' ? 'selected' : '' ?>>Sort by First Name</option>
                <option value="last_name" <?= $sort == 'last_name' ? 'selected' : '' ?>>Sort by Last Name</option>
                <option value="family_group" <?= $sort == 'family_group' ? 'selected' : '' ?>>Sort by Family Group
                </option>
            </select></label>
        <button type="submit">Search & Sort</button>
    </form>
    </div>
    <div class="button-container">
    <a class="button left-button" href="add.php">Add Guest</a> |
    <a class="button middle-button" href="export.php">Export CSV</a> |
    <a class="button right-button" href="logout.php">Logout</a>
    </div>
    <table class="my-table">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Family Group</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>RSVP</th>
            <th>Mehendi</th>
            <th>Grah Shanti</th>
            <th>Welcome Party</th>
            <th>Wedding</th>
            <th>Kankotri</th>
            <th>Save the Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row['first_name']) ?></td>
                <td><?= htmlspecialchars($row['last_name']) ?></td>
                <td><?= htmlspecialchars($row['family_group']) ?></td>
                <td><?= htmlspecialchars($row['address']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= $row['rsvp'] ? 'Yes' : 'No' ?></td>
                <td><?= $row['mehendi'] ? 'Yes' : 'No' ?></td>
                <td><?= $row['grah_shanti'] ? 'Yes' : 'No' ?></td>
                <td><?= $row['welcome_party'] ? 'Yes' : 'No' ?></td>
                <td><?= $row['wedding'] ? 'Yes' : 'No' ?></td>
                <td><?= $row['kankotri'] ? 'Yes' : 'No' ?></td>
                <td><?= $row['save_the_date'] ? 'Yes' : 'No' ?></td>
                <td>
                    <a class="guest-button left-button" href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a class="guest-button right-button" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this guest?');">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>

