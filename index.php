<?php
// DATABASE CONNECTION
$conn = new mysqli("localhost", "root", "", "crudsystem");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// FETCH DATA
$result = $conn->query("SELECT * FROM studentinfo");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Information System</title>
</head>
<body>

<h2>Add Student</h2>
<form method="POST" action="create.php">
    Name: <input type="text" name="name" required>
    Age: <input type="number" name="age" required>
    <button type="submit">Add</button>
</form>

<h2>Student List</h2>
<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Age</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row["id"] ?></td>
    <td><?= $row["name"] ?></td>
    <td><?= $row["age"] ?></td>
    <td>
        <a href="update.php?id=<?= $row["id"] ?>">Edit</a>
        <a href="delete.php?id=<?= $row["id"] ?>">Delete</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>

<?php
$conn->close();
?>