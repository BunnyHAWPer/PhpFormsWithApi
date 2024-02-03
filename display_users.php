<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php
        require_once('config/dbconfig.php');

        $query = "SELECT * FROM users";
        $result = $conn->query($query);

        if($result->num_rows > 0) {
            echo '
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Profile Image</th>
                        <th class="text-center" colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
            ';

            while($data = $result->fetch_assoc()) {
                echo '
                    <tr>
                        <td>' . $data['id'] . '</td>
                        <td>' . $data['name'] . '</td>
                        <td>' . $data['email'] . '</td>
                        <td>' . $data['password'] . '</td>
                        <td><img src="' . $data['profile_image'] . '" alt="Profile Image" width="50"></td>
                        <td>
                            <a href="update_users.php?id=' . $data["id"] . '">Edit</a>
                        </td>
                        <td>
                            <a href="delete_users.php?id=' . $data["id"] . '">Delete</a>
                        </td>
                    </tr>
                ';
            }

            echo '
                </tbody>
            </table>';
        } else {
            echo "The table has no record";
        }

        $conn->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
