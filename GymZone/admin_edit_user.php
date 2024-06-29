<?php
include 'db_connection.php';

if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $phone_number = $_POST['phone_number'];

    $sql = "UPDATE user_data SET username='$username', email='$email', fullname='$fullname', age='$age', gender='$gender', height='$height', `weight`='$weight', phone_number='$phone_number' WHERE id=$id";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        header('location: admin_user.php?Edit Successful');
    } else {
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Edit User</title>

    <link rel="stylesheet" type="text/css" href="css/admin_edit_user.css" />
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
            <a href="admin_feedback.php">FEEDBACK</a>
        </div>
    </div>

    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM user_data WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container">
        <div class="content">
            <div class="title">Profile Information</div>
            <form action="admin_edit_user.php" method="post">
                <div class="flex-container">
                    <div class="id">
                    <input type="text" id="id" name="id" value="<?php echo $row['id'] ?>" readonly>
                    </div>
                </div>
                <div class="flex-container">
                    <div class="username">
                        <input type="text" id="username" name="username" value="<?php echo $row['username'] ?>">
                    </div>
                    <div class="email">
                        <input type="text" id="email" name="email" value="<?php echo $row['email'] ?>">
                    </div>
                </div>
                <div class="flex-container">
                    <div class="fullname">
                        <input type="text" id="fullname" name="fullname" value="<?php echo $row['fullname'] ?>">
                    </div>
                    <div class="phone_number">
                        <input type="text" id="phone_number" name="phone_number" value="<?php echo $row['phone_number'] ?>">
                    </div>
                </div>
                <div class="flex-container">
                    <div class="gender">
                        <input type="text" id="gender" name="gender" value="<?php echo $row['gender'] ?>">
                    </div>
                    <div class="age">
                        <input type="text" id="age" name="age" value="<?php echo $row['age'] ?>">
                    </div>
                </div>
                <div class="flex-container">
                    <div class="weight">
                        <input type="text" id="weight" name="weight" value="<?php echo $row['weight'] ?>">
                    </div>
                    <div class="height">
                        <input type="text" id="height" name="height" value="<?php echo $row['height'] ?>">
                    </div>
                </div>
                <input type="submit" value="Submit" name="submit">
            </form>
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