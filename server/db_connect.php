<?php
// FILE: server/db_connect.php

$is_local = true; 

if ($is_local) {
    // --- Localhost Settings (XAMPP/WAMP) ---
    $servername = "localhost";
    $username   = "your_username";
    $password   = "your_password"; // Default XAMPP is empty string "", MAMP is "root"
    $dbname     = "your_dbname";
} else {
    $servername = "sql213.infinityfree.com"; // e.g., sql304.infinityfree.com
    $username   = "your_username";            // e.g., if0_37123456
    $password   = "your_password";   // Your hosting account password
    $dbname     = "your_dbname";   // Note: InfinityFree adds a prefix
}

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    // Show a user-friendly error message
    die("<h3>Database Connection Failed</h3>" . 
        "<p><strong>Error Message:</strong> " . mysqli_connect_error() . "</p>" .
        "<p><strong>Troubleshooting:</strong><br>" .
        "1. Did you update the <code>server/db_connect.php</code> file with your hosting details?<br>" .
        "2. Is the <code>\$is_local</code> variable set to <code>false</code>?<br>" .
        "3. Did you verify the Password and Database Name from your Control Panel?</p>");
}
?>
