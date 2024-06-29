<?php
// Assuming you have a database connection, modify the following accordingly
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'fitnessdb';

// Create a database connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the messages table with non-empty photo_path
$sql = "SELECT * FROM messages WHERE `photo_path` IS NOT NULL";
$result = mysqli_query($conn, $sql);

// Check if any messages were found
if ($result && mysqli_num_rows($result) > 0) {
?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GYM Zone Blog</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

        <style>
            body {
                min-height: 100vh;
                display: flex;
                align-items: center;
                background-color: rgb(233, 150, 150);
                font-family: 'Open Sans';
            }

            .container {
                margin: 2rem auto;
            }

            #blog {
                background: linear-gradient(112deg, #ffffff 50%, antiquewhite 50%);
                max-width: 900px;
                margin: auto;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            }

            .carousel-caption {
                position: initial;
                z-index: 10;
                padding: 5rem 8rem;
                color: rgba(78, 77, 77, 0.856);
                text-align: center;
                font-size: 1.2rem;
                font-style: italic;
                font-weight: bold;
                line-height: 2rem;
            }

            @media(max-width: 767px) {
                .carousel-caption {
                    position: initial;
                    z-index: 10;
                    padding: 3rem 2rem;
                    color: rgba(78, 77, 77, 0.856);
                    text-align: center;
                    font-size: 0.7rem;
                    font-style: italic;
                    font-weight: bold;
                    line-height: 1.5rem;
                }
            }

            .carousel-caption img {
                width: 100%;
                height: auto;
                max-width: 23rem; /* Adjust the maximum width as needed */
                border-radius: 3rem;
                margin-top: 2rem;
            }

            @media(max-width: 767px) {
                .carousel-caption img {
                    max-width: 4rem; /* Adjust the maximum width as needed */
                    border-radius: 4rem;
                    margin-top: 1rem;
                }
            }

            #image-caption {
                font-style: normal;
                font-size: 1rem;
                margin-top: 0.5rem;
            }

            @media(max-width: 767px) {
                #image-caption {
                    font-style: normal;
                    font-size: 0.6rem;
                    margin-top: 0.5rem;
                }
            }

            i {
                background-color: rgb(223, 56, 89);
                padding: 1.4rem;
            }

            @media(max-width: 767px) {
                i {
                    padding: 0.8rem;
                }
            }

            .carousel-control-prev {
                justify-content: flex-start;
            }

            .carousel-control-next {
                justify-content: flex-end;
            }

            .carousel-control-prev,
            .carousel-control-next {
                transition: none;
                opacity: unset;
            }
        </style>
    </head>
    <body>

    <div class="container">
        <div id="blog" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="carousel-item <?php echo ($row['message_id'] == 1) ? 'active' : ''; ?>">
                        <div class="carousel-caption">
                            <p><?php echo $row['message_content']; ?></p>
                            <img src="<?php echo htmlspecialchars($row['photo_path'], ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid">
                            <div id="image-caption">User ID: <?php echo $row['user_id']; ?> | Timestamp: <?php echo $row['timestamp']; ?></div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <a class="carousel-control-prev" href="#blog" role="button" data-slide="prev">
                <i class="fa fa-arrow-left"></i>
            </a>
            <a class="carousel-control-next" href="#blog" role="button" data-slide="next">
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>

    <!-- Homepage Button -->
    <div class="text-center mt-3">
        <a href="homepage.php" class="btn btn-danger">Homepage</a>
    </div>
    </div>


    <?php
    // Close the database connection
    mysqli_close($conn);
    ?>
    </body>
    </html>
    <?php
    
} else {
    // No messages found
    echo "No messages found.";
}

?>


</body>
</html>
