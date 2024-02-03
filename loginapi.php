<?php
require_once('dbconfig.php');


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    
    if ($result && mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        $userid = $row["id"];
        $response = array('userid'=>$userid, 'success' => true, 'message' => 'Login successful.');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'message' => 'Invalid username or password.');
        echo json_encode($response);
    }
}
header("Content-Type: application/json");

$conn->close();

?>