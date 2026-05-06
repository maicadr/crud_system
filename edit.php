<?php
require 'db.php';

// Check if ID exists
if (!isset($_GET['id'])) {
    die("No ID specified.");
}

$id = $_GET['id'];

// Fetch student data
$stmt = $conn->prepare("SELECT * FROM studentinfo WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("Student not found.");
}

// Update on form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];

    $update = $conn->prepare("UPDATE studentinfo SET name = ?, age = ? WHERE id = ?");
    $update->execute([$name, $age, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

<h2>Edit Student</h2>

<form method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" 
        value="<?php echo htmlspecialchars($student['name']); ?>" required><br><br>

    <label>Age:</label><br>
    <input type="number" name="age" 
        value="<?php echo htmlspecialchars($student['age']); ?>" required><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>