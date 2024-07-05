<?php
// Include database connection file
require_once('db_connection.php');

// Registration form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['register-username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['register-email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['register-password']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into database
    $sql = "INSERT INTO users (id_users, username, email, user_password) VALUES (NULL, '$username', '$email', '$hashed_password')";

    if ($koneksi->query($sql) === TRUE) {
        // Registration successful
        echo '<p>Registration successful. You can now <a href="login.php">login</a>.</p>';
    } else {
        // Registration failed
        echo '<p>Registration failed. Please try again later.</p>';
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
    <title>User Registration</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-md">
        <h2 class="text-2xl font-bold text-center py-4 bg-gray-200">User Registration</h2>
        
        <form class="p-4" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="mb-4">
                <label for="register-username" class="block text-gray-700">Username:</label>
                <input type="text" id="register-username" name="register-username" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="register-email" class="block text-gray-700">Email:</label>
                <input type="email" id="register-email" name="register-email" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="mb-6">
                <label for="register-password" class="block text-gray-700">Password:</label>
                <input type="password" id="register-password" name="register-password" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="text-center">
                <button type="submit" name="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Register
                </button>
            </div>
        </form>
        
      
    </div>
</body>
</html>
