<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM Zone Register</title>

    <link rel="stylesheet" type="text/css" href="css/register.css" />
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

    <div class="container">
        <div class="content">
            <div class="title">Register Form</div>

            <?php
            session_start();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Handle form submission
                $fullname = $_POST['fullname'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];
                $phone_number = $_POST['phone_number'];
                $age = $_POST['age'];
                $weight = $_POST['weight'];
                $height = $_POST['height'];

                // Check if gender is set in $_POST
                if (isset($_POST['gender'])) {
                    $gender = $_POST['gender'];
                } else {
                    // Handle the case when gender is not set
                    $gender = "Prefer not to say";
                }

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Process profile picture
                $profilePic = uniqid() . '_' . basename($_FILES['profile_pic']['name']);
                move_uploaded_file($_FILES['profile_pic']['tmp_name'], $profilePic);

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

                // Insert data into the user_data table using prepared statement
                $sql = "INSERT INTO `user_data` (`username`, `email`, `password`, `fullname`, `phone_number`, `gender`, `age`, `weight`, `height`, `profile_pic`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssssss", $username, $email, $hashedPassword, $fullname, $phone_number, $gender, $age, $weight, $height, basename($profilePic));

                if ($stmt->execute()) {
                    // Set the user ID in a session variable
                    $_SESSION['id'] = $conn->insert_id;
                    // Redirect to the user profile page
                    header("Location: user_profile.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();

                // Close the connection
                $conn->close();
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="flex-container">
                    <div class="fullname">
                        <div class="input-box">
                            <input type="text" id="fullname" name="fullname" placeholder="Enter your name" required>
                            <div class="error-message" id="fullname-error"></div>
                        </div>
                    </div>
                    <div class="username">
                        <div class="input-box">
                            <input type="text" id="username" name="username" placeholder="Enter your username" required>
                            <div class="error-message" id="username-error"></div>
                        </div>
                    </div>
                </div>
                <div class="flex-container">
                    <div class="email">
                        <div class="input-box">
                            <input type="text" id="email" name="email" placeholder="Enter your email" required>
                            <div class="error-message" id="email-error"></div>
                        </div>
                    </div>
                    <div class="phone-number">
                        <div class="input-box">
                            <input type="text" id="phone_number" name="phone_number" placeholder="Enter your number" required>
                            <div class="error-message" id="phone_number-error"></div>
                        </div>
                    </div>
                </div>
                <div class="flex-container">
                    <div class="password">
                        <div class="input-box">
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                            <div class="error-message" id="password-error"></div>
                        </div>
                    </div>
                    <div class="confirm-password">
                        <div class="input-box">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                            <div class="error-message" id="confirm_password-error"></div>
                        </div>
                    </div>
                </div>
                <div class="flex-container">
                    <div class="age">
                        <div class="input-box">
                            <input type="text" id="age" name="age" placeholder="Enter your age" required>
                            <div class="error-message" id="age-error"></div>
                        </div>
                    </div>
                    <div class="weight">
                        <div class="input-box">
                            <input type="text" id="weight" name="weight" placeholder="Enter your weight" required>
                            <div class="error-message" id="weight-error"></div>
                        </div>
                    </div>
                </div>
                <div class="flex-container">
                    <div class="height">
                        <div class="input-box">
                            <input type="text" id="height" name="height" placeholder="Enter your height" required>
                            <div class="error-message" id="height-error"></div>
                        </div>
                    </div>
                    <div class="profile-picture">
                        <div class="input-box-pp">
                            <input type="file" id="profile_pic" name="profile_pic" accept=".jpg, .jpeg, .png" required>
                            <div class="error-message" id="profile_pic-error"></div>
                        </div>
                    </div>
                </div>
                <div class="flex-container-gender">
                    <div class="gender-details-male">
                        <input type="radio" id="male" name="gender" value="Male">
                        <label for="male">Male</label>
                    </div>
                    <div class="gender-details-female">
                        <input type="radio" id="female" name="gender" value="Female">
                        <label for="female">Female</label>
                    </div>
                </div>
                <div class="flex-container">
                    <div class="field">
                        <input type="submit" value="REGISTER">
                    </div>
                </div>
                <div class="flex-container-terms">
                    <p>By signing up, you agree to our</p>
                    <a href="terms.php" target="_blank">Terms & Conditions</a>
                </div>
            </form>
        </div>
    </div>

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

    <!-- JavaScript at the end of the body -->
    <script>
        /* Open when someone clicks on the span element */
        function openNav() {
            document.getElementById("myNav").style.width = "100%";
        }

        /* Close when someone clicks on the "x" symbol inside the overlay */
        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }
    </script>
</body>

</html>