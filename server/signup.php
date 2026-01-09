<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $userName = $_POST["userName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];

    // Basic validation
    if ($password !== $repeatPassword) {
        echo "<script>alert('Passwords do not match'); window.location.href='../html/sign_up_page.html';</script>";
        exit;
    }

    // Check if user already exists
    $checkSql = "SELECT * FROM users WHERE userName = ? OR email = ?";
    $stmt = mysqli_prepare($con, $checkSql);
    mysqli_stmt_bind_param($stmt, "ss", $userName, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
         echo "<script>alert('Username or Email already exists'); window.location.href='../html/sign_up_page.html';</script>";
         exit;
    }
    mysqli_stmt_close($stmt);

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $sql = "INSERT INTO users (firstName, lastName, userName, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $userName, $email, $hashed_password);

    if (mysqli_stmt_execute($stmt)) {
        // Get the new user's ID
        $new_user_id = mysqli_insert_id($con);
        
        // Create a corresponding entry in the profile table
        $profile_sql = "INSERT INTO profile (user_id, first_name, last_name) VALUES (?, ?, ?)";
        $profile_stmt = mysqli_prepare($con, $profile_sql);
        mysqli_stmt_bind_param($profile_stmt, "iss", $new_user_id, $firstName, $lastName);
        mysqli_stmt_execute($profile_stmt);
        mysqli_stmt_close($profile_stmt);

        echo '
        <!DOCTYPE html>
        <html>    
        <head>        
        <title>Registration Successful</title>
        <link rel="stylesheet" href="../css/sign_up.css">     
        </head>     
        <body>        
        <div class="container">            
        <div class="content">                
        <h1>Account Successfully Created!</h1>
        <a href="../html/login_page.html" style="display:block; text-align:center; padding:10px; background-color:#27ac1f; color:white; text-decoration:none; border-radius:5px;">Go to Login</a>             
        </div>          
        </div>      
        </body> 
        </html> '; 
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
