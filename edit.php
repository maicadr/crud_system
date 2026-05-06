<?php
require 'db.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = $_GET['id'];

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM studentinfo WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Record not found.");
}

// Update data when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];

    $update = $conn->prepare("UPDATE studentinfo SET name = ?, age = ? WHERE id = ?");
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
    <input type="text" name="name" value="<?php echo htmlspecialchars($studentinfo['name']); ?>" required><br><br>

    <label>Age:</label><br>
    <input type="age" name="age" value="<?php echo htmlspecialchars($studentinfo['age']); ?>" required><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>