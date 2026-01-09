<?php
include 'db_connect.php';

$sql = "SHOW COLUMNS FROM profile LIKE 'photo_path'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) == 0) {
    $sql = "ALTER TABLE profile ADD COLUMN photo_path VARCHAR(255) DEFAULT NULL";
    if (mysqli_query($con, $sql)) {
        echo "Column 'photo_path' added successfully to 'profile' table.";
    } else {
        echo "Error adding column: " . mysqli_error($con);
    }
} else {
    echo "Column 'photo_path' already exists.";
}

mysqli_close($con);
?>
