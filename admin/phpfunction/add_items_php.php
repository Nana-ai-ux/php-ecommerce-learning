<?php
$message = "";


if (isset($_POST['submit'])) {

    $name = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['name']));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password']));
    $cpass = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['cpass']));
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];


    $allowed_file_types = ['image/jpeg', 'image/png', 'image/gif'];
    $file_type = mime_content_type($image_tmp);
    
    if (!in_array($file_type, $allowed_file_types)) {
        $message = "Please upload a valid image file (jpg, png, gif).";
    } else {
        move_uploaded_file($image_tmp, "productimage/$image");
    }


    if (empty($name)) {
        $message = 'Hi, name is empty';
    } elseif (empty($password)) {
        $message = "Password is empty";
    } elseif (empty($cpass)) {
        $message = "Confirm password is empty";
    } elseif ($password !== $cpass) {
        $message = "Password and confirm password didn't match";
    } elseif (empty($image)) {
        $message = "Enter an image";
    } else {
        
        $stmt = $conn->prepare("SELECT * FROM user_info WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->num_rows;
        $stmt->close();

        if ($count > 0) {
            $message = "This username already exists, try to login!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO user_info (name, password, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $hashed_password, $image);
            if ($stmt->execute()) {
                $message = "Registration successful";
                header("Location: view_product.php");
                exit();
            } else {
                $message = "Error trying to register, please try again";
            }
            $stmt->close();
        }
    }
}
?>