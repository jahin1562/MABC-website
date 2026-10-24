<?php
session_start();
include 'db.php'; 

$user = mysqli_real_escape_string($conn, $_POST['username']);
$pass = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM members WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$res = $stmt->get_result();

if ($row = $res->fetch_assoc()) {
    if ($pass === $row['password']) {
        $_SESSION['member_id'] = $row['id'];
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password!";
        header("Location: login.php");
    }
} else {
    $_SESSION['error'] = "Invalid username or password!";
    header("Location: login.php");
}
?>