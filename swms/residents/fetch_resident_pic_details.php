<?php
// Include your database connection file
include_once '../database/connection.php';

$response = array();

// Start or resume the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile-pic"])) {
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["profile-pic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile-pic"]["tmp_name"]);
    if ($check === false) {
        $response['status'] = 'error';
        $response['message'] = 'File is not an image.';
        echo json_encode($response);
        exit();
    }

    // Check file size
    if ($_FILES["profile-pic"]["size"] > 500000) {
        $response['status'] = 'error';
        $response['message'] = 'Sorry, your file is too large.';
        echo json_encode($response);
        exit();
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $response['status'] = 'error';
        $response['message'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        echo json_encode($response);
        exit();
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $response['status'] = 'error';
        $response['message'] = 'Sorry, your file was not uploaded.';
        echo json_encode($response);
        exit();
    } else {
        if (move_uploaded_file($_FILES["profile-pic"]["tmp_name"], $target_file)) {
            // Read the file content
            $imageData = file_get_contents($target_file);
            // Encode the file content for insertion
            $encodedImageData = base64_encode($imageData);
            
            // Insert the encoded file data into the database
            $stmt = $conn->prepare("UPDATE residents SET profile_pic = ? WHERE username = ?");
            $stmt->bind_param("ss", $encodedImageData, $_SESSION['username']);
            $stmt->execute();
            $response['status'] = 'success';
            $response['message'] = 'Profile picture successfully updated';
            $response['profile_pic'] = $target_file; // Return the path to the new profile picture
            echo json_encode($response);
            exit();
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Sorry, there was an error uploading your file.';
            echo json_encode($response);
            exit();
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'No file uploaded.';
    echo json_encode($response);
    exit();
}
?>
