<?php
session_start();
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM guest_users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        if ($pass === $row['password']) {
            $_SESSION['guest_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_type'] = 'guest'; 
        
            header("Location: index.php"); 
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password!";
            header("Location: login.php");
        }
    } else {
        $_SESSION['error'] = "Invalid username or password!";
        header("Location: login.php");
    }
} else {
    header("Location: login.php");
    exit();
}
?>