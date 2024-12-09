<?php

session_start();

if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit;
};

$host = 'localhost';
$dbname = 'Lab_5b';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "SELECT * FROM users WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $matric);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $name, $role, $matric);
    if ($stmt->execute()) {
        header("Location: display_users.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        a {
            text-align: center;
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    
    <form method="POST" action="update.php">
        <h3>Update User</h3>
        <label>Matric:</label>
        <input type="text" name="matric" value="<?= htmlspecialchars($user['matric']) ?>" readonly><br><br>
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>
        <label>Access Level:</label>
        <select name="role">
            <option value="student" <?= $user['role'] == 'student' ? 'selected' : '' ?>>Student</option>
            <option value="lecturer" <?= $user['role'] == 'lecturer' ? 'selected' : '' ?>>Lecturer</option>
        </select><br><br>
        <button type="submit">Update</button>
        <a href="display_users.php">Cancel</a>
    </form>
</body>
</html>
