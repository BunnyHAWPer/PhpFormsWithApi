<?php
require_once('dbconfig.php');

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "update users set password='$password' where email='$email'";

    if ($conn->query($sql) === TRUE) {
        $response = array("success" => true, "message" => "Password Update Sucess Fully");
    } else {
        $response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}

?>