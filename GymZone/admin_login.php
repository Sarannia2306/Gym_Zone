<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link rel="stylesheet" type="text/css" href="css/admin_login.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div class="login-container">
        <h2>Admin GYMZONE</h2>
        <br>
        <div class="content">
            <header>Login Form</header>
            <br>
            <form action="admin_home.php" method="post" onsubmit="return login()">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" id="username" name="username" required placeholder="Username">
                </div>
                <br>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" id="password" name="password" class="pass-key" required placeholder="Password">
                </div>
                <div class="field">
                    <input type="submit" value="LOGIN">
                </div>
            </form>
        </div>
    </div>



    <script>
        function login() {
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            // Check if the username and password are correct
            if (username.toLowerCase() === "admin" && password === "ADMIN") {
                // Return true to allow form submission and redirect to admin_home.php
                return true;
            } else {
                alert("Invalid username or password");
                // Return false to prevent form submission
                return false;
            }
        }
    </script>

</body>

</html>