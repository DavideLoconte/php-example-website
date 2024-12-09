<?php
session_start();
require "../components/database.php";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: /login.php");
    exit();
}

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST['content'])) {
    header("Location: /index.php");
    exit();
}

$username = $_SESSION['username'];
$content = trim($_POST['content']);

if (empty($content)) {
    // Redirect back to the dashboard with an error message
    $_SESSION['error_message'] = "Post content cannot be empty.";
    header("Location: /index.php");
    exit();
}

// Insert the post into the database
$insert_query = "INSERT INTO Posts (username, content) VALUES ($1, $2)";
$result = pg_query_params($conn, $insert_query, [$username, $content]);

if (!$result) {
    $_SESSION['error_message'] = "An error occurred while creating your post.";
}

// Close the connection
pg_close($conn);

// Redirect back to the dashboard
header("Location: /index.php");
exit();
?>
