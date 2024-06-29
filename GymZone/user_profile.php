<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$host = "localhost";
$user = "root";
$password_db = "";
$database = "fitnessdb";

$conn = new mysqli($host, $user, $password_db, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM user_data WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
    $fullname = $row['fullname'];
    $phone_number = $row['phone_number'];
    $gender = $row['gender'];
    $age = $row['age'];
    $weight = $row['weight'];
    $height = $row['height'];
    $profile_pic = $row['profile_pic'];
} else {
    echo "User not found";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM Zone Profile</title>

    <link rel="stylesheet" type="text/css" href="css/user_profile.css" />
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
            <div class="title">Profile Information</div>
            <div class="flex-container">
                <div class="profile-picture">
                    <img src="<?php echo htmlspecialchars($profile_pic, ENT_QUOTES, 'UTF-8'); ?>" alt="Profile Picture" id="pp">
                </div>
            </div>
            <div class="flex-container">
                <div class="username">
                    <input type="text" id="username" value="<?php echo ($username); ?>" readonly>
                </div>
                <div class="email">
                    <input type="text" id="email" value="<?php echo ($email); ?>" readonly>
                </div>
            </div>
            <div class="flex-container">
                <div class="fullname">
                    <input type="text" id="fullname" value="<?php echo ($fullname); ?>" readonly>
                </div>
                <div class="phone_number">
                    <input type="text" id="phone_number" value="<?php echo ($phone_number); ?>" readonly>
                </div>
            </div>
            <div class="flex-container">
                <div class="gender">
                    <input type="text" id="gender" value="<?php echo ($gender); ?>" readonly>
                </div>
                <div class="age">
                    <input type="text" id="age" value="<?php echo ($age); ?> years old" readonly>
                </div>
            </div>
            <div class="flex-container">
                <div class="weight">
                    <input type="text" id="weight" value="<?php echo ($weight); ?> KG" readonly>
                </div>
                <div class="height">
                    <input type="text" id="height" value="<?php echo ($height); ?> CM" readonly>
                </div>
            </div>
        </div>
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