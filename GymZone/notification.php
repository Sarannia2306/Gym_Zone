<?php
// Connect to the database and retrieve notifications, announcements, and feedbacks
$mysqli = new mysqli('localhost', 'root', '', 'fitnessdb');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch notifications and announcements
$sqlNotifications = "SELECT * FROM notifications ORDER BY created_at DESC";
$resultNotifications = $mysqli->query($sqlNotifications);

// Fetch feedbacks
$sqlFeedbacks = "SELECT * FROM feedbacks ORDER BY created_at DESC";
$resultFeedbacks = $mysqli->query($sqlFeedbacks);

if (!$resultNotifications || !$resultFeedbacks) {
    die("Error: " . $mysqli->error);
}

$notifications = [];
while ($row = $resultNotifications->fetch_assoc()) {
    $notifications[] = $row;
}

$feedbacks = [];
while ($row = $resultFeedbacks->fetch_assoc()) {
    $feedbacks[] = $row;
}

$mysqli->close();

$hasNotifications = !empty($notifications);
$hasFeedbacks = !empty($feedbacks);
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM Zone Notifications</title>

    <link rel="stylesheet" type="text/css" href="css/notification.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>

        .section-50 {
            padding: 50px 0;
        }

        .m-b-50 {
            margin-bottom: 50px;
        }

        .dark-link {
            color: #333;
        }

        .heading-line {
            position: relative;
            padding-bottom: 5px;
        }

        .heading-line:after {
            content: "";
            height: 4px;
            width: 75px;
            background-color: #29B6F6;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .notification-ui_dd-content {
            margin-bottom: 30px;
        }

        .notification-list {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 20px;
            margin-bottom: 7px;
            background: #fff;
            -webkit-box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        .notification-list--unread {
            border-left: 2px solid #29B6F6;
        }

        .notification-list .notification-list_content {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .notification-list .notification-list_content .notification-list_img img {
            height: 48px;
            width: 48px;
            border-radius: 50px;
            margin-right: 20px;
        }

        .notification-list .notification-list_content .notification-list_detail p {
            margin-bottom: 5px;
            line-height: 1.2;
        }

        .notification-list .notification-list_feature-img img {
            height: 48px;
            width: 48px;
            border-radius: 5px;
            margin-left: 20px;
        }
    </style>

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

    <?php if ($hasNotifications || $hasFeedbacks) : ?>
        <section class="section-50">
            <div class="container">
                <h3 class="m-b-50 heading-line" style="color: white; padding-left: 10px;">Notifications and Feedbacks</h3>

                <div class="notification-ui_dd-content">
                    <?php foreach ($notifications as $notification) : ?>
                        <div class="notification-list <?php echo ($notification['type'] == 'Announcement') ? 'notification-list--unread' : ''; ?>">
                            <div class="notification-list_content">
                                <div class="notification-list_detail">
                                    <?php if ($notification['type'] == 'Notification') : ?>
                                        <p><?php echo $notification['content']; ?></p>
                                    <?php elseif ($notification['type'] == 'Announcement') : ?>
                                        <h4><b>Announcement</b></h4>
                                        <p><?php echo $notification['content']; ?></p>
                                        <?php if (!empty($notification['scheduled_date'])) : ?>
                                            <p>Scheduled Date: <?php echo date('Y-m-d H:i:s', strtotime($notification['scheduled_date'])); ?></p>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($notification['response'])) : ?>
                                        <p><strong>Admin Response:</strong> <?php echo $notification['response']; ?></p>
                                    <?php endif; ?>

                                    <p class="text-muted"><small><?php echo date('Y-m-d H:i:s', strtotime($notification['created_at'])); ?></small></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php foreach ($feedbacks as $feedback) : ?>
                        <div class="notification-list">
                            <div class="notification-list_content">
                                <div class="notification-list_detail">
                                    <p><strong>Name: </strong><?php echo $feedback['fullname']; ?></p>
                                    <p><strong>Email: </strong><?php echo $feedback['email']; ?></p>
                                    <p><strong>Message: </strong><?php echo $feedback['message']; ?></p>
                                    <p><strong>Admin Response: </strong><?php echo $feedback['response']; ?></p>
                                    <p class="text-muted"><small><?php echo date('Y-m-d H:i:s', strtotime($feedback['created_at'])); ?></small></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php else : ?>
        <p>No notifications or feedbacks available.</p>
    <?php endif; ?>

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