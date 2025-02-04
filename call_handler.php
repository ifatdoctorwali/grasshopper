<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phoneNumber = $_POST['phone_number'] ?? null;

    if (!$phoneNumber || !preg_match('/^\+?[0-9]{10,15}$/', $phoneNumber)) {
        echo "Invalid phone number.";
        exit;
    }

    // Simulate calling logic
    echo "Calling " . htmlspecialchars($phoneNumber) . "...";
    // Integrate API for actual call handling
} else {
    echo "Invalid request method.";
}
?>
