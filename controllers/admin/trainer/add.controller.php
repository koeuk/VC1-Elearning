<?php
require '../../../database/database.php';
require '../../../models/user.model.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $gender = 'Male';
    if (isset($_POST['gender']) && $_POST['gender'] == 'Female') {
        $gender = 'Female';
    }
    
    if (isset($_FILES['image']['name']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../../../uploading/' . $image; // Updated the image folder path
        $image_size = $_FILES['image']['size'];

        // Perform validation for the required form inputs
        if (!empty($name) && !empty($email) && !empty($password) && !empty($phone)) {
            // Move the uploaded image to the destination folder
            move_uploaded_file($image_tmp_name, $image_folder);
            addTrainer($name, $email, $password, $phone, $gender, $image); // Assuming you have implemented the addTrainer() function to insert data into the database
        }
    } else {
        // No image file uploaded, use a default image

        // Perform validation for the required form inputs
        if (!empty($name) && !empty($email) && !empty($password) && !empty($phone)) {
            $image = "non.webp";
            addTrainer($name, $email, $password, $phone, $gender, $image); // Assuming you have implemented the addTrainer() function to insert data into the database
        }
    }

    header("Location: /list_trainer");
    exit();
}
?>