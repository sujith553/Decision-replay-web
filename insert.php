<?php

// Database connection
$conn = new mysqli("localhost", "root", "", "task_route_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name     = isset($_POST['name']) ? $_POST['name'] : '';
$email    = isset($_POST['email']) ? $_POST['email'] : '';
$phone    = isset($_POST['phone']) ? $_POST['phone'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$task     = isset($_POST['task']) ? $_POST['task'] : '';
$deadline = isset($_POST['deadline']) ? $_POST['deadline'] : NULL;
$gender   = isset($_POST['gender']) ? $_POST['gender'] : '';

// Handle multiple skills (checkbox)
$skills = "";
if (isset($_POST['skills'])) {
    $skills = implode(",", $_POST['skills']);
}

// Debug: show received data
error_log("POST data: " . json_encode($_POST));

// Hash password (IMPORTANT)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert query
$sql = "INSERT INTO users (name, email, phone, password, task_name, deadline, gender, skills)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("ssssssss", $name, $email, $phone, $hashed_password, $task, $deadline, $gender, $skills);
    if ($stmt->execute()) {
        echo "<h3 style='color:green;'>Registration Successful!</h3>";
        echo "<a href='select.php'>View Users</a>";
    } else {
        echo "Insert failed: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Prepare failed: " . $conn->error;
}

// Close connection
$conn->close();

?>