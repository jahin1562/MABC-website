<?php
session_start();
include 'db.php';

if (!isset($_SESSION['member_id']) && !isset($_SESSION['guest_id'])) {
    die("Error: Login required. Please login to continue.");
}


$user = "Unknown User";
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
} else {
    if (isset($_SESSION['member_id'])) {
        $res = $conn->query("SELECT username FROM members WHERE id = " . intval($_SESSION['member_id']));
        if ($row = $res->fetch_assoc()) {
            $user = $row['username'];
        }
    } elseif (isset($_SESSION['guest_id'])) {
        $res = $conn->query("SELECT username FROM guest_users WHERE id = " . intval($_SESSION['guest_id']));
        if ($row = $res->fetch_assoc()) {
            $user = $row['username'];
        }
    }
}


if(isset($_POST['submit_question'])) {
    $q = $_POST['question'];
    $dept = $_POST['department'];
    $photo = "";

    if(isset($_FILES['photo_url']) && $_FILES['photo_url']['error'] == 0) {
        $photo = 'uploads/' . time() . '_' . $_FILES['photo_url']['name'];
        move_uploaded_file($_FILES['photo_url']['tmp_name'], $photo);
    }
    $stmt = $conn->prepare("INSERT INTO questions (member_name, department, question, photo_url, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $user, $dept, $q, $photo);
    $stmt->execute();
}


if(isset($_POST['answer'])) {
    $qid = intval($_POST['question_id']);
    $ans = $_POST['answer'];
    
    $stmt = $conn->prepare("INSERT INTO answers (question_id, member_name, answer, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iss", $qid, $user, $ans);
    $stmt->execute();
}

header("Location: qa.php");
exit();
?>