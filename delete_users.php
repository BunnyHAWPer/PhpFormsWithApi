<?php
require_once('dbconfig.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    echo "$id";

    $query = "DELETE FROM users WHERE id=$id";
    $execute = $conn->query($query);
    if($execute) {
        header('location:index.php');
    } else {
        $msg = "Error: " . $query . "<br>" . $conn->error;
        echo $msg;
    }
}

?>