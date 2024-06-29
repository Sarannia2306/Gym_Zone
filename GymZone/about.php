<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: log_in.php"); // Redirect to login page if not logged in
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
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM Zone About Us</title>

    <link rel="stylesheet" type="text/css" href="css/about.css" />
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

    <!-- The overlay -->
    <div id="myNav" class="overlay">
        <!-- Button to close the overlay navigation -->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <!-- Overlay content -->
        <div class="overlay-content">
            <a class="active" href="about.php">OUR STORY</a>
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

    <div class="osText">
        OUR STORY
    </div>

    <div class="table-container">
        <table>
            <tr>
                <td>
                    <h2>GYMZONE</h2>
                    <br>
                    <p>Welcome to GymZone – where strength meets community, and fitness transforms into a lifestyle. Our story begins with a passion for empowering individuals to embark on their journey to a healthier, stronger, and happier version of themselves.

                        Founded in 2023. </p>
                    <p>GymZone was born out of a shared vision among fitness enthusiasts who believed that a gym should be more than just a place to work out; it should be a hub for inspiration, motivation, and transformation. We understand that everyone's fitness journey is unique, and we are here to support you every step of the way.

                        Our state-of-the-art facility is more than just equipment; it's a dynamic space designed to foster a sense of belonging.</p> From the moment you walk through our doors, you'll feel the energy and enthusiasm that defines the GymZone experience. We believe in creating a welcoming environment where individuals of all fitness levels can thrive, whether you're a seasoned athlete or just starting your fitness journey.

                    At GymZone, we pride ourselves on our team of certified and passionate trainers who are dedicated to helping you reach your fitness goals.<p>They are not just instructors; they are your partners in wellness, offering personalized guidance, motivation, and expertise to ensure you get the most out of every workout.

                        Community is at the heart of what we do.</p> We host regular events, challenges, and workshops to bring our members together, fostering a sense of camaraderie that extends beyond the gym floor. We believe that the support of a like-minded community is a powerful catalyst for success.

                    Our commitment to excellence extends to the equipment and amenities we provide. <p>From cutting-edge workout machines to carefully curated classes, we strive to offer a diverse range of options to keep your fitness routine exciting and effective. Our goal is to make every visit to GymZone an experience that leaves you energized and eager for more.

                        As we continue to grow and evolve, our dedication to providing a premium fitness experience remains unwavering.</p>
                    <p>Whether you're looking to build muscle, improve endurance, or simply enhance your overall well-being, GymZone is the place where your fitness aspirations become a reality.

                        Join us on this incredible journey towards a healthier, stronger, and more vibrant you. Welcome to GymZone – where the pursuit of fitness is an exhilarating adventure, and you're never alone in reaching your goals.</p>
                    <br><br>
                </td>
            </tr>
        </table>
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

</body>

</html>