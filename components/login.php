<?php
    // This file is included in all pages requiring authentication
    // It checks if the user is logged in and redirects to the login page if not
    if ($logged === false) {
        header('Location: /login.php');
        exit;
    } 
?>
