<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM Zone Checkout</title>

    <link rel="stylesheet" type="text/css" href="css/checkout.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

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

    <!-- The overlay -->
    <div id="myNav" class="overlay">
        <!-- Button to close the overlay navigation -->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <!-- Overlay content -->
        <div class="overlay-content">
            <a href="about.php">OUR STORY</a>
            <a class="active" href="membership.php">MEMBERSHIP</a>
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

        function submitForm() {
            var cardNumber = document.getElementById('card_number').value;
            var cardHolder = document.getElementById('card_holder').value;
            var expiryMonth = document.getElementById('expiry_month').value;
            var expiryYear = document.getElementById('expiry_year').value;
            var cvv = document.getElementById('cvv').value;

            // Card number validation
            if (cardNumber.length !== 16 || isNaN(cardNumber)) {
                alert('Please enter a valid 16-digit card number.');
                return false; // Prevent form submission
            }

            // Cardholder name validation
            if (!/^[a-zA-Z\s]+$/.test(cardHolder)) {
                alert('Please enter a valid cardholder name.');
                return false;
            }

            // Expiry date validation
            var currentDate = new Date();
            var enteredDate = new Date(expiryYear, expiryMonth - 1);

            if (enteredDate < currentDate) {
                alert('Please enter a valid expiry date.');
                return false;
            }

            // CVV validation
            if (cvv.length !== 3 || isNaN(cvv)) {
                alert('Please enter a valid 3-digit CVV.');
                return false;
            }

            return true; // Form submission allowed
        }
    </script>

    <div class="chekout">
        <p class="checkout-text">Checkout</p>
    </div>

    <main class="flex justify-center items-center h-screen form">
        <section class="flex flex-col w-[500px] items-center gap-4">
            <!-- Card Card -->
            <div class="bg-gradient-to-r from-teal-500/60 to-blue-500/90 rounded-xl backdrop-blur-md shadow-xl shadow-black/60 w-96 h-60 py-4 px-8 text-white">
                <!-- Bank Name Row -->
                <div class="flex justify-between">
                    <p class="text-bold"><b>Credit</b>Card</p>
                    <div class="flex relative">
                        <div class="bg-red-500 h-8 w-8 rounded-full absolute right-5 top-1 z-10"></div>
                        <div class="bg-amber-500 h-8 w-8 rounded-full absolute right-0 top-1"></div>
                    </div>
                </div>
                <!--  Chip Row  -->
                <img class="my-2 w-12 h-12" alt="Icons8 flat sim card chip" src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0d/Icons8_flat_sim_card_chip.svg/512px-Icons8_flat_sim_card_chip.svg.png">

                <!--  Number Row  -->
                <label class="text-xs uppercase">Card Number</label>
                <div class="text-bold text-2xl flex justify-between drop-shadow-2xl">
                    <p id="number-1">1234</p>
                    <p id="number-2">5678</p>
                    <p id="number-3">9876</p>
                    <p id="number-4">5643</p>
                </div>
                <!-- Card Holder -->
                <div class="flex justify-between">
                    <div>
                        <label class="text-xs uppercase">Card Holder</label>
                        <p class="text-xl">Lionel Messi</p>
                    </div>
                    <div>
                        <<label class="text-xs uppercase">Valid Till</label>
                            <p class="text-xl">02/32</p>
                    </div>
                </div>
            </div>

            <!-- Credit Card Form -->
            <div class="bg-gray-300/40 backdrop-blur-md shadow-lg h-auto w-full p-4 text-slate-500 text-bold text-xl gap-2 font-mono  rounded-xl">
                <form action="payment_success.php" method="post" onsubmit="return submitForm()">
                    <div class="flex flex-col gap-2">
                        <!-- Card Number -->
                        <label>Card Number</label>
                        <input class="text-black bg-slate-400/30 pl-4" type="tel" inputmode="numeric" id="card_number" placeholder="XXXX XXXX XXXX XXXX" maxlength="16" required></input>

                        <!-- Card Holder -->
                        <label>Card Holder</label>
                        <input class="text-black bg-slate-400/30 pl-4" type="text" id="card_holder" placeholder="Lionel Messi" required></input>

                        <!-- Expiry Date & CVV -->
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <label>Expiry Date</label>
                                <div class="flex flex-row gap-2">
                                    <input class="w-14 text-black bg-slate-400/30 pl-4" type="numeric" id="expiry_month" placeholder="MM" maxlength="2" required></input>
                                    <input class="w-20 text-black bg-slate-400/30 pl-4" type="numeric" id="expiry_year" placeholder="YYYY" maxlength="4" required></input>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label>CVV</label>
                                <input class="w-20 text-black bg-slate-400/30 pl-4" type="numeric" id="cvv" placeholder="XXX" maxlength="3" required></input>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-pink-500 to-red-500 m-2 rounded-full mt-4 py-1 px-4 text-white text-lg">Submit</button>
                </form>
            </div>
        </section>
    </main>

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