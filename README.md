# PhpFormsWithApi

This repository contains PHP forms with API endpoints for user authentication, registration, category management, login, and password recovery. It includes functionalities for displaying, editing, and deleting users. The API provides endpoints for login, registration, and password recovery, as well as managing categories.

## Setup

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/BunnyHAWPer/PhpFormsWithApi.git

2) Import MySQL tables from the tables folder:

Open your MySQL database.
Import tables from the tables folder into your database.

3) Ensure proper folder permissions:
Make sure the uploads/profile_images and uploads/category folders are writable by the web server to store user profile images and category images.

4) Update Database Configuration:

Modify the dbconfig.php file in the root directory with your MySQL database configuration

Usage
User Authentication:
Registration:

Use the register.php form to register a new user.
Login:

Log in using the login.php form.
Password Recovery:

Recover your password through the forgetpass.php form.
User Management:
Display Users:

View a list of users with the displayusers.php form.
Edit and Delete Users:

Edit and delete users from the displayed list.
Category Management:
Category API:
Utilize the API endpoints for managing categories.
File Structure:
uploads/profile_images/:

Folder for storing user profile images.
uploads/category/:

Folder for storing category images.
Contributing
Feel free to contribute by creating issues or submitting pull requests. Please follow the code of conduct.


Make sure to customize the URLs, placeholders, and instructions according to your actual repository structure and requirements. Additionally, create a `CODE_OF_CONDUCT.md` file if you want to define a code of conduct for contributors. The `LICENSE` file should reflect the license you choose for your project.
