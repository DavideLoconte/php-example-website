<?php
    // Retrieves the data from the session 
    session_start();


    // Check if the user is logged in
    if (isset($_SESSION['username'])) {
        $logged = true;
        $username = htmlspecialchars($_SESSION['username']);
    } else {
        $logged = false;
    }
?>
