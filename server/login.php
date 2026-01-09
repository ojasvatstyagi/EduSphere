<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["username"]; 
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE userName = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            // Login Success
            session_start();
            $_SESSION['user_id'] = $row['id']; // CRITICAL: Store ID for linking
            $_SESSION['username'] = $row['userName'];
            $_SESSION['firstName'] = $row['firstName'];
            header("Location: ../html/index.php");
            exit();
        } else {
            // Invalid Password
            echo_error("Invalid Password");
        }
    } else {
        // User not found
        echo_error("User not found");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}

function echo_error($msg) {
    echo '<!DOCTYPE html>
    <html>    
    <head>        
    <title>Login Failed</title>             
    <style>
      body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f2f2f2; }
      .container { text-align: center; padding: 40px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
      h1 { color: #d9534f; }
      a { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #27ac1f; color: white; text-decoration: none; border-radius: 5px; }
    </style>
    </head>     
    <body>        
    <div class="container">            
        <h1>' . $msg . '</h1>             
        <a href="../html/login_page.html">Try Again</a>
    </div>      
    </body> 
    </html> ';
}
?>
