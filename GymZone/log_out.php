<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out</title>
    <!-- Add your styles or link to a stylesheet if needed -->
</head>
<body>
    <div class="container">
        <h2>Log Out</h2>
        <p>Are you sure you want to log out?</p>
        <form action="logout.php" method="post">
            <input type="submit" value="Log Out">
        </form>
    </div>
</body>
</html>

<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: log_in.php");
exit();
?>