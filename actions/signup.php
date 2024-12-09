<?php
// Allow a new user to sign up

session_start();

require "../components/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);
    
    if ($password !== $password2) {
        $_SESSION['error_message'] = "The password do not match.";
        pg_close($conn);
        header("Location: /signup.php");
        exit();
    }

    $hashed_password = md5($password); // For lecture purposes, replace with stronger hashing in real-world use

    // Check if the username already exists
    $check_query = "SELECT username FROM Users WHERE username = $1";
    $check_result = pg_query_params($conn, $check_query, [$username]);

    if (!$check_result) {
        $_SESSION['error_message'] = "An error occurred while checking the username.";
        header("Location: /signup.php");
        exit();
    } elseif (pg_num_rows($check_result) > 0) {
        $_SESSION['error_message'] = "Username already exists. Please choose a different one.";
        header("Location: /signup.php");
        exit();
    } else {
        // Insert the new user
        $insert_query = "INSERT INTO Users (username, password) VALUES ($1, $2)";
        $insert_result = pg_query_params($conn, $insert_query, [$username, $hashed_password]);

        if (!$insert_result) {
            $_SESSION['error_message'] = "An error occurred while creating your account.";
        } else {
            // Set session variables
            $_SESSION['user_logged_in'] = true;
            $_SESSION['username'] = $username;

            // Redirect to the homepage
            pg_close($conn);
            header("Location: /index.php");
            exit();
        }
    }
}

// Close the PostgreSQL connection
pg_close($conn);
?>
