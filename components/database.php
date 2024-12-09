<?php
    // Database configuration: this file is included in all pages that
    // need to connect to the database, and exposes the $conn variable
    $host = "localhost";
    $dbname = "website";
    $user = "davide";

    // Connect to PostgreSQL
    $conn = pg_connect("host=$host dbname=$dbname user=$user");
    if (!$conn) {
        die("Database connection failed: " . pg_last_error());
    }
?>
