<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>

    <link rel="stylesheet" type="text/css" href="css/classes.css" />
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
            <a class="active" href="classes.php">CLASSES</a>
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

    <div class="row">
        <div class="column">
            <div class="class-card">
                <img src="images/hardcore.gif" alt="Hardcore" />
                <h2 style="padding: 10px;"><a href="hardcore_class.php" style="text-decoration: none; font-size: auto; color: white; margin-top: 10px;">HARDCORE</a></h2>
            </div>
        </div>

        <div class="column">
            <div class="class-card">
                <img src="images/yoga.jpg" alt="Yoga" />
                <h2 style="padding: 10px;"><a href="yoga_class.php" style="text-decoration: none; font-size: auto; color: white; margin-top: 10px;">YOGA</a></h2>
            </div>
        </div>

        <div class="column">
            <div class="class-card">
                <img src="images/cardio.gif" alt="Cardio" />
                <h2 style="padding: 10px;"><a href="cardio_class.php" style="text-decoration: none; font-size: auto; color: white; margin-top: 10px;">CARDIO</a></h2>
            </div>
        </div>

        <div class="column">
            <div class="class-card">
                <img src="images/pilates.gif" alt="Pilates" />
                <h2 style="padding: 10px;"><a href="pilates_class.php" style="text-decoration: none; font-size: auto; color: white; margin-top: 10px;">PILATES</a></h2>
            </div>
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

</body>

</html>