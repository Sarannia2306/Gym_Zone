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

$status = ''; // Initialize the status variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $message = $_POST['message'];

    // Insert feedback into the database
    $pdo = new PDO("mysql:host=localhost;dbname=fitnessdb", "root", "");
    $sql = "INSERT INTO feedbacks (fullname, email, phone_number, message) VALUES (:fullname, :email, :phone_number, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':message', $message);

    if ($stmt->execute()) {
        $status = 'success'; // Set status to success if the form is submitted successfully
    } else {
        $status = 'error'; // Set status to error if there is an issue submitting the form
    }
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

    <link rel="stylesheet" type="text/css" href="css/contact.css" />
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
            <a class="active" href="contact.php">CONTACT</a>
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
        // Display the modal if the status is 'success'
        window.onload = function() {
            <?php if ($status === 'success') : ?>
                openModal();
            <?php endif; ?>
        };

        // Open the modal
        function openModal() {
            document.getElementById('successModal').style.display = 'block';
        }

        // Close the modal
        function closeModal() {
            document.getElementById('successModal').style.display = 'none';
        }
    </script>

    <div class="text1">
        <h1 style="text-align:center; margin-top: 50px; padding: 10px;">Contact Us</h1>
        <h4 style="text-align:center; font-weight: bold; font-size: 30px; padding: 10px;">Would love to hear from you!</h4>
    </div>

    <div class="input-container">
        <form action="contact.php" method="post">
            <div class="name">
                <input type="text" name="name" placeholder="Name" style="display: block; margin: auto; margin-top:20px;" required />
            </div>
            <div class="email">
                <input type="text" name="email" placeholder="Email" style="display: block; margin: auto; margin-top:20px;" required />
            </div>
            <div class="phone_number">
                <input type="text" name="phone_number" placeholder="Phone Number" style="display: block; margin: auto; margin-top:20px;" required />
            </div>
            <div>
                <textarea name="message" placeholder="Message" style="display: block; margin: auto; margin-top:20px; height: 200px;" required></textarea>
            </div>
            <div class="button-submit">
                <button class="button" type="submit" style="display: block; margin: auto; margin-top:20px;">Send Message</button>
            </div>
            <div id="successModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <p>Feedback sent successfully!</p>
                </div>
            </div>
        </form>
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