<?php
// Checks for the submitted user credentials and logs the user in if 
// they are correct
session_start();

require "../components/database.php";

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $hashed_password = md5($password); // Hash the password with MD5 (lecture example, not recommended for real-world use)

    // MD5 is insecure. In real world examples, you should use stronger
    // Hashing mechanism with salting

    // Check if the username exists in the database
    $query = "SELECT password FROM Users WHERE username = $1";

    // Use pg_query_params for parameterized queries
    $result = pg_query_params($conn, $query, [$username]);

    if (!$result) {
        die("Query failed: " . pg_last_error());
    }

    // Alternative: Use pg_prepare and pg_execute for prepared statements 
    // (Prepare compile the query for additional performance when executing multiple times)
    
    /*
    pg_prepare($conn, "check_user", "SELECT password_hash FROM Users WHERE username = $1");
    $result = pg_execute($conn, "check_user", [$username]);
    */

    if (pg_num_rows($result) === 0) {
        // Redirect to error page if username does not exist
        $_SESSION['error_message'] = "Username does not exist.";
        pg_close($conn);
        header("Location: /index.php");
        exit();
    }

    $user = pg_fetch_assoc($result);

    // Check if the hashed password matches
    if ($user['password'] === $hashed_password) {
        // Set up session variables
        $_SESSION['user_logged_in'] = true;
        $_SESSION['username'] = $username;

        // Create a unique session ID
        session_regenerate_id(true);

        // Redirect to dashboard
        pg_close($conn);
        header("Location: /index.php");
        exit();
    } else {
        // Redirect to error page if password does not match
        pg_close($conn);
        $_SESSION['error_message'] = "Password do not match.";
        header("Location: /index.php");
        exit();
    }
} else {
    // Redirect to login page if accessed directly
    pg_close($conn);
    header("Location: /index.php");
    exit();
}
?>

