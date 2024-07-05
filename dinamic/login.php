<?php
// Initialize session (if not already started)
session_start();

// Include database connection file
require_once('db_connection.php');

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to dashboard or home page if logged in
    header("Location: dashboard.php");
    exit;
}

// Login form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['login-username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['login-password']);

    // Fetch user data based on username
    $sql = "SELECT id_users, username, user_password FROM users WHERE username = '$username'";
    $result = $koneksi->query($sql);

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['user_password'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $row['id_users'];
            $_SESSION['username'] = $row['username'];

            // Redirect to dashboard or home page
            header("Location: dashboard.php");
            exit;
        } else {
            // Password is incorrect
            $login_error = "Invalid username or password.";
        }
    } else {
        // User not found
        $login_error = "Invalid username or password.";
    }

    // Close database connection
    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4">User Login</h2>
        
        <form class="space-y-4" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="flex flex-col">
                <label for="login-username" class="mb-1">Username:</label>
                <input type="text" id="login-username" name="login-username" required
                    class="px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="flex flex-col">
                <label for="login-password" class="mb-1">Password:</label>
                <input type="password" id="login-password" name="login-password" required
                    class="px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="flex justify-center">
                <button type="submit" name="login"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Login
                </button>
            </div>
        </form>

        <?php
        if (isset($login_error)) {
            echo '<p class="text-red-500 mt-2">' . $login_error . '</p>';
        }
        ?>
    </div>
</body>
</html>
