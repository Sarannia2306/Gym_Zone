<?php
// Database connection details
$dsn = "mysql:host=localhost;dbname=fitnessdb";
$username = "root";
$password = "";

// Simulating database connection and query for user data
try {
    $pdo = new PDO($dsn, $username, $password);
    $stmt = $pdo->prepare("SELECT * FROM feedbacks");
    $stmt->execute();
    $userFeedback = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Handle form submissions for feedback
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'respondToFeedback') {
        $feedbackId = $_POST['feedbackId'];
        $response = $_POST['response'];

        // Add logic to update the 'response' column in the 'feedbacks' table
        try {
            $stmt = $pdo->prepare("UPDATE feedbacks SET response = :response WHERE id = :id");
            $stmt->bindParam(':response', $response, PDO::PARAM_STR);
            $stmt->bindParam(':id', $feedbackId, PDO::PARAM_INT);
            $stmt->execute();

            // Display a success message
            echo "Response sent successfully!";
        } catch (PDOException $e) {
            echo "Error updating response: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback</title>

    <link rel="stylesheet" type="text/css" href="css/admin_feedback.css" />
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
            <a href="admin_content.php">CONTENT</a>
            <a href="admin_noti.php">NOTIFICATIONS</a>
            <a class="active" href="admin_feedback.php">FEEDBACK</a>
        </div>
    </div>

    <h1>Feedback and Support</h1>

    <div class="feedback-container">

        <ul class="feedback-list">
            <?php foreach ($userFeedback as $feedback) : ?>
                <li>
                    <strong>Name: <?= $feedback['fullname'] ?></strong>
                    <p>Email: <?= $feedback['email'] ?></p>
                    <p>Feedback: <?= $feedback['message'] ?></p>
                    <form action="admin_feedback.php" method="post">
                        <label for="response">Your Response:</label>
                        <textarea name="response" rows="3" required></textarea>
                        <!-- Add a unique identifier, such as the feedback ID -->
                        <input type="hidden" name="feedbackId" value="<?= $feedback['id'] ?>">
                        <input type="hidden" name="action" value="respondToFeedback">
                        <button type="submit">Send Response</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
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