<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM Zone Payment</title>

    <link rel="stylesheet" type="text/css" href="css/payment_success.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div class="main-container">
        <div class="check-container">
            <div class="check-background">
                <svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="check-shadow"></div>
        </div>
    </div>

    <div class="payment-done">
        <p class="payment-done-text">PAYMENT SUCCESSFUL. Thank you!</p>
    </div>

    <div class="button-back">
        <button class="back-button" onclick="goToHomepage()">Go Back</button>
    </div>

    <script>
        // JavaScript function to navigate back to the homepage
        function goToHomepage() {
            window.location.href = "homepage.php";
        }
    </script>

</body>

</html>