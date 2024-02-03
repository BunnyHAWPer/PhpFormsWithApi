<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once('dbconfig.php');

        $query = "SELECT * FROM category";
        $result = $conn->query($query);

        if($result->num_rows > 0) {
            echo '
            <table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Course</th>
                </tr>
            ';
            while($data = $result->fetch_assoc()) {
                echo '
                    <tr>
                        <th>' . $data['id'] . '</th>
                        <th>' . $data['name'] . '</th>
                        <th>' . $data['email'] . '</th>
                        <th>' . $data['password'] . '</th>
                        <th>' . $data['mobile'] . '</th>
                        <th>' . $data['gender'] . '</th>
                        <th>' . $data['course'] . '</th>
                    </tr>
                ';
            }

            echo '</table>';

        } else {
            echo "The table has no record";
        }

        $conn->close();
        
    ?>
    
</body>
</html>