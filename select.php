<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "task_route_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
    <style>
        body{
            font-family: Arial;
            background:#eef2ff;
        }
        .container{
            width:80%;
            margin:auto;
            background:white;
            padding:20px;
            text-align:center;
        }
        table{
            width:100%;
            border-collapse: collapse;
        }
        th, td{
            border:1px solid black;
            padding:10px;
        }
        th{
            background:#c7d2fe;
        }
    </style>
</head>
<body>

<div class="container">
<h2>Registered Users List</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Task</th>
    <th>Deadline</th>
    <th>Gender</th>
    <th>Skills</th>
    <th>Registered On</th>
</tr>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['name']."</td>
        <td>".$row['email']."</td>
        <td>".$row['phone']."</td>
        <td>".$row['task_name']."</td>
        <td>".$row['deadline']."</td>
        <td>".$row['gender']."</td>
        <td>".$row['skills']."</td>
        <td>".$row['created_at']."</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='9'>No records found</td></tr>";
}
?>

</table>
</div>

</body>
</html>

<?php
$conn->close();
?>