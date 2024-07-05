<?php
// Include database connection file
require_once('db_connection.php');

// Initialize variables to store input data and error messages
$first_name = $last_name = $email = $phone = $message_subject = $message_detail = '';
$errors = [];

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Validate and sanitize inputs
    $first_name = mysqli_real_escape_string($koneksi, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($koneksi, $_POST['last_name']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $phone = mysqli_real_escape_string($koneksi, $_POST['phone']);
    $message_subject = mysqli_real_escape_string($koneksi, $_POST['message_subject']);
    $message_detail = mysqli_real_escape_string($koneksi, $_POST['message_detail']);

    // Validate required fields
    if (empty($first_name)) {
        $errors[] = "First name is required.";
    }
    // Add more validation for other fields as needed

    // If no errors, insert data into database
    if (empty($errors)) {
        // SQL query to insert data into `contact` table
        $sql = "INSERT INTO contact (id_contact, frist_name, last_name, email, phone, massage_subject, massage_detail) 
                VALUES (NULL, '$first_name', '$last_name', '$email', '$phone', '$message_subject', '$message_detail')";

        if ($koneksi->query($sql) === TRUE) {
            // Insert successful
            echo '<p class="text-green-600">Message sent successfully.</p>';
            // Optionally, redirect to another page after successful insertion
            // header("Location: success.php");
            // exit;
        } else {
            // Insert failed
            echo '<p class="text-red-600">Error: ' . $koneksi->error . '</p>';
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo '<p class="text-red-600">' . $error . '</p>';
        }
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
    <title>Contact Form</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-md">
        <h2 class="text-2xl font-bold text-center py-4 bg-gray-200">Contact Us</h2>
        
        <form class="p-4" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="mb-4">
                <label for="first_name" class="block text-gray-700">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="last_name" class="block text-gray-700">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="phone" class="block text-gray-700">Phone:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="message_subject" class="block text-gray-700">Message Subject:</label>
                <input type="text" id="message_subject" name="message_subject" value="<?php echo htmlspecialchars($message_subject); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="mb-6">
                <label for="message_detail" class="block text-gray-700">Message Detail:</label>
                <textarea id="message_detail" name="message_detail" rows="4" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"><?php echo htmlspecialchars($message_detail); ?></textarea>
            </div>
            
            <div class="text-center">
                <button type="submit" name="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Send Message
                </button>
            </div>
        </form>
    </div>
</body>
</html>
