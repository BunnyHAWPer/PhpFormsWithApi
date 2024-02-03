<?php

require_once('dbconfig.php');

$query = "SELECT * FROM category";
$result = $conn->query($query);

if ($result) {
    $categories = array();

    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    $result->close();

    $conn->close();

    $jsonResponse = json_encode($categories);

    header('Content-Type: application/json');

    echo $jsonResponse;
} else {
    echo "Error executing query: " . $conn->error;
}

?>