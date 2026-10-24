<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['name']) || empty($_POST['age']) || empty($_POST['blood_group']) || 
       empty($_POST['institute']) || empty($_POST['department']) || empty($_POST['phone']) || 
       empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || 
       empty($_FILES['img_url']['name'])) {
        
        echo "<script>alert('All fields are required!'); window.history.back();</script>";
        exit;
    }

    $name = $_POST['name'];
    $age = $_POST['age'];
    $bg = $_POST['blood_group'];
    $inst = $_POST['institute'];
    $dept = $_POST['department'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $img_name = time() . '_' . $_FILES['img_url']['name'];
    $upload_path = 'uploads/' . $img_name;
    
    if (move_uploaded_file($_FILES['img_url']['tmp_name'], $upload_path)) {
        $stmt = $conn->prepare("INSERT INTO guest_users (name, age, img_url, blood_group, institute, department, phone, email, username, password) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sissssssss", $name, $age, $upload_path, $bg, $inst, $dept, $phone, $email, $user, $pass);
        
        if ($stmt->execute()) {
            echo "<script>alert('Registration Successful!'); window.location='login.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>alert('Failed to upload image!'); window.history.back();</script>";
    }

    $img_name = time() . '_' . $_FILES['img_url']['name'];
    move_uploaded_file($_FILES['img_url']['tmp_name'], 'uploads/' . $img_name);
    $img_path = 'uploads/' . $img_name;

    $stmt = $conn->prepare("INSERT INTO guest_users (name, age, img_url, blood_group, institute, department, phone, email, username, password) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sissssssss", $name, $age, $img_path, $bg, $inst, $dept, $phone, $email, $user, $pass);
    
    if ($stmt->execute()) {
        echo "<script>alert('Registration Successful!'); window.location='login.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>