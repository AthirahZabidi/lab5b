<?php
session_start();

if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit;
};
?>

<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
</head>
<body>
    <p>Invalid username or password, try <a href="login.php">login</a> again.</p>
</body>
</html>
