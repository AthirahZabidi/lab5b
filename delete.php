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
    $sql = "DELETE FROM users WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $matric);
    if ($stmt->execute()) {
        header("Location: display_users.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>
