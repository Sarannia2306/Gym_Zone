<?php
// Sample connection to the database
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

// Fetch user data from the database
$sql = "SELECT id, fullname, email, username FROM user_data";
$result = $conn->query($sql);

$users = [];

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch user data and store it in the $users array
    while ($row = $result->fetch_assoc()) {
        $users[] = [
            'id' => $row['id'],
            'fullname' => $row['fullname'],
            'email' => $row['email'],
            'username' => $row['username'],
        ];
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin User Management</title>

    <link rel="stylesheet" type="text/css" href="css/admin_user.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div id="header">
        <div id="navbar-left">
            <a href="admin_home.php" id="logo"><img src="images/gymZONE.jpg" style="width: 98px; height: 98px;"></a>
        </div>
        <div class="nav" id="navbar-right">
            <a class="active" href="admin_user.php">USERS</a>
            <a href="admin_content.php">CONTENT</a>
            <a href="admin_noti.php">NOTIFICATIONS</a>
            <a href="admin_feedback.php">FEEDBACK</a>
        </div>
    </div>

    <h1>User Management</h1>

    <div class="flex-container">
        <div class="container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <a href="admin_edit_user.php?id=<?php echo $user['id'] ?>" style="color: green;"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                            <a href="admin_delete_user.php?id=<?php echo $user['id'] ?>" style="color: red;"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
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