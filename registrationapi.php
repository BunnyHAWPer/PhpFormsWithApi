<?php
include("dbconfig.php");

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $profile_image = strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));

    $allowedImageTypes = array("jpg", "jpeg", "png", "gif");
    $uploadOk = 1;

    $checkUserQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkUserResult = $conn->query($checkUserQuery);

    if ($checkUserResult->num_rows > 0) {
        $response["status"] = "error";
        $response["message"] = "User already exists in the database.";
        $uploadOk = 0;
    } else {
        if (!empty($profile_image) && !in_array($profile_image, $allowedImageTypes)) {
            $response["status"] = "error";
            $response["message"] = "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        $target_dir = "uploads/profile_images/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);

        if (!empty($profile_image) && $uploadOk == 1) {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO users (name, email, password, profile_image) VALUES ('$name', '$email', '$password', '$target_file')";
                if ($conn->query($sql) === TRUE) {
                    $response["status"] = "success";
                    $response["message"] = "File uploaded and database updated successfully.";
                } else {
                    $response["status"] = "error";
                    $response["message"] = "Error: " . $conn->error;
                }
            } else {
                $response["status"] = "error";
                $response["message"] = "Sorry, there was an error uploading your file.";
            }
        } else {
            $sql = "INSERT INTO users (name, email, password, profile_image) VALUES ('$name', '$email', '$password', NULL)";
            if ($conn->query($sql) === TRUE) {
                $response["status"] = "success";
                $response["message"] = "Database updated successfully.";
            } else {
                $response["status"] = "error";
                $response["message"] = "Error: " . $conn->error;
            }
        }
    }

    echo json_encode($response);

    $conn->close();
}
?>
