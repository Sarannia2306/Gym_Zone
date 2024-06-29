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
    <title>GYM Zone Membership</title>

    <link rel="stylesheet" type="text/css" href="css/membership.css" />
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
            <a href="about.php">OUR STORY</a>
            <a class="active" href="membership.php">MEMBERSHIP</a>
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

        function subscribe(data) {
            window.location.href = 'checkout.php?data=' + encodeURIComponent(data);
        }
    </script>

    <div class="membership-text">
        <p class="membership">MEMBERSHIP</p>
    </div>

    <div class="flex-container">
        <div class="three-month">
            <table class="table-month">
                <tr class="table-month-tr">
                    <th class="table-month-th">
                        3 Months
                        </th>
                        </tr>
                        <tr>
                            <td class="table-month-td">RM70<br><br>
                                Enjoy 3 Months plan<br><br>
                                Don't have to worry about commitments<br><br>
                                Subscribe NOW!<br><br>
                                <button class="subscribe-btn" onclick="subscribe('RM70')">WHY NOT?</button>
                            </td>
                        </tr>
                        </table>
        </div>

        <div class="six-month">
            <table class="table-month">
                <tr class="table-month-tr">
                    <th class="table-month-th">
                        6 Months
                        </th>
                        </tr>
                        <tr>
                            <td class="table-month-td">RM95<br><br>
                                Enjoy 6 Months plan<br><br>
                                See the changes in you in another 6 months<br><br>
                                Subscribe NOW!<br><br>
                                <button class="subscribe-btn" onclick="subscribe('RM95')">YES I WANT!</button>
                            </td>
                        </tr>
                        </table>
        </div>
    </div>

    <div class="flex-container">
        <div class="twelve-month">
            <table class="table-annual">
                <tr class="table-annual-tr">
                    <th class="table-annual-th">
                        12 Months
                    </th>
                </tr>
                <tr>
                    <td class="table-annual-td">
                        RM125<br><br>
                        Enjoy our Premium 1 year Plan<br><br>
                        Make them wonder who are you with your new LOOKS!<br><br>
                        Subscribe NOW!<br><br>
                        <button class="subscribe-btn" onclick="subscribe('RM125')">YEAAAZZZ!!</button>
                    </td>
                </tr>
            </table>
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