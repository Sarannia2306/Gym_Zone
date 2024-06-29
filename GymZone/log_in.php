<?php
session_start();

// Assuming you have variables with actual values
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection details (replace with your actual details)
    $host = "localhost";
    $user = "root";
    $password_db = "";
    $database = "fitnessdb";

    // Create connection
    $conn = new mysqli($host, $user, $password_db, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT id, password FROM user_data WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    // Execute the query
    $stmt->execute();

    // Store the result so we can check if the login is successful
    $stmt->store_result();

    // If a row is found, it means the username exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Set the user ID in the session
            $_SESSION['id'] = $user_id;

            // Redirect to the user profile page
            header("Location: homepage.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM Zone Login</title>

    <link rel="stylesheet" type="text/css" href="css/login.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div id="header">
        <div id="navbar-left">
            <a href="homepage.php" id="logo"><img src="images/gymZONE.jpg" style="width: 98px; height: 98px;"></a>
        </div>
        <div class="nav" id="navbar-right">
            <a><span class="nav-icon" onclick="openNav()"><i class="fa fa-bars"></i></span></a>
            <a href="BMI.php">BMI</a>
            <a href="register.php">JOIN NOW</a>
            <a href="contact.php">CONTACT</a>
            <a href="classes.php">CLASSES</a>
        </div>
    </div>

    <div class="content" id="login-form">
        <header>Login Form</header>
        <form action="#" method="post">
            <div class="field">
                <span class="fa fa-user"></span>
                <input type="text" name="username" required placeholder="Username">
            </div>
            <div class="field space">
                <span class="fa fa-lock"></span>
                <input type="password" name="password" class="pass-key" required placeholder="Password">
            </div>
            <div class="pass">
                <a href="#">Forgot Password?</a>
            </div>
            <div class="field">
                <input type="submit" value="LOGIN">
            </div>
        </form>
        <div class="login">
            Don't have an account?
            <a href="sign_up.php">Sign Up Now</a>
        </div>
        </form>
    </div>

    <!-- The overlay -->
    <div id="myNav" class="overlay">
        <!-- Button to close the overlay navigation -->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <!-- Overlay content -->
        <div class="overlay-content">
            <a href="about.php">OUR STORY</a>
            <a href="membership.php">MEMBERSHIP</a>
            <a href="testimonial.php">TESTIMONIAL</a>

            <?php
            if (isset($_SESSION['id'])) {
                // If user is logged in, display "LOG OUT" and "PROFILE"
                echo '<a href="log_out.php">LOG OUT</a>';
                echo '<a href="user_profile.php">PROFILE</a>';
            } else {
                // If user is not logged in, display "LOG IN"
                echo '<a href="log_in.php">LOG IN</a>';
            }
            ?>
            <a href="notification.php">NOTIFICATIONS</a>
            <a href="blog.php">BLOG</a>
        </div>

    </div>

    <script>
        const pass_field = document.querySelector('.pass-key');
            const showBtn = document.querySelector('.show');
            showBtn.addEventListener('click', function() {
                if (pass_field.type === "password") {
                    pass_field.type = "text";
                    showBtn.style.color = "#3498db";
                } else {
                    pass_field.type = "password";
                    showBtn.style.color = "#222";
                }
            });
        /* Open when someone clicks on the span element */
        function openNav() {
            document.getElementById("myNav").style.width = "100%";
        }

        /* Close when someone clicks on the "x" symbol inside the overlay */
        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }
    </script>

    <div class="animated-text-container">
        <p class="animated-text">GYMZONE GYMZONE GYMZONE GYMZONE GYMZONE GYMZONE GYMZONE GYMZONE GYMZONE GYMZONE GYMZONE GYMZONE</p>
    </div>

    <div id="footer">
        <div class="social-icons">
            <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
            <a href="https://www.instagram.com/accounts/login/?hl=en"><i class="fa fa-instagram"></i></a>
            <a href="https://www.youtube.com"><i class="fa fa-youtube-play"></i></a>
        </div>
        <p>&copy; 2023 GYM Zone</p>
    </div>

</body>

</html>