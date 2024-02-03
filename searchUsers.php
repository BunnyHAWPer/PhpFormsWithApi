<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>User Search</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">About</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <h2>User List</h2>
        <?php
            require_once('dbconfig.php');

            $search = isset($_GET['search']) ? $_GET['search'] : '';

            $query = "SELECT * FROM users WHERE name LIKE ?";
            $stmt = $conn->prepare($query);
            $searchParam = "%{$search}%";
            $stmt->bind_param("s", $searchParam);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
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

                while ($data = $result->fetch_assoc()) {
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
                echo "No records found.";
            }

            $stmt->close();
            $conn->close();
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
