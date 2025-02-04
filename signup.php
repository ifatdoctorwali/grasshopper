// Include the database connection
require 'db_connection.php';

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required!";
    } else {
        // Check if username or email already exists
        $check_sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Username or Email already taken!";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare SQL query to insert user
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            // Execute the query and check for success
            if ($stmt->execute()) {
                // Success
                echo "Signup successful! You can now <a href='login.php'>login</a>";
            } else {
                // Error while inserting into the database
                echo "Error: " . $stmt->error;
            }
        }
    }
}
?>

<!-- HTML Form for signup -->
<form action="signup.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    
    <button type="submit">Sign Up</button>
</form>
