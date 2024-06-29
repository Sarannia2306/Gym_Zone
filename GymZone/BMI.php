<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM Zone BMI</title>
    <link rel="stylesheet" type="text/css" href="css/BMI.css" />
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

    <form class="form" id="form" onsubmit="return validateForm()">
        <div class="container">
            <div class="content">
                <div class="title">Body Mass Index Calculator</div>
                <div class="flex-container">
                    <div class="age">
                        <input type="text" id="age" class="text-input" placeholder="AGE" required>
                    </div>
                    <div class="weight">
                        <input type="text" id="weight" class="text-input" placeholder="WEIGHT" required>
                    </div>
                    <div class="height">
                        <input type="text" id="height" class="text-input" placeholder="HEIGHT" required>
                    </div>
                </div>
                <div class="flex-container-gender">
                    <div class="gender-details-male">
                        <input type="radio" id="m" name="radio" value="male">
                        <label for="male">Male</label>
                    </div>
                    <div class="gender-details-female">
                        <input type="radio" id="f" name="radio" value="female">
                        <label for="male">Female</label>
                    </div>
                </div>
                <button type="button" id="submit">Submit</button>
            </div>
        </div>
    </form>

    <!-- Results container -->
    <div id="results-container"></div>

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
                echo '<a href="log_in.php">LOG IN';
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

        var age = document.getElementById("age");
        var height = document.getElementById("height");
        var weight = document.getElementById("weight");
        var male = document.getElementById("m");
        var female = document.getElementById("f");
        var form = document.getElementById("form");

        function validateForm() {
            if (age.value == '' || height.value == '' || weight.value == '' || (male.checked == false && female.checked == false)) {
                alert("All fields are required!");
                document.getElementById("submit").removeEventListener("click", countBmi);
            } else {
                countBmi();
            }
        }
        document.getElementById("submit").addEventListener("click", validateForm);

        function countBmi() {
            var p = [age.value, height.value, weight.value];
            if (male.checked) {
                p.push("male");
            } else if (female.checked) {
                p.push("female");
            }
            form.reset();
            var bmi = Number(p[2]) / (Number(p[1]) / 100 * Number(p[1]) / 100);

            var result = '';
            if (bmi < 18.5) {
                result = 'Underweight';
            } else if (18.5 <= bmi && bmi <= 24.9) {
                result = 'Healthy';
            } else if (25 <= bmi && bmi <= 29.9) {
                result = 'Overweight';
            } else if (30 <= bmi && bmi <= 34.9) {
                result = 'Obese';
            } else if (35 <= bmi) {
                result = 'Extremely obese';
            }

            var h1 = document.createElement("h1");
            var h2 = document.createElement("h2");

            var t = document.createTextNode(result);
            var b = document.createTextNode('BMI: ');
            var r = document.createTextNode(parseFloat(bmi).toFixed(2));

            h1.appendChild(t);
            h2.appendChild(b);
            h2.appendChild(r);

            var resultsContainer = document.getElementById("results-container");
            resultsContainer.innerHTML = '';  // Clear previous results
            resultsContainer.appendChild(h1);
            resultsContainer.appendChild(h2);

            document.getElementById("submit").removeEventListener("click", countBmi);
            document.getElementById("submit").removeEventListener("click", validateForm);
        }
        document.getElementById("submit").addEventListener("click", countBmi);
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
