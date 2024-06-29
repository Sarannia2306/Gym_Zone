<?php
// Connect to the database (replace 'your_username', 'your_password', and 'your_database' with your actual database credentials)
$mysqli = new mysqli('localhost', 'root', '', 'fitnessdb');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Handle form submissions for communication tools
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'sendNotification') {
        $notificationContent = $_POST['notificationContent'];

        // Insert notification into the database
        $sql = "INSERT INTO notifications (type, content) VALUES ('Notification', '$notificationContent')";
        $mysqli->query($sql);

        header("Location: admin_noti.php?notificationContent=$notificationContent");
        exit();
    } elseif (isset($_POST['action']) && $_POST['action'] == 'scheduleAnnouncement') {
        $title = $_POST['announcementTitle'];
        $content = $_POST['announcementContent'];
        $scheduledDate = $_POST['scheduledDate'];

        // Insert announcement into the database
        $sql = "INSERT INTO Notifications (type, content, scheduled_date) VALUES ('Announcement', '$title: $content', '$scheduledDate')";
        $mysqli->query($sql);

        header("Location: admin_noti.php");
        exit();
    }
}

// Retrieve notifications and announcements from the database
$sql = "SELECT * FROM Notifications ORDER BY created_at DESC";
$result = $mysqli->query($sql);

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Notifications</title>

    <link rel="stylesheet" type="text/css" href="css/admin_noti.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Great+Vibes&display=swap">
</head>

<body>

    <div id="header">
        <div id="navbar-left">
            <a href="admin_home.php" id="logo"><img src="images/gymZONE.jpg" style="width: 98px; height: 98px;"></a>
        </div>
        <div class="nav" id="navbar-right">
            <a href="admin_user.php">USERS</a>
            <a href="admin_content.php">CONTENT</a>
            <a class="active" href="admin_noti.php">NOTIFICATIONS</a>
            <a href="admin_feedback.php">FEEDBACK</a>
        </div>
    </div>

    <h1>Communication Tools</h1>

    <h2>Send Notifications</h2>

    <form action="admin_noti.php" method="post">
        <div class="container">
            <label for="notificationContent">Notification Content</label>
        </div>
        <div class="container">
            <textarea name="notificationContent" rows="3" required></textarea>
            <input type="hidden" name="action" value="sendNotification">
        </div>
        <div class="container">
            <button type="submit">Send Notification</button>
        </div>
    </form>

    <h2>Announcement Management</h2>
    <form action="admin_noti.php" method="post">
        <div class="container">
            <label for="announcementTitle">Announcement Title</label>
        </div>
        <div class="container">
            <input type="text" name="announcementTitle" required>
        </div>
        <br>
        <div class="container">
            <label for="announcementContent">Announcement Content</label>
        </div>
        <div class="container">
            <textarea name="announcementContent" rows="5" required></textarea>
        </div>
        <br>
        <div class="container">
            <label for="scheduledDate">Scheduled Date and Time</label>
        </div>
        <div class="container">
            <input type="datetime-local" name="scheduledDate" required>
            <input type="hidden" name="action" value="scheduleAnnouncement">
        </div>
        <br>
        <div class="container">
            <button type="submit">Schedule Announcement</button>
        </div>
    </form>

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