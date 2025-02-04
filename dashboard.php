<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Dummy data for logged-in user
$username = $_SESSION['username'] ?? 'User';

// Include database connection (update the path as needed)
// include 'db_connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>Dashboard: Manage your calls and messages</p>

    <!-- Form for making a call -->
    <h2>Make a Call</h2>
    <form action="call_handler.php" method="POST">
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" placeholder="+1234567890" required>
        <button type="submit">Call</button>
    </form>

    <!-- Form for sending a message -->
    <h2>Send a Message</h2>
    <form action="message_handler.php" method="POST">
        <label for="recipient">Recipient:</label>
        <input type="text" id="recipient" name="recipient" placeholder="+1234567890" required>
        <br>
        <label for="message">Message:</label>
        <textarea id="message" name="message" placeholder="Write your message here..." required></textarea>
        <br>
        <button type="submit">Send Message</button>
    </form>

    <!-- Logout link -->
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
