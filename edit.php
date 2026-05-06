<?php
require 'db.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = $_GET['id'];

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Record not found.");
}

// Update data when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $update = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $update->execute([$name, $email, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

<form method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>