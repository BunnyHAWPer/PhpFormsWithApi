<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-container {
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 400px;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      margin-bottom: 5px;
    }
    input[type="text"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      resize: none;
    }
    .image-preview {
      max-width: 100%;
      height: auto;
      margin-top: 10px;
    }
  </style>
</head>
<body>
<div class="form-container">
    <form method="post" action="#" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" required>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" rows="4" required></textarea>
      </div>
      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" accept="image/*" required>
        <div class="image-preview"></div>
      </div>
      <div class="form-group">
        <button type="submit" name="submit">Submit</button>
      </div>
    </form>
  </div>

</body>
</html>

<?php
if(isset($_POST["submit"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            include("dbconfig.php");
            
            $sql = "INSERT INTO category (name, description, image) VALUES ('$name', '$description', '$targetFile')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
