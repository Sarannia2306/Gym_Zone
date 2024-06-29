<?php
//database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitnessdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch schedule data from the database
$sql = "SELECT day, time_slot FROM cardio_class_schedule";
$result = $conn->query($sql);

// Initialize the booking message variable
$bookingMessage = '';

// Handle booking form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['day']) && isset($_POST['time_slot'])) {
        $day = $_POST['day'];
        $timeSlot = $_POST['time_slot'];

        // Insert booking data into the bookings table without 'id'
        $insertSql = "INSERT INTO bookings (day, time_slot) VALUES ('$day', '$timeSlot')";
        if ($conn->query($insertSql) === TRUE) {
            $bookingMessage = "Class has been booked successfully! You have booked $day at $timeSlot.";
        } else {
            $bookingMessage = "Error: " . $insertSql . "<br>" . $conn->error;
        }
    }
}



// Fetch schedule data from the database
$sql = "SELECT day, time_slot FROM cardio_class_schedule";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardio Classes</title>

    <link rel="stylesheet" type="text/css" href="css/class.css" />
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

    <?php if ($result->num_rows > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Join!</th>
                </tr>
            </thead>
            <tbody>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['day']; ?></td>
                        <td><?php echo $row['time_slot']; ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="day" value="<?php echo $row['day']; ?>">
                                <input type="hidden" name="time_slot" value="<?php echo $row['time_slot']; ?>">
                                <button type="submit">Book</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php if (!empty($bookingMessage)) : ?>
            <div style="color: #f01e2c; text-align: center; margin-top: 20px;">
                <?php echo $bookingMessage; ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <p>No schedule data found.</p>
    <?php endif; ?>

    <script>
        // Function to open the modal
        function openModal(day, timeSlot) {
            document.getElementById('modalDay').value = day;
            document.getElementById('modalTimeSlot').value = timeSlot;
            document.getElementById('joinModal').style.display = 'block';
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('joinModal').style.display = 'none';
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function(event) {
            var modal = document.getElementById('joinModal');
            if (event.target == modal) {
                closeModal();
            }
        };
    </script>

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