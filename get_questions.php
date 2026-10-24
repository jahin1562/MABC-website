<?php
session_start();
include 'db.php'; 
header('Content-Type: application/json');

$isLoggedIn = isset($_SESSION['member_id']) || isset($_SESSION['guest_id']);

if (!$isLoggedIn) {
    echo json_encode(['error' => 'Unauthorized']); 
    exit();
}

$query = mysqli_query($conn, "SELECT * FROM quiz_questions ORDER BY RAND()");

if (!$query) {
    echo json_encode(['error' => 'Database Query Failed: ' . mysqli_error($conn)]);
    exit();
}

$questions = [];
while($row = mysqli_fetch_assoc($query)) {
    $questions[] = $row;
}

echo json_encode($questions);
?>