<?php
// Ends the session on logout
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the dashboard
header("Location: /index.php");
exit();
?>
