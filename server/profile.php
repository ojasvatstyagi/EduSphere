<?php
session_start();
include 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please login first.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    
    // Collecting data
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $aadhaar_name = $_POST['full_name_as_per_aadhaar'] ?? '';
    $father_name = $_POST['father_name'] ?? '';
    $mother_name = $_POST['mother_name'] ?? '';
    $dob = $_POST['date_of_birth'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $branch = $_POST['branch'] ?? '';
    $section = $_POST['section'] ?? '';
    $languages = $_POST['languages'] ?? '';
    
    // File Upload Handling
    $photo_path = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "../assets/uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
        $new_filename = "profile_" . $user_id . "_" . time() . "." . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        // Allow certain file formats
        $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array(strtolower($file_extension), $allowed_types)) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $photo_path = $target_file;
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file type.";
        }
    }

    // Check if profile exists for this user
    // We construct an UPDATE query. 
    // Ideally, we should check existing photo to delete it, but let's keep it simple.
    
    if ($photo_path) {
        $sql = "UPDATE profile SET 
                first_name = ?, 
                last_name = ?, 
                aadhaar_name = ?, 
                father_name = ?, 
                mother_name = ?, 
                dob = ?, 
                gender = ?, 
                languages_known = ?, 
                branch = ?, 
                section = ?,
                photo_path = ?
                WHERE user_id = ?";
        
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssssssi", 
            $first_name, $last_name, $aadhaar_name, $father_name, $mother_name, 
            $dob, $gender, $languages, $branch, $section, $photo_path, $user_id
        );
    } else {
        $sql = "UPDATE profile SET 
                first_name = ?, 
                last_name = ?, 
                aadhaar_name = ?, 
                father_name = ?, 
                mother_name = ?, 
                dob = ?, 
                gender = ?, 
                languages_known = ?, 
                branch = ?, 
                section = ?
                WHERE user_id = ?";
        
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssssi", 
            $first_name, $last_name, $aadhaar_name, $father_name, $mother_name, 
            $dob, $gender, $languages, $branch, $section, $user_id
        );
    }

    if (mysqli_stmt_execute($stmt)) {
        // Update session name if changed
        $_SESSION['firstName'] = $first_name; 
        echo "<script>alert('Profile updated successfully!'); window.location.href='../html/index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
