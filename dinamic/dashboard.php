<?php
// Initialize session (if not already started)
session_start();

// Include database connection file
require_once('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = $koneksi->query($sql);

// Close database connection
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .user-list {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
        }

        .user-list-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
        }

        .user-list-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Dashboard</h2>
        
        <ul class="user-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="user-list-item">' . htmlspecialchars($row['username']) . ' - ' . htmlspecialchars($row['email']) . '</li>';
                }
            } else {
                echo '<li class="user-list-item">No users found.</li>';
            }
            ?>
        </ul>
        
        <p><a href="login.php">Logout</a></p>
    </div>
</body>
</html>
