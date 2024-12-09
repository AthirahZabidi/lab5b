<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>
    <form action="register.php" method="POST">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="">Please select</option>
            <option value="Student">Student</option>
            <option value="Lecturer">Lecturer</option>
        </select><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
