<?php

// Handle form submissions for content management
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'addVideo') {
        $title = $_POST['videoTitle'];
        $url = $_POST['videoUrl'];
        // Add logic to save the video information in the database
        // For simplicity, we'll just update the local array
        $workoutVideos[] = ['title' => $title, 'url' => $url];
    } elseif (isset($_POST['action']) && $_POST['action'] == 'updateSchedule') {
        // Add logic to update the class schedule in the database
        // For simplicity, we'll just update the local array
        foreach ($classSchedules as &$schedule) {
            if ($schedule['day'] == $_POST['day']) {
                $schedule['time'] = $_POST['time'];
                $schedule['class'] = $_POST['class'];
                break;
            }
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'addPost') {
        $postTitle = $_POST['postTitle'];
        $postContent = $_POST['postContent'];
        $blogPosts[] = ['title' => $postTitle, 'content' => $postContent];
    }
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Content</title>

    <link rel="stylesheet" type="text/css" href="css/admin_content.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div id="header">
        <div id="navbar-left">
            <a href="admin_home.php" id="logo"><img src="images/gymZONE.jpg" style="width: 98px; height: 98px;"></a>
        </div>
        <div class="nav" id="navbar-right">
            <a href="admin_user.php">USERS</a>
            <a class="active" href="admin_content.php">CONTENT</a>
            <a href="admin_noti.php">NOTIFICATIONS</a>
            <a href="admin_feedback.php">FEEDBACK</a>
        </div>
    </div>

    <h1>Content Management</h1>

    <h2>Workout Videos</h2>
    <form action="admin.php" method="post">
        <label for="videoTitle">Video Title:</label>
        <input type="text" name="videoTitle" required>
        <label for="videoUrl">Video URL:</label>
        <input type="url" name="videoUrl" required>
        <input type="hidden" name="action" value="addVideo">
        <button type="submit">Add Video</button>
    </form>
    <br>
    <h2>Class Schedules</h2>
    <form action="admin.php" method="post">
        <label for="day">Day:</label>
        <input type="text" name="day" required>
        <label for="time">Time:</label>
        <input type="text" name="time" required>
        <label for="class">Class:</label>
        <input type="text" name="class" required>
        <input type="hidden" name="action" value="updateSchedule">
        <button type="submit">Update Schedule</button>
    </form>
    <br>

    <h2>Blog Posts</h2>
    <form action="admin.php" method="post">
        <label for="postTitle">Post Title:</label>
        <input type="text" name="postTitle" required>
        <label for="postContent">Post Content:</label>
        <textarea name="postContent" rows="4" required></textarea>
        <input type="hidden" name="action" value="addPost">
        <button type="submit">Add Post</button>
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