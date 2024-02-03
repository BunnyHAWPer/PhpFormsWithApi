<?php
require_once('dbconfig.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($query);
    
    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $profile_image = $data['profile_image'];
    } else {
        echo "Record not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($_FILES["profile_image"]["name"])) {
        $target_dir = "uploads/profile_images/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["profile_image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        $allowedImageTypes = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedImageTypes)) {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1 && !empty($profile_image)) {
            unlink($profile_image);
        }

        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $profile_image = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
            $uploadOk = 0;
        }
    }

    $query = "UPDATE users SET name='$name', email='$email', password='$password', profile_image='$profile_image' WHERE id=$id";

    if ($conn->query($query) === TRUE) {
        echo "Record updated successfully.";
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
</head>
<body>
    <h2>Edit Record</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br><br>
        
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($password); ?>"><br><br>
        
        <label for="profile_image">Profile Image:</label>
        <input type="file" name="profile_image" id="profile_image"><br><br>
        
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
